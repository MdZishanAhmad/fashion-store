<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{

    public function carts($id)
    {
        // dd($id);
        $product = Product::find($id);
        return view('shop-details', compact('product'));
    }

    public function addToCart(Request $data, $id)
    {
        $user = Auth::user();
        $item = new Cart();
        $item->quantity = $data->input('quantity');
        $item->productId = $id;
        $item->customerId = $user->id;
        $item->save();
        return redirect()->back()->with('success', 'Congratulation! Item added into cart');
    }
    public function fetchUserCart()
    {
        $cartItems = Cart::with(['customer', 'product'])
            ->where('customerId', Auth::id())
            ->get();
    
        // Check if cart is empty
        if ($cartItems->isEmpty()) {
            return view('shopping-cart')->with('message', 'Your cart is empty');
        }
    
        // Check if any cart item has null product
        if ($cartItems->contains(function ($item) {
            return is_null($item->product);
        })) {
            // Handle cases where products were deleted
        }
    
        return view('shopping-cart', compact('cartItems'));
    }
}
