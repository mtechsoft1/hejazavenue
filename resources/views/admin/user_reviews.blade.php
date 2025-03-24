@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 text-center">
                <h4 style="margin: 10px;">User Reviews</h4>
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
                @if($reviews->count() > 0)
                    <table class="table table-sm table-hover" >
                        <thead>
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>User Name</th>
                            <th>Rating</th>
                            <th style="width: 50%;">Review</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                            <tr> 
                                    <td>{{$review->id}}</td>
                                    <td>{{$review->agency_details->company_name}}</td>
                                    <td>{{$review->user_details->name}}</td>
                                    <td>
                                        {!! str_repeat('<span style="color: #28a745;"><i class="fa fa-star"></i></span>', $review->rating_stars) !!}
                                        {!! str_repeat('<span><i class="fa fa-star-o"></i></span>', 5 - $review->rating_stars) !!}
                                    </td>
                                    <td style="width: 50%;">{{$review->review}}</td>
                                    <td>
                                        <a href="{{ route('admin.delete_review', $review->id) }}">
                                        <button type = "submit" onclick = "return confirm('Are You Sure To Want to Delete?')" name = "submit" class = "btn btn-sm btn-danger"><i class = "fa fa-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $reviews->links('pagination::bootstrap-4') }}
                @else
                    <h4 style = "text-align:center">No Reviews Found!</h4>
                @endif   
               
            </div>
        </div>
    </div>
@endsection