@extends('components.main')
@section('title', 'Order-show')
@section('user-body')

    <h1 class="bg-dark text-warning p-2 text-center">Order Confirmation</h1>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .order-section-title {
            color: #2c3e50;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #3498db;
        }
        .order-info-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.07);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .order-detail-item {
            display: flex;
            justify-content: space-between;
            padding: 0.7rem 0;
            border-bottom: 1px solid #eee;
        }
        .order-detail-item:last-child { border-bottom: none; }
        .order-badge {
            padding: 0.4em 1em;
            border-radius: 20px;
            font-size: 0.95em;
            font-weight: 500;
        }
        .order-badge.paid { background: #2ecc71; color: #fff; }
        .order-badge.unpaid { background: #f1c40f; color: #222; }
        .order-badge.delivered { background: #2ecc71; color: #fff; }
        .order-badge.pending { background: #f1c40f; color: #222; }
        .order-badge.accepted { background: #3498db; color: #fff; }
        .order-badge.reject { background: #e74c3c; color: #fff; }
        .order-product-img {
            width: 70px; height: 70px; object-fit: cover; border-radius: 8px; margin-right: 1rem;
        }
        .order-product-card {
            display: flex; align-items: center; margin-bottom: 1.2rem;
            background: #f8f9fa; border-radius: 10px; padding: 1rem;
        }
        .order-product-title { font-weight: 600; color: #2c3e50; }
        .order-product-qty { color: #3498db; font-weight: 500; }
        .order-product-price { color: #e74c3c; font-weight: 500; }
    </style>
    
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="order-info-card">
                    <div class="row">
                        <!-- Left: Shipping & Customer Info -->
                        <div class="col-md-6">
                            <div class="order-section-title">
                                <i class="fas fa-truck me-2"></i>Shipping Information
                            </div>
                            <div class="order-detail-item">
                                <span>Name:</span>
                                <span>{{ $order->shipping_fullname ?? $order->user->name }}</span>
                            </div>
                            {{-- <div class="order-detail-item">
                                <span>Address:</span>
                                <span>{{ $order->shipping_address ?? $order->user->address }}</span>
                            </div> --}}
                            <div class="order-detail-item">
                                <span>Phone:</span>
                                <span>{{ $order->shipping_phone ?? $order->user->phone }}</span>
                            </div>
                            <div class="order-detail-item">
                                <span>Email:</span>
                                <span>{{ $order->shipping_email ?? $order->user->email }}</span>
                            </div>
                            <div class="order-detail-item">
                                <span>Estimated Delivery:</span>
                                <span>{{ $order->created_at->addDays(3)->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <!-- Right: Order Summary -->
                        <div class="col-md-6">
                            <div class="order-section-title">
                                <i class="fas fa-receipt me-2"></i>Order Summary
                            </div>
                            <div class="order-detail-item">
                                <span>Subtotal:</span>
                                <span>Rs. {{ number_format($order->grand_total, 2) }}</span>
                            </div>
                            <div class="order-detail-item">
                                <span>Shipping:</span>
                                <span class="text-success">FREE</span>
                            </div>
                            <div class="order-detail-item">
                                <span>Tax:</span>
                                <span>Rs. 0.00</span>
                            </div>
                            <div class="order-detail-item">
                                <span class="fw-bold">Total:</span>
                                <span class="fw-bold text-primary">Rs. {{ number_format($order->grand_total, 2) }}</span>
                            </div>
                            <div class="order-detail-item">
                                <span>Payment Status:</span>
                                <span>
                                    @if($order->is_paid)
                                        <span class="order-badge paid">Paid</span>
                                    @else
                                        <span class="order-badge unpaid">Unpaid</span>
                                    @endif
                                </span>
                            </div>
                            <div class="order-detail-item">
                                <span>Payment Method:</span>
                                <span>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                            </div>
                            <div class="order-detail-item">
                                <span>Order Status:</span>
                                <span>
                                    <span class="order-badge {{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Order Items -->
                <div class="order-info-card">
                    <div class="order-section-title">
                        <i class="fas fa-shopping-bag me-2"></i>Order Items ({{ $order->items->count() }})
                    </div>
                    @foreach ($order->items as $item)
                        <div class="order-product-card">
                            <img src="{{ asset($item->product->photo) }}" class="order-product-img" alt="{{ $item->product->name }}">
                            <div>
                                <div class="order-product-title">{{ $item->product->name }}</div>
                                <div class="order-product-qty">Qty: {{ $item->quantity }}</div>
                                <div class="order-product-price">Rs. {{ number_format($item->price, 2) }}</div>
                                <div>Total: <b>Rs. {{ number_format($item->price * $item->quantity, 2) }}</b></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
