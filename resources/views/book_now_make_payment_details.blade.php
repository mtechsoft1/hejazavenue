@extends('layouts.app')
@section('title')
Booking Details
@endsection

<style>
    /* Ensure the map container has a height */
    #map {
        height: 500px;
        /* Adjust height as needed */
        width: 100%;
        /* Full width */
    }

    .img-container {
        display: flex;
        transition: transform 0.3s ease-in-out;
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
</style>

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>

<div class="container hidden mx-auto p-4 bg-black text-red-300 rounded-lg mt-2">
    <p>Message: <span id="user_message">N/A</span></p>
    <p>Payment Method: <span id="payment_method">N/A</span></p>
    <p>deposit_receipt: <span id="deposit_receipt">N/A</span></p>
    <p>package_type: <span id="package_type">N/A</span></p>
    <p>Payment Type: <span id="payment_type">N/A</span></p>
    <p>pickup_point_id: <span id="pickup_point_id">N/A</span></p>
    <p>Tour ID: <span id="tour_id">N/A</span></p>
    <p>User Id: <span id="user_id">N/A</span></p>
    <p>Name: <span id="name">N/A</span></p>
    <p>Email: <span id="email">N/A</span></p>
    <p>Phone: <span id="phone">N/A</span></p>
    <!-- <p>Under 3 Years: <span id="under3YearsCount">0</span></p>
                                                    <p>Between 3-8 Years: <span id="between3To8YearsCount">0</span></p>
                                                    <p>Above 8 Years: <span id="above8YearsCount">0</span></p> -->
    <p>Is Paid: <span id="is_paid">N/A</span></p>
    <p>status: <span id="status">N/A</span></p>
    <p>created_at: <span id="created_at">N/A</span></p>
    <p>updated_at: <span id="updated_at">N/A</span></p>
    <p>Current User:
        <code class="bg-black font-normal text-red-600 text-md hidden">{{ $user }}</code>
    </p>
</div>

<div class=" w-full">
    <div class="w-full m-0 flex flex-col lg:flex-row gap-4 justify-center">
        <div class="lg:max-w-[1110px] w-[90vw] mx-auto  my-10 flex flex-col gap-4">
            <p class="text-md mt-3 p-0 text-slate-800">
                <a href="{{ route('home') }}"
                    class="text-[#008000] text-decoration-none hover:text-green-700 m-0 p-0">Home</a>
                >
                <a href="{{ route('tour_details', $id) }}"
                    class="text-[#008000] text-decoration-none hover:text-green-700 m-0 p-0">Tour Details</a> >
                Booking Details
            </p>
            <!-- Payment Section -->

            <div class="w-full flex flex-col items-center justify-center gap-2 sm:gap-6 md:gap-8 lg:gap-4">
                <!-- Payment Amount Section -->
                <div class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2  flex justify-center p-2">
                    <h2 class="text-lg font-bold text-center flex flex-col gap-2">
                        <span>Payment:</span>
                        <span id="payment-amount"
                            data-payment-amount="0.00">0.00 
                            PKR
                        </span>
                    </h2>
                </div>

                <!-- Package Details Section -->
                <div class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 border-b border-gray-400 flex justify-center">
                    <div class="w-full p-3 rounded-lg flex flex-col gap-2">
                        <!-- Package Name -->
                        <div class="w-full flex justify-between items-center">
                            <p class="text-base sm:text-lg md:text-xl font-bold text-gray-800">Package:</p>
                            <p class="text-base sm:text-lg md:text-xl text-gray-500">Family</p>
                        </div>

                        <!-- Under 3 Years -->
                        <div class="w-full flex justify-between items-center">
                            <p class="text-base sm:text-lg md:text-xl font-normal text-gray-800">Under 3 Years:</p>
                            <p class="text-base sm:text-lg md:text-xl text-gray-500" id="under3YearsCount">0</p>
                        </div>

                        <!-- Between 3-8 Years -->
                        <div class="w-full flex justify-between items-center">
                            <p class="text-base sm:text-lg md:text-xl font-normal text-gray-800">Between 3-8 Years:</p>
                            <p class="text-base sm:text-lg md:text-xl text-gray-500" id="between3To8YearsCount">0</p>
                        </div>

                        <!-- Above 8 Years -->
                        <div class="w-full flex justify-between items-center">
                            <p class="text-base sm:text-lg md:text-xl font-normal text-gray-800">Above 8 Years:</p>
                            <p class="text-base sm:text-lg md:text-xl text-gray-500" id="above8YearsCount">0</p>
                        </div>
                    </div>
                </div>

                <div class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 border-b border-gray-400 flex justify-center p-1">
                    <div class="w-full rounded-lg flex flex-col gap-2 justify-center">
                        <div class="flex items-center">
                            <input id="default-radio-1" type="radio" value="" name="payment-type"
                                class="w-4 h-4 text-green-700 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                            <label for="default-radio-1"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pay 20% for confirm
                                booking</label>
                        </div>
                        <div class="flex items-center">
                            <input checked id="default-radio-2" type="radio" value="" name="payment-type"
                                class="w-4 h-4 text-green-700 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                            <label for="default-radio-2"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Make Full
                                Payment</label>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Paymnet Method -->
            <div class="w-full flex flex-col gap-2">
                <div>
                    <h1 class="p-0 m-0 text-xl font-bold">Payment Method</h1>
                </div>
                <div class="w-full flex flex-col items-center">
                    <div class="w-1/2 flex flex-wrap justify-center gap-2">
                        <div class="w-[48%] rounded-xl h-[45%]  border border-black">
                            <img src="https://digitalpakistan.pk/wp-content/uploads/2021/09/JazzCash-1.jpg"
                                class="w-full h-full rounded-xl" alt="">
                        </div>
                        <div class="w-[48%] h-[45%]  border-border-black rounded-xl">
                            <img src="https://www.completesports.com/wp-content/uploads/2024/03/easypaisa.jpg"
                                class="w-full h-full rounded-xl" alt="">
                        </div>
                        <div class="w-[48%] h-[45%]  border border-black rounded-xl">
                            <img src="https://t4.ftcdn.net/jpg/00/61/06/27/360_F_61062796_NF87GPnWV0fQ2LhoYNlyjev0PocRwZj9.jpg"
                                class="w-full h-full rounded-xl" alt="">
                        </div>
                    </div>
                    <div class="w-full flex justify-center">
                        <div class="w-full lg:w-1/2 flex justify-center">
                            <a href="{{ route('payment', $id) }}" class="w-full lg:w-1/2 text-decoration-none">
                                <div
                                    class="focus:outline-none text-center text-white bg-[#008000] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-full w-full text-base lg:text-xl px-4 lg:px-5 py-2 lg:py-2.5 my-3">
                                    Make Payment
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>


            <!-- Similar experience -->
            <div class="mt-10 w-full flex flex-col gap-2">
                <h1 class="m-0 p-0 text-xl font-bold">Similar Experience</h1>
                <div class="slider w-full flex flex-col gap-2 h-auto overflow-hidden relative">
                    <div class="img-container w-full flex gap-2 h-auto" id="imgContainer">
                        <div class="w-1/4 h-auto rounded-xl">
                            <img class="w-full h-full rounded-xl"
                                src="https://hunzaadventuretours.com/wp-content/uploads/2020/06/Autumn-Tours-in-Pakistan-1-1024x559.jpg"
                                alt="">
                        </div>
                        <div class="w-1/4 h-auto rounded-xl">
                            <img class="w-full h-full rounded-xl"
                                src="https://www.imusafir.pk/wp-content/uploads/2023/09/Hunza-Girl.jpg" alt="">
                        </div>
                        <div class="w-1/4 h-auto rounded-xl">
                            <img class="w-full h-full rounded-xl"
                                src="https://www.pakistantours.pk/wp-content/uploads/2022/10/Karakoram-Highway-tours.jpg"
                                alt="">
                        </div>
                        <div class="w-1/4 h-auto rounded-xl">
                            <img class="w-full h-full rounded-xl"
                                src="https://img.freepik.com/premium-photo/quotbus-travel-pakistan-concept-3d-renderingquot_1025557-1309.jpg"
                                alt="">
                        </div>
                        <div class="w-1/4 h-auto rounded-xl">
                            <img class="w-full h-full rounded-xl"
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_8NaS0MO5CNEpHm-CFDn3BH2oHHFCADJc8g&s"
                                alt="">
                        </div>
                        <div class="w-1/4 h-auto rounded-xl">
                            <img class="w-full h-full rounded-xl"
                                src="https://png.pngtree.com/background/20230217/original/pngtree-interior-of-bus-with-passengers-picture-image_2031558.jpg"
                                alt="">
                        </div>
                    </div>
                    <button id="prevBtn"
                        class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white p-2 shadow-lg hover:bg-gray-200 focus:outline-none z-10"
                        aria-label="Previous">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>

                    </button>
                    <button id="nextBtn"
                        class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white p-2 shadow-lg hover:bg-gray-200 focus:outline-none z-10"
                        aria-label="Next">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
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
                                                xmlns="http://www.w3.org/2000/svg" style="width:10px; fill:green;"
                                                viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2 160 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-306.7L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
                                            </svg></span></h2>
                                    <h2 class="p-0 m-0 text-sm text-[#008000]">9.8</h2>
                                </div>
                                <span class="w-full h-[10px] rounded-l-2xl flex items-center bg-gray-300"><span
                                        class="h-[10px] w-4/5 rounded-l-2xl bg-[#008000] object-fit"></span></span>
                            </li>
                            <li class=" flex flex-col p-2 w-full lg:w-1/3">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg p-0 m-0 flex gap-2 items-center"><span
                                            class="text-[#4d636e]">Transports</span><span class="text-sm"><svg
                                                xmlns="http://www.w3.org/2000/svg" style="width:10px; fill:green;"
                                                viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2 160 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-306.7L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
                                            </svg></span></h2>
                                    <h2 class="p-0 m-0 text-sm text-[#008000]">9.8</h2>
                                </div>
                                <span class="w-full  h-[10px] rounded-l-2xl flex items-center bg-gray-300"><span
                                        class="h-[10px] w-4/5 rounded-l-2xl bg-[#008000] object-fit"></span></span>
                            </li>
                            <li class=" flex flex-col p-2 w-full lg:w-1/3">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg p-0 m-0 flex gap-2 items-center"><span
                                            class="text-[#4d636e]">Rooms</span><span class="text-sm"><svg
                                                xmlns="http://www.w3.org/2000/svg" style="width:10px; fill:green;"
                                                viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2 160 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-306.7L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
                                            </svg></span></h2>
                                    <h2 class="p-0 m-0 text-sm text-[#008000]">9.8</h2>
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
                                                xmlns="http://www.w3.org/2000/svg" style="width:10px; fill:green;"
                                                viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2 160 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-306.7L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
                                            </svg></span></h2>
                                    <h2 class="p-0 m-0 text-sm text-[#008000]">9.8</h2>
                                </div>
                                <span class="w-full h-[10px] rounded-l-2xl flex items-center bg-gray-300"><span
                                        class="h-[10px] w-4/5 rounded-l-2xl bg-[#008000] object-fit"></span></span>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>


            <!-- Guest who Tour with us -->
            <div class="mt-10 w-full flex flex-col gap-2 relative mb-3">
                <h1 class="m-0 p-0 text-xl font-bold">Guest who tour with us</h1>
                <div class="relative overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-in-out gap-2 " id="cards-slider">
                        <div class="cards-item flex flex-col gap-4 p-4 border border-black rounded-lg ">
                            <div class="flex gap-2 items-center ">
                                <div class="rounded-full h-16 w-16 border-2  border-green-700">
                                    <img class="w-full h-full" src="{{ asset('./details-page/images/person1.png') }}"
                                        alt="">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h2 class="text-lg p-0 m-0">Ayesha</h2>
                                    <h3 class="text-sm p-0 m-0 text-[#4d636e]">Pakistan</h3>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="p-0 m-0 text-sm text-[#4d636e] text-justify">
                                    A fantastic experience from start to finish. I highly recommend this
                                    place!
                                </p>
                                <a href="#"
                                    class="m-0 p-0 text-[#008000] font-bold hover:text-green-700 text-decoration-none">Read
                                    More</a>
                            </div>
                        </div>
                        <div class="cards-item flex flex-col gap-4 p-4 border border-black rounded-lg">
                            <div class="flex gap-2 items-center">
                                <div class="rounded-full h-16 w-16 border-2 border-green-700">
                                    <img class="w-full h-full" src="{{ asset('./details-page/images/person1.png') }}"
                                        alt="">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h2 class="text-lg p-0 m-0">Mehwish</h2>
                                    <h3 class="text-sm p-0 m-0 text-[#4d636e]">Pakistan</h3>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="p-0 m-0 text-sm text-[#4d636e] text-justify"">
                                A fantastic experience from start to finish. I highly recommend this
                                place!
                            </p>
                            <a href=" #"
                                    class=" m-0 p-0 text-[#008000] font-bold hover:text-green-700 text-decoration-none">
                                    Read
                                    More</a>
                            </div>
                        </div>
                        <div class="cards-item flex flex-col gap-4 p-4 border border-black rounded-lg">
                            <div class="flex gap-2 items-center">
                                <div class="rounded-full h-16 w-16 border-2 border-green-700">
                                    <img class="w-full h-full" src="{{ asset('./details-page/images/person1.png') }}"
                                        alt="">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h2 class="text-lg p-0 m-0">Aqib</h2>
                                    <h3 class="text-sm p-0 m-0 text-[#4d636e]">Pakistan</h3>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="p-0 m-0 text-sm text-[#4d636e] text-justify"">
                                A fantastic experience from start to finish. I highly recommend this
                                place!
                            </p>
                            <a href=" #"
                                    class=" m-0 p-0 text-[#008000] font-bold hover:text-green-700 text-decoration-none">
                                    Read
                                    More</a>
                            </div>
                        </div>
                        <div class="cards-item flex flex-col gap-4 p-4 border border-black rounded-lg">
                            <div class="flex gap-2 items-center">
                                <div class="rounded-full h-16 w-16 border-2 border-green-700">
                                    <img class="w-full h-full" src="{{ asset('./details-page/images/person1.png') }}"
                                        alt="">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h2 class="text-lg p-0 m-0">Hasnain</h2>
                                    <h3 class="text-sm p-0 m-0 text-[#4d636e]">Pakistan</h3>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="p-0 m-0 text-sm text-[#4d636e] text-justify"">
                                A fantastic experience from start to finish. I highly recommend this
                                place!
                            </p>
                            <a href=" #"
                                    class=" m-0 p-0 text-[#008000] font-bold hover:text-green-700 text-decoration-none">
                                    Read
                                    More</a>
                            </div>
                        </div>
                        <div class="cards-item flex flex-col gap-4 p-4 border border-black rounded-lg">
                            <div class="flex gap-2 items-center">
                                <div class="rounded-full h-16 w-16 border-2 border-green-700">
                                    <img class="w-full h-full" src="{{ asset('./details-page/images/person1.png') }}"
                                        alt="">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h2 class="text-lg p-0 m-0">Nasir</h2>
                                    <h3 class="text-sm p-0 m-0 text-[#4d636e]">Pakistan</h3>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="p-0 m-0 text-sm text-[#4d636e] text-justify"">
                                A fantastic experience from start to finish. I highly recommend this
                                place!
                            </p>
                            <a href=" #"
                                    class=" m-0 p-0 text-[#008000] font-bold hover:text-green-700 text-decoration-none">
                                    Read
                                    More</a>
                            </div>
                        </div>
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
</div>
@endsection

@section('script')
<!-- Google Maps script with error handling -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCydhAGz2TMfCQef9UKTAgHe4hWfPUfjqE&callback=initMap" async
    defer></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imgContainer = document.getElementById('imgContainer');
        const imgs = imgContainer.children;
        const totalImgs = imgs.length;
        let imgCurrentIndex = 0;

        function updateImages() {
            const visibleImages = getVisibleImagesCount();
            const offset = -imgCurrentIndex * (105 / visibleImages);
            imgContainer.style.transform = `translateX(${offset}%)`;

            document.getElementById('prevBtn').style.display = imgCurrentIndex === 0 ? 'none' : 'block';
            document.getElementById('nextBtn').style.display = imgCurrentIndex >= totalImgs - visibleImages ? 'none' : 'block';
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
    document.addEventListener('DOMContentLoaded', function () {
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
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const bookingData = JSON.parse(localStorage.getItem('bookingData'));

        if (bookingData) {
            document.getElementById('under3YearsCount').textContent = bookingData.kids_under_3_years;
            document.getElementById('between3To8YearsCount').textContent = bookingData.kids_between_3_to_8;
            document.getElementById('above8YearsCount').textContent = bookingData.adults_in_number;

            // Format the payment amount
            const paymentAmount = parseFloat(bookingData.payment_amount.replace(/[^0-9.]/g, ''));
            const formattedAmount = paymentAmount.toLocaleString('en-US');
            document.getElementById('payment_amount').textContent = formattedAmount;

            document.getElementById('payment_type').textContent = bookingData.payment_type;
            document.getElementById('is_paid').textContent = bookingData.is_paid;
            document.getElementById('status').textContent = bookingData.status;
            document.getElementById('created_at').textContent = bookingData.created_at;
            document.getElementById('updated_at').textContent = bookingData.updated_at;
            document.getElementById('tour_id').textContent = bookingData.tour_id;
            document.getElementById('user_id').textContent = bookingData.user_id;
            document.getElementById('name').textContent = bookingData.name;
            document.getElementById('email').textContent = bookingData.email;
            document.getElementById('phone').textContent = bookingData.phone;
            document.getElementById('payment_method').textContent = bookingData.payment_method || 'N/A';
            document.getElementById('pickup_point_id').textContent = bookingData.pickup_point_id || 'N/A';
            document.getElementById('package_type').textContent = bookingData.package_type || 'N/A';
        }

        // Add event listener to update local storage with the selected payment method
        document.querySelectorAll('input[name="payment-method"]').forEach(input => {
            input.addEventListener('change', function () {
                const bookingData = JSON.parse(localStorage.getItem('bookingData'));

                if (bookingData) {
                    // Get the selected payment method label
                    const selectedPaymentMethod = document.querySelector(
                        'input[name="payment-method"]:checked');
                    const paymentMethodText = selectedPaymentMethod ?
                        document.querySelector(`label[for="${selectedPaymentMethod.id}"]`)
                            .textContent : 'unknown';

                    const selectedPaymentType = document.querySelector(
                        'input[name="payment-type"]:checked');
                    const paymentTypeText = selectedPaymentType ?
                        document.querySelector(`label[for="${selectedPaymentType.id}"]`)
                            .textContent : 'unknown';

                    bookingData.payment_method = paymentMethodText;
                    bookingData.payment_type = paymentTypeText;
                    localStorage.setItem('bookingData', JSON.stringify(bookingData));
                }
            });
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabButtons = document.querySelectorAll('#default-tab button');
        const tabContents = document.querySelectorAll('#default-tab-content > div');

        function handleTabClick(event) {
            // Remove border and text color from all buttons
            tabButtons.forEach(button => {
                button.classList.remove('border-b-2', 'border-gray-300', 'text-gray-800');
                button.classList.add('text-gray-500');
                button.setAttribute('aria-selected', 'false');
            });

            // Hide all tab contents
            tabContents.forEach(content => {
                content.classList.add('hidden');
                content.setAttribute('aria-hidden', 'true');
            });

            // Add active state to the clicked button
            const targetId = event.target.getAttribute('data-tabs-target');
            event.target.classList.remove('text-gray-500');
            event.target.classList.add('border-b-2', 'border-gray-300', 'text-gray-800');
            event.target.setAttribute('aria-selected', 'true');

            // Show the target tab content
            document.querySelector(targetId).classList.remove('hidden');
            document.querySelector(targetId).setAttribute('aria-hidden', 'false');
        }

        // Set the first tab as active by default
        const firstButton = tabButtons[0];
        firstButton.classList.add('border-b-2', 'border-gray-300', 'text-gray-800');
        firstButton.setAttribute('aria-selected', 'true');
        document.querySelector(firstButton.getAttribute('data-tabs-target')).classList.remove('hidden');
        document.querySelector(firstButton.getAttribute('data-tabs-target')).setAttribute('aria-hidden',
            'false');

        tabButtons.forEach(button => {
            button.addEventListener('click', handleTabClick);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to handle increment and decrement
        function updateCount(button, operation) {
            const countElement = button.parentElement.querySelector('.count');
            let count = parseInt(countElement.textContent);
            if (operation === 'increment') {
                count += 1;
            } else if (operation === 'decrement' && count > 0) {
                count -= 1;
            }
            countElement.textContent = count;
        }

        // Attach event listeners to buttons
        document.querySelectorAll('.increment').forEach(button => {
            button.addEventListener('click', function () {
                updateCount(button, 'increment');
            });
        });

        document.querySelectorAll('.decrement').forEach(button => {
            button.addEventListener('click', function () {
                updateCount(button, 'decrement');
            });
        });
    });
</script>

<script>
    function updatePaymentAmount() {
        const counts = document.querySelectorAll('.count');
        let total = 0;

        counts.forEach(count => {
            const value = parseInt(count.textContent, 10);
            total += value * 1000; // Assuming each person costs 1000 PKR
        });

        document.getElementById('payment-amount').textContent = `${total.toLocaleString()} PKR`;
    }

    document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', () => {
            const countElement = button.parentElement.querySelector('.count');
            countElement.textContent = parseInt(countElement.textContent, 10) + 1;
            updatePaymentAmount();
        });
    });

    document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', () => {
            const countElement = button.parentElement.querySelector('.count');
            const newValue = Math.max(parseInt(countElement.textContent, 10) - 1, 0);
            countElement.textContent = newValue;
            updatePaymentAmount();
        });
    });
</script>


<script>
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

        map.addListener('click', function (e) {
            var latLng = e.latLng;
            lat = latLng.lat();
            lng = latLng.lng();
            alert('Lat: ' + latLng.lat() + ', Lng: ' + latLng.lng()); // Display the coordinates
            // console.log('Lat: ' + latLng.lat() + ', Lng: ' + latLng.lng()); // Log the coordinates
        });

    }

    initMap(30.1864, 71.4886);



</script>
@endsection