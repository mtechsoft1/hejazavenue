<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TourPickupPoint;
use App\Tour;
use App\User;
use App\TourBooking;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = TourBooking::orderBy('created_at', 'desc')->paginate(10);
        foreach($bookings as $booking)
        {
            $booking->tour_detail = Tour::where('id', $booking->tour_id)->first();
            
            $booking->user_details = User::where('id', $booking->user_id)->first();
            
            $booking->agency_details = User::where('id', $booking->tour_detail->agency_id)->first();
            
            $booking->pickup_point = TourPickupPoint::find($booking->pickup_point_id);
        }
        // dd($bookings);
        
        return view('admin.booking.index',compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return view('admin.tours.create');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //     $data=array();
    //     $data['trip_name'] = $request->trip_name;
    //     $data['trip_start_date'] = $request->trip_start_date;
    //     $data['trip_end_date'] = $request->kids_under_3_years;
    //     $data['kids_under_3_years'] = $request->trip_name;
    //     $data['kids_between_3_to_8_years'] = $request->kids_between_3_to_8_years;
    //     $data['kids_above_8_years'] = $request->kids_above_8_years;
    //     $data['attractions'] = $request->attractions;
    //     $data['trip_duration'] = $request->trip_duration;
    //     $data['trip_total_days'] = $request->trip_total_days;

    //     $image = $request->file('trip_image');
    //    if ($image){
    //        $image_name = date('dmy_H_s_i');
    //        $ext = strtolower($image->getClientOriginalExtenson());
    //        $image_fullname = $image_name. '.' .$ext;
    //        $upload_path= 'public/tour_images/';
    //        $image_url = $upload_path. $image_fullname;
    //        $success = $image->move($upload_path,$image_fullname);
    //        $data['trip_image'] =$image_url;
    //        $tour = DB::table('tours')->insert($data);
    //        return redirect()->route('tours.index')
    //                    ->with('Success', 'Tour Insert Successfuly');
    //    }
   
       
       
      
        // $tours = Tour::create($request->all());
       
        // Alert::alert('Saved', 'Your Record is saved!', 'success');
        // return redirect('tours');
       }
      

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $pickup_points =TourPickupPoint::where('tour_id',$id)->get();
        // $tours = Tour::findOrFail($id);
        $bookings = TourBooking::find($id);
        
        $bookings->tour_detail = Tour::where('id', $bookings->tour_id)->first();
        
        $bookings->user_details = User::where('id', $bookings->user_id)->first();
        
        $bookings->agency_details = User::where('id', $bookings->tour_detail->agency_id)->first();
        
        $bookings->pickup_point = TourPickupPoint::find($bookings->pickup_point_id);
        
        return view ('admin.booking.view',compact('bookings'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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
            return back()->with('error', $e->getMessage());
        }
    }

}

