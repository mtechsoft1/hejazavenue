@extends('layouts.app')
@section('title')
Compass Tour
@endsection
@section('content')
@section('hide_navbar', true)
@include('components.video_header', ['title' => 'Contact Us', 'breadcrumb' => 'Home/Contact Us'])

{{--
<div class="container-fluid">
    <div class="contact-img">
        <div class="tour-img-overlay"></div>
        <div class="tour-text">
            <h2 class="lg:text-5xl text-4xl">Contact Us</h2>
            <div class="link-div"><a href="/">Home</a>/Contact Us</div>
        </div>
    </div>
    <!----End Header--->
</div>
--}}


    <div id="content" class="main lg:max-w-[1110px] w-[90vw] mx-auto my-12">
        <div>
            <div class="contact-section">
                <div class="row clearfix">
                    <div class="contact-info col-md-4 col-sm-6 col-xs-12">
                        <!---contact info-->
                        <div class="inner-div">
                            <div class="icon-box">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </div>
                            <h3>Our Address</h3>
                            <div class="text">
                                K-Block Valancia Town <br />
                                Lahore, Pakistan
                            </div>
                        </div>
                    </div>
                    <div class="contact-info col-md-4 col-sm-6 col-xs-12">
                        <!---contact info-->
                        <div class="inner-div">
                            <div class="icon-box">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </div>
                            <h3>Phone & Email</h3>
                            <div class="text">
                                +923212220630 <br />
                                contact@compassmytrip.com
                            </div>
                        </div>
                    </div>
                    <div class="contact-info col-md-4 col-sm-6 col-xs-12">
                        <!---contact info-->
                        <div class="inner-div">
                            <div class="icon-box">
                                <i class="fa fa-comments-o" aria-hidden="true"></i>
                            </div>
                            <h3>Stay in Touch</h3>
                            <div class="text">Also find us on social Media</div>
                            <div class="social-icon-three clearfix">
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form-section mt-10">
                <div class="row clearfix">
                    <div class="column col-md-7 col-sm-12 col-xs-12">
                        <!--Contact Form-->
                        <div class="contact-form">
                            <h3 class="heading text-center mt-3">What is your question about?</h3>
                            <div class="container">
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
                                <form id="contact-form" name="contact-form" action="{{route('contactus_message')}}"
                                    method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email Address(required)</label>
                                        <input type="email" class="form-control" id="email" name="email" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Your Name(required)</label>
                                        <input type="text" class="form-control" id="name" name="name" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" name="subject" class="form-control" id="subject" />
                                    </div>

                                    <div class="form-group">
                                        <label for="message">Your Message</label>
                                        <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                                    </div>
                                    <div class="row text-center justify-content-center">
                                        <input type="submit" value="Send" class="submit" />
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="column col-md-5 col-sm-12 col-xs-12 mt-12">
                        <div class="">
                            <h3 class="text-2xl tracking-tighter font-bold text-center">Have You Any Question About Us?</h3>
                            <div class="text space-y-2 text-md leading-6 text-center mt-3">
                                <p>
                                    Any kind of business solution and consultion don't
                                    hesitate to contact with us for imiditate customer
                                    support. We are love to hear from you
                                </p>
                                <p>
                                    <span>Office Hours:</span> We are always open from 10:00am
                                    to 6:00pm except Saturday and Sunday.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection