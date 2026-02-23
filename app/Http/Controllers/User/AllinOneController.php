<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\User;
use DB;
use App\Mail\BookTripMail;
use App\Mail\AdminBookingAlert;
use App\Destination;
use App\Tour;
use App\Benefit;
use App\TourBooking;
use App\Notification;
use App\TourPickupPoint;
use App\Gallary;
use App\ContactUs;
use App\UserReviews;
use App\ChauffeurService;
use App\Accommodation;
use Auth;

class AllinOneController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function contactus_message(Request $request)
    {
        // dd($request);

        $contactus_message = new ContactUs;

        $contactus_message->name = $request->name;
        $contactus_message->email = $request->email;
        $contactus_message->subject = $request->subject;
        $contactus_message->message = $request->message;
        // $contactus_message->save();

        if ($contactus_message->save()) {
            return back()->with('success', 'Your Message Sucessfully Submited!');
        }

        return back()->with('error', 'There is some trouble to proceed your action!');

    }

    /**
     * Accommodation detail page (load by slug from DB).
     */
    public function accommodationDetail($slug)
    {
        $accommodation = Accommodation::where('slug', $slug)->where('is_active', true)
            ->with(['images', 'chauffeurService'])
            ->firstOrFail();

        $chauffeurServices = ChauffeurService::active()->ordered()->get();
        $defaultChauffeur = $accommodation->chauffeurService ?? $chauffeurServices->firstWhere('is_default', true) ?? $chauffeurServices->first();
        $otherChauffeurs = $chauffeurServices->where('id', '!=', $defaultChauffeur?->id)->values();

        return view('accommodation-detail', compact('accommodation', 'chauffeurServices', 'defaultChauffeur', 'otherChauffeurs'));
    }

    public function tourdetails($id)
    {
        $admin = User::where('id', 1)->where('type', 0)->first();
        $tour = Tour::where('id', $id)->first();
        $pickup_points = TourPickupPoint::where('tour_id', $id)->get();
        $benefits = Benefit::where('tour_id', $id)->get();
        $gallery_images = Gallary::where('tour_id', $id)->get();
        $destinations = Destination::orderBy('id', 'desc')->get();
        $agency = User::find($tour->agency_id);
        
        // Fetch all cities related to the specific tour
        $allCities = $pickup_points->pluck('pickup_city')->unique();
        
        $ratings = UserReviews::where('agency_id', $tour->agency_id)->get();
        if($ratings->count() > 0)
        {
            $ratingValues = [];
            foreach($ratings as $rating)
            {
                $ratingValues[] = $rating->rating_stars;
            }
            $ratingAverage = collect($ratingValues)->sum() / $ratings->count();
            $tour->rating = $ratingAverage;
            $tour->reviews_count = $ratings->count();
        }else{
            $tour->rating = '5.0';
            $tour->reviews_count = '0';
        }
        
        $reviews = UserReviews::where('agency_id', $tour->agency_id)->orderBy('id', 'desc')->get();
        foreach($reviews as $review)
        {
            $user = User::where('id', $review->user_id)->first();
            $review->user_name = $user->name;
            $review->profile_image = $user->profile_image;
            $review->user_address = $user->city.' '.$user->country;
        }
        
        
        $tours = Tour::where('destination_id', $tour->destination_id)->orderBy('created_at', 'desc')->get();
        foreach ($tours as $tor) {
            $tor->pickup_points = TourPickupPoint::where('tour_id', $tor->id)->first();
            $ratings = UserReviews::where('agency_id', $tor->agency_id)->get();

            if ($ratings->count() > 0) {
                $ratingValues = [];
                foreach ($ratings as $rating) {
                    $ratingValues[] = $rating->rating_stars;
                }
                $ratingAverage = collect($ratingValues)->sum() / $ratings->count();
                $tor->rating = $ratingAverage;
                $tor->reviews_count = $ratings->count();
            } else {
                $tor->rating = '5.0';
                $tor->reviews_count = '0';
            }

        }

        $fares = [];
       
foreach ($pickup_points as $point) {
    $fares[$point['pickup_city']] = [
        'perSeatFare' => $point['per_seat_fare'] . " " . strtoupper($point['per_seat_fare_currency']),
        'coupleFare' => $point['couple_package_fare'] . " " . strtoupper($point['per_seat_fare_currency']),
        'familyFare' => $point['family_package_fare'] . " " . strtoupper($point['family_package_fare_currency']),
        'honeymoonFare' => $point['honeymoon_package_fare'] . " " . strtoupper($point['family_package_fare_currency']),
        'pickupDate' => $point['pickup_date'],
        'pickupTime' => $point['pickup_time'],
        'pickupPoint' => $point['pickup_point'],
    ];
}
        return view('tourdetails', compact('tour', 'pickup_points','fares', 'gallery_images','benefits', 'agency', 'admin', 'allCities','reviews','destinations','tours'));
    }



    public function tours()
    {
        $tours = Tour::orderBy('created_at', 'desc')->get();

        foreach ($tours as $tour) {

            $tour->pickup_points = TourPickupPoint::where('tour_id', $tour->id)->first();
            $ratings = UserReviews::where('agency_id', $tour->agency_id)->get();

            if ($ratings->count() > 0) {
                $ratingValues = [];
                foreach ($ratings as $rating) {
                    $ratingValues[] = $rating->rating_stars;
                }
                $ratingAverage = collect($ratingValues)->sum() / $ratings->count();
                $tour->rating = $ratingAverage;
                $tour->reviews_count = $ratings->count();
            } else {
                $tour->rating = '5.0';
                $tour->reviews_count = '0';
            }

        }
        return view('tours', compact('tours'));
    }

    public function loadMoreTours(Request $request)
    {
        $offset = $request->get('offset');
        $limit = 4;
        $tours = Tour::skip($offset)->take($limit)->get();

        $hasMore = $tours->count() === $limit;

        return response()->json([
            'html' => view('load_more_tours.popular_packages', compact('tours'))->render(),
            'has_more' => $hasMore,
        ]);
    }


    public function LoadMoreFeaturesTours(Request $request)
    {
        $offset = $request->get('offset');
        $limit = 4;

        $featureds = Tour::where('is_featured', 1)->skip($offset)->take($limit)->get();


        if ($featureds->isEmpty()) {
            return response()->json(['html' => '', 'has_more' => false]);
        }

        $html = view('load_more_tours.features_tours', compact('featureds'))->render();
        return response()->json(['html' => $html, 'has_more' => true]);
    }



    public function dashboard()
    {
        // $tours = Tour::get();
        // $destinations = Destination::get();
        // dd('ok');
        return view('user.user_profile');
    }

    public function search_tours(Request $request)
    {
        $tours = Tour::orWhere('destination_id', $request->destination_id)->orWhere('trip_name', 'like', '%' . $request->destination . '%')->orderBy('id', 'desc')->get();
        if(!empty($tours))
        {
            foreach($tours as $tour)
            {
                $agency = User::where('id', $tour->agency_id)->first(['name', 'company_name','profile_image']);
                $tour->agency_name = $agency->company_name;
                $tour->profile_image = $agency->profile_image;

                $tour->pickup_points = TourPickupPoint::where('tour_id', $tour->id)->first();
                
                $ratings = UserReviews::where('agency_id', $tour->agency_id)->get();
                
                if($ratings->count() > 0)
                {
                    $ratingValues = [];
                    foreach($ratings as $rating)
                    {
                        $ratingValues[] = $rating->rating_stars;
                    }
                    $ratingAverage = collect($ratingValues)->sum() / $ratings->count();
                    $tour->rating = $ratingAverage;
                    $tour->reviews_count = $ratings->count();
                }else{
                    $tour->rating = '5.0';
                    $tour->reviews_count = '0';
                }
            }  
        }

        // dd($tourss);
        // $tours = $tourss->where('price', '>=', $request->min)->where('max_price', '<=', $request->max)->get();

        return view('tours', compact('tours'));
    }


    public function my_bookings()
    {
        $user_id = Auth::user()->id;
        
        $user = User::where('id', $user_id)->first('id');

        $tours = TourBooking::where('user_id', $user_id)->get();

        // return $current_tours;
        if (!empty($tours)) {
            foreach ($tours as $tour) {
                $tour->tour_details = Tour::where('id', $tour->tour_id)->first();

                $tour->pickup_point = TourPickupPoint::where('id', $tour->pickup_point_id)->first();
            }
        }
       
        return view('user.my_bookings', compact('tours'));
    }

    public function getCalculation(Request $request)
    {
        // try{

        $getRequest = $request->all();

        $message = '';
        $data = '';
        $currency = '';


        $pickup_point = TourPickupPoint::where('id', $getRequest['pickup_point_id'])->first();
        if (empty($pickup_point)) {
            return 'Pickup Point does not Exists!';
        }

        if ($getRequest['package_type'] == 'single') {

            $adults = $getRequest['adults_in_number'] * $pickup_point->per_seat_fare;
            $kids_between_3_to_8 = $getRequest['kids_between_3_to_8'] * $pickup_point->kids_between_3_to_8;
            $kids_under_3 = $getRequest['kids_under_3_years'] * $pickup_point->kids_under_3_years;

            $total_price = $adults + $kids_between_3_to_8 + $kids_under_3;

        } elseif ($getRequest['package_type'] == 'couple') {

            $total_price = $pickup_point->couple_package_fare;

        } elseif ($getRequest['package_type'] == 'family') {

            $total_price = $pickup_point->family_package_fare;
        } else {
            $total_price = $pickup_point->per_seat_fare;
        }

        $data = $total_price;
        $currency = $pickup_point->per_seat_fare_currency;

        $jsonData = [];
        $jsonData['message'] = 'Calculation Success';
        $jsonData['total_price'] = $data;
        $jsonData['currency'] = $currency;
        echo json_encode($jsonData);
        die;
    }

    public function book_tour(Request $request)
    {
        $tour = Tour::find($request->tour_id);

        if (empty($tour)) {
            return back()->with('error', 'Tour does not Exists!');
        }

        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        if (empty($user)) {
            return back()->with('error', 'User does not Exists!');
        }

        $booking = new TourBooking;
        $booking->tour_id = $request->tour_id;
        $booking->user_id = $user_id;
        $booking->name = $request->user_name;
        $booking->email = $request->user_email;
        $country_code = $request->country_code;
        $phone = $request->user_phone;
        $code_and_phone = $country_code . '' . $phone;

        // dd($code_and_phone);

        $booking->phone = $code_and_phone;

        if ($request->has('package_type')) {
            $booking->package_type = $request->package_type;
        }

        if ($request->has('pickup_point_id')) {
            $booking->pickup_point_id = $request->pickup_point_id;
        }

        if ($request->has('adults_in_number')) {
            $booking->adults_in_number = $request->adults_in_number;
        }

        if ($request->has('kids_under_3_years')) {
            $booking->kids_under_3_years = $request->kids_under_3_years;
        }

        if ($request->has('kids_between_3_to_8')) {
            $booking->kids_between_3_to_8 = $request->kids_between_3_to_8;
        }

        if ($request->has('payment_method')) {
            $booking->payment_method = $request->payment_method;
        }

        if ($request->has('payment_amount')) {
            $booking->payment_amount = $request->payment_amount;
        }

        if ($request->has('user_message')) {
            $booking->user_message = $request->user_message;
        }

        $booking->payment_type = "pending";
        $booking->is_paid = "false";

        if ($booking->save()) {
            $user1 = User::where('id', $user_id)->first();
            $agency = User::where('id', $tour->agency_id)->first();

            $content['name'] = $booking->name;
            $content['booking_id'] = $booking->id;
            $content['email'] = $booking->email;
            $content['phone'] = $booking->phone;
            $content['tour'] = $tour->trip_name;

            $user_email = $booking->email;
            $agency_email = $agency->email;
            $admin_email = 'info@compassmytrip.com';

            \Mail::to($user_email)->send(new BookTripMail($content));
            \Mail::to($agency_email)->send(new AdminBookingAlert($content));
            \Mail::to($admin_email)->send(new AdminBookingAlert($content));

            return redirect()->route('user.my_bookings')->with('success', 'Tour Booked Successfully!');

        }
        return back()->with('error', 'There is some trouble to proceed your action!');
    }

    public function cancel_booking($id)
    {
        try {
            $booking = TourBooking::where('id', $id)->first();

            if (empty($booking)) {
                return back()->with('error', 'Booking does not Exists!');
            }

            $booking->status = 'cancelled';
            $booking->save();

            return back()->with('success', 'Booking Cancelled Successfully!');


        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to proceed your action!',
                'data' => null,
            ], 200);
        }
    }

    public function submit_review($id)
    {
        try {
            $booking = TourBooking::where('id', $id)->first();

            if (!empty($booking)) {
                $tour_details = Tour::where('id', $booking->tour_id)->first();
                $booking->agency_id = $tour_details->agency_id;
                $agency_details = User::where('id', $tour_details->agency_id)->first();

                $booking->agency_name = $agency_details->company_name;

            }

            // dd($booking);

            return view('user.submit_review', compact('booking'));


        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to proceed your action!',
                'data' => null,
            ], 200);
        }
    }

    public function add_review(Request $request)
    {
        // dd($request);

        $review = new UserReviews;

        $review->user_id = $request->user_id;
        $review->agency_id = $request->agency_id;
        $review->rating_stars = $request->rating_stars;
        $review->review = $request->review;
        // $contactus_message->save();

        if ($review->save()) {
            return redirect()->route('user.my_bookings')->with('success', 'Your Review Sucessfully Submited!');
        }

        return back()->with('error', 'There is some trouble to proceed your action!');

    }


}
