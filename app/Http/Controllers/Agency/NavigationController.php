<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TourPickupPoint;
use App\Tour;
USE App\Destination;
use DB;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class NavigationController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        return view('agency.agency_profile', compact('users'));
    }
    
    public function change_password()
    {
        return view('agency.change_password');
    }
   
   
    public function update_profile(Request $request)
    {
        try {
            // Validate incoming request
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'profile_image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
                'banner_image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:20',
                'license_number' => 'nullable|string|max:255',
                'account_title' => 'nullable|string|max:255',
                'account_number' => 'nullable|string|max:255',
                'bank_name' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
                'zip' => 'nullable|string|max:20',
                'company_name' => 'nullable|string|max:255',
                'company_description' => 'nullable|string|max:1000'
            ]);

            // Find the user
            $user = User::find($request->user_id);
            if (!$user) {
                return back()->with('error', 'User does not exist!');
            }

            // Update profile image if exists
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $extension = $image->getClientOriginalExtension();
                $allowedExtensions = ['png', 'jpg', 'jpeg'];
                if (in_array(strtolower($extension), $allowedExtensions)) {
                    $new_name = rand() . '.' . $extension;
                    $image->move(public_path('/profile_images'), $new_name);
                    $user->profile_image = 'profile_images/' . $new_name;
                } else {
                    return back()->with('error', 'Please choose a valid profile image!');
                }
            }

            // Update banner image if exists
            if ($request->hasFile('banner_image')) {
                $image = $request->file('banner_image');
                $extension = $image->getClientOriginalExtension();
                $allowedExtensions = ['png', 'jpg', 'jpeg'];
                if (in_array(strtolower($extension), $allowedExtensions)) {
                    $new_name = md5(mt_rand()) . '.' . $extension;
                    $image->move(public_path('/banner_images'), $new_name);
                    $user->banner_image = 'banner_images/' . $new_name;
                } else {
                    return back()->with('error', 'Please choose a valid banner image!');
                }
            }

            // Update other fields
            $user->name = $request->input('name', $user->name);
            $user->email = $request->input('email', $user->email);
            $user->phone = $request->input('phone', $user->phone);
            $user->license_number = $request->input('license_number', $user->license_number);
            $user->account_title = $request->input('account_title', $user->account_title);
            $user->account_number = $request->input('account_number', $user->account_number);
            $user->bank_name = $request->input('bank_name', $user->bank_name);
            $user->address = $request->input('address', $user->address);
            $user->city = $request->input('city', $user->city);
            $user->state = $request->input('state', $user->state);
            $user->country = $request->input('country', $user->country);
            $user->zip = $request->input('zip', $user->zip);
            $user->company_name = $request->input('company_name', $user->company_name);
            $user->company_description = $request->input('company_description', $user->company_description);

            // Save the user
            $user->save();

            return back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Profile update failed: ' . $e->getMessage());

            return back()->with('error', 'There was an issue updating your profile. Please try again.');
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
                    // if($request->expectsJson())
                    // {
                        return back()->with('error', 'You Entered Wrong Password!');
                    // }
                }
            }
        }catch(\Exception $e)
        {
            return back()->with('error', 'There is some trouble to proceed your action!');
        }
    } 
}
