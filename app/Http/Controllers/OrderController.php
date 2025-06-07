<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Cart;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $orders = Order::withCount('items')
              ->where('customerId', Auth::id())
              ->latest()
              ->paginate(10); // Paginate with 10 orders per page
    
    return view('orders.index', compact('orders'));
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
    // public function store(Request $request)
    // {
    //         $customerId = Auth::id();

    //     $cart= Cart::findOrFail($customerId);
    //     if (empty($cart)){
    //         return redirect ()->back()->with('error','Your cart is empty');

    //     }
    //     $order=new Order();
    //     $order->customerId=Auth::id();
    //     $order->order_number='ORD-'. strtoupper(Str::random( 10));
    //     $order->status = 'pending';
    //     $order->grand_total = $this->getCartTotal($cart);
    //     $order->item_count = $this->getCartItemCount($cart);
    //     $order->payment_method = $request->payment_method;
    //     $order->save();
    //     // Save order items
    //     foreach ($cart as $id => $item) {
    //         $orderItem = new OrderItem();
    //         $orderItem->order_id = $order->id;
    //         $orderItem->productId = $id;
    //         $orderItem->quantity = $item['quantity'];
    //         $orderItem->price = $item['price'];
    //         $orderItem->save();

            
    //     }
    // }
    //     private function getCartTotal($cart)
    // {
    //     $total = 0;
    //     foreach ($cart as $item) {
    //         $total += $item['price'] * $item['quantity'];
    //     }
    //     return $total;
    // }

//     public function store(Request $request)
// {
//     $customerId = Auth::id();
    
//     // Get cart items
//     $cartItems = Cart::with('product')
//         ->where('customerId', $customerId)
//         ->get()
//         ->filter(function ($cart) {
//             return $cart->product !== null;
//         });

//     // Create order
//     $order = Order::create([
//         'customerId' => $customerId,
//         'order_number' => 'ORD-' . strtoupper(uniqid()),
//         'status' => 'pending',
//         'grand_total' => $request->grand_total,
//         'item_count' => $request->item_count,
//         'is_paid' => false,
//         'payment_method' => $request->payment_method ?? 'cod',
//     ]);

//     // Create order items
//     foreach ($cartItems as $item) {
//         OrderItem::create([
//             'order_id' => $order->id,
//             'productId' => $item->productId,
//             'quantity' => $item->quantity,
//             'price' => $item->product->price,
//         ]);
//     }

//     // Clear the cart
//     Cart::where('customerId', $customerId)->delete();

//     return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
// }
public function store(Request $request)
{
    $customerId = Auth::id();
    
    // Get cart items
    $cartItems = Cart::with('product')
        ->where('customerId', $customerId)
        ->get()
        ->filter(function ($cart) {
            return $cart->product !== null;
        });

    // Create order
    $order = Order::create([
        'customerId' => $customerId,
        'order_number' => 'ORD-' . strtoupper(uniqid()),
        'status' => 'pending',
        'grand_total' => $request->grand_total,
        'item_count' => $request->item_count,
        'is_paid' => false,
        'payment_method' => $request->payment_method === 'cod' ? 'cash_on_delivery' : $request->payment_method, // Convert 'cod' to 'cash_on_delivery'
    ]);

    // Create order items
    foreach ($cartItems as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'productId' => $item->productId,
            'quantity' => $item->quantity,
            'price' => $item->product->price,
        ]);
    }

    // Clear the cart
    Cart::where('customerId', $customerId)->delete();

    return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
}

    private function getCartItemCount($cart)
    {
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
{
    // Verify the authenticated user owns this order
    if ($order->customerId != Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    // Eager load relationships for better performance
    $order->load([
        'items.product', 
        'user' // If you need user information
    ]);

    return view('orders.show', compact('order'));
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
