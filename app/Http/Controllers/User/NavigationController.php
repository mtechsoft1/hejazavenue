<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tour;
use App\Destination;
use App\TourPickupPoint;
use App\User;
use App\UserReviews;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class NavigationController extends Controller
{
    
    public function index(){
        
        $providers = User::where('type', '2')->get();            

        $destinations = Destination::where('is_public', 'true')->orderBy('created_at', 'desc')->get();
        if(!empty($destinations))
        {
            foreach($destinations as $destination)
            {
                $destination->tours = Tour::where('destination_id', $destination->id)->get();
                $destination->total_tours = $destination->tours->count();
            }
        }
        
        $featureds = Tour::where('is_featured', 1)->orderBy('created_at', 'desc')->take(8)->get();

        if(!empty($featureds))
        {
            foreach($featureds as $t)
            {
                $agency = User::where('id', $t->agency_id)->first(['name', 'company_name','profile_image']);
                
                $t->agency_name = $agency->company_name;
                $t->profile_image = $agency->profile_image;
                $t->pickup_points = TourPickupPoint::where('tour_id', $t->id)->first();
                
                $ratings = UserReviews::where('agency_id', $t->agency_id)->get();
            
                if($ratings->count() > 0)
                {
                    $ratingValues = [];
                    foreach($ratings as $rating)
                    {
                        $ratingValues[] = $rating->rating_stars;
                    }
                    $ratingAverage = collect($ratingValues)->sum() / $ratings->count();
                    $t->rating = $ratingAverage;
                    $t->reviews_count = $ratings->count();
                }else{
                    $t->rating = '5.0';
                    $t->reviews_count = '0';
                }
            }
        } 
        
        $tours = Tour::orderBy('created_at', 'desc')->take(8)->get();
        
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
        
        $reviews = UserReviews::orderBy('id', 'desc')->get();
        foreach($reviews as $review)
        {
            $user = User::where('id', $review->user_id)->first(['name','profile_image']);
            $review->user_name = $user->name;
            $review->profile_image = $user->profile_image;
        }
            
        return view ('welcome',compact('tours','destinations','featureds','providers','reviews'));
    }
    
    
    public function destination_tour($id)
    {
        $tours = Tour::where('destination_id', $id)->orderBy('created_at', 'desc')->get();
        if(!empty($tours))
        {
            foreach($tours as $tour)
            {
                $agency = User::where('id', $tour->agency_id)->first(['name', 'company_name','profile_image']);
                
                $tour->agency_name = $agency->company_name;
                $tour->profile_image = $agency->profile_image;
                $tour->average_rating = '5.0';

                $tour->pickup_points = TourPickupPoint::where('tour_id', $tour->id)->first();
            }
        }
        
        return view ('tours',compact('tours'));
    }
    
    
    public function dashboard()
    {
        return view('user.user_profile');
    }
    
    
    public function change_password()
    {
        return view('user.change_password');
    }
   
   
    public function update_profile(Request $request)
    {
        try{
            $user = User::find($request->user_id);
            if(empty($user))
            {
                return back()->with('error', 'User does not exists!');
            }            
            
            if($request->has('profile_image'))
            {
                $image = $request->profile_image;
                
                if($image->getClientOriginalExtension() == 'PNG' ||$image->getClientOriginalExtension() == 'png' || $image->getClientOriginalExtension() == 'JPG' || $image->getClientOriginalExtension() == 'jpg' || $image->getClientOriginalExtension() == 'jpeg' || $image->getClientOriginalExtension() == 'JPEG')
                    {
                        $new_name = rand().'.'.$image->getClientOriginalExtension();
                        $image->move(public_path('/profile_images'), $new_name);
                        $img_path = 'profile_images/'.$new_name;  
                    
                        
                    }else{  
                        return back()->with('error', 'Please Choose a Valid Image!');
                    }         
                

                $user->profile_image = $img_path;       
            }

            if($request->has('name'))
            {
                $user->name = $request->name;
            }      

            if($request->has('email'))
            {
                $user->email = $request->email;
            }
            
            if($request->has('phone'))
            {
                $user->phone = $request->phone;
            }
        

            if($user->save())
            {
                $user2 = User::where('id', $request->user_id)->first();

                return back()->with('success', 'Info Updated Successfully!');
            }
        }catch(\Exception $e)
        {
            if($request->expectsJson())
            {
                return back()->with('error', 'There is some trouble to proceed your action!');
            }
        }
    } 
    
    
    public function update_password(Request $request)
    {
        try{
            $user = User::find($request->user_id);

            if(empty($user))
            {
                return back()->with('error', 'User does not exists!');
            }

            if($request->has('old_password'))
            {
                if(Hash::check($request->old_password, $user->password))
                {   
                    $user->password = bcrypt($request->new_password);
                    if($user->save())
                    {
                        return back()->with('success', 'Password Changed Successfully!');
                    }
                }else{
                    return back()->with('error', 'You Entered Wrong Password!');
                }
            }
        }catch(\Exception $e)
        {
            return back()->with('error', 'There is some trouble to proceed your action!');
        }
    }
    public function agency_tours($agency_id)
    {
        try{
            $agencyName = Tour::where('agency_id', $agency_id)->take(1)->get();
            $tours = Tour::where('agency_id', $agency_id)->orderBy('created_at', 'desc')->get();
            if(empty($tours))
            {
                return back()->with('error','Agency Tour Not Found Sorry !');
            }
          
            foreach($tours as $tour)
            {
                $agency = User::where('id', $tour->agency_id)->first(['name', 'company_name','profile_image']);
               ;
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
            return view('agency_tour_details',compact('tours','agencyName'));
            
        }catch(\Execption $e)
        {
            return back()->with('error', 'There is Some Trouble , Sorry !');
        }
    }
  
}
