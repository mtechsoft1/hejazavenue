@extends('layouts.admin.app')
@section('content')

<h4 style="margin: 10px;">Destination list</h4>

<form action="">
<table class="table table-sm table-hover">
                        <thead>
                            <th>Distination Name:</th>
                            <th>{{$destinations->destination_name}}</th>
                        <tbody>

                                <tr> 
                                <th>Distination Image:</th>
                            <th><img src="{{ asset($destinations->destination_image) }}" alt="image" width="60" height="40"> </th>
                                </tr>

                                <tr>
                                   <th>Created At:</th>
                               <th>{{$destinations->created_at}}</th>
                                   </tr>
                                   <tr>
                                   <th>Updated At:</th>
                               <th>{{  $destinations->updated_at}}</th>
                                   </tr>
                                   <tr>
                                   <th>Is Public:</th>
                               <th>{{$destinations->is_public}}</th>
                                   </tr>



@endsection