
@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 text-center">
                <h4 style="margin: 10px;">Destination</h4>
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
                <a href="{{ route('admin.destination.create') }}" class = "btn btn-sm btn-primary" style="margin: 10px;">Add New <i class = "fa fa-plus"></i></a>
            </div>           
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                @if($destinations->count() > 0)
                    <table class="table table-sm table-hover">
                        <thead>
                            <th>Destination Name</th>
                            <th>Destination Image</th>
                                         
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            
                            @foreach($destinations as $destination)
                               
                            <tr> 
                                    <td>{{ $destination->destination_name}}</td>
                                    <td><img src="{{ asset($destination->destination_image) }}" alt="image" width="60" height="40"> </td>                                    
                                     <td>
                                        <a href="{{ route('admin.destination.show', $destination->id) }}" class = "btn btn-sm btn-info"><i class = "fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.destination.edit', $destination->id) }}" class = "btn btn-sm btn-warning"><i class = "fa fa-edit"></i></a>
                                    </td>
                                   
                                    <td>
                                        <form action="{{ route('admin.destination.destroy', $destination->id) }}" method = "POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type = "submit" onclick = "return confirm('Are You Sure To Want to Delete?')" name = "submit" class = "btn btn-sm btn-danger"><i class = "fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    {{ $destinations->links() }}
                @else
                    <h4 style = "text-align:center">No User Found!</h4>
                @endif
            </div>
        </div>
    </div>
@endsection