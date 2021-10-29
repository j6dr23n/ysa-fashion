@extends('layout')

@section('title', 'Home')

@section('content')
    <div id="homepage-1">
        <br>
        <div class="ps-site-features">
            <div class="ps-container">
                <div class="ps-block--site-features">
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-rocket"></i></div>
                        <div class="ps-block__right">
                            <h4>Fast Delivery</h4>
                            <p>For all orders on Myanmar.</p>
                        </div>
                    </div>
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-bubbles"></i></div>
                        <div class="ps-block__right">
                            <h4>24/7 Support</h4>
                            <p>Dedicated support</p>
                        </div>
                    </div>
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-phone"></i></div>
                        <div class="ps-block__right">
                            <h4>Hot Line</h4>
                            <p>+9595094762 , +9595406084</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($promotionsItems->first() != null)
            <div class="ps-deal-of-day">
                <div class="ps-container">
                    <div class="ps-section__header">
                        <div class="ps-block--countdown-deal">
                            <div class="ps-block__left">
                                <h3>Promotions</h3>
                            </div>
                        </div><a href="{{ route('promotion.index') }}">View all</a>
                    </div>
                    <div class="ps-section__content">
                        <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="5" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                            @foreach ($promotionsItems as $product)
                            <div class="ps-product ps-product--inner">
                                <div class="ps-product__thumbnail"><a href="{{ route('shop.show', $product->slug) }}"><img src="{{ productImage($product->image) }}" alt="{{ $product->name }}"></a>
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
                                    <p class="ps-product__price sale" style="font-size:13px;">{{ presentPrice($product->price * (1 - $product->discountPercent / 100)) }} <del>{{ presentPrice($product->price) }} </del><small style="{{ $product->discountPercent != null ? 'display:initial;': 'display:none;' }} font-size:14px;">{{ $product->discountPercent }}% off</small></p>
                                    <div class="ps-product__content"><a class="ps-product__title" href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                                        <div class="ps-product__progress-bar ps-progress" data-value="{{ $product->quantity }}">
                                            <div class="ps-progress__value"><span></span></div>
                                            <p>Sold:{{ 10-$product->quantity}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="ps-top-categories">
            <div class="ps-container">
                <h3>ယခုလရောင်းအားအကောင်းဆုံးအမျိုးအစားများ</h3>
                <div class="row">
                    @foreach($categories as $category)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 ">
                        <div class="ps-block--category">
                            <a class="ps-block__overlay" href="{{ route('shop.index',['category' => $category->slug]) }}">
                            </a>
                            <div style="height: 121px;">
                                <img src="{{ productImage($category->image) }}" alt="{{ $category->name }}" height="121px;">
                            </div>
                            <p>{{ $category->name }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="ps-product-list ps-clothings">
            <div class="ps-container">
                <div class="ps-section__header">
                    <h3>{{ $categories1->name }}</h3>
                    <ul class="ps-section__links">
                        <li><a href="{{ route('shop.index',['category' => $categories1->slug]) }}">View All</a></li>
                    </ul>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                        @foreach ($categoryProduct1 as $item1)
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="{{ route('shop.show', $item1->slug) }}"><img src="{{ productImage($item1->image) }}" alt="{{ $item1->name }}"></a>
                                    @if ($item1->quantity == 0)
                                        <div class="ps-product__badge out-stock" style="{{ $item1->quantity == 0 ? 'display:initial': 'display:none' }}">Out Of Stock</div>
                                    @endif
                                    @if ($item1->discountPercent != null)
                                        <div class="ps-product__badge" style="{{ $item1->discountPercent != null & $item1->quantity != 0 ? 'display:initial': 'display:none' }}">-{{ $item1->discountPercent }}%</div>
                                    @endif
                                    @if ($item1->quantity <= 2)
                                    <div class="ps-product__badge hot" style="{{ $item1->quantity <= 2 & $item1->discountPercent == null & $item1->quantity != 0 ? 'display:initial': 'display:none' }}">hot</div>
                                    @endif
                                    <ul class="ps-product__actions">
                                        <li><a href="{{ route('shop.show', $item1->slug) }}" data-toggle="tooltip" data-placement="top" title="ကြည့်ရန်"><i class="icon-bag2"></i></a></li>
                                        <li><a href="{{ route('shop.show', $item1->slug) }}" data-placement="top" title="အမြန်ကြည့်ရန်" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                        <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                            <input type="hidden" name="id" value="{{ $item1->id }}">
                                            <input type="hidden" name="name" value="{{ $item1->name }}">
                                            <input type="hidden" name="price" value="{{ $item1->price * (1 - $item1->discountPercent / 100) }}">
                                            <li><button href="" data-toggle="tooltip" data-placement="top" title="ခြင်းထဲထည့်ရန်"><i class="icon-heart"></i></button></li>	
                                        </form>
                                    </ul>
                                </div>
                                <div class="ps-product__container">
                                    <div class="ps-product__content"><a class="ps-product__title" href="{{ route('shop.show', $item1->slug) }}">{{ $item1->name }}</a>
                                        <p class="ps-product__price sale">{{ presentPrice($item1->price * (1 - $item1->discountPercent / 100)) }} <del style="{{ $item1->discountPercent > 0 ? 'display:initial' : 'display:none' }}">{{ presentPrice($item1->price) }} </del></p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('shop.show', $item1->slug) }}">{{ $item1->name }}</a>
                                        <p class="ps-product__price sale">{{ presentPrice($item1->price * (1 - $item1->discountPercent / 100)) }} <del style="{{ $item1->discountPercent > 0 ? 'display:initial' : 'display:none' }}">{{ presentPrice($item1->price) }} </del></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-product-list ps-clothings">
            <div class="ps-container">
                <div class="ps-section__header">
                    <h3>{{ $categories2->name }}</h3>
                    <ul class="ps-section__links">
                        <li><a href="{{ route('shop.index',['category' => $categories2->slug]) }}">View All</a></li>
                    </ul>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--responsive owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="2" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                        @foreach ($categoryProduct2 as $item2)
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="{{ route('shop.show', $item2->slug) }}"><img src="{{ productImage($item2->image) }}" alt="{{ $item2->name }}"></a>
                                    @if ($item2->quantity == 0)
                                        <div class="ps-product__badge out-stock" style="{{ $item2->quantity == 0 ? 'display:initial': 'display:none' }}">Out Of Stock</div>
                                    @endif
                                    @if ($item2->discountPercent != null)
                                        <div class="ps-product__badge" style="{{ $item2->discountPercent != null & $item2->quantity != 0 ? 'display:initial': 'display:none' }}">-{{ $item2->discountPercent }}%</div>
                                    @endif
                                    @if ($item2->quantity <= 2)
                                    <div class="ps-product__badge hot" style="{{ $item2->quantity <= 2 & $item2->discountPercent == null & $item2->quantity != 0 ? 'display:initial': 'display:none' }}">hot</div>
                                    @endif
                                    <ul class="ps-product__actions">
                                        <li><a href="{{ route('shop.show', $item2->slug) }}" data-toggle="tooltip" data-placement="top" title="ကြည့်ရန်"><i class="icon-bag2"></i></a></li>
                                        <li><a href="{{ route('shop.show', $item2->slug) }}" data-placement="top" title="အမြန်ကြည့်ရန်" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                        <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                            <input type="hidden" name="id" value="{{ $item2->id }}">
                                            <input type="hidden" name="name" value="{{ $item2->name }}">
                                            <input type="hidden" name="price" value="{{ $item2->price * (1 - $item2->discountPercent / 100) }}">
                                            <li><button href="" data-toggle="tooltip" data-placement="top" title="ခြင်းထဲထည့်ရန်"><i class="icon-heart"></i></button></li>	
                                        </form>
                                    </ul>
                                </div>
                                <div class="ps-product__container">
                                    <div class="ps-product__content"><a class="ps-product__title" href="{{ route('shop.show', $item2->slug) }}">{{ $item2->name }}</a>
                                        <p class="ps-product__price sale">{{ presentPrice($item2->price * (1 - $item2->discountPercent / 100)) }} <del style="{{ $item2->discountPercent > 0 ? 'display:initial' : 'display:none' }}">{{ presentPrice($item2->price) }} </del></p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('shop.show', $item2->slug) }}">{{ $item2->name }}</a>
                                        <p class="ps-product__price sale">{{ presentPrice($item2->price * (1 - $item2->discountPercent / 100)) }} <del style="{{ $item2->discountPercent > 0 ? 'display:initial' : 'display:none' }}">{{ presentPrice($item2->price) }} </del></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-product-list ps-garden-kitchen">
            <div class="ps-container">
                <div class="ps-section__header">
                    <h3>{{ $categories3->name }}</h3>
                    <ul class="ps-section__links">
                        <li><a href="{{ route('shop.index',['category' => $categories3->slug]) }}">View All</a></li>
                    </ul>
                </div>
                <div class="ps-section__content">
                    <div class="ps-carousel--responsive owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                        @foreach ($categoryProduct3 as $item3)
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="{{ route('shop.show', $item3->slug) }}"><img src="{{ productImage($item3->image) }}" alt="{{ $item3->name }}"></a>
                                    @if ($item3->quantity == 0)
                                        <div class="ps-product__badge out-stock" style="{{ $item3->quantity == 0 ? 'display:initial': 'display:none' }}">Out Of Stock</div>
                                    @endif
                                    @if ($item3->discountPercent != null)
                                        <div class="ps-product__badge" style="{{ $item3->discountPercent != null & $item3->quantity != 0 ? 'display:initial': 'display:none' }}">-{{ $item3->discountPercent }}%</div>
                                    @endif
                                    @if ($item3->quantity <= 2)
                                    <div class="ps-product__badge hot" style="{{ $item3->quantity <= 2 & $item3->discountPercent == null & $item3->quantity != 0 ? 'display:initial': 'display:none' }}">hot</div>
                                    @endif
                                    <ul class="ps-product__actions">
                                        <li><a href="{{ route('shop.show', $item3->slug) }}" data-toggle="tooltip" data-placement="top" title="ကြည့်ရန်"><i class="icon-bag2"></i></a></li>
                                        <li><a href="{{ route('shop.show', $item3->slug) }}" data-placement="top" title="အမြန်ကြည့်ရန်" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                        <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                            <input type="hidden" name="id" value="{{ $item3->id }}">
                                            <input type="hidden" name="name" value="{{ $item3->name }}">
                                            <input type="hidden" name="price" value="{{ $item3->price * (1 - $item3->discountPercent / 100) }}">
                                            <li><button href="" data-toggle="tooltip" data-placement="top" title="ခြင်းထဲထည့်ရန်"><i class="icon-heart"></i></button></li>	
                                        </form>
                                    </ul>
                                </div>
                                <div class="ps-product__container">
                                    <div class="ps-product__content"><a class="ps-product__title" href="{{ route('shop.show', $item3->slug) }}">{{ $item3->name }}</a>
                                        <p class="ps-product__price sale">{{ presentPrice($item3->price * (1 - $item3->discountPercent / 100)) }} <del style="{{ $item3->discountPercent > 0 ? 'display:initial' : 'display:none' }}">{{ presentPrice($item3->price) }} </del></p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="{{ route('shop.show', $item3->slug) }}">{{ $item3->name }}</a>
                                        <p class="ps-product__price sale">{{ presentPrice($item3->price * (1 - $item3->discountPercent / 100)) }} <del style="{{ $item3->discountPercent > 0 ? 'display:initial' : 'display:none' }}">{{ presentPrice($item3->price) }} </del></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="ps-download-app">
            <div class="ps-container">
                <div class="ps-block--download-app">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                <div class="ps-block__thumbnail"><img src="{{ asset('img/app.png') }}" alt="app.png"></div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                <div class="ps-block__content">
                                    <h3>Download Zay Min Htet App Now!</h3>
                                    <p>လျင်မြန်လွယ်ကူစွာနဲ့ဈေးဝယ်နိုင်ရန်အတွက်ကျွန်တော်တို့applicationကိုdownloadဆွဲလိုက်ပါ။</p>
                                    <p class="download-link"><a href="https://play.google.com/store/apps/details?id=com.zayminhtet.coltd.user"><img src="img/google-play.png" alt="" style="margin-left:27%"></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="ps-product-list ps-new-arrivals">
            <div class="ps-container">
                <div class="ps-section__header">
                    <h3>အသစ်ဝင်ပစ္စည်းများ</h3>
                    <ul class="ps-section__links">
                        <li><a href="{{ route('shop.index') }}">View All</a></li>
                    </ul>
                </div>
                <div class="ps-section__content">
                    <div class="row">
                        @foreach ($latestItems as $latestItem)
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 ">
                                <div class="ps-product--horizontal">
                                    <div class="ps-product__thumbnail" style="height: 75px">
                                        <a href="{{ route('shop.show', $latestItem->slug) }}"><img src="{{ productImage($latestItem->image) }}" alt="{{ $latestItem->name }}" height="75px"></a>
                                    </div>
                                    <div class="ps-product__content"><a class="ps-product__title" href="{{ route('shop.show', $latestItem->slug) }}">{{ $latestItem->name }}</a>
                                        <p class="ps-product__price">{{ presentPrice($latestItem->price) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')

    