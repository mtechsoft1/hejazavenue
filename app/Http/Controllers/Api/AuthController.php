<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Mail\AccountVerificationEMail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\ForgotPassword;
use App\Mail\SignupMail;
use App\Mail\BookTripMail;
use Illuminate\Support\Facades\Hash;
use App\TourBooking;
use App\Notification;
use App\Destination;

class AuthController extends Controller
{
    // Registartion Method
    public function register(Request $request)
    {
        try{           
            if(!$request->has('name')){
                return response()->json([
                    'status' => 400,
                    'message' => 'Name is Required!',
                    'data' => null,
                ], 200);
            }           
            if(!$request->has('phone'))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Phone is Required!',
                    'data' => null,
                ], 200);
            } 
            $user = User::where('phone', $request->phone)->first();
            if(!empty($user)){
                return response()->json([
                    'status' => 400,
                    'message' => 'Phone has Already Been Taken!',
                    'data' => null,
                ], 200);
            }
            if(!$request->has('email'))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Email is Required!',
                    'data' => null,
                ], 200);
            }
            if(!$request->has('password'))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Password is Required!',
                    'data' => null,
                ], 200);
            }
            $user = new User;  
            $user->name = $request->name;        
            $user->email = $request->email; 
            $user->phone = $request->phone; 
            $user->password = bcrypt($request->password);  
            $user->type = $request->user_type;  
            if($request->has('company_name')){
                $user->company_name = $request->company_name;
            }
                 
            if($user->save()){    
                // $content = $request->name;
                $user1 = User::where('phone', $request->phone)->first();
                // \Mail::to($request->email)->send(new SignupMail($content));
                
                return response()->json([
                    'status' => 200,
                    'message' => 'Welcome to Compass Trip!',
                    'data' => $user1->makeHidden(['created_at', 'updated_at', 'email_verified_at', 'token', 'type']),
                ], 200);
                
            }
        } catch(\Exception $e){

            return response()->json([
                'status' => 400,
                'message' => 'There is some trouble to proceed your action!',
                'data' => $e->getMessage(),
            ], 200);
        }
    }
    // Login Method
    public function login(Request $request)
    {
        // try{
            
            if(!$request->has('login_by') || $request->login_by == "")
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Login By Phone or Email Required',
                    'data' => null,
                ], 200);
            }
            
            if($request->login_by == "phone")
            {
                $loginData = $request->validate([
                    'phone' => 'string|required',
                    'password' => 'required|max:255'
                ]);  
                
            }elseif($request->login_by == "email"){
                $loginData = $request->validate([
                    'email' => 'string|required',
                    'password' => 'required|max:255'
                ]);
                
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid Login By',
                    'data' => null,
                ], 200);
            }
           
            if(!auth()->attempt($loginData))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid Credentials',
                    'data' => null,
                ], 200);
            } 
                    
            if($request->has('token'))
            {
                $user = User::where('phone', $request->phone)->first();
                $user->token = $request->token;
                $user->save();
            }   
            
            // if($request->user_type != auth()->user()->type)
            // {
            //     return response()->json([
            //         'status' => 400,
            //         'message' => 'Invalid Login Type',
            //         'data' => null,
            //     ], 200);
            // }     
            
                      
            return response()->json([
                'status' => 200,
                'message' => 'Welcome to Compass Trip!',
                'data' => auth()->user()->makeHidden(['created_at', 'updated_at', 'email_verified_at', 'verification_code', 'type']),
            ], 200);
                  
            
        // }catch(\Exception $e)
        // {
        //     return response()->json([
        //         'status' => 400,
        //         'message' => $e->getMessage(),
        //         'data' => null,
        //     ], 200);
        // }        
    }
    
    public function update_profile_image(Request $request)
    {
        // try{
            $user = User::find($request->user_id);
            if(empty($user))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'User Does Not Exists!',
                    'data' => null,
                ], 200);
            }else{
                if($request->has('image'))
                {
                    $image = $request->image;
                
                    if($image->getClientOriginalExtension() == 'PNG' ||$image->getClientOriginalExtension() == 'png' || $image->getClientOriginalExtension() == 'JPG' || $image->getClientOriginalExtension() == 'jpg' || $image->getClientOriginalExtension() == 'jpeg' || $image->getClientOriginalExtension() == 'JPEG')
                    {
                        $new_name = rand().'.'.$image->getClientOriginalExtension();
                        $image->move(public_path('/profile_images'), $new_name);
                        $img_path = 'profile_images/'.$new_name;  
                    }else{  
                        return response()->json([
                            'status' => 400,
                            'message' => 'Please Choose a Valid Image!',
                            'data' => null,
                        ], 200);
                    }         
                

                    $user->profile_image = $img_path;
                
                    if($user->save())
                    {
                        $user = User::find($request->user_id);
                        
                        if($request->expectsJson())
                        {
                            return response()->json([
                                'status' => 200,
                                'message' => 'Profile Image Updated Successfully!',
                                'data' => $user->makeHidden(['created_at', 'updated_at', 'email_verified_at', 'verification_code', 'self_description', 'type']),
                            ], 200);
                        }
                    }
                }else{
                    return response()->json([
                        'status' => 400,
                        'message' => 'Choose an Image to Update!',
                        'data' => null,
                    ], 200);
                }                
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

    public function update_profile(Request $request)
    {
        try{
            $user = User::find($request->user_id);
            if(empty($user))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'User does not exists!',
                    'data' => null,
                ], 200);
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
                        return response()->json([
                            'status' => 400,
                            'message' => 'Please Choose a Valid Image!',
                            'data' => null,
                        ], 200);
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
        
            if($request->has('license_number'))
            {
                $user->license_number = $request->license_number;
            }
            
            if($request->has('bank_name'))
            {
                $user->bank_name = $request->bank_name;
            }
            
            if($request->has('account_number'))
            {
                $user->account_number = $request->account_number;
            }
            
            if($request->has('account_title'))
            {
                $user->account_title = $request->account_title;
            }

            if($request->has('address'))
            {
                $user->address = $request->address;
            }
            
            if($request->has('city'))
            {
                $user->city = $request->city;
            }
            
            if($request->has('state'))
            {
                $user->state = $request->state;
            }
            
            if($request->has('country'))
            {
                $user->country = $request->country;
            }
            
            if($request->has('zip'))
            {
                $user->zip = $request->zip;
            }

            if($request->has('company_name'))
            {
                $user->company_name = $request->company_name;
            }

            if($request->has('company_description'))
            {
                $user->company_description = $request->company_description;
            }

            if($request->has('user_type') && $request->user_type == '2')
            {
                $user->type = $request->user_type;
                $user->user_role = 'provider';
                // $user->is_approved_by_admin = 'false';
            }

            if($user->save())
            {
                $user2 = User::where('id', $request->user_id)->first();

                return response()->json([
                    'status' => 200,
                    'message' => 'Info Updated Successfully!',
                    'data' => $user2, 
                ], 200);                
            }
        }catch(\Exception $e)
        {
            if($request->expectsJson())
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'There is some trouble to proceed your action!',
                    'data' => null,
                ], 200);
            }
        }
    } 
  
    public function forgot_password(Request $request)
    {
        try{
            $user = User::where('email', $request->email)->first();
            if(empty($user))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'User does not exists!',
                    'data' => null,
                ], 200);
            }

            $code = rand(1111, 9999);
            $user->verification_code = $code;
            $user->save();
            // \Mail::to($request->email)->send(new ForgotPassword($code));            
            
            if($request->expectsJson())
            {
                return response()->json([
                    'status' => 200,
                    'message' => 'A Verification Code has been Sent to your Email!',
                    'data' => [
                        'email' => $request->email,
                        'code' => $code
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

    public function verify_code(Request $request)
    {
        try{
            $user = User::where('email', $request->email)->first();
            if($request->verification_code == $user->verification_code)
            {
                $user->email_verified_at = Carbon::now();
                $user->verification_code = null;
                $user->save();
                if($request->expectsJson())
                {
                    return response()->json([
                        'status' => 200,
                        'message' => 'Verification Code Matched Successfully!',
                        'data' => $user,
                    ], 200);
                }
            }else{
                if($request->expectsJson())
                {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Invalid Verification Code!',
                        'data' => null,
                    ], 200);
                }
            }
        }catch(\Exception $e)
        {
            if($request->expectsJson())
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'There is some trouble to proceed your action!',
                    'data' => $e->getMessage(),
                ], 200);
            }
        }
    }

    public function reset_password(Request $request)
    {
        try{
            $user = User::where('email', $request->email)->first();

            if(empty($user))
            {
                if($request->expectsJson())
                {
                    return response()->json([
                        'status' => 400,
                        'message' => 'User does not exists!',
                        'data' => null,
                    ], 200);
                }
            }

            if($request->has('password') && $request->has('confirm_password'))
            {
                if($request->password === $request->confirm_password)
                {
                    $user->password = bcrypt($request->password);
                    if($user->save())
                    {
                        if($request->expectsJson())
                        {
                            return response()->json([
                                'status' => 200,
                                'message' => 'Password Changed Successfully!',
                                'data' => $user->makeHidden(['created_at', 'updated_at', 'email_verified_at', 'verification_code', 'cover_image', 'self_description', 'opening_time', 'type']),
                            ], 200);
                        }
                    }
                }
            }
        }catch(\Exception $e)
        {
            if($request->expectsJson)
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'There is some trouble to proceed your action!',
                    'data' => null,
                ], 200);
            }
        }
    }    

    public function logout(Request $request)
    {
        try{
            $user = User::find($request->user_id);

            if(empty($user))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'User does not exists!',
                    'data' => null,
                ], 200);
            }

            $user->token = null;
            if($user->save())
            {
                return response()->json([
                    'status' => 200,
                    'message' => 'Logged Out!',
                    'data' => null,
                ], 200);
            }
        }catch(\Exception $e)
        {
            if($request->expectsJson())
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'There is some trouble to proceed your action!',
                    'data' => null,
                ], 200);
            }
        }
    }

    public function change_password(Request $request)
    {
        try{
            $user = User::find($request->user_id);

            if(empty($user))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'User does not exists!',
                    'data' => null,
                ], 200);
            }

            if($request->has('old_password'))
            {
                if(Hash::check($request->old_password, $user->password))
                {   
                    $user->password = bcrypt($request->new_password);
                    if($user->save())
                    {
                        return response()->json([
                            'status' => 200,
                            'message' => 'Password Changed Successfully!',
                            'data' => $user->makeHidden(['created_at', 'updated_at']),
                        ], 200);
                    }
                }else{
                    if($request->expectsJson())
                    {
                        return response()->json([
                            'status' => 400,
                            'message' => 'You Entered Wrong Password!',
                            'data' => null,
                        ], 200);
                    }
                }
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

    public function login_with_facebook(Request $request)
    {
        try{
            if(!$request->has('facebook_id'))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Facebook ID is Required!',
                    'data' => null,
                ], 200);
            }

            if(!$request->has('name'))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Name is Required!',
                    'data' => null,
                ], 200);
            }           

            if(!$request->has('email'))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Email is Required!',
                    'data' => null,
                ], 200);
            }

            $user = User::where('facebook_id', $request->facebook_id)
            ->where('name', $request->name)            
            ->where('email', $request->email)
            ->first();

            if(!empty($user))
            {
                $user1 = User::where('email', $request->email)->first();
                if($request->expectsJson())
                {
                    return response()->json([
                        'status' => 200,
                        'message' => 'Welcome to Compass Trip!',
                        'data' => $user1->makeHidden(['created_at', 'updated_at']),
                    ], 200);
                }
            }else{
                $existing_user = User::where('email', $request->email)->first();

                if(!empty($existing_user))
                {
                    if($request->expectsJson())
                    {
                        return response()->json([
                            'status' => 400, 
                            'message' => 'Email has already been Taken!',
                            'data' => null,
                        ], 200);
                    }
                }

                $user = new User;
                $user->facebook_id = $request->facebook_id;
                $user->name = $request->name;                
                $user->email = $request->email;                

                if($user->save())
                {
                    $user = User::where('facebook_id', $request->facebook_id)                    
                    ->where('name', $request->name)
                    ->where('email', $request->email)
                    ->first(); 

                    if($request->expectsJson())
                    {
                        return response()->json([
                            'status' => 200,
                            'message' => 'Welcome to Compass Trip!',
                            'data' => $user->makeHidden(['created_at', 'updated_at', 'email_verified_at', 'verification_code', 'type']),
                        ], 200);
                    }
                }
            }
        }catch(\Exception $e)
        {
            if($request->expectsJson())
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'There is some trouble to proceed your action!',
                    'data' => $e->getMessage(),
                ], 200);
            }
        }
    }

    public function login_with_google(Request $request)
    {
        try{

            if(!$request->has('google_id'))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Google ID is Required!',
                    'data' => null,
                ], 200);
            }

            if(!$request->has('name'))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Name is Required',
                    'data' => null,
                ], 200);
            }           

            if(!$request->has('email'))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Email is Required',
                    'data' => null,
                ], 200);
            }

            $user = User::where('google_id', $request->google_id)
            ->where('name', $request->first_name)        
            ->where('email', $request->email)
            ->first();

            if(!empty($user))
            {
                if($request->expectsJson())
                {
                    return response()->json([
                        'status' => 200,
                        'message' => 'Welcome to Compass Trip',
                        'data' => $user->makeHidden(['created_at', 'updated_at']),
                    ], 200);
                }
            }else{               

                $user = new User;
                $user->google_id = $request->google_id;
                $user->name = $request->name;                
                $user->email = $request->email;

                if($user->save())
                {
                    $user = User::where('google_id', $request->google_id)
                    ->where('name', $request->name)                    
                    ->where('email', $request->email)
                    ->first(); 

                    if($request->expectsJson())
                    {
                        return response()->json([
                            'status' => 200,
                            'message' => 'Welcome to Compass Trip!',
                            'data' => $user->makeHidden(['created_at', 'updated_at', 'email_verified_at', 'verification_code', 'type']),
                        ], 200);
                    }
                }
            }
        }catch(\Exception $e)
        {
            if($request->expectsJson())
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'There is some trouble to proceed your action!',
                    'data' => null,
                ], 200);
            }
        }
    }

    public function login_with_apple(Request $request)
    {
        try{
            if(!$request->has('apple_id'))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Apple ID is Required',
                    'data' => [],
                ], 200);
            }

            if(!$request->has('name'))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Name is Required',
                    'data' => null,
                ], 200);
            }

            if(!$request->has('email'))
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'Email is Required',
                    'data' => null,
                ], 200);
            }
            
            $user = User::where('apple_id', $request->apple_id)
            ->where('name', $request->name)
            ->where('email', $request->email)
            ->first();

            if(!empty($user))
            {
                return response()->json([
                    'status' => 200,
                    'message' => 'Welcome to Compass Trip!',
                    'data' => $user,
                ], 200);
            }else{
                $new_user = new User;
                $new_user->apple_id = $request->apple_id;
                $new_user->name = $request->name;
                $new_user->email = $request->email;
                
                if($new_user->save())
                {
                    $user = User::where('apple_id', $request->apple_id)
                    ->where('name', $request->name)
                    ->where('email', $request->email)
                    ->first();

                    return response()->json([
                        'status' => 200,
                        'message' => 'Welcome to Compass Trip!',
                        'data' => $user,
                    ], 200);
                }                
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
}

