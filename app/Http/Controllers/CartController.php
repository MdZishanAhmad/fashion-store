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
        $product = Product::with('category')->findOrFail($id);
        return view('details', compact('product'));
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
    $customerId = Auth::id();

    $cartItems = Cart::with('product')
        ->where('customerId', $customerId)
        ->get()
        ->filter(function ($cart) {
            return $cart->product !== null; // Only keep cart items with valid products
        });

    return view('shopping-cart', compact('cartItems'));
}
public function delete($id)
{
    $item=Cart::findorFail($id);
    $item->delete();
    return redirect()->back()->with('success','1 Item has been deleted from cart ');

}

public function update(Request $request, $id)
{
    $cart = Cart::findOrFail($id);
    $cart->quantity = $request->input('quantity');
    $cart->save();

    return response()->json(['status' => 'success', 'message' => 'Cart updated']);
}

}
