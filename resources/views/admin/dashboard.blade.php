@extends('layouts.admin.app')
@section('content')
    
         
         <style>
             .admin-heading{
                 margin-top:50px;
                 margin-bottom:30px;
                 font-size:44px;
                 font-weight:700;
                 text-align:center;
             }
             @media screen and (max-width : 768px){
            .admin-heading{
                 font-size:32px;
             }
             }
         </style>
                       

         <div class="row">
            <div class="col-md-12"> 
            <h5 class="admin-heading">Admin Panel</h5>           
                <div class="row">
                    <div class="col-md-3">
                        <div class="card-counter info">
                            <i class="fa fa-users" style = "font-size: 36px;"></i>
                            <span class="count-numbers" style = "font-size: 24px;">{{ $countuser}}</span>
                            <span class="count-name" >Total User</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-counter primary">
                            <i class="fa fa-users" style = "font-size: 36px;"></i>
                            <span class="count-numbers" style = "font-size: 24px;">{{$countprovider}}</span>
                            <span class="count-name">Total Provider</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-counter danger">
                            <i class="fa fa-list" style = "font-size: 36px;"></i>
                            <span class="count-numbers" style = "font-size: 24px;">{{$count}}</span>
                            <span class="count-name">Destinations</span>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card-counter danger">
                            <i class="fa fa-list" style = "font-size: 36px;"></i>
                            <span class="count-numbers" style = "font-size: 24px;">{{$counttour}}</span>
                            <span class="count-name">Tours</span>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card-counter danger">
                            <i class="	fas fa-pen" style = "font-size: 36px;"></i>
                            <span class="count-numbers" style = "font-size: 24px;">{{$countbookings}}</span>
                            <span class="count-name">Total Bookings</span>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card-counter danger">
                            <i class="	fas fa-pen" style = "font-size: 36px;"></i>
                            <span class="count-numbers" style = "font-size: 24px;">{{$countreviews}}</span>
                            <span class="count-name">Total Reviews</span>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card-counter danger">
                            <i class="	fas fa-pen" style = "font-size: 36px;"></i>
                            <span class="count-numbers" style = "font-size: 24px;">{{$countmessages}}</span>
                            <span class="count-name">Total Messages</span>
                        </div>
                    </div>
                    
                   

</div>



@endsection