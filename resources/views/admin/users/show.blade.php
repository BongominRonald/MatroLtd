@extends('admin.layouts.admin')

@section('title', 'Customer Profile: ' . $user->name . ' — BRX Agro Global Administration')
@section('page-title', 'Customer Profile')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
        <i class="bi bi-arrow-left me-1"></i>Back to Users &amp; Customers
    </a>
</div>

<div class="row g-4">
    <!-- User Profile Summary Card -->
    <div class="col-lg-4">
        <div class="card admin-card mb-4">
            <div class="card-body text-center p-4">
                <div class="rounded-circle bg-success-subtle text-success fw-bold d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px; font-size: 1.8rem;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h5 class="fw-bold text-dark mb-1">{{ $user->name }}</h5>
                <p class="text-muted small mb-2">{{ $user->email }}</p>
                <div>
                    @if($user->role === 'admin')
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill">
                            <i class="bi bi-shield-lock me-1"></i>Administrator
                        </span>
                    @else
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill">
                            <i class="bi bi-person me-1"></i>Customer
                        </span>
                    @endif
                </div>
            </div>
            <div class="border-top p-3 bg-light">
                <div class="row text-center g-2">
                    <div class="col-6 border-end">
                        <small class="text-muted d-block text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Orders Placed</small>
                        <span class="fs-5 fw-bold text-dark">{{ $user->orders->count() }}</span>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Total Spent</small>
                        <span class="fs-5 fw-bold text-success">${{ number_format($user->orders->sum('total_amount'), 2) }}</span>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush small">
                <li class="list-group-item d-flex justify-content-between px-4 py-3">
                    <span class="text-muted">Account ID</span>
                    <span class="fw-semibold text-dark">#{{ $user->id }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between px-4 py-3">
                    <span class="text-muted">Member Since</span>
                    <span class="fw-semibold text-dark">{{ $user->created_at->format('M d, Y') }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between px-4 py-3">
                    <span class="text-muted">Last Updated</span>
                    <span class="fw-semibold text-dark">{{ $user->updated_at->diffForHumans() }}</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Orders History -->
    <div class="col-lg-8">
        <div class="card admin-card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-bag-check me-2 text-success"></i>Order History ({{ $user->orders->count() }})
                </h6>
            </div>
            <div class="table-responsive">
                <table class="table admin-table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($user->orders as $order)
                            @php
                                $statusBadge = match($order->status) {
                                    'completed', 'delivered' => 'success',
                                    'shipped' => 'info text-dark',
                                    'processing' => 'warning text-dark',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                };
                            @endphp
                            <tr>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="fw-bold text-decoration-none text-dark">
                                        #{{ $order->order_number }}
                                    </a>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                                </td>
                                <td>
                                    <small class="text-dark">{{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}</small>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">${{ number_format($order->total_amount, 2) }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $statusBadge }} text-capitalize px-2 py-1">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                        View Order <i class="bi bi-chevron-right ms-1"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-cart-x fs-1 d-block mb-2 text-secondary"></i>
                                    This customer has not placed any orders yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
