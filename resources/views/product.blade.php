@extends('product-layout')

@section('title', 'Product Details')

@section('extra-css')

@endsection

@section('content')
    <nav class="navigation--mobile-product">
        <form action="{{ route('cart.store') }}" method="POST">
        @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <input type="hidden" name="name" value="{{ $product->name }}">
            <input type="hidden" name="price" value="{{ $product->price * (1 - $product->discountPercent / 100) }}">
            <button class="ps-btn-cart" style="font-size: small;" {{ $product->quantity == 0 ? 'disabled' : ''  }}>{{ $product->quantity == 0 ? 'ပစ္စည်းမရှိပါ။' : 'ခြင်းထဲထည့်ရန်'  }}</buttton>
        </form>
    </nav>
    <div class="ps-breadcrumb">
        <div class="ps-container">
            <ul class="breadcrumb">
                <li><a href="{{ route('index.page') }}">ပင်မ</a></li>
                <li><a href="{{ route('shop.index') }}">စျေးဝယ်ရန်</a></li>
                <li>{{ $product->name }}</li>
            </ul>
        </div>
    </div>
    <div class="ps-page--product">
        <div class="ps-container">
            <div class="ps-page__container">
                <div class="ps-page__left">
                    <div class="ps-product--detail ps-product--fullwidth">
                        <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                            <div class="ps-product__header">
                                <div class="ps-product__thumbnail" data-vertical="true">
                                    <figure>
                                        <div class="ps-wrapper">
                                            <div class="ps-product__gallery" data-arrow="true">
                                                <div class="item"><a href="{{ productImage($product->image) }}"><img src="{{ productImage($product->image) }}" alt="{{ $product->name }}"></a></div>
                                                @if ($product->images)
                                                    @foreach (json_decode($product->images,true) as $image)
                                                        <div class="item"><a href="{{ productImage($image) }}"><img src="{{ productImage($image) }}" alt="{{ $product->name }}"></a></div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </figure>
                                    <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
                                        <div class="item"><img src="{{ productImage($product->image) }}" alt="{{ $product->name }}" width="69px" height="69px"></div>
                                        @if ($product->images)
                                            @foreach (json_decode($product->images,true) as $image)
                                                <div class="item"><img src="{{ productImage($image) }}" alt="{{ $product->name }}"  width="69px" height="69px"></div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="ps-product__info">
                                    <h1>{{ $product->name }}</h1>
                                    <div class="ps-product__meta"></div>
                                    <h4 class="ps-product__price">{{ presentPrice($product->price * (1 - $product->discountPercent / 100)) }} <del style="{{ $product->discountPercent != null ? 'display:initial;': 'display:none;' }}">{{ presentPrice($product->price) }} </del>&nbsp; <small style="{{ $product->discountPercent != null ? 'display:initial;': 'display:none;' }} font-size:14px;"> {{ $product->discountPercent }}% off</small></h4>
                                    <div class="ps-product__desc">
                                        <ul class="ps-list--dot">
                                            <li> {{ $product->details }}</li>
                                        </ul>
                                    </div>
                                    <div class="ps-product__variations">
                                        <figure>
                                            <figcaption style="color:black;font-size:16px">Color</figcaption>
                                            @php
                                                $color_hex = $product->color;
                                                $product_color = explode(',',$product->color_name);
                                            @endphp
                                            <select name="color" class="select-product-color" style="margin-bottom: 3%;">
                                            @foreach ($product_color as $color)
                                                <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                            @endforeach
                                        </select>
                                        </figure>
                                    </div>
                                    <div class="ps-product__shopping">
                                        <div style="margin:15px 0;"></div>
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <input type="hidden" name="name" value="{{ $product->name }}">
                                            <input type="hidden" name="price" value="{{ $product->price * (1 - $product->discountPercent / 100) }}">
                                            <button class="ps-btn" {{ $product->quantity == 0 ? 'disabled' : ''  }}>{{ $product->quantity == 0 ? 'ပစ္စည်းမရှိပါ။' : 'ခြင်းထဲထည့်ရန်'  }}</buttton>
                                    </div>
                                    <div class="ps-product__specification"><a class="report" href="mailto:ysablow@gmail.com">Report Abuse</a>
                                        @php
                                            $categoriesName = explode(',',$CategoryName);
                                            $ch = '-';  
                                        @endphp
                                        <p class="categories"><strong> Categories:</strong>
                                            @foreach ($categoriesName as $category)
                                            <?php 
                                                $category_slug = strtolower(str_replace(' ',$ch,$category));
                                            ?>
                                                <a href="{{ route('shop.index',['category' => $category_slug]) }}">{{ $category }}</a>,
                                            @endforeach
                                        </p>
                                        {{-- <p class="tags"><strong> Tags</strong><a href="#">sofa</a>,<a href="#">technologies</a>,<a href="#">wireless</a></p> --}}
                                    </div>                
                                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                    <div class="addthis_inline_share_toolbox"></div>
                                </div>
                            </div>
                            <div class="ps-product__content ps-tab-root">
                                <ul class="ps-tab-list">
                                    <li class="active"><a href="#tab-1">Description</a></li>
                                </ul>
                                <div class="ps-tabs">
                                    <div class="ps-tab active" id="tab-1">
                                        <div class="ps-document">
                                            {!! nl2br($product->description) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="ps-section--default ps-customer-bought">
                <div class="ps-section__header">
                    <h3>ဝယ်ယူသူများဝယ်ယူမူ့များသောပစ္စည်းများ</h3>
                </div>
                <div class="ps-section__content">
                    <div class="row">
                        @foreach ($recommendedItems as $product)
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                                <div class="ps-product">
                                    <div class="ps-product__thumbnail"><a href="{{ route('shop.show', $product->slug) }}"><img src="{{ productImage($product->image) }}" alt=""></a>
                                        @if ($product->quantity == 0)
                                            <div class="ps-product__badge out-stock" style="{{ $product->quantity == 0 ? 'display:initial': 'display:none' }}">Out Of Stock</div>
                                        @endif
                                        @if ($product->discountPercent != null)
                                            <div class="ps-product__badge" style="{{ $product->discountPercent != null & $product->quantity != 0 ? 'display:initial': 'display:none' }}">-{{ $product->discountPercent }}%</div>
                                        @endif
                                        @if ($product->quantity <= 2)
                                        <div class="ps-product__badge hot" style="{{ $product->quantity <= 2 & $product->discountPercent == null & $product->quantity != 0 ? 'display:initial': 'display:none' }}">hot</div>
                                        @endif
                                        <ul class="ps-product__actions">
                                            <li><a href="{{ route('shop.show', $product->slug) }}" data-toggle="tooltip" data-placement="top" title="ကြည့်ရန်"><i class="icon-bag2"></i></a></li>
                                            <li><a href="{{ route('shop.show', $product->slug) }}" data-placement="top" title="အမြန်ကြည့်ရန်" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                            <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="name" value="{{ $product->name }}">
                                                <input type="hidden" name="price" value="{{ $product->price * (1 - $product->discountPercent / 100) }}">
                                                <li><button href="" data-toggle="tooltip" data-placement="top" title="ခြင်းထဲထည့်ရန်"><i class="icon-heart"></i></button></li>	
                                            </form>
                                        </ul>
                                    </div>
                                    <div class="ps-product__container">
                                        <div class="ps-product__content"><a class="ps-product__title" href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                                            <p class="ps-product__price">{{ presentPrice($product->price) }}</p>
                                        </div>
                                        <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                                            <p class="ps-product__price">{{ presentPrice($product->price) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="ps-section--default">
                <div class="ps-section__header">
                    <h3>အမျိုးအစားတူပစ္စည်းများ</h3>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                        @foreach ($categoryProduct as $categoryproduct)
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="{{ route('shop.show', $categoryproduct->slug) }}"><img src="{{ productImage($categoryproduct->image) }}" alt=""></a>
                                    @if ($product->quantity == 0)
                                        <div class="ps-product__badge out-stock" style="{{ $product->quantity == 0 ? 'display:initial': 'display:none' }}">Out Of Stock</div>
                                    @endif
                                    @if ($product->discountPercent != null)
                                        <div class="ps-product__badge" style="{{ $product->discountPercent != null & $product->quantity != 0 ? 'display:initial': 'display:none' }}">-{{ $product->discountPercent }}%</div>
                                    @endif
                                    @if ($product->quantity <= 2)
                                    <div class="ps-product__badge hot" style="{{ $product->quantity <= 2 & $product->discountPercent == null & $product->quantity != 0 ? 'display:initial': 'display:none' }}">hot</div>
                                    @endif
                                    <ul class="ps-product__actions">
                                        <li><a href="{{ route('shop.show', $categoryproduct->slug) }}" data-toggle="tooltip" data-placement="top" title="ကြည့်ရန်"><i class="icon-bag2"></i></a></li>
                                        <li><a href="{{ route('shop.show', $categoryproduct->slug) }}" data-placement="top" title="အမြန်ကြည့်ရန်" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                        <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                            <input type="hidden" name="id" value="{{ $categoryproduct->id }}">
                                            <input type="hidden" name="name" value="{{ $categoryproduct->name }}">
                                            <input type="hidden" name="price" value="{{ $categoryproduct->price * (1 - $categoryproduct->discountPercent / 100) }}">
                                            <li><button data-toggle="tooltip" data-placement="top" title="ခြင်းထဲထည့်ရန်"><i class="icon-heart"></i></button></li>	
                                        </form>
                                    </ul>
                                </div>
                                <div class="ps-product__container">
                                    <div class="ps-product__content"><a class="ps-product__title" href="{{ route('shop.show', $categoryproduct->slug) }}">{{ $categoryproduct->name }}</a>
                                        <p class="ps-product__price">{{ presentPrice($categoryproduct->price) }}</p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('shop.show', $categoryproduct->slug) }}">{{ $categoryproduct->name }}</a>
                                        <p class="ps-product__price">{{ presentPrice($categoryproduct->price) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')

@endsection