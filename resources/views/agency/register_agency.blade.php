@extends('layouts.app')
@section('title')
Register Company
@endsection
@section('content')

<div class="container-fluid">
    <div class="tour-img">
        <div class="tour-img-overlay"></div>
        <div class="tour-text">
            <h2 class="lg:text-5xl text-4xl">Register Company</h2>
            <div class="link-div"><a href="/">Home</a>/Register</div>
        </div>
    </div>
    <!-------------End Header------------->

    <div class="bg-gray-100 py-12">
        
    <div class="lg:w-[70vw] w-[90vw] mx-auto bg-white p-4">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid md:grid-cols-2 gap-3">
                <input type="hidden" class="form-control" name="type" value="2">
                <input type="hidden" class="form-control" name="user_role" value="agency">
                <input type="hidden" class="form-control" name="is_approved_by_admin" value="false">

                <div class="">
                    <label for="name" class="block text-sm font-medium text-gray-600">{{ __('Name') }}</label>
                    <div class="">
                        <input id="name" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <label for="name" class="block text-sm font-medium text-gray-600">{{ __('Company Name') }}</label>

                    <div class="">
                        <input id="company_name" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('company_name') is-invalid @enderror"
                            name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name">

                        @error('company_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <label for="name" class="block text-sm font-medium text-gray-600">{{ __('Phone Number') }}</label>

                    <div class="">
                        <input id="phone" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('phone') is-invalid @enderror" name="phone"
                            value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <label for="email" class="block text-sm font-medium text-gray-600">{{ __('E-Mail Address') }}</label>

                    <div class="">
                        <input id="email" type="email" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <label for="name" class="block text-sm font-medium text-gray-600">{{ __('License Number (Optional)') }}</label>

                    <div class="">
                        <input id="license_number" type="text"
                            class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('license_number') is-invalid @enderror" name="license_number"
                            value="{{ old('license_number') }}">

                        @error('license_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <label for="name" class="block text-sm font-medium text-gray-600">{{ __('Street Address') }}</label>

                    <div class="">
                        <input id="address" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('address') is-invalid @enderror"
                            name="address" value="{{ old('address') }}">

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <label for="city" class="block text-sm font-medium text-gray-600">{{ __('City') }}</label>

                    <div class="">
                        <input id="city" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('city') is-invalid @enderror" name="city"
                            value="{{ old('city') }}">

                        @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <label for="state" class="block text-sm font-medium text-gray-600">{{ __('State') }}</label>

                    <div class="">
                        <input id="state" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('state') is-invalid @enderror" name="state"
                            value="{{ old('state') }}">

                        @error('state')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <label for="country" class="block text-sm font-medium text-gray-600">{{ __('Country') }}</label>

                    <div class="">
                        <input id="country" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('country') is-invalid @enderror"
                            name="country" value="{{ old('country') }}">

                        @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <label for="zip" class="block text-sm font-medium text-gray-600">{{ __('Zip') }}</label>

                    <div class="">
                        <input id="zip" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('zip') is-invalid @enderror" name="zip"
                            value="{{ old('zip') }}">

                        @error('zip')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <label for="name" class="block text-sm font-medium text-gray-600">{{ __('Company Description') }}</label>

                    <div class="">
                        <textarea name="company_description" id="company_description"
                            class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('company_description') is-invalid @enderror" rows="5"
                            value="{{ old('company_description') }}" autocomplete="company_description"
                            placeholder="Type Here..."></textarea>

                        @error('company_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <label for="password" class="block text-sm font-medium text-gray-600">{{ __('Password') }}</label>

                    <div class="">
                        <input id="password" type="password" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <label for="password-confirm" class="block text-sm font-medium text-gray-600">{{ __('Confirm Password') }}</label>

                    <div class="">
                        <input id="password-confirm" type="password" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                </div>
            </div>

            <div class="my-5">
                <div class="text-center">
                    <input type="submit" value="Register" class="submit md:max-w-[300px] w-full" />
                </div>
            </div>

            <div class="max-w-[300px] mx-auto">
                <p class="text-md text-center">or use one of these options</p>
                <div class="grid grid-cols-2 gap-3 mt-3">
                    <a href="https://www.google.com" target="_blank" rel="noopener noreferrer"
                        class="flex flex-col items-center justify-center p-4 text-center rounded-lg shadow-md transition">
                        <svg viewBox="0 0 262 262" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid"
                            aria-hidden="true" focusable="false" width="24" height="24" role="img">
                            <path
                                d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"
                                fill="#4285F4"></path>
                            <path
                                d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"
                                fill="#34A853"></path>
                            <path
                                d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"
                                fill="#FBBC05"></path>
                            <path
                                d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"
                                fill="#EB4335"></path>
                        </svg>
                    </a>
                    <a href="https://www.apple.com" target="_blank" rel="noopener noreferrer"
                        class="flex flex-col items-center justify-center p-4 text-center rounded-lg shadow-md transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M17.25 13.41c.02 2.27 2.02 3.02 2.05 3.03-.02.06-.32 1.15-1.07 2.28-.65.98-1.33 1.95-2.4 1.97-1.05.02-1.38-.64-2.57-.64s-1.56.62-2.55.66c-1.02.03-1.8-1.06-2.46-2.04-1.34-1.94-2.37-5.5-.99-7.89.69-1.21 1.93-1.98 3.27-2 .98-.02 1.91.66 2.57.66s1.77-.82 3-.7c.51.02 1.95.21 2.88 1.62-.07.04-1.71.99-1.69 2.96m-2.2-5.44c.55-.68.92-1.62.82-2.57-.79.03-1.78.53-2.34 1.2-.52.62-.96 1.6-.84 2.52.89.07 1.81-.46 2.36-1.15" />
                        </svg>
                    </a>
                </div>
                <div>
                    <p class="text-sm text-center mt-5">By signing in or creating an account, you agree with our <span
                            class="text-green-500"> Terms & Conditions </span> and <span class="text-green-500"> Privacy
                            Statement </span></p>
                    <p class="text-sm text-center mt-3">All rights reserved. <br>
                        Copyright (2006-2025) – Booking.com™</p>
                </div>
            </div>
        </form>
    </div>
    </div>

</div>
</div>

@endsection

@section('script')

@endsection