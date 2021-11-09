@extends('layout')

@section('title', 'About Us')

@section('extra-css')

@endsection

@section('content')
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('index.page') }}">Home</a></li>
                <li>About Us</li>
            </ul>
        </div>
    </div>
    <div class="ps-page--single" id="about-us">
        <br><img src="img/bg/cover.png" alt="" style="
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;">
        <div class="ps-about-intro">
            <div class="container-fluid">
                {{-- <div class="ps-section__header">
                    <h4>Welcome to Ysa Fashion</h4>
                    <h3>Online Shopping</h3>
                    <p>Cash On Delivery</p>
                </div> --}}
                <div class="ps-section__content">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 ">
                            <div class="ps-block--icon-box"><i class="icon-cube"></i>
                                <h4>{{ $products->count() }}</h4>
                                <p>Product for sale</p>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 ">
                            <div class="ps-block--icon-box"><i class="icon-store"></i>
                                <h4>{{ $users->count() }}</h4>
                                <p>Members on Ysa Fashion</p>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 ">
                            <div class="ps-block--icon-box"><i class="icon-bag2"></i>
                                <h4>{{ $users->count() }}</h4>
                                <p>Buyer active on Ysa Fashion</p>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 ">
                            <div class="ps-block--icon-box"><i class="icon-telephone"></i>
                                <h4>+9595094762</h4>
                                <p>Buyer active on Ysa Fashion</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--include ../../partials/pages/about-us/milestone-->
        {{-- <div class="ps-our-team">
            <div class="container">
                <div class="ps-section__header">
                    <h3>Meet Our Leaders</h3>
                </div>
                <div class="ps-section__content">
                    <figure>
                        <div class="ps-block--ourteam"><img src="img/users/our-team/1.jpg" alt="">
                            <div class="ps-block__content">
                                <h4>Robert Downey Jr</h4>
                                <p>CEO Fouder</p>
                                <ul>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </figure>
                    <figure>
                        <div class="ps-block--ourteam"><img src="img/users/our-team/2.jpg" alt="">
                            <div class="ps-block__content">
                                <h4>Robert Downey Jr</h4>
                                <p>CEO Fouder</p>
                                <ul>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </figure>
                    <figure>
                        <div class="ps-block--ourteam"><img src="img/users/our-team/3.jpg" alt="">
                            <div class="ps-block__content">
                                <h4>Robert Downey Jr</h4>
                                <p>CEO Fouder</p>
                                <ul>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </figure>
                    <figure>
                        <div class="ps-block--ourteam"><img src="img/users/our-team/4.jpg" alt="">
                            <div class="ps-block__content">
                                <h4>Robert Downey Jr</h4>
                                <p>CEO Fouder</p>
                                <ul>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </figure>
                    <figure>
                        <div class="ps-block--ourteam"><img src="img/users/our-team/5.jpg" alt="">
                            <div class="ps-block__content">
                                <h4>Robert Downey Jr</h4>
                                <p>CEO Fouder</p>
                                <ul>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </figure>
                    <figure>
                        <div class="ps-block--ourteam"><img src="img/users/our-team/6.jpg" alt="">
                            <div class="ps-block__content">
                                <h4>Robert Downey Jr</h4>
                                <p>CEO Fouder</p>
                                <ul>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </figure>
                    <figure>
                        <div class="ps-block--ourteam"><img src="img/users/our-team/7.jpg" alt="">
                            <div class="ps-block__content">
                                <h4>Robert Downey Jr</h4>
                                <p>CEO Fouder</p>
                                <ul>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </figure>
                    <figure data-mh="our-team">
                        <div class="ps-block--ourteam blank"><a href="#">Become <br> member in <br> team</a></div>
                    </figure>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@section('extra-js')

@endsection