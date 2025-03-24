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

    .tooltip {
        visibility: hidden;
        width: 120px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        /* Position the tooltip above the button */
        left: 50%;
        margin-left: -60px;
        /* Center the tooltip */
        opacity: 1;
        transition: opacity 0.3s;
    }

    .copy-btn.show-tooltip .tooltip {
        visibility: visible;
        opacity: 1;
    }

    .copy-btn {
        cursor: pointer;
        position: relative;
        /* For positioning the tooltip */
    }

    /* Additional styles for the loader */
    .loader {
        border: 4px solid rgba(0, 0, 0, 0.1);
        border-radius: 50%;
        border-top: 4px solid #4A90E2;
        width: 40px;
        height: 40px;
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
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">


<!-- Show error messages -->
@if ($errors->any())
    <div class="container md:w-1/3 mt-4 p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="font-medium">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Show success messages -->
@if (session()->has('success'))
    <div class="container md:w-1/3 mt-4 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
        <span class="font-medium">Success alert!</span> {{ session()->get('success') }}
    </div>
@endif


<div class="w-full flex flex-col items-center justify-center">
    <!-- Loader Modal -->
    <div id="loaderModal" class="fixed z-10 inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center hidden">
        <div class="bg-white p-5 rounded-lg shadow-lg flex items-center justify-center flex-col">
            <p class="text-lg text-gray-700">Receipt uploaded successfully</p>
            <hr class="grid grid-cols-1 divide-y divide-gray-300 divide-solid mt-3 mb-1 hover:divide-y-8">
            <div class="loader mb-4"></div>
        </div>
    </div>

    <!-- Rating and Reviews Modal -->
    <div id="reviewsModal" class="fixed z-10 inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center hidden">

        <div class="bg-white px-5 py-2 rounded-lg shadow-lg md:w-1/3 overflow-auto"
            style="max-height: 90vh; -ms-overflow-style: none; scrollbar-width: none; ">
            <h2 class="text-xl font-bold mb-4 text-center">Reviews & Rating</h2>
            <hr class="grid grid-cols-1 divide-y divide-gray-300 divide-solid my-3 hover:divide-y-8">

            <div class="flex flex-col items-center justify-center gap-3">
                <div class="flex items-center justify-center h-20 w-20 rounded-full">
                    <img class="w-full h-full rounded-full"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSrWl3NFJnWwwjlBSSbNxJcQ2EpYbFhtX4M0Q&s"
                        alt="User Profile" class="w-[100px] h-[100px] rounded-full mb-1">
                </div>

                <div class="flex flex-col gap-2">
                    <h2 class="text-xl font-bold m-0 p-0">{{ $user->name }}</h2>
                    <h2 class="text-xl font-normal m-0 p-0">Rate the Service Provider</h2>
                </div>

                <!-- Rating Stars -->
                <div class="flex items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#cce900" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#cce900" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="#cce900" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#cce900" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="#cce900" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#cce900" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="#cce900" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#cce900" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="#cce900" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#cce900" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>

                </div>

            </div>

            <form action="{{ route('payment', $tour->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="container hidden mx-auto p-4 bg-black text-red-300 rounded-lg my-3 space-y-4">
                    <div class="flex items-center">
                        <label for="user_message" class="w-1/3">Message:</label>
                        <input id="user_message" name="user_message" type="text"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>

                    <div class="flex items-center">
                        <label for="payment_method" class="w-1/3">Payment Method:</label>
                        <input id="payment_method" type="text" name="payment_method"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>

                    <div class="flex items-center">
                        <label for="deposit_receipt" class="w-1/3">Deposit Receipt:</label>
                        <input id="deposit_receipt" type="text" name="deposit_receipt_value"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>

                    <div class="flex items-center">
                        <label for="package_type" class="w-1/3">Package Type:</label>
                        <input id="package_type" type="text" name="package_type"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>

                    <div class="flex items-center">
                        <label for="payment_type" class="w-1/3">Payment Type:</label>
                        <input id="payment_type" type="text" name="payment_type"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>

                    <div class="flex items-center">
                        <label for="pickup_point_id" class="w-1/3">Pickup Point ID:</label>
                        <input id="pickup_point_id" type="text" name="pickup_point_id"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>

                    <div class="flex items-center">
                        <label for="tour_id" class="w-1/3">Tour ID:</label>
                        <input id="tour_id" type="text" name="tour_id"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>

                    <div class="flex items-center">
                        <label for="user_id" class="w-1/3">User ID:</label>
                        <input id="user_id" type="text" name="user_id"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>

                    <div class="flex items-center">
                        <label for="name" class="w-1/3">Name:</label>
                        <input id="name" type="text" name="name"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>

                    <div class="flex items-center">
                        <label for="email" class="w-1/3">Email:</label>
                        <input id="email" type="text" name="email"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>

                    <div class="flex items-center">
                        <label for="phone" class="w-1/3">Phone:</label>
                        <input id="phone" type="text" name="phone"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>

                    <div class="flex items-center">
                        <label for="under3YearsCount" class="w-1/3">Under 3 Years:</label>
                        <input id="under3YearsCount" type="text" name="kids_under_3_years"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly value="0">
                    </div>

                    <div class="flex items-center">
                        <label for="between3To8YearsCount" class="w-1/3">Between 3-8 Years:</label>
                        <input id="between3To8YearsCount" type="text" name="kids_between_3_to_8"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly value="0">
                    </div>

                    <div class="flex items-center">
                        <label for="above8YearsCount" class="w-1/3">Above 8 Years:</label>
                        <input id="above8YearsCount" type="text" name="adults_in_number"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly value="0">
                    </div>

                    <div class="flex items-center">
                        <label for="is_paid" class="w-1/3">Is Paid:</label>
                        <input id="is_paid" type="text" name="is_paid"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="false">
                    </div>

                    <div class="flex items-center">
                        <label for="status" class="w-1/3">Status:</label>
                        <input id="status" type="text" name="status"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>

                    <div class="flex items-center">
                        <label for="created_at" class="w-1/3">Created At:</label>
                        <input id="created_at" type="text" name="created_at"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>

                    <div class="flex items-center">
                        <label for="updated_at" class="w-1/3">Updated At:</label>
                        <input id="updated_at" type="text" name="updated_at"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>

                    <div class="flex items-center">
                        <label for="updated_at" class="w-1/3">Payment Amount</label>
                        <input id="payment_amount" type="text" name="payment_amount"
                            class="bg-transparent border-none text-red-300 focus:outline-none w-2/3" readonly
                            value="N/A">
                    </div>
                </div>

                <div class="mb-2">
                    <textarea id="message" rows="4" name="user_message" value=""
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Additional Comments..."></textarea>
                </div>

                <!-- File Upload -->
                <!-- <div class="flex items-center justify-center w-full my-3 rounded-lg">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                    to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" name="deposit_receipt" />
                    </label>
                </div> -->
                <!-- File Upload -->

                <div class="mb-4 flex items-center justify-between gap-3">
                    <a href="#!" class="text-decoration-none" onclick="closeReviewModal()">
                        <div
                            class="focus:outline-none  text-center text-[#008000] border-2 border-green-700 rounded-3xl bg-white hover:bg-slate-300 focus:ring-4 focus:ring-green-300 font-medium rounded-full w-[130px] text-sm px-3 py-2.5 my-3">
                            Not Now
                        </div>
                    </a>

                    <button type="submit"
                        class="focus:outline-none text-center text-white bg-[#008000] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-full w-[130px] text-sm px-3 py-2.5 my-3">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="lg:max-w-[1110px] w-[90vw] mx-auto mt-10">
        <p class="text-md mt-3 p-0 text-slate-800">
            <a href="{{ route('home') }}"
                class="text-[#008000] text-decoration-none hover:text-[#008000] m-0 p-0">Home</a>
            >
            <a href="{{ route('tour_details', $id) }}"
                class="text-[#008000] text-decoration-none hover:text-[#008000] m-0 p-0">Tour Details</a> >
            <a href="{{ route('booking_details', $id) }}"
                class="text-[#008000] text-decoration-none hover:text-[#008000] m-0 p-0">Booking Details</a> >
            <a href="{{ route('make-payment', $id) }}"
                class="text-[#008000] text-decoration-none hover:text-[#008000] m-0 p-0">Make Payment</a> >
            Payment
        </p>

    </div>
    <!-- Payment Amount Section -->
    <div class="lg:max-w-[1110px] w-[90vw] mx-auto mt-3 flex flex-col items-center gap-4">
        <div class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2  flex flex-col items-center justify-center gap-2 p-2">
            <h1 class="text-xl text-gray-800 font-bold p-0 m-0">Pay the Seller</h1>
            <h1 class="text-sm p-0 m-0 text-gray-800 font-normal">Time Remaining: <span id="time-remaining"
                    class="text-red-500"></span></h1>
            </h1>
            <h2 class="text-5xl text-gray-800 font-normal flex justify-center items-center gap-3 p-0 m-0">
                <span class="text-xl text-gray-800 font-normal" id="payment_amount_value"></span>
                <span class="text-xl text-gray-800 font-normal">{{ $tourPickupPoint->per_seat_fare_currency }}</span>
            </h2>
        </div>

        <div class="w-full flex flex-col  justify-center items-center  space-y-4 lg:space-y-0 lg:space-x-4 gap-4">
            <div class="w-full lg:w-1/2 flex justify-center">
                <button
                    class="chat-button bg-[#008000]  text-white text-lg p-2 rounded-3xl w-full lg:w-1/2 flex items-center justify-center gap-1">
                    <span class="chat-button-icon"><img src="{{ asset('./details-page/icons/chat.png') }}"
                            alt=""></span>
                    <span>Chat With Admin</span>
                </button>
            </div>

            <div class="w-full lg:w-1/2 p-4 bg-[#f4f5f7] rounded-xl">
                <div class="w-full flex justify-between items-center py-1">
                    <p class="text-xl lg:text-2xl text-gray-800 font-bold">Bank Transfer</p>
                </div>

                <div class="w-full flex justify-between items-center py-1">
                    <p class="text-lg lg:text-xl text-gray-800 font-normal">Account Title: </p>
                    <p class="text-lg lg:text-xl text-gray-500 font-normal">
                        <span id="accountTitle"
                            class="mr-2">{{ $user->name == null || $user->name == '' ? 'N/A' : $user->name }}</span>
                        <button type="button"
                            class="copy-btn text-slate-700 border border-slate-700 hover:bg-slate-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 inline-flex items-center me-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500"
                            onclick="copyToClipboard('accountTitle', this)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                            <span class="tooltip">Copied!</span>
                        </button>
                    </p>
                </div>

                <div class="w-full flex justify-between items-center py-1">
                    <p class="text-lg lg:text-xl text-gray-800 font-normal">Account Number: </p>
                    <p class="text-lg lg:text-xl text-gray-500 font-normal">
                        <span id="accountNumber"
                            class="mr-2">{{ $user->account_number == null || $user->account_number == '' ? 'N/A' : $user->account_number }}</span>
                        <button type="button"
                            class="copy-btn text-slate-700 border border-slate-700 hover:bg-slate-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 inline-flex items-center me-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500"
                            onclick="copyToClipboard('accountNumber', this)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                            <span class="tooltip">Copied!</span>
                        </button>
                    </p>
                </div>

                <div class="w-full flex justify-between items-center py-1">
                    <p class="text-lg lg:text-xl text-gray-800 font-normal">Bank Name: </p>
                    <p class="text-lg lg:text-xl text-gray-500 font-normal">
                        <span id="bankName"
                            class="mr-2">{{ $user->bank_name == null || $user->bank_name == '' ? 'N/A' : $user->bank_name }}</span>
                        <button type="button"
                            class="copy-btn text-slate-700 border border-slate-700 hover:bg-slate-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 inline-flex items-center me-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500"
                            onclick="copyToClipboard('bankName', this)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                            <span class="tooltip">Copied!</span>
                        </button>
                    </p>
                </div>
            </div>
            <div class="w-full lg:w-1/2 flex justify-center">
                <a href="#!" onclick="showModal()"
                    class="chat-button bg-[#008000] text-decoration-none hover:text-[#008000] text-white text-lg p-2 rounded-3xl w-full lg:w-1/2 flex items-center justify-center gap-1">
                    <span class="chat-button-icon"><img src="{{ asset('./details-page/icons/chat.png') }}"
                            alt=""></span>
                    <span> Upload Receipt</span>
                </a>
            </div>
        </div>

    </div>

    <div class="w-full flex justify-center">
        <div class="lg:max-w-[1110px] w-[90vw] mx-auto mb-10">
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
                                    class="m-0 p-0 text-[#008000] font-bold hover:text-[#008000] text-decoration-none">Read
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
                                    class=" m-0 p-0 text-[#008000] font-bold hover:text-[#008000] text-decoration-none">
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
                                    class=" m-0 p-0 text-[#008000] font-bold hover:text-[#008000] text-decoration-none">
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
                                    class=" m-0 p-0 text-[#008000] font-bold hover:text-[#008000] text-decoration-none">
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
                                    class=" m-0 p-0 text-[#008000] font-bold hover:text-[#008000] text-decoration-none">
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
        // Function to handle the flash message
        function handleFlashMessage(status, message) {
            if (status === 'success') {
                // Clear local storage on success
                localStorage.clear();
                // console.log(message);
                window.location.href = '/';
            } else if (status === 'error') {
                // console.log(message);
            }
        }

        // Get flash data from session
        const status = @json(session('status'));
        const message = @json(session('message'));

        // Handle the flash message
        if (status && message) {
            handleFlashMessage(status, message);
        }
    });
</script>

<script>
    $(document).ready(function () {
        $('#dropzone-file').on('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Create an image element and set its source to the file data URL
                    const img = $('<img>').attr('src', e.target.result).addClass(
                        'w-full h-1/3 object-cover rounded-lg');

                    // Clear any existing content in the dropzone and append the new image
                    $('#dropzone-file').siblings('div').empty().append(img);

                    // Generate a unique file name
                    const randomString = Math.random().toString(36).substring(2, 15);
                    const fileExtension = file.name.split('.').pop();
                    const fileName = `${randomString}.${fileExtension}`;
                    const filePath = `deposit_receipts/${fileName}`;

                    // Store the path in local storage
                    const bookingData = JSON.parse(localStorage.getItem('bookingData')) || {};
                    bookingData.deposit_receipt = filePath;
                    localStorage.setItem('bookingData', JSON.stringify(bookingData));
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const timeKey = 'futureTime';

        function calculateFutureTime() {
            const now = new Date();
            const futureTime = new Date(now.getTime() + 30 * 60 * 1000); // Add 30 minutes
            return futureTime.toISOString();
        }

        function updateRemainingTime() {
            const futureTimeISOString = localStorage.getItem(timeKey);
            if (futureTimeISOString) {
                const futureTime = new Date(futureTimeISOString);
                const now = new Date();
                const timeDiff = futureTime - now;

                if (timeDiff <= 0) {
                    // Time has expired
                    localStorage.removeItem(timeKey); // Remove expired time from storage
                    window.location.href = '/'; // Redirect to home page
                    return;
                }

                // Calculate remaining time
                const totalSeconds = Math.floor(timeDiff / 1000);
                const remainingHours = Math.floor(totalSeconds / 3600);
                const remainingMinutes = Math.floor((totalSeconds % 3600) / 60);
                const remainingSeconds = totalSeconds % 60;

                // Convert remaining hours to 12-hour format and determine AM/PM
                const isPM = remainingHours >= 12;
                const displayHours = remainingHours % 12 || 12; // Convert 0 to 12 for midnight
                const period = isPM ? 'PM' : 'AM';

                // Format time to HH:MM:SS AM/PM
                const formattedHours = displayHours < 10 ? '0' + displayHours : displayHours;
                const formattedMinutes = remainingMinutes < 10 ? '0' + remainingMinutes : remainingMinutes;
                const formattedSeconds = remainingSeconds < 10 ? '0' + remainingSeconds : remainingSeconds;
                const timeString = `${formattedHours}:${formattedMinutes}:${formattedSeconds} ${period}`;

                document.getElementById('time-remaining').textContent = timeString;
            } else {
                // If future time doesn't exist, create and store it
                localStorage.setItem(timeKey, calculateFutureTime());
                updateRemainingTime();
            }
        }

        // Initialize the countdown timer and set it to update every second
        updateRemainingTime();
        setInterval(updateRemainingTime, 1000); // Update every second
    });


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

<script>
    function copyToClipboard(elementId, button) {
        var textToCopy = document.getElementById(elementId).innerText;
        navigator.clipboard.writeText(textToCopy).then(function () {
            // Show the tooltip
            var tooltip = button.querySelector('.tooltip');
            tooltip.classList.add('show-tooltip');

            // Hide the tooltip after 1 second
            setTimeout(function () {
                tooltip.classList.remove('show-tooltip');
            }, 1000);
        }, function (err) {
            console.error('Error copying text: ', err);
        });
    }
</script>

<script>
    function showModal() {
        // Show the loader modal
        document.getElementById('loaderModal').classList.remove('hidden');

        // Simulate file upload process
        setTimeout(function () {
            // Hide the loader modal
            document.getElementById('loaderModal').classList.add('hidden');
            // Show the rating and reviews modal
            document.getElementById('reviewsModal').classList.remove('hidden');
        }, 3000); // Adjust the time as needed
    }

    function closeReviewModal() {
        // Hide the rating and reviews modal
        document.getElementById('reviewsModal').classList.add('hidden');
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Load and display booking data from local storage
        const bookingData = JSON.parse(localStorage.getItem('bookingData'));

        if (bookingData) {
            document.getElementById('under3YearsCount').value = bookingData.kids_under_3_years;
            document.getElementById('between3To8YearsCount').value = bookingData.kids_between_3_to_8;
            document.getElementById('above8YearsCount').value = bookingData.adults_in_number;

            // Format the payment amount
            const paymentAmount = parseFloat(bookingData.payment_amount.replace(/[^0-9.]/g, ''));
            const formattedAmount = paymentAmount.toLocaleString('en-US');
            document.getElementById('payment_amount').value = formattedAmount;
            document.getElementById('payment_amount_value').textContent = formattedAmount;

            document.getElementById('payment_type').value = bookingData.payment_type;
            document.getElementById('is_paid').textContent = bookingData.is_paid;
            document.getElementById('status').value = bookingData.status;
            document.getElementById('created_at').value = bookingData.created_at;
            document.getElementById('updated_at').value = bookingData.updated_at;
            document.getElementById('tour_id').value = bookingData.tour_id;
            document.getElementById('user_id').value = bookingData.user_id;
            document.getElementById('name').value = bookingData.name;
            document.getElementById('email').value = bookingData.email;
            document.getElementById('phone').value = bookingData.phone;
            document.getElementById('payment_method').value = bookingData.payment_method || 'N/A';
            document.getElementById('pickup_point_id').value = bookingData.pickup_point_id || 'N/A';
            document.getElementById('package_type').value = bookingData.package_type || 'N/A';
            document.getElementById('deposit_receipt').value = bookingData.deposit_receipt ||
                'Please attach deposit receipt';
            document.getElementById('user_message').value = bookingData.user_message || 'N/A';
        }

        // Function to update local storage with the selected payment method and user message
        function updateLocalStorage() {
            const bookingData = JSON.parse(localStorage.getItem('bookingData')) || {};

            if (bookingData) {
                // Get the user message from the textarea
                const userMessageText = document.getElementById('message').value;

                bookingData.user_message = userMessageText;
                bookingData.created_at = new Date().toISOString(),
                    bookingData.updated_at = new Date().toISOString(),

                    // Save updated bookingData to local storage
                    localStorage.setItem('bookingData', JSON.stringify(bookingData));
            }
        }

        // Add event listener to update local storage with the selected payment method
        document.querySelectorAll('input[name="payment-method"]').forEach(input => {
            input.addEventListener('change', updateLocalStorage);
        });

        // Attach event listener to the submit button
        document.querySelector('#submit_review').addEventListener('click', function (event) {
            event.preventDefault();
            updateLocalStorage();
            closeReviewModal();
            setTimeout(() => {
                window.location.reload();
            }, 100);
        });
    });
</script>
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
@endsection