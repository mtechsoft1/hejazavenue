@extends('agency.layouts.app')
@section('title')
Tour Bookings
@endsection
@section('content')


            <div class="row">
                <div class="col-md-11 text-center">
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
            </div>
            
            
            <!--<div><h5>Search Booking:</h5>-->
            <!--    <form action="{{ route('agency.update_profile') }}" method="post" enctype="multipart/form-data">-->
            <!--        @csrf-->
            <!--        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />-->
            <!--          <div class="row">-->
            <!--          <div class="form-group col-md-3 col-sm-6">-->
            <!--            <label for="cname">Booking Id</label>-->
            <!--            <input-->
            <!--              type="text"-->
            <!--              class="form-control"-->
            <!--              id="name"-->
            <!--              name="name"-->
            <!--            />-->
            <!--          </div>-->
            <!--          <div class="form-group col-md-3 col-sm-6">-->
            <!--            <label for="cname">Tour Name</label>-->
            <!--            <input-->
            <!--              type="text"-->
            <!--              class="form-control"-->
            <!--              id="company_name"-->
            <!--              name="company_name"-->
            <!--            />-->
            <!--          </div>-->
            <!--          <div class="form-group col-md-3 col-sm-6">-->
            <!--            <label for="cname">Customer Name</label>-->
            <!--            <input-->
            <!--              type="text"-->
            <!--              class="form-control"-->
            <!--              id="company_name"-->
            <!--              name="company_name"-->
            <!--            />-->
            <!--          </div>-->
            <!--          <div class="form-group col-md-3 col-sm-6">-->
            <!--                <label class="w-100" for="cname"> </label>-->
            <!--                <input type="submit" value="Search" class="btn btn-info" />-->
            <!--          </div>-->
            <!--        </div>-->
                    
            <!--    </form>-->
            <!--</div><hr>-->
                
<div class="overflow-x-auto my-10">
    @if($bookings->count() > 0)
        <table class="bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-3 py-2 border whitespace-nowrap">Booking ID</th>
                    <th class="px-3 py-2 border whitespace-nowrap">Tour</th>
                    <th class="px-3 py-2 border whitespace-nowrap">Customer Name</th>
                    <th class="px-3 py-2 border whitespace-nowrap">Phone</th>
                    <th class="px-3 py-2 border whitespace-nowrap">Pickup Point</th>
                    <th class="px-3 py-2 border whitespace-nowrap">Package</th>
                    <th class="px-3 py-2 border whitespace-nowrap">Amount</th>
                    <th class="px-3 py-2 border whitespace-nowrap">Payment Status</th>
                    <th class="px-3 py-2 border whitespace-nowrap">Deposit Receipt</th>
                    <th class="px-3 py-2 border whitespace-nowrap">Booking At</th>
                    <th class="px-3 py-2 border whitespace-nowrap">Status</th>
                    <th class="px-3 py-2 border whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 border whitespace-nowrap">{{ $booking->id }}</td>
                        <td class="px-3 py-2 border whitespace-nowrap">{{ $booking->tour_detail->trip_name }}</td>
                        <td class="px-3 py-2 border whitespace-nowrap">{{ $booking->user_name }}</td>
                        <td class="px-3 py-2 border whitespace-nowrap">{{ $booking->user_phone }}</td>
                        <td class="px-3 py-2 border whitespace-nowrap">{{ $booking->pickup_point->pickup_point ?? "" }}</td>
                        <td class="px-3 py-2 border whitespace-nowrap">{{ $booking->package_type }}</td>
                        <td class="px-3 py-2 border whitespace-nowrap">{{ $booking->payment_amount }}</td>
                        <td class="px-3 py-2 border whitespace-nowrap">{{ $booking->payment_type }}</td>
                        <td class="px-3 py-2 border whitespace-nowrap">
                            <img src="{{ asset($booking->deposit_receipt) }}" alt="Receipt" class="h-12 w-12 object-cover rounded" />
                        </td>
                        <td class="px-3 py-2 border whitespace-nowrap">{{ $booking->created_at }}</td>
                        <td class="px-3 py-2 border whitespace-nowrap">{{ $booking->status }}</td>
                        <td class="px-3 py-2 border whitespace-nowrap flex space-x-2">
                            <a href="#" class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('agency.delete_booking', $booking->id) }}" 
                               onclick="return confirm('Are You Sure To Want to Delete?')" 
                               class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">
                               <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $bookings->links('pagination::tailwind') }}
        </div>
    @else
        <h4 class="text-center text-gray-700 text-lg">No Bookings Found!</h4>
    @endif
</div>

              
   
@endsection

@section('script')

@endsection