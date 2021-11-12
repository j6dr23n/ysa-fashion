@extends('layout')

@section('title', 'Profile')

@section('extra-css')

@endsection

@section('content')
    <main class="ps-page--my-account">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index.page') }}">Home</a></li>
                    <li>Account</li>
                </ul>
            </div>
        </div>
        <section class="ps-section--account">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ps-section__left">
                            <aside class="ps-widget--account-dashboard">
                                <div class="ps-widget__header"><img src="{{ $user->avatar != null ? $user->avatar : 'img/users/3.jpg' }}" alt="">
                                    <figure>
                                        <figcaption>{{ $user->name }}</figcaption>
                                        <p>{{ $user->email }}</p>
                                    </figure>
                                </div>
                                <div class="ps-widget__content">
                                    <ul class="ps-tab-list">
                                        <li class="active"><a href="#profile"><i class="icon-user"></i> Account</a></li>
                                        <li><a href="#invoices"><i class="icon-papers"></i> Orders</a></li>
                                        {{-- <li><a href="#whishlist"><i class="icon-heart"></i> ရွှေးချယ်ပစ္စည်း</a></li> --}}
                                        <li>
                                            <a href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-size:16px;">
                                                <i class="icon-power-switch"></i> Logout
                                            </a>
                
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </div>
                    <div class="ps-tabs col-lg-8">
                        <div class="ps-section__right ps-tab active" id="profile">
                            
                            {{-- @if ($user->Username == null)
                            <form class="ps-form--account-setting" action="" method="POST">
                            @csrf
                                <div class="ps-form__header">
                                    <br>
                                    <p style="font-size:medium;background-color:black;color:red;font-weight:bold;text-align:center;border-radius: 20px;padding:15px 15px;">Create New Account!!!</p>
                                    <br>
                                    <h3>Login Creditionals</h3>
                                    @if (session()->has('success_message_login'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success_message_login') }}
                                        </div>
                                    @endif
                                    @if(count($errors) > 0)
                                    <div class="alert alert-danger" style="height:50px;">
                                        <ul style="list-style-type: none;">
                                        @foreach ($errors->all() as $error)
                                            <li style="text-align: center">{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                                <div class="ps-form__content">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" name="Username" type="text" value="{{ old('Username') }}" placeholder="Please enter your Username...">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control" name="Password" type="password" placeholder="Please enter your password...">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input class="form-control" name="ConfirmPassword" type="password" placeholder="Please enter your password again...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group submit">
                                    <button class="ps-btn" type="submit">Create</button>
                                </div>
                            </form>
                            <div style="border-top:2px solid black"></div>
                            @endif

                            @if ($user->Username != null)
                            <form class="ps-form--account-setting" action="" method="POST">
                            @csrf
                                <div class="ps-form__header">
                                    <h3>Update Login Creditionals</h3>
                                    @if (session()->has('success_message_login'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success_message_login') }}
                                        </div>
                                    @endif
                                    @if(count($errors) > 0)
                                    <div class="alert alert-danger" style="height:50px;">
                                        <ul style="list-style-type: none;">
                                        @foreach ($errors->all() as $error)
                                            <li style="text-align: center">{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                                <div class="ps-form__content">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" name="Username" type="text" value="{{ old('Username') }}" placeholder="{{ $user->Username }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control" name="Password" type="password" placeholder="Please enter your new password...">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input class="form-control" name="ConfirmPassword" type="password" placeholder="Please enter your new password again...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group submit">
                                    <button class="ps-btn" type="submit">Update</button>
                                </div>
                            </form>
                            <div style="border-top:2px solid black"></div>
                            @endif --}}

                            <form class="ps-form--account-setting" action="{{ route('user.update')}}" method="POST">
                            @csrf
                                <div class="ps-form__header">
                                    <br>
                                    <h3>User Information</h3>
                                    @if (session()->has('success_message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success_message') }}
                                        </div>
                                    @endif
                                    @if(count($errors) > 0)
                                    <div class="alert alert-danger" style="height:50px;">
                                        <ul style="list-style-type: none;">
                                        @foreach ($errors->all() as $error)
                                            <li style="text-align: center">{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                                <div class="ps-form__content">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input class="form-control" name="ph_number" type="text" placeholder="{{ $user->PhNumber != null ? '+95-'.$user->PhNumber : 'Please enter your phone number...' }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input class="form-control" name="address" type="text" placeholder="{{ $user->AddressLine1 != null ? $user->AddressLine1 : 'Please enter your address...' }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Birthday</label>
                                        <input class="form-control" name="birthday" type="date" placeholder="{{ $user->birthday != null ? $user->birthday : 'Please enter your Birthday...' }}">
                                    </div>
                                    <div class="input-group input-group-lg ">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="inputGroupSelect01">Gender</label>
                                        </div>
                                        <select class="custom-select" id="inputGroupSelect01" name="gender">
                                          <option value="female">Female</option>
                                          <option value="male">Male</option>
                                          <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group submit">
                                    <button class="ps-btn" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="ps-section__right ps-tab" id="invoices">
                            <br>
                            <div class="ps-section--account-setting">
                                <div class="ps-section__header">
                                    <h3>Orders</h3>
                                </div>
                                <div class="ps-section__content">
                                    <div class="table-responsive">
                                        <table class="table ps-table ps-table--invoices">
                                            <thead>
                                                <tr>
                                                    <th>Order No.</th>
                                                    <th>Name</th>
                                                    <th>Date</th>
                                                    <th>Color</th>
                                                    <th>Size</th>
                                                    <th>Totals</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td><a href="invoice-detail.html">{{ $order->id }}</a></td>
                                                        <td>
                                                            @foreach ($order->products as $item)
                                                            <a href="{{ route('shop.show', $item->slug) }}">{{ $item->name }}(x{{ $item->pivot->quantity }}) <br></a>
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $order->created_at->toDateString() }}</td>
                                                        <td>
                                                            @foreach ($order->products as $item)
                                                                {{ $item->pivot->color }}
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($order->products as $item)
                                                                {{ $item->pivot->size }}
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $order->total }}</td>
                                                        <td style="background-color: {{ $order->delivered == 1 ? 'green' : 'red' }};font-weight:bold;color:black;text-align:center;">{{ $order->delivered == 1 ? 'Delivered' : 'Not Delivered' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="ps-section__right ps-tab" id="whishlist">
                            <br>
                            @if(Cart::instance('saveCart')->count() > 0)
                            <div class="ps-section__content">
                                <div class="table-responsive">
                                    <table class="table ps-table--whishlist">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>ဓာတ်ပုံပစ္စည်းအမည်</th>
                                                <th>စျေးနှုန်း</th>
                                                <th>အခြေအနေ</th>
                                                <th>ဈေးခြင်းသို့</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (Cart::instance('saveCart')->content() as $item)
                                            <tr>
                                                <td>
                                                    <form action="{{ route('saveCart.destroy',$item->rowId) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE') 
                                                        <button type="submit" class="cross-button"><i class="icon-cross"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <div class="ps-product--cart">
                                                        <div class="ps-product__thumbnail"><a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ productImage($item->model->image)}}" alt="{{ $item->model->name }}"></a></div>
                                                        <div class="ps-product__content"><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                                                    </div>
                                                </td>
                                                <td class="price" style="text-align: center">{{ $item->model->presentPrice() }}</td>
                                                <td style="text-align: center"><span class="ps-tag {{ $item->model->quantity > 0 ? 'ps-tag--in-stock' : 'ps-tag--out-stock' }}">{{ $item->model->quantity > 0 ? 'In Stock' : 'Out Of Stock' }}</span></td>
                                                @if($item->model->quantity > 0)
                                                    <td style="text-align: center">
                                                    <form action="{{ route('cart.store') }}" method="POST">
                                                    @csrf
                                                            <input type="hidden" name="id" value="{{ $item->model->id }}">
                                                            <input type="hidden" name="name" value="{{ $item->model->name }}">
                                                            <input type="hidden" name="price" value="{{ $item->model->price * (1 - $item->model->discountPercent / 100) }}">
                                                            <button class="ps-btn">ခြင်းထဲထည့်ရန်</button>	
                                                    </form>
                                                    </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                            @else				
                                                <h3 style="text-align:center;color:red;font-weight:bold;border:4px double black;padding:20px;">ရွှေးချယ်ထားသောပစ္စည်းမရှိပါ။</h3>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection('content')

@section('extra-js')

@endsection