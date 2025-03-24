@extends('layouts.app')
@section('title')
Agency Tour Details
@endsection
@section('content')

      <!---------------Our Best Packages-------------->
     
      <div id="package" class="packages">
        <div class="container">
          <div class="package-div">
            <h3 class="packagetitle">
             @foreach($agencyName as $name)
             
             {{$name->user->company_name}}
             
             @endforeach
            </h3>
          </div>
          <div class="row col-lg-12 col-12 " style="justify-content: space-between;">
             
                    @foreach($tours as $tour)
             <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-4 py-3 card  card-deck" style="padding-left: 0px;padding-right: 0px;padding-top: 0px !important;padding-bottom: 0px !important;">
                <div class="card-img">
                    <a href="{{ route('tour_details', $tour->id) }}">
                        <figure>
                        <img class="card-img-top"src="{{ asset($tour->trip_image) }}"alt="Card image cap"style="height: 300px !important; object-fit: cover !important;"/>
                        
                        <!-- Badge -->
                        <div class="badges" >
                           <img  src="{{ asset($tour->user->profile_image) }}" style="width: 60px;height: 60px;border: 3px solid #009900 !important;margin-top: 10px;margin-left: 10px;" class="border border-2 rounded-circle shadow-4-strong"></img>
                        </div>
                        
                        <!--<figcaption>-->
                        <!--  <span>{{Str::limit($tour->attractions, 25, ' ...') }}</span>-->
                        <!--</figcaption>-->
                        </figure>
                    </a>
                </div> 
                 <div class="card-body">
                    
                        <h3 class="card-title">
                            <i class="fa fa-map-marker" aria-hidden="true" style="margin-left:-18px;color:green"></i>
                            <a href="{{ route('tour_details', $tour->id) }}" style="margin-left: 5px;color:green;text-decoration:none">{{$tour->trip_name}}</a>
                        </h3>
                    
                        <p class="tour-duration">
                            <span class="fa fa-clock-o"></span>
                            <strong>Duration:</strong>{{$tour->trip_duration}}
                        </p>
                        <p class="tour-duration">
                             <span style="color:green" class="fa fa-calendar"></span>
                             <strong>Trip Date:</strong> {{ \Carbon\Carbon::parse($tour->trip_start_date)->format('Y-m-d')}}
                         </p>
                <!--<p class="card-text">-->
                <!--  {{Str::limit($tour->trip_description, 70, ' ...') }}-->
                <!--</p>-->
                </div>
                <div class="card-footer" style="width:100%">
                    <div class=" tour-meta">
                        <div class="tour-rating">
                           <ul class="list-unstyled clearfix">
                                <li>
                                {!! str_repeat('<span><i class="fa fa-star"></i></span>', $tour->rating) !!}
                                {!! str_repeat('<span><i class="fa fa-star-o"></i></span>', 5 - $tour->rating) !!}
                                </li>
                                <li class="review">({{$tour->reviews_count}} Reviews)
                                </li>
                            </ul>
                        </div>
                        <div class="tour-price">
                            <span>
                            @if(isset($tour->pickup_points->per_seat_fare_currency))
                                    {{ $tour->pickup_points->per_seat_fare_currency}} 
                            @else
                                PKR
                            @endif
                            @if(isset($tour->pickup_points->per_seat_fare))
                                {{ $tour->pickup_points->per_seat_fare}} 
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
          <!--<div class="row justify-content-center py-3">-->
          <!--  <a href="{{ route('tours') }}"><button class="submit">Load More</button></a>-->
          <!--</div>-->
        </div>
      </div>

@endsection

