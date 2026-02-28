<?php

namespace App\Http\Controllers;

use App\Accommodation;
use App\Booking;
use App\ChauffeurService;
use App\Services\AccommodationAvailabilityService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

/**
 * Accommodation booking flow: review (POST from detail) → review page (GET) → confirm (POST) → success.
 * Security: never trust frontend; validate and re-check availability on confirm.
 */
class AccommodationBookingController extends Controller
{
    public function __construct(
        protected AccommodationAvailabilityService $availability
    ) {}

    /**
     * GET availability check for live display (e.g. "Available" / "Not available" on detail page).
     * Query: check_in, check_out (Y-m-d). Returns JSON { "available": bool }.
     */
    public function checkAvailability(Request $request, string $slug)
    {
        $accommodation = Accommodation::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $checkIn = $request->query('check_in');
        $checkOut = $request->query('check_out');
        if (!$checkIn || !$checkOut) {
            return response()->json(['available' => false, 'message' => 'Invalid dates']);
        }
        $valid = $this->availability->validateDateRange($checkIn, $checkOut);
        if (!$valid['valid']) {
            return response()->json(['available' => false, 'message' => $valid['message']]);
        }
        $available = $this->availability->isAvailable($accommodation->id, $checkIn, $checkOut);
        return response()->json(['available' => $available]);
    }

    /**
     * POST from accommodation detail page. Validate and redirect to review or back with errors.
     */
    public function storeReview(Request $request)
    {
        $slug = $request->route('slug');
        $accommodation = Accommodation::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $validated = $request->validate([
            'check_in_date'  => ['required', 'date', 'after_or_equal:today'],
            'check_out_date' => ['required', 'date', 'after:check_in_date'],
            'adults'         => ['required', 'integer', 'min:1', 'max:255'],
            'kids'           => ['required', 'integer', 'min:0', 'max:255'],
            'chauffeur_service_id' => ['nullable', Rule::exists('chauffeur_services', 'id')],
            'arrival_airport' => ['nullable', 'string', 'max:20'],
            'flight_number'   => ['nullable', 'string', 'max:50'],
        ], [
            'check_in_date.after_or_equal' => 'Check-in date cannot be in the past.',
            'check_out_date.after'         => 'Check-out date must be after check-in date.',
        ]);

        $adults = (int) $validated['adults'];
        $kids = (int) $validated['kids'];
        $totalGuests = $adults + $kids;
        if ($totalGuests < $accommodation->min_guests || $totalGuests > $accommodation->max_guests) {
            throw ValidationException::withMessages([
                'adults' => "Total guests must be between {$accommodation->min_guests} and {$accommodation->max_guests}.",
            ]);
        }

        $checkIn = $validated['check_in_date'];
        $checkOut = $validated['check_out_date'];
        $dateValidation = $this->availability->validateDateRange($checkIn, $checkOut);
        if (!$dateValidation['valid']) {
            throw ValidationException::withMessages(['check_in_date' => $dateValidation['message']]);
        }

        if (!$this->availability->isAvailable($accommodation->id, $checkIn, $checkOut)) {
            throw ValidationException::withMessages([
                'check_in_date' => 'This accommodation is not available for the selected dates. Please choose different dates.',
            ]);
        }

        $nights = Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut));
        $pricePerNight = (float) $accommodation->price_per_night;
        $chauffeurServiceId = isset($validated['chauffeur_service_id']) ? (int) $validated['chauffeur_service_id'] : null;
        $chauffeurPrice = 0;
        if ($chauffeurServiceId) {
            $chauffeur = ChauffeurService::find($chauffeurServiceId);
            if ($chauffeur && !$chauffeur->is_default) {
                $chauffeurPrice = (float) $chauffeur->extra_price * $nights;
            }
        }
        $subtotal = $pricePerNight * $nights;
        $totalPrice = $subtotal + $chauffeurPrice;

        $bookingPayload = [
            'accommodation_id'      => $accommodation->id,
            'slug'                  => $slug,
            'check_in_date'         => $checkIn,
            'check_out_date'        => $checkOut,
            'nights'                => $nights,
            'adults'                => $adults,
            'kids'                 => $kids,
            'price_per_night'      => $pricePerNight,
            'chauffeur_service_id' => $chauffeurServiceId,
            'chauffeur_price'      => $chauffeurPrice,
            'arrival_airport'      => $validated['arrival_airport'] ?? null,
            'flight_number'        => $validated['flight_number'] ?? null,
            'total_price'          => $totalPrice,
        ];

        session([
            'accommodation_booking_review'     => $bookingPayload,
            'accommodation_booking_review_slug' => $slug,
        ]);

        return redirect()->route('accommodation.booking.review', ['slug' => $slug]);
    }

    /**
     * GET booking review page. Data from session (set by storeReview).
     */
    public function showReview(Request $request, string $slug)
    {
        $accommodation = Accommodation::where('slug', $slug)->where('is_active', true)
            ->with(['images', 'chauffeurService'])
            ->firstOrFail();

        $payload = session('accommodation_booking_review');
        if (!$payload || (int) ($payload['accommodation_id'] ?? 0) !== (int) $accommodation->id) {
            return redirect()->route('accommodation.detail', $slug)
                ->with('error', 'Please submit your dates and guests to continue.');
        }

        session(['accommodation_booking_review_slug' => $slug]);

        $chauffeurService = null;
        if (!empty($payload['chauffeur_service_id'])) {
            $chauffeurService = ChauffeurService::find($payload['chauffeur_service_id']);
        }

        return view('accommodation-booking-review', [
            'accommodation'    => $accommodation,
            'payload'          => $payload,
            'chauffeurService' => $chauffeurService,
        ]);
    }

    /**
     * POST confirm booking. Re-check availability, validate, save as pending, redirect to success.
     */
    public function confirm(Request $request)
    {
        $payload = session('accommodation_booking_review');
        if (!$payload) {
            $slug = session('accommodation_booking_review_slug');
            if ($slug) {
                return redirect()->route('accommodation.detail', $slug)
                    ->with('error', 'Your booking session expired. Please select your dates and try again.');
            }
            return redirect()->route('index')
                ->with('error', 'Your booking session expired. Please start your booking again.');
        }

        $accommodation = Accommodation::where('id', $payload['accommodation_id'])->where('is_active', true)->first();
        if (!$accommodation) {
            session()->forget(['accommodation_booking_review', 'accommodation_booking_review_slug']);
            $slug = $payload['slug'] ?? null;
            if ($slug) {
                return redirect()->route('accommodation.detail', $slug)->with('error', 'This accommodation is no longer available.');
            }
            return redirect()->route('index')->with('error', 'Accommodation no longer available.');
        }

        $checkIn = $payload['check_in_date'];
        $checkOut = $payload['check_out_date'];

        try {
            $this->availability->assertAvailable($accommodation->id, $checkIn, $checkOut);
        } catch (\RuntimeException $e) {
            session()->forget('accommodation_booking_review');
            return redirect()->route('accommodation.detail', $accommodation->slug)
                ->with('error', $e->getMessage());
        }

        DB::transaction(function () use ($payload, $accommodation) {
            $booking = new Booking();
            $booking->user_id = Auth::id();
            $booking->accommodation_id = $accommodation->id;
            $booking->check_in_date = $payload['check_in_date'];
            $booking->check_out_date = $payload['check_out_date'];
            $booking->nights = $payload['nights'];
            $booking->adults = $payload['adults'];
            $booking->kids = $payload['kids'];
            $booking->price_per_night = $payload['price_per_night'];
            $booking->chauffeur_service_id = $payload['chauffeur_service_id'] ?? null;
            $booking->chauffeur_price = $payload['chauffeur_price'] ?? 0;
            $booking->arrival_airport = $payload['arrival_airport'] ?? null;
            $booking->flight_number = $payload['flight_number'] ?? null;
            $booking->total_price = $payload['total_price'];
            $booking->status = Booking::STATUS_PENDING;
            $booking->save();
            session(['accommodation_booking_confirmed_reference' => $booking->reference]);
        });

        session()->forget(['accommodation_booking_review', 'accommodation_booking_review_slug']);

        return redirect()->route('accommodation.booking.success', [
            'reference' => session('accommodation_booking_confirmed_reference'),
        ]);
    }

    /**
     * GET success page after booking.
     */
    public function success(Request $request, string $reference)
    {
        $booking = Booking::where('reference', $reference)
            ->with(['accommodation', 'chauffeurService'])
            ->firstOrFail();

        session()->forget('accommodation_booking_confirmed_reference');

        return view('accommodation-booking-success', ['booking' => $booking]);
    }
}
