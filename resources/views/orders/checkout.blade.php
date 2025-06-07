// resources/views/orders/checkout.blade.php
@include('components.header')
{{-- @section('content') --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Checkout</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Shipping Details</h4>
                                <div class="form-group">
                                    <label for="shipping_fullname">Full Name</label>
                                    <input type="text" class="form-control" id="shipping_fullname" name="shipping_fullname" required value="{{ Auth::user()->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="shipping_address">Address</label>
                                    <input type="text" class="form-control" id="shipping_address" name="shipping_address" required>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="shipping_city">City</label>
                                        <input type="text" class="form-control" id="shipping_city" name="shipping_city" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="shipping_state">State</label>
                                        <input type="text" class="form-control" id="shipping_state" name="shipping_state" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="shipping_zipcode">Zip Code</label>
                                        <input type="text" class="form-control" id="shipping_zipcode" name="shipping_zipcode" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="shipping_phone">Phone</label>
                                    <input type="text" class="form-control" id="shipping_phone" name="shipping_phone" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h4>Billing Details</h4>
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="billing_same" name="billing_same" checked>
                                    <label class="form-check-label" for="billing_same">Same as shipping details</label>
                                </div>

                                <div id="billing-details" style="display: none;">
                                    <div class="form-group">
                                        <label for="billing_fullname">Full Name</label>
                                        <input type="text" class="form-control" id="billing_fullname" name="billing_fullname">
                                    </div>

                                    <div class="form-group">
                                        <label for="billing_address">Address</label>
                                        <input type="text" class="form-control" id="billing_address" name="billing_address">
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="billing_city">City</label>
                                            <input type="text" class="form-control" id="billing_city" name="billing_city">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="billing_state">State</label>
                                            <input type="text" class="form-control" id="billing_state" name="billing_state">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="billing_zipcode">Zip Code</label>
                                            <input type="text" class="form-control" id="billing_zipcode" name="billing_zipcode">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="billing_phone">Phone</label>
                                        <input type="text" class="form-control" id="billing_phone" name="billing_phone">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h4>Payment Method</h4>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery" checked>
                                        <label class="form-check-label" for="cash_on_delivery">
                                            Cash on Delivery
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal">
                                        <label class="form-check-label" for="paypal">
                                            PayPal
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="stripe" value="stripe">
                                        <label class="form-check-label" for="stripe">
                                            Credit Card (Stripe)
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="notes">Order Notes (Optional)</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h4>Order Summary</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(session('cart') as $id => $item)
                                                <tr>
                                                    <td>{{ $item['name'] }}</td>
                                                    <td>{{ $item['quantity'] }}</td>
                                                    <td>${{ number_format($item['price'], 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2">Subtotal</th>
                                                <td>${{ number_format($subtotal, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="2">Shipping</th>
                                                <td>$0.00</td>
                                            </tr>
                                            <tr>
                                                <th colspan="2">Total</th>
                                                <td>${{ number_format($subtotal, 2) }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg btn-block">Place Order</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('billing_same').addEventListener('change', function() {
        const billingDetails = document.getElementById('billing-details');
        if (this.checked) {
            billingDetails.style.display = 'none';
        } else {
            billingDetails.style.display = 'block';
        }
    });
</script>
@include('components.footer')