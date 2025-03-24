@extends('layouts.admin.app')
@section('content')

<h4 style="margin: 10px;">list of User</h4>

<!-- <ul class="list-group">
  <li class="list-group-item" style="font-weight: bold;">Name: &nbsp;&nbsp;&nbsp;{{ $user->name}}</li>
  <li class="list-group-item"style="font-weight: bold;">email:&nbsp;&nbsp;&nbsp;{{ $user->email}}</li>
  <li class="list-group-item"style="font-weight: bold;">phone:&nbsp;&nbsp;&nbsp;{{ $user->phone}}</li>
  <li class="list-group-item"style="font-weight: bold;">company name:&nbsp;&nbsp;&nbsp;{{ $user->company_name}}</li>
  <li class="list-group-item"style="font-weight: bold;">Address:&nbsp;&nbsp;&nbsp;{{ $user->address}}</li>
  <li class="list-group-item"style="font-weight: bold;">Profile Image:&nbsp;&nbsp;&nbsp;<img src="{{ asset($user->profile_image) }}" alt="image" width="60" height="40"></li>
  <li class="list-group-item"style="font-weight: bold;">Facebook Id:&nbsp;&nbsp;&nbsp;{{ $user->facebook_id}}</li>
  <li class="list-group-item"style="font-weight: bold;">Apple Id:&nbsp;&nbsp;&nbsp;{{ $user->apple_id}}</li>
  <li class="list-group-item"style="font-weight: bold;">Google Id:&nbsp;&nbsp;&nbsp;{{ $user->google_id}}</li>
  <li class="list-group-item"style="font-weight: bold;">Bank Name:&nbsp;&nbsp;&nbsp;{{ $user->bank_name}}</li>
  <li class="list-group-item"style="font-weight: bold;">Account Number:&nbsp;&nbsp;&nbsp;{{ $user->account_number}}</li>
  <li class="list-group-item"style="font-weight: bold;">License Number:&nbsp;&nbsp;&nbsp;{{ $user->license_number}}</li>
  <li class="list-group-item"style="font-weight: bold;">Account Title:&nbsp;&nbsp;&nbsp;{{ $user->accounnt_title}}</li>
  <li class="list-group-item"style="font-weight: bold;">Company Description:&nbsp;&nbsp;&nbsp;{{ $user->company_description}}</li>
  <li class="list-group-item"style="font-weight: bold;">Account Created Date:&nbsp;&nbsp;&nbsp;{{ $user->created_at}}</li>
  <li class="list-group-item"style="font-weight: bold;">Account Update  Date:&nbsp;&nbsp;&nbsp;{{ $user->updated_at}}</li>
</ul> -->




<form action="">
<table class="table table-sm table-hover">
                        <thead>
                            <th>Name</th>
                            <th>{{ $user->name}}</th>
                        <tbody>

                                <tr> 
                                <th>Email</th>
                            <th>{{  $user->email}}</th>
                                </tr>

                                <tr>
                                   <th>Phone Number</th>
                               <th>{{  $user->phone}}</th>
                                   </tr>
                                   <tr>
                                   <th>Company Name</th>
                               <th>{{  $user->company_name}}</th>
                                   </tr>
                                   <tr>
                                   <th>Address</th>
                               <th>{{ $user->address}}</th>
                                   </tr>
                                   <tr>
                                   <th>Profile Photo</th>
                               <th><img src="{{ asset($user->profile_image) }}" alt="image" width="60" height="40"></th>
                                   </tr>
                                   <tr>
                                   <th>Facebook Id</th>
                               <th>{{  $user->facebook_id}}</th>
                                   </tr>
                                   <tr>
                                   <th>Google Id</th>
                               <th>{{  $user->google_id}}</th>
                                   </tr>
                                   <th>Apple Id</th>
                               <th>{{  $user->apple_id}}</th>
                                   </tr>
                                   <tr>
                                   <th>Bank Name</th>
                               <th>{{ $user->bank_name}}</th>
                                   </tr>
                                   <tr>
                                   <th>Account Number</th>
                               <th>{{ $user->account_number}}</th>
                                   </tr>
                                   <th>User License Number</th>
                               <th>{{ $user->license_number}}</th>
                                   </tr>
                                   <tr>
                                   <th>Account tiltle</th>
                               <th>{{ $user->account_title}}</th>
                                   </tr>
                                   <th>Company Description</th>
                               <th>{{ $user->company_description}}</th>
                                   </tr>
                                   <th>User Created Date</th>
                               <th>{{  $user->created_at}}</th>
                                   </tr>
                                   <tr>
                                   <th>User Updated date</th>
                               <th>{{ $user->updated_at}}</th>
                                   </tr>
                        

                       

                       
                        </tbody>

                       </thead>

                    </table>
                    @endsection