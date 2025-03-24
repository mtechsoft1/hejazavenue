@extends('agency.layouts.app')
@section('title')
Edit Tour
@endsection
@section('content')
<style>
/** {*/
/*  box-sizing: border-box;*/
/*}*/

/*body {*/
/*  background-color: #f1f1f1;*/
/*}*/

#regForm {
  background-color: #f1f1f1;
  /*margin: 100px auto;*/
  /*font-family: Raleway;*/
  padding: 40px;
  /*width: 70%;*/
  /*min-width: 300px;*/
}

h1 {
  text-align: center;  
}

/*input {*/
/*  padding: 10px;*/
/*  width: 100%;*/
/*  font-size: 17px;*/
/*  font-family: Raleway;*/
/*  border: 1px solid #aaaaaa;*/
/*}*/

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

.button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  /*font-family: Raleway;*/
  cursor: pointer;
}

.button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>
    
            <div class="row">
                <div class="col-md-11 text-center">
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
            </div>
            
            
            <form id="regForm" action="{{ route('agency.update_tour') }}"  method="POST" enctype="multipart/form-data">
                @csrf 
                
              <input type="hidden" name="agency_id" value="{{ Auth::user()->id }}" />
              <input type="hidden" name="tour_id" value="{{ $tour->id}}" />
              <!--<h1>Create Tour</h1>-->
              <!-- One "tab" for each step in the form: -->
              <div><h1>Update Tour Details</h1>
                <div class="row">
                  <div class="form-group col-md-6 col-sm-12">
                    <label for="ttitle">Tour Title</label>
                    <input
                      type="text"
                      class="form-control"
                      id="ttitle"
                      name="trip_name"
                      value="{{ $tour->trip_name}}"
                      required
                    />
                  </div>
                  <div class="form-group col-md-6 col-sm-12">
                   <div class="form-group">
                     <label >Choose Destinations</label>
                        <div class="input-group">
                        
                          <select
                            class="form-control"
                            name="destination_id"
                            id="dest"
                            >
                          @foreach($destinations as $destination)
                            
                              <option @if($tour->destination_id ==  $destination->id) selected @endif value ="{{ $destination->id }}">{{ $destination->destination_name }}</option>
                            
                          @endforeach
                                                    
                        </select>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                      <div class="form-group">
                        <label >Every Week</label>
                        <div class="input-group">
                            <select class="form-control" name="day" id="day">
                                <option value="" selected>{{ $tour->day}}</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="sdate">Start Date</label>
                        <input
                          type="text"
                          class="form-control"
                          id="sdate"
                          name="trip_start_date"
                          value="{{ $tour->trip_start_date}}"
                          required
                        />
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                      <label for="edate">End Date</label>
                      <input
                        type="text"
                        class="form-control"
                        id="edate"
                        name="trip_end_date"
                        value="{{ $tour->trip_end_date}}"
                        required
                      />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                      <label for="edate">total Days</label>
                      <input
                        type="number"
                        class="form-control"
                        id="edate"
                        name="trip_total_days"
                        value="{{ $tour->trip_total_days}}"
                        required
                      />
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                      <label for="cpolicy">Tour Duration</label>
                      <input
                        type="text"
                        class="form-control"
                        id="cpolicy"
                        name="trip_duration"
                        value="{{ $tour->trip_duration}}"
                        required
                      />
                    </div>
                  </div>
                <div class="row">
                  <div class="form-group col-md-12 col-sm-12">
                    <label for="tdesc">Tour Attractions</label>
                    <textarea
                      class="form-control"
                      rows="3"
                      id="attraction"
                      name="attractions"
                    >{{ $tour->attractions}}</textarea>
                  </div>
                </div>  
                <div class="row">
                  <div class="form-group col-md-12 col-sm-12">
                    <label for="tdesc">Tour Description</label>
                    <textarea
                      class="form-control"
                      id="tdesc"
                      rows="3"
                      name="trip_description"
                    >{{ $tour->trip_description}}</textarea>
                  </div>
                </div>
              </div>
              
              <div>
                
                <div class="row"><h5>Departure Cities</h5>
                    @if($pickup_points->count() > 0)
                    <table class="table table-sm table-hover">
                        <thead>
                             <th>City Name</th>
                             <th>Per Person</th>
                             <th>Couple Package</th>
                             <th>Family Package</th>
                             <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($pickup_points as $pickup_point)
                                <tr>
                                    <td>{{$pickup_point->pickup_city}}</td>
                                    <td>{{$pickup_point->per_seat_fare}}</td>
                                    <td>{{$pickup_point->couple_package_fare}}</td>
                                    <td>{{$pickup_point->family_package_fare}}</td>
                                    <td>
                                        <a href="{{ route('agency.edit_pickup_point', $pickup_point->id) }}" class = "btn btn-sm btn-info"><i class = "fa fa-edit"></i></a>
                                        <a href="{{ route('agency.delete_pickup_point', $pickup_point->id) }}" class = "btn btn-sm btn-danger"><i class = "fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4 style = "text-align:center">No Departure Cities Found!</h4>
                @endif
                </div>
              </div>
              
              <div style="overflow:auto;">
                <div style="float:right;">
                  <input class="button" type="submit" id="nextBtn" value="Update"></input>
                </div>
              </div>
            </form>
   
@endsection

@section('script')

@endsection