@extends('user.layouts.app')
@section('title')
Submit Review
@endsection
@section('content')

<style>
#regForm {
  background-color: #f1f1f1;
  margin: 0px auto;
  /*font-family: Raleway;*/
  padding: 40px;
  width: 70%;
  /*min-width: 300px;*/
}

h1 {
  text-align: center;  
}
#avatar-div {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border-style: solid;
  border-color: #ffd3d3;
  box-shadow: 0 0 8px 3px #B8B8B8;
  position: relative;
  margin: 10px auto;
}

#avatar-div img {
  height: 100%;
  width: 100%;
  border-radius: 50%;
}

.cancel {
    color: #009900;
    padding: 8px 65px;
    border: 1px solid;
    border-radius: 30px;
    font-size: 18px;
    font-weight: 500;
    cursor: pointer;
}
.rating {
    /*padding-top: 10px;*/
    direction: rtl;
    
    }
    .rating > input {
      display: none;
    }
    .rating > label {
      position: relative;
      width: 1em;
      font-size: 40px;
      font-weight: 400;
      color: #28a745;
      cursor: pointer;
    }
    
    .rating > label::before {
    content: "\2605";
    position: absolute;
    opacity: 0;
    }
    
    .rating > label:hover:before,
    .rating > label:hover ~ label:before {
    opacity: 1 !important;
    }
    
    .rating > input:checked ~ label:before {
    opacity: 1;
    }
    
    .rating:hover > input:checked ~ label:before {
    opacity: 0.4;
    }
</style>
      
        <form id="regForm" action="{{ route('user.add_review') }}"  method="POST" enctype="multipart/form-data">
                @csrf 
                
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
               <input type="hidden" name="agency_id" value="{{ $booking->agency_id }}" />
              <!--<h1>Create Tour</h1>-->
              <!-- One "tab" for each step in the form: -->
            <div class="tab"><h1>Review & Rating</h1>
                <div id="avatar-div">
                        <img src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png" class="main-profile-img" />
                </div>
                <div class="row text-center justify-content-center">    
                    <div>
                        <h4>{{$booking->agency_name}}</h4>
                        <p>Rate The Service Provider</p>
                    </div>
                </div>
                <div class="row text-center justify-content-center">    
                    <div class="rating">
                        <input type="radio" name="rating_stars" value="5.0" id="1"><label for="1">☆</label>
                        <input type="radio" name="rating_stars" value="4.0" id="2"><label for="2">☆</label>
                        <input type="radio" name="rating_stars" value="3.0" id="3"><label for="3">☆</label>
                        <input type="radio" name="rating_stars" value="2.0" id="4"><label for="4">☆</label>
                        <input type="radio" name="rating_stars" value="1.0" id="5"><label for="5">☆</label>
                    </div>
                </div>
                <div class="row">
                  
                  <div class="form-group col-md-12 col-sm-12">
                    <label for="review">Review Description</label>
                    <textarea
                      class="form-control"
                      id="review"
                      rows="3"
                      name="review"
                      placeholder="Review Description..."
                    ></textarea>
                  </div>
                </div>
            </div>
            <div class="row justify-content-around">
                <a href="{{ route('user.my_bookings') }}"><button class="cancel">Not Now</button></a>    
                <input type="submit" value="Submit" class="submit" />
            </div>
        </form>
      
      
@endsection

@section('script')

@endsection