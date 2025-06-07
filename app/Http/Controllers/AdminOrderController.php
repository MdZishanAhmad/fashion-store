<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.Order.index', compact('orders'));
    }

    public function pending()
    {
        $orders = Order::where('status', 'pending')->with('user')->latest()->paginate(10);
        return view('admin.Order.index', compact('orders'));
    }

    public function accepted()
    {
        $orders = Order::where('status', 'accepted')->with('user')->latest()->paginate(10);
        return view('admin.Order.index', compact('orders'));
    }

    public function rejected()
    {
        $orders = Order::where('status', 'rejected')->with('user')->latest()->paginate(10);
        return view('admin.Order.index', compact('orders'));
    }

    public function accept(Order $order)
    {
        $order->update(['status' => 'accepted']);
        return back()->with('success', 'Order accepted');
    }

    public function reject(Order $order)
    {
        $order->update(['status' => 'rejected']);
        return back()->with('success', 'Order rejected');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Order deleted');
    }

    public function show(Order $order)
    {
        return view('admin.Order.show', compact('order'));
    }

    public function delivered()
    {
        $orders = Order::where('status', 'delivered')->with('user')->latest()->paginate(10);
        return view('admin.Order.index', compact('orders'));
    }

    public function markAsDelivered(Order $order)
    {
        $order->update([
            'status' => 'delivered',
            'is_paid' => true  // Set payment status to paid when delivered
        ]);
        return back()->with('success', 'Order delivered');
    }
}
