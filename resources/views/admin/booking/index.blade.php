@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 text-center">
                <h4 style="margin: 10px;">Bookings</h4>
                @if(session()->has('success'))
                    <div class="alert alert-success text-center">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-warning text-center">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div> 
            <!--<div class="col-md-1">-->
                <!--<a href="#" class = "btn btn-sm btn-primary" style="margin: 10px;">Add New <i class = "fa fa-plus"></i></a>-->
            <!--</div>           -->
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 table-responsive">
                @if($bookings->count() > 0)
                    <table class="table table-sm table-hover" >
                        <thead>
                            <th>Booking ID</th>
                            <th>Tour Name</th>
                            <th>Company Name</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Pickup Point</th>
                            <th>Payment Method</th>
                            <th>Payment Amount</th>
                            <th>payment Status</th>
                            <th>deposit receipt</th>
                            <th>Booking at</th>
                            <th>User Message</th>
                            <th>Status</th>
                            <th>View</th>
                            <!--<th>Edit</th>-->
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr> 
                                    <td>{{$booking->id}}</td>
                                    <td>{{$booking->tour_detail->trip_name}}</td>
                                    <td>{{$booking->agency_details->company_name}}</td>
                                    <td>{{$booking->name}}</td>
                                    <td>{{$booking->email}}</td>
                                    <td>{{$booking->phone}}</td>
                                    <td>{{$booking->pickup_point_id}}</td>
                                    <td>{{$booking->payment_method}}</td>
                                    <td>{{$booking->payment_amount}}</td>
                                    <td>{{$booking->payment_type}}</td>
                                    <td><img src="{{ asset($booking->deposit_receipt) }}" alt="Card image cap" height="50px" width="50px"/></td>
                                    <td>{{$booking->created_at}}</td>
                                    <td>{{$booking->user_message}} </td> 
                                    <td>
                                        <div class="seldive">
                                        <select  class="form-control border p-1 border-dark text-dark" name="update_status" id="update_booking_status" onchange="location =    this.options[this.selectedIndex].value;" style="width: 100px;">
                                            
                                            <option class="p-1" value="{{ route('admin.update_booking_status', ['booking_id'=>$booking->id,'booking_status'=>'pending']) }}" @if($booking->status == 'pending') selected @endif> Pending</option>
                                                                                
                                            <option class="p-1" value="{{ route('admin.update_booking_status', ['booking_id'=>$booking->id,'booking_status'=>'cancelled']) }}" @if($booking->status == 'cancelled') selected @endif>Cancelled</option>
                                                                                
                                            <option class="p-1" value="{{ route('admin.update_booking_status', ['booking_id'=>$booking->id,'booking_status'=>'completed']) }}" @if($booking->status == 'completed') selected @endif>Completed</option>
                                                                                
                                        </select> 
                                        </div>
                                    </td>
                                     <td>
                                        <a href="{{ route ('admin.bookings.show',$booking->id)}}" class = "btn btn-sm btn-info"><i class = "fa fa-eye"></i></a>
                                    </td>
                                    <!--<td>-->
                                    <!--    <a href="#" class = "btn btn-sm btn-warning"><i class = "fa fa-edit"></i></a>-->
                                    <!--</td>-->
                                   
                                    <td>
                                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method = "POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type = "submit" onclick = "return confirm('Are You Sure To Want to Delete?')" name = "submit" class = "btn btn-sm btn-danger"><i class = "fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $bookings->links('pagination::bootstrap-4') }}
                @else
                    <h4 style = "text-align:center">No Bookings Found!</h4>
                @endif   
               
            </div>
        </div>
    </div>
@endsection