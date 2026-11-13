@extends('admin.layouts.admin')

@section('title', 'Customers & Users — BRX Agro Global Administration')
@section('page-title', 'Customers & Users')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <p class="text-muted small mb-0">Browse registered customer accounts, view transaction frequency, and inspect order histories.</p>
    </div>
</div>

<div class="card admin-card mb-4">
    <div class="card-header bg-white">
        <form action="{{ route('admin.users.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="search" name="search" class="form-control border-start-0 bg-light" placeholder="Search customer name or email..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="role" class="form-select bg-light" onchange="this.form.submit()">
                    <option value="">All Roles</option>
                    <option value="customer" {{ request('role') === 'customer' ? 'selected' : '' }}>Customers</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Administrators</option>
                </select>
            </div>
            <div class="col-md-3 text-md-end">
                @if(request('search') || request('role'))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Reset Filters</a>
                @endif
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table admin-table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>User / Customer</th>
                    <th>Account Role</th>
                    <th>Total Orders</th>
                    <th>Joined</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-success-subtle text-success fw-bold d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; font-size: 1rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-semibold text-dark">{{ $user->name }}</div>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="badge bg-warning text-dark px-2.5 py-1">
                                    <i class="bi bi-shield-lock me-1"></i>Administrator
                                </span>
                            @else
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1">
                                    <i class="bi bi-person me-1"></i>Customer
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($user->orders_count > 0)
                                <span class="badge bg-success px-2.5 py-1">{{ $user->orders_count }} {{ Str::plural('order', $user->orders_count) }}</span>
                            @else
                                <span class="text-muted small">0 orders</span>
                            @endif
                        </td>
                        <td>
                            <div class="text-dark small">{{ $user->created_at->format('M d, Y') }}</div>
                            <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                View History <i class="bi bi-chevron-right ms-1"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-people fs-1 d-block mb-2 text-secondary"></i>
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div class="card-footer bg-white d-flex justify-content-between align-items-center py-3">
            <small class="text-muted">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users</small>
            <div>{{ $users->links() }}</div>
        </div>
    @endif
</div>
@endsection
