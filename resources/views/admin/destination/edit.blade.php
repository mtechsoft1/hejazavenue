@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 style="margin: 10px;">Update Destinations</h4>
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
        </div>
        <br>
        <form action="{{ route('admin.destination.update',$destinations[0]->id ) }}" method="POST" enctype="multipart/form-data" >
        @csrf  
        {{ method_field('PUT') }}

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
               
                    <div class="form-group">
                  
                    <div class="form-group">
                        <label for="">Destination Name</label>
                        <input type="text" name = "destination_name" value = {{ $destinations[0]->destination_name}} class ="form-control" placeholder="Destination Name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Destination Image</label>
                        <input type="file" name="destination_image" value = {{ $destinations[0]->destination_image}} class = "form-control" placeholder="Destination Image" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Is Public</label>
                        <select name="is_public" id="" value = {{ $destinations[0]->is_public}}  class = "form-control" required>
                            <option value="true" name = "true">Yes</option>
                            <option value="false" name = "false">NO</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <input type="submit" name="submit" class="btn btn-sm btn-primary form-control" value="Update">
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    </form>
@endsection