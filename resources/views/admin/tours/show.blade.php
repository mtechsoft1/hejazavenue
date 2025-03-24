

@extends('layouts.admin.app')
@section('content')

<h4 style="margin: 10px;">Tours List</h4>

<form action="">
<table class="table table-sm table-hover">
                        <thead>
                            <th>Trip Name:</th>
                            <th>{{$tours->trip_name}}</th>
                        <tbody>

                                <tr> 
                                <th>Trip Image:</th>
                            <th><img src="{{ asset($tours->trip_image) }}" alt="image" width="60" height="40"></th>
                                </tr>

                                <tr>
                                   <th>Trip destination:</th>
                               <th>{{$tours->trip_destination}}</th>
                                   </tr>
                                   <tr>
                                   <th>Trip Start Date:</th>
                               <th>{{  $tours->trip_start_date}}</th>
                                   </tr>
                                   <tr>
                                   <th>Trip End Date:</th>
                               <th>{{$tours->trip_end_date}}</th>
                                   </tr>
                                   <tr>
                                   <th>Total days Of Trip:</th>
                               <th>{{$tours->trip_total_days }}</th>
                                   </tr>
                                   <tr>
                                   <th>Under 3 yeras Kids:</th>
                               <th>{{ $tours->kids_under_3_years}}</th>
                                   </tr>
                                   <tr>
                                   <th>3 To 8 Years Kids:</th>
                               <th>{{  $tours->kids_between_3to_8_years}}</th>
                                   </tr>
                                   <th>Kids Above 8 years:</th>
                               <th>{{  $tours->kids_above_8_years}}</th>
                                   </tr>
                                   <tr>
                                   <th>Attractions of Trip:</th>
                               <th>{{ $tours->attractions}}</th>
                                   </tr>
                                   <tr>
                                   <th>Durations oF Trip:</th>
                               <th>{{ $tours->trip_duration}}</th>
                                   </tr>
                                   <th>Status Of The Trip:</th>
                               <th>{{$tours->status}}</th>
                                   </tr>
                         

                       

                       
                        </tbody>

                       </thead>

                    </table>
</form>



@endsection

