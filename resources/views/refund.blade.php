@extends('layouts.app')
@section('title')
Refund
@endsection
@section('content')
<style>
        .content {
          max-width: 1247px;
          margin: 0 auto;
          padding: 38px 0px 80px;
        }
        @media screen and (max-width: 772px) {
          .content {
            padding: 20px 15px;
          }
        }
        
      </style>
      

    <div id="content" class="main content">
        <div class="container">
            
            <div class="row justify-content-center py-3">
                <h2 class="lg:text-4xl text-2xl text-center font-bold tracking-tight">Refund/ Re-issue Policy</h2>
            </div>
            <div class="row my-3">
                <h4 class="lg:text-3xl text-xl text-start font-bold tracking-tight">Hotel</h4>
            </div>
            <div class="row">
                <ul type="square" class="md:text-md text-sm space-y-2 mt-3 md:text-start">
                    <li>hejaz avenue follows property’s cancellation policy.</li>
                    <li>To Cancel a booking, customer must go to ‘My booking’ > ’Cancel’ and confirm the cancellation.</li>
                    <li>Cancellation fee may apply depending on the property and the time of cancellation.</li>
                    <li>Date change is not possible for any hotel booking. Customer needs to cancel the previous booking and rebook with the new date.</li>
                    <li>Booking for black-out dates are not cancellable or refundable.</li>
                    <li>Refund will get initiated (if applicable) after a successful cancellation and refunded amount may reflect in your account within 15 working days depending on your bank.</li>
                </ul>
                <p class="mt-2"><b>Convenience fee is charged by the service provider & it is non-refundable.</b></p>
                 
            </div>
            
            <br>
            
            <div class="row">
                <h4 class="lg:text-3xl text-xl text-start font-bold tracking-tight">Tour</h4>
            </div>
            <div class="row">
                <ul style="list-style-type: square;" class="md:text-md text-sm space-y-2 mt-3 md:text-start">
                    <li>hejaz avenue follows property’s cancellation policy.</li>
                    <li>To Cancel a booking, customer must go to ‘My booking’ > ’Cancel’ and confirm the cancellation.</li>
                    <li>Cancellation fee may apply depending on the property and the time of cancellation.</li>
                    <li>Please check the given policy under each tour before booking.</li>
                    <li>Booking for black-out dates are not cancellable or refundable.</li>
                    <li>Refund will get initiated (if applicable) after a successful cancellation and refunded amount may reflect in your account within 15 working days depending on your bank.</li>
                </ul>
                <p class="mt-2"><b>Convenience fee is charged by the service provider & it is non-refundable.</b></p>
                 
            </div>
            
        </div>
    </div>

@endsection

@section('script')

@endsection