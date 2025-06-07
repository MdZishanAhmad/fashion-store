@extends('components.main')
@section('title','Order')
@section('user-body')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        color: #333;
    }

    .order-container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 25px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .order-table {
        width: 100%;
        margin-bottom: 0;
    }

    .order-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #2c3e50;
        padding: 15px;
        border-bottom: 2px solid #dee2e6;
    }

    .order-table td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
    }

    .order-table tr:hover {
        background-color: #f8f9fa;
    }

    .badge-status {
        padding: 8px 12px;
        border-radius: 5px;
        font-weight: 500;
        font-size: 0.85rem;
    }

    .badge-status.bg-success {
        background-color: #27ae60 !important;
    }

    .badge-status.bg-primary {
        background-color: #2c3e50 !important;
    }

    .badge-status.bg-warning {
        background-color: #f39c12 !important;
    }

    .badge-status.bg-danger {
        background-color: #e74c3c !important;
    }

    .view-btn {
        background: #2c3e50;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .view-btn:hover {
        background: #34495e;
        color: white;
        transform: translateY(-2px);
    }

    .empty-card {
        text-align: center;
        padding: 40px 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .empty-card i {
        font-size: 3rem;
        color: #95a5a6;
        margin-bottom: 20px;
    }

    .empty-card h5 {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .empty-card p {
        color: #7f8c8d;
        margin-bottom: 20px;
    }

    .shop-btn {
        background: #2c3e50;
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .shop-btn:hover {
        background: #34495e;
        color: white;
        transform: translateY(-2px);
    }

    .alert {
        border-radius: 5px;
        padding: 15px 20px;
        margin-bottom: 20px;
        border: none;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .pagination {
        margin: 0;
        padding: 15px;
    }

    .pagination .page-link {
        color: #2c3e50;
        border: 1px solid #dee2e6;
        padding: 8px 15px;
    }

    .pagination .page-item.active .page-link {
        background-color: #2c3e50;
        border-color: #2c3e50;
    }

    .pagination .page-link:hover {
        background-color: #f8f9fa;
        color: #2c3e50;
    }

    @media (max-width: 768px) {
        .order-container {
            padding: 15px;
            margin: 15px;
        }

        .order-table th,
        .order-table td {
            padding: 10px;
        }

        .badge-status {
            padding: 6px 10px;
            font-size: 0.8rem;
        }

        .view-btn {
            padding: 6px 12px;
            font-size: 0.85rem;
        }
    }
</style>

<div class="container">
    <div class="order-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-dark">
                <i class="fas fa-clipboard-list me-2"></i>My Orders
            </h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($orders->isEmpty())
            <div class="empty-card">
                <i class="fas fa-clipboard-list"></i>
                <h5>No Orders Found</h5>
                <p>You haven't placed any orders yet.</p>
                <a href="{{ route('products.index') }}" class="shop-btn">
                    <i class="fas fa-shopping-bag"></i>
                    Start Shopping
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table order-table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="fw-bold">#{{ $order->order_number }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>{{ $order->items_count }}</td>
                                <td>RS.{{ number_format($order->grand_total, 2) }}</td>
                                <td>
                                    <span class="badge badge-status bg-{{ 
                                        $order->status == 'delivered' ? 'success' : 
                                        ($order->status == 'accepted' ? 'primary' : 
                                        ($order->status == 'reject' ? 'danger' : 'warning')) 
                                    }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('orders.show', $order->id) }}" class="view-btn">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $orders->links() }}
                </div>
            @endif
        @endif
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection