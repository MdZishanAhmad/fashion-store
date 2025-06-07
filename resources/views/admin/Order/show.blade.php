@extends('admin.header')
@section('title', 'Order')

@section('content')
<style>
    .order-container {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        padding: 2rem;
        margin: 2rem 0;
    }
    
    .section-title {
        color: #2c3e50;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #3498db;
    }
    
    .info-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
    }
    
    .card-header {
        background: #f8f9fa;
        border-bottom: 1px solid #eee;
        padding: 1rem 1.5rem;
        border-radius: 12px 12px 0 0;
    }
    
    .card-header h5 {
        margin: 0;
        color: #2c3e50;
        font-weight: 600;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 0.8rem 0;
        border-bottom: 1px solid #eee;
    }
    
    .detail-item:last-child {
        border-bottom: none;
    }
    
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.9rem;
    }
    
    .status-badge.pending { background: #f1c40f; color: #000; }
    .status-badge.accepted { background: #3498db; color: #fff; }
    .status-badge.delivered { background: #2ecc71; color: #fff; }
    .status-badge.reject { background: #e74c3c; color: #fff; }
    
    .product-card {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    
    .product-img-container {
        width: 100%;
        height: 120px;
        overflow: hidden;
        border-radius: 8px;
    }
    
    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .product-title {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    
    .product-price {
        color: #e74c3c;
        font-weight: 500;
    }
    
    .btn-action {
        padding: 0.8rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
    }
</style>

<div class="container py-4">
    <div class="order-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">
                <i class="fas fa-receipt me-2"></i>Order #{{ $order->order_number }}
            </h3>
            <span class="status-badge {{ $order->status }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="row">
            <!-- Customer Information -->
            <div class="col-md-6">
                <div class="info-card">
                    <div class="card-header">
                        <h5><i class="fas fa-user me-2"></i>Customer Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="detail-item">
                            <span class="text-muted">Name:</span>
                            <span class="fw-bold">{{ $order->user->name ?? 'Guest' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="text-muted">Phone:</span>
                            <span class="fw-bold">{{ $order->user->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="text-muted">Email:</span>
                            <span class="fw-bold">{{ $order->user->email ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="text-muted">Address:</span>
                            <span class="fw-bold text-end">{{ $order->user->address ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-6">
                <div class="info-card">
                    <div class="card-header">
                        <h5><i class="fas fa-info-circle me-2"></i>Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="detail-item">
                            <span class="text-muted">Total Amount:</span>
                            <span class="fw-bold text-success">Rs. {{ number_format($order->grand_total, 2) }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="text-muted">Items:</span>
                            <span class="fw-bold">{{ $order->item_count }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="text-muted">Payment Method:</span>
                            <span class="fw-bold text-capitalize">{{ $order->payment_method }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="text-muted">Payment Status:</span>
                            <span class="badge {{ $order->is_paid ? 'bg-success' : 'bg-warning' }}">
                                {{ $order->is_paid ? 'Paid' : 'Unpaid' }}
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="text-muted">Order Date:</span>
                            <span class="fw-bold">{{ $order->created_at->format('M d, Y h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="info-card mt-4">
            <div class="card-header">
                <h5><i class="fas fa-shopping-bag me-2"></i>Order Items ({{ $order->items->count() }})</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($item->product->photo)
                                                <img src="{{ asset($item->product->photo) }}" 
                                                     alt="{{ $item->product->name }}"
                                                     class="me-2"
                                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                            @endif
                                            <span>{{ $item->product->name }}</span>
                                        </div>
                                    </td>
                                    <td>Rs. {{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td class="fw-bold">Rs. {{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Order Actions -->
        <div class="d-flex justify-content-end gap-3 mt-4">
            @if ($order->status == 'pending')
                <form action="{{ route('admin.orders.accept', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-action">
                        <i class="fas fa-check-circle me-2"></i>Accept Order
                    </button>
                </form>
                <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-action" 
                            onclick="return confirm('Are you sure you want to reject this order?')">
                        <i class="fas fa-times-circle me-2"></i>Reject Order
                    </button>
                </form>
            @endif
            
            @if ($order->status == 'accepted')
                <form action="{{ route('admin.orders.mark-as-delivered', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-info btn-action">
                        <i class="fas fa-truck me-2"></i>Mark as Delivered
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection