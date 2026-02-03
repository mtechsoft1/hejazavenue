@extends('layouts.app')
@section('title')
Login
@endsection
@section('content')
@section('hide_navbar', true)
@include('components.video_header', ['title' => 'Login', 'breadcrumb' => 'Home/Login'])

{{--
<div class="container-fluid">
    <div class="tour-img">
        <div class="tour-img-overlay"></div>
            <div class="tour-text">
                <h2 class="lg:text-5xl text-4xl">Login</h2>
                <div class="link-div"><a href="/">Home</a>/Login</div>
        </div>
    </div>
    <!-------------End Header------------->
</div>
--}}
    <div class="bg-gray-100 py-12">
        <div class="lg:w-[50vw] w-[90vw] mx-auto  p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold w-full text-left">Sign in or create an account</h2>
            <p class="text-md text-left mt-2 w-full">You can sign in using your hejaz.com account to access our services.</p>
            
            <form action="{{ route('login') }}" method="POST" class="w-full mt-4">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">E-Mail Address</label>
                    <input id="email" type="email" name="email" required autocomplete="email" autofocus
                        class="w-full p-2.5 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full p-2.5 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="text-center">
                    <button type="submit"
                        class="w-full py-2.5 md:max-w-[300px] mx-auto bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 transition">Continue with Email</button>
                </div>
            </form>
            
            <div class="max-w-[300px] mx-auto text-center space-y-3 pt-4">
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Forgot Your Password?</a>
                @endif
                
                <p class="text-md text-center mt-4">or use one of these options</p>
                    <div class="grid grid-cols-2 gap-3 mt-3">
                        <a href="https://www.google.com" target="_blank" rel="noopener noreferrer"
                            class="flex flex-col items-center justify-center p-2 text-center rounded-lg shadow-md transition">
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
                            class="flex flex-col items-center justify-center p-2 text-center rounded-lg shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M17.25 13.41c.02 2.27 2.02 3.02 2.05 3.03-.02.06-.32 1.15-1.07 2.28-.65.98-1.33 1.95-2.4 1.97-1.05.02-1.38-.64-2.57-.64s-1.56.62-2.55.66c-1.02.03-1.8-1.06-2.46-2.04-1.34-1.94-2.37-5.5-.99-7.89.69-1.21 1.93-1.98 3.27-2 .98-.02 1.91.66 2.57.66s1.77-.82 3-.7c.51.02 1.95.21 2.88 1.62-.07.04-1.71.99-1.69 2.96m-2.2-5.44c.55-.68.92-1.62.82-2.57-.79.03-1.78.53-2.34 1.2-.52.62-.96 1.6-.84 2.52.89.07 1.81-.46 2.36-1.15" />
                            </svg>
                        </a>
                    </div>
                
                <p class="text-sm text-center mt-5">By signing in or creating an account, you agree with our
                    <a href="#" class="text-green-600 hover:underline">Terms & Conditions</a> and
                    <a href="#" class="text-green-600 hover:underline">Privacy Statement</a>
                </p>
                <div class="text-center mt-3">
                    <p class="text-md">Don't have an account? <a href="{{ route('register') }}" class="text-green-600 font-bold hover:underline">Create an account</a></p>
                </div>
                <p class="text-sm text-center mt-3">All rights reserved. <br> Copyright (2006-2025) – hejaz.com™</p>
            
            </div>
            
        </div>
        
    </div>

    
</div>
</div>
@endsection

@section('script')
@endsection