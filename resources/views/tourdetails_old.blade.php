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
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


    <div class="container-fluid">
        <!--<div class="tour-img">-->
        <!--  <div class="img-text">-->
        <!--    <h2>{{ $tour->trip_name }}</h2>-->
        <!-- <a href="index.html">Home</a>/Contact -->
        <!--  </div>-->
        <!--</div>-->
        <img class="card-img-top" src="{{ asset($tour->trip_image) }}" alt="Card image cap" style="height: 285px;" />
        <div class="tourcity">
            <div class="row">

                <div class="col-md-12" style="text-align: left; padding-top: 6px;">
                    <img src="{{ asset($tour->user->profile_image) }}" alt="Avatar" class="avatar">
                    <span style="display: inline-table; vertical-align: middle;">
                        <h3 style='font-size: 1rem; margin: auto;'>{{ $tour->user->company_name }}</h3>
                        <a href="{{ route('agency-tours-list', $tour->agency_id) }}"
                            style="color: #009900; font-weight: 700; margin: auto;text-decoration: none; ">All Tours</a>
                </div>
                <!--<p style="color: #009900; font-weight: 700; margin: auto; ">All Tours</p></div>-->
                </span>


                <div class="separator-border"></div>
                <!--<p>-->
                <!--  Gilgit City Tour From Traditional markers to the tall architectural-->
                <!--  masterplaces<br />-->
                <!--  Luxury Yacht Cruising.-->
                <!--</p>-->
            </div>
            <!--<div class="col-md-5">-->
            <!--  <p class="tour-tag">Sightseeing Tours</p>-->
            <!--</div>-->
        </div>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h2 style="font-weight: 700; color: #1d421d;">{{ $tour->trip_name }}</h2>
                        <h2>Tour Description</h2>
                    </div>

                    <div class="separator-border"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p>{{ $tour->trip_description }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h2>Tour Highlights</h2>
                    </div>

                    <div class="separator-border"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p>{{ $tour->attractions }}</p>
                    </div>
                </div>
                <!--<div class="row">-->
                <!--  <div class="col-12"><h2>Tour Highlights</h2></div>-->
                <!--  <div class="separator-border"></div>-->
                <!--  <br />-->

                <!--  <ul style="list-style-type: square">-->
                <!--    <li>-->
                <!--      Go inside the world's 4th largest mosque at the Sheikh Zayed-->
                <!--      Grand Mosque-->
                <!--    </li>-->
                <!--    <li>-->
                <!--      Marvel at the opulent Emirates Palace, Etihad Towers and-->
                <!--      Ferrari World-->
                <!--    </li>-->
                <!--    <li>Take a drive along the Abu Dhabi Corniche</li>-->
                <!--    <li>Visit the Abu Dhabi date market</li>-->
                <!--  </ul>-->
                <!--</div>-->
                <div class="row">
                    <div class="col-12">
                        <h2>Services</h2>
                    </div>
                    <div class="separator-border"></div>
                    <div class="row tour-service text-center col-lg-12 ">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 border">
                            <div class="tour-box card-body style2 text-center justify-content-center">
                                <!--<a href="#">-->
                                <i class="fa fa-credit-card" aria-hidden="true"></i><br />
                                <span>Easy cancellation</span>
                                <p>Yes</p>
                                <!--</a>-->
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 border">
                            <div class="tour-box card-body style2 text-center">
                                <!--<a href="#">-->
                                <i class="fa fa-ticket" aria-hidden="true"></i><br />
                                <span>Instant confirmation</span>
                                <p>Yes</p>
                                <!--</a>-->
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 border">
                            <div class="tour-box card-body style2 text-center">
                                <!--<a href="#">-->
                                <i class="fa fa-ticket" aria-hidden="true"></i><br />
                                <span>Pick-up Possible</span>
                                <p>Yes</p>
                                <!--</a>-->
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 border">
                            <div class="tour-box card-body style2 text-center">
                                <!--<a href="#">-->
                                <i class="fa fa-ticket" aria-hidden="true"></i><br />
                                <span>Skip the line</span>
                                <p>Yes</p>
                                <!--</a>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2>Prices & Pickup Points</h2>
                    </div>
                    @if ($pickup_points->count() > 0)
                        <table class="table table-sm table-hover">
                            <thead>
                                <th>City</th>
                                <th>Pickup Point</th>
                                <th>Per Person</th>
                                <th>Couple Package</th>
                                <th>Family Package</th>
                                <th>Under 3 Year</th>
                                <th>Between 3-8 Year</th>

                            </thead>
                            <tbody>
                                @foreach ($pickup_points as $pickup_point)
                                    <tr>
                                        <td>{{ $pickup_point->pickup_city }}</td>
                                        <td>{{ $pickup_point->pickup_point }}</td>
                                        <td>{{ $pickup_point->per_seat_fare_currency }} {{ $pickup_point->per_seat_fare }}
                                        </td>
                                        <td>{{ $pickup_point->couple_package_fare_currency }}
                                            {{ $pickup_point->couple_package_fare }}</td>
                                        <td>{{ $pickup_point->family_package_fare_currency }}
                                            {{ $pickup_point->family_package_fare }}</td>
                                        <td>{{ $pickup_point->couple_package_fare_currency }}
                                            {{ $pickup_point->kids_under_3_years }}</td>
                                        <td>{{ $pickup_point->family_package_fare_currency }}
                                            {{ $pickup_point->kids_between_3_to_8 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h4 style = "text-align:center">No Pickup Points Found!</h4>
                    @endif
                </div>
                <!--<div class="row">-->
                <!--  <h2>Know before you go</h2>-->
                <!--  <div class="separator-border"></div>-->
                <!--  <div class="know">-->
                <!--    • The Sheikh Zayed Centre is closed on Fridays, Saturdays and-->
                <!--    Islamic festival holidays. It is not possible to visit the-->
                <!--    Sheikh Zayed Mosque and Heritage Village during any Islamic-->
                <!--    festival • Mosques have very strict dress codes: women must wear-->
                <!--    long loose-->
                <!--  </div>-->
                <!--</div>-->
                <!--<div class="row">-->
                <!--  <div><h2>General FAQs</h2></div>-->
                <!--  <div class="separator-border"></div>-->
                <!--  <br />-->
                <!--  <div class="row">-->
                <!--    <div id="accordion">-->
                <!--      <div class="card">-->
                <!--        <div class="card-header" id="headingOne">-->
                <!--          <h5 class="mb-0">-->
                <!--            <button-->
                <!--              class="btn btn-link active"-->
                <!--              data-toggle="collapse"-->
                <!--              data-target="#collapseOne"-->
                <!--              aria-expanded="true"-->
                <!--              aria-controls="collapseOne"-->
                <!--            >-->
                <!--              What is included in the price of the tour?-->
                <!--            </button>-->
                <!--          </h5>-->
                <!--        </div>-->

                <!--        <div-->
                <!--          id="collapseOne"-->
                <!--          class="collapse show"-->
                <!--          aria-labelledby="headingOne"-->
                <!--          data-parent="#accordion"-->
                <!--        >-->
                <!--          <div class="card-body">-->
                <!--            he undivided attention of your expert native English-->
                <!--            speaking guide for the duration of the tour (it is a-->
                <!--            private walking tour, so only the people you book for-->
                <!--            will be on it).-->
                <!--          </div>-->
                <!--        </div>-->
                <!--      </div>-->
                <!--      <div class="card">-->
                <!--        <div class="card-header" id="headingTwo">-->
                <!--          <h5 class="mb-0">-->
                <!--            <button-->
                <!--              class="btn btn-link collapsed"-->
                <!--              data-toggle="collapse"-->
                <!--              data-target="#collapseTwo"-->
                <!--              aria-expanded="false"-->
                <!--              aria-controls="collapseTwo"-->
                <!--            >-->
                <!--              What is NOT included in the price of the tour?-->
                <!--            </button>-->
                <!--          </h5>-->
                <!--        </div>-->
                <!--        <div-->
                <!--          id="collapseTwo"-->
                <!--          class="collapse"-->
                <!--          aria-labelledby="headingTwo"-->
                <!--          data-parent="#accordion"-->
                <!--        >-->
                <!--          <div class="card-body">-->
                <!--            Our standard tours do not include the cost of any-->
                <!--            transport FROM the end of the walking tour back to your-->
                <!--            accommodation, or elsewhere. You can however elect to-->
                <!--            pay an additional fee at the time of booking to have-->
                <!--            this included.-->
                <!--          </div>-->
                <!--        </div>-->
                <!--      </div>-->
                <!--      <div class="card">-->
                <!--        <div class="card-header" id="headingThree">-->
                <!--          <h5 class="mb-0">-->
                <!--            <button-->
                <!--              class="btn btn-link collapsed"-->
                <!--              data-toggle="collapse"-->
                <!--              data-target="#collapseThree"-->
                <!--              aria-expanded="false"-->
                <!--              aria-controls="collapseThree"-->
                <!--            >-->
                <!--              Where do the tours start?-->
                <!--            </button>-->
                <!--          </h5>-->
                <!--        </div>-->
                <!--        <div-->
                <!--          id="collapseThree"-->
                <!--          class="collapse"-->
                <!--          aria-labelledby="headingThree"-->
                <!--          data-parent="#accordion"-->
                <!--        >-->
                <!--          <div class="card-body">-->
                <!--            Unless you specifically request otherwise, the tours-->
                <!--            begin with one of our guides (or another representative)-->
                <!--            meeting you in your hotel lobby (or other accommodation-->
                <!--            within the city of Buenos Aires) at the agreed start-->
                <!--            time to accompany you to the start of the walking tour,-->
                <!--            by taxi, other form of private transport, or if nearby,-->
                <!--            on foot. The cost of any transport needed for journey is-->
                <!--            included in the price of the tour.-->
                <!--          </div>-->
                <!--        </div>-->
                <!--      </div>-->
                <!--      <div class="card">-->
                <!--        <div class="card-header" id="headingFour">-->
                <!--          <h5 class="mb-0">-->
                <!--            <button-->
                <!--              class="btn btn-link collapsed"-->
                <!--              data-toggle="collapse"-->
                <!--              data-target="#collapseFour"-->
                <!--              aria-expanded="false"-->
                <!--              aria-controls="collapseFour"-->
                <!--            >-->
                <!--              What happens at the end of the tour?-->
                <!--            </button>-->
                <!--          </h5>-->
                <!--        </div>-->
                <!--        <div-->
                <!--          id="collapseFour"-->
                <!--          class="collapse"-->
                <!--          aria-labelledby="headingFour"-->
                <!--          data-parent="#accordion"-->
                <!--        >-->
                <!--          <div class="card-body">-->
                <!--            At the end of the walking tour, your tour guide can-->
                <!--            either put you in a taxi back to your hotel (or other-->
                <!--            destination), or give you directions/advice on where you-->
                <!--            might want to head next on foot/by subway etc.-->
                <!--          </div>-->
                <!--        </div>-->
                <!--      </div>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->
                <!--<div class="row tourpg">-->
                <!--  <h2>Tour Program</h2>-->
                <!--  <div class="row">-->
                <!-------------Tour Program Description----->
                <!--    <div class="single-timeline">-->
                <!--      <div class="timeline">-->
                <!--        <div class="timeline-content left">-->
                <!--          <span class="timeline-icon">1</span>-->
                <!--          <h4>Step 1</h4>-->
                <!--          <p>-->
                <!--            Enter the underwater tunnels of the Dubai Aquarium. Tour-->
                <!--            all the highlights of this hyper-modern metropolis with-->
                <!--            an old-world twist with a local English-speaking guide.-->
                <!--            Overnight in Dubai.-->
                <!--          </p>-->
                <!--        </div>-->
                <!--      </div>-->
                <!-- single timeline -->
                <!--      <div class="timeline">-->
                <!--        <div class="timeline-content left">-->
                <!--          <span class="timeline-icon">2</span>-->
                <!--          <h4>Step 2</h4>-->
                <!--          <p>-->
                <!--            Watch traditional Arabic entertainment, such as a belly-->
                <!--            dance show and the whirling dancers of a tanoura show.-->
                <!--            Smoke a shisha water pipe (“hooka”) before you are-->
                <!--            served a barbecue buffet dinner of authentic Arabic-->
                <!--            cuisine in the middle of the desert. Return to your-->
                <!--            waiting vehicle for the journey back to Dubai.-->
                <!--          </p>-->
                <!--        </div>-->
                <!--      </div>-->
                <!-- single timeline -->
                <!--      <div class="timeline">-->
                <!--        <div class="timeline-content left">-->
                <!--          <span class="timeline-icon">3</span>-->
                <!--          <h4>Step 3</h4>-->
                <!--          <p>-->
                <!--            Visit Dubai’s most remote desert area known as ‘Lahbab,’-->
                <!--            located approximately 50 kilometres outside the city on-->
                <!--            this 7-hour desert safari. The silky red sand and-->
                <!--            towering dunes lend Lahbab a unique desert landscape-->
                <!--            with picture-perfect views of the desert surrounding.-->
                <!--            This tour is perfect for adventure seekers, families,-->
                <!--            couples and solo travelers looking for a unique tour-->
                <!--            combining fun, adventure, nature and culture.-->
                <!--          </p>-->
                <!--        </div>-->
                <!--      </div>-->
                <!-- single timeline -->
                <!--    </div>-->
                <!-------------Tour pg desc End------------->
                <!--  </div>-->
                <!--</div>-->
            </div>

            <div class="col-md-4 col-sm-12 col-xs-12">
                <h2>Ticket Booking</h2>
                <div class="separator-border"></div>
                <div id="text-1" class="booknow_text">
                    <div class="text-center">
                        <h3>Reserve Now!</h3>
                    </div>
                    <div class="textwidget">
                        <div role="form" class="booking-form" dir="ltr">
                            <div class="screen-reader-response"></div>

                            <form action="{{ route('book_tour') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="tour_id" value="{{ $tour->id }}" />

                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <span class="your-name">
                                        <input type="text" aria-required="true" aria-invalid="false"
                                            placeholder="Your Name *" name="user_name" required class="form-control" />
                                    </span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <span class="your-email">
                                        <input type="email" size="40" class="form-control" aria-required="true"
                                            aria-invalid="false" placeholder="Your Email *" name="user_email" required />
                                    </span>
                                    <i class="fa fa-envelope-open-o"></i>
                                </div>
                                <div class="col-12">
                                    <div class="input-group">
                                        <label class="input-group-text">Country</label>
                                        <select name="country_code" class="form-select">
                                            <option value="+92" selected>Pakistan +92</option>
                                            <option value="+33">France +33</option>
                                            <option value="+49">Germany +49</option>
                                            <option value="+36">Hungary +36</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <span class="your-phone">
                                        <input type="tel"name="user_phone" value=""
                                            size="40"class="form-control" aria-required="true" aria-invalid="false"
                                            placeholder="Phone *" required />
                                    </span>
                                    <i class="fa fa-comment-o" aria-hidden="true"></i>
                                </div>
                                <input type="hidden" name="payment_amount" id="payment_amount" value=""
                                    required />
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <span class="adult-select">
                                            <select name="pickup_point_id" id="pickup_point_id" class="form-control"
                                                aria-required="true" aria-invalid="false" onchange="getCalculation()">
                                                <option value="">Select Pickup Point</option>
                                                @foreach ($pickup_points as $pickup_point)
                                                    <option value="{{ $pickup_point->id }}">
                                                        {{ $pickup_point->pickup_point }} {{ $pickup_point->pickup_city }}
                                                    </option>
                                                @endforeach
                                            </select></span>
                                    </div>
                                </div>
                                <!--{{ $pickup_points }}-->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <span class="adult-select">
                                            <select name="package_type" id="package_type" class="form-control"
                                                aria-required="true" aria-invalid="false" onchange="getCalculation()">
                                                <option value="">Select Package Type</option>
                                                @foreach ($pickup_points as $pickup_point)
                                                    @if ($pickup_point->per_seat_fare != 0000)
                                                        <option value="single">Single Amount
                                                            {{ $pickup_point->per_seat_fare }}</option>
                                                    @else
                                                        <option>Sorry Single package not available now</option>
                                                    @endif

                                                    @if ($pickup_point->couple_package_fare != 0000)
                                                        <option value="couple">Couple Amount
                                                            {{ $pickup_point->couple_package_fare }}</option>
                                                    @else
                                                        <option>Couple package not available now</option>
                                                    @endif

                                                    @if ($pickup_point->family_package_fare != 0000)
                                                        <option value="family">Family Amount
                                                            {{ $pickup_point->family_package_fare }}</option>
                                                    @else
                                                        <option>Family package not available now</option>
                                                    @endif
                                                @endforeach
                                            </select></span>
                                    </div>
                                </div>

                                <div id="person_details" class="row person_details" style="display: none;">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <span class="adult-select">
                                            <select name="adults_in_number" id="adults_in_number" class="form-control"
                                                aria-required="true" aria-invalid="false" onchange="getCalculation()">
                                                <option value="0">Select Adult</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                            </select>
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <span class="kids-select">
                                            <select name="kids_between_3_to_8"
                                                id="kids_between_3_to_8"class="form-control" aria-required="true"
                                                aria-invalid="false"onchange="getCalculation()">
                                                <option value="0">Kids Between 3-8 Years</option>
                                                @foreach ($pickup_points as $pickup_point)
                                                    @if ($pickup_point->kids_between_3_to_8 != null || $pickup_point->kids_between_3_to_8 != '')
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                    @else
                                                        <option>Kids Between 3-8 Years package not available</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <span class="kids-select">
                                            <select name="kids_under_3_years"id="kids_under_3_years" class="form-control"
                                                aria-required="true"aria-invalid="false" onchange="getCalculation()">
                                                <option value="0">Kids Under 3 Years</option>
                                                @foreach ($pickup_points as $pickup_point)
                                                    @if ($pickup_point->kids_under_3_years != null || $pickup_point->kids_under_3_years != '')
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                    @else
                                                        <option>Kids under 3 Years package not available</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <span class="your-message">
                                        <textarea name="user_message" cols="40"rows="5" class="form-control textarea" aria-invalid="false"
                                            placeholder="Your Message"></textarea>
                                    </span>
                                </div>

                                <!--<div class="row form-group">-->
                                <!--<div class="col-md-6 col-sm-6 col-xs-12 form-group">-->
                                <!--  <span class="your-message">-->
                                <!--    <input type="radio" name="payment_method" value="Cash On Pickup" onchange="cash_on_pickup()"/> Cash On Pickup-->
                                <!--  </span>-->
                                <!--</div>-->
                                <!--    <div class="col-md-6 col-sm-6 col-xs-12 form-group">-->
                                <!--      <span class="your-message">-->
                                <!--        <input type="radio" name="payment_method" value="BANK TRANSFER" onchange="bank_transfer()" required/> BANK TRANSFER-->
                                <!--      </span>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div id="bank_details" class="row form-group m-2 bank_details" style="display: none;">-->
                                <!--    <div class="col-md-12 col-sm-12 col-xs-12 form-group border p-2">-->
                                <!--        <div>-->
                                <!--            <h6>INSTRUCTIONS FOR BANK TRANSFER:</h6>-->
                                <!--            <p>Please transfer/deposit the booking amount to the following bank account and upload the deposit receipt to payment.</p>-->

                                <!--            <h6>Account Title:</h6>-->
                                <!--            <p>{{ $admin->account_title }}</p>-->

                                <!--            <h6>Account Number:</h6>-->
                                <!--            <p>{{ $admin->account_number }}</p>-->

                                <!--            <h6>Bank Name:</h6>-->
                                <!--            <p>{{ $admin->bank_name }}</p>-->

                                <!--            <h6>Upload Deposit Receipt:</h6>-->
                                <!--            <input type="file" name="deposit_receipt" value="" required />-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <div class="col-md-12 col-sm-12 col-xs-12 form-group text-center">
                                    <span>Total Amount: </span> <span id="currency">PKR</span> <span id="total_amount">
                                        0.00</span>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 form-group text-center">
                                    @auth
                                        <input type="submit" value="Book Now" class="submit" style="cursor: pointer;" />
                                    @else
                                        <a class="signin" data-toggle="modal" data-target="#loginModal"><button
                                                class="submit" style="cursor: pointer;">Book Now</button></a>
                                    @endauth
                                    <span class="ajax-loader"></span>
                                </div>
                                <div class="display-none"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('script')
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
            // // console.log(formData);
            // for (var value of formData.values()) {
            //   // console.log(value); 
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
@endsection
