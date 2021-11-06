<?php

use App\Http\Controllers\BasicUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaveCartController;
use App\Http\Controllers\ShopController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/home_ysa',[IndexController::class,'index'])->name('index.page');
Route::get('/',[IndexController::class,'index'])->name('index.page');

Route::get('/shop',[ShopController::class,'index'])->name('shop.index');
Route::get('/promotion',[ShopController::class,'promotion'])->name('promotion.index');

Route::get('/shop/{product}',[ShopController::class,'show'])->name('shop.show');

// Route::get('/cart',[CartController::class,'index'])->name('cart.index');
// Route::get('/saveCart',[CartController::class,'saveCart'])->name('cart.save');
// Route::post('/cart',[CartController::class,'store'])->name('cart.store');
// Route::patch('/cart/{product}',[CartController::class,'update'])->name('cart.update');
// Route::delete('/cart/{product}',[CartController::class,'destroy'])->name('cart.destroy');
// Route::post('/cart/switchToSaveCart/{product}',[CartController::class,'switchToSaveCart'])->name('cart.switchToSaveCart');

// Route::delete('/saveCart/{product}',[SaveCartController::class,'destroy'])->name('saveCart.destroy');
// Route::post('/saveCart/switchToCart/{product}',[SaveCartController::class,'switchToCart'])->name('saveCart.switchToCart');

Route::get('/search',[ShopController::class,'search'])->name('shop.search');

Route::get('/contact',[PagesController::class,'contactUs'])->name('pages.contactUs');
Route::get('/about',[PagesController::class,'aboutUs'])->name('pages.aboutUs');
Route::get('/comming-soon',[PagesController::class,'commingSoon'])->name('pages.commingSoon');
Route::get('/faqs',[PagesController::class,'faqs'])->name('pages.faqs');

Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

route::get('/empty',function (){
    Cart::instance('saveCart')->destroy();
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/profile',[IndexController::class,'profile'])->name('profile.index');

    Route::get('/thankyou',[ConfirmationController::class,'index'])->name('confirmation.index');

    Route::post('/order',[OrderController::class,'store'])->name('order.store');

    Route::post('/coupon',[CouponsController::class,'store'])->name('coupon.store');
    Route::delete('/coupon',[CouponsController::class,'destroy'])->name('coupon.destroy');
    
    Route::get('/cart',[CartController::class,'index'])->name('cart.index');
    Route::get('/saveCart',[CartController::class,'saveCart'])->name('cart.save');
    Route::post('/cart',[CartController::class,'store'])->name('cart.store');
    Route::patch('/cart/{product}',[CartController::class,'update'])->name('cart.update');
    Route::delete('/cart/{product}',[CartController::class,'destroy'])->name('cart.destroy');
    Route::post('/cart/switchToSaveCart/{product}',[CartController::class,'switchToSaveCart'])->name('cart.switchToSaveCart');

    Route::delete('/saveCart/{product}',[SaveCartController::class,'destroy'])->name('saveCart.destroy');
    Route::post('/saveCart/switchToCart/{product}',[SaveCartController::class,'switchToCart'])->name('saveCart.switchToCart');
});