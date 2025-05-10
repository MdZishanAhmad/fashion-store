<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CartController extends Controller
{
    
    public function carts($id){
        // dd($id);
        $product = Product::find($id);
        return view('shop-details', compact('product'));

    }

    public function addToCart(Request $data, $id){
        $user = Auth::user();
       
        $item=new Cart();
        $item->quantity=$data->input('quantity');
        $item->productId=$id;
        $item->customerId=$user->id;
        $item->save();
        return redirect()->back()->with('success','Congratulation! Item added into cart');
         }
      
    
}
 