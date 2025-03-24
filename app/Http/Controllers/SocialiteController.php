<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class SocialiteController extends Controller
{
    public function google_redirect(){
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function google_callback(){
        $user = Socialite::driver('google')->stateless()->user();
        $this->storeUser($user,'google');
          return view('home');
//        dd($user);

    }

    public function storeUser($data,$provider){
        $user = User::where('email',$data->email)->first();
        if ($user){
            $user->update([
                'provider'=>$provider,
                'provider_id'=>$data->id,
                'avatar'=>$data->avatar,
            ]);
        }
        else{
            $user = User::create([
                'name'=>$data->name,
                'email'=>$data->email,
                'provider'=>$provider,
                'provider_id'=>$data->id,
                'avatar'=>$data->avatar,
            ]);
        }
        Auth::login($user);

    }

    public function fb_redirect(){
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function fb_callback(){
        
        $user = Socialite::driver('facebook')->stateless()->user();
        $this->fbUser($user,'facebook');
          return view('home');
        // dd($user);
        // if($existingUser)
        //     {
        //         Auth::login($existingUser);
        //         return view('home');
        //     }   else
        //             {
        //                 $createUser = User::create([
        //                     'name'=>$user->name,
        //                     'email'=>$user->email,
        //                     'provider_id'=>$user->id,
        //                     'provider'=>$user->provider,
        //                     'avatar'=>$user->avatar,
        //                 ]);
        //                     Auth::login($createUser);
        //                         return view('home');
        //             }
            
    }

    public function fbUser($data,$provider){
        $user = User::where('email',$data->email)->first();
            if ($user){
                $user->update([
                    'provider'=>$provider,
                    'provider_id'=>$data->id,
                    'avatar'=>$data->avatar,
                ]);
            }
            else{
                    $user = User::create([
                    'name'=>$data->name,
                    'email'=>$data->email,
                    'provider'=>$provider,
                    'provider_id'=>$data->id,
                    'avatar'=>$data->avatar,
                    ]);
        }
        Auth::login($user);

    }
}
