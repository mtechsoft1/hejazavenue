@extends('agency.layouts.app')
@section('title')
Create Tour
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
  background-color: #fff;
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
.selected-service {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .service-name { font-weight: bold; }
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
                <div class="col-md-12 text-center">
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
            
            
            <form id="regForm" class="shadow-lg rounded-lg py-16  md:px-4 px-2" action="{{ route('agency.storetour') }}"  method="POST" enctype="multipart/form-data">
                @csrf 
                
              <input type="hidden" name="agency_id" value="{{ Auth::user()->id }}" />

              <div class="tab">
                  <h1 class="text-2xl font-bold mb-4">Add Tour Details</h1>
                <div class="row">
                  <div class="form-group col-md-6 col-sm-12">
                    <label class="block text-sm font-medium text-gray-600" for="ttitle">Tour Title</label>
                    <input
                      type="text"
                      class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                      id="ttitle"
                      name="trip_name"
                      placeholder="Tour Title"
                      required
                    />
                  </div>
                  <div class="form-group col-md-6 col-sm-12">
                   <div class="form-group">
                     <label class="block text-sm font-medium text-gray-600" >Choose Destinations</label>
                        <div class="input-group">
                        
                          <select
                            class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                            name="destination_id"
                            id="dest"
                          >
                          @foreach($destinations as $destination)
                              <option value = "{{ $destination->id }}">{{ $destination->destination_name }}</option>
                          @endforeach
                                                    
                        </select>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                      <label class="block text-sm font-medium text-gray-600" for="edate">total Days</label>
                      <input
                        type="number"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                        id="edate"
                        name="trip_total_days"
                        required
                      />
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                      <label class="block text-sm font-medium text-gray-600" for="cpolicy">Tour Duration</label>
                      <input
                        type="text"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                        id="cpolicy"
                        name="trip_duration"
                        placeholder="2 Days 3 Nights"
                        required
                      />
                    </div>
                </div>
                <div class="row">
                <div class="form-group col-md-4 col-sm-12">
                   <div class="form-group">
                     <label class="block text-sm font-medium text-gray-600" >Every Week</label>
                        <div class="input-group">
                            <select class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" name="day" id="day">
                                <option value="" selected>Select Day</option>
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
                        <label class="block text-sm font-medium text-gray-600" for="sdate">Start Date</label>
                        <input
                          type="date"
                          class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                          id="sdate"
                          name="trip_start_date"
                          required
                        />
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                      <label class="block text-sm font-medium text-gray-600" for="edate">End Date</label>
                      <input
                        type="date"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                        id="edate"
                        name="trip_end_date"
                        required
                      />
                    </div>
                </div>
              </div>
              
              <div class="tab">
                <div class="input_fields_wrap">
                    <h1 class="text-2xl font-bold mb-4">Add Departure Cities</h1>
                        <div class="row">
                          <div class="form-group col-md-12 col-sm-12">
                            <label class="block text-sm font-medium text-gray-600" for="tdesc">Tour Attractions</label>
                            <textarea
                              class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                              rows="3"
                              id="attraction"
                              name="attractions"
                              placeholder="#Muree #Mallroad"
                            ></textarea>
                          </div>
                        </div>  
                        <div class="row">
                          <div class="form-group col-md-12 col-sm-12">
                            <label class="block text-sm font-medium text-gray-600" for="tdesc">Tour Description</label>
                            <textarea
                              class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                              id="tdesc"
                              rows="3"
                              name="trip_description"
                            ></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-12 col-sm-12">
                            <label class="block text-sm font-medium text-gray-600" for="tdesc">Whats Included</label>
                            <textarea
                              class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                              id="winc"
                              rows="3"
                              name="whats_included"
                            ></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-12 col-sm-12">
                            <label class="block text-sm font-medium text-gray-600" for="tdesc">Departure & Return</label>
                            <textarea
                              class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                              id="dar"
                              rows="3"
                              name="departure_and_return"
                            ></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-12 col-sm-12">
                            <label class="block text-sm font-medium text-gray-600" for="tdesc">Accessibility</label>
                            <textarea
                              class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                              id="acc"
                              rows="3"
                              name="accessibility"
                            ></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-12 col-sm-12">
                            <label class="block text-sm font-medium text-gray-600" for="tdesc">Additional Information</label>
                            <textarea
                              class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                              id="ai"
                              rows="3"
                              name="additional_information"
                            ></textarea>
                          </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-12 col-sm-12">
                            <label class="block text-sm font-medium text-gray-600" for="tdesc">Cancellation Policy</label>
                            <textarea
                              class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                              id="cp"
                              rows="3"
                              name="cancellation_policy"
                            ></textarea>
                          </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-12 col-sm-12">
                            <label class="block text-sm font-medium text-gray-600" for="tdesc">FAQ</label>
                            <textarea
                              class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                              id="faq"
                              rows="3"
                              name="faq"
                            ></textarea>
                          </div>
                        </div>
                    </div>
              </div>
              
              <div class="tab">
                <div class="input_fields_wrap">
                    <h1 class="text-2xl font-bold mb-4">Add Benifits</h1>
                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12">
                            <label class="block text-sm font-medium text-gray-600" for="services">Services</label>
                            <select class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" name="" id="services" required>
                                <option value="">--Select Service--</option>
                                <option value="Wonderful Breakfast">Wonderful Breakfast</option>
                                <option value="Restaurant">Restaurant</option>
                                <option value="Spa">Spa</option>
                                <option value="Outdoor swimming pool">Outdoor swimming pool</option>
                                <option value="Airport shuttle">Airport shuttle</option>
                                <option value="Paid private parking">Paid private parking</option>
                                <option value="Fitness Center">Fitness Center</option>
                                <option value="Concierge Service">Concierge Service</option>
                            </select>
                        </div>
                    </div>
                    <div id="selectedServicesContainer">
                        <h3>Selected Services:</h3>
                        <!-- Selected services will be displayed here dynamically -->
                    </div>
                </div>
            </div>

              <div class="tab">
                <div class="input_fields_wrap">
                    <h1 class="text-2xl font-bold mb-4">Add Departure Cities</h1>
                    <div class="row">
                       
                        <div class="form-group col-md-6 col-sm-12">
                          <label class="block text-sm font-medium text-gray-600" for="cname">City Name</label>
                          <input
                            type="text"
                            class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                            id="cname"
                            name="pickup_city[]"
                            placeholder="Islambad"
                            required
                          />
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                          <label class="block text-sm font-medium text-gray-600" for="ppoint">Pickup Point</label>
                          <input
                              type="address"
                              class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                              id="ppoint"
                              name="pickup_point[]"
                              placeholder="D Chowk"
                              required
                            />
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="block text-sm font-medium text-gray-600" for="ppfare">Per Person Fare</label>
                            <input
                              type="number"
                              min="0"
                              class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                              id="ppfare"
                              name="per_seat_fare[]"
                              placeholder="6000"
                              required
                            />
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                          <label class="block text-sm font-medium text-gray-600" for="cfare">Couple Package Fare</label>
                          <input
                            type="number"
                            min="0"
                            class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                            id="cfare"
                            name="couple_package_fare[]"
                            placeholder="10000"
                            required
                          />
                        </div>    
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="block text-sm font-medium text-gray-600" for="ffare">Family Package Fare(2Adult & 2Kids)</label>
                            <input
                              type="number"
                              min="0"
                              class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                              id="ffare"
                              name="family_package_fare[]"
                              placeholder="20000"
                              required
                            />
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                          <label class="block text-sm font-medium text-gray-600" for="cfare">Honeymoon Package Fare</label>
                          <input
                            type="number"
                            min="0"
                            class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                            id="cfare"
                            name="honeymoon_package_fare[]"
                            placeholder="25000"
                            required
                          />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                          <label class="block text-sm font-medium text-gray-600" for="currency_unit">Currency Unit</label>
                          <input
                              type="address"
                              class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                              id="currency_unit"
                              name="currency_unit[]"
                              placeholder="PKR, USD"
                              required
                            />
                        </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-12">
                          <label class="block text-sm font-medium text-gray-600" for="pdate">Pickup Date</label>
                          <input
                            type="date"
                            class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                            id="pdate"
                            name="pickup_date[]"
                            required
                          />
                        </div>
                      <div class="form-group col-md-6 col-sm-12">
                        <label class="block text-sm font-medium text-gray-600" for="ptime">Pickup Time</label>
                        <input
                          type="time"
                          class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                          id="ptime"
                          name="pickup_time[]"
                          required
                        />
                      </div>
                    </div>
                    <h2 class="text-xl text-center font-bold my-6">Kids Charges</h2>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="block text-sm font-medium text-gray-600" for="kids_under_3">Under 3 Years</label>
                            <input
                              type="number"
                              min="0"
                              class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                              id="kids_under_3"
                              name="kids_under_3[]"
                              placeholder="0.00"
                              required
                            />
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                          <label class="block text-sm font-medium text-gray-600" for="kids_between_3_to_8">Between 3-8 Years</label>
                          <input
                            type="number"
                            min="0"
                            class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                            id="kids_between_3_to_8"
                            name="kids_between_3_to_8[]"
                            placeholder="3000"
                            required
                          />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="block text-sm font-medium text-gray-600" for="kids_above_8">Above 8 Years</label>
                            <input
                              type="number"
                              class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                              id="kids_above_8"
                              name="kids_above_8[]"
                              placeholder="6000"
                              required
                            />
                        </div>
                    </div>
                    
                </div>
                <div class="row justify-content-center py-3">
                    <button class="add_field_button btn btn-primary">Add More Departure Cities <i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
                
              </div>
              
              <div class="tab"><h1 class="text-2xl font-bold mb-4">Add Tour Images</h1>
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12">
                        <label class="block text-sm font-medium text-gray-600" for="kids_above_8">Featured Image</label>
                        <input id="trip_image" type="file" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 border-0" name="trip_image" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12">
                        <label class="block text-sm font-medium text-gray-600" for="kids_above_8">Gallery Images</label>
                        <input id="gallery_images" type="file" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 border-0" name="gallery_images[]" multiple="multiple" accept="'image/*" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12">
                       <div class="form-group">
                            <label class="block text-sm font-medium text-gray-600" >Is Featured</label>
                            <div class="input-group">
                                <select class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" name="is_featured" id="is_featured" required>
                                    <option value="0" selected>No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              
              <div style="overflow:auto;">
                <div style="float:right;">
                  <input class="button rounded-md" type="button" id="prevBtn" value="Previous" onclick="nextPrev(-1)"></input>
                  <input class="button rounded-md" type="button" id="nextBtn" value="Next" onclick="nextPrev(1)"></input>
                </div>
              </div>
              <!-- Circles which indicates the steps of the form: -->
              <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
              </div>
            </form>

   
@endsection

@section('script')
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").value = "Submit";
    document.getElementById("nextBtn").type = "submit";
  } else {
    document.getElementById("nextBtn").value = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
//   if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

document.addEventListener("DOMContentLoaded", function () {
    const serviceSelect = document.getElementById("services");
    const selectedServicesContainer = document.getElementById("selectedServicesContainer");
    let selectedServices = []; // This will store the values to be submitted

    serviceSelect.addEventListener("change", function () {
        const selectedText = serviceSelect.options[serviceSelect.selectedIndex].text;
        const selectedValue = serviceSelect.value;

        // Check if the selected service is already in the array
        if (selectedValue && !selectedServices.includes(selectedValue)) {
            selectedServices.push(selectedValue);

            // Create a visual block for the selected service
            const serviceContainer = document.createElement("div");
            serviceContainer.classList.add("selected-service");
            serviceContainer.setAttribute("data-service-value", selectedValue);

            serviceContainer.innerHTML = `
                <span class="service-name">${selectedText}</span>
                <button type="button" class="remove-service-button">Remove</button>
            `;

            // Handle service removal
            serviceContainer.querySelector(".remove-service-button").addEventListener("click", function () {
                serviceContainer.remove();
                selectedServices = selectedServices.filter(service => service !== selectedValue);
                updateHiddenInputs(); // Update hidden inputs when a service is removed
            });

            selectedServicesContainer.appendChild(serviceContainer);
            updateHiddenInputs();
        }

        serviceSelect.value = "";
    });

    function updateHiddenInputs() {
        // Remove old hidden inputs to avoid duplication
        const oldInputs = document.querySelectorAll('.hidden-service-input');
        oldInputs.forEach(input => input.remove());

        // Add hidden inputs for selected services
        selectedServices.forEach(service => {
            const hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "services[]"; // Name must match backend expectation
            hiddenInput.value = service;
            hiddenInput.classList.add("hidden-service-input");
            document.getElementById("regForm").appendChild(hiddenInput);
        });
    }
});


</script>


<script>
	$(document).ready(function() {
	var max_fields      = 5; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID
	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div><h1 class="text-2xl font-bold mb-4">Add Departure Cities</h1>'+
                                '<div class="row">'+
                                    '<div class="form-group col-md-6 col-sm-12">'+
                                      '<label for="cname">City Name</label>'+
                                      '<input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="cname" name="pickup_city[]"  placeholder="Islambad" required/>'+
                                    '</div>'+
                                    '<div class="form-group col-md-6 col-sm-12">'+
                                      '<label for="ppoint">Pickup Point</label>'+
                                      '<input type="address" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="ppoint" name="pickup_point[]" placeholder="D Chowk" required/>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">'+
                                    '<div class="form-group col-md-6 col-sm-12">'+
                                        '<label for="ppfare">Per Person Fare</label>'+
                                        '<input type="number" min="0" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="ppfare" name="per_seat_fare[]" placeholder="6000" required/>'+
                                    '</div>'+
                                    '<div class="form-group col-md-6 col-sm-12">'+
                                      '<label for="cfare">Couple Package Fare</label>'+
                                      '<input type="number" min="0" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="cfare" name="couple_package_fare[]" placeholder="10000" required/>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">'+
                                    '<div class="form-group col-md-6 col-sm-12">'+
                                        '<label for="ffare">Family Package Fare(2Adult & 2Kids)</label>'+
                                        '<input type="number" min="0" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="ffare" name="family_package_fare[]" placeholder="20000" required />'+
                                    '</div>'+
                                    '<div class="form-group col-md-6 col-sm-12">'+
                                      '<label for="honeymoon_package_fare">Honeymoon Package Fare</label>'+
                                      '<input type="number" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="honeymoon_package_fare" name="honeymoon_package_fare[]"  placeholder="25000" required/>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">'+
                                    '<div class="form-group col-md-6 col-sm-12">'+
                                      '<label for="currency_unit">Currency Unit</label>'+
                                      '<input type="text" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="currency_unit" name="currency_unit[]"  placeholder="PKR, USD" required/>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">'+
                                  '<div class="form-group col-md-6 col-sm-12">'+
                                      '<label for="pdate">Pickup Date</label>'+
                                      '<input type="date" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="pdate" name="pickup_date[]" required/>'+
                                    '</div>'+
                                  '<div class="form-group col-md-6 col-sm-12">'+
                                    '<label for="ptime">Pickup Time</label>'+
                                    '<input type="time" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="ptime" name="pickup_time[]" required/>'+
                                  '</div>'+
                                '</div>'+
                                '<h2>Kids Charges</h2>'+
                                '<div class="row">'+
                                    '<div class="form-group col-md-6 col-sm-12">'+
                                        '<label for="kids_under_3">Under 3 Years</label>'+
                                        '<input type="number" min="0" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="kids_under_3" name="kids_under_3[]" placeholder="0.00" required />'+
                                    '</div>'+
                                    '<div class="form-group col-md-6 col-sm-12">'+
                                      '<label for="kids_between_3_to_8">Between 3-8 Years</label>'+
                                      '<input type="number" min="0" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="kids_between_3_to_8" name="kids_between_3_to_8[]" placeholder="3000" required />'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">'+
                                    '<div class="form-group col-md-6 col-sm-12">'+
                                        '<label for="kids_above_8">Above 8 Years</label>'+
                                        '<input type="number" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="kids_above_8" name="kids_above_8[]" placeholder="6000" required />'+
                                    '</div>'+
                                    // '<div class="form-group col-md-6 col-sm-12">'+
                                    //     '<br>'+
                                    //     '<a href="#" class="remove_field btn btn-danger">Remove</a>'+
                                    // '</div>'+
                                '</div></div>'); //add input box
		}
	});
	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
@endsection