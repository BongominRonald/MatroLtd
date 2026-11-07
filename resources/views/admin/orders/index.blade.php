@extends('admin.layouts.admin')

@section('title', 'Orders — Matro Administration')
@section('page-title', 'Commercial Orders')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <p class="text-muted small mb-0">Monitor commodity orders, buyer contracts, payment verifications, and delivery statuses.</p>
    </div>
</div>

<!-- Status Filters -->
<div class="d-flex flex-wrap gap-2 mb-4">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm {{ !request('status') ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill">
        All Orders ({{ array_sum($statusCounts) }})
    </a>
    @foreach($statuses as $st)
        @php
            $count = $statusCounts[$st] ?? 0;
            $active = request('status') === $st;
        @endphp
        <a href="{{ route('admin.orders.index', ['status' => $st]) }}" class="btn btn-sm {{ $active ? 'btn-dark' : 'btn-outline-secondary' }} rounded-pill text-capitalize">
            {{ $st }} ({{ $count }})
        </a>
    @endforeach
</div>

<div class="card admin-card mb-4">
    <div class="card-header bg-white">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-2 align-items-center">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="search" name="search" class="form-control border-start-0 bg-light" placeholder="Search order #, buyer name, or email..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <span class="text-muted small fw-semibold">{{ $orders->total() }} order(s) found</span>
                @if(request('search'))
                    <a href="{{ route('admin.orders.index', ['status' => request('status')]) }}" class="btn btn-sm btn-outline-secondary ms-2 rounded-pill">Clear Search</a>
                @endif
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table admin-table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Buyer / Company</th>
                    <th>Date Placed</th>
                    <th>Total Value</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="fw-bold text-dark text-decoration-none">
                                #{{ $order->order_number }}
                            </a>
                            <small class="text-muted d-block">{{ $order->items->count() }} line item(s)</small>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $order->customer_name }}</div>
                            <small class="text-muted">{{ $order->customer_email }}</small>
                        </td>
                        <td>
                            <div class="small text-dark">{{ $order->created_at->format('M d, Y') }}</div>
                            <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                        </td>
                        <td>
                            <span class="fw-bold text-success fs-6">${{ number_format($order->total_amount, 2) }}</span>
                        </td>
                        <td>
                            <span class="badge bg-light text-secondary border">{{ $order->payment_method ?? 'Escrow' }}</span>
                        </td>
                        <td>
                            @php
                                $badgeColor = match($order->status) {
                                    'delivered' => 'success',
                                    'shipped' => 'info text-white',
                                    'confirmed' => 'primary',
                                    'pending' => 'warning text-dark',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $badgeColor }} text-capitalize px-2 py-1">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                View <i class="bi bi-chevron-right ms-1"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-bag-x fs-1 d-block mb-2 text-secondary"></i>
                            No orders found in this category.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
        <div class="card-footer bg-white d-flex justify-content-between align-items-center py-3">
            <small class="text-muted">Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} orders</small>
            <div>{{ $orders->links() }}</div>
        </div>
    @endif
</div>
@endsection
