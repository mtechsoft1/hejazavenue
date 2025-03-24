@extends('layouts.app')
@section('title')
    Compass Tour
@endsection
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>


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
    </style>

    <!-- Show the success message -->
    @if (session()->has('success'))
        <div class="container md:w-1/3 mt-4 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
            <span class="font-medium">Success alert!</span> {{ session()->get('success') }}
        </div>
    @endif



    <div class="container-fluid">
        <div class="row background-img">
            <div class="outside-div w-75 m-auto p-3">
                <div class="inner-div col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="{{ route('search_tours') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row col-12">
                            <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12 p-0">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" name="destination" id="going" class="form-control"
                                            placeholder="Where are you going?" />
                                    </div>
                                </div>
                            </div>

                            <!-- /.col-md-3 -->
                            <div class=" col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        </span>
                                        <select class="form-control" name="destination_id" id="single-filter">
                                            <option value="">Location</option>
                                            @foreach ($destinations as $destination)
                                                <option value="{{ $destination->id }}">{{ $destination->destination_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="field col-md-3 col-sm-6 col-xs-6 pd-0 m-clear">
                                <div class="form-group">
                                    <button class="btn btn-success btn-block">
                                        <i class="fa fa-binoculars"></i> Search
                                    </button>
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <!-- /.col-md-3 -->
                            <!--<div class="field col-md-3 col-sm-6 col-xs-12">-->
                            <!--  <div class="form-group">-->
                            <!--    <div class="input-group">-->
                            <!--      <span class="input-group-addon">-->
                            <!--        <i-->
                            <!--          class="flaticon-placeholder-filled-point"-->
                            <!--          aria-hidden="true"-->
                            <!--        ></i>-->
                            <!--      </span>-->
                            <!--      <select-->
                            <!--        class="form-control"-->
                            <!--        name="tour_type"-->
                            <!--        id="single-filter"-->
                            <!--      >-->
                            <!--        <option value="">Tour type</option>-->

                            <!--        <option value="35">Adventure Tours</option>-->

                            <!--        <option value="39">Children's Activities</option>-->

                            <!--        <option value="46">Family Friendly</option>-->

                            <!--        <option value="52">Guided Tours</option>-->

                            <!--        <option value="74">Self-Guided</option>-->

                            <!--        <option value="75">Sightseeing Tours</option>-->

                            <!--        <option value="79">Special Interest Tours</option>-->

                            <!--        <option value="85">Theme Tours</option>-->
                            <!--      </select>-->
                            <!--    </div>-->
                            <!--  </div>-->
                            <!--</div>-->
                        </div>
                        <!--<div class="row col-12">-->
                        <!--  <div class=" col-md-3 col-sm-6 col-xs-6 p-0">-->
                        <!--    <div class="form-group">-->
                        <!--      <div class="input-group">-->
                        <!--        <span class="input-group-addon"-->
                        <!--          ><i class="fa fa-money" aria-hidden="true"></i>-->
                        <!--          Min</span-->
                        <!--        >-->
                        <!--        <input-->
                        <!--          type="number"-->
                        <!--          min="0"-->
                        <!--          name="min"-->
                        <!--          placeholder="Price from"-->
                        <!--          class="form-control"-->
                        <!--          value=""-->
                        <!--          id="single-filter"-->
                        <!--        />-->
                        <!--      </div>-->
                        <!-- /.input-group -->
                        <!--    </div>-->
                        <!-- /.form-group -->
                        <!--  </div>-->

                        <!--  <div class=" col-md-3 col-sm-6 col-xs-6">-->
                        <!--    <div class="form-group">-->
                        <!--      <div class="input-group">-->
                        <!--        <span class="input-group-addon"-->
                        <!--          ><i class="fa fa-money" aria-hidden="true"></i>-->
                        <!--          Max</span-->
                        <!--        >-->
                        <!--        <input-->
                        <!--          type="number"-->
                        <!--          min="0"-->
                        <!--          name="max"-->
                        <!--          placeholder="Price to"-->
                        <!--          class="form-control"-->
                        <!--          value=""-->
                        <!--          id="single_filter_single_package_widget-2_price_to"-->
                        <!--        />-->
                        <!--      </div>-->
                        <!-- /.input-group -->
                        <!--    </div>-->
                        <!-- /.form-group -->
                        <!--  </div>-->

                        <!--<div class="field col-md-3 col-sm-6 col-xs-12 p-0">-->
                        <!--  <div class="form-group">-->
                        <!--    <select-->
                        <!--      class="form-control"-->
                        <!--      name="filter-language"-->
                        <!--      id="single-filter"-->
                        <!--    >-->
                        <!--      <option value="">Language</option>-->

                        <!--      <option value="37">Urdu</option>-->
                        <!--      <option value="43">English</option>-->
                        <!--      <option value="48">Arabic</option>-->
                        <!--      <option value="49">German</option>-->
                        <!--      <option value="51">Greek</option>-->
                        <!--      <option value="55">Italian</option>-->
                        <!--      <option value="56">Japanese</option>-->
                        <!--      <option value="66">Polish</option>-->
                        <!--      <option value="71">Russian</option>-->
                        <!--      <option value="77">Spanish</option>-->
                        <!--      <option value="84">Thai</option>-->
                        <!--      <option value="87">Turkish</option>-->
                        <!--    </select>-->
                        <!--  </div>-->
                        <!-- /.form-group -->
                        <!--</div>-->
                        <!--  <div class="field col-md-3 col-sm-6 col-xs-6 pd-0 m-clear">-->
                        <!--    <div class="form-group">-->
                        <!--      <button class="btn btn-success btn-block">-->
                        <!--        <i class="fa fa-binoculars"></i> Search-->
                        <!--      </button>-->
                        <!--    </div>-->
                        <!-- /.form-group -->
                        <!--  </div>-->
                        <!--</div>-->
                    </form>
                </div>
            </div>
        </div>

        <div class="container grid-cols-1 sm:grid md:grid-cols-4 ">
            <div
                class="relative mx-3 mt-6 flex flex-col rounded-lg hover:bg-slate-100 transition duration-300 text-surface shadow-secondary-1 sm:shrink-0 sm:grow sm:basis-0">
                <a href="#!"
                    class="rounded-t-lg sm:rounded-t-none text-decoration-none text-surface hover:text-black">
                    <img class="rounded-t-lg" src="https://tecdn.b-cdn.net/img/new/standard/city/044.webp"
                        alt="Skyscrapers" />

                    <div class="p-3">
                        <div class="flex flex-row gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 30 30"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>

                            <h5 class="mb-2 text-xl font-bold leading-tight">A Trip from Lahore to Murre</h5>
                        </div>

                        <div>
                            <div class="flex flex-row gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 30 30"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>


                                <h5 class="mb-2 text-sm font-normal leading-tight"><b>Duration: </b>11 Days and 10 Nights
                                </h5>
                            </div>

                            <div class="flex flex-row gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 30 30"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>



                                <h5 class="mb-2 text-sm font-medium leading-tight"><b>Trip Date: </b>2024-08-29</h5>
                            </div>

                        </div>
                    </div>
                </a>
                <div
                    class="flex flex-row bg-slate-100 justify-between items-center border-t-2 border-white px-6 py-3 text-center text-surface/75">
                    <div class="flex flex-col justify-start items-start gap-1">
                        <div class="flex flex-row">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="green" viewBox="0 0 30 30" stroke-width="0"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="green" viewBox="0 0 30 30" stroke-width="0"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="green" viewBox="0 0 30 30" stroke-width="0"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="green" viewBox="0 0 30 30" stroke-width="0"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="green" viewBox="0 0 30 30" stroke-width="0"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>

                        </div>
                        <small>(2 Reviews)</small>
                    </div>
                    <h1 class="bg-[#108a00] text-white text-1xl font-bold rounded-full py-2.5 px-3">PKR 0.00</h1>
                </div>
                <div class="absolute top-2 left-2">
                    <div class="border border-3 border-[#108a00] rounded-full p-1">
                        <img src="https://cdn.dribbble.com/users/2959364/avatars/small/9afda620bf04b40ab310d16dbce65a2f.png?1696939287"
                            alt="hero image" class="w-16 h-16 rounded-full object-cover">
                    </div>
                </div>
            </div>
        </div>

        <!--new code of our best services-->
        <div id="service" class="sevices">
            <div class="service-div">
                <h2 class="servicetitle">
                    Our Best Services
                    <small> Why we are the best for our client </small><!-- /.description -->
                </h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class=" col-12 col-sm-6 col-md-4 col-sm d-flex mb-4">
                        <div class="card card-body flex-fill service-content">
                            <h3>Best destinations</h3>
                            <p>
                                Find out what the best destinations in the Pakistan are as
                                awarded by millions of real...
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-sm d-flex mb-4">
                        <div class="card card-body flex-fill service-content">
                            <h3>Best price guaranteed</h3>
                            <p>
                                We constantly ensures to have the lowest prices available
                                online and it is committed to protect...
                            </p>
                        </div>
                    </div>
                    <div class=" col-12 col-sm-6 col-md-4 col-sm d-flex mb-4">
                        <div class="card card-body flex-fill service-content">
                            <h3>Real Host Rating</h3>
                            <p>
                                You can find best hosts with real ratings which are provided
                                by our valuable guests...
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end-->

        <!---------------Our Best Services-------------->
        <!--<div id="service" class="sevices">-->
        <!--  <div class="container">-->
        <!--    <div class="service-div">-->
        <!--      <h2 class="servicetitle">-->
        <!--        Our Best Services-->
        <!--        <small> Why we are the best for our client </small-->
        <!--        >-->
        <!--/.description -->
        <!--      </h2>-->
        <!--    </div>-->
        <!--    <div class="row">-->
        <!--      <div class="col-md-4 col-sm-6 col-xs-12 flex-fill">-->
        <!--        <div class="service-container">-->
        <!--          <div class="service-content">-->
        <!--            <h3>Best destinations</h3>-->
        <!--            <p>-->
        <!--              Find out what the best destinations in the Pakistan are as-->
        <!--              awarded by millions of real...-->
        <!--            </p>-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--      <div class="col-md-4 col-sm-6 col-xs-12 flex-fill">-->
        <!--        <div class="service-container">-->
        <!--          <div class="service-content">-->
        <!--            <h3>Best price guaranteed</h3>-->
        <!--            <p>-->
        <!--              We constantly ensures to have the lowest prices available-->
        <!--              online and it is committed to protect...-->
        <!--            </p>-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--      <div class="col-md-4 col-sm-6 col-xs-12 flex-fill">-->
        <!--        <div class="service-container">-->
        <!--          <div class="service-content">-->
        <!--            <h3>Real Host Rating</h3>-->
        <!--            <p>-->
        <!--              You can find best hosts with real ratings which are provided-->
        <!--              by our valuable guests...-->
        <!--            </p>-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->

        <!--new code for our best packages-->
        <!--<div class="container">-->
        <!--    <div class="package-div">-->
        <!--        <h2 class="packagetitle">-->
        <!--          OUR MOST POPULAR PACKAGES-->
        <!--          <small> Browse through our most popular tours! </small-->
        <!--          >-->
        <!-- /.description -->
        <!--        </h2>-->
        <!--    </div>-->
        <!--    <div class="row ">-->
        <!--        @foreach ($tours as $tour)
    -->
        <!--            <div class=" col-lg-4 col-md-3 col-sm-6 col-xs-12 card-deck ">-->

        <!--                    <div class="card">-->
        <!--                        <a href="{{ route('tour_details', $tour->id) }}">-->
        <!--                            <figure>-->
        <!--                                <img-->
        <!--                                  class="card-img-top"-->
        <!--                                  src="{{ asset($tour->trip_image) }}"-->
        <!--                                  alt="Card image cap"-->
        <!--                                  style="height: 200px;"-->
        <!--                                />-->
        <!--                                <figcaption>-->
        <!--                                    <span>-->
        <!--                                        {{ Str::limit($tour->attractions, 25, ' ...') }}-->
        <!--                                    </span>-->
        <!--                                </figcaption>-->
        <!--                            </figure>-->
        <!--                        </a>-->
        <!--                        <div class="card-body">-->
        <!--                            <h5 class="card-title">-->
        <!--                                {{ $tour->trip_name }}-->
        <!--                            </h5>-->
        <!--                            <p class="card-text tour-duration">-->
        <!--                                <span class="fa fa-clock-o"></span>-->
        <!--                                <strong>Duration:</strong>-->
        <!--                                {{ $tour->trip_duration }} -->
        <!--                            </p>-->
        <!--                            <p class="card-text">-->
        <!--                                {{ Str::limit($tour->trip_description, 70, ' ...') }}-->
        <!--                            </p>-->
        <!--                        </div>-->
        <!--                        <div class="card-footer">-->
        <!--                            <div class="tour-meta">-->
        <!--                                <div class="tour-rating">-->
        <!--                                    <ul class="list-unstyled clearfix">-->
        <!--                                        <li>-->
        <!--                                          <i class="fa fa-star active"></i>-->
        <!--                                          <i class="fa fa-star active"></i>-->
        <!--                                          <i class="fa fa-star active"></i>-->
        <!--                                          <i class="fa fa-star active"></i>-->
        <!--                                          <i class="fa fa-star-half active"></i>-->
        <!--                                        </li>-->
        <!--                                        <li class="review">(2 Reviews)</li>-->
        <!--                                     </ul>-->
        <!--                                </div>-->
        <!--                                <div class="tour-price">-->
        <!--                                    <span>-->
        <!--                                        @if (isset($tour->pickup_points->per_seat_fare_currency))
    -->
        <!--                                         {{ $tour->pickup_points->per_seat_fare_currency }} -->
    <!--                                            @else-->
        <!--                                                PKR-->
        <!--
    @endif-->
        <!--                                        @if (isset($tour->pickup_points->per_seat_fare))
    -->
        <!--                                        {{ $tour->pickup_points->per_seat_fare }} -->
    <!--                                        @else-->
        <!--                                            0.00-->
        <!--
    @endif-->
        <!--                                    </span>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->

        <!--
    @endforeach-->
        <!--            </div>-->
        <!--             <div class="row justify-content-center py-3">-->
        <!--                <a href="{{ route('tours') }}"><button class="submit">Load More</button></a>-->
        <!--             </div>-->
        <!--    </div>-->

        <!--</div>-->
        <!--end new our best packages-->

        <!---------------Our Best Packages-------------->
        <div id="package" class="packages">
            <div class="container">
                <div class="package-div">
                    <h2 class="packagetitle">
                        OUR MOST POPULAR PACKAGES
                        <small> Browse through our most popular tours! </small><!-- /.description -->
                    </h2>
                </div>
                <div id="records-container">
                    <div class="row col-lg-12 col-12 " style="justify-content: space-between;">

                        @foreach ($tours as $tour)
                            <div class="col-xl-3 col-lg-4 transition-all duration-300 hover:bg-[#f3f8f9] rounded-lg col-md-4 col-sm-6 col-xs-12 mb-4 py-3 px-2 card  card-deck"
                                style="padding-left: 0px;padding-right: 0px;padding-top: 0px !important;padding-bottom: 0px !important;">
                                <div class="card-img">
                                    <a href="{{ route('tour_details', $tour->id) }}">
                                        <figure>
                                            <img class="card-img-top"src="{{ asset($tour->trip_image) }}"
                                                alt="Card image cap"
                                                style="height: 300px !important; object-fit: cover !important;" />

                                            <!-- Badge -->
                                            <div class="badges">
                                                <img src="{{ asset($tour->user->profile_image) }}"
                                                    style="width: 60px;height: 60px;border: 3px solid #009900 !important;margin-top: 10px;margin-left: 10px;"
                                                    class="border border-2 rounded-circle shadow-4-strong"></img>
                                            </div>

                                            <!--<figcaption>-->
                                            <!--  <span>{{ Str::limit($tour->attractions, 25, ' ...') }}</span>-->
                                            <!--</figcaption>-->
                                        </figure>
                                    </a>
                                </div>
                                <div class="card-body">

                                    <h3 class="card-title">
                                        <i class="fa fa-map-marker" aria-hidden="true"
                                            style="margin-left:-18px;color:green"></i>
                                        <a href="{{ route('tour_details', $tour->id) }}"
                                            style="margin-left: 5px;color:green;text-decoration:none">{{ $tour->trip_name }}</a>
                                    </h3>

                                    <p class="tour-duration">
                                        <span class="fa fa-clock-o"></span>
                                        <strong>Duration:</strong>{{ $tour->trip_duration }}
                                    </p>
                                    <p class="tour-duration">
                                        <span style="color:green" class="fa fa-calendar"></span>
                                        <strong>Trip Date:</strong>
                                        {{ \Carbon\Carbon::parse($tour->trip_start_date)->format('Y-m-d') }}
                                    </p>
                                    <!--<p class="card-text">-->
                                    <!--  {{ Str::limit($tour->trip_description, 70, ' ...') }}-->
                                    <!--</p>-->
                                </div>
                                <div class="card-footer" style="width:100%">
                                    <div class=" tour-meta py-2">
                                        <div class="tour-rating px-3">
                                            <ul class="list-unstyled clearfix">
                                                <li>
                                                    {!! str_repeat('<span><i class="fa fa-star"></i></span>', $tour->rating) !!}
                                                    {!! str_repeat('<span><i class="fa fa-star-o"></i></span>', 5 - $tour->rating) !!}
                                                </li>
                                                <li class="review">({{ $tour->reviews_count }} Reviews)
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tour-price">
                                            <span>
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

                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row justify-content-center py-3">
                    {{--  <a href="{{ route('tours') }}"><button class="submit">Load More</button></a>  --}}
                    <button id="load-more-btn w-25" data-offset="4"
                        class="md:w-1/4 btn bg-[#108A00] hover:bg-[#009900] transition-all duration-300 text-white text-md font-bold rounded-full">Load
                        More</button>
                </div>
            </div>
        </div>

        <!----------------Popular Destinations------------------>

        <div id="location" class="locations">
            <div class="container">
                <div class="location-div">
                    <h2 class="locationtitle">
                        Popular Destinations
                        <small> Find out what the best destinations in the Pakistan</small><!-- /.description -->
                    </h2>
                </div>
                <!-- destiantions boxes code here -->
                <div class="row">
                    @foreach ($destinations as $destination)
                        <div class="col-lg-3 col-md-3 col-xs-6">
                            <!-- Image Box -->
                            <a href="{{ route('destination_tour', $destination->id) }}" class="img-box hover-effect">
                                <img src="{{ asset(str_replace('public/', '', $destination->destination_image)) }}"
                                    class="img-responsive" alt="" />


                                <!-- Badge -->
                                <div class="badges">
                                    <span class="featured">{{ $destination->total_tours }} Tours</span>
                                </div>
                                <div class="img-box-content">
                                    <h4><strong>{{ $destination->destination_name }}</strong></h4>
                                    <ul class="stars text-center">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>

            <!--------------------Featured Tours--------------------->
            <div id="featured" class="featured">
                <div class="container">
                    <div class="package-div">
                        <h2 class="featuretitle">Featured tours
                            <small>Our Featured Tours can help you find the trip that's perfect for you! </small>
                            <!-- /.description -->
                        </h2>
                    </div>
                    <div id="load-more-container">
                        <div class="row col-12" style="justify-content: space-between;">
                            @foreach ($featureds as $tour)
                                <div class="col-md-3 col-sm-6 col-xs-12 py-3 card-deck">
                                    <div class="card-img">
                                        <a href="{{ route('tour_details', $tour->id) }}">
                                            <img class="card-img-top"src="{{ asset(str_replace('public/', '', $tour->trip_image)) }}"
                                                alt="Card image cap" style="height: 285px; object-fit: cover;" />

                                            <!-- Badge -->
                                            <div class="badges">
                                                <img src=" {{ asset(str_replace('public/profile_images/', '', $tour->user->profile_image)) }} "
                                                    style="width: 60px;height: 60px;border: 3px solid #009900 !important;margin-top: 23px;margin-left: 23px;"
                                                    class="border border-2 rounded-circle shadow-4-strong"></img>
                                            </div>

                                            <!--<figcaption>-->
                                            <!--  <span>{{ Str::limit($tour->attractions, 30, ' ...') }}</span>-->
                                            <!--</figcaption>-->
                                            </figure>
                                        </a>

                                        <div class="card-body">
                                            <h3 class="card-title">
                                                <i class="fa fa-map-marker" aria-hidden="true"
                                                    style="margin-left:-18px;color:green"></i>
                                                <strong style="margin-left: 5px;">{{ $tour->trip_name }}</strong>
                                            </h3>
                                            <p class="tour-duration">
                                                <span class="fa fa-clock-o"></span>
                                                <strong>Duration:</strong>
                                                {{ $tour->trip_duration }}
                                            </p>
                                            <p class="tour-duration">
                                                <span style="color:green" class="fa fa-calendar"></span>
                                                <strong>Trip Date:</strong>
                                                {{ \Carbon\Carbon::parse($tour->trip_start_date)->format('Y-m-d') }}
                                            </p>
                                            <!--<p class="card-text">-->
                                            <!--  {{ Str::limit($tour->trip_description, 70, ' ...') }}-->
                                            <!--</p>-->
                                            <div class="card-footer"
                                                style="width: 121%; padding: 7px 22px; margin-left: -29px">
                                                <div class=" tour-meta">
                                                    <div class="tour-rating">
                                                        <ul class="list-unstyled clearfix">
                                                            <li>
                                                                {!! str_repeat('<span><i class="fa fa-star"></i></span>', $tour->rating) !!}
                                                                {!! str_repeat('<span><i class="fa fa-star-o"></i></span>', 5 - $tour->rating) !!}
                                                            </li>
                                                            <li class="review">({{ $tour->reviews_count }} Reviews)
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="tour-price">
                                                        <span>
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
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row justify-content-center py-3">
                        <!--<a href="{{ route('tours') }}"><button class="submit">Load More</button></a>-->
                        <button id="load-more" data-offset="4"
                            class="md:w-1/4 btn bg-[#108A00] hover:bg-[#009900] transition-all duration-300 text-white text-md font-bold rounded-full">Load
                            More</button>
                    </div>
                </div>
            </div>

            <!-----------------Customers Testimonial------------------------->
            <div id="location" class="locations">
                <div class="container">
                    <div class="location-div">
                        <h2 class="locationtitle">
                            WHAT OUR CUSTOMERS SAY
                            <small>
                                We have many happy customers that have booked holidays with
                                us.</small>
                        </h2>
                        <!-- Testimonials code here -->
                    </div>
                    <!-- Testimonials code here -->
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="alert alert-success m-2" role="alert">
                                <h4 class="alert-heading">Well done!</h4>
                                <div class="data">
                                    <p>
                                        <q>
                                            The trip was fabulous. Mike and Elizabeth provided us with
                                            a wealth of information. Our group bonded together well.
                                        </q>
                                    </p>
                                    <h5>Talha Khan</h5>
                                    <span>Ongoing Themes </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="alert alert-success m-2" role="alert">
                                <h4 class="alert-heading">Wonderful day!</h4>
                                <div class="data">
                                    <p>
                                        <q>
                                            We had a wonderful day, The guide was fabulous, although
                                            we were the only Pakistani on board he did everything.
                                        </q>
                                    </p>
                                    <h5>Imran Qasim</h5>
                                    <span>OngoingThemes </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#load-more-btn').click(function() {
                var offset = $(this).data('offset');
                var url = '{{ route('load-more-popular-packages') }}?offset=' + offset;

                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                        $('#records-container').append(response);
                        $('#load-more-btn').data('offset', offset + 4);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#load-more').click(function() {
                var offset = $(this).data('offset');
                var url = '{{ route('load-more-features-tours') }}?offset=' + offset;

                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                        $('#load-more-container').append(response);
                        $('#load-more').data('offset', offset + 4);
                    }
                });
            });
        });
    </script>
@endsection
