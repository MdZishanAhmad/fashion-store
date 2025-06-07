<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $customerId = Auth::id();

    $cartItems = Cart::with('product')
        ->where('customerId', $customerId)
        ->get()
        ->filter(function ($cart) {
            return $cart->product !== null;
        });

    // Calculate totals
    $subtotal = $cartItems->sum(function ($item) {
        return $item->quantity * $item->product->price;
    });

    $shippingFee = 100; // Fixed shipping fee
    $tax = 150; // Fixed tax or calculate based on subtotal if needed
    $total = $subtotal + $shippingFee + $tax;

    return view('checkout', compact('cartItems', 'subtotal', 'shippingFee', 'tax', 'total'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
