@extends('layouts.app')
@section('title')
    Compass Tour
@endsection
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,container-queries"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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
            /*background-color: #1748a0;*/
            padding: 12px 78px;
            border-radius: 30px;
            font-size: 16px;
        }

        .loader {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left: 4px solid #3498db;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Best services slider cards style */

        /* Additional CSS for styling pagination dots */
        .swiper-pagination {
            text-align: center;
            /* Center the dots */
        }

        .swiper-pagination-bullet {
            background: #4f46e5;
            /* Customize the bullet color */
        }

        .swiper-pagination-bullet-active {
            background: #3b82f6;
            /* Active bullet color */
        }

        /* Best services slider cards style end */
        /* Popular Destination style code */

        #image-slider {
            display: flex;
            transition: transform 0.5s ease-in-out;

        }

        #planner-image-slider {
            display: flex;
            transition: transform 0.5s ease-in-out;

        }

        .image-item {
            flex: 0 0 auto;

        }


        #prev,
        #next {
            z-index: 10;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #planner-prev,
        #planner-next {
            z-index: 10;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }


        .relative {
            position: relative;
            overflow: hidden;
        }


        .image-item img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        /* cutomer testinominals */

        .swiper-button-next,
        .swiper-button-prev {
            color: #007bff;
        }

        .swiper-pagination-bullet-active {
            background-color: #007bff;
        }


        .swiper-button-next {
            background: white;
            color: black;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 50%;
            right: -20px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.4);
        }

        .swiper-button-next:after {
            font-size: 18px
        }

        .swiper-button-prev {
            background: white;
            color: black;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 50%;
            left: -20px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.4);
        }

        .swiper-button-prev:after {
            font-size: 18px
        }

        .swiper-container-wrapper {
            position: relative;
            width: 100%;
        }
    </style>

    <!-- Show the success message -->
    @if (session()->has('success'))
        <div class="container md:w-1/3 mt-4 p-4 mb-4 text-sm text-[#008000] rounded-lg bg-green-100" role="alert">
            <span class="font-medium">Success alert!</span> {{ session()->get('success') }}
        </div>
    @endif



    <div class="container-fluid relative z-0">
        <div class=" w-full min-h-[600px] relative flex flex-col z-0">
            <!-- Background image section -->
            <!-- <div class="row background-img relative flex justify-center w-full">
                                                                </div> -->

            <!-- Hero Video Background -->
            <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0">
                <source src="{{ asset('gallary_videos/Video2.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>

        </div>

        <!-- Booking.com Style Search Bar -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <div class="w-full relative z-10 -mt-10 mb-12" x-data="bookingSearch()">
            <div class="lg:max-w-[1110px] w-[90vw] mx-auto">
                <div class="bg-[#ffb700] p-1 rounded-[4px] shadow-2xl">
                    <form action="{{ route('search_tours') }}" method="post"
                        class="grid grid-cols-1 lg:grid-cols-12 gap-1">
                        @csrf

                        <!-- Destination Input -->
                        <div class="lg:col-span-4 relative bg-white rounded-[4px]" @click.outside="destOpen = false">
                            <div
                                class="flex items-center px-3 h-14 border-2 border-transparent focus-within:border-[#ffb700] rounded-[4px] bg-white transition-colors">
                                <i class="fa fa-bed text-gray-400 text-lg mr-3"></i>
                                <input type="text" x-model="search" @focus="destOpen = true" name="destination"
                                    class="w-full h-full border-none outline-none focus:ring-0 text-gray-900 placeholder-gray-600 font-medium bg-transparent text-sm"
                                    placeholder="Where are you going?" autocomplete="off">
                                <input type="hidden" name="destination_id" x-model="destId">
                                <i x-show="search.length > 0" @click="search = ''; destId = ''"
                                    class="fa fa-times text-gray-400 cursor-pointer p-2 rounded-full hover:bg-gray-100"></i>
                            </div>

                            <!-- Destination Dropdown -->
                            <div x-show="destOpen" x-transition.opacity
                                class="absolute top-full left-0 w-full bg-white shadow-xl rounded-md mt-2 py-2 z-50 max-h-80 overflow-y-auto border border-gray-100">
                                <h4 class="px-4 py-2 text-xs font-bold text-gray-800 uppercase tracking-wider">Trending
                                    destinations</h4>
                                <ul class="list-none p-0 m-0">
                                    @foreach ($destinations as $destination)
                                        <li @click="search = '{{ $destination->destination_name }}'; destId = '{{ $destination->id }}'; destOpen = false"
                                            class="px-4 py-3 hover:bg-gray-50 cursor-pointer flex items-center gap-3 border-b border-gray-50 last:border-0 group">
                                            <i class="fa fa-map-marker text-gray-400 group-hover:text-[#008000]"></i>
                                            <div>
                                                <div class="font-bold text-gray-900">{{ $destination->destination_name }}
                                                </div>
                                                <div class="text-xs text-gray-500">Pakistan</div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Date Range Picker -->
                        <div class="lg:col-span-4 bg-white rounded-[4px]">
                            <div class="flex items-center px-3 h-14 border-2 border-transparent focus-within:border-[#ffb700] rounded-[4px] bg-white transition-colors cursor-pointer"
                                onclick="document.getElementById('date-range')._flatpickr.open()">
                                <i class="fa fa-calendar text-gray-400 text-lg mr-3"></i>
                                <input type="text" id="date-range" name="dates"
                                    class="w-full h-full border-none outline-none focus:ring-0 text-gray-900 placeholder-gray-600 font-medium cursor-pointer bg-transparent text-sm"
                                    placeholder="Check-in Date — Check-out Date">
                            </div>
                        </div>

                        <!-- Guests & Rooms -->
                        <div class="lg:col-span-3 relative bg-white rounded-[4px]" @click.outside="guestOpen = false">
                            <div class="flex items-center px-3 h-14 border-2 border-transparent focus-within:border-[#ffb700] rounded-[4px] bg-white transition-colors cursor-pointer"
                                @click="guestOpen = !guestOpen">
                                <i class="fa fa-user text-gray-400 text-lg mr-3"></i>
                                <div class="flex flex-col justify-center">
                                    <span class="text-gray-900 font-medium text-sm truncate"
                                        x-text="`${adults} adults · ${children} children · ${rooms} room`">2 adults · 0
                                        children · 1 room</span>
                                </div>
                                <i class="fa fa-chevron-down ml-auto text-xs text-gray-400"></i>
                            </div>

                            <!-- Guest Dropdown -->
                            <div x-show="guestOpen" x-transition style="display: none;"
                                class="absolute top-full left-0 w-[400px] bg-white shadow-xl rounded-md mt-2 p-6 z-50 border border-gray-100 text-[#1a1a1a]">

                                <!-- Adults -->
                                <div class="flex items-center justify-between mb-4">
                                    <label class="text-sm font-medium text-gray-900">Adults</label>
                                    <div class="flex items-center border border-gray-300 rounded-[4px] overflow-hidden">
                                        <button type="button" @click="if(adults > 1) adults--"
                                            class="w-10 h-9 flex items-center justify-center text-[#0071c2] hover:bg-blue-50 focus:outline-none focus:bg-blue-100 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                                            :disabled="adults <= 1"><i class="fa fa-minus text-xs"></i></button>
                                        <span class="w-10 text-center font-medium text-gray-900 text-sm"
                                            x-text="adults"></span>
                                        <button type="button" @click="adults++"
                                            class="w-10 h-9 flex items-center justify-center text-[#0071c2] hover:bg-blue-50 focus:outline-none focus:bg-blue-100 transition-colors"><i
                                                class="fa fa-plus text-xs"></i></button>
                                    </div>
                                </div>

                                <!-- Children -->
                                <div class="flex items-center justify-between mb-2">
                                    <label class="text-sm font-medium text-gray-900">Children</label>
                                    <div class="flex items-center border border-gray-300 rounded-[4px] overflow-hidden">
                                        <button type="button" @click="removeChild()"
                                            class="w-10 h-9 flex items-center justify-center text-[#0071c2] hover:bg-blue-50 focus:outline-none focus:bg-blue-100 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                                            :disabled="children <= 0"><i class="fa fa-minus text-xs"></i></button>
                                        <span class="w-10 text-center font-medium text-gray-900 text-sm"
                                            x-text="children"></span>
                                        <button type="button" @click="addChild()"
                                            class="w-10 h-9 flex items-center justify-center text-[#0071c2] hover:bg-blue-50 focus:outline-none focus:bg-blue-100 transition-colors"><i
                                                class="fa fa-plus text-xs"></i></button>
                                    </div>
                                </div>

                                <!-- Children Ages Dropdowns -->
                                <div x-show="children > 0" class="grid grid-cols-2 gap-3 mb-4">
                                    <template x-for="(age, index) in childrenAges" :key="index">
                                        <div class="mt-2">
                                            <select
                                                class="w-full p-2 text-sm border border-gray-300 rounded-[4px] focus:border-[#0071c2] focus:ring-1 focus:ring-[#0071c2] outline-none text-gray-700 bg-white">
                                                <option value="" disabled selected>Age needed</option>
                                                @for ($i = 0; $i <= 17; $i++)
                                                    <option value="{{ $i }}">{{ $i }} years old
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </template>
                                </div>

                                <div x-show="children > 0" class="text-xs text-gray-500 mb-4">
                                    To find you a place to stay that fits your entire group along with correct prices, we
                                    need to know how old your child will be at check-out
                                </div>


                                <!-- Rooms -->
                                <div class="flex items-center justify-between mb-6">
                                    <label class="text-sm font-medium text-gray-900">Rooms</label>
                                    <div class="flex items-center border border-gray-300 rounded-[4px] overflow-hidden">
                                        <button type="button" @click="if(rooms > 1) rooms--"
                                            class="w-10 h-9 flex items-center justify-center text-[#0071c2] hover:bg-blue-50 focus:outline-none focus:bg-blue-100 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                                            :disabled="rooms <= 1"><i class="fa fa-minus text-xs"></i></button>
                                        <span class="w-10 text-center font-medium text-gray-900 text-sm"
                                            x-text="rooms"></span>
                                        <button type="button" @click="rooms++"
                                            class="w-10 h-9 flex items-center justify-center text-[#0071c2] hover:bg-blue-50 focus:outline-none focus:bg-blue-100 transition-colors"><i
                                                class="fa fa-plus text-xs"></i></button>
                                    </div>
                                </div>

                                <!-- Pets Toggle -->
                                <div class="flex items-center justify-between mb-4 pt-4 border-t border-gray-100">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">Travelling with pets?</div>
                                        <div class="text-xs text-gray-500 mt-1">Assistance animals aren't considered pets.
                                        </div>
                                        <a href="#" class="text-xs text-[#0071c2] mt-0.5 block hover:underline">Read
                                            more about travelling with assistance animals</a>
                                    </div>
                                    <div
                                        class="relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in">
                                        <input type="checkbox" name="toggle" id="pets-toggle"
                                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearence-none cursor-pointer border-gray-300" />
                                        <label for="pets-toggle"
                                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 text-center">
                                    <button type="button" @click="guestOpen = false"
                                        class="w-full text-[#0071c2] border border-[#0071c2] px-4 py-2 rounded-[4px] hover:bg-blue-50 transition-colors text-sm font-bold">Done</button>
                                </div>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="lg:col-span-1">
                            <button type="submit"
                                class="w-full h-14 bg-[#0071c2] hover:bg-[#005999] text-white text-xl font-bold rounded-[4px] transition-colors shadow-sm">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <style>
            /* Custom Toggle Style */
            .toggle-checkbox:checked {
                right: 0;
                border-color: #0071c2;
            }

            .toggle-checkbox:checked+.toggle-label {
                background-color: #0071c2;
            }

            .toggle-checkbox {
                right: 0;
                z-index: 10;
            }

            .toggle-label {
                width: 100%;
                height: 100%;
            }

            /* Calendar Buttons Styling */
            .flatpickr-calendar .calendar-footer-buttons {
                display: flex;
                gap: 8px;
                padding: 10px;
                border-top: 1px solid #e6e6e6;
                margin-top: 10px;
                flex-wrap: wrap;
            }

            .flatpickr-calendar .cal-btn {
                background: #fff;
                border: 1px solid #e7e7e7;
                border-radius: 4px;
                /* Booking.com rounded pill style roughly or square */
                padding: 5px 10px;
                font-size: 12px;
                color: #1a1a1a;
                cursor: pointer;
                transition: all 0.2s;
                font-weight: 500;
                border-radius: 20px;
                flex: 1;
                text-align: center;
            }

            .flatpickr-calendar .cal-btn:hover {
                background: #f0f6fd;
                border-color: #0071c2;
                color: #0071c2;
            }

            .flatpickr-calendar .cal-btn.active {
                background: #0071c2;
                color: white;
                border-color: #0071c2;
            }
        </style>

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                flatpickr("#date-range", {
                    mode: "range",
                    minDate: "today",
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "D, M d",
                    showMonths: 2,
                    onReady: function(selectedDates, dateStr, instance) {
                        const footer = document.createElement("div");
                        footer.className = "calendar-footer-buttons";
                        footer.innerHTML = `
                        <button type="button" class="cal-btn active">Exact dates</button>
                        <button type="button" class="cal-btn">± 1 day</button>
                        <button type="button" class="cal-btn">± 2 days</button>
                        <button type="button" class="cal-btn">± 3 days</button>
                        <button type="button" class="cal-btn">± 7 days</button>
                    `;

                        // Add click handlers for visually toggling active state
                        const btns = footer.querySelectorAll('.cal-btn');
                        btns.forEach(btn => {
                            btn.addEventListener('click', function(e) {
                                e.stopPropagation(); // Prevent calendar from closing
                                btns.forEach(b => b.classList.remove('active'));
                                this.classList.add('active');
                            });
                        });

                        instance.calendarContainer.appendChild(footer);
                    }
                });
            });

            // Register Alpine Data
            document.addEventListener('alpine:init', () => {
                Alpine.data('bookingSearch', () => ({
                    destOpen: false,
                    guestOpen: false,
                    search: '',
                    destId: '',
                    adults: 2,
                    children: 0,
                    rooms: 1,
                    childrenAges: [],

                    addChild() {
                        this.children++;
                        this.childrenAges.push('');
                    },

                    removeChild() {
                        if (this.children > 0) {
                            this.children--;
                            this.childrenAges.pop();
                        }
                    }
                }));
            });
        </script>

        <!--new code of our best services-->
        <!-- Include Swiper.js CDN -->

        <!--
                                                            <div id="service" class="services py-10  relative">
                                                                <div class="service-div text-center mb-2">
                                                                    <div class="max-w-[1110px] w-[90vw] mx-auto ps-2">
                                                                    <h2 class="text-2xl font-bold text-start">
                                                                    Offers
                                                                    </h2>
                                                                        <p class="block text-md text-[#595959] text-start ">Most popular choices for Tourest from Pakistan</p>

                                                                    </div>
                                                                </div>

                                                                <div class="mx-auto lg:max-w-[1110px] w-[90vw]">
                                                                    <div class="swiper mySwiper">
                                                                        <div class="swiper-wrapper">
                                                                            @foreach ($destinations as $index => $destination)
    <div class="swiper-slide @if ($index = 1) flex justify-between items-center @endif">
                                                                                <div
                                                                                    class="w-full gap-5 shadow-md bg-white flex flex-col md:flex-row justify-between items-center p-2 rounded-lg border border-1">
                                                                                    <div class="w-full md:w-3/4">
                                                                                        <h3 class="text-xl font-semibold text-[#1a1a1a]">{{ $destination->destination_name }}
                                                                                        </h3>
                                                                                        <p class="mt-2 text-[#595959] md:text-md text-sm">
                                                                                            {{ $destination->destination_desc }}
                                                                                        </p>
                                                                                        <div class="mt-2">
                                                                                            <button class="bg-[#008000] px-3 py-2 rounded-md text-white lg:text-md text-sm">Save 15% or more</button>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="w-full md:w-1/5 flex justify-center md:justify-end">
                                                                                        <img class="w-auto md:h-[100px] h-[100px] rounded-xl  object-cover"
                                                                                            src="{{ asset(str_replace('public/', '', $destination->destination_image)) }}"
                                                                                            alt="{{ $destination->destination_name }}" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
    @endforeach

                                                                        </div>
                                                                    </div>

                                                                    <div class="swiper-pagination mt-6 flex justify-center absolute bottom-10"></div>
                                                                </div>

                                                            </div>
                                                            -->

        <!------------------Our Complete Services------------------>
        <div class="py-16 bg-white relative">
            <div class="lg:max-w-[1110px] w-[90vw] mx-auto text-center">

                <!-- Heading Section -->
                <div class="mb-12">
                    <h2 class="text-4xl font-serif font-bold text-[#1a1a1a] mb-4">Our Complete Services</h2>
                    <p class="text-[#595959] text-lg max-w-2xl mx-auto font-light">
                        Everything you need for a blessed pilgrimage, thoughtfully arranged and delivered with excellence.
                    </p>
                </div>

                <!-- Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <!-- Card 1: Airport Pickup -->
                    <div
                        class="group bg-stone-50 p-8 rounded-2xl border border-gray-100 hover:border-transparent hover:shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] transition-all duration-300 transform hover:-translate-y-2 cursor-pointer flex flex-col items-start text-left h-full">
                        <div
                            class="w-16 h-16 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fa fa-plane text-2xl"></i>
                        </div>
                        <h3 class="text-[#1a1a1a] mb-3 group-hover:text-[#008000] transition-colors"
                            style="font-family: 'Didot', serif; font-size: 1.5rem; font-weight: 600; line-height: 1.4;">
                            Airport Pickup & Drop-off</h3>
                        <p class="text-[#595959] text-sm leading-relaxed">
                            Seamless transfers from arrival to departure with professional drivers
                        </p>
                    </div>

                    <!-- Card 2: Apartments & Villas -->
                    <div
                        class="group bg-stone-50 p-8 rounded-2xl border border-gray-100 hover:border-transparent hover:shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] transition-all duration-300 transform hover:-translate-y-2 cursor-pointer flex flex-col items-start text-left h-full">
                        <div
                            class="w-16 h-16 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fa fa-home text-2xl"></i>
                        </div>
                        <h3 class="text-[#1a1a1a] mb-3 group-hover:text-[#008000] transition-colors"
                            style="font-family: 'Didot', serif; font-size: 1.5rem; font-weight: 600; line-height: 1.4;">
                            Apartments & Villas</h3>
                        <p class="text-[#595959] text-sm leading-relaxed">
                            Premium accommodations near holy sites with all amenities
                        </p>
                    </div>

                    <!-- Card 3: Maid & Optional Chef -->
                    <div
                        class="group bg-stone-50 p-8 rounded-2xl border border-gray-100 hover:border-transparent hover:shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] transition-all duration-300 transform hover:-translate-y-2 cursor-pointer flex flex-col items-start text-left h-full">
                        <div
                            class="w-16 h-16 bg-amber-50 rounded-xl flex items-center justify-center mb-6 text-amber-700 group-hover:scale-110 transition-transform duration-300">
                            <i class="fa fa-users text-2xl"></i>
                        </div>
                        <h3 class="text-[#1a1a1a] mb-3 group-hover:text-[#008000] transition-colors"
                            style="font-family: 'Didot', serif; font-size: 1.5rem; font-weight: 600; line-height: 1.4;">
                            Maid & Optional Chef</h3>
                        <p class="text-[#595959] text-sm leading-relaxed">
                            Dedicated housekeeping and optional culinary services
                        </p>
                    </div>

                    <!-- Card 4: Car Rentals -->
                    <div
                        class="group bg-stone-50 p-8 rounded-2xl border border-gray-100 hover:border-transparent hover:shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] transition-all duration-300 transform hover:-translate-y-2 cursor-pointer flex flex-col items-start text-left h-full">
                        <div
                            class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center mb-6 text-blue-700 group-hover:scale-110 transition-transform duration-300">
                            <i class="fa fa-car text-2xl"></i>
                        </div>
                        <h3 class="text-[#1a1a1a] mb-3 group-hover:text-[#008000] transition-colors"
                            style="font-family: 'Didot', serif; font-size: 1.5rem; font-weight: 600; line-height: 1.4;">Car
                            Rentals with Drivers</h3>
                        <p class="text-[#595959] text-sm leading-relaxed">
                            Comfortable vehicles with experienced, licensed drivers
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <!--end-->

        <!------------------ Premium Accommodations (below Our Complete Services) ------------------>
        <style>
            .accommodation-card { border: 1px solid #e5e7eb; }
            .accommodation-card:hover { border: 2px solid #86efac; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.08); }
            .amenity-icon { width: 2.25rem; height: 2.25rem; display: inline-flex; align-items: center; justify-content: center; border-radius: 0.5rem; background: #f5f5f4; color: #57534e; transition: all 0.2s; }
            .amenity-icon:hover { border: 2px solid #86efac; background: #ecfdf5; color: #0f7c5c; }
        </style>
        <section class="py-16 sm:py-20 bg-white">
            <div class="lg:max-w-[1110px] w-[90vw] mx-auto px-4 sm:px-6">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-serif font-bold text-[#1a1a1a] mb-4">Premium Accommodations</h2>
                    <p class="text-[#595959] text-lg max-w-2xl mx-auto font-light">
                        Handpicked apartments and villas near Masjid an-Nabawi, fully managed by our professional staff.
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card 1: Deluxe Apartment -->
                    <a href="{{ route('accommodation.detail', 'deluxe-apartment') }}" class="group block accommodation-card bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden text-left">
                        <div class="relative h-52 bg-stone-200 overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fa fa-bed text-5xl text-stone-400"></i>
                            </div>
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md bg-[#1a1a1a] text-white text-xs font-medium">Guest Favorite</span>
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-[#1a1a1a] mb-2" style="font-family: Georgia, serif;">Deluxe Apartment</h3>
                            <p class="text-sm text-[#595959] mb-1 flex items-center gap-1.5"><i class="fa fa-map-marker text-[#1a1a1a]"></i> 500m from Masjid an-Nabawi</p>
                            <p class="text-sm text-[#595959] mb-3 flex items-center gap-1.5"><i class="fa fa-users text-[#1a1a1a]"></i> 4-6 People</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="amenity-icon" title="3 Bedrooms"><i class="fa fa-bed text-sm"></i></span>
                                <span class="amenity-icon" title="Full Kitchen"><i class="fa fa-cutlery text-sm"></i></span>
                                <span class="amenity-icon" title="Living Room"><i class="fa fa-television text-sm"></i></span>
                                <span class="amenity-icon" title="WiFi"><i class="fa fa-wifi text-sm"></i></span>
                                <span class="amenity-icon" title="AC"><i class="fa fa-thermometer-half text-sm"></i></span>
                            </div>
                            <p class="text-lg font-bold text-[#0f7c5c]">SAR 800<span class="text-gray-500 font-normal text-sm">/night</span></p>
                        </div>
                    </a>
                    <!-- Card 2: Family Apartment -->
                    <a href="{{ route('accommodation.detail', 'family-apartment') }}" class="group block accommodation-card bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden text-left">
                        <div class="relative h-52 bg-stone-200 overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fa fa-home text-5xl text-stone-400"></i>
                            </div>
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md bg-[#1a1a1a] text-white text-xs font-medium">Spacious</span>
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-[#1a1a1a] mb-2" style="font-family: Georgia, serif;">Family Apartment</h3>
                            <p class="text-sm text-[#595959] mb-1 flex items-center gap-1.5"><i class="fa fa-map-marker text-[#1a1a1a]"></i> 800m from Masjid an-Nabawi</p>
                            <p class="text-sm text-[#595959] mb-3 flex items-center gap-1.5"><i class="fa fa-users text-[#1a1a1a]"></i> 6-8 People</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="amenity-icon" title="Bedrooms"><i class="fa fa-bed text-sm"></i></span>
                                <span class="amenity-icon" title="Full Kitchen"><i class="fa fa-cutlery text-sm"></i></span>
                                <span class="amenity-icon" title="Living Room"><i class="fa fa-television text-sm"></i></span>
                                <span class="amenity-icon" title="WiFi"><i class="fa fa-wifi text-sm"></i></span>
                                <span class="amenity-icon" title="AC"><i class="fa fa-thermometer-half text-sm"></i></span>
                            </div>
                            <p class="text-lg font-bold text-[#0f7c5c]">SAR 1,200<span class="text-gray-500 font-normal text-sm">/night</span></p>
                        </div>
                    </a>
                    <!-- Card 3: Premium Villa -->
                    <a href="{{ route('accommodation.detail', 'premium-villa') }}" class="group block accommodation-card bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden text-left">
                        <div class="relative h-52 bg-stone-200 overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fa fa-flag text-5xl text-stone-400"></i>
                            </div>
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md bg-[#1a1a1a] text-white text-xs font-medium">Luxury</span>
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-[#1a1a1a] mb-2" style="font-family: Georgia, serif;">Premium Villa</h3>
                            <p class="text-sm text-[#595959] mb-1 flex items-center gap-1.5"><i class="fa fa-map-marker text-[#1a1a1a]"></i> 1km from Masjid an-Nabawi</p>
                            <p class="text-sm text-[#595959] mb-3 flex items-center gap-1.5"><i class="fa fa-users text-[#1a1a1a]"></i> 8-12 People</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="amenity-icon" title="Bedrooms"><i class="fa fa-bed text-sm"></i></span>
                                <span class="amenity-icon" title="Full Kitchen"><i class="fa fa-cutlery text-sm"></i></span>
                                <span class="amenity-icon" title="Living Room"><i class="fa fa-television text-sm"></i></span>
                                <span class="amenity-icon" title="WiFi"><i class="fa fa-wifi text-sm"></i></span>
                                <span class="amenity-icon" title="AC"><i class="fa fa-thermometer-half text-sm"></i></span>
                            </div>
                            <p class="text-lg font-bold text-[#0f7c5c]">SAR 2,500<span class="text-gray-500 font-normal text-sm">/night</span></p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!---------------Our Best Packages-------------->
        <div id="package" class="packages lg:max-w-[1110px] w-[90vw] mx-auto mt-3">
            <div>
                <div class="flex flex-col items-center justify-center text-center">
                    <div class="package-div">
                        <h2 class="text-2xl font-bold pt-2">Our Most Popular Packages</h2>
                        <p class="text-md font-normal mt-2 text-[#595959] mb-4">Browse through our most popular tours!</p>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('tours') }}">
                            <button
                                class="text-sm font-normal border border-[#008000] px-4 py-1 text-[#008000] rounded-lg hover:bg-green-50 transition-colors">See
                                All</button>
                        </a>
                    </div>
                </div>

                <!-- Swiper Container -->
                <div class="swiper-container-wrapper mostPopularSwiper-btn">
                    <div class="swiper mostPopularSwiper mt-1">
                        <div class="swiper-wrapper">
                            @foreach ($tours as $tour)
                                <div class="swiper-slide border rounded-lg  shadow-sm ">
                                    <div class="relative flex flex-col shadow-md rounded-lg transition duration-300">
                                        <i
                                            class="material-icons cursor-pointer text-[#1a1a1a] text-[18px] absolute top-3 right-3 bg-white p-2 rounded-full">favorite_border</i>
                                        <a href="{{ route('tour_details', $tour->id) }}"
                                            class="rounded-lg text-decoration-none text-surface hover:text-black">
                                            <img class="rounded-lg w-full h-[210px] object-cover"
                                                src="{{ asset($tour->trip_image) }}" alt="{{ $tour->trip_name }}" />

                                            <div class="p-3 flex flex-col gap-3">
                                                <h5 class="mb-2 text-sm font-bold leading-tight">{{ $tour->trip_name }}
                                                </h5>
                                                <div class="flex items-center justify-start gap-3">
                                                    @if ($tour->pickup_points)
                                                        <p class="text-[#595959] flex items-center">
                                                            <span
                                                                class="material-icons text-[#008000] me-1">location_on</span>
                                                            {{ $tour->pickup_points->pickup_city }}
                                                        </p>
                                                    @endif
                                                    <h5 class="text-sm font-normal text-[#595959] leading-tight">
                                                        <span class="font-bold">Tour Date: </span>
                                                        {{ \Carbon\Carbon::parse($tour->trip_start_date)->format('d-m-y') }}
                                                    </h5>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    @if ($tour->rating)
                                                        <span
                                                            class="bg-[#009900] text-white p-1 text-sm rounded">{{ $tour->rating }}</span>
                                                        <p class="text-sm">Good</p>
                                                        <small class="text-gray-500">({{ $tour->reviews_count }}
                                                            Reviews)</small>
                                                    @endif
                                                </div>
                                                <div class="flex justify-between gap-1 items-center">
                                                    <h5 class="text-sm font-normal text-gray-500 leading-tight">
                                                        {{ $tour->trip_duration }}
                                                    </h5>
                                                    <div class="flex flex-col text-right">
                                                        <h1 class="text-md font-bold">
                                                            {{ $tour->pickup_points->per_seat_fare_currency ?? 'PKR' }}
                                                            {{ $tour->pickup_points->per_seat_fare ?? '0.00' }}
                                                        </h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>

            </div>
        </div>


        <section class="w-full py-20 bg-gradient-to-br from-emerald-50 to-teal-50">
            <div class="max-w-7xl mx-auto px-6 text-center">

                <!-- Heading -->
                <h2 class="text-[48px] font-serif font-semibold text-gray-800">
                    Why Pilgrims Trust Us
                </h2>

                <!-- Subtitle -->
                <p class="mt-4 text-[20px] text-gray-600">
                    Your comfort, safety, and spiritual experience are our highest priorities.
                </p>

                <!-- Cards Wrapper -->
                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">

                    <!-- Card 1 -->
                    <div class="bg-white rounded-2xl p-6 text-center shadow-lg border border-emerald-100">

                        <!-- Icon Circle -->
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-emerald-600 to-teal-700 rounded-full flex items-center justify-center mx-auto mb-6 mt-8">
                            <!-- Shield Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3l7 4v5c0 5-3.5 9-7 9s-7-4-7-9V7l7-4z" />
                            </svg>
                        </div>

                        <h3 class="text-stone-800 mb-2"
                            style="font-family: 'Didot', serif; font-size: 1.5rem; font-weight: 600; line-height: 1.4;">
                            Licensed in Saudi Arabia
                        </h3>

                        <p class="text-gray-600 text-lg">
                            Fully authorized and regulated
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white rounded-2xl p-6 text-center shadow-lg border border-emerald-100">

                        <div
                            class="w-20 h-20 bg-gradient-to-br from-emerald-600 to-teal-700 rounded-full flex items-center justify-center mx-auto mb-6 mt-8">
                            <!-- Clock Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 3" />
                            </svg>
                        </div>

                        <h3 class="text-stone-800 mb-2"
                            style="font-family: 'Didot', serif; font-size: 1.5rem; font-weight: 600; line-height: 1.4;">
                            24/7 Support
                        </h3>

                        <p class="text-gray-600 text-lg">
                            Always here when you need us
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white rounded-2xl p-6 text-center shadow-lg border border-emerald-100">

                        <div
                            class="w-20 h-20 bg-gradient-to-br from-emerald-600 to-teal-700 rounded-full flex items-center justify-center mx-auto mb-6 mt-8">
                            <!-- Star Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.012 6.18a1 1 0 00.95.69h6.497c.969 0 1.371 1.24.588 1.81l-5.26 3.823a1 1 0 00-.364 1.118l2.012 6.18c.3.921-.755 1.688-1.538 1.118l-5.26-3.823a1 1 0 00-1.176 0l-5.26 3.823c-.783.57-1.838-.197-1.538-1.118l2.012-6.18a1 1 0 00-.364-1.118L2.05 11.607c-.783-.57-.38-1.81.588-1.81h6.497a1 1 0 00.95-.69l2.012-6.18z" />
                            </svg>
                        </div>

                        <h3 class="text-stone-800 mb-2"
                            style="font-family: 'Didot', serif; font-size: 1.5rem; font-weight: 600; line-height: 1.4;">
                            Experienced Staff
                        </h3>

                        <p class="text-gray-600 text-lg">
                            10+ years serving pilgrims
                        </p>
                    </div>

                </div>
            </div>
        </section>


        <!----------------Popular Destinations------------------>

        <div class="locations">
            @if (false)
                <div class="lg:max-w-[1110px] w-[90vw] mx-auto">
                    <div class="location-div text-center mb-6">
                        <h2 class="text-2xl font-bold ps-2">
                            Popular Destinations
                        </h2>
                        <p class="text-md font-normal text-[#595959] mt-2 ps-2"> Find out what the best destinations in the
                            Pakistan</p>
                    </div>
                    <!-- destiantions boxes code here -->
                    <!--<div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-3">
                                                                        @foreach ($destinations as $index => $destination)
    @if ($index < 2)
    Only show the first two images -->
                    <div class="relative border hover:border hover:border-[#008000] rounded-lg">
                        <!-- Image Box -->
                        <a href="{{ route('destination_tour', $destination->id) }}" class="block relative group">
                            <img src="{{ asset(str_replace('public/', '', $destination->destination_image)) }}"
                                class="w-full h-[270px]  rounded-lg object-cover"
                                alt="{{ $destination->destination_name }}" />

                            <!-- Overlay -->
                            <div
                                class="absolute inset-x-0 top-0 h-1/2 bg-black bg-opacity-[0] transition-opacity duration-300 group-hover:bg-[rgba(0,0,0,0.08)]   rounded-lg">
                            </div>

                            <div class="absolute top-5 left-5 p-2">
                                <h4 class="text-white text-2xl font-bold">{{ $destination->destination_name }}</h4>
                            </div>
                        </a>
                    </div>
            @endif
            @endforeach
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-3">
            @foreach ($destinations as $index => $destination)
                @if ($index >= 2 && $index < 5)
                    <!-- Only show the first two images -->
                    <div class="relative border hover:border hover:border-[#008000] rounded-lg">
                        <!-- Image Box -->
                        <a href="{{ route('destination_tour', $destination->id) }}" class="block relative group">
                            <img src="{{ asset(str_replace('public/', '', $destination->destination_image)) }}"
                                class="w-full h-[265px]  object-cover " alt="{{ $destination->destination_name }}" />

                            <!-- Overlay -->
                            <div
                                class="absolute inset-x-0 top-0 h-1/2 bg-black bg-opacity-[0] transition-opacity duration-300 group-hover:bg-[rgba(0,0,0,0.08)]   rounded-lg">
                            </div>

                            <div class="absolute top-5 left-3 p-2">
                                <h4 class="text-white text-xl font-bold">{{ $destination->destination_name }}</h4>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- <div class="mt-3">
                <h2 class="font-bold text-2xl ps-2">Explore Pakistan</h2>
                <p class="text-md text-[#595959] mt-2 ps-2">These popular destinations have a lot to offer</p>
            </div>
            <div class="relative overflow-hidden mt-2">
                <div class="flex transition-transform duration-500 ease-in-out" id="image-slider">

                    @foreach ($destinations as $destination)
                    <div class="image-item w-full md:w-1/2 lg:w-[170px] p-2">
                        <div class="bg-white overflow-hidden">
                            <a href="{{ route('destination_tour', $destination->id) }}" class="block relative group">
                                <img src="{{ asset(str_replace('public/', '', $destination->destination_image)) }}"
                                    class="w-full h-[135px] max-h-[135px] object-cover rounded-md" alt="{{ $destination->destination_name }}" />
                                <div class="pb-2 pt-2 px-2">
                                    <h5 class="text-sm font-bold text-gray-800">
                                        {{ $destination->destination_name }}
                                    </h5>
                                    <h5 class="text-xs font-normal text-[#1a1a1a]">
                                        23 Tours
                                    </h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach

                </div>

                <button id="prev"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white p-2 shadow-lg hover:bg-gray-200 focus:outline-none"
                    aria-label="Previous">
                    ←
                </button>
                <button id="next"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white p-2 shadow-lg hover:bg-gray-200 focus:outline-none"
                    aria-label="Next">
                    →
                </button>
            </div> --}}
    </div>
    @endif

    <!-- Planner Section -->

    @if (false)
        <div x-data="handlePlanner()" class="max-w-[1110px] w-[90vw] mx-auto">
            {{-- <div class="mt-3">
                <h2 class="font-bold text-2xl ps-2">Quick and easy trip planner</h2>
                <p class="text-md text-[#595959] mt-2 ps-2">Pick a vibe and explore the top destinations in Pakistan</p>
            </div>
            <div>
                <div class="flex items-center justify-start gap-3 mt-3 mb-2 ps-2">
                    <div @click="activeTab = 'city'" :class="{'border-[1px] border-[#008000]': activeTab === 'city'}" class="rounded-2xl cursor-pointer flex items-center gap-1 px-3">
                        <i :class="{'text-[#008000]': activeTab === 'city'}" class="material-icons">location_city</i>
                        <p :class="{'text-[#008000]': activeTab === 'city'}" class="text-md py-1">City</p>
                    </div>
                    <div @click="activeTab = 'honeymoon'" :class="{'border-[1px] border-[#008000]': activeTab === 'honeymoon'}" class="rounded-2xl cursor-pointer flex items-center gap-1 px-3">
                        <i :class="{'text-[#008000]': activeTab === 'honeymoon'}" class="material-icons">favorite</i>
                        <p :class="{'text-[#008000]': activeTab === 'honeymoon'}" class="text-md py-1">Honeymoon</p>
                    </div>
                    <div @click="activeTab = 'womens'" :class="{'border-[1px] border-[#008000]': activeTab === 'womens'}" class="rounded-2xl cursor-pointer flex items-center gap-1 px-3">
                      <i :class="{'text-[#008000]': activeTab === 'womens'}" class="material-icons">face_3</i>

                        <p :class="{'text-[#008000]': activeTab === 'womens'}" class="text-md py-1">Womens</p>
                    </div>
                </div>
            </div> --}}

            <div class="relative overflow-hidden mt-2">
                <div x-show="activeTab === 'city'" class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($destinations as $destination)
                            <div class="swiper-slide w-full md:w-1/2 lg:w-[170px] p-2">
                                <div class="bg-white overflow-hidden">
                                    <a href="{{ route('destination_tour', $destination->id) }}"
                                        class="block relative group">
                                        <img src="{{ asset(str_replace('public/', '', $destination->destination_image)) }}"
                                            class="w-full h-[135px] max-h-[135px] object-cover rounded-md"
                                            alt="{{ $destination->destination_name }}" />
                                        <div class="pb-2 pt-2 px-2">
                                            <h5 class="text-sm font-bold text-gray-800">
                                                {{ $destination->destination_name }}
                                            </h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Navigation Buttons -->
                    <button class="swiper-button-prev"></button>
                    <button class="swiper-button-next"></button>
                </div>

                <div x-show="activeTab === 'honeymoon'" class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($destinations->skip(2)->take(3) as $destination)
                            <div class="swiper-slide w-full md:w-1/2 lg:w-[170px] p-2">
                                <div class="bg-white overflow-hidden">
                                    <a href="{{ route('destination_tour', $destination->id) }}"
                                        class="block relative group">
                                        <img src="{{ asset(str_replace('public/', '', $destination->destination_image)) }}"
                                            class="w-full h-[135px] max-h-[135px] object-cover rounded-md"
                                            alt="{{ $destination->destination_name }}" />
                                        <div class="pb-2 pt-2 px-2">
                                            <h5 class="text-sm font-bold text-gray-800">
                                                {{ $destination->destination_name }}
                                            </h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="swiper-button-prev"></button>
                    <button class="swiper-button-next"></button>
                </div>

                <div x-show="activeTab === 'womens'" class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($destinations->skip(5)->take(3) as $destination)
                            <div class="swiper-slide w-full md:w-1/2 lg:w-[170px] p-2">
                                <div class="bg-white overflow-hidden">
                                    <a href="{{ route('destination_tour', $destination->id) }}"
                                        class="block relative group">
                                        <img src="{{ asset(str_replace('public/', '', $destination->destination_image)) }}"
                                            class="w-full h-[135px] max-h-[135px] object-cover rounded-md"
                                            alt="{{ $destination->destination_name }}" />
                                        <div class="pb-2 pt-2 px-2">
                                            <h5 class="text-sm font-bold text-gray-800">
                                                {{ $destination->destination_name }}
                                            </h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="swiper-button-prev"></button>
                    <button class="swiper-button-next"></button>
                </div>
            </div>

        </div>

        <script>
            function handlePlanner() {
                return {
                    activeTab: 'city',
                };
            }
        </script>
    @endif



    <!-- Planner Section-->



    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">

            <!-- Heading -->
            <h2 class="text-[48px] font-serif font-semibold text-gray-800">
                Simple Booking Process
            </h2>

            <!-- Subtitle -->
            <p class="mt-4 text-[20px] text-gray-600">
                Your complete holy journey in four easy steps.
            </p>

            <!-- Steps Wrapper -->
            <div class="mt-20 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-12">

                <!-- Step 1 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="w-20 h-20 flex items-center justify-center rounded-full bg-[#0f7c5c] text-white text-3xl font-semibold">
                        1
                    </div>

                    <h3 class="mt-8 text-[28px] font-serif font-semibold text-gray-800">
                        Travel Details
                    </h3>

                    <p class="mt-4 text-gray-600 text-lg leading-relaxed max-w-[250px]">
                        Enter your arrival and departure information
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="w-20 h-20 flex items-center justify-center rounded-full bg-[#0f7c5c] text-white text-3xl font-semibold">
                        2
                    </div>

                    <h3 class="mt-8 text-[28px] font-serif font-semibold text-gray-800">
                        Choose Accommodation
                    </h3>

                    <p class="mt-4 text-gray-600 text-lg leading-relaxed max-w-[250px]">
                        Select your preferred apartment or villa
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="w-20 h-20 flex items-center justify-center rounded-full bg-[#0f7c5c] text-white text-3xl font-semibold">
                        3
                    </div>

                    <h3 class="mt-8 text-[28px] font-serif font-semibold text-gray-800">
                        Select Transportation
                    </h3>

                    <p class="mt-4 text-gray-600 text-lg leading-relaxed max-w-[250px]">
                        Pick your vehicle and driver
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="w-20 h-20 flex items-center justify-center rounded-full bg-[#0f7c5c] text-white text-3xl font-semibold">
                        4
                    </div>

                    <h3 class="mt-8 text-[28px] font-serif font-semibold text-gray-800">
                        Confirm Booking
                    </h3>

                    <p class="mt-4 text-gray-600 text-lg leading-relaxed max-w-[250px]">
                        Review and confirm your journey
                    </p>
                </div>

            </div>
        </div>
    </section>


    <section class="py-20 bg-gradient-to-r from-emerald-700 to-teal-800 text-white">
        <div class="max-w-5xl mx-auto px-6 text-center">

            <!-- Heading -->
            <h2 class="text-[48px] font-serif font-semibold text-white">
                Ready to Begin Your Journey?
            </h2>

            <!-- Subtitle -->
            <p class="mt-6 text-[22px] text-white/90 leading-relaxed max-w-3xl mx-auto">
                Let us handle all the details while you focus on your spiritual
                experience.
            </p>

            <!-- Button -->
            <div class="mt-14">
                <a href="#"
                    class="inline-flex items-center gap-3 bg-[#e5e5e5] text-[#0f6f5a] text-[20px] font-semibold p-4  rounded-2xl transition duration-300 hover:bg-white">

                    Start Booking Now

                    <!-- Arrow Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </a>
            </div>

        </div>
    </section>

    {{-- <footer class="bg-stone-900 text-stone-300 py-12">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Top Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">

                <!-- Column 1 -->
                <div>
                    <h3 class="text-[28px] text-white font-serif font-semibold">
                        Holy Tour Host
                    </h3>

                    <p class="mt-6 text-gray-400 text-lg leading-relaxed max-w-sm">
                        Premium pilgrimage services based in Madinah,
                        Saudi Arabia.
                    </p>
                </div>

                <!-- Column 2 -->
                <div>
                    <h3 class="text-[28px] text-white font-serif font-semibold">
                        Contact
                    </h3>

                    <div class="mt-6 space-y-3 text-gray-400 text-lg">
                        <p>Phone: +966 55 123 4567</p>
                        <p>Email: info@holytourhost.sa</p>
                    </div>
                </div>

                <!-- Column 3 -->
                <div>
                    <h3 class="text-[28px] text-white font-serif font-semibold">
                        Services
                    </h3>

                    <ul class="mt-6 space-y-4 text-gray-400 text-lg">
                        <li class="flex items-center gap-3">
                            <!-- Check Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Airport Transfers
                        </li>

                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Accommodations
                        </li>

                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Car Rentals
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Divider -->
            <div class="border-t border-gray-700 mt-16 pt-8 text-center">
                <p class="text-gray-500 text-base">
                    © 2026 Holy Tour Host. All rights reserved. Licensed in Saudi Arabia.
                </p>
            </div>

        </div>
    </footer> --}}



    <!--------------------Deals Tours--------------------->
    @if (false)
        <div id="featured" class="packages lg:max-w-[1110px] w-[90vw] mx-auto mt-3">
            <div>
                <div class="flex flex-col items-center justify-center text-center">
                    <div class="featured-div">
                        <h2 class="text-2xl font-bold pt-2">Deals of the weekend</h2>
                        <p class="text-md font-normal mt-2 text-[#595959] mb-4">Save on stays for 14 March - 16 March</p>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('tours') }}">
                            <button
                                class="text-sm font-normal border border-[#008000] px-4 py-1 text-[#008000] rounded-lg hover:bg-green-50 transition-colors">See
                                All</button>
                        </a>
                    </div>
                </div>

                <!-- Swiper Container -->
                <div class="swiper-container-wrapper dealsSwiper-btn">
                    <div class="swiper dealsSwiper mt-1">
                        <div class="swiper-wrapper">
                            @foreach ($tours as $tour)
                                <div class="swiper-slide border rounded-lg shadow-sm ">
                                    <div class="relative flex flex-col shadow-md rounded-lg transition duration-300">
                                        <i
                                            class="material-icons cursor-pointer text-[#1a1a1a] text-[18px] absolute top-3 right-3 bg-white p-2 rounded-full">favorite_border</i>
                                        <a href="{{ route('tour_details', $tour->id) }}"
                                            class="rounded-lg text-decoration-none text-surface hover:text-black">
                                            <img class="rounded-lg w-full h-[210px] object-cover"
                                                src="{{ asset($tour->trip_image) }}" alt="{{ $tour->trip_name }}" />

                                            <div class="p-3 flex flex-col gap-3">
                                                <h5 class="mb-2 text-sm font-bold leading-tight">{{ $tour->trip_name }}
                                                </h5>
                                                <div class="flex items-center justify-start gap-3">
                                                    @if ($tour->pickup_points)
                                                        <p class="text-[#595959] flex items-center">
                                                            <span
                                                                class="material-icons text-[#008000] me-1">location_on</span>
                                                            {{ $tour->pickup_points->pickup_city }}
                                                        </p>
                                                    @endif
                                                    <h5 class="text-sm font-normal text-[#595959] leading-tight">
                                                        <span class="font-bold">Tour Date: </span>
                                                        {{ \Carbon\Carbon::parse($tour->trip_start_date)->format('d-m-y') }}
                                                    </h5>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    @if ($tour->rating)
                                                        <span
                                                            class="bg-[#009900] text-white p-1 text-sm rounded">{{ $tour->rating }}</span>
                                                        <p class="text-sm">Good</p>
                                                        <small class="text-gray-500">({{ $tour->reviews_count }}
                                                            Reviews)</small>
                                                    @endif
                                                </div>
                                                <div class="flex justify-between gap-1 items-center">
                                                    <h5 class="text-sm font-normal text-gray-500 leading-tight">
                                                        {{ $tour->trip_duration }}
                                                    </h5>
                                                    <div class="flex flex-col text-right">
                                                        <p class="text-md font-bold text-red-500">
                                                            <del>
                                                                {{ $tour->pickup_points->per_seat_fare_currency ?? 'PKR' }}
                                                                {{ $tour->pickup_points->per_seat_fare ?? '0.00' }}
                                                            </del>
                                                        </p>
                                                        <p class="text-md font-bold text-gray-500">
                                                            {{ 'PKR' }}
                                                            {{ '20.00' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>


        <!--------------------Perfect Stay Tours--------------------->

        <div id="featured" class="packages lg:max-w-[1110px] w-[90vw] mx-auto mt-3">
            <div>
                <div class="flex flex-col items-center justify-center text-center">
                    <div>
                        <h2 class="text-2xl font-bold pt-2">Looking for the perfect stay</h2>
                        <p class="text-md font-normal mt-2 text-[#595959] mb-4">Travellers with similar searches booked
                            these trips </p>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('tours') }}">
                            <button
                                class="text-sm font-normal border border-[#008000] px-4 py-1 text-[#008000] rounded-lg hover:bg-green-50 transition-colors">See
                                All</button>
                        </a>
                    </div>

                </div>

            </div>

            <!-- Swiper Container -->
            <div class="swiper-container-wrapper perfectStaySwiper-btn">
                <div class="swiper perfectStaySwiper mt-1">
                    <div class="swiper-wrapper">
                        @foreach ($tours as $tour)
                            <div class="swiper-slide border rounded-lg shadow-sm ">
                                <div class="relative flex flex-col shadow-md rounded-lg transition duration-300">
                                    <i
                                        class="material-icons cursor-pointer text-[#1a1a1a] text-[18px] absolute top-3 right-3 bg-white p-2 rounded-full">favorite_border</i>
                                    <a href="{{ route('tour_details', $tour->id) }}"
                                        class="rounded-lg text-decoration-none text-surface hover:text-black">
                                        <img class="rounded-lg w-full h-[210px] object-cover"
                                            src="{{ asset($tour->trip_image) }}" alt="{{ $tour->trip_name }}" />

                                        <div class="p-3 flex flex-col gap-3">
                                            <h5 class="mb-2 text-sm font-bold leading-tight">{{ $tour->trip_name }}</h5>
                                            <div class="flex items-center justify-start gap-3">
                                                @if ($tour->pickup_points)
                                                    <p class="text-[#595959] flex items-center">
                                                        <span class="material-icons text-[#008000] me-1">location_on</span>
                                                        {{ $tour->pickup_points->pickup_city }}
                                                    </p>
                                                @endif
                                                <h5 class="text-sm font-normal text-[#595959] leading-tight">
                                                    <span class="font-bold">Tour Date: </span>
                                                    {{ \Carbon\Carbon::parse($tour->trip_start_date)->format('d-m-y') }}
                                                </h5>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                @if ($tour->rating)
                                                    <span
                                                        class="bg-[#009900] text-white p-1 text-sm rounded">{{ $tour->rating }}</span>
                                                    <p class="text-sm">Good</p>
                                                    <small class="text-gray-500">({{ $tour->reviews_count }}
                                                        Reviews)</small>
                                                @endif
                                            </div>
                                            <div class="flex justify-between gap-1 items-center">
                                                <h5 class="text-sm font-normal text-gray-500 leading-tight">
                                                    {{ $tour->trip_duration }}
                                                </h5>
                                                <div class="flex flex-col text-right">
                                                    <h1 class="text-md font-bold">
                                                        {{ $tour->pickup_points->per_seat_fare_currency ?? 'PKR' }}
                                                        {{ $tour->pickup_points->per_seat_fare ?? '0.00' }}
                                                    </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
        </div>


        <!--------------------Unique Tours--------------------->

        <div id="featured" class="packages lg:max-w-[1110px] w-[90vw] mx-auto mt-3">
            <div>
                <div class="flex flex-col items-center justify-center text-center">
                    <div class="featured-div">
                        <h2 class="text-2xl font-bold pt-2">Stay at our top unique tours</h2>
                        <p class="text-md font-normal mt-2 text-[#595959] mb-4">Our Featured Tours can help you find the
                            trip
                            that's perfect for you! </p>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('tours') }}">
                            <button
                                class="text-sm font-normal border border-[#008000] px-4 py-1 text-[#008000] rounded-lg hover:bg-green-50 transition-colors">See
                                All</button>
                        </a>
                    </div>

                </div>

                <!-- Swiper Container -->
                <div class="swiper-container-wrapper TopUniqueSwiper-btn">
                    <div class="swiper TopUniqueSwiper mt-1">
                        <div class="swiper-wrapper">
                            @foreach ($tours as $tour)
                                <div class="swiper-slide border rounded-lg shadow-sm ">
                                    <div class="relative flex flex-col shadow-md rounded-lg transition duration-300">
                                        <i
                                            class="material-icons cursor-pointer text-[#1a1a1a] text-[18px] absolute top-3 right-3 bg-white p-2 rounded-full">favorite_border</i>
                                        <a href="{{ route('tour_details', $tour->id) }}"
                                            class="rounded-lg text-decoration-none text-surface hover:text-black">
                                            <img class="rounded-lg w-full h-[210px] object-cover"
                                                src="{{ asset($tour->trip_image) }}" alt="{{ $tour->trip_name }}" />

                                            <div class="p-3 flex flex-col gap-3">
                                                <h5 class="mb-2 text-sm font-bold leading-tight">{{ $tour->trip_name }}
                                                </h5>
                                                <div class="flex items-center justify-start gap-3">
                                                    @if ($tour->pickup_points)
                                                        <p class="text-[#595959] flex items-center">
                                                            <span
                                                                class="material-icons text-[#008000] me-1">location_on</span>
                                                            {{ $tour->pickup_points->pickup_city }}
                                                        </p>
                                                    @endif
                                                    <h5 class="text-sm font-normal text-[#595959] leading-tight">
                                                        <span class="font-bold">Tour Date: </span>
                                                        {{ \Carbon\Carbon::parse($tour->trip_start_date)->format('d-m-y') }}
                                                    </h5>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    @if ($tour->rating)
                                                        <span
                                                            class="bg-[#009900] text-white p-1 text-sm rounded">{{ $tour->rating }}</span>
                                                        <p class="text-sm">Good</p>
                                                        <small class="text-gray-500">({{ $tour->reviews_count }}
                                                            Reviews)</small>
                                                    @endif
                                                </div>
                                                <div class="flex justify-between gap-1 items-center">
                                                    <h5 class="text-sm font-normal text-gray-500 leading-tight">
                                                        {{ $tour->trip_duration }}
                                                    </h5>
                                                    <div class="flex flex-col text-right">
                                                        <h1 class="text-md font-bold">
                                                            {{ $tour->pickup_points->per_seat_fare_currency ?? 'PKR' }}
                                                            {{ $tour->pickup_points->per_seat_fare ?? '0.00' }}
                                                        </h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>

        <!--------------------Get inspiration Tours--------------------->
        <div id="featured" style="border-top:5px ; border:black"
            class="packages lg:max-w-[1110px] w-[90vw] mx-auto mt-3">
            <div>
                <div class="flex flex-col items-center justify-center text-center">
                    <div class="featured-div">
                        <h2 class="text-2xl font-bold pb-2 pt-0">Get inspiration for your next trip</h2>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('tours') }}">
                            <button
                                class="text-sm font-normal border border-[#008000] px-4 py-1 text-[#008000] rounded-lg hover:bg-green-50 transition-colors">More</button>
                        </a>
                    </div>

                </div>

                <!-- Swiper Container -->
                <div class="swiper-container-wrapper articleSwiper-btn">
                    <div class="swiper articleSwiper mt-1">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide border rounded-lg shadow-sm  first-article-banner-slide">
                                <div class="relative flex flex-col shadow-md rounded-lg transition duration-300">
                                    <a href="#"
                                        class="rounded-lg text-decoration-none text-surface hover:text-black">
                                        <img class="rounded-lg w-full h-[310px] object-cover"
                                            src="https://hejazavenue.com/compass/public/tour_images/1442528471.jpg"
                                            alt="Placeholder Image" />
                                    </a>
                                </div>
                            </div>
                            @foreach ($tours->take(6) as $tour)
                                <div class="swiper-slide border rounded-lg shadow-sm ">
                                    <div class="relative flex flex-col shadow-md rounded-lg transition duration-300">
                                        <a href="{{ route('tour_details', $tour->id) }}"
                                            class="rounded-lg text-decoration-none text-surface hover:text-black">
                                            <img class="rounded-lg w-full h-[210px] object-cover"
                                                src="{{ asset($tour->trip_image) }}" alt="{{ $tour->trip_name }}" />

                                            <div class="p-3 flex flex-col">
                                                <h5 class="mb-2 text-sm font-bold leading-tight">{{ $tour->trip_name }}
                                                </h5>
                                                <p class="text-md">Discover the best Orlando hotels for families for your
                                                    vacation.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>

        <!-- travel tours -->

        <div
            class="lg:max-w-[1110px] w-[90vw] mt-[50px] mx-auto flex flex-col md:flex-row justify-end items-center md:h-[300px] h-[200px] border gap-10 relative">
            <div
                class="bg-[#008000] rounded-full w-16 h-16 md:w-20 md:h-20 absolute left-1/2 transform -translate-x-1/2 md:translate-x-0 md:-left-5 bottom-5 md:bottom-10 shadow hidden md:block">
            </div>
            <div
                class="bg-[#008000] rounded-full lg:h-[500px] h-[400px] lg:w-[500px] md:w-[400px] w-[300px]  flex items-center justify-center">
                <div class="md:max-w-[250px] max-w-[200px] mx-auto">
                    <h2 class="text-white text-xl md:text-3xl font-bold tracking-tight ">Find Destination For your next
                        trip
                    </h2>
                    <a href="{{ route('index') }}">
                        <button class="text-[#008000] text-center bg-white w-full py-2 rounded-lg mt-2">
                            Discover Home
                        </button>
                    </a>
                </div>
            </div>
            <div class="hidden md:block">
                <img src="https://as1.ftcdn.net/v2/jpg/02/70/83/06/1000_F_270830623_qqW0sXdUgHbpc5fONPdpPp5VwL7KPza6.jpg"
                    alt="Responsive Image" class="md:h-[250px] h-[150px] w-auto rounded-lg" />
            </div>
        </div>
    @endif



    <!-----------------Customers Testimonial------------------------->
    <!--<div class="lg:py-16 ">-->
    <!--    <div class="lg:max-w-[1110px] w-[90vw] mx-auto flex justify-center flex-col items-start">-->
    <!--        <div>-->
    <!--            <h2 class="text-2xl font-bold ps-2 pt-2">-->
    <!--                What Our Customers Say-->
    <!--            </h2>-->
    <!--            <p class="text-md  font-normal mt-2 text-[#595959] ps-2 mb-2">-->
    <!--                We have many happy customers that have booked holidays with us.-->
    <!--            </p>-->
    <!--        </div>-->

    <!--        <div class="swiper reviews_swiper w-full">-->
    <!--            <div class="swiper-wrapper">-->
    <!--                @foreach ($reviews as $review)
    -->
    <!--                <div class="swiper-slide border rounded-lg shadow-sm ">-->
    <!--                    <div class="bg-white rounded-lg p-6 hover:scale-[1.01] transform transition duration-300">-->
    <!--                        <div class="w-20 h-20 rounded-full border-2 border-black overflow-hidden mb-4">-->
    <!--                            <img src="{{ asset($review->profile_image) }}" alt="profile img"-->
    <!--                                class="w-full h-full object-cover">-->
    <!--                        </div>-->
    <!--                        <h4 class="lg:text-xl font-semibold text-[#008000] mb-2">Wonderful day!</h4>-->
    <!--                        <p class="italic font-normal text-[#595959] mb-2 md:text-md text-sm">-->
    <!--                            {{ $review->review }}-->
    <!--                        </p>-->
    <!--                        <h5 class="md:text-md text-sm font-bold text-gray-900 ">{{ $review->user_name }}</h5>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--
    @endforeach-->
    <!--            </div>-->
    <!--        </div>-->


    <!--    </div>-->
    <!--</div>-->
    </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var offset = $('#load-more-popular-tours').data('offset');
            var loading = false;

            function loadMorePopularPosts() {
                if (loading) return;
                loading = true;

                var url = '{{ route('load-more-popular-packages') }}?offset=' + offset;

                // Show the loader
                $('#loader-load-more-popular-tours').removeClass('hidden');

                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        $('#loader-load-more-popular-tours').addClass('hidden');

                        if (response.has_more) {
                            $('#load-more-popular').append(response.html);
                            offset += 4;
                            $('#load-more-popular-tours').data('offset', offset);
                        } else {
                            $('#load-more-popular-tours').hide();
                        }
                    },
                    error: function(xhr) {
                        $('#loader-load-more-popular-tours').addClass('hidden');
                        loading = false;
                        alert('An error occurred while loading popular posts: ' + xhr.responseText);
                    },
                    complete: function() {
                        loading = false;
                    }
                });
            }

            function checkIfLoadMorePopularVisible() {
                var button = $('#load-more-popular-tours');
                if (!button || !button.length) return;
                var btnOffsetObj = button.offset();
                if (!btnOffsetObj) return;
                var buttonOffset = btnOffsetObj.top;
                var windowScrollTop = $(window).scrollTop();
                var windowHeight = $(window).height();

                if (buttonOffset < (windowScrollTop + windowHeight)) {
                    loadMorePopularPosts();
                }
            }

            $(window).on('scroll', function() {
                checkIfLoadMorePopularVisible();
            });

            checkIfLoadMorePopularVisible();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var offset = $('#load-more').data('offset');
            var loading = false;

            function loadMorePosts() {
                if (loading) return;
                loading = true;

                var url = '{{ route('load-more-features-tours') }}?offset=' + offset;

                $('#loader').removeClass('hidden');

                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        $('#loader').addClass('hidden');

                        if (response.has_more) {
                            $('#load-more-container').append(response.html);
                            offset += 4;
                            $('#load-more').data('offset', offset);
                        } else {
                            $('#load-more').hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#loader').addClass('hidden');
                        loading = false;
                        alert('An error occurred while loading posts: ' + xhr.responseText);
                    },
                    complete: function() {
                        loading = false;
                    }
                });

            }

            function checkIfLoadMoreVisible() {
                var button = $('#load-more');
                if (!button || !button.length) return;
                var btnOffsetObj = button.offset();
                if (!btnOffsetObj) return;
                var buttonOffset = btnOffsetObj.top;
                var windowScrollTop = $(window).scrollTop();
                var windowHeight = $(window).height();

                if (buttonOffset < (windowScrollTop + windowHeight)) {
                    loadMorePosts();
                }
            }

            $(window).on('scroll', function() {
                checkIfLoadMoreVisible();
            });

            checkIfLoadMoreVisible();
        });


        // Best services cards slider script
        // Initialize Swiper.js
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            grabCursor: true,
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
            },
        });

        document.addEventListener("DOMContentLoaded", function() {
            var swiper = new Swiper(".reviews_swiper", {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                slidesPerView: 1,
                spaceBetween: 20,
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
                navigation: {
                    nextEl: ".reviews_swiper .swiper-button-next",
                    prevEl: ".reviews_swiper .swiper-button-prev",
                },
                pagination: {
                    el: ".reviews_swiper .swiper-pagination",
                    clickable: true,
                },
            });
        });



        //popular destination slider
        //popular destination slider
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('image-slider');
            if (!slider) return;

            const images = document.querySelectorAll('.image-item');
            const totalImages = images.length;
            let cardWidth = images.length > 0 ? images[0].offsetWidth : 0;
            let currentIndex = 0;
            let itemsToShow = getItemsToShow();

            const prevButton = document.getElementById('prev');
            const nextButton = document.getElementById('next');

            if (!prevButton || !nextButton) return;

            // Initially hide the Previous button
            prevButton.style.display = 'none';

            function updateSlider() {
                if (!slider) return;
                const offset = currentIndex * cardWidth;
                slider.style.transform = `translateX(-${offset}px)`;

                // Toggle the visibility of the buttons based on currentIndex
                if (currentIndex === 0) {
                    prevButton.style.display = 'none';
                } else {
                    prevButton.style.display = 'block';
                }

                // Hide "Next" button when reaching the last visible set of cards
                if (currentIndex >= totalImages - itemsToShow) {
                    nextButton.style.display = 'none';
                } else {
                    nextButton.style.display = 'block';
                }
            }

            function getItemsToShow() {
                if (window.innerWidth < 768) {
                    return 1;
                } else if (window.innerWidth < 1024) {
                    return 2;
                } else {
                    return 5;
                }
            }

            // Update the cardWidth when resizing the window
            window.addEventListener('resize', () => {
                itemsToShow = getItemsToShow();
                if (images.length > 0) {
                    cardWidth = images[0].offsetWidth;
                }
                updateSlider();
            });

            // Next button functionality
            nextButton.addEventListener('click', () => {
                if (currentIndex < totalImages - itemsToShow) {
                    currentIndex += 1;
                    slider.style.transition = 'transform 0.5s ease-in-out';
                    updateSlider();
                }
            });

            // Previous button functionality
            prevButton.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex -= 1;
                    slider.style.transition = 'transform 0.5s ease-in-out';
                    updateSlider();
                }
            });

            // Initialize the slider
            updateSlider();
        });


        (function() {
            var el = document.querySelector(".mostPopularSwiper");
            var slides = el ? el.querySelectorAll(".swiper-slide").length : 0;
            new Swiper(".mostPopularSwiper", {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: slides >= 4,
                navigation: {
                nextEl: ".mostPopularSwiper-btn .swiper-button-next",
                prevEl: ".mostPopularSwiper-btn .swiper-button-prev",
            },
            pagination: {
                el: ".mostPopularSwiper-btn .swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1280: {
                    slidesPerView: 4
                },
            },
        });
        })();
        (function() {
            var el = document.querySelector(".TopUniqueSwiper");
            var slides = el ? el.querySelectorAll(".swiper-slide").length : 0;
            new Swiper(".TopUniqueSwiper", {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: slides >= 4,
                navigation: {
                nextEl: ".TopUniqueSwiper-btn .swiper-button-next",
                prevEl: ".TopUniqueSwiper-btn .swiper-button-prev",
            },
            pagination: {
                el: ".TopUniqueSwiper-btn .swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1280: {
                    slidesPerView: 4
                },
            },
        });
        })();
        (function() {
            var el = document.querySelector(".perfectStaySwiper");
            var slides = el ? el.querySelectorAll(".swiper-slide").length : 0;
            new Swiper(".perfectStaySwiper", {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: slides >= 4,
                navigation: {
                nextEl: ".perfectStaySwiper-btn .swiper-button-next",
                prevEl: ".TopUniqueSwiper-btn .swiper-button-prev",
            },
            pagination: {
                el: ".perfectStaySwiper-btn .swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1280: {
                    slidesPerView: 4
                },
            },
        });
        })();
        (function() {
            var el = document.querySelector(".dealsSwiper");
            var slides = el ? el.querySelectorAll(".swiper-slide").length : 0;
            new Swiper(".dealsSwiper", {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: slides >= 4,
                navigation: {
                nextEl: ".dealsSwiper-btn .swiper-button-next",
                prevEl: ".dealsSwiper-btn .swiper-button-prev",
            },
            pagination: {
                el: ".dealsSwiper-btn .swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1280: {
                    slidesPerView: 4
                },
            },
        });
        })();

        new Swiper(".articleSwiper", {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: false,
            navigation: {
                nextEl: ".articleSwiper-btn .swiper-button-next",
                prevEl: ".articleSwiper-btn .swiper-button-prev",
            },
            pagination: {
                el: ".articleSwiper-btn .swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1280: {
                    slidesPerView: 4
                },
            },
        });

        if (window.innerWidth >= 1024) { // Adjust breakpoint as needed
            const firstArticleSlide = document.querySelector(".first-article-banner-slide");
            if (firstArticleSlide) {
                firstArticleSlide.style.flex = "0 0 50%";
            }
        }


        document.querySelectorAll(".swiper-container").forEach((swiperEl) => {
            new Swiper(swiperEl, {
                slidesPerView: "auto",
                spaceBetween: 2,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 6
                    },
                },
            });
        });
    </script>
@endsection
