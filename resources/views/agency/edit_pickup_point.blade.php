@extends('agency.layouts.app')
@section('title')
Edit Departure City
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
            
            
            <form id="regForm" action="{{ route('agency.update_pickup_point') }}"  method="POST" enctype="multipart/form-data">
                @csrf 
                
              <input type="hidden" name="id" value="{{$pickup_point->id}}" />
              <input type="hidden" name="tour_id" value="{{$pickup_point->tour_id}}" />
              <div>
                    <h1>Edit Departure City</h1>
                    <div class="row">
                       
                        <div class="form-group col-md-6 col-sm-12">
                          <label for="cname">City Name</label>
                          <input
                            type="text"
                            class="form-control"
                            id="cname"
                            name="pickup_city"
                            value="{{$pickup_point->pickup_city}}"
                            required
                          />
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                          <label for="ppoint">Pickup Point</label>
                          <input
                              type="address"
                              class="form-control"
                              id="ppoint"
                              name="pickup_point"
                              value="{{$pickup_point->pickup_point}}"
                              required
                            />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="ppfare">Per Person Fare</label>
                            <input
                              type="number"
                              min="0"
                              class="form-control"
                              id="ppfare"
                              name="per_seat_fare"
                              value="{{$pickup_point->per_seat_fare}}"
                              required
                            />
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                          <label for="cfare">Couple Package Fare</label>
                          <input
                            type="number"
                            min="0"
                            class="form-control"
                            id="cfare"
                            name="couple_package_fare"
                            value="{{$pickup_point->couple_package_fare}}"
                            required
                          />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="ffare">Family Package Fare(2Adult & 2Kids)</label>
                            <input
                              type="number"
                              min="0"
                              class="form-control"
                              id="ffare"
                              name="family_package_fare"
                              value="{{$pickup_point->family_package_fare}}"
                              required
                            />
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                          <label for="cfare">Honeymoon Package Fare</label>
                          <input
                            type="number"
                            min="0"
                            class="form-control"
                            id="cfare"
                            name="honeymoon_package_fare"
                            value="{{$pickup_point->honeymoon_package_fare}}"
                            required
                          />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                          <label for="currency_unit">Currency Unit</label>
                          <input
                              type="address"
                              class="form-control"
                              id="currency_unit"
                              name="currency_unit"
                              value="{{$pickup_point->per_seat_fare_currency}}"
                              required
                            />
                        </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-12">
                          <label for="pdate">Pickup Date</label>
                          <input
                            type="date"
                            class="form-control"
                            id="pdate"
                            name="pickup_date"
                            value="{{$pickup_point->pickup_date}}"
                            required
                          />
                        </div>
                      <div class="form-group col-md-6 col-sm-12">
                        <label for="ptime">Pickup Time</label>
                        <input
                          type="time"
                          class="form-control"
                          id="ptime"
                          name="pickup_time"
                          value="{{$pickup_point->pickup_time}}"
                          required
                        />
                      </div>
                    </div>
                    <h2>Kids Charges</h2>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="kids_under_3">Under 3 Years</label>
                            <input
                              type="number"
                              min="0"
                              class="form-control"
                              id="kids_under_3"
                              name="kids_under_3"
                              value="{{$pickup_point->kids_under_3_years}}"
                              required
                            />
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                          <label for="kids_between_3_to_8">Between 3-8 Years</label>
                          <input
                            type="number"
                            min="0"
                            class="form-control"
                            id="kids_between_3_to_8"
                            name="kids_between_3_to_8"
                            value="{{$pickup_point->kids_between_3_to_8}}"
                            required
                          />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="kids_above_8">Above 8 Years</label>
                            <input
                              type="number"
                              class="form-control"
                              id="kids_above_8"
                              name="kids_above_8"
                              value="{{$pickup_point->kids_above_8_years}}"
                              required
                            />
                        </div>
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