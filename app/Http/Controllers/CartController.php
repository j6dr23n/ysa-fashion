<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart')->with([
            'discount' =>$this->getNumbers()->get('discount'),
            'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
            'newTotal' => $this->getNumbers()->get('newTotal'),
        ]); 
    }

    public function saveCart()
    {
        return view('savecart')->with([
            
        ]);
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
        $duplicates = Cart::search(function($cartItem,$rowID) use ($request){
            return $cartItem->id === $request->id;
        });
        
        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message','This item is already in your cart.');
        }

        Cart::add(['id' => $request->id, 'name' => $request->name,'qty' => 1, 'price' => $request->price,'weight' => 550,'options' => ['color' => $request->color,'size' => $request->size]])
              ->associate('App\Models\Product');

        return redirect()->route('cart.index')->with('success_message','Item added');
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
        $validator= Validator::make($request->all(),[
            'quantity' => 'required|numeric|between:1,5',
        ]);

        if($validator->fails()){
            session()->flash('errors',collect(['Quantity must betweeb 1 to 5.']));

            return response()->json(['success' => false], 400);
        }

        if($request->quantity > $request->productQuantity){
            session()->flash('errors',collect(['We are currently unavailibly']));

            return response()->json(['success' => false], 400);
        }

        Cart::update($id,$request->quantity,$request->color);

        session()->flash('success_message','Quantity Updated');

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return back()->with('success_message','Item Removed');
    }

    /**
     * Switch item to save cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToSaveCart($id)
    {
        $item = Cart::get($id);

        Cart::remove($id);

        $duplicates = Cart::instance('saveCart')->search(function( $cartItem, $rowId) use ($id){
            return $rowId === $id;
        });
        
        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.save')->with('success_message','This item already in your cart.');
        }

        Cart::instance('saveCart')->add($item->id, $item->name,1,$item->price)
              ->associate('App\Models\Product');

        return redirect()->route('cart.save')->with('success_message','Item added');
    }

    private function getNumbers()
    {
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = (Cart::subtotal() - $discount);
        if($newSubtotal < 0){
            $newSubtotal = 0;
        }
        $newTotal = $newSubtotal;
        return collect([
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTotal' => $newTotal,
        ]); 
    }
}
