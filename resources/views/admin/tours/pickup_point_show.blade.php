@extends('layouts.admin.app')
@section('content')
<h4 style="margin: 10px;">Tours List</h4>
<form action="">
   <table class="table table-sm table-hover" >
      <thead>
         <th>Pickup City:</th>
         <th>{{ $picking_point->pickup_city}}</th>
      <tbody>
         <tr>
            <th style = "width: 500px;">Per Seat Price:</th>
            <th style = "width: 500px;">{{ $picking_point->per_seat_fare}}</th>
         </tr>
         <tr>
            <th>Per Seat Price Currency:</th>
            <th>{{ $picking_point->per_seat_fare_currency}}</th>
         </tr>
         <tr>
            <th>Couple Package Price:</th>
            <th>{{ $picking_point->couple_package_fare}}</th>
         </tr>
         <tr>
            <th>Couple Package Price Currency:</th>
            <th>{{ $picking_point->couple_package_fare_currency}}</th>
         </tr>
         <tr>
            <th>Family Package Price:</th>
            <th>{{ $picking_point->family_package_fare}}</th>
         </tr>
         <tr>
            <th>Family Package Price Currency :</th>
            <th>{{ $picking_point->family_package_fare_currency}}</th>
         </tr>
         <tr>
            <th>Kids Under 3 Years:</th>
            <th>{{ $picking_point->kids_under_3_years }}</th>
         </tr>
         <tr>
            <th>3 To 8 Years Kids:</th>
            <th>{{$picking_point->kids_between_3_to_8}}</th>
         </tr>
         <th>Kids Above 8 Years:</th>
         <th>{{$picking_point->kids_above_8_years}}</th>
         </tr>
         <tr>
            <th>Pickup Point:</th>
            <th>{{$picking_point->pickup_point}}</th>
         </tr>
         <tr>
            <th>Pickup Point Latitude:</th>
            <th>{{$picking_point->pickup_point_latitude}}</th>
         </tr>
         <th>Pickup Point Longitude:</th>
         <th>{{$picking_point->pickup_point_longitude}}</th>
         </tr>
         <tr>
            <th>Pickup Date:</th>
            <th>{{$picking_point->pickup_date}}</th>
         </tr>
         <th>Pickup Time:</th>
         <th>{{$picking_point->pickup_time}}</th>
         </tr>
      </tbody>
      </thead>
   </table>
</form>
@endsection