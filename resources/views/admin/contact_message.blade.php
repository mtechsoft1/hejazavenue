@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 text-center">
                <h4 style="margin: 10px;">Contact Us Messages</h4>
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
            <!--    <a href="#" class = "btn btn-sm btn-primary" style="margin: 10px;">Add New <i class = "fa fa-plus"></i></a>-->
            <!--</div>           -->
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 table-responsive">
                @if($messages->count() > 0)
                    <table class="table table-sm table-hover" >
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>subject</th>
                            <th>message</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach($messages as $message)
                            <tr> 
                                    <td>{{$message->id}}</td>
                                    <td>{{$message->name}}</td>
                                    <td>{{$message->email}}</td>
                                    <td>{{$message->subject}}</td>
                                    <td>{{$message->message}}</td>
                                    <td>
                                        <a href="{{ route('admin.delete_contact_us_message', $message->id) }}">
                                        <button type = "submit" onclick = "return confirm('Are You Sure To Want to Delete?')" name = "submit" class = "btn btn-sm btn-danger"><i class = "fa fa-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $messages->links('pagination::bootstrap-4') }}
                @else
                    <h4 style = "text-align:center">No Messages Found!</h4>
                @endif   
               
            </div>
        </div>
    </div>
@endsection