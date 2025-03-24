
@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 text-center">
                <h4 style="margin: 10px;">Tours</h4>
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
                @if($tours->count() > 0)
                    <table class="table table-sm table-hover">
                        <thead>
                            <th>Company Name</th>
                            <th>Provider Name</th>
                            <th>Trip Name</th>
                            <th>Trip Image</th>
                            <th>Trip start from</th>                           
                            <th>Trip End date</th>
                            <th>Attractions</th>
                            <th>View</th>
                            <th>Pickup Point</th> 
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach($tours as $tour)
                                <tr>
                                    <td>{{ $tour->user->company_name}}</td>
                                    <td>{{$tour->user->name}} </td> 
                                    <td>{{ $tour->trip_name}}</td>
                                    <td><img src="{{ asset($tour->trip_image) }}" alt="image" width="60" height="40"></td>                                     
                                    <td>{{$tour->trip_start_date}}</td>  
                                    <td>{{$tour->trip_end_date}}</td>  
                                    <td>{{$tour->attractions}}</td>  
                                     <td>
                                        <a href="{{ route('admin.tours.show', $tour->id) }}" class = "btn btn-sm btn-info"><i class = "fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.pickuppoint', $tour->id) }}" class = "btn btn-sm btn-info"><i class = "fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.tours.destroy', $tour->id) }}" method = "POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type = "submit" onclick = "return confirm('Are You Sure To Want to Delete?')" name = "submit" class = "btn btn-sm btn-danger"><i class = "fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $tours->links() }}
                @else
                    <h4 style = "text-align:center">No User Found!</h4>
                @endif
            </div>
        </div>
    </div>
@endsection