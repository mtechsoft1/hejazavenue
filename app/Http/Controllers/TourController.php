<?php

namespace App\Http\Controllers;

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
use App\ContactUs;
use App\UserReviews;
use Auth;

class TourController extends Controller
{

    
    
    public function tourBookingsDetails($id)
    {
        $tour = Tour::find($id);

        if(empty($tour))
            {
                return back()->with('error', 'Tour does not Exists!');
            }

        $user_id=Auth::user()->id;
        $user = User::find($user_id);

        if(empty($user))
            {
                return back()->with('error', 'User does not Exists!');
            }
  dd($user);
        // Fetch the booking details based on tour_id and user_id
        $booking = TourBooking::where('tour_id', $id)->first();
        $tourPickupPoint = TourPickupPoint::where('tour_id', $id)->get();
        // dd($tourPickupPoint);
        // if (empty($booking)) {
        //     return back()->with('error', 'Booking does not exist!'); //
        // }
        
        return view('book_now_details', compact('id' ,'booking', 'user', 'tour', 'tourPickupPoint'));
    }
    
    // Book Now Almost to Complete by 10%
    public function makePayment($id)
    {
        $tour = Tour::find($id);

        if(empty($tour))
        {
            return back()->with('error', 'Tour does not Exists!');
        }

        $user_id=Auth::user()->id;
        $user = User::find($user_id);

        if(empty($user))
        {
            return back()->with('error', 'User does not Exists!');
        }

        // Fetch the booking details based on tour_id and user_id
        $booking = TourBooking::where('tour_id', $id)->first();


        // if (empty($booking)) {
        //     return back()->with('error', 'Booking does not exist!');
        // }

        // Fetch the pickup point ID from the request
        $pickupPointId = 92;
        $tourPickupPoint = TourPickupPoint::where('id', $pickupPointId)->first();

        return view('book_now_make_payment_details', compact('id' ,'booking', 'user', 'tour', 'tourPickupPoint'));
    }

    
    public function bookNowPayment($id)
    {
        $tour = Tour::find($id);

        if(empty($tour))
            {
                return back()->with('error', 'Tour does not Exists!');
            }

        $user_id=Auth::user()->id;
        $user = User::find($user_id);

        if(empty($user))
            {
                return back()->with('error', 'User does not Exists!');
            }

         $booking = TourBooking::where('tour_id', $id)->first();

        // if (empty($booking)) {
        //     return back()->with('error', 'Booking does not exist!');
        // }
        
        // Fetch the pickup point ID from the request
        $pickupPointId = 92;
        $tourPickupPoint = TourPickupPoint::where('id', $pickupPointId)->first();

        return view('book_now_payment', compact('id', 'tourPickupPoint', 'booking', 'user', 'tour'));
    }

    public function processTourBooking(Request $request, $id)
    {
      
        // $validatedData = $request->validate([
        //     'tour_id' => 'required|string',
        //     'user_id' => 'required|string',
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'country' => 'required|string|max:255',
        //     'phone' => 'required|string|max:20',
        //     'pickup_point_id' => 'required|string',
        //     'package_type' => 'required|string',

        //     'adults_in_number'  => 'required|string',
        //     'kids_under_3_years'  => 'required|string',
        //     'kids_between_3_to_8'  => 'required|string',

        //     'payment_method' => 'required|string',
        //     'payment_amount' => 'required|string', 
        //     'deposit_receipt' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        //     'payment_type' => 'required|string',
        //     // 'is_paid' => 'required|string', 
        //     // 'status' => 'required|string',
        // ]);

        // Handle file upload
        
        if ($request->hasFile('deposit_receipt')) {
            $file = $request->file('deposit_receipt');
            
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            
            // Move the file to public/deposit_receipts directory
            $file->move(public_path('deposit_receipts'), $fileName);
            
            // Save the file path relative to the public directory
            $filePath = 'deposit_receipts/' . $fileName;

            
        }

        // Create a new TourBooking instance and fill it with validated data
        $tourBooking = new TourBooking();
        $tourBooking->tour_id = $request->tour_id;
        $tourBooking->user_id = $request->user_id;
        $tourBooking->name = $request->name;
        $tourBooking->email = $request->email;
        $tourBooking->country = $request->country;
        $tourBooking->phone = $request->phone;
        $tourBooking->pickup_point_id = $request->pickup_point_id;
        $tourBooking->package_type = $request->package_type;
        $tourBooking->adults_in_number = $request->above_8;
        $tourBooking->kids_under_3_years = $request->under_3year;
        $tourBooking->kids_between_3_to_8 = $request->between_3_8;
        $tourBooking->payment_method = $request->payment_method;
        $tourBooking->payment_type = $request->payment_type;
        $tourBooking->payment_amount = $request->total_price;
        if($request->payment_type == 'full')
        {
            $tourBooking->paid = $request->total_price;
            $tourBooking->payment_date = Carbon::now();
            $tourBooking->remaining = 0;
        }else if($request->payment_type == '20')
        {
            $tourBooking->paid = $request->total_price/5;
            $tourBooking->payment_date = Carbon::now();
            $tourBooking->remaining = $request->total_price - $tourBooking->paid;
            }else if($request->payment_type == 'cash')
            {
                $tourBooking->paid = 0;
                $tourBooking->payment_date = '';
                $tourBooking->remaining = $request->total_price;
            }
            $tourBooking->deposit_receipt = $filePath;
            $tourBooking->status = 'confirmed';
            
           
            try {
            $data =$tourBooking->save();
            $success = true;
            $message = 'Tour booking processed successfully.';
        } catch (\Exception $e) {
            \Log::error('Error saving tour booking: ' . $e->getMessage());
            $success = false;
            $message = 'There was an error processing your booking.';
        }
        
       
    }


}
