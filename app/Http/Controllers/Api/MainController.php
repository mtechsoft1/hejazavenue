<?php

namespace App\Http\Controllers\Api;

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
use App\TourBooking;
use App\Notification;
use App\TourPickupPoint;
use App\Gallary;
use App\UserReviews;

class MainController extends Controller
{    
    public function home_screen()
    {
        try{
            $providers = User::where('type', '2')->get();            

            $destinations = Destination::where('is_public', 'true')->orderBy('created_at', 'desc')->get(['id', 'destination_name', 'destination_image']);

            if(!empty($destinations))
            {
                foreach($destinations as $dest)
                {
                    $dest->tours = Tour::where('destination_id', $dest->id)->get();

                    if(!empty($dest->tours))
                    {
                        foreach($dest->tours as $t)
                        {
                            $agency = User::where('id', $t->agency_id)->first(['name', 'company_name','profile_image']);
                            // return $agency->profile_image;
                            $t->agency_name = $agency->company_name;
                            $t->profile_image = $agency->profile_image;
                            $t->average_rating = '5.0';

                            $t->pickup_points = TourPickupPoint::where('tour_id', $t->id)->get();
                        }
                    }
                }
            }
            
            $featured = Tour::orderBy('created_at', 'desc')->take(5)->get();

            if(!empty($featured))
            {
                foreach($featured as $t)
                {
                    $agency = User::where('id', $t->agency_id)->first(['name', 'company_name','profile_image']);
                    
                    $t->agency_name = $agency->company_name;
                    $t->profile_image = $agency->profile_image;
                    $t->average_rating = '5.0';

                    $t->pickup_points = TourPickupPoint::where('tour_id', $t->id)->get();
                }
            }              
            // return $featured;
            $search_suggestions = Destination::where('is_public', 'true')->orderBy('created_at', 'desc')->get(['id', 'destination_name', 'destination_image']);

            return response()->json([
                'status' => $destinations->count() > 0 ? 200 : 400,
                'message' => $destinations->count() > 0 ? 'Tours Found!' : 'No Tour Found!',
                'data' => [
                    'destinations' => $search_suggestions->count() > 0 ? $search_suggestions : [],
                    'providers' => $providers->count() > 0 ? $providers : [],
                    'featured' => $featured->count() > 0 ? $featured : [],
                    'tours' => $destinations->count() > 0 ? $destinations : [],
                ],
            ], 200);
        }catch(\Exception $e)
        {
            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to proceed your action!',
                'data' => null,
            ], 200);
        }
    }

    public function search_tours(Request $request)
    {
        try{
            $destination = '%'.$request->destination.'%';
            
            $dest = Destination::orWhere('destination_name', 'like', '%'.$destination.'%')->first();

            if(empty($dest))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'No Destination Found!',
                    'data' => [],
                ], 200);
            }

            $tours = Tour::where('destination_id', $dest->id)->get();

            if(!empty($tours))
            {
                foreach($tours as $tour)
                {
                    $agency = User::where('id', $tour->agency_id)->first(['name', 'profile_image']);

                    $tour->agency_name = $agency->name;
                    $tour->profile_image = $agency->profile_image;
                    $tour->average_rating = '5.0';

                    $tour->pickup_points = TourPickupPoint::where('tour_id', $tour->id)->get();
                }
            }

            return response()->json([
                'status' => $tours->count() > 0 ? 200 : 400,
                'message' => $tours->count() > 0 ? 'Tours Found!' : 'No Tour Found!',
                'data' => $tours->count() > 0 ? $tours : [],
            ], 200);
        }catch(\Exception $e)
        {
            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to proceed your action!',
                'data' => null,
            ], 200);
        }
    }

    public function book_tour(Request $request)
    {
        // try{
            $tour = Tour::find($request->tour_id);

            if(empty($tour))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Tour does not Exists!',
                    'data' => null,
                ], 200);
            }

            $user = User::find($request->user_id);

            if(empty($user))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'User does not Exists!',
                    'data' => null,
                ], 200);
            }

            $booking = new TourBooking;
            $booking->tour_id = $request->tour_id;
            $booking->user_id = $request->user_id;
            
            $booking->name = $request->name;
            $booking->email = $request->email;
            $booking->phone = $request->phone;

            if($request->has('package_type'))
            {
                $booking->package_type = $request->package_type;
            }

            if($request->has('pickup_point_id'))
            {
                $booking->pickup_point_id = $request->pickup_point_id;
            }            

            if($request->has('adults_in_number'))
            {
                $booking->adults_in_number = $request->adults_in_number;
            }

            if($request->has('kids_under_3_years'))
            {
                $booking->kids_under_3_years = $request->kids_under_3_years;
            }
            
            if($request->has('kids_between_3_to_8'))
            {
                $booking->kids_between_3_to_8 = $request->kids_between_3_to_8;
            }

            if($request->has('payment_method'))
            {
                $booking->payment_method = $request->payment_method;
            }

            if($request->has('payment_amount'))
            {
                $booking->payment_amount = $request->payment_amount;
            }
            
            if($request->has('deposit_receipt'))
            {
                $image = $request->deposit_receipt;
                
                if($image->getClientOriginalExtension() == 'PNG' ||$image->getClientOriginalExtension() == 'png' || $image->getClientOriginalExtension() == 'JPG' || $image->getClientOriginalExtension() == 'jpg' || $image->getClientOriginalExtension() == 'jpeg' || $image->getClientOriginalExtension() == 'JPEG')
                {
                    $new_name = rand().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('/deposit_receipts'), $new_name);
                    $img_path = 'deposit_receipts/'.$new_name;  
                }else{  
                    return response()->json([
                        'status' => 400,
                        'message' => 'Please Choose a Valid Image!',
                        'data' => null,
                    ], 200);
                }         
                

                $booking->deposit_receipt = $img_path;        
            }
            
            if($request->has('user_message'))
            {
                $booking->user_message = $request->user_message;
            }

            if($request->has('payment_type'))
            {
                $booking->payment_type = $request->payment_type;
            }

            if($request->has('is_paid'))
            {
                $booking->is_paid = $request->is_paid;
            }

            if($booking->save()){
                // $user1 = User::where('id', $request->user_id)->first();
                // $content = $user1->name;
                // $email = $user1->email;
                // $admin ='mtechmembers@gmail.com';
                // \Mail::to($email)->send(new BookTripMail($content));
                // \Mail::to($admin)->send(new AdminBookingAlert($content));
                return response()->json([
                    'status' => 200,
                    'message' => 'Tour Booked!',
                    'data' => $booking,
                ], 200);
            }
        // }catch(\Exception $e)
        // {
        //     return response()->json([
        //         'status' => 400,
        //         'message' => 'There is some trouble to proceed your action!',
        //         'data' => null,
        //     ], 200);
        // }
    }

    public function my_tours(Request $request)
    {
        try{
            $user = User::where('id', $request->user_id)->first('id');

            if(empty($user))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'User does not Exists',
                    'data' => [],
                ], 200);
            }
            
            $current_tours = TourBooking::where('user_id', $request->user_id)->where('status', 'pending')->get();
            // return $current_tours;
            if(!empty($current_tours))
            {
                foreach($current_tours as $tour)
                {
                    $tour_details = Tour::find($tour->tour_id)->first();
                    $tour->tour_id = $tour_details->id;
                    $tour->agency_id = $tour_details->agency_id;
                    $tour->agency_name = User::find($tour_details->agency_id)->company_name;
                    $tour->agency_logo = User::find($tour_details->agency_id)->profile_image;
                    $tour->agency_rating = '5.0';
                    $tour->destination_id = $tour->destination_id;
                    $tour->destination_name = Destination::find($tour_details->destination_id)->destination_name;
                    $tour->trip_name = $tour_details->trip_name;
                    $tour->trip_image = $tour_details->trip_image;
                    $tour->trip_description = $tour_details->trip_description;
                    $tour->trip_start_date = $tour_details->trip_start_date;
                    $tour->trip_end_date = $tour_details->trip_end_date;
                    $tour->trip_total_days = $tour_details->trip_total_days;
                    $tour->per_person_fare = $tour_details->per_seat_fare;
                    $tour->per_person_fare_currency = $tour_details->per_seat_fare_currency;
                    $tour->couple_package_fare = $tour_details->couple_package_fare;
                    $tour->couple_package_fare_currency = $tour_details->couple_package_fare_currency;
                    $tour->family_package_fare = $tour_details->family_package_fare;
                    $tour->family_package_fare_currency = $tour_details->family_package_fare_currency;
                    $tour->total_bookings = TourBooking::where('tour_id', $tour->tour_id)->where('status', '!=', 'completed')->count();
                    
                    $tour->pickup_points = TourPickupPoint::where('id', $tour->pickup_point_id)->first();
                }
            }
            // return $current_tours;
            $past_tours = TourBooking::where('user_id', $request->user_id)->where('status', 'completed')->get();
        
            if(!empty($past_tours))
            {
                foreach($past_tours as $tour)
                {
                    $tour_details = Tour::find($tour->tour_id)->first();
                    $tour->tour_id = $tour_details->id;
                    $tour->agency_id = $tour_details->agency_id;
                    $tour->agency_name = User::find($tour_details->agency_id)->company_name;
                    $tour->agency_logo = User::find($tour_details->agency_id)->profile_image;
                    $tour->agency_rating = '5.0';
                    $tour->destination_id = $tour->destination_id;
                    $tour->destination_name = Destination::find($tour_details->destination_id)->destination_name;
                    $tour->trip_name = $tour_details->trip_name;
                    $tour->trip_image = $tour_details->trip_image;
                    $tour->trip_description = $tour_details->trip_description;
                    $tour->trip_start_date = $tour_details->trip_start_date;
                    $tour->trip_end_date = $tour_details->trip_end_date;
                    $tour->trip_total_days = $tour_details->trip_total_days;
                    $tour->per_person_fare = $tour_details->per_seat_fare;
                    $tour->per_person_fare_currency = $tour_details->per_seat_fare_currency;
                    $tour->couple_package_fare = $tour_details->couple_package_fare;
                    $tour->couple_package_fare_currency = $tour_details->couple_package_fare_currency;
                    $tour->family_package_fare = $tour_details->family_package_fare;
                    $tour->family_package_fare_currency = $tour_details->family_package_fare_currency;
                    $tour->trip_pickup_point = $tour_details->pickup_point;
                    $tour->trip_pickup_point_latitude = $tour_details->pickup_point_latitude;
                    $tour->trip_pickup_point_longitude = $tour_details->pickup_point_longitude;
                    $tour->total_bookings = TourBooking::where('tour_id', $tour->tour_id)->where('status', 'completed')->count();
                    $tour->pickup_points = TourPickupPoint::where('id', $tour->pickup_point_id)->first();
                }
            }

            if($current_tours->count() > 0 || $past_tours->count() > 0)
            {
                return response()->json([
                    'status' => 200,
                    'message' => 'Tours Found!',
                    'data' => [
                        'current_tours' => $current_tours->count() > 0 ? $current_tours : [],
                        'past_tours' => $past_tours->count() > 0 ? $past_tours : [],
                    ],
                ], 200);
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'No Tour Found!',
                    'data' => [
                        'current_tours' => $current_tours->count() > 0 ? $current_tours : [],
                        'past_tours' => $past_tours->count() > 0 ? $past_tours : [],
                    ],
                ], 200);
            }
        }catch(\Exception $e)
        {
            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to proceed your action!',
                'data' => null,
            ], 200);
        }
    }

    public function notification_list(Request $request)
    {
        try{
            $user = User::find($request->user_id);

            if(empty($user))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'User does not Exists!',
                    'data' => null,
                ],200);
            }

            $notifications = Notification::where('notification_to', $request->user_id)->get();

            if(!empty($notifications))
            {
                foreach($notifications as $notification)
                {
                    $noti = User::where('id', $notification->notification_from)->first(['name', 'profile_image']);

                    $notification->notification_from_name = $noti->name;
                    $notification->notification_from_image = $noti->profile_image;
                }
            }

            return response()->json([
                'status' => $notifications->count() > 0 ? 200 : 400,
                'message' => $notifications->count() > 0 ? 'Notifications Found' : 'No Notification Found',
                'data' => $notifications->count() > 0 ? $notifications : [],
            ], 200);
        }catch(\Exception $e)
        {
            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to proceed your action!',
                'data' => null,
            ], 200);
        }
    }

    public function create_tour(Request $request)
    {
        // try{    
            // $pickup_locations = json_decode($request->pickup_locations);
            // return $pickup_locations[1];

            $agency = User::find($request->agency_id);

            if(empty($agency))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Tour Provider does not Exists!',
                    'data' => [],
                ], 200);
            }

            $destination = Destination::find($request->destination_id);

            if(empty($destination))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Destination does not Exists!',
                    'data' => [],
                ], 200);
            }

            $tour = new Tour;
            $tour->agency_id = $request->agency_id;
            $tour->destination_id = $request->destination_id;
            
            
            if($request->has('trip_image'))
            {
                $image = $request->trip_image;
                
                if($image->getClientOriginalExtension() == 'PNG' ||$image->getClientOriginalExtension() == 'png' || $image->getClientOriginalExtension() == 'JPG' || $image->getClientOriginalExtension() == 'jpg' || $image->getClientOriginalExtension() == 'jpeg' || $image->getClientOriginalExtension() == 'JPEG')
                    {
                        $new_name = rand().'.'.$image->getClientOriginalExtension();
                        $image->move(public_path('/tour_images'), $new_name);
                        $img_path = 'tour_images/'.$new_name;  
                    }else{  
                        return response()->json([
                            'status' => 400,
                            'message' => 'Please Choose a Valid Image!',
                            'data' => null,
                        ], 200);
                    }         
                

                $tour->trip_image = $img_path;         
            }

            $tour->trip_name = $request->trip_name;
            $tour->trip_description = $request->trip_description;
            $tour->trip_start_date = $request->trip_start_date;
            $tour->trip_end_date = $request->trip_end_date;
            $tour->trip_total_days = $request->trip_total_days;
            $tour->attractions = $request->attractions;
            $tour->trip_duration = $request->trip_duration;
            $tour->status = 'active';
            
            if($tour->save())
            {
                $pickup_locations = json_decode($request->pickup_locations);
                

                for($i = 0; $i < count($pickup_locations); $i++)
                {
                    // dd($pickup_locations[0]);

                    $point = new TourPickupPoint;
                    $point->tour_id = $tour->id;
                    $point->pickup_city = $pickup_locations[$i]->pickup_city;
                    $point->per_seat_fare = $pickup_locations[$i]->per_seat_fare;
                    $point->per_seat_fare_currency = $pickup_locations[$i]->per_seat_fare_currency;
                    $point->couple_package_fare = $pickup_locations[$i]->couple_package_fare;
                    $point->couple_package_fare_currency = $pickup_locations[$i]->couple_package_fare_currency;
                    $point->family_package_fare = $pickup_locations[$i]->family_package_fare;
                    $point->family_package_fare_currency = $pickup_locations[$i]->family_package_fare_currency;
                    $point->kids_under_3_years = $pickup_locations[$i]->kids_under_3_years;
                    $point->kids_between_3_to_8 = $pickup_locations[$i]->kids_between_3_to_8;
                    $point->kids_above_8_years = $pickup_locations[$i]->kids_above_8_years;
                    $point->pickup_point = $pickup_locations[$i]->pickup_point;
                    $point->pickup_point_latitude = $pickup_locations[$i]->pickup_point_latitude;
                    $point->pickup_point_longitude = $pickup_locations[$i]->pickup_point_longitude;
                    $point->pickup_date = $pickup_locations[$i]->pickup_date;
                    $point->pickup_time = $pickup_locations[$i]->pickup_time;               
                    $point->save();
                } 
            }  
            
            $tour->pickup_points = TourPickupPoint::where('tour_id', $tour->id)->get();

            return response()->json([
                'status' => 200,
                'message' => 'Tour Saved Successfully!',
                'data' => $tour,
            ], 200);

        // }catch(\Exception $e)
        // {
        //     return response()->json([
        //         'status' => 400,
        //         'message' => 'There is some trouble to prceed your action!',
        //         'data' => [],
        //     ], 200);
        // }
    }

    public function edit_tour(Request $request)
    {
        // try{  

            $tour = Tour::where('id', $request->tour_id)->first('id');

            if(empty($tour))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Tour does not Exists!',
                    'data' => [],
                ], 200);
            }          

            
            
            if($request->has('trip_image'))
            {
                $image = $request->trip_image;

                if($image->getClientOriginalExtension() == 'PNG' ||$image->getClientOriginalExtension() == 'png' || $image->getClientOriginalExtension() == 'JPG' || $image->getClientOriginalExtension() == 'jpg' || $image->getClientOriginalExtension() == 'jpeg' || $image->getClientOriginalExtension() == 'JPEG')
                {
                    $new_name = rand().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('/tour_images'), $new_name);
                    $img_path = 'tour_images/'.$new_name;  
                }else{  
                    return response()->json([
                        'status' => 400,
                        'message' => 'Please Choose a Valid Image!',
                        'data' => null,
                    ], 200);
                }

                $tour->trip_image = $img_path;        
            }
                
            $tour->trip_name = $request->trip_name;
            $tour->destination_id = $request->destination_id;
            $tour->trip_description = $request->trip_description;
            $tour->trip_start_date = $request->trip_start_date;
            $tour->trip_end_date = $request->trip_end_date;
            $tour->trip_total_days = $request->trip_total_days;
            $tour->attractions = $request->attractions;
            $tour->trip_duration = $request->trip_duration;
            // $tour->per_seat_fare = $request->per_seat_fare;
            // $tour->per_seat_fare_currency = $request->per_seat_fare_currency;
            // $tour->couple_package_fare = $request->couple_package_fare;
            // $tour->couple_package_fare_currency = $request->couple_package_fare_currency;
            // $tour->family_package_fare = $request->family_package_fare;
            // $tour->family_package_fare_currency = $request->family_package_fare_currency;
            // $tour->per_kid_fare = $request->per_kid_fare;
            // $tour->per_kid_fare_currency = $request->per_kid_fare_currency;
            
            if($tour->save())
            {
                // $pickup_locations = json_decode(json_encode($request->pickup_locations));

                // for($i = 0; $i < count($pickup_locations); $i++)
                // {
                //     // dd($pickup_locations[0]);

                //     $point = new TourPickupPoint;
                //     $point->tour_id = $tour->id;
                //     $point->pickup_point = $pickup_locations[$i]->pickup_point;
                //     $point->pickup_point_latitude = $pickup_locations[$i]->pickup_point_latitude;
                //     $point->pickup_point_longitude = $pickup_locations[$i]->pickup_point_longitude;

                //     $point->save();
                // } 
                
                $tour->pickup_points = TourPickupPoint::where('tour_id', $tour->id)->get();
                
                return response()->json([
                    'status' => 200,
                    'message' => 'Tour Info Updated',
                    'data' => $tour,
                ], 200);
            }

            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to Update Tour Info',
                'data' => [],
            ], 200);

        // }catch(\Exception $e)
        // {
        //     return response()->json([
        //         'status' => 400,
        //         'message' => 'There is some trouble to prceed your action!',
        //         'data' => [],
        //     ], 200);
        // }
    }
    
    public function get_destinations()
    {
        try{
            $destinations = Destination::all();
            
            return response()->json([
                'status' => $destinations->count() > 0 ? 200 : 400,
                'message' => $destinations->count() > 0 ? 'Destinations Found' : 'No Destination Found',
                'data' => $destinations->count() > 0 ? $destinations : [],
            ], 200);
        }catch(\Exception $e)
        {
            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to proceed your action!',
                'data' => [],
            ], 200);
        }
    }
    
    public function agent_tours(Request $request)
    {
        // try{
            $user = User::find($request->user_id);
            
            if(empty($user))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Agent does not Exists!',
                    'data' => null,
                ], 200);
            }
            
            $current_tours = Tour::where('agency_id', $request->user_id)->orderBy('id', 'desc')->orderBy('id', 'desc')->where('status', 'active')->get();
            
            if(!empty($current_tours))
            {
                foreach($current_tours as $tour)
                {
                    $dest = Destination::where('id', $tour->destination_id)->first('destination_name');
                    
                    $tour->destination_name = $dest->destination_name;
                    
                    $tour->total_bookings = TourBooking::where('tour_id', $tour->id)->count();
                    $tour->pickup_points = TourPickupPoint::where('tour_id', $tour->id)->get();
                    
                    $tour->bookings = TourBooking::where('tour_id', $tour->id)->get();
                
                    if(!empty($tour->bookings))
                    {
                        foreach($tour->bookings as $booking)
                        {
                            // return $booking->payment_type;
                            $user_details = User::where('id', $booking->user_id)->first();
                            $booking->user_name = $user_details->name;
                            $booking->user_phone = $user_details->phone;
                            $booking->user_image = $user_details->profile_image;
                            $booking->user_details = $user_details;
                            $booking->user_details->payment_type = $booking->payment_type;
                            $booking->user_details->package_type = $booking->package_type;
                            
                            $pickup = TourPickupPoint::find($booking->pickup_point_id);
                            // return $pickup;
                            
                            $booking->user_details->pickup_city = $pickup->pickup_city;
                            $booking->user_details->per_seat_fare = $pickup->per_seat_fare;
                            $booking->user_details->per_seat_fare_currency = $pickup->per_seat_fare_currency;
                            $booking->user_details->couple_package_fare = $pickup->couple_package_fare;
                            $booking->user_details->couple_package_fare_currency = $pickup->couple_package_fare_currency;
                            $booking->user_details->family_package_fare = $pickup->family_package_fare;
                            $booking->user_details->family_package_fare_currency = $pickup->family_package_fare_currency;
                            $booking->user_details->kids_under_3_years = $pickup->kids_under_3_years;
                            $booking->user_details->kids_between_3_to_8 = $pickup->kids_between_3_to_8;
                            $booking->user_details->pickup_point = $pickup->pickup_city;
                            $booking->user_details->pickup_point_latitude = $pickup->pickup_point_latitude;
                            $booking->user_details->pickup_point_longitude = $pickup->pickup_point_longitude;
                            $booking->user_details->pickup_time = $pickup->pickup_time;
                            $booking->user_details->pickup_date = $tour->trip_start_date;
                            
                        }
                    }
                }
            }
            
            $past_tours = Tour::where('agency_id', $request->user_id)->where('status', 'completed')->orderBy('id', 'desc')->get();
            
            if(!empty($past_tours))
            {
                foreach($past_tours as $tour)
                {
                    $dest = Destination::where('id', $tour->destination_id)->first('destination_name');
                    
                    $tour->destination_name = $dest->destination_name;
                    
                    $tour->total_bookings = TourBooking::where('tour_id', $tour->id)->count();
                    $tour->pickup_points = TourPickupPoint::where('tour_id', $tour->id)->get();
                    
                    $tour->bookings = TourBooking::where('tour_id', $tour->id)->get();
                    
                    if(!empty($tour->bookings))
                    {
                        foreach($tour->bookings as $booking)
                        {
                            // return $booking->payment_type;
                            $user_details = User::where('id', $booking->user_id)->first();
                            $booking->user_name = $user_details->name;
                            $booking->user_phone = $user_details->phone;
                            $booking->user_image = $user_details->profile_image;
                            $booking->user_details = $user_details;
                            $booking->user_details->payment_type = $booking->payment_type;
                            $booking->user_details->package_type = $booking->package_type;
                            
                            $pickup = TourPickupPoint::find($booking->pickup_point_id);
                            
                            $booking->user_details->pickup_city = $pickup->pickup_city;
                            $booking->user_details->per_seat_fare = $pickup->per_seat_fare;
                            $booking->user_details->per_seat_fare_currency = $pickup->per_seat_fare_currency;
                            $booking->user_details->couple_package_fare = $pickup->couple_package_fare;
                            $booking->user_details->couple_package_fare_currency = $pickup->couple_package_fare_currency;
                            $booking->user_details->family_package_fare = $pickup->family_package_fare;
                            $booking->user_details->family_package_fare_currency = $pickup->family_package_fare_currency;
                            $booking->user_details->kids_under_3_years = $pickup->kids_under_3_years;
                            $booking->user_details->kids_between_3_to_8 = $pickup->kids_between_3_to_8;
                            $booking->user_details->pickup_point = $pickup->pickup_city;
                            $booking->user_details->pickup_point_latitude = $pickup->pickup_point_latitude;
                            $booking->user_details->pickup_point_longitude = $pickup->pickup_point_longitude;
                            $booking->user_details->pickup_time = $pickup->pickup_time;
                            $booking->user_details->pickup_date = $tour->trip_start_date;
                            
                        }
                    }
                }
            }
            
            if($current_tours->count() > 0 || $past_tours->count() > 0)
            {
                return response()->json([
                    'status' => 200,
                    'message' => 'Tours Found!',
                    'data' => [
                        'current_tours' => $current_tours,
                        'past_tours' => $past_tours,
                    ],
                ], 200);
            }else{
                return response()->json([
                    'status' => 400, 
                    'message' => 'No Tour Found!',
                    'data' => [
                        'current_tours' => [],
                        'past_tours' => [],
                    ],
                ], 200);
            }
        // }catch(\Exception $e)
        // {
        //     return response()->json([
        //         'status' => 400,
        //         'message' => 'There is some trouble to proceed your action!',
        //         'data' => $e->getMessage(),
        //     ], 200);
        // }
    }
    
    public function user_profile(Request $request)
    {
        // try{
            $user = User::find($request->user_id);
            
            if(empty($user))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'User does not Exists!',
                    'data' => null,
                ], 200);
            }
            
            
            
            return response()->json([
                'status' => 200,
                'message' => 'User data found!',
                'data' => $user,
            ], 200);
            
        // }catch(\Exception $e)
        // {
        //     return response()->json([
        //         'status' => 400, 
        //         'message' => 'There is some trouble to proceed your action!',
        //         'data' => null,
        //     ], 200);
        // }
    }
    
    public function provider_profile(Request $request)
    {
        // try{
            $provider = User::find($request->provider_id);
            
            if(empty($provider))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Provider does not Exists!',
                    'data' => null,
                ], 200);
            }
            
            $provider->tours = Tour::where('agency_id', $request->provider_id)->orderBy('created_at', 'desc')->get();
            
            if(!empty($provider->tours))
            {
                foreach($provider->tours as $tour)
                {
                    $tour->company_name = $provider->company_name;
                    $tour->profile_image = $provider->profile_image;
                    $tour->average_rating = '5.0';
                    $tour->pickup_points = TourPickupPoint::where('tour_id', $tour->id)->get();
                }
            }
            
            return response()->json([
                'status' => 200,
                'message' => 'Provider data found!',
                'data' => $provider,
            ], 200);
            
        // }catch(\Exception $e)
        // {
        //     return response()->json([
        //         'status' => 400, 
        //         'message' => 'There is some trouble to proceed your action!',
        //         'data' => null,
        //     ], 200);
        // }
    }

    public function cancel_booking(Request $request)
    {
        try{
            $booking = TourBooking::where('id', $request->booking_id)->first();

            if(empty($booking))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Booking does not Exists!',
                    'data' => null,
                ], 200);
            }

            $booking->status = 'cancelled';
            $booking->save();

            return response()->json([
                'status' => 200,
                'message' => 'Booking Cancelled!',
                'data' => $booking,
            ], 200);
        }catch(\Exception $e)
        {
            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to proceed your action!',
                'data' => null,
            ], 200);
        }
    }

    public function upload_in_gallary(Request $request)
    {
        try{
            $tour = Tour::find($request->tour_id);

            if(empty($tour))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Tour does not Exists!',
                    'data' => null,
                ], 200);
            }

            $user = User::find($request->user_id);

            if(empty($user))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'User does not exists!',
                    'data' => null,
                ], 200);
            }

            $gallary = new Gallary;
            $gallary->tour_id = $request->tour_id;
            $gallary->user_id = $request->user_id;

            if($request->has('image'))
            {
                $image = $request->image;
                
                if($image->getClientOriginalExtension() == 'PNG' ||$image->getClientOriginalExtension() == 'png' || $image->getClientOriginalExtension() == 'JPG' || $image->getClientOriginalExtension() == 'jpg' || $image->getClientOriginalExtension() == 'jpeg' || $image->getClientOriginalExtension() == 'JPEG')
                {
                    $new_name = rand().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('/gallary_images'), $new_name);
                    $img_path = 'gallary_images/'.$new_name;  
                }else{  
                    return response()->json([
                        'status' => 400,
                        'message' => 'Please Choose a Valid Image!',
                        'data' => null,
                    ], 200);
                }

                $gallary->image = $img_path;           
            }

            if($request->has('video'))
            {
                $image = $request->video;
                
                if($image->getClientOriginalExtension() == 'mp4' ||$image->getClientOriginalExtension() == 'MP4' || $image->getClientOriginalExtension() == 'wav' || $image->getClientOriginalExtension() == 'Wav' || $image->getClientOriginalExtension() == 'FLV' || $image->getClientOriginalExtension() == 'flv')
                {
                    $new_name = rand().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('/gallary_videos'), $new_name);
                    $img_path = 'gallary_videos/'.$new_name;  
                }else{  
                    return response()->json([
                        'status' => 400,
                        'message' => 'Please Choose a Valid Video!',
                        'data' => null,
                    ], 200);
                }

                $gallary->video = $img_path;           
            }

            $gallary->save();

            return response()->json([
                'status' => 200,
                'message' => 'Saved in Gallary',
                'data' => null,
            ], 200);
        }catch(\Exception $e)
        {
            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to proceed your action!',
                'data' => null,
            ], 200);
        }
    }
    
    public function delete_tour($id)
    {
        try{
            $tour = Tour::where('id', $id)->first();
            if(empty($tour))
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Tour does not Exists',
                ], 200);
            }
            
            // $pickup_points = TourPickupPoint::where('tour_id', $tour->id)->get();
            // $images = Gallary::where('tour_id', $tour->id)->get();
            
            $tour->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Tour deleted',
            ], 200);
        }catch(\Exception $e)
        {
            return response()->json([
                'status' => false,
                'message' => 'There is some trouble to proceed your action',
            ], 200);
        }
    }
    
    public function submit_review(Request $request)
    {
        $user = User::find($request->user_id);
        if(empty($user))
        {
            return response()->json([
                'status' => 400,
                'message' => 'User does not Exists!',
                'data' => null,
            ], 200);
        }
        
        $agency = User::find($request->agency_id);
        if(empty($agency))
        {
            return response()->json([
                'status' => 400,
                'message' => 'Tour Agency does not Exists!',
                'data' => null,
            ], 200);
        }
        
        $review = new UserReviews;
        $review->user_id = $request->user_id;
        $review->agency_id = $request->agency_id;
        $review->rating_stars = $request->rating_stars;
        $review->review = $request->review;
        $review->save();
        
        return response()->json([
                'status' => 200,
                'message' => 'Review Submitted!',
                'data' => $review,
            ], 200);  
        
         return back()->with('error', 'There is some trouble to proceed your action!');

    }
    
    
    public function update_pickup_point(Request $request)
    {
        
            $point = TourPickupPoint::find($request->id);
            $point->tour_id = $request->tour_id;
            $point->pickup_city = $request->pickup_city;
            $point->per_seat_fare = $request->per_seat_fare;
            $point->couple_package_fare = $request->couple_package_fare;
            $point->family_package_fare = $request->family_package_fare;
            $point->honeymoon_package_fare = $request->honeymoon_package_fare;
            $point->per_seat_fare_currency = $request->currency_unit;
            $point->couple_package_fare_currency = $request->currency_unit;
            $point->family_package_fare_currency = $request->currency_unit;
            $point->kids_under_3_years = $request->kids_under_3;
            $point->kids_between_3_to_8 = $request->kids_between_3_to_8;
            $point->kids_above_8_years = $request->kids_above_8;
            $point->pickup_point = $request->pickup_point;
            $point->pickup_date = $request->pickup_date;
            $point->pickup_time = $request->pickup_time;               
            $point->save();
        return back()->with('success', 'Departure City Update Successfully!');
    }
    
    
    public function my_bookings($user_id)
    {
        $user = User::where('id', $user_id)->first('id');
        if(empty($user))
        {
            return response()->json([
                'status' => 400,
                'message' => 'User does not Exists!',
                'data' => null,
            ], 200);
        }
        
        $tours=Tour::where('agency_id', $user_id)->orderBy('id', 'desc')->get();
        foreach($tours as $tour)
        {
            $tour->total_bookings = TourBooking::where('tour_id', $tour->id)->count();
        }
        
        return response()->json([
            'status' => 200,
            'message' => 'Bookings Found!',
            'data' => $tours,
        ], 200);
        
    }
    
    public function tour_bookings($id)
    {
        
        $bookings=TourBooking::where('tour_id', $id)->orderBy('id', 'desc')->get();
        
        foreach($bookings as $booking)
        {
            $booking->tour_detail = Tour::where('id', $booking->tour_id)->first();
            $user_details = User::where('id', $booking->user_id)->first();
            $booking->user_name = $user_details->name;
            $booking->user_phone = $user_details->phone;
            $booking->user_image = $user_details->profile_image;
            $booking->user_details = $user_details;
            
            $booking->pickup_point = TourPickupPoint::find($booking->pickup_point_id);
        }
        
        return response()->json([
            'status' => 200,
            'message' => $bookings->count() > 0 ? 'Tour Bookings Found' : 'No Tour Bookings Found',
            'data' => $bookings->count() > 0 ? $bookings : [],
        ], 200);

    }
    
    
    public function delete_booking($id)
    {
        //
        try{
            $booking =TourBooking::find($id);

            if(empty($booking))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Tour Booking does not Exists!',
                    'data' => null,
                ], 200);
            }

            $booking->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Tour Booking Deleted Successfully!',
                'data' => null,
            ], 200);

        }catch(\Exception $e)
        {
            return back()->with('error', 'There is some trouble to proceed your action!');
        }
    }
    
    
    public function update_booking_status($booking_id , $booking_status)
    {
        // dd($booking_id,$booking_status);

        try{
            $booking = TourBooking::where('id', $booking_id)->first();

            if(!empty($booking))
            {
                $booking->status = $booking_status;
                $booking->save();

            }else{
                return back()->with('error', 'Booking does not Exists!');
            }


            return back()->with('success', 'Booking Status Updated Successfully!');
        }catch(\Exception $e)
        {
            return back()->with('error', 'There is Some Trouble , Sorry !');
        }
    }
    
    public function delete_pickup_point($id)
    {
        //
        try{
            $tours =TourPickupPoint::find($id);

            if(empty($tours))
            {
                return back()->with('error', 'Departure City does not Exists!');
            }            

            $tours->delete();

            return back()->with('success', 'Departure City Deleted Successfully');

        }catch(\Exception $e)
        {
            return back()->with('error', 'There is some trouble to proceed your action!');
        }
    }
}   

    