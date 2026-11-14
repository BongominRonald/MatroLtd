@extends('admin.layouts.admin')

@section('title', 'Admin Profile & Security — BRX Agro Global Administration')
@section('page-title', 'Admin Profile & Password')

@section('content')
@if($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-4">
    <div class="col-lg-7">
        <form action="{{ route('admin.profile.update') }}" method="POST" class="card admin-card p-4">
            @csrf
            @method('PUT')

            <h5 class="fw-bold mb-3">Administrator Details</h5>

            <div class="mb-3">
                <label class="form-label small fw-bold">Name / Username *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold">Email Address *</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                <small class="text-muted">Order and trade desk notifications for administrators are sent to this address.</small>
            </div>

            <hr class="my-3">
            <h5 class="fw-bold mb-3">Change Password</h5>
            <p class="text-muted small">Leave blank if you do not want to change your password.</p>

            <div class="mb-3">
                <label class="form-label small fw-bold">Current Password</label>
                <input type="password" name="current_password" class="form-control" autocomplete="current-password">
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label small fw-bold">New Password</label>
                    <input type="password" name="new_password" class="form-control" autocomplete="new-password">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" class="form-control" autocomplete="new-password">
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-matro rounded-pill px-4">
                    <i class="bi bi-shield-check me-1"></i>Save Account Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
