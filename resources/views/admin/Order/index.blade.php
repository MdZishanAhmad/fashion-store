@extends('admin.header')
@section('title', 'Manage Order')

@section('content')
    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-shopping-cart me-2 text-primary"></i>Order Management
                    </h4>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-list me-1"></i> All
                        </a>
                        <a href="{{ route('admin.orders.pending') }}" class="btn btn-outline-warning">
                            <i class="fas fa-clock me-1"></i> Pending
                        </a>
                        <a href="{{ route('admin.orders.accepted') }}" class="btn btn-outline-success">
                            <i class="fas fa-check-circle me-1"></i> Accepted
                        </a>
                        <a href="{{ route('admin.orders.delivered') }}" class="btn btn-outline-info">
                            <i class="fas fa-truck me-1"></i> Delivered
                        </a>
                        <a href="{{ route('admin.orders.rejected') }}" class="btn btn-outline-danger">
                            <i class="fas fa-times-circle me-1"></i> Rejected
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Order #</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td class="ps-4 fw-bold">{{ $order->order_number }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-3">
                                                <span class="avatar-title rounded-circle bg-light text-dark">
                                                    {{ substr($order->user->name ?? 'G', 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $order->user->name ?? 'Guest' }}</h6>
                                                <small class="text-muted">{{ $order->user->email ?? '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="fw-bold">RS.{{ number_format($order->grand_total, 2) }}</td>
                                    <td>
                                        @if ($order->status == 'pending')
                                            <span class="badge bg-warning rounded-pill px-3 py-1">
                                                <i class="fas fa-clock me-1"></i> Pending
                                            </span>
                                        @elseif($order->status == 'accepted')
                                            <span class="badge bg-success rounded-pill px-3 py-1">
                                                <i class="fas fa-check-circle me-1"></i> Accepted
                                            </span>
                                        @elseif($order->status == 'delivered')
                                            <span class="badge bg-info rounded-pill px-3 py-1">
                                                <i class="fas fa-truck me-1"></i> Delivered
                                            </span>
                                        @else
                                            <span class="badge bg-danger rounded-pill px-3 py-1">
                                                <i class="fas fa-times-circle me-1"></i> Rejected
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                                class="btn btn-sm btn-outline-info rounded-circle" data-bs-toggle="tooltip"
                                                title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if ($order->status == 'pending')
                                                <form action="{{ route('admin.orders.accept', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-success rounded-circle"
                                                        data-bs-toggle="tooltip" title="Accept Order">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.orders.reject', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger rounded-circle"
                                                        data-bs-toggle="tooltip" title="Reject Order">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            @if ($order->status == 'rejected')
                                                <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-dark rounded-circle"
                                                        data-bs-toggle="tooltip" title="Delete Order">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if ($order->status == 'accepted')
                                                <form action="{{ route('admin.orders.mark-as-delivered', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-info rounded-circle"
                                                        data-bs-toggle="tooltip" title="Mark as Delivered">
                                                        <i class="fas fa-truck"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">No orders found</h5>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($orders->hasPages())
                    <div class="card-footer bg-white border-top-0">
                        <div class="d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        })
    </script>
@endpush
