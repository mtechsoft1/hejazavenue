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
<div class="bg-gradient-to-br from-gray-50 via-white to-gray-100 py-20">
    <div class="lg:w-[480px] w-[90%] mx-auto">
        
        <div class="bg-white/90 backdrop-blur-xl border border-gray-100 rounded-3xl shadow-2xl p-10">

            <!-- Logo -->
            <div class="flex justify-center">
                    <img class="h-12 w-auto max-w-[160px] object-contain" src="{{ asset('img/logo.png') }}" alt="Hejaz Avenue" />
            </div>

            <!-- Header -->
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold text-gray-900">
                    Welcome Back
                </h2>
                <p class="text-gray-500 mt-2 text-sm">
                    Sign in to access your hejazavenue.com account
                </p>
            </div>

            <!-- Form -->
            <form action="{{ route('login') }}" method="POST" class="needs-validation space-y-6" novalidate>
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-600 mb-2">
                        Email Address
                    </label>

                    <input id="email" type="email" name="email" required autocomplete="email" autofocus
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-sm 
                        focus:ring-2 focus:ring-emerald-400 focus:border-emerald-500 focus:outline-none 
                        transition-all duration-200 
                        form-control @error('email') is-invalid @enderror"
                        placeholder="Enter your email address">

                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="invalid-feedback d-none" id="email-feedback">
                        Please enter a valid email address.
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-600 mb-2">
                        Password
                    </label>

                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-sm 
                        focus:ring-2 focus:ring-emerald-400 focus:border-emerald-500 focus:outline-none 
                        transition-all duration-200 
                        form-control @error('password') is-invalid @enderror"
                        placeholder="Enter your password">

                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="invalid-feedback d-none" id="password-feedback">
                        Please enter your password.
                    </div>
                </div>

                <!-- Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full rounded-2xl bg-gradient-to-r from-emerald-500 to-green-600
                        px-6 py-3.5 text-sm font-semibold tracking-wide text-white
                        shadow-lg shadow-emerald-200/50
                        transition-all duration-300
                        hover:shadow-xl hover:shadow-emerald-300/50 hover:-translate-y-0.5
                        active:scale-[0.99]
                        focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2">
                        Sign In
                    </button>
                </div>

            </form>

            <!-- Divider -->
            <div class="flex items-center gap-4 my-8">
                <div class="flex-1 h-px bg-gray-200"></div>
                <span class="text-xs text-gray-400 uppercase tracking-wide">or continue with</span>
                <div class="flex-1 h-px bg-gray-200"></div>
            </div>

            <!-- Social -->

            <div class="flex justify-center gap-6 mt-2">

                <!-- Google -->
                <a href="https://www.google.com" target="_blank" rel="noopener noreferrer"
                    class="flex items-center justify-center w-14 h-14 rounded-2xl 
                    bg-white border border-gray-200 shadow-sm 
                    hover:shadow-md hover:-translate-y-1 transition-all duration-300">

                    <svg viewBox="0 0 262 262" xmlns="http://www.w3.org/2000/svg"
                        width="26" height="26">
                        <path fill="#4285F4"
                            d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />
                        <path fill="#34A853"
                            d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />
                        <path fill="#FBBC05"
                            d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782" />
                        <path fill="#EB4335"
                            d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />
                    </svg>
                </a>

                <!-- Apple -->
                <a href="https://www.apple.com" target="_blank" rel="noopener noreferrer"
                    class="flex items-center justify-center w-14 h-14 rounded-2xl 
                    bg-white border border-gray-200 shadow-sm 
                    hover:shadow-md hover:-translate-y-1 transition-all duration-300">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="black" viewBox="0 0 24 24">
                        <path
                            d="M17.25 13.41c.02 2.27 2.02 3.02 2.05 3.03-.02.06-.32 1.15-1.07 2.28-.65.98-1.33 1.95-2.4 1.97-1.05.02-1.38-.64-2.57-.64s-1.56.62-2.55.66c-1.02.03-1.8-1.06-2.46-2.04-1.34-1.94-2.37-5.5-.99-7.89.69-1.21 1.93-1.98 3.27-2 .98-.02 1.91.66 2.57.66s1.77-.82 3-.7c.51.02 1.95.21 2.88 1.62-.07.04-1.71.99-1.69 2.96m-2.2-5.44c.55-.68.92-1.62.82-2.57-.79.03-1.78.53-2.34 1.2-.52.62-.96 1.6-.84 2.52.89.07 1.81-.46 2.36-1.15" />
                    </svg>
                </a>

            </div>

            <!-- Footer Links -->
            <div class="mt-8 text-center space-y-4">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}#register-form"
                       class="text-emerald-600 font-semibold hover:underline">
                        Sign Up
                    </a>
                </p>

                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm text-gray-500 hover:text-emerald-600 transition">
                    Forgot your password?
                </a>
                @endif

                <p class="text-xs text-gray-400 pt-4">
                    By signing in, you agree to our
                    <a href="#" class="text-emerald-600 hover:underline">Terms</a>
                    and
                    <a href="#" class="text-emerald-600 hover:underline">Privacy Policy</a>.
                </p>

                <p class="text-xs text-gray-400">
                    © 2006–2025 hejazavenue.com™. All rights reserved.
                </p>
            </div>

        </div>
    </div>
</div>
    
</div>
</div>
@endsection
@section('script')
<script>
// Bootstrap form validation
(function () {
    'use strict'
    
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
    
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            var isValid = true;
            var formSubmitted = true;
            
            // Custom email validation
            var email = document.getElementById('email');
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email) {
                if (!email.value || !emailRegex.test(email.value)) {
                    email.classList.add('is-invalid');
                    email.classList.remove('is-valid');
                    var errorMsg = document.getElementById('email-feedback');
                    if (errorMsg) errorMsg.classList.remove('d-none');
                    isValid = false;
                } else {
                    email.classList.add('is-valid');
                    email.classList.remove('is-invalid');
                    var errorMsg = document.getElementById('email-feedback');
                    if (errorMsg) errorMsg.classList.add('d-none');
                }
            }
            
            // Custom password validation
            var password = document.getElementById('password');
            if (password) {
                if (!password.value) {
                    password.classList.add('is-invalid');
                    password.classList.remove('is-valid');
                    var errorMsg = document.getElementById('password-feedback');
                    if (errorMsg) errorMsg.classList.remove('d-none');
                    isValid = false;
                } else {
                    password.classList.add('is-valid');
                    password.classList.remove('is-invalid');
                    var errorMsg = document.getElementById('password-feedback');
                    if (errorMsg) errorMsg.classList.add('d-none');
                }
            }
            
            if (!form.checkValidity() || !isValid) {
                event.preventDefault()
                event.stopPropagation()
            }
            
            form.classList.add('was-validated')
        }, false)
    })
    
    // Real-time validation (but don't show error messages until form is submitted)
    document.getElementById('email')?.addEventListener('input', function() {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailRegex.test(this.value)) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
    });
    
    document.getElementById('password')?.addEventListener('input', function() {
        if (this.value.length > 0) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
    });
})()
</script>
@endsection