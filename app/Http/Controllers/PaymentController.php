<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function payfom()
    {
        $userId = Auth::id(); // get the currently logged-in user's ID

        // Fetch cart items with related product data
        $cartItems = Cart::with('product')->where('customerId', $userId)->get();

        // Calculate total cart amount
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // eSewa payment setup
        $product_id = uniqid(); // unique transaction ID
        $amount = $totalAmount;
        $tax_amount = 0;
        $service_charge = 0;
        $delivery_charge = 0;
        $merchant_code = 'EPAYTEST'; // for test environment
        $success_url = route('payment.success');
        $failure_url = route('payment.failure');

        // eSewa V2 signature generation
        $message = "total_amount={$amount},transaction_uuid={$product_id},product_code={$merchant_code}";
        $secret = '8gBm/:&EnhH.1/q';
        $hash = base64_encode(hash_hmac('sha256', $message, $secret, true));

        return view('esewa', [
            'amount' => $amount,
            'product_id' => $product_id,
            'merchant_code' => $merchant_code,
            'service_charge' => $service_charge,
            'delivery_charge' => $delivery_charge,
            'success_url' => $success_url,
            'failure_url' => $failure_url,
            'signature' => $hash
        ]);
    }


    public function pay(Request $request)
    {
        $product_id = uniqid(); // generate unique ID
        $amount = 100;
        $tax_amount = 0;
        $service_charge = 0;
        $delivery_charge = 0;
        $merchant_code = 'EPAYTEST'; // change to your actual code
        $success_url = route('payment.success');
        $failure_url = route('payment.failure');

        $message = "total_amount={$amount},transaction_uuid={$product_id},product_code={$merchant_code},product_service_charge={$service_charge},product_delivery_charge={$delivery_charge},success_url={$success_url},failure_url={$failure_url}";

        $secret = '8gBm/ZN6c4zFqNWjGw5Q'; // Your actual secret key from eSewa

        $hash = base64_encode(hash_hmac('sha256', $message, $secret, true));

        return view('esewa', [
            'amount' => $amount,
            'product_id' => $product_id,
            'merchant_code' => $merchant_code,
            'service_charge' => $service_charge,
            'delivery_charge' => $delivery_charge,
            'success_url' => $success_url,
            'failure_url' => $failure_url,
            'signature' => $hash
        ]);
    }

    public function success(Request $request)
    {
        return "Payment was successful. Data: " . json_encode($request->all());
    }

    public function failure(Request $request)
    {
        return "Payment failed. Data: " . json_encode($request->all());
    }
}
