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
        <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
            @csrf

            <div class="grid md:grid-cols-2 gap-3">
                <input type="hidden" class="form-control" name="type" value="2">
                <input type="hidden" class="form-control" name="user_role" value="agency">
                <input type="hidden" class="form-control" name="is_approved_by_admin" value="false">

                <div class="mb-3">
                    <label for="name" class="block text-sm font-medium text-gray-600">{{ __('Name') }}</label>
                    <input id="name" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your full name">

                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback d-none" id="name-feedback">Name is required and must be at least 2 characters long.</div>
                </div>

                <div class="mb-3">
                    <label for="company_name" class="block text-sm font-medium text-gray-600">{{ __('Company Name') }}</label>
                    <input id="company_name" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 form-control @error('company_name') is-invalid @enderror"
                        name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" placeholder="Enter your company name">

                    @error('company_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback d-none" id="company_name-feedback">Company name is required and must be at least 2 characters long.</div>
                </div>

                <div class="mb-3">
                    <label for="phone" class="block text-sm font-medium text-gray-600">{{ __('Phone Number') }}</label>
                    <input id="phone" type="tel" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 form-control @error('phone') is-invalid @enderror" name="phone"
                        value="{{ old('phone') }}" required autocomplete="phone" placeholder="Enter your phone number">

                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback d-none" id="phone-feedback">Please enter a valid phone number (10-15 digits).</div>
                </div>

                <div class="mb-3">
                    <label for="email" class="block text-sm font-medium text-gray-600">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email address">

                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback d-none" id="email-feedback">Please enter a valid email address.</div>
                </div>

                <div class="mb-3">
                    <label for="license_number" class="block text-sm font-medium text-gray-600">{{ __('License Number (Optional)') }}</label>
                    <input id="license_number" type="text"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 form-control @error('license_number') is-invalid @enderror" name="license_number"
                        value="{{ old('license_number') }}" placeholder="Enter your license number">

                    @error('license_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="block text-sm font-medium text-gray-600">{{ __('Street Address') }}</label>
                    <input id="address" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 form-control @error('address') is-invalid @enderror"
                        name="address" value="{{ old('address') }}" placeholder="Enter your street address">

                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback d-none" id="address-feedback">Please enter your street address.</div>
                </div>

                <div class="mb-3">
                    <label for="city" class="block text-sm font-medium text-gray-600">{{ __('City') }}</label>
                    <input id="city" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 form-control @error('city') is-invalid @enderror" name="city"
                        value="{{ old('city') }}" placeholder="Enter your city">

                    @error('city')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback d-none" id="city-feedback">Please enter your city.</div>
                </div>

                <div class="mb-3">
                    <label for="state" class="block text-sm font-medium text-gray-600">{{ __('State') }}</label>
                    <input id="state" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 form-control @error('state') is-invalid @enderror" name="state"
                        value="{{ old('state') }}" placeholder="Enter your state">

                    @error('state')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback d-none" id="state-feedback">Please enter your state.</div>
                </div>

                <div class="mb-3">
                    <label for="country" class="block text-sm font-medium text-gray-600">{{ __('Country') }}</label>
                    <input id="country" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 form-control @error('country') is-invalid @enderror"
                            name="country" value="{{ old('country') }}" placeholder="Enter your country">

                    @error('country')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback d-none" id="country-feedback">Please enter your country.</div>
                </div>

                <div class="mb-3">
                    <label for="zip" class="block text-sm font-medium text-gray-600">{{ __('Zip') }}</label>
                    <input id="zip" type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 form-control @error('zip') is-invalid @enderror" name="zip"
                        value="{{ old('zip') }}" placeholder="Enter your zip code">

                    @error('zip')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback d-none" id="zip-feedback">Please enter your zip code.</div>
                </div>

                <div class="mb-3">
                    <label for="company_description" class="block text-sm font-medium text-gray-600">{{ __('Company Description') }}</label>
                    <textarea name="company_description" id="company_description"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 form-control @error('company_description') is-invalid @enderror" rows="5"
                        placeholder="Type your company description here...">{{ old('company_description') }}</textarea>

                    @error('company_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback d-none" id="company_description-feedback">Please enter your company description.</div>
                </div>

                <div class="mb-3">
                    <label for="password" class="block text-sm font-medium text-gray-600">{{ __('Password') }}</label>
                    <input id="password" type="password" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" placeholder="Enter your password (min 8 characters)">

                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback d-none" id="password-feedback">Password must be at least 8 characters long.</div>
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="block text-sm font-medium text-gray-600">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 form-control" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Confirm your password">
                    <div class="invalid-feedback d-none" id="password-confirm-feedback">Passwords do not match.</div>
                </div>
            </div>

            <div class="my-5">
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg md:max-w-[300px] w-full">Register</button>
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
            
            // Custom validation for each field
            var name = document.getElementById('name');
            if (name) {
                if (name.value.trim().length < 2) {
                    name.classList.add('is-invalid');
                    name.classList.remove('is-valid');
                    // Show error message only on form submission
                    var errorMsg = document.getElementById('name-feedback');
                    if (errorMsg) errorMsg.classList.remove('d-none');
                    isValid = false;
                } else {
                    name.classList.add('is-valid');
                    name.classList.remove('is-invalid');
                    // Hide error message
                    var errorMsg = document.getElementById('name-feedback');
                    if (errorMsg) errorMsg.classList.add('d-none');
                }
            }
            
            var companyName = document.getElementById('company_name');
            if (companyName) {
                if (companyName.value.trim().length < 2) {
                    companyName.classList.add('is-invalid');
                    companyName.classList.remove('is-valid');
                    var errorMsg = document.getElementById('company_name-feedback');
                    if (errorMsg) errorMsg.classList.remove('d-none');
                    isValid = false;
                } else {
                    companyName.classList.add('is-valid');
                    companyName.classList.remove('is-invalid');
                    var errorMsg = document.getElementById('company_name-feedback');
                    if (errorMsg) errorMsg.classList.add('d-none');
                }
            }
            
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
            
            var phone = document.getElementById('phone');
            var phoneRegex = /^[0-9]{10,15}$/;
            if (phone) {
                var cleanPhone = phone.value.replace(/\s/g, '');
                if (!phone.value || !phoneRegex.test(cleanPhone)) {
                    phone.classList.add('is-invalid');
                    phone.classList.remove('is-valid');
                    var errorMsg = document.getElementById('phone-feedback');
                    if (errorMsg) errorMsg.classList.remove('d-none');
                    isValid = false;
                } else {
                    phone.classList.add('is-valid');
                    phone.classList.remove('is-invalid');
                    var errorMsg = document.getElementById('phone-feedback');
                    if (errorMsg) errorMsg.classList.add('d-none');
                }
            }
            
            var address = document.getElementById('address');
            if (address) {
                if (address.value.trim().length < 1) {
                    address.classList.add('is-invalid');
                    address.classList.remove('is-valid');
                    var errorMsg = document.getElementById('address-feedback');
                    if (errorMsg) errorMsg.classList.remove('d-none');
                    isValid = false;
                } else {
                    address.classList.add('is-valid');
                    address.classList.remove('is-invalid');
                    var errorMsg = document.getElementById('address-feedback');
                    if (errorMsg) errorMsg.classList.add('d-none');
                }
            }
            
            var city = document.getElementById('city');
            if (city) {
                if (city.value.trim().length < 1) {
                    city.classList.add('is-invalid');
                    city.classList.remove('is-valid');
                    var errorMsg = document.getElementById('city-feedback');
                    if (errorMsg) errorMsg.classList.remove('d-none');
                    isValid = false;
                } else {
                    city.classList.add('is-valid');
                    city.classList.remove('is-invalid');
                    var errorMsg = document.getElementById('city-feedback');
                    if (errorMsg) errorMsg.classList.add('d-none');
                }
            }
            
            var state = document.getElementById('state');
            if (state) {
                if (state.value.trim().length < 1) {
                    state.classList.add('is-invalid');
                    state.classList.remove('is-valid');
                    var errorMsg = document.getElementById('state-feedback');
                    if (errorMsg) errorMsg.classList.remove('d-none');
                    isValid = false;
                } else {
                    state.classList.add('is-valid');
                    state.classList.remove('is-invalid');
                    var errorMsg = document.getElementById('state-feedback');
                    if (errorMsg) errorMsg.classList.add('d-none');
                }
            }
            
            var country = document.getElementById('country');
            if (country) {
                if (country.value.trim().length < 1) {
                    country.classList.add('is-invalid');
                    country.classList.remove('is-valid');
                    var errorMsg = document.getElementById('country-feedback');
                    if (errorMsg) errorMsg.classList.remove('d-none');
                    isValid = false;
                } else {
                    country.classList.add('is-valid');
                    country.classList.remove('is-invalid');
                    var errorMsg = document.getElementById('country-feedback');
                    if (errorMsg) errorMsg.classList.add('d-none');
                }
            }
            
            var zip = document.getElementById('zip');
            if (zip) {
                if (zip.value.trim().length < 1) {
                    zip.classList.add('is-invalid');
                    zip.classList.remove('is-valid');
                    var errorMsg = document.getElementById('zip-feedback');
                    if (errorMsg) errorMsg.classList.remove('d-none');
                    isValid = false;
                } else {
                    zip.classList.add('is-valid');
                    zip.classList.remove('is-invalid');
                    var errorMsg = document.getElementById('zip-feedback');
                    if (errorMsg) errorMsg.classList.add('d-none');
                }
            }
            
            var companyDescription = document.getElementById('company_description');
            if (companyDescription) {
                if (companyDescription.value.trim().length < 1) {
                    companyDescription.classList.add('is-invalid');
                    companyDescription.classList.remove('is-valid');
                    var errorMsg = document.getElementById('company_description-feedback');
                    if (errorMsg) errorMsg.classList.remove('d-none');
                    isValid = false;
                } else {
                    companyDescription.classList.add('is-valid');
                    companyDescription.classList.remove('is-invalid');
                    var errorMsg = document.getElementById('company_description-feedback');
                    if (errorMsg) errorMsg.classList.add('d-none');
                }
            }
            
            var password = document.getElementById('password');
            if (password) {
                if (password.value.length < 8) {
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
            
            // Password confirmation validation
            var passwordConfirm = document.getElementById('password-confirm');
            if (passwordConfirm && password) {
                if (password.value !== passwordConfirm.value) {
                    passwordConfirm.classList.add('is-invalid');
                    passwordConfirm.classList.remove('is-valid');
                    var errorMsg = document.getElementById('password-confirm-feedback');
                    if (errorMsg) errorMsg.classList.remove('d-none');
                    isValid = false;
                } else if (passwordConfirm.value) {
                    passwordConfirm.classList.add('is-valid');
                    passwordConfirm.classList.remove('is-invalid');
                    var errorMsg = document.getElementById('password-confirm-feedback');
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
    document.getElementById('name')?.addEventListener('input', function() {
        if (this.value.trim().length >= 2) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
    });
    
    document.getElementById('company_name')?.addEventListener('input', function() {
        if (this.value.trim().length >= 2) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
    });
    
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
    
    document.getElementById('phone')?.addEventListener('input', function() {
        var phoneRegex = /^[0-9]{10,15}$/;
        var cleanPhone = this.value.replace(/\s/g, '');
        if (phoneRegex.test(cleanPhone)) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
    });
    
    document.getElementById('address')?.addEventListener('input', function() {
        if (this.value.trim().length >= 1) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
    });
    
    document.getElementById('city')?.addEventListener('input', function() {
        if (this.value.trim().length >= 1) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
    });
    
    document.getElementById('state')?.addEventListener('input', function() {
        if (this.value.trim().length >= 1) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
    });
    
    document.getElementById('country')?.addEventListener('input', function() {
        if (this.value.trim().length >= 1) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
    });
    
    document.getElementById('zip')?.addEventListener('input', function() {
        if (this.value.trim().length >= 1) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
    });
    
    document.getElementById('company_description')?.addEventListener('input', function() {
        if (this.value.trim().length >= 1) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
    });
    
    document.getElementById('password')?.addEventListener('input', function() {
        if (this.value.length >= 8) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
        
        // Also validate password confirmation if it has a value
        var passwordConfirm = document.getElementById('password-confirm');
        if (passwordConfirm && passwordConfirm.value) {
            if (this.value === passwordConfirm.value) {
                passwordConfirm.classList.add('is-valid');
                passwordConfirm.classList.remove('is-invalid');
            } else {
                passwordConfirm.classList.add('is-invalid');
                passwordConfirm.classList.remove('is-valid');
            }
        }
    });
    
    // Real-time password confirmation validation
    document.getElementById('password-confirm')?.addEventListener('input', function() {
        var password = document.getElementById('password');
        if (password && this.value === password.value) {
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