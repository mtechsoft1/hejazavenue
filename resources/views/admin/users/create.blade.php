@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4>Add New Locations</h4>
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
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="{{ route('admin.locations.store') }}" method = "POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Camera Type</label>
                        <select name="camera_type" id="" class = "form-control">
                            <option value="fixed">Fixed</option>
                            <option value="movable">Movable</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" name = "latitude" class = "form-control" placeholder="Latitude" required>
                    </div>
                    <div class="form-group">
                        <label for="">Longitude</label>
                        <input type="text" name = "longitude" class = "form-control" placeholder="Longitude" required>
                    </div>
                    <div class="form-group">
                        <label for="">Speed Limit</label>
                        <input type="number" name = "speed_limit" class = "form-control" placeholder="Speed Limit" required>
                    </div>
                    <div class="form-group">
                        <label for="">Speed Limit Unit</label>
                        <select name="speed_limit_unit" id="" class = "form-control" required>
                            <option value="Km/h">Km/h</option>
                            <option value="mph">Mph</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <input type="submit" name = "submit" class = "btn btn-sm btn-primary form-control" value = "Add">
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
@endsection