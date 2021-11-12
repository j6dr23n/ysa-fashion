@extends('layout')

@section('title', 'Cart')

@section('extra-css')

@endsection

@section('content')
    <div class="ps-page--simple">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index.page') }}">Home</a></li>
                    <li><a href="{{ route('shop.index') }}">Shop</a></li>
                    <li>Cart</li>
                </ul>
            </div>
        </div>
        <div class="ps-section--shopping ps-shopping-cart">
            <div class="container-fluid">
                <div class="ps-section__header">
                    <h1>Cart({{ Cart::count() }})</h1>
                    <br>
                    @if (session()->has('success_message'))
                        <div class="alert alert-success">
                            {{ session()->get('success_message') }}
                        </div>
                    @endif

                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                @if(Cart::count() > 0)
                <div class="ps-section__content">
                    <div class="table-responsive">
                        <table class="table ps-table--shopping-cart">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    {{-- <th>ရွှေးချယ်ထားရန်</th> --}}
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Totals</th>
                                    <th><i class="icon-cross"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $item)
                                @php
                                    $color = $item->model->color_name;
                                    $product_color = explode(',',$color);
                                @endphp
                                    <tr>
                                        <td>
                                            <div class="ps-product--cart">
                                                <div class="ps-product__thumbnail"><a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ productImage($item->model->image)}}" alt=""></a></div>
                                                <div class="ps-product__content"><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                                            </div>
                                        </td>
                                        <td class="price" style="text-align: center;">{{ $item->model->presentPrice() }}</td>
                                        <td style="text-align: center;">
                                            <select class="cart_quantity_select" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
                                                @for($i = 1; $i < $item->model->quantity + 1 ; $i++)
                                                <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td style="text-align: center;">
                                            <p>{{ucwords($item->options->color)}}</p>
                                        </td>
                                        <td style="text-align: center;">
                                            <p>{{ucwords($item->options->size)}}</p>
                                        </td>
                                        <td style="text-align: center;">{{ presentPrice($item->subtotal()) }} {{ $item->model->discountPercent > 0 ? '(-'.$item->model->discountPercent.'%)' : '' }}</td>
                                        <td>
                                            <form action="{{ route('cart.destroy',$item->rowId) }}" method="POST">
                                            @csrf
                                            @method('DELETE') 
                                                <button type="submit" class="cross-button"><i class="icon-cross"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @else				
                                    <h3 style="text-align:center;color:red;font-weight:bold;border:4px double black;padding:20px;">Nothing in cart.</h3>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="ps-section__cart-actions"><a class="ps-btn" href="{{ route('shop.index') }}"><i class="icon-arrow-left"></i> Back to Shop</a></div>
                </div>
                <div class="ps-section__footer">
                    <div class="row">
                        @if (session()->has('coupon'))
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                <form action="{{ route('coupon.store') }}" method="POST">
                                @csrf
                                    <figure>
                                        <figcaption>Coupon Has Been Applied!!</figcaption>
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Coupon Code - ({{ session()->get('coupon')['name'] }})" name="coupon_code" disabled>
                                        </div>
                                    </figure>
                                </form>
                            </div>
                        @endif
                            @if (! session()->has('coupon'))
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                <form action="{{ route('coupon.store') }}" method="POST">
                                @csrf
                                    <figure>
                                        <figcaption>Coupon Discount</figcaption>
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Enter Coupon Here!!!" name="coupon_code">
                                        </div>
                                        <div class="form-group">
                                            <button class="ps-btn ps-btn--outline">Apply</button>
                                        </div>
                                    </figure>
                                </form>
                            </div>
                            @endif
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                            <div class="ps-block--shopping-total">
                                @if (session()->has('coupon'))
                                <div style="border-bottom:1px solid #ccc;">
                                    <div class="ps-block__header">
                                        <p style="display: inline;font-size:16px;">Discount ({{ session()->get('coupon')['name'] }}) :
                                            <span>
                                                <form action="{{ route('coupon.destroy') }}" method="POST" style="padding:10px 0;">
                                                @csrf
                                                @method('DELETE')
                                                    <button type="submit" class="btn" style="color:red;font-size:12px;border:2px solid red;">Remove</button> 
                                                </form>
                                                - {{ presentPrice($discount) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                @endif
                                <div class="ps-block__header" style="padding-top:10px;">
                                    <p>Total Quantity <span>{{ Cart::count() > 0 ? Cart::count() : 0 }}</span></p>
                                </div>
                                <div class="ps-block__content">
                                    <h3>Totals  <span>{{ presentPrice($newTotal) }}</span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                            <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Full Name*" name="name" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Phone*" name="ph_number" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Address*" name="address" required>
                                </div>
                                <h3 class="mt-40"> Addition information</h3>
                                <div class="form-group">
                                    <label>Order Notes</label>
                                    <div class="form-group__content">
                                        <textarea class="form-control" name="order_notes" rows="7" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                                <button class="ps-btn ps-btn--fullwidth" type="submit" >Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
<script src="{{ asset('js/app.js') }}"></script>
<script>
	(function(){
		const classname = document.querySelectorAll('.cart_quantity_select')

		Array.from(classname).forEach(function(element){
			element.addEventListener('change',function(){
				const id = element.getAttribute('data-id')
				const productQuantity = element.getAttribute('data-productQuantity')

				axios.patch(`/cart/${id}`, {
					quantity : this.value,
					productQuantity : productQuantity
				})
				.then(function (response) {
					// console.log(response);
					window.location.href = '{{ route('cart.index') }}'
				})
				.catch(function (error) {
					//console.log(error);
					window.location.href = '{{ route('cart.index') }}'
				});
			})
		})
	})();
</script>
@endsection