@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 text-center">
                <h4>View Movable Location</h4>
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
            <div class="col-md-1">
                <a href="{{ route('admin.locations.create') }}" class = "btn btn-sm btn-primary">Add New <i class = "fa fa-plus"></i></a>
            </div>           
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                @if($locations->count() > 0)
                    <table class="table table-sm table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Camera Type</th>
                            <th>Speed Limit</th>
                            <th>Latitude</th>
                            <th>Longitude</th>                           
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach($locations as $location)
                                <tr>
                                    <td>{{ $location->id }}</td>
                                    <td>{{ ucfirst($location->camera_type)}}</td>
                                    <td>{{ $location->speed_limit}} {{ $location->speed_limit_unit}}</td>                                    
                                    <td>{{ $location->latitude }}</td>  
                                    <td>{{ $location->longitude }}</td>  
                                     <td>
                                        <a href="{{ route('admin.locations.edit', $location->id) }}" class = "btn btn-sm btn-warning"><i class = "fa fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.locations.destroy', $location->id) }}" method = "POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type = "submit" onclick = "return confirm('Are You Sure To Want to Delete?')" name = "submit" class = "btn btn-sm btn-danger"><i class = "fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $locations->links() }}
                @else
                    <h4 style = "text-align:center">No User Found!</h4>
                @endif
            </div>
        </div>
    </div>
@endsection