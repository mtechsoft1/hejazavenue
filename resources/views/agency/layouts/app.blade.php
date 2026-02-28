<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="{{ asset('img/fav_icon.png') }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/locdetails.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}" />

    @yield('style')

</head>

<style>
        a {
        text-decoration: none !important;
    }
</style>

<body>

    <div id="agency-page" class="w-100 bg-[#009900] text-white p-3 flex justify-center flex-col items-center gap-6">
        <div class="w-[90vw] text-white flex justify-center flex-col items-center gap-2">
            <div class="flex lg:justify-end justify-between w-full items-center">
                <div class="hidden lg:flex items-center gap-2">
                    {{-- <a class=" text-sm  py-2 px-4 me-3  border text-decoration-none cursor-pointer rounded">
                        <p class="text-white">List our tours </p>
                    </a> --}}
                    @auth
                    <a href="{{ route('home') }}"
                        class="bg-white text-[#009900] text-sm p-2 rounded text-decoration-none cursor-pointer hover:text-[#009900]">
                        <p>My Account</p>
                    </a>
                    <a href="{{ route('logout') }}"
                        class="bg-white text-[#009900] text-sm p-2 rounded text-decoration-none cursor-pointer hover:text-[#009900]">
                        <p>Logout</p>
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                        class="bg-white text-[#009900] text-sm p-2 rounded text-decoration-none cursor-pointer hover:text-[#009900]">
                        <p>Sign In</p>
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-white text-[#009900] text-sm p-2 rounded text-decoration-none cursor-pointer hover:text-[#009900]">
                        <p>Register</p>
                    </a>
                    @endauth
                </div>

                <div class="lg:hidden">
                    <a href="/" class="text-white text-decoration-none text-xl font-bold flex items-center">
                        <div class="w-[60px] h-[100px] "> <img class="w-full h-full object-contain" src="{{ asset('./img/logo.png') }}"
                                 alt="logo" /></div>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="menu-toggle"
                    class="lg:hidden text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm p-2">

                    <!-- Toggle icon for mobile menu -->

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
                        <a href="https://hejazavenue.com/compass/public"
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
                            <span>Properties</span>
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
                            <span>Apartments</span>
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
                            <span>Maps</span>
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
                </ul>

                <div class="flex flex-col my-1 gap-2 px-5">

                    <a href="{{ route('tours') }}"
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
            <div class="hidden lg:flex justify-between w-full gap-2 mt-2">
                <div>
                    <a href="{{ route('home') }}"
                        class="text-white text-decoration-none text-xl font-bold flex items-center">
                        <div class="w-[60px] h-[100px] "> <img class="w-full h-full object-contain" src="{{ asset('./img/logo.jpeg') }}"
                                 alt="logo" /></div>
                    </a>
                </div>
                <ul class="flex items-center gap-2 p-0">
                    <li>
                        <a href="https://hejazavenue.com/compass/public"
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
                            <span>Properties</span>
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
                            <span>Apartments</span>
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
                            <span>Maps</span>
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
                        <a href="{{ route('register_company') }}"
                            class="p-2 rounded-full text-decoration-none hover:bg-green-700  text-sm flex gap-1 hover:text-white items-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 0 0 3.182-3.183L6.5 7.568V5.25a2.25 2.25 0 0 0-2.25-2.25h4.318a2.25 2.25 0 0 1 2.25 2.25v4.318a2.25 2.25 0 0 0 2.25 2.25h4.318a2.25 2.25 0 0 0 2.25-2.25v-4.318a2.25 2.25 0 0 0-2.25-2.25h-4.318A2.25 2.25 0 0 1 9.568 3Z" />
                            </svg>
                            <span>Create Tour</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="tour-img">
        <div class="tour-img-overlay"></div>
        <div class="tour-text">
            <h2 class="lg:text-5xl text-4xl">@yield('title')</h2>
            <div class="link-div"><a href="{{ route('home') }}">Home</a>/@yield('title')</div>
        </div>
    </div>
<div class="bg-gray-200 py-10">
    <div class="mx-auto w-[90vw]">
        <div class="md:grid md:grid-cols-12 gap-5">
            <div class="col-span-3 bg-white rounded-md shadow-lg py-16  md:px-4 px-2">
                <ul>
                    <a class="no-underline " href="{{ route('agency.dashboard') }}">
                        <li class=" @if (Request::routeIs('agency.dashboard')) bg-[#008000] text-white @endif hover:bg-green-600 rounded-md  hover:text-white text-[#1a1a1a] text-lg p-2">
                            Profile
                        </li>
                    </a>
                        <a class="no-underline" href="{{ route('agency.createtour') }}">
                            <li class=" @if (Request::routeIs('agency.createtour')) bg-[#008000] text-white @endif mt-2 hover:bg-green-600 rounded-md hover:text-white text-[#1a1a1a] text-lg p-2">
                                Create Tour
                            </li>
                        </a>
                        <a class="no-underline" href="{{ route('agency.mytour') }}">
                            <li class="@if (Request::routeIs('agency.mytour')) bg-[#008000] text-white @endif mt-2 hover:bg-green-600 rounded-md hover:text-white text-[#1a1a1a] text-lg p-2">
                                MyTours
                            </li>
                        </a>
                        <a class="no-underline" href="{{ route('agency.my_bookings') }}">
                            <li class="@if (Request::routeIs('agency.my_bookings') || Request::routeIs('agency.tour_bookings')) bg-[#008000] text-white @endif mt-2 hover:bg-green-600 rounded-md hover:text-white text-[#1a1a1a] text-lg p-2">
                                Tour Bookings
                            </li>
                        </a>
                        <a class="no-underline" href="{{ route('agency.change_password') }}">
                            <li class="@if (Request::routeIs('agency.change_password')) bg-[#008000] text-white @endif mt-2 hover:bg-green-600 rounded-md hover:text-white text-[#1a1a1a] text-lg p-2">
                                Change Password
                            </li>
                        </a>
                        <a class="no-underline" href="{{ route('logout') }}">
                            <li class="@if (Request::routeIs('agency.logout')) bg-[#008000] text-white @endif mt-2 hover:bg-green-600 rounded-md hover:text-white text-[#1a1a1a] text-lg p-2">
                                Logout
                            </li>
                        </a>
                </ul>
            </div>

            <div class="col-span-9">
                @yield('content')
            </div>
        </div>
    </div>
</div>

    <div id="agency-page" class="bg-gray-100">
        <div class="w-[90vw] mx-auto  pt-16 pb-8">
            <div class="grid lg:grid-cols-5 md:grid-cols-3 grid-cols-1 gap-4">
                <!-- Support Section -->
                <div>
                    <h1 class="lg:text-lg text-md font-semibold">Support</h1>
                    <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Coronavirus (COVID-19) FAQs</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Manage your trips</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Contact Customer Service</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Safety Resource Center</a></li>
                    </ul>
                </div>

                <!-- Discovers Section -->
                <div>
                    <h1 class="lg:text-lg text-md font-semibold">Discovers</h1>
                    <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Genius loyalty program</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Seasonal and holiday deals</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Travel articles</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Booking.com for Business</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Traveller Review Awards</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Car rental</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Flight finder</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Restaurant reservations</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Booking.com for Travel Agents</a></li>
                    </ul>
                </div>

                <!-- Terms and settings Section -->
                <div>
                    <h1 class="lg:text-lg text-md font-semibold">Terms and settings</h1>
                    <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                        <li><a href="{{ route('about_us') }}" class="text-gray-900 hover:text-gray-900">Privacy &
                                cookies</a>
                        </li>
                        <li><a href="{{ route('policy') }}" class="text-gray-900 hover:text-gray-900">Terms &
                                conditions</a></li>
                        <li><a href="{{ route('refund') }}" class="text-gray-900 hover:text-gray-900">Partner
                                dispute</a></li>
                        <li><a href="{{ route('terms') }}" class="text-gray-900 hover:text-gray-900">Modern Slavery
                                Statement</a></li>
                        <li><a href="{{ route('terms') }}" class="text-gray-900 hover:text-gray-900">Human Rights
                                Statement</a></li>
                    </ul>
                </div>

                <!-- Partners Section -->
                {{--
                <div>
                    <h1 class="lg:text-lg text-md font-semibold">Partners</h1>
                    <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Extranet login</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Partner help</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">List your property</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Become an affiliate</a></li>
                    </ul>
                </div>
                --}}

                <!-- About Section -->
                <div>
                    <h1 class="lg:text-lg text-md font-semibold">About</h1>
                    <ul class="list-none space-y-2 px-0 pt-2 lg:text-md text-sm">
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">About Booking.com</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">How We Work</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Sustainability</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Press center</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Careers</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Investor relations</a></li>
                        <li><a href="/" class="text-gray-900 hover:text-gray-900">Corporate contact</a></li>
                    </ul>
                </div>
            </div>

                <div>
                    <p class="text-xs text-center mt-5">
                        hejaz avenue.com is a part of MTech Soft LLc. the world leader in online travel and related
                        services.</p>
                    <p class="text-xs text-center mt-1">Copyright © hejaz avenue.com™. All rights reserved.</p>
                </div>

        </div>
    </div>

    {{-- Font Awesome: use CDN in head, kit removed (403) --}}
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
    document.getElementById('menu-toggle').addEventListener('click', function() {
        var menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
    </script>
    @yield('script')
</body>

</html>