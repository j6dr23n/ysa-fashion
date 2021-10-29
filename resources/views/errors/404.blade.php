@extends('layout')

@section('title', '404')

@section('extra-css')

@endsection

@section('content')
    <div class="ps-page--404">
        <div class="container">
            <div class="ps-section__content"><img src="img/404.jpg" alt="">
                <h3>ohh! page not found</h3>
                <p>It seems we can't find what you're looking for. Perhaps searching can help or go back to<a href="{{ route('index.page') }}">Homepage</a></p>
                <form class="ps-form--widget-search" action="do_action" method="get">
                    <input class="form-control" type="text" placeholder="Search...">
                    <button><i class="icon-magnifier"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')

@endsection
    