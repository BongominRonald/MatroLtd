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
                <li class="list-group-item d-flex justify-content-between px-4 py-3">
                    <span class="text-muted">Status</span>
                    @if($user->trashed())
                        <span class="badge bg-danger-subtle text-danger border">Deactivated ({{ $user->deleted_at->format('M d, Y') }})</span>
                    @else
                        <span class="badge bg-success-subtle text-success border">Active</span>
                    @endif
                </li>
            </ul>
            @if($user->id !== auth()->id())
                <div class="card-footer p-3 d-flex flex-column gap-2">
                    <form action="{{ route('admin.users.update-role', $user->id) }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <select name="role" class="form-select form-select-sm">
                            <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer Role</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrator Role</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-matro text-nowrap">Update Role</button>
                    </form>
                    @if($user->trashed())
                        <form action="{{ route('admin.users.restore', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-success w-100 rounded-pill">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>Restore User Account
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Deactivate (soft-delete) this user account?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-pill">
                                <i class="bi bi-person-slash me-1"></i>Deactivate Account (Soft Delete)
                            </button>
                        </form>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Orders History -->
    <div class="col-lg-8">
        <div class="card admin-card">
            <div class="card-header d-flex justify-content-between align-items-center">
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
