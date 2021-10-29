<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $products = Product::where('featured',true)->take(12)->get();
            $categories = Category::orderBy('id','desc')->take(8)->get();
            $recommendedItems = Product::inRandomOrder()->take(12)->get();
            $latestItems = Product::orderBy('id','desc')->take(12)->get();
            $categories1 = Category::where('p_id',0)->orderBy('id','desc')->first();
            $categories2 = Category::where('p_id',1)->orderBy('id','desc')->first();
            $categories3 = Category::where('p_id',2)->orderBy('id','desc')->first();
            $promotionsItems = Product::where('promotions',true)->orderBy('id','desc')->take(12)->get();
            $promotion = Promotion::orderBy('id','desc')->take(2)->get();
            
            $categoryProduct1 = Product::with('categories')->whereHas('categories',function (Builder $query) {
                $categories1 = Category::where('p_id',0)->orderBy('id','desc')->first();
                $query->where('slug',$categories1->slug);
            })->take(8)->get();

            $categoryProduct2 = Product::with('categories')->whereHas('categories',function (Builder $query) {
                $categories2 = Category::where('p_id',1)->orderBy('id','desc')->first();
                $query->where('slug',$categories2->slug);
            })->take(8)->get();

            $categoryProduct3 = Product::with('categories')->whereHas('categories',function (Builder $query) {
                $categories3 = Category::where('p_id',2)->orderBy('id','desc')->first();
                $query->where('slug',$categories3->slug);
            })->take(8)->get();

            return view('index')->with([
                'products' =>$products,
                'recommendedItems' => $recommendedItems,
                'latestItems' => $latestItems,
                'categories' => $categories,
                'promotionsItems' => $promotionsItems,
                'promotion' => $promotion,
                'categories1' => $categories1,
                'categories2' => $categories2,
                'categories3' => $categories3,
                'categoryProduct1' => $categoryProduct1,
                'categoryProduct2' => $categoryProduct2,
                'categoryProduct3' => $categoryProduct3,
            ]);
    }

    public function profile()
    {   
        if (Auth::check()) {
            $user = Auth::user();
            $orders = [];
            return view('profile')->with([
                'user' => $user,
                'orders' => $orders,
            ]);
        }
    }
}
