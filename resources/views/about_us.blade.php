@extends('layouts.app')
@section('title')
About Us
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
                <h2 class="lg:text-4xl text-3xl text-center font-bold tracking-tight">About Us</h2>
            </div>
            
            <div class="row">
                <p class="md:text-md text-sm text-center max-w-[700px] mx-auto">Compassmytrip offering Tours and Travels in Pakistan. The Pakistan travel packages range from northern area tour packages, Summer Tour Packages to Winter Tour Packages and also including City tours and Historical area Tours.</p><br>
            </div>
            
        </div>
    </div>

@endsection

@section('script')

@endsection