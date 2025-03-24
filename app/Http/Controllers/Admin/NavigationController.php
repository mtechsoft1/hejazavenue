<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Destination;
use App\Tour;
use App\TourBooking;
use App\ContactUs;
use App\UserReviews;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;

class NavigationController extends Controller
{
    public function dashboard()
    {
       
      $count = DB::table('destinations')->count();
      $countuser =  User::where('type', '1')->count();
      $countprovider =  User::where('type', '2')->count();
      $counttour = DB::table('tours')->count();
      $countbookings = TourBooking::all()->count();
      $countreviews = UserReviews::all()->count();
      $countmessages = ContactUs::all()->count();
        
        return view('admin.dashboard', compact('count','countuser', 'countprovider', 'counttour','countbookings','countreviews','countmessages'));
    }
    
    public function contactus_message()
    {
        $messages = ContactUs::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.contact_message', compact('messages'));
    }
    
    public function delete_message($id)
    {
        try{
            $message =ContactUs::find($id);

            if(empty($message))
            {
                return back()->with('error', 'User Message does not Exists!');
            }            

            $message->delete();

            return back()->with('success', 'Message Deleted Successfully');

        }catch(\Exception $e)
        {
            return back()->with('error', 'There is some trouble to proceed your action!');
        }
    }
    
    public function user_reviews()
    {
        $reviews = UserReviews::orderBy('created_at', 'desc')->paginate(10);
        foreach($reviews as $review)
        {
            
            $review->user_details = User::where('id', $review->user_id)->first();
            
            $review->agency_details = User::where('id', $review->agency_id)->first();
        }
        
        return view('admin.user_reviews', compact('reviews'));
    }
    
    public function delete_review($id)
    {
        try{
            $review =UserReviews::find($id);

            if(empty($review))
            {
                return back()->with('error', 'User Review does not Exists!');
            }            

            $review->delete();

            return back()->with('success', 'User Review Deleted Successfully');

        }catch(\Exception $e)
        {
            return back()->with('error', 'There is some trouble to proceed your action!');
        }
    }
    
    public function delete_contact_us_message($id)
    {
        try{
            $contact_us =ContactUs::find($id);

            if(empty($contact_us))
            {
                return back()->with('error', 'Record does not Exists!');
            }            

            $contact_us->delete();

            return back()->with('success', 'Selected Record Deleted Successfully');

        }catch(\Exception $e)
        {
            return back()->with('error', 'There is some trouble to proceed your action!');
        }
    }
    
    
}
