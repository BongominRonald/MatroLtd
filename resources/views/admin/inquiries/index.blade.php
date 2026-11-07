@extends('admin.layouts.admin')

@section('title', 'Trade Inquiries — Matro Administration')
@section('page-title', 'Inquiries &amp; Leads')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <p class="text-muted small mb-0">Direct customer leads, buyer requests for quotes (RFQs), grower supply offers, and logistics partner contacts.</p>
    </div>
</div>

<div class="card admin-card mb-4">
    <div class="card-header bg-white">
        <form action="{{ route('admin.inquiries.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="search" name="search" class="form-control border-start-0 bg-light" placeholder="Search inquiry name, email, or topic..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="role" class="form-select bg-light" onchange="this.form.submit()">
                    <option value="">All Roles (Buyers/Partners/Growers)</option>
                    <option value="buyer" {{ request('role') === 'buyer' ? 'selected' : '' }}>Buyers / Importers</option>
                    <option value="partner" {{ request('role') === 'partner' ? 'selected' : '' }}>Partners / Logistics</option>
                    <option value="grower" {{ request('role') === 'grower' ? 'selected' : '' }}>Growers / Farms</option>
                </select>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('admin.inquiries.index', ['unread' => 1]) }}" class="btn btn-sm {{ request('unread') ? 'btn-warning text-dark' : 'btn-outline-warning text-dark' }} rounded-pill">
                    <i class="bi bi-envelope me-1"></i>Unread Only
                </a>
                @if(request('search') || request('role') || request('unread'))
                    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-sm btn-outline-secondary ms-2 rounded-pill">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table admin-table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Contact</th>
                    <th>Role</th>
                    <th>Subject / Message</th>
                    <th>Status</th>
                    <th>Received</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inquiries as $inquiry)
                    <tr class="{{ !$inquiry->is_read ? 'table-warning-subtle fw-semibold' : '' }}">
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if(!$inquiry->is_read)
                                    <span class="p-1 bg-warning rounded-circle" title="Unread"></span>
                                @endif
                                <div>
                                    <div class="text-dark">{{ $inquiry->name }}</div>
                                    <small class="text-muted fw-normal">{{ $inquiry->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @php
                                $roleBadge = match($inquiry->role) {
                                    'buyer' => 'primary',
                                    'partner' => 'info text-dark',
                                    'grower' => 'success',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $roleBadge }} text-capitalize px-2 py-1">
                                {{ $inquiry->role }}
                            </span>
                        </td>
                        <td>
                            <div class="text-truncate text-dark" style="max-width: 320px;">
                                {{ $inquiry->subject ?: Str::limit($inquiry->message, 45) }}
                            </div>
                            <small class="text-muted fw-normal text-truncate d-block" style="max-width: 320px;">
                                {{ $inquiry->message }}
                            </small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border text-capitalize">
                                {{ str_replace('_', ' ', $inquiry->status) }}
                            </span>
                        </td>
                        <td>
                            <small class="text-muted fw-normal">{{ $inquiry->created_at->diffForHumans() }}</small>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                Read <i class="bi bi-chevron-right ms-1"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                            No inquiries found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($inquiries->hasPages())
        <div class="card-footer bg-white d-flex justify-content-between align-items-center py-3">
            <small class="text-muted">Showing {{ $inquiries->firstItem() }} to {{ $inquiries->lastItem() }} of {{ $inquiries->total() }} inquiries</small>
            <div>{{ $inquiries->links() }}</div>
        </div>
    @endif
</div>
@endsection
