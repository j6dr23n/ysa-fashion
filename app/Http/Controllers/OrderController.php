<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:120',
            'address' => 'required',
            'ph_number' => 'required|min:11|numeric',
        ]);
        //check race condition when there are lsee items available to purchase
        if($this->productAreNotLongerAvailable()){
            return back()->withErrors('Sorry! One of the item in your cart is no longer available.');
        }
        $user = Auth::user();

        $order = $this->addToOrderTables($user,null);

        //decrease the quantity of all the products in the cart
        $this->decreaseQuantity();
        
        //Successful
        Cart::instance('default')->destroy();
        session()->forget('coupon');

        return redirect()->route('confirmation.index')->with('success_message','Thanks you! Your order has been successfully accepted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function addToOrderTables($user,$error)
    {
        //Insert into order table
        $order = Order::create([
            'user_id' => $user->id,
            'name' => request()->name,
            'ph_number'=> request()->ph_number,
            'address' => request()->address,
            'discount' => $this->getNumbers()->get('discount'),
            'discount_code' => $this->getNumbers()->get('discount_code'),
            'subtotal' => $this->getNumbers()->get('newSubtotal'),
            'total' => $this->getNumbers()->get('newTotal'),
            'error'=> $error,

        ]);
        //insert into order_product table
        foreach(Cart::content() as $item){
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
                'color' => $item->options->color,
                'size' => $item->options->size
            ]);
        }

        return $order;
    }

    private function getNumbers()
    {
        $discount = session()->get('coupon')['discount'] ?? 0;
        $discount_code = session()->get('coupon')['name'] ?? null;
        $newSubtotal = (Cart::subtotal() - $discount );
        $newTotal = $newSubtotal;
        return collect([
            'discount' => $discount,
            'discount_code' => $discount_code,
            'newSubtotal' => $newSubtotal,
            'newTotal' => $newTotal,
        ]); 
    }

    protected function decreaseQuantity()
    {
        foreach(Cart::content() as $item){
            $product = Product::find($item->model->id);


            $product->update(['quantity' => $product->quantity - $item->qty]);
        }
    }

    protected function productAreNotLongerAvailable()
    {
        foreach(Cart::content() as $item){
            $product = Product::find($item->model->id);
            if($product->quantity < $item->qty){
                return true;
            }
        }

        return false;
    }
}
