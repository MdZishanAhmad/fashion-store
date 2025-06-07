@extends('components.main')
@section('title', 'Cart')
@section('user-body')

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
                        @if ($cartItems->isEmpty())
                            <div class="empty-cart text-center py-5">
                                <i class="fas fa-shopping-cart fa-4x mb-4 text-muted"></i>
                                <h4 class="mb-3">Your cart is empty</h4>
                                <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet</p>
                                <a href="{{ route('shop') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                                </a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="text-center">Product</th>
                                            <th scope="col" class="text-center">Price</th>
                                            <th scope="col" class="text-center">Quantity</th>
                                            <th scope="col" class="text-center">Total</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $subtotal = 0;
                                        @endphp

                                        @foreach ($cartItems as $cart)
                                            <tr class="cart-item" data-cart-id="{{ $cart->id }}">
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $cart->product ? asset($cart->product->photo) : asset('images/default-product.jpg') }}"
                                                            alt="{{ $cart->product ? $cart->product->name : 'Product not available' }}"
                                                            class="img-fluid rounded me-3"
                                                            style="width: 80px; height: 80px; object-fit: cover;">
                                                        <div>
                                                            <h6 class="mb-0">{{ $cart->product->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    RS{{ number_format($cart->product->price, 2) }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="quantity-selector d-flex justify-content-center">
                                                        <button
                                                            class="quantity-btn decrement btn btn-outline-secondary rounded-start-pill px-3">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <input type="number"
                                                            class="quantity-input form-control text-center border-secondary border-start-0 border-end-0"
                                                            value="{{ $cart->quantity }}" min="1"
                                                            max="{{ min(10, $cart->product->stock ?? 10) }}"
                                                            data-product-id="{{ $cart->product->id }}"
                                                            data-cart-id="{{ $cart->id }}"
                                                            data-item-price="{{ $cart->product->price }}"
                                                            style="width: 60px; height: 38px;">

                                                        <button
                                                            class="quantity-btn increment btn btn-outline-secondary rounded-end-pill px-3">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center item-total fw-bold">
                                                    RS.<span
                                                        class="item-total-value">{{ number_format($cart->product->price * $cart->quantity, 2) }}</span>
                                                </td>

                                                <td class="align-middle text-end">
                                                    <a href="{{ route('delete', ['id' => $cart->id]) }}"
                                                        class="btn btn-sm btn-outline-danger remove-item">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php
                                                $subtotal += $cart->product->price * $cart->quantity;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    @if (!$cartItems->isEmpty())
                        <div class="row mt-4">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <a href="{{ route('shop') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                                </a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-end">
                                <button id="clear-cart" class="btn btn-outline-danger me-2">
                                    <a href="{{ route('delete', ['id' => $cart->id]) }}"
                                        class="btn btn-sm btn-outline-danger remove-item">
                                        <i class="fas fa-trash-alt me-2"></i> Clear Cart
                                    </a>
                                </button>
                                <button id="update-cart" class="btn btn-primary">
                                    <i class="fas fa-sync-alt me-2"></i> Update Cart
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                @if (!$cartItems->isEmpty())
                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Cart Summary</h5>


                                <ul class="list-group list-group-flush mb-4">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                        Subtotal
                                        <span>RS.<span id="cart-subtotal">{{ number_format($subtotal, 2) }}</span></span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                        Shipping
                                        <span class="badge bg-success">Free</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                        <div>
                                            <strong>Total</strong>
                                            {{-- <small class="d-block text-muted">including VAT</small> --}}
                                        </div>
                                        <span><strong>RS.<span
                                                    id="cart-total">{{ number_format($subtotal, 2) }}</span></strong></span>
                                    </li>
                                </ul>

                                <a href="{{ route('checkout') }}" class="btn btn-primary w-100 py-3 btn-lg">
                                    Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm">
                            {{-- <div class="card-body">
                                <h6 class="mb-3">We accept</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <i alt="Esewa"></i>
                                        class="img-fluid" style="height: 24px;">
                                    <h1 alt="Cash On delivery" class="img-fluid" style="height: 24px;"></h1>
                                </div>
                                <div class="mt-3">
                                    <small class="text-muted">Need help? <a href="{{ route('contact') }}">Contact
                                            us</a></small>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize all quantity selectors
                function initializeQuantitySelectors() {
                    document.querySelectorAll('.quantity-selector').forEach(function(selector) {
                        const input = selector.querySelector('.quantity-input');
                        const decrementBtn = selector.querySelector('.decrement');
                        const incrementBtn = selector.querySelector('.increment');
                        const max = parseInt(input.getAttribute('max')) || 10;
                        const min = parseInt(input.getAttribute('min')) || 1;

                        // Update button states based on current value
                        function updateButtonStates() {
                            const value = parseInt(input.value) || min;
                            decrementBtn.disabled = value <= min;
                            incrementBtn.disabled = value >= max;
                        }

                        // Decrement quantity
                        decrementBtn.addEventListener('click', function() {
                            let value = parseInt(input.value) || min;
                            if (value > min) {
                                input.value = value - 1;
                                updateButtonStates();
                                updateCartItem(input);
                            }
                        });

                        // Increment quantity
                        incrementBtn.addEventListener('click', function() {
                            let value = parseInt(input.value) || min;
                            if (value < max) {
                                input.value = value + 1;
                                updateButtonStates();
                                updateCartItem(input);
                            }
                        });

                        // Handle direct input
                        input.addEventListener('change', function() {
                            let value = parseInt(this.value) || min;

                            // Enforce min and max limits
                            if (value < min) {
                                this.value = min;
                            } else if (value > max) {
                                this.value = max;
                            } else {
                                this.value = value;
                            }

                            updateButtonStates();
                            updateCartItem(this);
                        });

                        // Initialize button states
                        updateButtonStates();
                    });
                }

                // Remove item from cart
                function removeCartItem(cartId, rowElement) {
                    if (confirm('Are you sure you want to remove this item from your cart?')) {
                        showLoading(cartId);

                        fetch(`/cart/${cartId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    // Animate removal
                                    rowElement.classList.add('table-danger');
                                    setTimeout(() => {
                                        rowElement.style.transition = 'all 0.3s ease';
                                        rowElement.style.opacity = '0';
                                        rowElement.style.height = '0';
                                        rowElement.style.padding = '0';
                                        rowElement.style.margin = '0';
                                        rowElement.style.border = 'none';

                                        setTimeout(() => {
                                            rowElement.remove();
                                            // Update cart totals
                                            if (data.cart) {
                                                document.getElementById('cart-subtotal')
                                                    .textContent = data.cart.subtotal.toFixed(2);
                                                document.getElementById('cart-total').textContent =
                                                    data.cart.total.toFixed(2);
                                            }

                                            // If cart is now empty, reload to show empty state
                                            if (data.cart.items_count === 0) {
                                                window.location.reload();
                                            }
                                        }, 300);
                                    }, 100);

                                    showToast('Item removed from cart', 'success');
                                } else {
                                    throw new Error(data.message || 'Error removing item');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                showToast(error.message || 'Error removing item', 'error');
                            })
                            .finally(() => {
                                hideLoading(cartId);
                            });
                    }
                }

                // Update cart item quantity
                function updateCartItem(input) {
                    const cartId = input.closest('.cart-item').dataset.cartId;
                    const productId = input.dataset.productId;
                    const newQuantity = parseInt(input.value);
                    const originalQuantity = parseInt(input.dataset.originalQuantity);
                    const itemPrice = parseFloat(input.dataset.itemPrice);

                    if (newQuantity === originalQuantity) return;

                    showLoading(cartId);

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
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                input.dataset.originalQuantity = newQuantity;

                                // Update item total display
                                const total = newQuantity * itemPrice;
                                const itemTotalElement = input.closest('tr').querySelector('.item-total');
                                itemTotalElement.textContent = 'RS.' + total.toFixed(2);

                                // Visual feedback
                                itemTotalElement.classList.add('text-success');
                                setTimeout(() => {
                                    itemTotalElement.classList.remove('text-success');
                                }, 1000);

                                // Update cart totals
                                if (data.cart) {
                                    document.getElementById('cart-subtotal').textContent = data.cart.subtotal
                                        .toFixed(2);
                                    document.getElementById('cart-total').textContent = data.cart.total.toFixed(2);
                                }

                                showToast('Quantity updated successfully', 'success');
                            } else {
                                throw new Error(data.message || 'Error updating quantity');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            // Revert to original quantity on error
                            input.value = originalQuantity;
                            updateButtonStates(input);
                            showToast(error.message || 'Error updating quantity', 'error');
                        })
                        .finally(() => {
                            hideLoading(cartId);
                        });
                }

                // Clear entire cart
                document.getElementById('clear-cart')?.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('Are you sure you want to clear your entire cart?')) {
                        showGlobalLoading();

                        fetch(`/cart/clear`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    showToast('Cart cleared successfully', 'success');
                                    window.location.reload();
                                } else {
                                    throw new Error(data.message || 'Error clearing cart');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                showToast(error.message || 'Error clearing cart', 'error');
                            })
                            .finally(() => {
                                hideGlobalLoading();
                            });
                    }
                });

                // Update all changed quantities at once
                document.getElementById('update-cart')?.addEventListener('click', function(e) {
                    e.preventDefault();
                    const inputs = document.querySelectorAll('.quantity-input');
                    let updates = [];

                    inputs.forEach(input => {
                        const newQuantity = parseInt(input.value);
                        const originalQuantity = parseInt(input.dataset.originalQuantity);

                        if (newQuantity !== originalQuantity) {
                            updates.push({
                                cartId: input.closest('.cart-item').dataset.cartId,
                                productId: input.dataset.productId,
                                quantity: newQuantity
                            });
                        }
                    });

                    if (updates.length > 0) {
                        updateMultipleCartItems(updates);
                    } else {
                        showToast('No changes to update', 'info');
                    }
                });

                // Bulk update cart items
                function updateMultipleCartItems(updates) {
                    showGlobalLoading();

                    fetch(`/cart/bulk-update`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                updates
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Update all quantities and totals in the UI
                                data.updatedItems.forEach(item => {
                                    const row = document.querySelector(
                                        `.cart-item[data-cart-id="${item.cart_id}"]`);
                                    if (row) {
                                        const input = row.querySelector('.quantity-input');
                                        input.value = item.quantity;
                                        input.dataset.originalQuantity = item.quantity;

                                        const itemPrice = parseFloat(input.dataset.itemPrice);
                                        const total = item.quantity * itemPrice;
                                        row.querySelector('.item-total').textContent = 'RS.' + total
                                            .toFixed(2);
                                    }
                                });

                                // Update cart totals
                                if (data.cart) {
                                    document.getElementById('cart-subtotal').textContent = data.cart.subtotal
                                        .toFixed(2);
                                    document.getElementById('cart-total').textContent = data.cart.total.toFixed(2);
                                }

                                showToast('Cart updated successfully', 'success');
                            } else {
                                throw new Error(data.message || 'Error updating cart');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showToast(error.message || 'Error updating cart', 'error');
                            // Reload to ensure consistency
                            window.location.reload();
                        })
                        .finally(() => {
                            hideGlobalLoading();
                        });
                }

                // Helper functions
                function showLoading(cartId) {
                    const row = document.querySelector(`.cart-item[data-cart-id="${cartId}"]`);
                    if (row) {
                        row.classList.add('table-active');
                        row.querySelectorAll('button, input').forEach(el => el.disabled = true);
                    }
                }

                function hideLoading(cartId) {
                    const row = document.querySelector(`.cart-item[data-cart-id="${cartId}"]`);
                    if (row) {
                        row.classList.remove('table-active');
                        row.querySelectorAll('button, input').forEach(el => el.disabled = false);
                    }
                }

                function showGlobalLoading() {
                    const btn = document.getElementById('update-cart');
                    if (btn) {
                        btn.disabled = true;
                        btn.innerHTML =
                            '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Updating...';
                    }
                }

                function hideGlobalLoading() {
                    const btn = document.getElementById('update-cart');
                    if (btn) {
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fas fa-sync-alt me-2"></i> Update Cart';
                    }
                }

                function showToast(message, type = 'success') {
                    // In a real implementation, you would use a proper toast library
                    // This is a simplified version using alert
                    alert(`${type.toUpperCase()}: ${message}`);
                }

                function updateButtonStates(input) {
                    const selector = input.closest('.quantity-selector');
                    const value = parseInt(input.value) || 1;
                    const min = parseInt(input.getAttribute('min')) || 1;
                    const max = parseInt(input.getAttribute('max')) || 10;

                    const decrementBtn = selector.querySelector('.decrement');
                    const incrementBtn = selector.querySelector('.increment');

                    decrementBtn.disabled = value <= min;
                    incrementBtn.disabled = value >= max;
                }

                // Initialize all event listeners
                initializeQuantitySelectors();

                // Set up remove item buttons
                document.querySelectorAll('.remove-item').forEach(button => {
                    button.addEventListener('click', function() {
                        const cartId = this.dataset.cartId;
                        removeCartItem(cartId, this.closest('.cart-item'));
                    });
                });
            });
        </script>
    @endpush
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartTable = document.querySelector('table'); // Adjust selector as needed

            cartTable.addEventListener('click', function(e) {
                const isIncrement = e.target.closest('.increment');
                const isDecrement = e.target.closest('.decrement');

                if (isIncrement || isDecrement) {
                    const quantityInput = e.target.closest('tr').querySelector('.quantity-input');
                    let quantity = parseInt(quantityInput.value);
                    const max = parseInt(quantityInput.max);

                    if (isIncrement && quantity < max) {
                        quantity++;
                    } else if (isDecrement && quantity > 1) {
                        quantity--;
                    }

                    quantityInput.value = quantity;

                    // Update item total
                    const price = parseFloat(quantityInput.dataset.itemPrice);
                    const itemTotalCell = e.target.closest('tr').querySelector('.item-total-value');
                    const newTotal = (quantity * price).toFixed(2);
                    itemTotalCell.textContent = newTotal;

                    // Optionally, update subtotal if you show it
                    updateSubtotal();

                    // Send AJAX to update cart
                    updateCartOnServer(quantityInput.dataset.cartId, quantity);
                }
            });

            function updateSubtotal() {
                let subtotal = 0;
                document.querySelectorAll('.item-total-value').forEach(item => {
                    subtotal += parseFloat(item.textContent);
                });
                const subtotalElement = document.getElementById('subtotal');
                if (subtotalElement) {
                    subtotalElement.textContent = subtotal.toFixed(2);
                }
            }

            function updateCartOnServer(cartId, newQuantity) {
                fetch(`/cart/update/${cartId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            quantity: newQuantity
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log('Cart updated:', data);
                    })
                    .catch(err => {
                        console.error('Error updating cart:', err);
                    });
            }
        });
    </script>


@endsection
