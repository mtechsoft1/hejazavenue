<?php

namespace App\Http\Controllers\Agency;

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
use Auth;

class TourController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        // if(Auth::check()){
        //     if(Auth::user()->isUser()) {
        //         return redirect()->route('user.dashboard');
        //     } else if(Auth::user()->isAdmin()) {
        //         return redirect()->route('admin.dashboard');
        //     }
        // }
        
        $destinations = Destination::all();
        $tours=Tour::all();
        return view('agency.createtour', compact('destinations','tours'));

    }
    
    
    public function store(Request $request)
    {
        try{           
            // dd($request);
            // dd(json_decode(json_encode($request->pickup_city[0])));
            // die();

            $agency = User::find($request->agency_id);

            if(empty($agency))
            {
                 return back()->with('error', 'Tour Provider does not Exists!');
            }

            $destination = Destination::find($request->destination_id);

            if(empty($destination))
            {
                 return back()->with('error', 'Destination does not Exists!');
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
                        return back()->with('error', 'Please Choose a Valid Image!');
                    }         
                

                $tour->trip_image = $img_path;        
            }

            $tour->trip_name = $request->trip_name;
            $tour->trip_description = $request->trip_description;
            $tour->day = $request->day;
            $tour->trip_start_date = $request->trip_start_date;
            $tour->trip_end_date = $request->trip_end_date;
            $tour->trip_total_days = $request->trip_total_days;
            $tour->attractions = $request->attractions;
            $tour->trip_duration = $request->trip_duration;
            $tour->kids_under_3_years = $request->kids_under_3_years;
            $tour->kids_between_3_to_8_years = $request->kids_between_3_to_8_years;
            $tour->kids_above_8_years = $request->kids_above_8_years;
            $tour->is_featured = $request->is_featured;
            $tour->status = 'active';
            // $tour->save();
            
            if($tour->save())
            {
                for($i = 0; $i < count($request->pickup_city); $i++)
                {
                    $point = new TourPickupPoint;
                    $point->tour_id = $tour->id;
                    $point->pickup_city = $request->pickup_city[$i];
                    $point->per_seat_fare = $request->per_seat_fare[$i];
                    $point->per_seat_fare_currency = $request->currency_unit[$i];
                    $point->couple_package_fare = $request->couple_package_fare[$i];
                    $point->couple_package_fare_currency = $request->currency_unit[$i];
                    $point->family_package_fare = $request->family_package_fare[$i];
                    $point->honeymoon_package_fare = $request->honeymoon_package_fare[$i];
                    $point->family_package_fare_currency = $request->currency_unit[$i];
                    $point->kids_under_3_years = $request->kids_under_3[$i];
                    $point->kids_between_3_to_8 = $request->kids_between_3_to_8[$i];
                    $point->kids_above_8_years = $request->kids_above_8[$i];
                    $point->pickup_point = $request->pickup_point[$i];
                    $point->pickup_date = $request->pickup_date[$i];
                    $point->pickup_time = $request->pickup_time[$i];               
                    $point->save();
                }
               
                if($request->hasFile('gallery_images'))
                {                
                    $images = $request->file('gallery_images');
                    foreach($images as $image)
                    {   
                        if($image->getClientOriginalExtension() == 'PNG' ||$image->getClientOriginalExtension() == 'png' || $image->getClientOriginalExtension() == 'JPG' || $image->getClientOriginalExtension() == 'jpg' || $image->getClientOriginalExtension() == 'jpeg' || $image->getClientOriginalExtension() == 'JPEG')
                        {
                            $new_name = rand().'.'.$image->getClientOriginalExtension();
                            $image->move(public_path('/gallary_images'), $new_name);
                            $gallary_image = new Gallary;
                            $gallary_image->tour_id = $tour->id;
                            $gallary_image->image = 'gallary_images/'.$new_name; 
                            $gallary_image->save(); 
                        }else{
                            return back()->with('error', 'Please Choose a Valid Image!');
                        } 
                    }                  
                } 
            }  
            
            return back()->with('success', 'Tour Add Successfully!');

        }catch(\Exception $e)
        {
            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to prceed your action!',
                'data' => [],
            ], 200);
        }
    }

    
    public function edit_tour($id)
    {
        try{
            
            $tour =Tour::find($id);

            if(empty($tour))
            {
                return back()->with('error', 'Tour does not Exists!');
            }
            
            $destinations = Destination::all();
            $pickup_points = TourPickupPoint::where('tour_id', $tour->id)->get();
            $gallery_images = Gallary::where('tour_id', $tour->id)->get();
            
            
            
            return view('agency.edit_tour', compact('destinations','tour','pickup_points','gallery_images'));
            
        }catch(\Exception $e)
        {
            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to prceed your action!',
                'data' => [],
            ], 200);
        }
    }
    
    
    public function update_tour(Request $request)
    {
        try{            

            $tour = Tour::find($request->tour_id);

            if(empty($tour))
            {
                return back()->with('error', 'Tour does not Exists!');
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
                        return back()->with('error', 'Please Choose a Valid Image!');
                    }         
                

                $tour->trip_image = $img_path;        
            }
            
            $tour->trip_name = $request->trip_name;
            $tour->destination_id = $request->destination_id;
            $tour->day = $request->day;
            $tour->trip_description = $request->trip_description;
            $tour->trip_start_date = $request->trip_start_date;
            $tour->trip_end_date = $request->trip_end_date;
            $tour->trip_total_days = $request->trip_total_days;
            $tour->attractions = $request->attractions;
            $tour->trip_duration = $request->trip_duration;
            $tour->save();
            
            // if($tour->save())
            // {
            //     for($i = 0; $i < count($request->pickup_city); $i++)
            //     {
            //         $point = new TourPickupPoint;
            //         $point->tour_id = $tour->id;
            //         $point->pickup_city = $request->pickup_city[$i];
            //         $point->per_seat_fare = $request->per_seat_fare[$i];
            //         $point->couple_package_fare = $request->couple_package_fare[$i];
            //         $point->family_package_fare = $request->family_package_fare[$i];
            //         $point->kids_under_3_years = $request->kids_under_3[$i];
            //         $point->kids_between_3_to_8 = $request->kids_between_3_to_8[$i];
            //         $point->kids_above_8_years = $request->kids_above_8[$i];
            //         $point->pickup_point = $request->pickup_point[$i];
            //         $point->pickup_date = $request->pickup_date[$i];
            //         $point->pickup_time = $request->pickup_time[$i];               
            //         $point->save();
            //     }
               
            //     if($request->has('gallery_images') && $request->gallery_images != "")
            //     {                
            //         $images = $request->file('gallery_images');

            //         foreach($images as $image)
            //         {   
            //             if($image->getClientOriginalExtension() == 'PNG' ||$image->getClientOriginalExtension() == 'png' || $image->getClientOriginalExtension() == 'JPG' || $image->getClientOriginalExtension() == 'jpg' || $image->getClientOriginalExtension() == 'jpeg' || $image->getClientOriginalExtension() == 'JPEG')
            //             {
            //                 $new_name = rand().'.'.$image->getClientOriginalExtension();
            //                 $image->move(public_path('/gallary_images'), $new_name);
            //                 $gallary_image = new Gallary;
            //                 $gallary_image->tour_id = $tour->id;
            //                 $gallary_image->image = 'gallary_images/'.$new_name; 
            //                 $gallary_image->save(); 
            //             }else{
            //                 return back()->with('error', 'Please Choose a Valid Image!');
            //             } 
            //         }                  
            //     } 
            // }
            
            return back()->with('success', 'Tour Updated Successfully!');

        }catch(\Exception $e)
        {
            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to prceed your action!',
                'data' => [],
            ], 200);
        }
    }
    
    
    public function mytour()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first('id');
        $tours=Tour::where('agency_id', $user_id)->orderBy('id', 'desc')->get();
        foreach($tours as $tour)
        {
            $tour->pickup_points = TourPickupPoint::where('tour_id', $tour->id)->first();
        }
        // dd($tours);
        // die();
        
        return view('agency.mytour', compact('tours'));
    }

    
    public function pickup_point(Request $request)
    {
        
        $point = new TourPickupPoint;
            $point->tour_id = $request->tour_id;
            $point->pickup_city = $request->pickup_city;
            $point->per_seat_fare = $request->per_seat_fare;
            // $point->per_seat_fare_currency = $request->per_seat_fare_currency;
            $point->couple_package_fare = $request->couple_package_fare;
            // $point->couple_package_fare_currency = $request->couple_package_fare_currency;
            $point->family_package_fare = $request->family_package_fare;
            $point->honeymoon_package_fare = $request->honeymoon_package_fare;
            // $point->family_package_fare_currency = $request->family_package_fare_currency;
            $point->kids_under_3_years = $request->kids_under_3_years;
            $point->kids_between_3_to_8 = $request->kids_between_3_to_8;
            $point->kids_above_8_years = $request->kids_above_8_years;
            $point->pickup_point = $request->pickup_point;
            // $point->pickup_point_latitude = $request->pickup_point_latitude;
            // $point->pickup_point_longitude = $request->pickup_point_longitude;
            $point->pickup_date = $request->pickup_date;
            $point->pickup_time = $request->pickup_time;               
            $point->save();
        return back()->with('success', 'Departure Add Successfully!');
    }
    
    
    public function edit_pickup_point($id)
    {
        try{
            
            $pickup_point =TourPickupPoint::find($id);

            if(empty($pickup_point))
            {
                return back()->with('error', 'Departure City does not Exists!');
            }
            
            return view('agency.edit_pickup_point', compact('pickup_point'));
            
        }catch(\Exception $e)
        {
            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to prceed your action!',
                'data' => [],
            ], 200);
        }
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
    
    
    public function my_bookings()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first('id');
        $tours=Tour::where('agency_id', $user_id)->orderBy('id', 'desc')->get();
        foreach($tours as $tour)
        {
            $tour->total_bookings = TourBooking::where('tour_id', $tour->id)->count();
        }
        
        return view('agency.my_bookings', compact('tours'));
    }
 
    public function tour_bookings($id)
    {
        
        $user_id=Auth::user()->id;
        
        $bookings=TourBooking::where('tour_id', $id)->orderBy('id', 'desc')->paginate(10);;
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
        
        return view('agency.tour_bookings', compact('bookings'));

    }
    
    public function delete_tour($id)
    {
        //
        try{
            $tours =Tour::find($id);

            if(empty($tours))
            {
                return back()->with('error', 'Tour does not Exists!');
            }            

            $tours->delete();

            return back()->with('success', 'Tour Deleted Successfully');

        }catch(\Exception $e)
        {
            return back()->with('error', 'There is some trouble to proceed your action!');
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
    
    
    public function delete_booking($id)
    {
        //
        try{
            $tours =TourBooking::find($id);

            if(empty($tours))
            {
                return back()->with('error', 'Tour Booking does not Exists!');
            }            

            $tours->delete();

            return back()->with('success', 'Tour Booking Deleted Successfully');

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
    
    
    
}
