<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/fav_icon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/locdetails.css') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries">
    </script>
    
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <style>
    .form-control-plaintext {
        background-color: #f5f8fa;
    }

    label {
        float: left;
    }

    .submit-button {
        margin-top: 15px;
        margin-bottom: 15px;
        padding: 12px 78px;
        border-radius: 30px;
        font-size: 16px;
    }

    @media (min-width: 1400px) {

        .container,
        .container-lg,
        .container-xl,
        .container-xxl {
            max-width: 1620px;
        }
    }

    .navbar {
        background-color: #6fda44 !important;
    }

    .navbar-brand img {
        height: 30px;
    }

    .btn-post-tour {
        background: transparent;
        border: none;
        color: white;
    }

    .btn-post-tour:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .btn-signup,
    .btn-register {
        background: white;
        color: #007bff;
    }

    .navbar-nav .nav-link {
        margin-right: 20px;
        color: white;
    }

    .nav-item.active .nav-link {
        border: 1px solid white;
        border-radius: 30%;
        background-color: #ffffff40;
    }

    .navbar-toggler {
        margin-top: 10px;
    }

    @media (max-width: 992px) {
        .nav-item.active .nav-link {
            border: none;
            background-color: transparent;
        }
    }

    #currencyModal {
        z-index: 100;
    }

    .cmodal {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    </style>
    @yield('style')
</head>

<body>
    
    <div class="row" id="SessionMessage">
        <div class="col-md-12 text-center">
            @if(session()->has('success'))
                <div class="alert alert-success text-center">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger text-center">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div> 
    </div>


    <div id="home-page" class="w-100 bg-[#008000] text-white p-3 flex justify-center flex-col items-center gap-6">
        <div class="lg:max-w-[1110px] w-[90vw]  text-white flex justify-center flex-col items-center gap-3">
            <div class="flex lg:justify-end justify-between w-full items-center">
                <!-- Navigation Links (hidden on small screens, visible on large screens) -->
                <div class="hidden lg:flex items-center gap-2">
                    <a class=" text-sm  py-2 px-4 me-3  border text-decoration-none cursor-pointer rounded">
                        <p class="text-white font-bold">List our tours </p>
                    </a>
                    @auth
                    <a href="{{ route('home') }}"
                        class="bg-white text-[#008000] text-sm p-2 rounded text-decoration-none cursor-pointer hover:text-[#008000]">
                        <p class="font-medium">My Account</p>
                    </a>
                    <a href="{{ route('logout') }}"
                        class="bg-white text-[#008000] text-sm p-2 rounded text-decoration-none cursor-pointer hover:text-[#008000]">
                        <p class="font-medium">Logout</p>
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                        class="bg-white text-[#008000] text-sm p-2 rounded text-decoration-none cursor-pointer hover:text-[#008000]">
                        <p class="font-medium">Sign In</p>
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-white text-[#008000] text-sm p-2 rounded text-decoration-none cursor-pointer hover:text-[#008000]">
                        <p class="font-medium">Register</p>
                    </a>
                    @endauth
                </div>

                <div class="lg:hidden">
                    <a href="{{ route('index') }}"
                        class="text-white text-decoration-none text-xl font-bold flex items-center">
                        <div class="w-14 h-14 "> <img class="w-full h-full" src="{{ asset('./img/logo.png') }}"
                                alt="logo" /></div>
                        <!--<span  class="font-medium">Compass.com</span>-->
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="menu-toggle"
                    class="lg:hidden text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu hidden on large screens -->
            <div id="mobile-menu" class="lg:hidden hidden w-full mt-4 transition-all duration-300">
                <ul class="flex flex-col p-0">
                    <li>
                        <a href="{{ route('index') }}"
                            class="p-2 rounded-full text-decoration-none border-1 border-white text-sm flex gap-1 hover:text-white items-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span>Home</span></a>
                    </li>
                    <li>
                        <a href="{{ route('tours') }}"
                            class="p-2 rounded-full text-decoration-none hover:bg-green-700  text-sm flex gap-1 hover:text-white items-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            <span>Tours</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                            class="p-2 rounded-full text-decoration-none hover:bg-green-700  text-sm flex gap-1 hover:text-white items-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 0 0 3.182-3.183L6.5 7.568V5.25a2.25 2.25 0 0 0-2.25-2.25h4.318a2.25 2.25 0 0 1 2.25 2.25v4.318a2.25 2.25 0 0 0 2.25 2.25h4.318a2.25 2.25 0 0 0 2.25-2.25v-4.318a2.25 2.25 0 0 0-2.25-2.25h-4.318A2.25 2.25 0 0 1 9.568 3Z" />
                            </svg>
                            <span>Contact Us</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about_us') }}"
                            class="p-2 rounded-full text-decoration-none hover:bg-green-700  text-sm flex gap-1 hover:text-white items-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 0 0 3.182-3.183L6.5 7.568V5.25a2.25 2.25 0 0 0-2.25-2.25h4.318a2.25 2.25 0 0 1 2.25 2.25v4.318a2.25 2.25 0 0 0 2.25 2.25h4.318a2.25 2.25 0 0 0 2.25-2.25v-4.318a2.25 2.25 0 0 0-2.25-2.25h-4.318A2.25 2.25 0 0 1 9.568 3Z" />
                            </svg>
                            <span>About Us</span>
                        </a>
                    </li>
                </ul>

                <div class="flex flex-col my-1 gap-2 px-5">

                    <a href=""
                        class="text-slate-100 border transition-all duration-300 hover:text-white text-decoration-none border-gray-300 focus:outline-none hover:bg-[#828a00] focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-md px-2 py-2.5">
                        List Our Tours
                    </a>
                    @auth
                    <a href="{{ route('home') }}"
                        class="text-slate-800 border bg-slate-100 transition-all duration-300 hover:text-white text-decoration-none border-gray-300 focus:outline-none hover:bg-[#828a00] focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-md px-3 py-2.5">
                        My Account
                    </a>
                    <a href="{{ route('logout') }}"
                        class="text-slate-800 border bg-slate-100 transition-all duration-300 hover:text-white text-decoration-none border-gray-300 focus:outline-none hover:bg-[#828a00] focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-md px-3 py-2.5">
                        Logout
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                        class="text-slate-800 border bg-slate-100 transition-all duration-300 hover:text-white text-decoration-none border-gray-300 focus:outline-none hover:bg-[#828a00] focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-md px-3 py-2.5">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}"
                        class="text-slate-800 border bg-slate-100 transition-all duration-300 hover:text-white text-decoration-none border-gray-300 focus:outline-none hover:bg-[#828a00] focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-md px-3 py-2.5">
                        Register
                    </a>
                    @endauth
                </div>
            </div>

            <!-- hidden on small screen -->
            <div class="hidden lg:flex justify-between w-full gap-2">
                <div>
                    <a href="{{ route('index') }}"
                        class="text-white text-decoration-none text-xl font-bold flex items-center">
                        <div class="w-14 h-14 "> <img class="w-full h-full" src="{{ asset('./img/logo.png') }}"
                                alt="logo" /></div>
                        <!--<span>Compass.com</span>-->
                    </a>
                </div>
                <ul class="flex items-center gap-2 p-0">
                    <li>
                        <a href="{{ route('index') }}"
                            class="p-2 rounded-full text-decoration-none border-1 border-white text-sm flex gap-1 hover:text-white items-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span>Home</span></a>
                    </li>
                    <li>
                        <a href="{{ route('tours') }}"
                            class="p-2 rounded-full text-decoration-none hover:bg-green-700  text-sm flex gap-1 hover:text-white items-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            <span>Tours</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                            class="p-2 rounded-full text-decoration-none hover:bg-green-700  text-sm flex gap-1 hover:text-white items-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 0 0 3.182-3.183L6.5 7.568V5.25a2.25 2.25 0 0 0-2.25-2.25h4.318a2.25 2.25 0 0 1 2.25 2.25v4.318a2.25 2.25 0 0 0 2.25 2.25h4.318a2.25 2.25 0 0 0 2.25-2.25v-4.318a2.25 2.25 0 0 0-2.25-2.25h-4.318A2.25 2.25 0 0 1 9.568 3Z" />
                            </svg>
                            <span>Contact Us</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about_us') }}"
                            class="p-2 rounded-full text-decoration-none hover:bg-green-700  text-sm flex gap-1 hover:text-white items-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 0 0 3.182-3.183L6.5 7.568V5.25a2.25 2.25 0 0 0-2.25-2.25h4.318a2.25 2.25 0 0 1 2.25 2.25v4.318a2.25 2.25 0 0 0 2.25 2.25h4.318a2.25 2.25 0 0 0 2.25-2.25v-4.318a2.25 2.25 0 0 0-2.25-2.25h-4.318A2.25 2.25 0 0 1 9.568 3Z" />
                            </svg>
                            <span>About Us</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid ">

        @yield('content')

        {{-- <!-------------Footer---------------------> --}}
        <div id="home-page" class="bg-gray-100">
            <div class="lg:max-w-[1110px] w-[90%] mx-auto  pt-16 pb-8">
                <div class="grid lg:grid-cols-5 md:grid-cols-3 grid-cols-1 gap-4">
                    <!-- Support Section -->
                    <div>
                        <h1 class="lg:text-lg text-md font-semibold">Support</h1>
                        <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Coronavirus (COVID-19) FAQs</a>
                            </li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Manage your trips</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Contact Customer Service</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Safety Resource Center</a></li>
                        </ul>
                    </div>

                    <!-- Discovers Section -->
                    <div>
                        <h1 class="lg:text-lg text-md font-semibold">Discovers</h1>
                        <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                            <!--<li><a href="/" class="text-gray-900 hover:text-gray-900">Genius loyalty program</a></li>-->
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Seasonal and holiday deals</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Travel Articles</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Compassmytrip.com for Business</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Traveller Review Awards</a></li>
                            <!--<li><a href="/" class="text-gray-900 hover:text-gray-900">Car rental</a></li>-->
                            <!--<li><a href="/" class="text-gray-900 hover:text-gray-900">Flight finder</a></li>-->
                            <!--<li><a href="/" class="text-gray-900 hover:text-gray-900">Restaurant reservations</a></li>-->
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Compassmytrip.com for Travel Agents</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Terms and settings Section -->
                    <div>
                        <h1 class="lg:text-lg text-md font-semibold">Terms and settings</h1>
                        <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                            <li><a href="{{ route('policy') }}" class="text-gray-900 hover:text-gray-900">Privacy & Policy</a></li>
                            <li><a href="{{ route('terms') }}" class="text-gray-900 hover:text-gray-900">Terms & conditions</a></li>
                            <li><a href="{{ route('refund') }}" class="text-gray-900 hover:text-gray-900">Refund Policy</a></li>
                            <li><a href="{{ route('terms') }}" class="text-gray-900 hover:text-gray-900">Modern Slavery Statement</a></li>
                            <li><a href="{{ route('terms') }}" class="text-gray-900 hover:text-gray-900">Human Rights Statement</a></li>
                        </ul>
                    </div>

                    <!-- Partners Section -->
                    <div>
                        <h1 class="lg:text-lg text-md font-semibold">Partners</h1>
                        <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Extranet login</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Partner help</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">List your Tour</a></li>
                            <li><a href="{{ route('register_company') }}" class="text-gray-900 hover:text-gray-900">Become an affiliate</a></li>
                        </ul>
                    </div>

                    <!-- About Section -->
                    <div>
                        <h1 class="lg:text-lg text-md font-semibold">About</h1>
                        <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                            <li><a href="{{ route('about_us') }}" class="text-gray-900 hover:text-gray-900">About Compassmytrip.com</a></li>
                            <li><a href="{{ route('about_us') }}" class="text-gray-900 hover:text-gray-900">How We Work</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Sustainability</a></li>
                            <!--<li><a href="/" class="text-gray-900 hover:text-gray-900">Press center</a></li>-->
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Careers</a></li>
                            <li><a href="/" class="text-gray-900 hover:text-gray-900">Investor relations</a></li>
                            <li><a href="{{ route('contact') }}" class="text-gray-900 hover:text-gray-900">Corporate contact</a></li>
                        </ul>
                    </div>
                </div>

                <div>
                    <p class="text-xs text-center mt-5">
                        Compassmytrip.com is a part of MTech Soft LLc. the world leader in online travel and related
                        services.</p>
                    <p class="text-xs text-center mt-1">Copyright © compassmytrip.com™. All rights reserved.</p>
                </div>

            </div>
        </div>

    </div>


    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    
    <script>
        setTimeout(function() {
         $('#SessionMessage').remove();
        }, 3000); 
    </script>
    
    <script>
        function addToFavourites(itemid) {
            var item_id = itemid;
            var _token ="{{ csrf_token() }}";
            
            $.ajax({
               type:'POST',
               url:"{{ route('user.addfavourite') }}",
               data:{_token:_token, item_id:item_id},
               dataType: 'JSON',
               success:function(response){
                   
                     $('.addfavourites' + item_id).css({
                        'color': '#ffffff'
                    });  
                    
                }
            });
        }
    </script>
    <script>
        function removeFavourites(itemid) {
            var item_id = itemid;
            var _token ="{{ csrf_token() }}";
            
            
            $.ajax({
               type:'POST',
               url:"{{ route('user.addfavourite') }}",
               data:{_token:_token, item_id:item_id},
               dataType: 'JSON',
               success:function(response){
                   
                     $('.addfavourites' + item_id).css({
                        'color': '#212529'
                    }); 
                }
            });
        }
    </script>

    <!-- JavaScript to handle mobile menu toggle -->
    <script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        var menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    // pkr currency Modal script
    const openModalButton = document.getElementById("openModal");
    const currencyModal = document.getElementById("currencyModal");
    const closeModalButton = document.getElementById("closeModal");
    const currencyOptions = document.querySelectorAll("#currencyOptions button");


    // openModalButton.addEventListener("click", (event) => {
    //     event.stopPropagation();
    //     currencyModal.classList.remove("hidden");
    //     document.body.style.overflow = "hidden";
    // });


    // closeModalButton.addEventListener("click", () => {
    //     currencyModal.classList.add("hidden");
    //     document.body.style.overflow = "";
    // });

    currencyOptions.forEach((option) => {
        option.addEventListener("click", () => {
            const selectedCurrency = option.dataset.value;
            openModalButton.textContent = selectedCurrency;
            currencyModal.classList.add("hidden");
            document.body.style.overflow = "";
        });
    });

    window.addEventListener("click", (event) => {
        if (event.target === currencyModal) {
            currencyModal.classList.add("hidden");
            document.body.style.overflow = "";
        }
    });

    // pkr currency Modal script end
    </script>
    @yield('script')
</body>

</html>