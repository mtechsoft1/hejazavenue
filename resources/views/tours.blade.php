@extends('layouts.app')

@section('title')
Tours
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


<style>
    .swiper-container-wrapper .swiper-button-next {
    background:white;
    color:black;
    width:25px;
    height:25px;
    border-radius : 50%;
    right:-15px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.4);
}
.swiper-container-wrapper .swiper-button-next:after {
    font-size: 12px
}

.swiper-container-wrapper .swiper-button-prev {
    background:white;
    color:black;
    width:25px;
    height:25px;    
    border-radius : 50%;
    left:-15px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.4);
}
.swiper-container-wrapper .swiper-button-prev:after {
    font-size: 12px
}

.swiper-wrapper {
    display: flex;
    align-items: stretch !important;
}

.swiper-container-wrapper {
  position: relative;
  width: 100%; 
}
</style>

<div class="bg-[#008000] h-[20px]"></div>
<section class="max-w-[1110px] w-[90vw] mx-auto">
    
    <!--    SECTION 1   START      -->
    
            <div class="lg:max-w-[1110px] w-[90vw] mx-auto text-white font-bold  flex items-center justify-center relative lg:bottom-8 my-2 ">
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
                                    class="py-[15px] md:text-md text-sm focus:ring-0 w-full font-normal text-gray-900 border-0"
                                    placeholder="Where are you going?" />
                            </div>
                        </div>

                        <!-- Location select -->
                        <div class="w-full col-span-5 border-2 border-[#ffb700]">
                            <div class="relative flex tems-center px-4">
                                <span class="text-gray-500 flex items-center">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </span>
                                <select
                                    class="font-normal py-[15px]  w-full text-black border-0 focus:ring-0 md:text-md text-sm"
                                    name="destination_id" id="single-filter">
                                    <option value="">Location</option>
                     
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
        
        <!--    SECTION 1   END      -->
        
        <!-- Navigation Section START -->

        <div class="flex items-center gap-2">
            <p class="text-[#008000] text-sm">Home</p>
            <p><span>></span></p>
            <p class="text-[#008000] text-sm">Search Results</p>
        </div>
        
        <!-- Navigation Section END -->
        
        <!-- MAIN SECTION START -->
        
        <div class="lg:grid lg:grid-cols-12 gap-3 mt-3">
            
            <!-- SIDEBAR START-->
            
                    <div class="col-span-3 hidden lg:block">
                        <!-- Map Container -->
                        <div id="map" class="w-full h-[200px] rounded-md shadow"></div>
                    
                        <!-- Filter Section -->
                        <div class="mt-4">
                            <div class="border p-2 rounded-md">
                                <h3 class="text-lg font-semibold">Filter By</h3>
                            </div>
                            <div class="border p-2 rounded-md space-y-2">
                                <div class="flex items-center space-x-2">
                                        <h4 class="font-bold text-sm">Destinations</h4>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Kashmir</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Murree</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">islamabad</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Lahore</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                            </div>
                            <div class="border p-2 space-y-2">
                                <div class="flex items-center space-x-2">
                                        <h4 class="font-bold text-sm">Price</h4>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">2300 PKR</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                            </div>
                            <div class="border p-2 space-y-2">
                                <div class="flex items-center space-x-2">
                                        <h4 class="font-bold text-sm">Top Trip Planner</h4>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                            </div>
                            <div class="border p-2 space-y-2">
                                <div class="flex items-center space-x-2">
                                        <h4 class="font-bold text-sm">Popular Tour Planner</h4>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                            </div>
                            <div class="border p-2 space-y-2">
                                <div class="flex items-center space-x-2">
                                        <h4 class="font-bold text-sm">Distance</h4>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox text-blue-600 rounded-sm">
                                        <p class="text-sm text-[#1a1a1a]">Filter 1</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#1a1a1a]">23</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            
            <!-- SIDEBAR END -->
            
            <!-- Tours START -->
            
            <div class="col-span-9">
                 <div>
                     <h2 class="text-xl font-bold m-0 ps-3">Lahore: 233 Tours Found</h2>
                        <div x-data="{ open: false, selected: 'Sort By' }" class="relative mt-3 inline-block">
                            <!-- Button that shows the current selection and toggles the dropdown -->
                            <button @click="open = !open" class="flex items-center justify-between w-full rounded-full border border-gray-300 px-4 py-2 bg-white text-sm">
                                <span x-text="selected"></span>
                                <span class="material-icons">arrow_drop_down</span>
                            </button>
                            <!-- Dropdown menu -->
                            <div x-show="open" @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 transform scale-95"
                                     x-transition:enter-end="opacity-100 transform scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 transform scale-100"
                                     x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute text-sm left-0 w-full mt-1 bg-white shadow-lg rounded-sm z-10 transition duration-500 ease-in-out">
                                <ul class="py-1">
                                    <li @click="selected = 'Sort By'; open = false" class="cursor-pointer px-4 py-2 hover:bg-gray-100">Sort By </li>
                                    <li @click="selected = 'Top Tours'; open = false" class="cursor-pointer px-4 py-2 hover:bg-gray-100">Top Tours</li>
                                    <li @click="selected = 'Top Reviews'; open = false" class="cursor-pointer px-4 py-2 hover:bg-gray-100">Top Reviews</li>
                                </ul>
                            </div>
                        </div>

                 </div>
                 
                 <div class="space-y-3 mt-3">
                     @foreach($tours as $tour)
                            
                     <div class="p-3 sm:grid sm:grid-cols-12 gap-3 border rounded-lg">
                         <div class="col-span-3">
                             <div class="w-full h-[170px] relative">
                                <i class="material-icons cursor-pointer text-[#1a1a1a] text-[18px] absolute top-3 right-3 bg-white p-2 rounded-full">favorite_border</i>
                            <a href="{{ route('tour_details', $tour->id) }}">
                            <img class="rounded-lg object-cover w-full h-full h-[170px]"
                                src="{{ asset($tour->trip_image)}}"
                                alt="{{ $tour->trip_name }}" />
                            </a>
                             </div>
                         </div>
                         <div class="col-span-9">
                             <div class="grid grid-cols-12 gap-2">
                                 <div class="col-span-9">
                                        <h5 class="mb-2 text-lg font-bold leading-tight text-[#008000] m-0 p-0">{{ $tour->trip_name }}</h5>
     
                                        <p class="text-sm text-[#1a1a1a] mt-1">
                                                {{ \Illuminate\Support\Str::words($tour->trip_description, 30, '...') }}
                                        </p>
                                        
                                        <div class="flex items-center mt-3 gap-2">
                                            <!--<p class="font-bold">Duration: </p>-->
                                            <p class="text-sm text-start text-[#1a1a1a] leading-tight">
                                                    {{ $tour->trip_duration }}
                                            </p>
                                        
                                        </div>
                                         <div class="flex items-center mt-1 gap-2">
                                        <p class="font-bold text-sm">Tour Date: </p>
                                         <p class="text-sm font-normal text-start text-[#1a1a1a] leading-tight">
                                             {{ \Carbon\Carbon::parse($tour->trip_start_date)->format('Y-m-d') }}
                                        </p>
                                         </div>
                                
                                 </div>
                                 <div class="col-span-3">
	                                 <div class="flex justify-end gap-1">
                                         <div>
                                            <p class="text-sm text-[#1a1a1a] font-bold text-end">Good</p>
                                            <p class="text-[#1a1a1a] text-xs">118 Reviews</p>
                                         </div>
                                        <span class="ps-1 rounded-md text-white">
                                            <p class="bg-green-800 p-1 text-sm rounded flex items-center">
                                                {{ $tour->average_rating ?? $tour->rating}}
                                            </p>
                                        </span>
	                                 </div>
	                                 
                                     <div class="mt-3">
      
                                             @if ($tour->pickup_points)
                                                <p class="text-[#1a1a1a] text-sm text-end mt-1 flex items-center justify-end">
                                                    <span class="material-icons mr-1 text-base text-[#008000]">location_on</span>
                                                    {{ $tour->pickup_points->pickup_city }}
                                                </p>
                                            @endif
 
                                            <div class="flex flex-col text-end mt-1">
                                                <h1 class="text-sm font-bold text-[#1a1a1a]">
                                                    @if (isset($tour->pickup_points->per_seat_fare_currency))
                                                        {{ $tour->pickup_points->per_seat_fare_currency }}
                                                    @else
                                                        PKR
                                                    @endif
                                                    @if (isset($tour->pickup_points->per_seat_fare))
                                                        {{ $tour->pickup_points->per_seat_fare }}
                                                    @else
                                                        0.00
                                                    @endif
                                                </h1>
                                            </div>
                                    </div>
                                 </div>
                             </div>
                        </div>
                     </div>

                     @endforeach
                     
                     <div class="text-center mt-3">
                         <button class="text-white bg-[#008000] text-md font-normal px-3 py-1 rounded-2xl">Load More</button>
                     </div>
                     
                 </div>
                 
            <div id="featured" class="packages mt-3">
                <div>
                    <div class="flex justify-between">
                        <div>
                            <h2 class="text-2xl font-bold ps-2 py-2">Recently viewed</h2>
                        </div>
                    <div class="flex items-end">
                        <a href="{{route('tours')}}">
                            <button class="text-sm font-normal border-0 px-4 py-1  text-[#008000] rounded-lg">See All</button>
                        </a>
                    </div>
    
                    </div>
                        
                    </div>
            
                    <!-- Swiper Container -->
                <div class="swiper-container-wrapper recentlyViewedSwiper-btn">
                    <div class="swiper recentlyViewedSwiper mt-1">
                        <div class="swiper-wrapper">
                            @foreach ($tours as $tour)
                                <div class="swiper-slide border rounded-lg shadow-sm ">
                                    <div class="relative flex flex-col transition duration-300">
                                <i class="material-icons cursor-pointer text-[#1a1a1a] text-[18px] absolute top-3 right-3 bg-white p-2 rounded-full">favorite_border</i>
                                        <a href="{{ route('tour_details', $tour->id) }}"
                                            class="rounded-lg text-decoration-none text-surface hover:text-black">
                                            <img class="rounded-lg w-full h-[120px] object-cover"
                                                src="{{ asset($tour->trip_image)}}" alt="{{ $tour->trip_name }}" />
                                
                                            <div class="p-3 flex flex-col gap-1">
                                                <h5 class="mb-2 text-sm font-bold leading-tight">{{ $tour->trip_name }}</h5>
                                                <div class="flex items-center justify-start gap-3">
                                                    @if ($tour->pickup_points)
                                                        <p class="text-[#595959] flex items-center text-sm">
                                                            <span class="material-icons text-[#008000] me-1 text-lg">location_on</span>
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
                                                <div class="flex justify-between gap-1 items-center mt-2">
                                                    <h5 class="text-xs font-normal text-gray-500 leading-tight">
                                                        {{ $tour->trip_duration }}
                                                    </h5>
                                                    <div class="flex flex-col text-right">
                                                        <h1 class="text-xs font-bold">
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
            <div id="featured" class="packages mt-3">
                <div>
                    <div class="flex justify-between">
                        <div>
                            <h2 class="text-2xl font-bold ps-2 py-2">Great deals</h2>
                        </div>
                    <div class="flex items-end">
                        <a href="{{route('tours')}}">
                            <button class="text-sm font-normal border-0 px-4 py-1  text-[#008000] rounded-lg">See All</button>
                        </a>
                    </div>
    
                    </div>
                        
                    </div>
            
                    <!-- Swiper Container -->
                <div class="swiper-container-wrapper greatDealsSwiper-btn">
                    <div class="swiper greatDealsSwiper mt-1">
                        <div class="swiper-wrapper">
                            @foreach ($tours as $tour)
                                <div class="swiper-slide border rounded-lg shadow-sm ">
                                    <div class="relative flex flex-col transition duration-300">
                                <i class="material-icons cursor-pointer text-[#1a1a1a] text-[18px] absolute top-3 right-3 bg-white p-2 rounded-full">favorite_border</i>
                                        <a href="{{ route('tour_details', $tour->id) }}"
                                            class="rounded-lg text-decoration-none text-surface hover:text-black">
                                            <img class="rounded-lg w-full h-[120px] object-cover"
                                                src="{{ asset($tour->trip_image)}}" alt="{{ $tour->trip_name }}" />
                                
                                            <div class="p-3 flex flex-col gap-1">
                                                <h5 class="mb-2 text-sm font-bold leading-tight">{{ $tour->trip_name }}</h5>
                                                <div class="flex items-center justify-start gap-3">
                                                    @if ($tour->pickup_points)
                                                        <p class="text-[#595959] flex items-center text-sm">
                                                            <span class="material-icons text-[#008000] me-1 text-lg">location_on</span>
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
                                               <div class="flex gap-2 text-right mt-2">
                                                        <p class="text-xs font-bold text-red-500">
                                                            <del>
                                                                {{ $tour->pickup_points->per_seat_fare_currency ?? 'PKR' }}
                                                                {{ $tour->pickup_points->per_seat_fare ?? '0.00' }}
                                                            </del>
                                                        </p>
                                                        <p class="text-xs font-bold text-gray-500">
                                                            {{ 'PKR' }}
                                                            {{ '20.00' }}
                                                        </p>
                                                    </div>
                                                <div class="flex flex-col gap-1 items-start justify-start">
                                                    <h5 class="text-xs font-normal text-gray-500 leading-tight">
                                                        {{ $tour->trip_duration }}
                                                    </h5>
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
            
            <!-- Tours END -->
            
        </div>
        
        <!-- MAIN SECTION END -->

</section>

<script>
      new Swiper(".recentlyViewedSwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        autoHeight: true,
        loop: true,
        navigation: {
            nextEl: ".recentlyViewedSwiper-btn .swiper-button-next",
            prevEl: ".recentlyViewedSwiper-btn .swiper-button-prev",
        },
        pagination: {
            el: ".recentlyViewedSwiper-btn .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
            1280: { slidesPerView: 4 },
        },
    });
      new Swiper(".greatDealsSwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        autoHeight: true,
        loop: true,
        navigation: {
            nextEl: ".greatDealsSwiper-btn .swiper-button-next",
            prevEl: ".greatDealsSwiper-btn .swiper-button-prev",
        },
        pagination: {
            el: ".greatDealsSwiper-btn .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
            1280: { slidesPerView: 4 },
        },
    });
    
    document.addEventListener("DOMContentLoaded", function () {
        var map = L.map('map', {
            zoomControl: false,  
            dragging: true,  
            scrollWheelZoom: false
        }).setView([51.505, -0.09], 13);  

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker; 

        // Handle map click event
        map.on('click', function (e) {
            const { lat, lng } = e.latlng;

            // Remove existing marker before adding a new one
            if (marker) {
                map.removeLayer(marker);
            }

            // Add a marker at the selected location
            marker = L.marker([lat, lng]).addTo(map);

            // Update selected location text
            document.getElementById("selected-coordinates").innerText = `Selected: ${lat.toFixed(5)}, ${lng.toFixed(5)}`;
        });
    });
</script>
@endsection



@section('script')
<!-- Add any custom JS if needed -->
@endsection