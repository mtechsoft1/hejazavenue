
@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 text-center">
                <h4 style="margin: 10px;">Pickup Points</h4>
                @if(session()->has('message'))
                    <div class="alert alert-success text-center">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-warning text-center">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div> 
            <!-- <div class="col-md-1">
                <a href="{{ route('admin.tours.create') }}" class = "btn btn-sm btn-primary">Add New <i class = "fa fa-plus"></i></a>
            </div>            -->
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                @if($picking_point->count() > 0)
                    <table class="table table-sm table-hover">
                        <thead>
                           
                            <th>Pickup City</th>
                            <th>Per Seat Price</th>
                            <th>For Couple Price</th>
                            <th>For Family Price</th>
                            <th>Pickup Date</th>
                            <th>Pickup Time</th>
                            <th>View</th>
                            <th>Delete</th>
                           
                        </thead>
                        <tbody>
                            @foreach($picking_point as $tour)
                           
                                <tr>
                                    
                                    <td>{{ $tour->pickup_city}}</td>
                                    <td>{{$tour->per_seat_fare}} </td> 
                                    <td>{{ $tour->couple_package_fare}}</td>
                                    <td>{{$tour->family_package_fare}} </td>
                                    <td>{{ $tour->pickup_date}}</td>
                                    <td>{{$tour->pickup_time}} </td>                                       
                                  
                                     <td>
                                        <a href="{{ route('admin.pickup_point_show', $tour->id) }}" class = "btn btn-sm btn-info"><i class = "fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                    <form action="{{ route('admin.pickupdelete', $tour->id) }}" method = "POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type = "submit" onclick = "return confirm('Are You Sure To Want to Delete?')" name = "submit" class = "btn btn-sm btn-danger"><i class = "fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                
                                
                            @endforeach
                        </tbody>
                    </table>
                    
                @else
                    <h4 style = "text-align:center">No User Found!</h4>
                @endif
            </div>
        </div>
    </div>
@endsection