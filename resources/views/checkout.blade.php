@extends('components.main')
@section('title','Checkout')
@section('user-body')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root {
        --primary: #2c3e50;  /* Dark Blue */
        --secondary: #e74c3c;  /* Red */
        --accent: #3498db;  /* Light Blue */
        --light: #f8f9fa;
        --dark: #343a40;
        --success: #2ecc71;
        --warning: #f1c40f;
    }
    
    .checkout-container {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        padding: 2rem;
        margin: 2rem 0;
    }
    
    .section-title {
        color: var(--primary);
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--accent);
    }
    
    .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 0.8rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }
    
    .payment-method {
        background: #fff;
        border: 2px solid #eee;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .payment-method:hover {
        border-color: var(--accent);
        transform: translateY(-2px);
    }
    
    .payment-method.active {
        border-color: var(--accent);
        background-color: rgba(52, 152, 219, 0.05);
    }
    
    .payment-method img {
        height: 30px;
        margin-right: 10px;
    }
    
    .order-summary {
        background: var(--light);
        border-radius: 12px;
        padding: 1.5rem;
    }
    
    .summary-item {
        display: flex;
        justify-content: space-between;
        padding: 0.8rem 0;
        border-bottom: 1px solid #eee;
    }
    
    .summary-item:last-child {
        border-bottom: none;
    }
    
    .total-amount {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--primary);
    }
    
    .btn-checkout {
        background: var(--accent);
        color: white;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 1rem;
    }
    
    .btn-checkout:hover {
        background: var(--primary);
        transform: translateY(-2px);
    }
    
    .cart-item {
        display: flex;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #eee;
    }
    
    .cart-item-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 1rem;
    }
    
    .cart-item-details {
        flex-grow: 1;
    }
    
    .cart-item-title {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }
    
    .cart-item-price {
        color: var(--accent);
        font-weight: 500;
    }
    
    .quantity-badge {
        background: var(--light);
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.9rem;
        color: var(--primary);
    }
    
    .secure-badge {
        display: inline-flex;
        align-items: center;
        background: var(--success);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        margin-top: 1rem;
    }
    
    .secure-badge i {
        margin-right: 0.5rem;
    }
    
    .form-label {
        font-weight: 500;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }
    
    .required-field::after {
        content: '*';
        color: var(--secondary);
        margin-left: 4px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="checkout-container">
                <h2 class="text-center mb-4">Complete Your Order</h2>
                
                <form action="{{ route('orders.store') }}" method="POST" id="checkoutForm">
                    @csrf
                    <div class="row">
                        <!-- Billing Information -->
                        <div class="col-md-7">
                            <div class="section-title">
                                <i class="fas fa-user me-2"></i>Billing Information
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="first_name" 
                                           value="{{ Auth::user()->first_name ?? '' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="last_name" 
                                           value="{{ Auth::user()->last_name ?? '' }}" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label required-field">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ Auth::user()->email ?? '' }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label required-field">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" 
                                       value="{{ Auth::user()->phone ?? '' }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label required-field">Address</label>
                                <input type="text" class="form-control" id="address" name="address" 
                                       value="{{ Auth::user()->address ?? '' }}" required>
                            </div>
                            
                            <!-- Payment Method -->
                            <div class="section-title mt-4">
                                <i class="fas fa-credit-card me-2"></i>Payment Method
                            </div>
                            
                            <a href="#">
                            <div class="payment-method active">
                                <div class="form-check">
                                    <label class="form-check-label fw-bold" for="cash_on_delivery">
                                        <i class="fas fa-money-bill-wave me-2"></i>Cash on Delivery
                                    </label>
                                </div>
                                <p class="mb-0 mt-2 text-muted small">Pay with cash when your order is delivered.</p>
                            </div>
                            </a>
                            <a href="{{route('payment')}}">
                            <div class="payment-method">
                                <div class="form-check">
                                                                
                                           <label class="form-check-label fw-bold" for="esewa">
                                        <img src="{{ asset('images/esewa-logo.png') }}" alt="eSewa">
                                        eSewa                                       
                                    </label>
                                </div>
                                <p class="mb-0 mt-2 text-muted small">Pay securely with eSewa.</p>
                            </div>
                            </a>
                            
                            
                        </div>
                        
                        <!-- Order Summary -->
                        <div class="col-md-5">
                            <div class="section-title">
                                <i class="fas fa-shopping-bag me-2"></i>Order Summary
                            </div>
                            
                            <div class="order-summary">
                                @if($cartItems->count() > 0)
                                    @foreach($cartItems as $item)
                                        <div class="cart-item">
                                            <img src="{{ asset($item->product->photo) }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="cart-item-image">
                                            <div class="cart-item-details">
                                                <div class="cart-item-title">{{ $item->product->name }}</div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="cart-item-price">
                                                        Rs. {{ number_format($item->product->price) }}
                                                    </span>
                                                    <span class="quantity-badge">
                                                        Qty: {{ $item->quantity }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    <div class="summary-item">
                                        <span>Subtotal</span>
                                        <span>Rs. {{ number_format($subtotal) }}</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>Shipping</span>
                                        <span class="text-success">FREE</span>
                                    </div>
                                    <div class="summary-item total-amount">
                                        <span>Total</span>
                                        <span>Rs. {{ number_format($subtotal) }}</span>
                                    </div>
                                    
                                    <input type="hidden" name="grand_total" value="{{ $subtotal }}">
                                    <input type="hidden" name="item_count" value="{{ $cartItems->count() }}">
                                    <input type="hidden" name="first_name" id="formFirstName">
                                    <input type="hidden" name="last_name" id="formLastName">
                                    <input type="hidden" name="email" id="formEmail">
                                    <input type="hidden" name="phone" id="formPhone">
                                    <input type="hidden" name="payment_method" id="formPaymentMethod" value="cash_on_delivery">
                                    
                                    <button type="submit" class="btn btn-checkout">
                                        <i class="fas fa-lock me-2"></i>Place Order Securely
                                    </button>
                                    
                                    <div class="secure-badge">
                                        <i class="fas fa-shield-alt"></i>
                                        Secure Checkout
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                        <h5>Your cart is empty</h5>
                                        <p class="text-muted">Add some products to your cart to checkout.</p>
                                        <a href="{{ route('shop') }}" class="btn btn-primary mt-3">
                                            <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function selectPayment(method) {
        // Remove active class from all payment methods
        document.querySelectorAll('.payment-method').forEach(m => {
            m.classList.remove('active');
            m.querySelector('input[type="radio"]').checked = false;
        });
        
        // Add active class to selected payment method
        const selectedMethod = document.getElementById(method).closest('.payment-method');
        selectedMethod.classList.add('active');
        document.getElementById(method).checked = true;
        document.getElementById('formPaymentMethod').value = method;
    }
    
    // Form submission handler
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        // Update hidden fields with billing info
        document.getElementById('formFirstName').value = document.getElementById('firstName').value;
        document.getElementById('formLastName').value = document.getElementById('lastName').value;
        document.getElementById('formEmail').value = document.getElementById('email').value;
        document.getElementById('formPhone').value = document.getElementById('phone').value;
    });
    
    // Auto-fill phone number if not already filled
    document.addEventListener('DOMContentLoaded', function() {
        const phoneField = document.getElementById('phone');
        if (phoneField && !phoneField.value && "{{ Auth::user()->phone ?? '' }}") {
            phoneField.value = "{{ Auth::user()->phone }}";
        }
    });
</script>
@endsection