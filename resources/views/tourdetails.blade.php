@extends('layouts.app')
@section('title')
Tour Details
@endsection
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
.img-container {
    display: flex;
    transition: transform 0.3s ease-in-out;
}

p {
    margin: 0px !important;
}

.img-container>div {
    flex: 0 0 calc(100%/4);
    box-sizing: border-box;
}


@media (max-width: 1024px) {
    .img-container>div {
        flex: 0 0 calc(100% / 2);
    }
}

@media (max-width: 768px) {
    .img-container>div {
        flex: 0 0 100%;
    }
}


#cards-slider {
    display: flex;
    transition: transform 0.5s ease-in-out;

}

.cards-item {
    flex: 0 0 32.8%;

}

@media (max-width: 1024px) {
    .cards-item {
        flex: 0 0 49%;

    }
}

@media (max-width: 768px) {
    .cards-item {
        flex: 0 0 100%;

    }
}




/* Button Styling */
#prev,
#next {
    z-index: 10;
    /* Ensure buttons appear above content */
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    background-color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

#prevBtn,
#nextBtn {
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

.swiper .swiper-button-next {
    background:white;
    color:black;
    padding: 10px 20px;
    font-size: 18px;
    border-radius : 50%;
}
.swiper .swiper-button-next:after {
    font-size: 18px
}

.swiper .swiper-button-prev {
    background:white;
    color:black;
    padding: 10px 20px;
    font-size: 18px;
    border-radius : 50%;
}
.swiper .swiper-button-prev:after {
    font-size: 18px
}
</style>


<script>
    
    function faqHandler() {
    // Initialize window.tours with backend data
    window.tours = @json($tour);

    return {
        openSection: null,
        sections: [
            { title: "What’s Included", content: window.tours.whats_included || "N/A" },
            { title: "Departure & Return", content: window.tours.departure_and_return || "N/A" },
            { title: "Accessibility", content: window.tours.accessibility || "N/A" },
            { title: "Additional Information", content: window.tours.additional_information || "N/A" },
            { title: "Cancellation Policy", content: window.tours.cancellation_policy || "N/A" },
            { title: "FAQ", content: window.tours.faq || "N/A" }
        ],
        toggleSection(index) {
            this.openSection = this.openSection === index ? null : index;
        }
    };
}


document.addEventListener('alpine:init', () => {
    Alpine.data('bookingDetails', (fares) => ({
        selectedCity: '', // Default value for dropdown
        fares: fares, // Dynamic data from backend
        
        init() {
            console.log("Booking Details Initialized!", this.fares);
        }
    }));
});

</script>

<!--  -->

<div class="bg-[#008000] pb-5 pt-3">
    <div class="lg:max-w-[1110px] w-[90vw] mx-auto">
        <form action="{{ route('search_tours') }}" method="post" enctype="multipart/form-data" class="">
            @csrf
            <div class="md:grid md:grid-cols-5 gap-3 md:space-y-0 space-y-3">
                <div class="relative col-span-2 w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center pl-2 ps-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="simple-search" name="destination"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-md focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 py-3 rounded-lg"
                        placeholder="Where are you going?" />
                </div>

                <div class="relative col-span-2 w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center pl-2 ps-3 pointer-events-none">
                        <!-- SVG Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>

                    <select id="simple-search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-md focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 py-3 rounded-lg"
                        name="destination_id">
                        <option value="">Destination Location</option>
                        @foreach ($destinations as $destination)
                        <option value="{{ $destination->id }}">{{ $destination->destination_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Search Button -->
                <button type="submit" class="w-full py-3 text-center border bg-[#108a00] text-white rounded-lg">
                    Search
                </button>
            </div>
        </form>
    </div>
</div>

<div class="w-full">
    <div class=" lg:max-w-[1110px] w-[90vw] mx-auto mt-5">
        <div class="flex flex-wrap gap-3 py-2">
            <span class="flex items-center gap-2 text-sm text-gray-500">
                <a href="{{ route('index') }}"
                    class="text-blue-500 hover:text-blue-700 transition-all duration-300 text-decoration-none font-bold"
                    style="color:green">Home</a>
                <span>&gt;</span>
            </span>

            <span class="flex items-center gap-2 text-sm  text-slate-500 transition-all duration-300 "
                style="color:#4d636e">
                {{ $tour->trip_name }}
            </span>
        </div>

    </div>
    <!-- Breadcrumb End -->


    <!-- Tabs start -->
    <div class="lg:max-w-[1110px] w-[90vw] mx-auto mt-3">
        <ul class="w-full m-0 flex flex-col lg:flex-row border-b border-gray-200 pb-2 pl-0">
            <li class="lg:w-1/5 w-full">
                <a href="#overview" id="overview-tab"
                    class="nav-link text-md font-normal block p-0"
                    onclick="setActiveTab(event)" style="color:#4d636e">
                    <span class="border-b-2 border-transparent hover:border-green-500 transition duration-300 pb-2">Overview</span>
                </a>
            </li>
            <li class="lg:w-1/5 w-full">
                <a href="#info" id="info-tab"
                    class="nav-link text-slate-500 text-md font-normal block p-0"
                    onclick="setActiveTab(event)" style="color:#4d636e">
                    <span class="border-b-2 border-transparent hover:border-green-500 transition duration-300 pb-2">Info & Prices</span>
                </a>
            </li>
            <li class="lg:w-1/5 w-full">
                <a href="#availability" id="facilities-tab"
                    class="nav-link text-slate-500 text-md font-normal block p-0 "
                    onclick="setActiveTab(event)" style="color:#4d636e">
                    <span class="border-b-2 border-transparent hover:border-green-500 transition duration-300 pb-2">Facilities</span>
                </a>
            </li>
            <li class="lg:w-1/5 w-full">
                <a href="#availability" id="rules-tab"
                    class="nav-link text-slate-500 text-md font-normal block p-0"
                    onclick="setActiveTab(event)" style="color:#4d636e">
                    <span class="border-b-2 border-transparent hover:border-green-500 transition duration-300 pb-2">Cancelation Policy</span>
                </a>
            </li>
            <li class="lg:w-1/5 w-full">
                <a href="#reviews" id="reviews-tab"
                    class="nav-link text-slate-500 text-md font-normal block p-0"
                    onclick="setActiveTab(event)" style="color:#4d636e">
                    <span class="border-b-2 border-transparent hover:border-green-500 transition duration-300 pb-2">User Review ({{$tour->reviews_count}})</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Tabs End -->

    <!-- Tab Content -->
    <div class="tab-content lg:max-w-[1110px] w-[90vw] mx-auto " id="myTabContent">
        <div class="tab-pane fade show active flex flex-col gap-2" id="overview" role="tabpanel" style="
             width: 100%;
             display:flex;
            ">
            <div class="flex md:justify-between justify-center items-center flex-col md:flex-row gap-2">
                <div class="flex gap-4 items-center p-2 mt-3">
                    <div class="flex items-center space-x-2">
                        <span class="flex gap-1">
                            @foreach(range(1,5) as $i)
                            <span class="fa-stack" style="width:1em">
                                @if(round($tour->rating) >= $i)
                                <i class="fas fa-star fa-stack-1x" style="color:green"></i>
                                @else
                                <i class="fas fa-star fa-stack-1x" style="color:black"></i>
                                @endif
                            </span>
                            @endforeach
                        </span>
                    </div>

                    <div class="relative inline-block">
                        <div
                            class="likeButton bg-[#108a00] p-1 text-sm  rounded-lg hover:bg-[#0a6f00] transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                            </svg>
                            <span
                                class="tooltip-text absolute bottom-full left-1/2 transform -translate-x-1/2 mt-2 hidden w-48 p-2 text-white bg-green-600 rounded-lg text-sm z-10">
                                Located in Agra, 2.4 miles from Taj Mahal, Trident Agra provides accommodations
                                with an outdoor swimming pool, free private parking, a fitness center and a
                                garden. This 5-star hotel offers room service and a concierge service. The
                                property has a 24-hour front desk, airport transportation, a kids' club and free
                                WiFi throughout the property.
                            </span>
                        </div>

                    </div>

                    <style>
                    .likeButton:hover .tooltip-text {
                        display: block;
                    }
                    </style>

                    <div>
                        <div class=" bg-gray-100 text-[#4d636e] text-sm p-2 rounded-sm">Airport shuttle</div>
                    </div>
                </div>
                <div class="flex gap-4 items-center p-2 mt-3">
                    <div><a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="green" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>

                        </a></div>
                    <div>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="green" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                            </svg>

                        </a>
                    </div>
                    <div>
                        @auth
                        <a href="{{ route('booking_details', $tour->id) }}"
                            class="text-center text-slate-50 border bg-[#008000] transition-all duration-300 hover:text-white text-decoration-none border-gray-300 focus:outline-none hover:bg-[#108a00] focus:ring-2 focus:ring-green-300 font-normal rounded-lg text-md px-3 py-2.5">
                            Book Now
                        </a>
                        @endauth

                        @guest
                        <a href="{{ route('login') }}"
                            class="bg-[#008000] text-white p-2 rounded text-decoration-none text-sm hover:bg-[#108a00]">Book
                            Now</a>
                        </a>
                        @endguest
                    </div>
                </div>
            </div>

            <!-- Description -->
            {{-- <div class="flex flex-col mt-3">
                <!--<h2 class="font-bold text-xl py-2 my-1">{{ $tour->trip_description }}</h2>-->
                <div class="lg:w-1/3 w-full  flex flex-col md:flex-row items-center justify-between gap-3">
                    <div class="flex">
                        <p class="flex text-sm m-0 text-[#4d636e]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="green" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>

                            {{ $tour->trip_name }}
                        </p>
                    </div>
                    <div class="flex gap-1">
                        <p class="text-sm m-0 p-1 bg-[#008000] text-white">
                            Tour By
                            {{ $tour->user->company_name }}
                        </p>
                    </div>
                </div>
            </div> --}}
            <!-- Description end -->

            <!-- galler images and slider -->
            <div class="w-full m-0  flex flex-col lg:flex-row gap-4 mt-4">
                <div class="lg:w-[70%] w-full ">
                    <div class="w-full flex flex-col gap-2 h-[500px]">
                        <div class="w-full flex gap-2 h-[80%]">
                            <div class=" flex flex-col gap-2 w-[30%] ">
                                @foreach($gallery_images as $index => $gallery_image)
                                @if($index < 2) <img src="{{ asset($gallery_image->image) }}"
                                    alt="{{ $tour->trip_name }}" class="w-full h-1/2 object-cover rounded-md">
                                    @endif
                                    @endforeach
                            </div>
                            <div class="w-[70%]">
                                @foreach($gallery_images as $index => $gallery_image)
                                @if($index == 2)
                                <img src="{{ asset($gallery_image->image) }}" alt="{{ $tour->trip_name }}"
                                    class="w-full h-full object-cover rounded-md">
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="grid grid-cols-5 gap-2">
                            @foreach($gallery_images->skip(2)->take(5) as $gallery_image)
                                <img src="{{ asset($gallery_image->image) }}" alt="" class="w-full h-[100px] rounded-md">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="lg:w-[30%] w-full border border-gray-700 flex flex-col gap-2 ">
                    <div class="flex flex-col main relative">
                        <div>
                            <a href="#"
                                class="border border-black h-auto w-full flex text-decoration-none justify-end items-center gap-2 p-2">
                                <div class="flex flex-col leading-none">
                                    <span class="text-lg  m-0  text-[#4d636e]">wonderful</span>
                                    <span class="text-sm m-0 text-[#acacac]">{{$tour->reviews_count}} reviews</span>
                                </div>
                                <div>
                                    <span
                                        class="bg-[#008000] text-white text-sm font-bold p-2 rounded">{{$tour->rating}}</span>
                                </div>
                            </a>
                        </div>
                        <div class="flex flex-col gap-1">
                            <div class="text-center mt-2">
                                <h1 class="text-sm p-0 m-0 text-[#4d636e]">Guests who stayed here loved</h1>
                            </div>
                            @foreach($reviews as $review)
                            @if ($loop->first)
                            <div class="flex justify-center h-[80px] m-0">
                                <p id="testimonial-text" class="text-sm text-[#4d636e] px-2"> 
                                    {{ \Illuminate\Support\Str::limit($review->review, 150, $end='...') }}
                                </p>
                            </div>
                            <div class="flex w-full justify-between items-center gap-2 p-2 bg-[#d4d8da]">
                                <div class="flex gap-4 items-center">
                                     <div class="w-10 h-10 border-2 border-green-700 rounded-full flex items-center justify-center bg-green-700 text-white text-xl font-bold">
                                        {{ strtoupper(substr($review->user_name, 0, 1)) }}
                                    </div>
                                    <div class="">
                                        <h1 id="testimonial-name" class="text-lg p-0 m-0 text-green-700">
                                            {{$review->user_name}}</h1>
                                        <h2 id="testimonial-location" class="text-sm font-light p-0 m-0">From
                                            {{$review->address}}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach

                        </div>
                        <div class="absolute right-0 bottom-4">
                            <button class="text-[#4d636e] focus:outline-none font-medium text-sm" onclick="nextSlide()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="lg:h-1/2 h-56 pt-3">
                        <div class="h-full w-full" id="map"></div>
                    </div>
                </div>
            </div>

            <!-- Services -->
            <div class="w-full flex flex-wrap justify-between p-2 mt-5">
                @foreach ($benefits as $benefit )
                    
              @if($benefit->benefit_name == 'Wonderful Breakfast')
              <div class="border border-black flex gap-1 items-center p-2 rounded-lg w-full sm:w-[48%] md:w-[30%] lg:w-[15%]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                </svg>
                <span class="text-sm">{{$benefit->benefit_name}}</span>
            </div>
                @endif
                @if($benefit->benefit_name == 'Restaurant')
                <div
                    class="border border-black flex gap-1 items-center p-2 rounded-lg w-full sm:w-[48%] md:w-[30%] lg:w-[15%]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                    </svg>
                    <span class="text-sm">{{$benefit->benefit_name}}</span>
                </div>
                @endif
                @if($benefit->benefit_name == 'Spa')
                <div
                    class="border border-black flex gap-1 items-center p-2 rounded-lg w-full sm:w-[48%] md:w-[30%] lg:w-[15%]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                    <span class="text-sm">{{$benefit->benefit_name}}</span>
                </div>
                @endif
                @if($benefit->benefit_name == 'Outdoor swimming pool')
                <div
                    class="border border-black flex gap-1 items-center p-2 rounded-lg w-full sm:w-[48%] md:w-[30%] lg:w-[15%]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                    <span class="text-sm">{{$benefit->benefit_name}}</span>
                </div>
                @endif
                @if($benefit->benefit_name == 'Airport shuttle')
                <div
                    class="border border-black flex gap-1 items-center p-2 rounded-lg w-full sm:w-[48%] md:w-[30%] lg:w-[15%]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                    </svg>
                    <span class="text-sm">{{$benefit->benefit_name}}</span>
                </div>
                @endif
                @if($benefit->benefit_name == 'Paid private parking')
                <div
                    class="border border-black flex gap-1 items-center p-2 rounded-lg w-full sm:w-[48%] md:w-[30%] lg:w-[15%]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-3A2.25 2.25 0 0 0 8.25 5.25V9m7.5 0H8.25m7.5 0h2.25A2.25 2.25 0 0 1 20.25 11.25v9A2.25 2.25 0 0 1 18 22.5H6a2.25 2.25 0 0 1-2.25-2.25v-9A2.25 2.25 0 0 1 6 9h2.25m7.5 0v9.75a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75V9m3 4.5h.008v.008H11.25V13.5Z" />
                    </svg>
                    <span class="text-sm">{{$benefit->benefit_name}}</span>
                </div>
                @endif
                @endforeach
            </div>


            <!-- Reseve -->
            <!-- <div class=" m-0  flex flex-col lg:flex-row gap-5 mt-4" id="info">
                <div class=" w-full sm:w-[90%] md:w-[80%] lg:w-[70%] mx-auto">
                    <div class="flex flex-col">
                        <h1 class="text-base md:text-lg text-md font-bold">Get the celebrity treatment with world-class service
                        </h1>
                        <p class="md:text-md text-sm text-[#4d636e] text-justify">{{ $tour->trip_description }}
                        </p>
                    </div>
                    <div class="flex flex-col gap-3 mt-3">
                        <div class="flex flex-wrap gap-2">
                            @foreach ($benefits as $benefit )
                                 
                           @if($benefit->benefit_name == 'Wonderful Breakfast')
                            <div
                                class="border border-black flex gap-2 items-center p-2 rounded-lg w-full sm:w-[48%] md:w-[30%] lg:w-[32%]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                                </svg>
                                <span class="text-sm">{{$benefit->benefit_name}}</span>
                            </div>
                            @endif
                            @if($benefit->benefit_name == 'Restaurant')
                            <div
                                class="border border-black flex gap-2 items-center p-2 rounded-lg w-full sm:w-[48%] md:w-[30%] lg:w-[32%]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                                </svg>
                                <span class="text-sm">{{$benefit->benefit_name}}</span>
                            </div>
                            @endif
                            @if($benefit->benefit_name == 'Spa')
                            <div
                                class="border border-black flex gap-2 items-center p-2 rounded-lg w-full sm:w-[48%] md:w-[30%] lg:w-[32%]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                </svg>
                                <span class="text-sm">{{$benefit->benefit_name}}</span>
                            </div>
                            @endif
                            @endforeach

                        </div>
                        
                            
                     
                        <div class="flex flex-wrap gap-2">
                            @foreach ($benefits as $benefit)
                                
                         
                            @if ($benefit->benefit_name == 'swimming pool')
                            <div
                                class="border border-black flex gap-2 items-center p-2 rounded-lg w-full sm:w-[48%] md:w-[30%] lg:w-[32%]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                </svg>
                                <span class="text-sm"> {{$benefit->benefit_name}}</span>
                            </div>
                            @endif
                            @if ($benefit->benefit_name == 'Fitness Center')
                            <div
                                class="border border-black flex gap-2 items-center p-2 rounded-lg w-full sm:w-[48%] md:w-[30%] lg:w-[32%]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.75 3.75h4.5a6 6 0 0 1 6 6v7.5h1.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1 0-1.5H5.25v-7.5a6 6 0 0 1 6-6Z" />
                                </svg>
                                <span class="text-sm">Fitness Center</span>
                            </div>
                            @endif
                            @if ($benefit->benefit_name == 'Concierge Service')
                                
                           
                            <div
                                class="border border-black flex gap-2 items-center p-2 rounded-lg w-full sm:w-[48%] md:w-[30%] lg:w-[32%]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.75 3.75h4.5a6 6 0 0 1 6 6v7.5h1.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1 0-1.5H5.25v-7.5a6 6 0 0 1 6-6Z" />
                                </svg>
                                <span class="text-sm"> {{$benefit->benefit_name}}</span>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:w-[30%] w-full flex flex-col gap-2 border rounded-lg">
                    <div class="w-full flex flex-col items-center justify-center p-2 gap-2">
                            <h1 class="m-0 p-0 text-xl font-bold text-center">Company Details</h1>
                            <div class="w-full flex justify-center">
                                <div class="w-14 h-14 border-2 border-green-700 rounded-full">
                                    <img class="w-full h-full" src="{{ asset($agency->profile_image) }}" alt="">
                                </div>
                            </div>
                            <div class="w-full flex justify-center ">
                                <h3 class="m-0 p-0 text-md font-bold text-[#4d636e]">{{$agency->company_name}}</h3>
                            </div>
                            <div class="flex gap-2 items-center">
                                <div class="flex items-center space-x-1">
                                    <span class="flex gap-1">
                                        @foreach(range(1,5) as $i)
                                        <span class="fa-stack" style="width:1em">
                                            @if(round($tour->rating) >= $i)
                                            <i class="fas fa-star fa-stack-1x" style="color:#008000"></i>
                                            @else
                                            <i class="fas fa-star fa-stack-1x" style="color:black"></i>
                                            @endif
                                        </span>
                                        @endforeach
                                    </span>
                                </div>
                                <div>
                                    <span class="text-lg">{{$tour->rating}}</span>
                                </div>
                            </div>
                            <div class="flex gap-2 tex-sm">
                                <p class="flex text-sm m-0 text-[#4d636e]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="green" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>

                                    {{$agency->addrss}} {{$agency->city}}, {{$agency->country}}
                                </p>
                            </div>
                            <div class="w-full flex justify-center">
                                <button
                                    class="chat-button bg-[#008000] text-white text-lg p-2 rounded-lg flex items-center justify-center gap-1">
                                    <span class="chat-button-icon"><img
                                            src="{{ asset('./details-page/icons/chat.png') }}" alt=""></span>
                                    <!--<span>Chat With Host</span>-->
                                </button>
                            </div>
                        </div>
                </div>
            </div> -->

            <div class="border-b border-gray-200 w-full mt-4 mb-4"></div>

            <!-- Booking Detail -->
            <div x-data="bookingDetails({{ json_encode($fares) }})" class="w-full flex flex-col lg:flex-row gap-2" id="facilities">

                <div class="lg:w-[70%] w-full flex flex-col gap-2">
                    <h1 class="m-0 p-0 md:text-2xl text-xl font-bold">Booking Details</h1>
                    <div class="w-full mt-3">
                        <div class="flex w-full">
                            <select x-model="selectedCity" class="city-dropdown w-full rounded-md">
                                <option value="" disabled selected>Select Pickup Points</option>
                                <template x-for="(fare, city) in fares" :key="city">
                                    <option :value="city" x-text="city"></option>
                                </template>
                            </select>
                            <div id="loader" class="loader"></div>
                        </div>
                        <div class="w-full mt-3">
                            <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                                <tbody>
                                    <tr class="bg-gray-100">
                                        <td class="px-4 py-2 font-semibold">Per Seat Fare:</td>
                                        <td class="px-4 py-2" x-text="selectedCity ? fares[selectedCity].perSeatFare : '-'"></td>
                                    </tr>
                                    <tr class="border-t border-gray-300">
                                        <td class="px-4 py-2 font-semibold text-gray-700">Couple Package Fare:</td>
                                        <td class="px-4 py-2" x-text="selectedCity ? fares[selectedCity].coupleFare : '-'"></td>
                                    </tr>
                                    <tr class="border-t border-gray-300 bg-gray-100">
                                        <td class="px-4 py-2 font-semibold text-gray-700">Family Package Fare:</td>
                                        <td class="px-4 py-2" x-text="selectedCity ? fares[selectedCity].familyFare : '-'"></td>
                                    </tr>
                                    <tr class="border-t border-gray-300">
                                        <td class="px-4 py-2 font-semibold text-gray-700">Honeymoon Package Fare:</td>
                                        <td class="px-4 py-2" x-text="selectedCity ? fares[selectedCity].honeymoonFare : '-'"></td>
                                    </tr>
                                    <tr class="border-t border-gray-300 bg-gray-100">
                                        <td class="px-4 py-2 font-semibold text-gray-700">Pickup Date:</td>
                                        <td class="px-4 py-2" x-text="selectedCity ? fares[selectedCity].pickupDate : '-'"></td>
                                    </tr>
                                    <tr class="border-t border-gray-300">
                                        <td class="px-4 py-2 font-semibold text-gray-700">Pickup Time:</td>
                                        <td class="px-4 py-2" x-text="selectedCity ? fares[selectedCity].pickupTime : '-'"></td>
                                    </tr>
                                    <tr class="border-t border-gray-300 bg-gray-100">
                                        <td class="px-4 py-2 font-semibold text-gray-700">Pickup Point:</td>
                                        <td class="px-4 py-2" x-text="selectedCity ? fares[selectedCity].pickupPoint : '-'"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Availability -->
            <div id="availability" class="m-0 w-full flex flex-col gap-2">
                <div class="w-full mx-auto" x-data="faqHandler()">
                    <h1 class="text-2xl font-bold p-3">Availability</h1>
            
                    <!-- Sections -->
                    <template x-for="(section, index) in sections" :key="index">
                        <div class="border-b border-gray-300">
                            <button @click="toggleSection(index)"
                                class="w-full flex justify-between items-center p-3 text-gray-700 font-semibold text-lg focus:outline-none">
                                <span x-text="section.title"></span>
                                <span class="material-icons" x-text="openSection === index ? 'remove' : 'add'"></span>
                            </button>
                            <div x-show="openSection === index" x-collapse class="px-3 pb-3 text-gray-600">
                                <span x-text="section.content"></span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Similar experience -->
                    <div id="featured" class="packages lg:max-w-[1110px] w-[90vw] mx-auto mt-3">
                <div>
                    <div class="flex justify-between">
                        <div>
                        <h2 class="text-2xl font-bold ps-2 pt-2">Similar experience</h2>
                        </div>
                    <div class="flex items-end">
                        <a href="{{route('tours')}}">
                            <button class="text-sm font-normal border-0 px-4 py-1  text-[#008000] rounded-lg">See All</button>
                        </a>
                    </div>
    
                    </div>
                        
                    </div>
            
                    <!-- Swiper Container -->
                    <div class="swiper mostPopularSwiper mt-1">
                        <div class="swiper-wrapper">
                            @foreach ($tours as $tour)
                                <div class="swiper-slide border rounded-lg shadow-sm ">
                                    <div class="relative flex flex-col shadow-md rounded-lg transition duration-300">
                                <i class="material-icons cursor-pointer text-[#1a1a1a] text-[18px] absolute top-3 right-3 bg-white p-2 rounded-full">favorite_border</i>
                                        <a style="color:#1a1a1a" href="{{ route('tour_details', $tour->id) }}"
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
                                                        <h5 class="text-sm font-bold text-[#1a1a1a] leading-tight">
                                                            {{ $tour->pickup_points->per_seat_fare_currency ?? 'PKR' }}
                                                            {{ $tour->pickup_points->per_seat_fare ?? '0.00' }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
            
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>


            <!-- Guest Reviews -->
            <div class=" mt-10 w-full  flex flex-col  gap-2" id="reviews">
                <h1 class="m-0 p-0 text-xl font-bold">Guest Reviews</h1>
                <div class="w-full  flex flex-col  gap-2">
                    <div class="w-full">
                        <ul class="w-full flex flex-col lg:flex-row p-0 m-0">
                            <li class=" flex flex-col p-2 w-full lg:w-1/3">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg p-0 m-0 flex gap-2 items-center"><span
                                            class="text-[#4d636e]">Reviews</span><span class="text-sm"><svg
                                                xmlns="http://www.w3.org/2000/svg" style="width:10px; fill:#008000;"
                                                viewBox="0 0 384 512">
                                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2 160 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-306.7L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
                                            </svg></span></h2>
                                    <h2 class="p-0 m-0 text-sm text-green-700">{{$tour->rating}}</h2>
                                </div>
                                <span class="w-full h-[10px] rounded-l-2xl flex items-center bg-gray-300"><span
                                        class="h-[10px] w-4/5 rounded-l-2xl bg-[#008000] object-fit"></span></span>
                            </li>
                            <li class=" flex flex-col p-2 w-full lg:w-1/3">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg p-0 m-0 flex gap-2 items-center"><span
                                            class="text-[#4d636e]">Transports</span><span class="text-sm"><svg
                                                xmlns="http://www.w3.org/2000/svg" style="width:10px; fill:#008000;"
                                                viewBox="0 0 384 512">
                                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2 160 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-306.7L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
                                            </svg></span></h2>
                                    <h2 class="p-0 m-0 text-sm text-green-700">{{$tour->rating}}</h2>
                                </div>
                                <span class="w-full  h-[10px] rounded-l-2xl flex items-center bg-gray-300"><span
                                        class="h-[10px] w-4/5 rounded-l-2xl bg-[#008000] object-fit"></span></span>
                            </li>
                            <li class=" flex flex-col p-2 w-full lg:w-1/3">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg p-0 m-0 flex gap-2 items-center"><span
                                            class="text-[#4d636e]">Rooms</span><span class="text-sm"><svg
                                                xmlns="http://www.w3.org/2000/svg" style="width:10px; fill:#008000;"
                                                viewBox="0 0 384 512">
                                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2 160 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-306.7L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
                                            </svg></span></h2>
                                    <h2 class="p-0 m-0 text-sm text-green-700">{{$tour->rating}}</h2>
                                </div>
                                <span class="w-full h-[10px] rounded-l-2xl flex items-center bg-gray-300"><span
                                        class="h-[10px] w-4/5 rounded-l-2xl bg-[#008000] object-fit"></span></span>
                            </li>
                        </ul>
                    </div>
                    <div class="w-full">
                        <ul class="w-full flex flex-col lg:flex-row p-0">
                            <li class=" flex flex-col p-2 w-full lg:w-1/3">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg p-0 m-0 flex gap-2 items-center"><span
                                            class="text-[#4d636e]">SPA</span><span class="text-sm"><svg
                                                xmlns="http://www.w3.org/2000/svg" style="width:10px; fill:#008000;"
                                                viewBox="0 0 384 512">
                                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2 160 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-306.7L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
                                            </svg></span></h2>
                                    <h2 class="p-0 m-0 text-sm text-green-700">{{$tour->rating}}</h2>
                                </div>
                                <span class="w-full h-[10px] rounded-l-2xl flex items-center bg-gray-300"><span
                                        class="h-[10px] w-4/5 rounded-l-2xl bg-[#008000] object-fit"></span></span>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>


            <!-- Guest who Tour with us -->
            <div class="my-10 w-full flex flex-col gap-2 relative">
                <h1 class="m-0 p-0 text-xl font-bold">Guest who tour with us</h1>
                <div class="relative overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-in-out gap-2 " id="cards-slider">

                        @foreach($reviews as $review)
                        <div class="cards-item flex flex-col gap-4 p-4 border border-black rounded-lg ">
                            <div class="flex gap-2 items-center ">
                                <div class="rounded-full h-16 w-16 border-2  border-green-700">
                                    <img class="w-full h-full rounded-full" src="{{ asset($review->profile_image)}}"
                                        alt="">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h2 class="text-lg p-0 m-0">{{$review->user_name}}</h2>
                                    <h3 class="text-sm p-0 m-0 text-[#4d636e]">{{ $review->user_address ?? ''}}</h3>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="p-0 m-0 text-sm text-[#4d636e] text-justify">
                                    {{ \Illuminate\Support\Str::limit($review->review, 150, $end='...') }}
                                </p>
                                <a href="#"
                                    class="m-0 p-0 text-[#008000] font-bold hover:text-green-700 text-decoration-none">Read
                                    More</a>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <button id="prev"
                        class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white p-2 shadow-lg hover:bg-gray-200 focus:outline-none"
                        aria-label="Previous">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>

                    </button>
                    <button id="next"
                        class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white p-2 shadow-lg hover:bg-gray-200 focus:outline-none"
                        aria-label="Next">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

    </div>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endsection

    @section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCydhAGz2TMfCQef9UKTAgHe4hWfPUfjqE&callback=initMap"
        async defer></script>
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer></script>
    {{-- Font Awesome: use layout CDN, kit removed (403) --}}

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script>
    function openModal() {
        document.getElementById('photo-gallery-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('photo-gallery-modal').classList.add('hidden');
    }

    // Optional: Close modal when clicking outside of the modal content
    document.addEventListener('click', function(event) {
        if (event.target === document.getElementById('photo-gallery-modal')) {
            closeModal();
        }
    });


    function initMap(lat, lng) {
        var center = {
            lat: lat,
            lng: lng
        };

        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 8,
            center: center,
        });

        var marker = new google.maps.Marker({
            position: center,
            map: map,
        });

        map.addListener('click', function(e) {
            var latLng = e.latLng;
            lat = latLng.lat();
            lng = latLng.lng();
            // <!-- alert('Lat: ' + latLng.lat() + ', Lng: ' + latLng.lng()); // Display the coordinates
            // console.log('Lat: ' + latLng.lat() + ', Lng: ' + latLng.lng()); // Log the coordinates -->
        });

    }

    initMap(30.1864, 71.4886);


    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 32,
        loop: true,
        centeredSlides: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,

        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 32,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 32,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 32,
            },
        },
    });



    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#datepicker-range-start", {
            mode: "range",
            dateFormat: "Y-m-d",
            defaultDate: [new Date()],
            onChange: function(selectedDates, dateStr, instance) {
                document.getElementById('datepicker-range-end').value = dateStr.split(' to ')[1] ||
                    '';
            }
        });

        flatpickr("#datepicker-range-end", {
            mode: "range",
            dateFormat: "Y-m-d",
            defaultDate: [new Date()],
            onChange: function(selectedDates, dateStr, instance) {
                document.getElementById('datepicker-range-start').value = dateStr.split(' to ')[
                    0] || '';
            }
        });
    });



    document.getElementById('menu-btn').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });



    var BaseURL = "<?= url('') ?>";
    var csrf_token = '{{ csrf_token() }}';



    $('#package_type').on('change', function() {
        $("#person_details").css('display', (this.value == 'single') ? 'block' : 'none');
    });


    function cash_on_pickup() {
        document.getElementById('bank_details').style.display = 'none';
    }

    function bank_transfer() {
        document.getElementById('bank_details').style.display = 'block';
    }



    function getCalculation() {

        var formData = new FormData($(this).closest('form')[0]);
        formData.append('_token', csrf_token);
        formData.append('package_type', $('#package_type').val());
        formData.append('adults_in_number', $('#adults_in_number').val());
        formData.append('kids_between_3_to_8', $('#kids_between_3_to_8').val());
        formData.append('kids_under_3_years', $('#kids_under_3_years').val());
        formData.append('pickup_point_id', $('#pickup_point_id').val());

        $.ajax({
            url: BaseURL + '/getCalculation',
            data: formData,
            type: 'POST',
            dataType: "json",
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            success: function(response) {
                // console.log(response.total_price);
                $('#total_amount').text(response.total_price);
                $('#currency').text(response.currency);
                $('#payment_amount').val(response.total_price);
            },
            error: function(data) {
                // console.log(data);
            }
        });
    }


    function initMap() {
        var mapOptions = {
            center: new google.maps.LatLng(31.5204, 74.3587), // Default to San Francisco
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    }



    $(document).ready(function() {
        adjustTabNav();

        // Adjust tab nav position on window resize
        $(window).on('resize', function() {
            adjustTabNav();
        });

        function adjustTabNav() {
            var tabs = $('.nav-tabs');
            if (tabs.length > 0) {
                var tabsWidth = tabs.width();
                var navItems = tabs.find('.nav-item');
                var totalWidth = 0;

                navItems.each(function() {
                    totalWidth += $(this).outerWidth(true);
                });

                if (totalWidth > tabsWidth) {
                    tabs.addClass('overflow-tabs');
                } else {
                    tabs.removeClass('overflow-tabs');
                }
            }
        }
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const cityDropdown = document.getElementById('city-dropdown');
        const loader = document.getElementById('loader');
        const perSeatFare = document.getElementById('per-seat-fare').querySelector('p:last-child');
        const couplePackageFare = document.getElementById('couple-package-fare').querySelector('p:last-child');
        const familyPackageFare = document.getElementById('family-package-fare').querySelector('p:last-child');
        const honeymoonPackageFare = document.getElementById('honeymoon-package-fare').querySelector(
            'p:last-child');
        const pickupDate = document.getElementById('pickup-date').querySelector('p:last-child');
        const pickupTime = document.getElementById('pickup-time').querySelector('p:last-child');
        const pickupPoint = document.getElementById('pickup-point').querySelector('p:last-child');

        const pickupPoints = @json($pickup_points);

        cityDropdown.addEventListener('change', function() {
            const selectedCity = cityDropdown.value;

            // Show loader
            loader.style.display = 'block';

            // Simulate a delay to show the loader (for demo purposes)
            setTimeout(function() {
                const point = pickupPoints.find(p => p.pickup_city === selectedCity);

                if (point) {
                    perSeatFare.textContent = point.per_seat_fare + ' PKR';
                    couplePackageFare.textContent = point.couple_package_fare + ' PKR';
                    familyPackageFare.textContent = point.family_package_fare + ' PKR';
                    honeymoonPackageFare.textContent = point.honeymoon_package_fare + ' PKR';
                    pickupDate.textContent = point.pickup_date;
                    pickupTime.textContent = point.pickup_time;
                    pickupPoint.textContent = point.pickup_point;
                } else {
                    perSeatFare.textContent = '';
                    couplePackageFare.textContent = '';
                    familyPackageFare.textContent = '';
                    honeymoonPackageFare.textContent = '';
                    pickupDate.textContent = '';
                    pickupTime.textContent = '';
                    pickupPoint.textContent = '';
                }

                // Hide loader
                loader.style.display = 'none';
            }, 500); // Adjust this time based on how long your actual data loading takes
        });
    });


    const testimonials = [{
            text: "The hotel has a great location, the Eastern gate of Taj Mahal, wonderful staff, engaging activities, and a good value for money.",
            image: "{{ asset('./details-page/images/person1.png') }}",
            name: "Ayesha",
            location: "From Pakistan"
        },
        {
            text: "A fantastic experience! The staff went above and beyond to ensure our stay was perfect.",
            image: "{{ asset('./details-page/images/person2.png') }}",
            name: "Mehwish",
            location: "From Narowal"
        },
    ];

    let currentIndex = 0;

    function nextSlide() {
        currentIndex = (currentIndex + 1) % testimonials.length;
        updateTestimonial();
    }

    function updateTestimonial() {
        const testimonial = testimonials[currentIndex];
        document.getElementById('testimonial-text').innerText = testimonial.text;
        document.getElementById('testimonial-image').src = testimonial.image;
        document.getElementById('testimonial-name').innerText = testimonial.name;
        document.getElementById('testimonial-location').innerText = testimonial.location;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const imgContainer = document.getElementById('imgContainer');
        const imgs = imgContainer.children;
        const totalImgs = imgs.length;
        let imgCurrentIndex = 0;

        function updateImages() {
            const visibleImages = getVisibleImagesCount();
            const offset = -imgCurrentIndex * (105 / visibleImages);
            imgContainer.style.transform = `translateX(${offset}%)`;

            document.getElementById('prevBtn').style.display = imgCurrentIndex === 0 ? 'none' : 'block';
            document.getElementById('nextBtn').style.display = imgCurrentIndex >= totalImgs - visibleImages ?
                'none' : 'block';
        }

        function getVisibleImagesCount() {
            if (window.innerWidth <= 768) {
                return 1;
            } else if (window.innerWidth <= 1024) {
                return 2;
            } else {
                return 4;
            }
        }

        document.getElementById('nextBtn').addEventListener('click', () => {
            const visibleImages = getVisibleImagesCount();
            if (imgCurrentIndex < totalImgs - visibleImages) {
                imgCurrentIndex++;
                updateImages();
            }
        });

        document.getElementById('prevBtn').addEventListener('click', () => {
            if (imgCurrentIndex > 0) {
                imgCurrentIndex--;
                updateImages();
            }
        });

        window.addEventListener('resize', updateImages);
        updateImages();
    });


    // cards slider
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('cards-slider');
        const images = document.querySelectorAll('.cards-item');
        const totalImages = images.length;
        let cardWidth = images[0].offsetWidth;
        let currentIndex = 0;
        let itemsToShow = getItemsToShow();

        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');

        prevButton.style.display = 'none';

        function updateSlider() {
            const offset = currentIndex * cardWidth;
            slider.style.transform = `translateX(-${offset}px)`;


            prevButton.style.display = currentIndex === 0 ? 'none' : 'block';
            nextButton.style.display = currentIndex >= totalImages - itemsToShow ? 'none' : 'block';
        }

        function getItemsToShow() {
            if (window.innerWidth < 768) {
                return 1;
            } else if (window.innerWidth < 1024) {
                return 2;
            } else {
                return 3;
            }
        }


        window.addEventListener('resize', () => {
            itemsToShow = getItemsToShow();
            cardWidth = slider.offsetWidth / itemsToShow;
            updateSlider();
        });


        nextButton.addEventListener('click', () => {
            if (currentIndex < totalImages - itemsToShow) {
                currentIndex += 1;
                updateSlider();
            }
        });


        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex -= 1;
                updateSlider();
            }
        });

        cardWidth = slider.offsetWidth / itemsToShow;
        updateSlider();
    });
    
          new Swiper(".mostPopularSwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
            1280: { slidesPerView: 4 },
        },
    });
    </script>
    @endsection