<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\RedirectController;


class HomeController extends Controller
{
    public function user(){
        return view("components.index");
    }
    public function index(){
        // return view("user.home");
        return view("index");
    }
    public function cart(){
        return view("shopping-cart");
    }
    public function shop(){
        return view("shop");
    }
    public function checkout(){
        return view("checkout");
    }
    public function shopdetails(){
        return view("shop-details");
    }

    public function contacts(){
        return view("contact");
    }
    public function card(){
        $products = Product::all();
        return view('shop', compact('products'));

    }
    
}
