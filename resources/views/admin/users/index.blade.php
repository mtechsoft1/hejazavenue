@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 text-center">
                <h4 style="margin: 10px;">View users</h4>
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
                <a href="{{ route('admin.users.create') }}" class = "btn btn-sm btn-primary">Add New <i class = "fa fa-plus"></i></a>
            </div>            -->
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                @if($users->count() > 0)
                    <table class="table table-sm table-hover">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>phone</th> 
                            <th>Profile  Picture</th>                          
                            <th>View</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->email}}</td>  
                                    <td>{{ $user->phone}}</td>  
                                    <td> <img src="{{ asset($user->profile_image) }}" alt="image" width="60" height="40"></td> 
                                     <td>
                                        <a href="{{ route('admin.users.show', $user->id) }}" class = "btn btn-sm btn-info"><i class = "fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method = "POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type = "submit" onclick = "return confirm('Are You Sure To Want to Delete?')" name = "submit" class = "btn btn-sm btn-danger"><i class = "fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                @else
                    <h4 style = "text-align:center">No User Found!</h4>
                @endif
            </div>
        </div>
    </div>
@endsection