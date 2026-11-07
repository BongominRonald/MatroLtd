@extends('admin.layouts.admin')

@section('title', 'Inquiry from ' . $inquiry->name . ' — Matro Administration')
@section('page-title', 'Inquiry Details')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.inquiries.index') }}" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left me-1"></i>Back to All Inquiries
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card admin-card p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">{{ $inquiry->subject ?: 'Trade Desk Lead / Inquiry' }}</h5>
                <small class="text-muted">{{ $inquiry->created_at->format('M d, Y \a\t h:i A') }}</small>
            </div>
            <hr class="text-secondary opacity-25">
            <div class="p-3 bg-light rounded border mb-4">
                <p class="mb-0 text-dark" style="white-space: pre-line; line-height: 1.7;">{{ $inquiry->message }}</p>
            </div>

            <div class="d-flex gap-2">
                <a href="mailto:{{ $inquiry->email }}?subject=RE: {{ urlencode($inquiry->subject ?: 'Matro Trade Inquiry') }}" class="btn btn-matro rounded-pill">
                    <i class="bi bi-reply-fill me-1"></i>Reply via Email
                </a>
                @if($inquiry->phone)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}" target="_blank" class="btn btn-outline-success rounded-pill">
                        <i class="bi bi-whatsapp me-1"></i>WhatsApp Chat
                    </a>
                @endif
                <form action="{{ route('admin.inquiries.toggle-read', $inquiry) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary rounded-pill">
                        <i class="bi bi-envelope{{ $inquiry->is_read ? '-open' : '' }} me-1"></i>
                        Mark as {{ $inquiry->is_read ? 'Unread' : 'Read' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card admin-card p-4 mb-4">
            <h6 class="fw-bold mb-3">Contact Information</h6>
            <div class="mb-3">
                <small class="text-muted d-block">Sender Name</small>
                <div class="fw-bold text-dark">{{ $inquiry->name }}</div>
            </div>
            <div class="mb-3">
                <small class="text-muted d-block">Email Address</small>
                <a href="mailto:{{ $inquiry->email }}" class="text-primary text-decoration-none">{{ $inquiry->email }}</a>
            </div>
            @if($inquiry->phone)
                <div class="mb-3">
                    <small class="text-muted d-block">Telephone / WhatsApp</small>
                    <div class="fw-semibold">{{ $inquiry->phone }}</div>
                </div>
            @endif
            <div class="mb-3">
                <small class="text-muted d-block">Inquiry Role / Stakeholder</small>
                @php
                    $roleBadge = match($inquiry->role) {
                        'buyer' => 'primary',
                        'partner' => 'info text-dark',
                        'grower' => 'success',
                        default => 'secondary'
                    };
                @endphp
                <span class="badge bg-{{ $roleBadge }} text-capitalize px-3 py-1">
                    {{ $inquiry->role }}
                </span>
            </div>
            <div>
                <small class="text-muted d-block">Resolution Status</small>
                <form action="{{ route('admin.inquiries.update-status', $inquiry) }}" method="POST" class="mt-1">
                    @csrf
                    <select name="status" class="form-select form-select-sm mb-2" onchange="this.form.submit()">
                        <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>New Inquiry</option>
                        <option value="in_progress" {{ $inquiry->status === 'in_progress' ? 'selected' : '' }}>In Progress / Contacted</option>
                        <option value="resolved" {{ $inquiry->status === 'resolved' ? 'selected' : '' }}>Resolved / Closed</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
