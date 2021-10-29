@extends('layout')

@section('title', 'Thanks You')

@section('extra-css')

@endsection

@section('content')
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ route('index.page') }}">ပင်မ</a></li>
            <li>Thanks You</li>
        </ul>
    </div>
</div>
<section class="ps-section--account">
    <div class="container">
        <div class="ps-block--payment-success">
            <h3>Orders Success !</h3>
            <p>Thanks for your payment. Please visit<a href="{{ route('profile.index')}}"> here</a> to check your order status.</p>
        </div>
    </div>
</section>
@endsection

@section('extra-js')

@endsection