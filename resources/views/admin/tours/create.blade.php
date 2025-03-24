<!-- @extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 style="margin: 10px;" >Add New Tour</h4>
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
                <form action="{{ route('admin.tours.store') }}" method = "POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Trip Name</label>
                        <input type="text" name = "trip_name" class = "form-control" placeholder="Trip Name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Trip Image</label>
                        <input type="file" name = "trip_image" class = "form-control" placeholder="Trip Image" required>
                    </div>
                    <div class="form-group">
                        <label for="">Trip destination</label>
                        <input type="text" name = "trip_description" class = "form-control" placeholder="Trip destination" required>
                    </div>
                    <div class="form-group">
                        <label for="">Trip Start Date</label>
                        <input type="date" name = "trip_start_date" class = "form-control" placeholder="Trip Start Date" required>
                    </div>
                    <div class="form-group">
                        <label for="">Trip End Date</label>
                        <input type="date" name = "trip_end_date" class = "form-control" placeholder="Trip End Date" required>
                    </div>
                    <div class="form-group">
                        <label for="">Total days Of Trip</label>
                        <input type="number" name = "trip_total_days" class = "form-control" placeholder="Total days Of Trip" required>
                    </div>
                    <div class="form-group">
                        <label for="">Number of Under 3 yeras Kids</label>
                        <input type="number" name = "kids_under_3_years" class = "form-control" placeholder="Number of Under 3 yeras Kids" required>
                    </div>
                    <div class="form-group">
                        <label for="">Number of 3 To 8 Years Kids</label>
                        <input type="number" name = "kids_between_3_to_8_years" class = "form-control" placeholder="Number of 3 To 8 Years Kids" required>
                    </div>
                    <div class="form-group">
                        <label for="">Number Of Kids Above 8 years</label>
                        <input type="number" name = "kids_above_8_years" class = "form-control" placeholder="Number Of Kids Above 8 years" required>
                    </div>
                    <div class="form-group">
                        <label for="">Attractions of Trip</label>
                        <input type="text" name = "attractions" class = "form-control" placeholder="Attractions of Trip" required>
                    </div>
                    <div class="form-group">
                        <label for="">Durations oF Trip</label>
                        <input type="text" name = "trip_duration" class = "form-control" placeholder="Durations oF Trip" required>
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

@endsection -->