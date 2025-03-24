@extends('layouts.admin.app')
@section('content')

<h4 style="margin: 10px;">Booking List</h4>

<form action="">
<table class="table table-sm table-hover">
                        <thead>
                            <th>ID:</th>
                            <th>{{$bookings->id}}</th>
                        <tbody>

                                <tr> 
                                    <th>Company ID:</th>
                                    <th>{{$bookings->agency_details->id}}</th>
                                </tr>
                                
                                <tr>
                                    <th>Company Name</th>
                                    <th>{{$bookings->agency_details->company_name}}</th>
                                </tr>
                                
                                <tr> 
                                    <th>Tour ID:</th>
                                    <th>{{$bookings->tour_id}}</th>
                                </tr>
                                
                                <tr>
                                    <th>Tour Name</th>
                                    <th>{{$bookings->tour_details->trip_name}}</th>
                                </tr>

                                <tr>
                                   <th>User ID:</th>
                               <th>{{$bookings->user_id}}</th>
                                   </tr>
                                   
                                   <tr>
                                   <th>Name:</th>
                               <th>{{$bookings->name}}</th>
                                   </tr>
                                   <tr>
                                   <th>Email:</th>
                               <th>{{$bookings->email}}</th>
                                   </tr>
                                   <tr>
                                   <th>Phone:</th>
                               <th>{{$bookings->phone}}</th>
                                   </tr>
                                   <tr>
                                   <th>User Message:</th>
                               <th>{{$bookings->user_message}}</th>
                                   </tr>
                                   <tr>
                                   <th>Pickup Point ID:</th>
                               <th>{{$bookings->pickup_point_id}}</th>
                                   </tr>
                                   
                                   <tr>
                                    <th>Pickup Point:</th>
                               <th>{{$bookings->pickup_point->pickup_city}}</th>
                                   </tr>
                                   
                                   <th>Package Type:</th>
                               <th>{{$bookings->package_type}}</th>
                                   </tr>
                                   <tr>
                                   <th>Number Of Adults:</th>
                               <th>{{$bookings->adults_in_number}}</th>
                                   </tr>
                                   <tr>
                                   <th>Kids Under 3 Years:</th>
                               <th>{{$bookings->kids_under_3_years}}</th>
                                   </tr>
                                   <tr>
                                   <th>Kids Between 3 to 8:</th>
                               <th>{{$bookings->kids_between_3_to_8}}</th>
                                   </tr>
                                   <tr>
                                    <th>Payment Method:</th>
                               <th>{{$bookings->payment_type}}</th>
                                   </tr>
                                   <tr>
                                    <th>Payment Amount:</th>
                               <th>{{$bookings->payment_amount}}</th>
                                    </tr>
                                    <tr>
                                    <th>Deposite Receipt:</th>
                                <th><img src="{{ asset($bookings->deposit_receipt) }}" alt="image" width="60" height="40"></th>
                                    </tr>
                                    <tr>
                                    <th>Payment Type:</th>
                               <th>{{$bookings->payment_type}}</th>
                                    </tr>
                                     <tr>
                                    <th>Status:</th>
                               <th>{{$bookings->status}}</th>
                                   </tr>
                         

                       

                       
                        </tbody>

                       </thead>

                    </table>
</form>



@endsection