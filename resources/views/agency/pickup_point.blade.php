@extends('agency.layouts.app')
@section('title')
Create Tour
@endsection
@section('content')
    
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

        
        
        <div class="deptcity">
        <form action="{{ route('agency.pickup_point') }}" method="POST" enctype="multipart/form-data">
            @csrf  
            <h2>Add Departure Cities</h2>
           
                <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                  <label for="cname">Choose Tour</label>
                  <select
                            class="form-control"
                            name="tour_id"
                            id="dest"
                          >
                          <option > Select Tour</option>
                          @foreach($tours as $tour)
                            
                              <option value = "{{ $tour->id }}">{{ $tour->trip_name }}</option>
                            
                          @endforeach
                                                    
                        </select>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                  <label for="cname">City Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="cname"
                    name="pickup_city"
                    required
                  />
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <label for="ppfare">Per Person Fare</label>
                    <input
                      type="number"
                      min="0"
                      class="form-control"
                      id="ppfare"
                      name="per_seat_fare"
                      required
                    />
                </div>
              </div>
              <div class="row">
                  <div class="form-group col-md-6 col-sm-12">
                      <label for="cfare">Couple Package Fare</label>
                      <input
                        type="number"
                        min="0"
                        class="form-control"
                        id="cfare"
                        name="couple_package_fare"
                        required
                      />
                    </div>
                  <div class="form-group col-md-6 col-sm-12">
                    <label for="ffare">Family Package Fare(2Adult & 2Kids)</label>
                    <input
                      type="number"
                      min="0"
                      class="form-control"
                      id="ffare"
                      name="family_package_fare"
                      required
                    />
                  </div>
                
                </div>
                <div class="row">
                    <div class="form-group col-12">
                      <label for="ppoint">Pickup Point</label>
                      <input
                          type="address"
                          class="form-control"
                          id="ppoint"
                          name="pickup_point"
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
                      required
                    />
                  </div>
                </div>
                <h2>Kids Charges</h2>
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="under3">Under 3 Years</label>
                        <input
                          type="number"
                          min="0"
                          class="form-control"
                          id="under3"
                          name="kids_under_3_years"
                          required
                        />
                      </div>
                    <div class="form-group col-md-6 col-sm-12">
                      <label for="btw8">Between 3-8 Years</label>
                      <input
                        type="number"
                        min="0"
                        class="form-control"
                        id="btw8"
                        name="kids_between_3_to_8"
                        required
                      />
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="above8">Above 8 Years</label>
                        <input
                          type="number"
                          class="form-control"
                          id="above8"
                          name="kids_above_8_years"
                          required
                        />
                      </div>
                      </div>
                    <div class="row justify-content-end">    
                        <input type="submit" value="Save" class="submit" />
                    </div>
              </form>
        </div>
   
@endsection

@section('script')

@endsection