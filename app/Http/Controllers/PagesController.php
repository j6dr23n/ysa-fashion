<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class PagesController extends Controller
{
    public function contactUs()
    {
        return view('pages.contact-us');
    }

    public function aboutUs()
    {
        $users = User::get();
        $products = Product::all();
        return view('pages.about-us')->with([
            'products' => $products,
            'users' => $users
        ]);
    }

    public function commingSoon()
    {
        if(session()->has('user')){
            $number = session()->get('user')['NationalNumber'];
            $user = BasicUser::where('NationalNumber',$number)->first();

            return view('pages.comming-soon')->with([
                'user' => $user,
            ]);
        }else{
            return redirect()->route('user.login')->withErrors('အကောင့်ဝင်ရန်လိုအပ်ပါသည်။');
        }
    }

    public function faqs()
    {
        if(session()->has('user')){
            $number = session()->get('user')['NationalNumber'];
            $user = BasicUser::where('NationalNumber',$number)->first();

            return view('pages.faqs')->with([
                'user' => $user,
            ]);
        }else{
            return redirect()->route('user.login')->withErrors('အကောင့်ဝင်ရန်လိုအပ်ပါသည်။');
        }
    }
}
