@extends('layouts.app')
@section('title')
    Tour Details
@endsection
@section('content')
    <!--<link rel="stylesheet" href="css/locdetails.css" />-->
    <style>
        .form-control-plaintext {
            background-color: #f5f8fa;
        }

        label {
            float: left;
        }

        .avatar {
            vertical-align: middle;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid #009900 !important;
        }

        .tourcity {
            padding: 15px 55px;
            background-color: #f7f7f7;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #F5F5F5;
        }

        .search-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #14A800;
            padding: 20px;
            border-radius: 10px;
            max-width: 800px;
            margin: 0 auto;
            margin-top: 50px;
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 100%;
        }

        .search-form div {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 5px;
            padding: 5px;
            margin: 5px;
            flex: 1;
            min-width: 200px;
            box-sizing: border-box;
        }

        .search-form input,
        .search-form select {
            padding: 5px;
            border: none;
            border-radius: 3px;
            width: 100%;
        }

        .search-form input[type="text"],
        .search-form input[type="date"],
        .search-form select {
            width: 100%;
        }

        .search-form button {
            padding: 10px;
            border: none;
            border-radius: 3px;
            background-color: white;
            cursor: pointer;
            flex: 1;
            min-width: 150px;
            margin: 5px;
        }

        .search-form img {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }

        .search-form select option {
            background-color: white;
            color: black;
        }

        .search-form select option:checked,
        .search-form select option:hover {
            background-color: #14A800;
            color: white;
        }

        @media (max-width: 600px) {
            .search-form {
                flex-direction: column;
                align-items: stretch;
            }

            .search-form div,
            .search-form button {
                flex: none;
                width: 100%;
            }
        }

        .nav-tabs .nav-link {
            color: black;
            padding: 10px 20px;
            border: none;
        }

        .nav-tabs .nav-link.active {
            color: black;
            border: none;
            border-bottom: 2px solid #14A800;
        }

        .nav-tabs .nav-link:hover {
            border: none;
            border-bottom: 2px solid #14A800;
        }

        .nav-tabs {
            border-bottom: none;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE 10+ */
        }

        .nav-tabs::-webkit-scrollbar {
            display: none;
            /* Safari and Chrome */
        }

        .nav-tabs {
            border-bottom: none;
            flex-wrap: nowrap;
        }

        .green-color {
            color: #14A800 !important;
        }

        .green-color-background {
            background-color: #14A800 !important;
        }

        .flex {
            display: flex;
        }

        .flex-col {
            display: flex;
            flex-direction: column;
        }

        .gallery {
            display: grid;
            gap: 10px;
        }

        .gallery img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0px;
        }

        .row1-col1,
        .row1-col2,
        .row2-col {
            width: 50%;
            height: 300px;
            /* Adjust height as needed */
        }

        @media (max-width: 768px) {

            .row1-col1,
            .row1-col2,
            .row2-col {
                height: auto;
                width: 100%;
                /* Adjust height for smaller screens */
            }

            .small-margin {
                margin-bottom: .5rem !important;
            }
        }

        @media (min-width: 768px) {
            .small-height {
                height: 150px !important;
            }
        }

        @media (min-width: 768px) {
            .small-height2 {
                height: 75% !important;
            }
        }

        .gallery-width {
            width: 70%;
        }

        @media (max-width: 768px) {
            .gallery-width {
                width: 100%;
            }
        }

        .rating-section {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .rating-text {

            margin-right: 10px;
            text-align: right;
        }

        .rating-text h4 {
            font-size: 21px;
            margin: 0;
        }

        .rating-text p {
            font-size: 14px;
            margin: 0;
        }

        .rating-button {
            background-color: #00a650;
            color: white;
            font-size: 20px;
            border: none;
            padding: 10px 15px;
            border-radius: 20px 20px 20px 0px;
        }

        .testimonial-content {
            text-align: center;
            margin-bottom: 20px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .testimonial-content p {
            font-size: 0.8em;
            margin: 0;
            color: #333;
        }

        .next-btn {
            margin-top: 10px;
        }

        .person-info {
            align-items: center;
            margin-top: 30px;
        }

        .person-image {
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }

        .person-name {
            font-weight: bold;
            font-size: 1rem;
            color: #333;
        }

        .person-location {
            font-size: 0.9em;
            color: gray;
        }

        .rounded-div {
            width: 100%;
            height: 170px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .flex-res {
            display: flex;
            flex-direction: row;
        }

        @media (max-width: 768px) {
            .flex-res {
                display: flex;
                flex-direction: column;
            }
        }

        .wid-30 {
            width: 30%;
        }

        @media (max-width: 768px) {
            .wid-30 {
                width: 100%;
                justify-content: center;
                align-items: center;
            }

            .rating-section {
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }

        .container-custom {
            border: 2px solid black;
            border-radius: 45px;
            padding: 20px;
        }

        .flex-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .bullet {
            width: 10px;
            height: 10px;
            background-color: black;
            border-radius: 50%;
            margin-right: 10px;
        }

        .icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .text {
            flex: 1;
        }

        .flex-item i {
            padding-right: 12px;
        }

        .card-header-custom {
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
            padding: 15px;
            border-left: 5px solid #007bff;
        }

        .card-header-custom h5 {
            margin: 0;
            font-size: 1rem;
            font-weight: bold;
        }

        .card-body-custom {
            padding: 1rem;
            border: 1px solid #ddd;
            border-top: none;
            background-color: #fff;
        }

        .btn-link {
            text-decoration: none;
            color: Black;
            font-weight: bold;
            width: 100%;
            text-align: left;
        }

        .btn-link:hover {
            text-decoration: none;
            color: #007bff;
        }

        .btn-link:after {
            content: '⨯';
            /* FontAwesome down arrow */
            font-family: 'FontAwesome';
            float: right;
        }

        .btn-link.collapsed:after {
            content: '＞';
            /* FontAwesome right arrow */
        }

        .card {
            border: none;
            background-color: #F5F5F5;

        }

        .card-header-custom {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid black;
            cursor: pointer;
            padding: 15px;
            border-left: none
        }

        .fare-section {
            width: 100%;
            height: 333px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            background-color: white;
        }

        .city-dropdown {
            background-color: #28a745;
            color: white;
            border: none;
            width: 100%;
            text-align: left;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .fare-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .fare-card,
        .travel-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 10px;
        }

        .travel-card {
            text-align: center;
        }

        .rating {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
        }

        .location {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px 0;
        }

        .location-icon {
            margin-right: 5px;
        }

        .chat-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-button-icon {
            margin-right: 5px;
        }

        .fare-details {

            width: 60%;
        }

        .travel-details {

            width: 35%;
        }

        .progress-bar-custom {
            padding: 10px 12px;
            background: radial-gradient(50% 50% at 50% 50%, #F9C339 0%, #B545CF 100%);
            border-radius: 12px;
            color: white;
            text-align: right;
            position: relative;
        }

        .progress-bar-custom span {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .progress-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .progress-container .label {
            width: 20%;
        }

        .progress-container .bar {
            width: 70%;
            padding: 0 5px;
        }

        .progress-container .value {
            width: 10%;
            text-align: right;
        }


        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            -webkit-animation: spin 2s linear infinite;
            -o-animation: spin 2s linear infinite;
            -moz-animation: spin 2s linear infinite;
            display: none;
            animation: spin 2s linear infinite;
            margin: 20px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <!-- search Section Starts -->

    {{--  <div class="search-container">

        <form class="search-form">
            <div>
                <img src="{{ asset('./details-page/icons/place.png') }}" alt="Location Icon">
                <input type="text" placeholder="Where are you going?">
            </div>
            <div>
                <img src="{{ asset('./details-page/icons/location.png') }}" alt="State Icon">
                <select>
                    <option value="">State</option>
                    <option value="Punjab">Punjab</option>
                    <option value="Sindh">Sindh</option>
                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                    <option value="Balochistan">Balochistan</option>
                </select>
            </div>
            <div>
                <img src="{{ asset('./details-page/icons/city.png') }}" alt="City Icon">
                <select>
                    <option value="">City</option>
                    <option value="Lahore">Lahore</option>
                    <option value="Karachi">Karachi</option>
                    <option value="Peshawar">Peshawar</option>
                    <option value="Quetta">Quetta</option>
                </select>
            </div>
            <div>
                <img src="{{ asset('./details-page/icons/date.png') }}" alt="Calendar Icon">
                <input type="date">
            </div>
            <!-- <div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <img src="{{ asset('./details-page/icons/calendar.png') }}" alt="Calendar Icon">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <input type="date">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div> -->
            <div>
                <img src="{{ asset('./details-page/icons/person.png') }}" alt="Person Icon">
                <select>
                    <option value="1">1 Person</option>
                    <option value="2">2 Persons</option>
                    <option value="3">3 Persons</option>
                    <option value="4">4 Persons</option>
                </select>
            </div>
            <button type="submit">Search</button>
        </form>
    </div>  --}}

    <!-- Search Section Ends -->




    <!-- Tabs Section Starts -->

    <div class="container mt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab"
                    aria-controls="overview" aria-selected="true">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info"
                    aria-selected="false">Info & Prices</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="facilities-tab" data-toggle="tab" href="#facilities" role="tab"
                    aria-controls="facilities" aria-selected="false">Facilities</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="rules-tab" data-toggle="tab" href="#rules" role="tab" aria-controls="rules"
                    aria-selected="false">House Rules</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab"
                    aria-controls="reviews" aria-selected="false">User Review (1,022)</a>
            </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content" id="myTabContent">


            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                <div>
                    <!-- Overview content start -->
                    <!-- rating row starts -->
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="me-3">
                            <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                                height="15">
                            <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                                height="15">
                            <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                                height="15">
                            <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                                height="15">
                            <img src="{{ asset('./details-page/icons/star-o.png') }}" alt="Star icon" width="15"
                                height="15">
                        </span>
                        <div class="d-flex align-items-center">
                            <a href="#">
                                <img src="{{ asset('./details-page/icons/heart.png') }}" alt="Heart icon" width="30"
                                    height="30">
                            </a>
                            <a href="#">
                                <img src="{{ asset('./details-page/icons/share.png') }}" alt="Share icon" width="30"
                                    height="30">
                            </a>

                            <a href="{{ route('booking_details', $tour->id) }}"
                                class="btn btn-primary ms-2 green-color-background">Book Now</a>

                        </div>
                    </div>
                    <!-- rating rows ends -->
                    <div class="container">
                        <div>
                            <div>
                                <h2>{{ $tour->trip_description }}</h2>
                            </div>
                            <div class="flex">
                                <p><span> <img src="{{ asset($tour->trip_image) }}" alt="location icon" width="15"
                                            height="15"></span> {{ $tour->trip_name }}</p>
                                <p style="margin-left: 50px;"><span style="font-size: 13px;"> By</span>
                                    {{ $tour->user->company_name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="container flex-res">
                        <div class="gallery-width">

                            <div class="container my-4">
                                <div class="gallery">
                                    <div class="row">
                                        <div class="col-md-6 row1-col1">
                                            <div class="row mb-2">
                                                <div class="col-12 small-margin">
                                                    <img class="small-height " src="{{ asset($tour->trip_image) }}"
                                                        alt="Image 1">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 small-margin">
                                                    <img class="small-height" src="{{ asset($tour->trip_image) }}"
                                                        alt="Image 2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row1-col2 small-margin">
                                            <img src="{{ asset($tour->trip_image) }}" alt="Image 3">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3 row2-col small-margin">
                                            <img class="small-height2" src="{{ asset($tour->trip_image) }}"
                                                alt="Image 4">
                                        </div>
                                        <div class="col-md-3 row2-col small-margin">
                                            <img class="small-height2" src="{{ asset($tour->trip_image) }}"
                                                alt="Image 5">
                                        </div>
                                        <div class="col-md-3 row2-col small-margin">
                                            <img class="small-height2" src="{{ asset($tour->trip_image) }}"
                                                alt="Image 6">
                                        </div>
                                        <div class="col-md-3 row2-col small-margin">
                                            <img class="small-height2" src="{{ asset($tour->trip_image) }}"
                                                alt="Image 7">
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="wid-30"> <!--30% Column Starts -->
                            <div class="d-flex" style="flex-direction: column;">

                                <div> <!-- Rating section starts -->
                                    <div class="container my-4">
                                        <div class="rating-section">
                                            <div class="rating-text">
                                                <h4>Superb</h4>
                                                <p>1,022 reviews</p>
                                            </div>
                                            <button class="rating-button">9.1</button>
                                        </div>
                                    </div>
                                </div> <!-- Rating section Ends -->
                                <div> <!--Testmonial section starts-->
                                    <div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="testimonial-content text-center">
                                                        <p>we had a grate journey with them it was totally fun, enjoyed it a
                                                            lot i recommend everyone to tour with them</p>
                                                        <button style="margin-left: 87%; border: none; box-shadow: none;"
                                                            class="btn btn-outline-secondary next-btn"
                                                            data-target="#testimonialCarousel" data-slide="next">
                                                            <img src="{{ asset('./details-page/icons/right-arrow.png') }}"
                                                                alt="Star icon" width="15" height="auto">
                                                        </button>
                                                    </div>

                                                    <div class="d-flex flex-row align-items-center person-info mt-4">
                                                        <img src="{{ asset('./details-page/images/person1.png') }}"
                                                            class="person-image" alt="Person">
                                                        <div class="ml-3">
                                                            <span class="person-name">Aysha</span>
                                                            <span class="person-location d-block mt-1">from Lahore</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="carousel-item ">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="testimonial-content text-center">
                                                        <p>we had a grate journey with them it was totally fun, enjoyed it a
                                                            lot i recommend everyone to tour with them</p>
                                                        <button style="margin-left: 87%; border: none; box-shadow: none;"
                                                            class="btn btn-outline-secondary next-btn"
                                                            data-target="#testimonialCarousel" data-slide="next">
                                                            <img src="{{ asset('./details-page/icons/right-arrow.png') }}"
                                                                alt="Star icon" width="15" height="auto">
                                                        </button>
                                                    </div>

                                                    <div class="d-flex flex-row align-items-center person-info mt-4">
                                                        <img src="{{ asset('./details-page/images/person1.png') }}"
                                                            class="person-image" alt="Person">
                                                        <div class="ml-3">
                                                            <span class="person-name">Aysha</span>
                                                            <span class="person-location d-block mt-1">from Lahore</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Add more carousel items here for more testimonials -->
                                        </div>
                                    </div>



                                </div> <!--Testmonial section Endss-->
                                <div style="height: 200px;">

                                    <div class="container mt-5">
                                        <div class="rounded-div" id="map"></div>
                                    </div>


                                </div>
                            </div>
                        </div> <!--30% Column Ends -->
                    </div>
                    <!-- Overview content Ends -->

                </div>
            </div>




            <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                <h3>Info & Prices Content</h3>
                <p>This is the content for the Info & Prices tab.</p>
            </div>
            <div class="tab-pane fade" id="facilities" role="tabpanel" aria-labelledby="facilities-tab">
                <h3>Facilities Content</h3>
                <p>This is the content for the Facilities tab.</p>
            </div>
            <div class="tab-pane fade" id="rules" role="tabpanel" aria-labelledby="rules-tab">
                <h3>House Rules Content</h3>
                <p>This is the content for the House Rules tab.</p>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <h3>User Review Content</h3>
                <p>This is the content for the User Review tab.</p>
            </div>
        </div>
    </div>

    <!-- Tabs Section Ends -->
    <!-- rounded Black container started -->
    <div class="container container-custom d-flex justify-content-between">
        <div class="flex-item">
            <div class="bullet"></div>
            <i><img src="{{ asset('./details-page/icons/cam.png') }}" alt="Star icon"></i>
            <div class="text">Camera</div>
        </div>
        <div class="flex-item">
            <div class="bullet"></div>
            <i><img src="{{ asset('./details-page/icons/bed.png') }}" alt="Star icon"></i>
            <div class="text">Car</div>
        </div>
        <div class="flex-item">
            <div class="bullet"></div>
            <i><img src="{{ asset('./details-page/icons/coffe.png') }}" alt="Star icon"></i>
            <div class="text">Free Tea</div>
        </div>
        <div class="flex-item">
            <div class="bullet"></div>
            <i><img src="{{ asset('./details-page/icons/burger.png') }}" alt="Star icon"></i>
            <div class="text">Free Burger</div>
        </div>
        <div class="flex-item">
            <div class="bullet"></div>
            <i><img src="{{ asset('./details-page/icons/spoons.png') }}" alt="Star icon"></i>
            <div class="text">Free Spoons</div>
        </div>
        <div class="flex-item">
            <div class="bullet"></div>
            <i><img src="{{ asset('./details-page/icons/cars.png') }}" alt="Star icon"></i>
            <div class="text">Free Cars</div>
        </div>
    </div>
    <!-- rounded Black container Ended -->

    <!-- Heading section starts -->
    <div style="display: flex; flex-direction: column; gap: 20px; justify-content: space-between;">

        <diV class="container my-4" style="padding-top: 25PX;"> <!-- 1st heading starts-->
            <div>
                <h4 style="padding-bottom: 10px;">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </h4>
            </div>
            <div>
                <p>
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                    took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                    centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                </p>
                <p>
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                    took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                    centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                </p>
                <p>
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                    took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                    centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                </p>
                <p>
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                    took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                    centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                </p>
                <p>
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                    took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                    centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                </p>
                <p>
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                    took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                    centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                </p>
            </div>
        </diV> <!-- 1st heading Ends-->

        <div class="container">
            <h4>
                Attractions
            </h4>
            <p>
                {{ $tour->attractions ?? 'No Attractions Found' }}
            </p>
        </div>
        <div class="container d-flex  " style="align-items: center;">
            <img src="{{ asset('./details-page/icons/green-wallet.png') }}" alt="Star icon"
                style="margin-top: -10px; margin-right: 10px;">
            <p style="padding-right: 10px;">
                Lowest price gurantee
            </p>
            <p style="padding-right: 10px;">
                Free cancellation
            </p>
            <p style="padding-right: 10px;">
                Reserve now
            </p>
            <p style="padding-right: 10px;">
                & pay later
            </p>
        </div>
        <div class="container d-flex  " style="align-items: center; padding: 20px;">
            <img src="{{ asset('./details-page/icons/Icon feather-calendar.png') }}" alt="Star icon"
                style="margin-top: -20px; margin-right: 10px;">
            <p style="padding-right: 10px;">
                Duration:
            </p>
            <p style="padding-right: 10px;">
                {{ $tour->trip_duration ?? 'No Duration Found' }}
            </p>

        </div>


        <div class="container mt-5">
            <div id="accordion">
                <div class="card">
                    <div class="card-header card-header-custom" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                What's included
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body card-body-custom">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                            laborum eiusmod.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-custom" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                Departure and Return
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body card-body-custom">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                            laborum eiusmod.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-custom" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                Accessibility
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body card-body-custom">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                            laborum eiusmod.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-custom" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                Additional Information
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body card-body-custom">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                            laborum eiusmod.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-custom" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                Cancellation Policy
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body card-body-custom">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                            laborum eiusmod.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-custom" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                FAQ
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body card-body-custom">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                            laborum eiusmod.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-custom" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                Help
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body card-body-custom">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                            3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                            laborum eiusmod.
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="container mt-5">
            <div class="d-flex justify-content-between">
                <!-- 1st Div: Fare Details -->
                <div class="fare-details">
                    <h3>Fare Details</h3>
                    <div>
                        <div class="fare-section">

                            <div class="d-flex"
                                style="height: 20%; display: flex; flex-direction: row; justify-content: center; align-items: center;">
                                <select id="city-dropdown" class="city-dropdown mr-4 ">
                                    <option value="" disabled selected>Select City</option>
                                    @foreach ($allCities as $city)
                                        <option value="{{ $city }}">{{ $city }}</option>
                                    @endforeach
                                </select>

                                <div id="loader" class="loader"></div>
                            </div>

                            <!-- 2nd Row: Per Seat Fare -->
                            <div id="per-seat-fare" class="fare-row">
                                <b>Per Seat Fare:</b>
                                <p></p>
                            </div>

                            <!-- 3rd Row: Couple Package Fare -->
                            <div id="couple-package-fare" class="fare-row">
                                <b>Couple Package Fare:</b>
                                <p></p>
                            </div>

                            <!-- 4th Row: Family Package Fare -->
                            <div id="family-package-fare" class="fare-row">
                                <b>Family Package Fare:</b>
                                <p></p>
                            </div>

                            <!-- 5th Row: Pickup Date -->
                            <div id="pickup-date" class="fare-row">
                                <b>Pickup Date:</b>
                                <p></p>
                            </div>

                            <!-- 6th Row: Pickup Time -->
                            <div id="pickup-time" class="fare-row">
                                <b>Pickup Time:</b>
                                <p></p>
                            </div>

                            <!-- 7th Row: Pickup Point -->
                            <div id="pickup-point" class="fare-row">
                                <b>Pickup Point:</b>
                                <p></p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- 2nd Div: Travel Details -->
                <div class="travel-details">
                    <h3>Travel Details</h3>
                    <div class="travel-card fare-section"
                        style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <img src="https://www.sajjao.com/compass_new/public/{{ $tour->user->profile_image }}"
                            alt="Mtech Logo" width="100">
                        <h4>{{ $tour->user->company_name }} Travels</h4>
                        <div class="rating">
                            <span class="me-3 d-flex">
                                <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                                    height="15">
                                <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                                    height="15">
                                <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                                    height="15">
                                <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                                    height="15">
                                <img src="{{ asset('./details-page/icons/star-o.png') }}" alt="Star icon" width="15"
                                    height="15">
                            </span>
                            <span
                                style="padding-left: 5px;">{{ $tour->user->rating_stars == null ? 0 : $tour->user->rating_stars }}</span>
                        </div>
                        <div class="location">
                            <span><img src="{{ asset('./details-page/icons/location.png') }}" alt="location"
                                    height="auto" width="15px" style="margin-right: 5px;"></span>
                            <span>{{ $tour->user->address }}</span>
                        </div>
                        <button class="chat-button">
                            <span class="chat-button-icon"><img src="{{ asset('./details-page/icons/chat.png') }}"
                                    alt=""></span>
                            <span>Chat With Host</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" style="margin-top: 10px;">
            <h4>
                Ratting & Reviews
            </h4>
            <div class="rating" style="justify-content: start; ">
                <span class="me-3 d-flex">
                    <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                        height="15">
                    <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                        height="15">
                    <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                        height="15">
                    <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                        height="15">
                    <img src="{{ asset('./details-page/icons/star-o.png') }}" alt="Star icon" width="15"
                        height="15">
                </span>
                <span style="padding-left: 5px;">4/5</span>
            </div>
        </div>



        <div class="container mt-5 p-3" style="background-color: #f0f0f0; border-radius: 17px;">
            <div class="progress-container">
                <b class="label">Excellent</b>
                <div class="bar">
                    <div class="progress-bar-custom" style="width: 84%;"></div>
                </div>
                <div class="value">84</div>
            </div>
            <div class="progress-container">
                <b class="label">Very Good</b>
                <div class="bar">
                    <div class="progress-bar-custom" style="width: 70%;">

                    </div>
                </div>
                <div class="value">70</div>
            </div>
            <div class="progress-container">
                <b class="label">Average</b>
                <div class="bar">
                    <div class="progress-bar-custom" style="width: 50%;">

                    </div>
                </div>
                <div class="value">50</div>
            </div>
            <div class="progress-container">
                <b class="label">Poor</b>
                <div class="bar">
                    <div class="progress-bar-custom" style="width: 30%;">

                    </div>
                </div>
                <div class="value">30</div>
            </div>
            <div class="progress-container">
                <b class="label">Terrible</b>
                <div class="bar">
                    <div class="progress-bar-custom" style="width: 10%;">

                    </div>
                </div>
                <div class="value">10</div>
            </div>
        </div>


        <div class="container d-flex"
            style="justify-content:center; align-items: center; background-color: white; border-radius: 17px; padding: 10px; min-height: 250px; margin-top: 50px; justify-content: space-between; margin-bottom: 100px;">
            <div class="d-flex "
                style="flex-direction: column; width: 30%; justify-content:center; align-items: center; ">
                <img src="{{ asset('./details-page/images/person2.png') }}" alt="Mtech Logo" width="100">
                <h4>celia almeda</h4>
                <div class="rating">
                    <span class="me-3 d-flex">
                        <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                            height="15">
                        <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                            height="15">
                        <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                            height="15">
                        <img src="{{ asset('./details-page/icons/star.png') }}" alt="Star icon" width="15"
                            height="15">
                        <img src="{{ asset('./details-page/icons/star-o.png') }}" alt="Star icon" width="15"
                            height="15">
                    </span>
                    <span style="padding-left: 5px;">4/5</span>
                </div>
            </div>

            <div style="width: 70% ;">
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                    scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                    release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                    software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
            </div>

        </div>


    </div> <!-- Heading section Ends -->




    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('script')
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script>
        var BaseURL = "<?= url('') ?>";
        var csrf_token = '{{ csrf_token() }}';
    </script>

    <script type="text/javascript">
        $('#package_type').on('change', function() {
            $("#person_details").css('display', (this.value == 'single') ? 'block' : 'none');
        });


        function cash_on_pickup() {
            document.getElementById('bank_details').style.display = 'none';
        }

        function bank_transfer() {
            document.getElementById('bank_details').style.display = 'block';
        }
    </script>

    <script>
        function getCalculation() {

            var formData = new FormData($(this).closest('form')[0]);
            formData.append('_token', csrf_token);
            formData.append('package_type', $('#package_type').val());
            formData.append('adults_in_number', $('#adults_in_number').val());
            formData.append('kids_between_3_to_8', $('#kids_between_3_to_8').val());
            formData.append('kids_under_3_years', $('#kids_under_3_years').val());
            formData.append('pickup_point_id', $('#pickup_point_id').val());
            // console.log(formData);
            // for (var value of formData.values()) {
            //   console.log(value); 
            // }
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
    </script>

    <script>
        function initMap() {
            var mapOptions = {
                center: new google.maps.LatLng(31.5204, 74.3587), // Default to San Francisco
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        }
        initMap();
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cityDropdown = document.getElementById('city-dropdown');
            const loader = document.getElementById('loader');
            const perSeatFare = document.getElementById('per-seat-fare').querySelector('p:last-child');
            const couplePackageFare = document.getElementById('couple-package-fare').querySelector('p:last-child');
            const familyPackageFare = document.getElementById('family-package-fare').querySelector('p:last-child');
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
                        pickupDate.textContent = point.pickup_date;
                        pickupTime.textContent = point.pickup_time;
                        pickupPoint.textContent = point.pickup_point;
                    } else {
                        perSeatFare.textContent = '';
                        couplePackageFare.textContent = '';
                        familyPackageFare.textContent = '';
                        pickupDate.textContent = '';
                        pickupTime.textContent = '';
                        pickupPoint.textContent = '';
                    }

                    // Hide loader
                    loader.style.display = 'none';
                }, 500); // Adjust this time based on how long your actual data loading takes
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Adjust tab nav position for small screens
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
@endsection
