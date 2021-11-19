    <header class="header header--1" data-sticky="true">
        <div class="header__top">
            <div class="ps-container">
                <div class="header__left">
                    <div class="menu--product-categories">
                        <div class="menu__toggle"><i class="icon-menu"></i><span>Categories</span></div>
                        <div class="menu__content">
                            <ul class="menu--dropdown">
                                @foreach (App\Models\Category::with('childs')->where('p_id',0)->get() as $item)
                                <li class="current-menu-item menu-item-has-children has-mega-menu"><a href="{{ route('shop.index',['category' => $item->slug]) }}"><img src="{{ productImage($item->image) }}" width="25px" height="25px" alt=""> {{ $item->name }}</a>
                                    {{-- <div class="mega-menu">
                                        <div class="mega-menu__column">
                                            <h4><a href="{{ route('shop.index',['category' => $item->slug]) }}">{{ $item->name }}</a><span class="sub-toggle"></span></h4>
                                            <ul class="mega-menu__list">
                                                @foreach ($item->childs as $itemChilds)
                                                <li class="current-menu-item "><a href="{{ route('shop.index',['category' => $itemChilds->slug]) }}">{{ $itemChilds->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div> --}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div><a class="ps-logo" href="{{ route('index.page') }}"><img src="{{ asset('img/bg/logo.png') }}" width="30px" height="30px" alt="" style="margin-right: 5px;"><img src="{{ asset('img/ysa_fashion_typo.png') }}" alt="logo.png" width="35px" height="35px" style="width:70%;"></a>
                </div>
                <div class="header__center">
                    <form class="ps-form--quick-search" action="{{ route('shop.search') }}" method="GET">
                        <input class="form-control" type="text" placeholder="Search..." name="query" value="{{ request()->input('query') }}" id="input-search query">
                        <button>Search</button>
                    </form>
                </div>
                <div class="header__right">
                    <div class="header__actions">
                        {{-- <a class="header__extra" href="{{ route('cart.save') }}"><i class="icon-heart"></i><span><i>{{ Cart::instance('saveCart')->count() }}</i></span></a> --}}
                        <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-bag2"></i><span><i>{{ Cart::instance('default')->count() }}</i></span></a>
                            <div class="ps-cart__content">
                                @foreach (Cart::instance('default')->content() as $item)
                                <div class="ps-cart__items">
                                    <div class="ps-product--cart-mobile">
                                        <div class="ps-product__thumbnail"><a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ productImage($item->model->image) }}" alt="{{ $item->model->name }}"></a></div>
                                        <div class="ps-product__content">
                                            <form action="{{ route('cart.destroy',$item->rowId) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <button class="ps-product__remove" ><i class="icon-cross"></i></button>
                                            </form>
                                            <a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a>
                                            <small>(1 x {{ presentPrice($item->model->price) }})</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="ps-cart__footer">
                                    @if(Cart::instance('default')->count() > 0)
                                    <h3>Sub Total:<strong>{{ presentPrice(Cart::instance('default')->subtotal()) }}</strong></h3>
                                    <figure><a href="#"></a><a class="ps-btn" href="{{ route('cart.index') }}">Go to Cart</a></figure>
                                    @else
                                        <h3 style="text-align:center;color:red;font-weight:bold;margin:30px;">Nothing in Cart</h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="ps-block--user-header">
                            <div class="ps-block__left"><a href="{{ route('profile.index') }}"><i class="icon-user"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navigation">
            <div class="ps-container">
                <div class="navigation__left">
                    <div class="menu--product-categories">
                        <div class="menu__toggle"><i class="icon-menu"></i><span>Categories</span></div>
                        <div class="menu__content">
                            <ul class="menu--dropdown">
                                @foreach (App\Models\Category::with('childs')->where('p_id',0)->get() as $item)
                                <li class="current-menu-item menu-item-has-children has-mega-menu"><a href="{{ route('shop.index',['category' => $item->slug]) }}"><img src="{{ productImage($item->image) }}" width="25px" height="25px" alt=""> {{ $item->name }}</a>
                                    {{-- <div class="mega-menu">
                                        <div class="mega-menu__column">
                                            <h4><a href="{{ route('shop.index',['category' => $item->slug]) }}" style="font-weight: bolder;">{{ $item->name }}</a></h4>
                                            <ul class="mega-menu__list">
                                                @foreach ($item->childs as $itemChilds)
                                                <li class="current-menu-item "><a href="{{ route('shop.index',['category' => $itemChilds->slug]) }}">{{ $itemChilds->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div> --}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="navigation__right">
                    <ul class="menu">
                        <li class="menu-item-has-children"></li>
                        <li class="menu-item-has-children has-mega-menu"></li>
                        <li class="menu-item-has-children has-mega-menu"></li>
                    </ul>
                    <ul class="navigation__extra">
                        <li><a href="{{ route('index.page') }}">Home</a></li>
                        <li><a href="{{ route('shop.index') }}">Shop</a></li>
                        <li><a href="{{ route('pages.contactUs') }}">Contact</a></li>
                        @guest
                        <li><a href="/login">Account</a></li>
                        @else
                            <a href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-size:16px;">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                {{ csrf_field() }}
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <header class="header header--mobile" data-sticky="true">
        <div class="navigation--mobile">
            <div class="navigation__left"><a class="ps-logo" href="{{ route('index.page') }}"><img src="{{ asset('img/bg/logo.png') }}" width="30px" height="30px" alt="" style="margin-right: 5px;"><img src="{{ asset('img/ysa_fashion_typo.png') }}" alt="logo.png" width="35px" height="35px" style="width:70%;"></a></div>
            <div class="navigation__right">
                <div class="header__actions">
                    <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-bag2"></i><span><i>{{ Cart::instance('default')->count() }}</i></span></a>
                        <div class="ps-cart__content">
                            <div class="ps-cart__items">
                                @foreach (Cart::instance('default')->content() as $item)
                                    <div class="ps-product--cart-mobile">
                                        <div class="ps-product__thumbnail"><a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ productImage($item->model->image) }}" alt="{{ $item->model->name }}"></a></div>
                                        <div class="ps-product__content">
                                            <form action="{{ route('cart.destroy',$item->rowId) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <button class="ps-product__remove" ><i class="icon-cross"></i></button>
                                            </form>
                                            <a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a>
                                            
                                            <small>1 x {{ presentPrice($item->model->price) }} (-{{ $item->model->discountPercent > 0 ? $item->model->discountPercent : '0'  }}%)</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="ps-cart__footer">
                                @if(Cart::instance('default')->count() > 0)
                                <h3>Sub Total:<strong>{{ presentPrice(Cart::subtotal()) }}</strong></h3>
                                <figure><a href="#"></a><a class="ps-btn" href="{{ route('cart.index') }}">Add to Cart</a></figure>
                                @else
                                    <h3 style="text-align:center;color:red;font-weight:bold;">Nothing In Cart</h3>
                                @endif
                            </div>         
                        </div>
                    </div>
                    <div class="ps-block--user-header">
                        <div class="ps-block__left"><a href="{{ route('profile.index') }}"><i class="icon-user"></i></a></div>
                        <div class="ps-block__right"><a href="{{ route('profile.index') }}" style="text-align: center;">My</a><a href="{{ route('profile.index') }}">Account</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-search--mobile">
            <form class="ps-form--search-mobile" action="{{ route('shop.search') }}" method="GET">
                <div class="form-group--nest">
                    <input class="form-control" type="text" placeholder="Seacrh..." name="query" value="{{ request()->input('query') }}" id="query">
                    <button type="submit"><i class="icon-magnifier"></i></button>
                </div>
            </form>
        </div>
    </header>