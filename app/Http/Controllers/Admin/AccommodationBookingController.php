<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAccommodationBookingStatusRequest;
use App\Services\BookingStatusService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AccommodationBookingController extends Controller
{
    public function __construct(
        protected BookingStatusService $statusService
    ) {}

    /**
     * List accommodation bookings with filters (status, date range) and pagination.
     */
    public function index(Request $request): View
    {
        $query = Booking::query()
            ->with(['user', 'accommodation', 'chauffeurService'])
            ->orderByDesc('created_at');

        if ($request->filled('status') && in_array($request->status, [
            Booking::STATUS_PENDING,
            Booking::STATUS_CONFIRMED,
            Booking::STATUS_CANCELLED,
            Booking::STATUS_COMPLETED,
        ], true)) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('check_in_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('check_out_date', '<=', $request->date_to);
        }

        $bookings = $query->paginate(15)->withQueryString();

        return view('admin.accommodation-booking.index', compact('bookings'));
    }

    /**
     * Show a single accommodation booking (read-only; no financial field editing).
     */
    public function show(Booking $booking): View|RedirectResponse
    {
        $booking->load(['user', 'accommodation.images', 'chauffeurService']);

        return view('admin.accommodation-booking.show', compact('booking'));
    }

    /**
     * Update booking status via POST. Validates allowed transitions and runs in transaction.
     */
    public function updateStatus(UpdateAccommodationBookingStatusRequest $request, Booking $booking): RedirectResponse
    {
        try {
            $this->statusService->transition($booking, $request->validated('status'));
        } catch (\InvalidArgumentException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Booking status updated successfully.');
    }
}
