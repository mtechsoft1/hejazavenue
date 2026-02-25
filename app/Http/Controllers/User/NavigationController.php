<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Destination;
use App\User;
use App\UserReviews;
use App\Accommodation;
use Illuminate\Support\Facades\Hash;

class NavigationController extends Controller
{
    public function index()
    {
        $providers = User::where('type', '2')->get();

        $destinations = Destination::where('is_public', 'true')->orderBy('created_at', 'desc')->get();

        $reviews = UserReviews::orderBy('id', 'desc')->get();
        foreach ($reviews as $review) {
            $user = User::where('id', $review->user_id)->first(['name', 'profile_image']);
            $review->user_name = $user->name ?? '';
            $review->profile_image = $user->profile_image ?? null;
        }

        $accommodations = Accommodation::active()->ordered()->with('images')->get();

        return view('welcome', compact('destinations', 'providers', 'reviews', 'accommodations'));
    }

    public function searchTours(Request $request)
    {
        return redirect()->route('index');
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
        try {
            $user = User::find($request->user_id);
            if (empty($user)) {
                return back()->with('error', 'User does not exists!');
            }

            if ($request->has('profile_image')) {
                $image = $request->profile_image;

                if (in_array(strtoupper($image->getClientOriginalExtension()), ['PNG', 'JPG', 'JPEG'])) {
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/profile_images'), $new_name);
                    $img_path = 'profile_images/' . $new_name;
                } else {
                    return back()->with('error', 'Please Choose a Valid Image!');
                }

                $user->profile_image = $img_path;
            }

            if ($request->has('name')) {
                $user->name = $request->name;
            }

            if ($request->has('email')) {
                $user->email = $request->email;
            }

            if ($request->has('phone')) {
                $user->phone = $request->phone;
            }

            if ($user->save()) {
                return back()->with('success', 'Info Updated Successfully!');
            }
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return back()->with('error', 'There is some trouble to proceed your action!');
            }
        }
    }

    public function update_password(Request $request)
    {
        try {
            $user = User::find($request->user_id);

            if (empty($user)) {
                return back()->with('error', 'User does not exists!');
            }

            if ($request->has('old_password')) {
                if (Hash::check($request->old_password, $user->password)) {
                    $user->password = bcrypt($request->new_password);
                    if ($user->save()) {
                        return back()->with('success', 'Password Changed Successfully!');
                    }
                } else {
                    return back()->with('error', 'You Entered Wrong Password!');
                }
            }
        } catch (\Exception $e) {
            return back()->with('error', 'There is some trouble to proceed your action!');
        }
    }
}
