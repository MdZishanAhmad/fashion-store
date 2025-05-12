@include('components.header')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($cartItems->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="empty-cart-message">
                                            <i class="fas fa-shopping-cart fa-3x mb-3 text-muted"></i>
                                            <h5 class="text-muted">Your cart is empty</h5>
                                            <a href="{{ route('shop') }}" class="btn btn-primary mt-3">
                                                Continue Shopping
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @php
                                    $subtotal = 0;
                                @endphp
                                
                                @foreach($cartItems as $cart)
                                    @php
                                        $itemPrice = $cart->product->price ?? 0;
                                        $itemTotal = $cart->quantity * $itemPrice;
                                        $subtotal += $itemTotal;
                                    @endphp
                                    
                                    <tr class="cart-item" data-cart-id="{{ $cart->id }}">
                                        <td class="product__cart__item align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="product__cart__item__pic mr-3">
                                                    <img src="{{ asset($cart->product->image ?? 'img/shopping-cart/default.jpg') }}" 
                                                         alt="{{ $cart->product->name ?? 'No name' }}" 
                                                         class="img-fluid" 
                                                         style="width: 70px; height: auto; object-fit: cover;">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6 class="mb-1">{{ $cart->product->name ?? 'Unknown Product' }}</h6>
                                                    <h5 class="mb-0">${{ number_format($itemPrice, 2) }}</h5>
                                                    @if(!$cart->product || $cart->product->trashed())
                                                        <small class="text-danger">This product is no longer available</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                            
                                        <td class="quantity__item align-middle">
                                            <div class="quantity">
                                                <div class="input-group quantity-selector" style="max-width: 120px;">
                                                    <button class="btn btn-outline-secondary quantity-decrement" type="button">-</button>
                                                    <input type="number" 
                                                           class="form-control text-center quantity-input" 
                                                           value="{{ $cart->quantity }}" 
                                                           min="1" 
                                                           max="{{ $cart->product->stock ?? 99 }}"
                                                           data-product-id="{{ $cart->product->id ?? '' }}"
                                                           data-original-quantity="{{ $cart->quantity }}"
                                                           data-item-price="{{ $itemPrice }}">
                                                    <button class="btn btn-outline-secondary quantity-increment" type="button">+</button>
                                                </div>
                                                <small class="text-muted d-block mt-1 stock-message">
                                                    @if(isset($cart->product->stock))
                                                        {{ $cart->product->stock }} available
                                                    @endif
                                                </small>
                                            </div>
                                        </td>
                            
                                        <td class="cart__price align-middle">
                                            $<span class="item-total">{{ number_format($itemTotal, 2) }}</span>
                                        </td>
                            
                                        <td class="cart__close align-middle">
                                            <form action="{{ route('cart.delete', $cart->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0" title="Remove item">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{ route('shop') }}">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <a href="#" id="update-cart"><i class="fa fa-spinner"></i> Update cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <button type="submit">Apply</button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>$<span id="cart-subtotal">{{ number_format($subtotal ?? 0, 2) }}</span></span></li>
                        <li>Total <span>$<span id="cart-total">{{ number_format($subtotal ?? 0, 2) }}</span></span></li>
                    </ul>
                    <a href="{{ route('checkout') }}" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quantity change handlers
    document.querySelectorAll('.quantity-selector').forEach(function(selector) {
        const input = selector.querySelector('.quantity-input');
        const decrementBtn = selector.querySelector('.quantity-decrement');
        const incrementBtn = selector.querySelector('.quantity-increment');
        const max = parseInt(input.getAttribute('max')) || 99;
        
        decrementBtn.addEventListener('click', function() {
            let value = parseInt(input.value) || 1;
            if (value > 1) {
                input.value = value - 1;
                updateCartItem(input);
            }
        });
        
        incrementBtn.addEventListener('click', function() {
            let value = parseInt(input.value) || 1;
            if (value < max) {
                input.value = value + 1;
                updateCartItem(input);
            }
        });
        
        input.addEventListener('change', function() {
            let value = parseInt(this.value) || 1;
            if (value < 1) this.value = 1;
            if (value > max) this.value = max;
            updateCartItem(this);
        });
    });
    
    // Update all quantities button
    document.getElementById('update-cart').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelectorAll('.quantity-input').forEach(input => {
            updateCartItem(input);
        });
    });
    
    function updateCartItem(input) {
        const cartId = input.closest('.cart-item').dataset.cartId;
        const productId = input.dataset.productId;
        const newQuantity = parseInt(input.value);
        const originalQuantity = parseInt(input.dataset.originalQuantity);
        const itemPrice = parseFloat(input.dataset.itemPrice);
        
        if (newQuantity === originalQuantity) return;
        
        fetch(`/cart/${cartId}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                quantity: newQuantity,
                product_id: productId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                input.dataset.originalQuantity = newQuantity;
                // Update item total
                const total = newQuantity * itemPrice;
                input.closest('tr').querySelector('.item-total').textContent = total.toFixed(2);
                
                // Update cart totals
                if (data.cart) {
                    document.getElementById('cart-subtotal').textContent = data.cart.subtotal.toFixed(2);
                    document.getElementById('cart-total').textContent = data.cart.total.toFixed(2);
                }
            } else {
                alert(data.message || 'Error updating cart');
                input.value = originalQuantity;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            input.value = originalQuantity;
        });
    }
});
</script>
@endpush

@include('components.footer')