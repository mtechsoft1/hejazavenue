@extends('layouts.app')
@section('title')
Compass Tour
@endsection
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
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
    background:white;
    color:black;
    padding: 10px 20px;
    font-size: 18px;
    border-radius : 50%;
    right:-20px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.4);
}
.swiper-button-next:after {
    font-size: 18px
}

.swiper-button-prev {
    background:white;
    color:black;
    padding: 10px 20px;
    font-size: 18px;
    border-radius : 50%;
    left:-20px;
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



<div class="container-fluid">
    <div class=" w-full min-h-[550px] relative flex flex-col">
        <!-- Background image section -->
        <div class="row background-img relative flex justify-center w-full">
        </div>

        <!-- Search Bar Container -->
        <div class="lg:max-w-[1110px] w-[90vw] mx-auto text-white font-bold  flex items-center justify-center relative lg:bottom-5 bottom-14">
            <div class="w-full border-2 rounded-lg border-[#ffb700] bg-white bg-opacity-10">
                <!-- Search Form -->
                <form action="{{ route('search_tours') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="lg:grid lg:grid-cols-12 w-full">
                        <!-- Destination input -->
                        <div class="w-full col-span-5 border-2 border-[#ffb700]">
                            <div class="relative flex items-center px-4">
                                <span class="text-gray-500">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </span>
                                <input type="text" name="destination" id="going"
                                    class="py-2 md:text-md text-sm focus:ring-0 w-full font-normal text-gray-900 border-0"
                                    placeholder="Where are you going?" />
                            </div>
                        </div>

                        <!-- Location select -->
                        <div class="w-full col-span-5 border-2 border-[#ffb700]">
                            <div class="relative flex items-center px-4">
                                <span class="text-gray-500">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </span>
                                <select
                                    class="py-2 font-normal  w-full text-black border-0 focus:ring-0 md:text-md text-sm"
                                    name="destination_id" id="single-filter">
                                    <option value="">Location</option>
                                    @foreach ($destinations as $destination)
                                    <option value="{{ $destination->id }}">{{ $destination->destination_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Search button -->
                        <div class="w-full col-span-2">
                            <button
                                class="w-full h-full py-2 md:text-md text-sm rounded-sm bg-[#008000] hover:bg-green-600 text-white">
                                <i class="fa fa-binoculars"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--new code of our best services-->
    <!-- Include Swiper.js CDN -->

    <div id="service" class="services py-10  relative">
        <div class="service-div text-center mb-2">
            <div class="max-w-[1110px] w-[90vw] mx-auto ps-2">
            <h2 class="text-2xl font-bold text-start">
            Offers
            </h2>
                <p class="block text-md text-[#595959] text-start ">Most popular choices for Tourest from Pakistan</p>

            </div>
        </div>

        <!-- Swiper Container for Carousel -->
        <div class="mx-auto lg:max-w-[1110px] w-[90vw]">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($destinations as $index => $destination)
                    <div class="swiper-slide @if($index = 1) flex justify-between items-center @endif">
                        <div
                            class="w-full gap-5 shadow-md bg-white flex flex-col md:flex-row justify-between items-center p-2 rounded-lg border border-1">
                            <!--Text Content -->
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

                            <!--Image Section -->
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

            <!-- Add Pagination Dots Below the Swiper -->
            <div class="swiper-pagination mt-6 flex justify-center absolute bottom-10"></div>
        </div>

    </div>
    <!--end-->

    <!----------------Popular Destinations------------------>

    <div class="locations">
        <div class="lg:max-w-[1110px] w-[90vw] mx-auto">
            <div class="location-div">
                <h2 class="text-2xl font-bold ps-2">
                    Popular Destinations
                </h2>
                <p class="text-md font-normal text-[#595959] mt-2 ps-2"> Find out what the best destinations in the Pakistan</p>
            </div>
            <!-- destiantions boxes code here -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-3">
                @foreach ($destinations as $index => $destination)
                @if ($index < 2) <!-- Only show the first two images -->
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
                @if ($index >= 2 && $index < 5) <!-- Only show the first two images -->
                    <div class="relative border hover:border hover:border-[#008000] rounded-lg">
                        <!-- Image Box -->
                        <a href="{{ route('destination_tour', $destination->id) }}" class="block relative group">
                            <img src="{{ asset(str_replace('public/', '', $destination->destination_image)) }}"
                                class="w-full h-[265px]  object-cover "
                                alt="{{ $destination->destination_name }}" />

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

            <div class="mt-3">
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
            </div>
        </div>
        
        <!-- Planner Section -->
        
        <div x-data="handlePlanner()" class="max-w-[1110px] w-[90vw] mx-auto">
            <div class="mt-3">
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
            </div>
            
            <div class="relative overflow-hidden mt-2">
                <div x-show="activeTab === 'city'" class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($destinations as $destination)
                            <div class="swiper-slide w-full md:w-1/2 lg:w-[170px] p-2">
                                <div class="bg-white overflow-hidden">
                                    <a href="{{ route('destination_tour', $destination->id) }}" class="block relative group">
                                        <img src="{{ asset(str_replace('public/', '', $destination->destination_image)) }}"
                                            class="w-full h-[135px] max-h-[135px] object-cover rounded-md" alt="{{ $destination->destination_name }}" />
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
                                    <a href="{{ route('destination_tour', $destination->id) }}" class="block relative group">
                                        <img src="{{ asset(str_replace('public/', '', $destination->destination_image)) }}"
                                            class="w-full h-[135px] max-h-[135px] object-cover rounded-md" alt="{{ $destination->destination_name }}" />
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
                                    <a href="{{ route('destination_tour', $destination->id) }}" class="block relative group">
                                        <img src="{{ asset(str_replace('public/', '', $destination->destination_image)) }}"
                                            class="w-full h-[135px] max-h-[135px] object-cover rounded-md" alt="{{ $destination->destination_name }}" />
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

        
        
        <!-- Planner Section-->


        <!---------------Our Best Packages-------------->
            <div id="package" class="packages lg:max-w-[1110px] w-[90vw] mx-auto mt-3">
                <div>
                    <div class="flex justify-between">
                    <div class="package-div">
                        <h2 class="text-2xl font-bold ps-2 pt-2">Our Most Popular Packages</h2>
                        <p class="text-md font-normal mt-2 text-[#595959] ps-2 mb-2">Browse through our most popular tours!</p>
                    </div>
                    <div class="flex items-end">
                        <a href="{{route('tours')}}">
                            <button class="text-sm font-normal border-0 px-4 py-1  text-[#008000] rounded-lg">See All</button>
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
                                    <i class="material-icons cursor-pointer text-[#1a1a1a] text-[18px] absolute top-3 right-3 bg-white p-2 rounded-full">favorite_border</i>
                                            <a href="{{ route('tour_details', $tour->id) }}"
                                                class="rounded-lg text-decoration-none text-surface hover:text-black">
                                                <img class="rounded-lg w-full h-[210px] object-cover"
                                                    src="{{ asset($tour->trip_image)}}" alt="{{ $tour->trip_name }}" />
                                    
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
                                                        @if($tour->rating)
                                                            <span class="bg-[#009900] text-white p-1 text-sm rounded">{{ $tour->rating }}</span>
                                                            <p class="text-sm">Good</p>   
                                                            <small class="text-gray-500">({{ $tour->reviews_count }} Reviews)</small>
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

            
        <!--------------------Deals Tours--------------------->
                    <div id="featured" class="packages lg:max-w-[1110px] w-[90vw] mx-auto mt-3">
                <div>
                    <div class="flex justify-between">
                    <div class="featured-div">
                        <h2 class="text-2xl font-bold ps-2 pt-2">Deals of the weekend</h2>
                        <p class="text-md font-normal mt-2 text-[#595959] ps-2 mb-2">Save on stays for 14 March - 16 March</p>
                    </div>
                    <div class="flex items-end">
                        <a href="{{route('tours')}}">
                            <button class="text-sm font-normal border-0 px-4 py-1  text-[#008000] rounded-lg">See All</button>
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
                                <i class="material-icons cursor-pointer text-[#1a1a1a] text-[18px] absolute top-3 right-3 bg-white p-2 rounded-full">favorite_border</i>
                                        <a href="{{ route('tour_details', $tour->id) }}"
                                            class="rounded-lg text-decoration-none text-surface hover:text-black">
                                            <img class="rounded-lg w-full h-[210px] object-cover"
                                                src="{{ asset($tour->trip_image)}}" alt="{{ $tour->trip_name }}" />
                                
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
                                                    @if($tour->rating)
                                                        <span class="bg-[#009900] text-white p-1 text-sm rounded">{{ $tour->rating }}</span>
                                                        <p class="text-sm">Good</p>   
                                                        <small class="text-gray-500">({{ $tour->reviews_count }} Reviews)</small>
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
                    <div class="flex justify-between">
                        <div>
                        <h2 class="text-2xl font-bold ps-2 pt-2">Looking for the perfect stay</h2>
                        <p class="text-md font-normal mt-2 text-[#595959] ps-2 mb-2">Travellers with similar searches booked these trips </p>
                        </div>
                    <div class="flex items-end">
                        <a href="{{route('tours')}}">
                            <button class="text-sm font-normal border-0 px-4 py-1  text-[#008000] rounded-lg">See All</button>
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
                                <i class="material-icons cursor-pointer text-[#1a1a1a] text-[18px] absolute top-3 right-3 bg-white p-2 rounded-full">favorite_border</i>
                                        <a href="{{ route('tour_details', $tour->id) }}"
                                            class="rounded-lg text-decoration-none text-surface hover:text-black">
                                            <img class="rounded-lg w-full h-[210px] object-cover"
                                                src="{{ asset($tour->trip_image)}}" alt="{{ $tour->trip_name }}" />
                                
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
                                                    @if($tour->rating)
                                                        <span class="bg-[#009900] text-white p-1 text-sm rounded">{{ $tour->rating }}</span>
                                                        <p class="text-sm">Good</p>   
                                                        <small class="text-gray-500">({{ $tour->reviews_count }} Reviews)</small>
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
                    <div class="flex justify-between">
                    <div class="featured-div">
                        <h2 class="text-2xl font-bold ps-2 pt-2">Stay at our top unique tours</h2>
                        <p class="text-md font-normal mt-2 text-[#595959] ps-2 mb-2">Our Featured Tours can help you find the trip that's perfect for you! </p>
                    </div>
                    <div class="flex items-end">
                        <a href="{{route('tours')}}">
                            <button class="text-sm font-normal border-0 px-4 py-1  text-[#008000] rounded-lg">See All</button>
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
                                <i class="material-icons cursor-pointer text-[#1a1a1a] text-[18px] absolute top-3 right-3 bg-white p-2 rounded-full">favorite_border</i>
                                        <a href="{{ route('tour_details', $tour->id) }}"
                                            class="rounded-lg text-decoration-none text-surface hover:text-black">
                                            <img class="rounded-lg w-full h-[210px] object-cover"
                                                src="{{ asset($tour->trip_image)}}" alt="{{ $tour->trip_name }}" />
                                
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
                                                    @if($tour->rating)
                                                        <span class="bg-[#009900] text-white p-1 text-sm rounded">{{ $tour->rating }}</span>
                                                        <p class="text-sm">Good</p>   
                                                        <small class="text-gray-500">({{ $tour->reviews_count }} Reviews)</small>
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
                    <div id="featured" style="border-top:5px ; border:black" class="packages lg:max-w-[1110px] w-[90vw] mx-auto mt-3">
                <div>
                    <div class="flex justify-between">
                    <div class="featured-div">
                        <h2 class="text-2xl font-bold ps-2 pb-2 pt-0">Get inspiration for your next trip</h2>
                    </div>
                    <div class="flex items-end">
                        <a href="{{route('tours')}}">
                            <button class="text-sm font-normal border-0 px-4 py-1  text-[#008000] rounded-lg">More</button>
                        </a>
                    </div>
                        
                    </div>
            
                    <!-- Swiper Container -->
                <div class="swiper-container-wrapper articleSwiper-btn">
                    <div class="swiper articleSwiper mt-1">
                        <div class="swiper-wrapper">
                                <div class="swiper-slide border rounded-lg shadow-sm  first-article-banner-slide">
                                    <div class="relative flex flex-col shadow-md rounded-lg transition duration-300">
                                        <a href="#" class="rounded-lg text-decoration-none text-surface hover:text-black">
                                            <img class="rounded-lg w-full h-[310px] object-cover"
                                                src="https://compassmytrip.com/compass/public/tour_images/1442528471.jpg" alt="Placeholder Image" />
                                        </a>
                                    </div>
                                </div>
                            @foreach ($tours->take(6) as $tour)
                                <div class="swiper-slide border rounded-lg shadow-sm ">
                                    <div class="relative flex flex-col shadow-md rounded-lg transition duration-300">
                                        <a href="{{ route('tour_details', $tour->id) }}"
                                            class="rounded-lg text-decoration-none text-surface hover:text-black">
                                            <img class="rounded-lg w-full h-[210px] object-cover"
                                                src="{{ asset($tour->trip_image)}}" alt="{{ $tour->trip_name }}" />
                                
                                            <div class="p-3 flex flex-col">
                                                <h5 class="mb-2 text-sm font-bold leading-tight">{{ $tour->trip_name }}</h5>
                                                <p class="text-md">Discover the best Orlando hotels for families for your vacation.</p>
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

        <div class="lg:max-w-[1110px] w-[90vw] mt-[50px] mx-auto flex flex-col md:flex-row justify-end items-center md:h-[300px] h-[200px] border gap-10 relative">
                    <div
                        class="bg-[#008000] rounded-full w-16 h-16 md:w-20 md:h-20 absolute left-1/2 transform -translate-x-1/2 md:translate-x-0 md:-left-5 bottom-5 md:bottom-10 shadow hidden md:block">
                    </div>
                <div class="bg-[#008000] rounded-full lg:h-[500px] h-[400px] lg:w-[500px] md:w-[400px] w-[300px]  flex items-center justify-center">
                    <div class="md:max-w-[250px] max-w-[200px] mx-auto">
                        <h2 class="text-white text-xl md:text-3xl font-bold tracking-tight ">Find Destination For your next trip</h2>
                        <a href="{{route('index')}}">
                            <button class="text-[#008000] text-center bg-white w-full py-2 rounded-lg mt-2">
                                Discover Home
                            </button>
                        </a>
                    </div>
                </div>
                <div class="hidden md:block">
                        <img src="https://as1.ftcdn.net/v2/jpg/02/70/83/06/1000_F_270830623_qqW0sXdUgHbpc5fONPdpPp5VwL7KPza6.jpg"
                            alt="Responsive Image" class="md:h-[250px] h-[150px] w-auto rounded-lg"  />
                </div>
        </div>



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
        <!--                @foreach ($reviews as $review)-->
        <!--                <div class="swiper-slide border rounded-lg shadow-sm ">-->
        <!--                    <div class="bg-white rounded-lg p-6 hover:scale-[1.01] transform transition duration-300">-->
        <!--                        <div class="w-20 h-20 rounded-full border-2 border-black overflow-hidden mb-4">-->
        <!--                            <img src="{{ asset($review->profile_image)}}" alt="profile img"-->
        <!--                                class="w-full h-full object-cover">-->
        <!--                        </div>-->
        <!--                        <h4 class="lg:text-xl font-semibold text-[#008000] mb-2">Wonderful day!</h4>-->
        <!--                        <p class="italic font-normal text-[#595959] mb-2 md:text-md text-sm">-->
        <!--                            {{$review->review}}-->
        <!--                        </p>-->
        <!--                        <h5 class="md:text-md text-sm font-bold text-gray-900 ">{{$review->user_name}}</h5>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                @endforeach-->
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
        var buttonOffset = button.offset().top;
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
        var buttonOffset = button.offset().top;
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

document.addEventListener("DOMContentLoaded", function () {
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
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('image-slider');
    const images = document.querySelectorAll('.image-item');
    const totalImages = images.length;
    let cardWidth = images[0].offsetWidth;
    let currentIndex = 0;
    let itemsToShow = getItemsToShow();

    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');

    // Initially hide the Previous button
    prevButton.style.display = 'none';

    function updateSlider() {
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
        cardWidth = images[0].offsetWidth;
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


      new Swiper(".mostPopularSwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        navigation: {
            nextEl: ".mostPopularSwiper-btn .swiper-button-next",
            prevEl: ".mostPopularSwiper-btn .swiper-button-prev",
        },
        pagination: {
            el: ".mostPopularSwiper-btn .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
            1280: { slidesPerView: 4 },
        },
    });
      new Swiper(".TopUniqueSwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        navigation: {
            nextEl: ".TopUniqueSwiper-btn .swiper-button-next",
            prevEl: ".TopUniqueSwiper-btn .swiper-button-prev",
        },
        pagination: {
            el: ".TopUniqueSwiper-btn .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
            1280: { slidesPerView: 4 },
        },
    });
      new Swiper(".perfectStaySwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        navigation: {
            nextEl: ".perfectStaySwiper-btn .swiper-button-next",
            prevEl: ".TopUniqueSwiper-btn .swiper-button-prev",
        },
        pagination: {
            el: ".perfectStaySwiper-btn .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
            1280: { slidesPerView: 4 },
        },
    });
      new Swiper(".dealsSwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        navigation: {
            nextEl: ".dealsSwiper-btn .swiper-button-next",
            prevEl: ".dealsSwiper-btn .swiper-button-prev",
        },
        pagination: {
            el: ".dealsSwiper-btn .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
            1280: { slidesPerView: 4 },
        },
    });
    
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
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
            1280: { slidesPerView: 4 },
        },
    });
    
    if (window.innerWidth >= 1024) { // Adjust breakpoint as needed
      document.querySelector(".first-article-banner-slide").style.flex = "0 0 50%";
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
                    640: { slidesPerView: 2 },
                    1024: { slidesPerView: 6 },
                },
            });
        });
</script>
@endsection