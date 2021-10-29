@extends('layout')

@section('title', 'Contact')

@section('extra-css')

@endsection

@section('content')
    <div class="ps-page--single" id="contact-us">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index.page') }}">ပင်မ</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
        <div id="contact-map" data-address="17 Queen St, Southbank, Melbourne 10560, Australia" data-title="Funiture!" data-zoom="17" style="margin:10px;">
            <iframe src="" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        <div class="ps-contact-info">
            <div class="container">
                <div class="ps-section__header">
                    <h3>Contact Us For Any Questions</h3>
                </div>
                <div class="ps-section__content">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-block--contact-info">
                                <h4>Contact Directly</h4>
                                <p><a href="mailto:ysablow@gmail.com">ysablow@gmail.com</a><span>+9595094762</span></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-block--contact-info">
                                <h4>Head Quater</h4>
                                <p><span>No.280/5 , Kyaung Street ,Lane(2) ,Thuwana ,Yangon.</span></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                            <div class="ps-block--contact-info">
                                <h4>Customer Service</h4>
                                <p><a href="mailto:ysablow@gmail.com">Ysa-Fashion</a><span>+9595094762 , +9595406084</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="ps-contact-form">
            <div class="container">
                <form class="ps-form--contact-us" action="index.html" method="get">
                    <h3>Get In Touch</h3>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Name *">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Email *">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Subject *">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <div class="form-group">
                                <textarea class="form-control" rows="5" placeholder="Message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group submit">
                        <button class="ps-btn">Send message</button>
                    </div>
                </form>
            </div>
        </div> -->
    </div>
@endsection

@section('extra-js')

@endsection