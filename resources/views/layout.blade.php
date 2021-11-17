<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="ysa">
    <meta name="keywords" content="ysa fashion">
    <meta name="description" content="Ysa Fashion Online Shop | Bag Shop">
    <title>@yield('title', '') | YSA-OnlineShop</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/bg/logo.png') }}" />
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css"/>
    
    <link rel="stylesheet" href="{{ asset('fonts/Linearicons/Linearicons/Font/demo-files/demo.css')}}"> 
    {{-- <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/assets/owl.carousel.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    {{-- <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/assets/owl.theme.default.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>
    {{-- <link rel="stylesheet" href="{{ asset('plugins/slick/slick/slick.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    {{-- <link rel="stylesheet" href="{{ asset('plugins/nouislider/nouislider.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.css"/>
    {{-- <link rel="stylesheet" href="{{ asset('plugins/lightGallery-master/dist/css/lightgallery.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.3.0/css/lightgallery.min.css"/>
    {{-- <link rel="stylesheet" href="{{ asset('plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/themes/fontawesome-stars.css">
    {{-- <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-2KHVDDQRTJ"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-2KHVDDQRTJ');
        </script>

    <!-- extra css -->
    @yield('extra-css')
    <!-- end of extra css -->
</head>

<body>
    @include('partials.header')
    
    @include('partials.sidebar-mobile')

    @yield('content')

    @include('partials.footer')

    @yield('extra-js')