<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Redirect to intended URL (e.g. booking review) after registration when set.
     */
    public function redirectPath()
    {
        return session('url.intended', RouteServiceProvider::HOME);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    { 
        // Base validation rules for all registration types
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric', 'min:10'],
        ];
        // Additional validation rules for agency registration
        if (isset($data['type']) && $data['type'] == '2') {
            $rules = array_merge($rules, [
                'company_name' => ['required', 'string', 'max:255'],
                'address' => ['nullable', 'string', 'max:500'],
                'city' => ['nullable', 'string', 'max:100'],
                'state' => ['nullable', 'string', 'max:100'],
                'country' => ['nullable', 'string', 'max:100'],
                'zip' => ['nullable', 'string', 'max:20'],
                'license_number' => ['nullable', 'string', 'max:100'],
                'company_description' => ['nullable', 'string', 'max:2000'],
            ]);
        }
        return Validator::make($data, $rules, [
            'name.required' => 'Your name is required.',
            'name.max' => 'Your name cannot exceed 255 characters.',
            'email.required' => 'An email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'A password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.confirmed' => 'Password confirmation does not match.',
            'phone.required' => 'A phone number is required.',
            'phone.numeric' => 'Phone number must contain only digits.',
            'phone.min' => 'Phone number must be at least 10 digits.',
            'company_name.required' => 'Company name is required for agency registration.',
            'company_name.max' => 'Company name cannot exceed 255 characters.',
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //dd($data);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'company_name' => $data['company_name'] ?? '',
            'phone' => $data['phone'],
            'address' => $data['address'] ?? '',
            'city' => $data['city'] ?? '',
            'state' => $data['state'] ?? '',
            'country' => $data['country'] ?? '',
            'zip' => $data['zip'] ?? '',
            'license_number' => $data['license_number'] ?? '',
            'company_description' => $data['company_description'] ?? '',
            'type' => $data['type'] ?? '1',
            'user_role' => $data['user_role'] ?? 'user',
            'is_approved_by_admin' => $data['is_approved_by_admin'] ?? 'true',
            'password' => Hash::make($data['password']),
        ]);
    }
}
