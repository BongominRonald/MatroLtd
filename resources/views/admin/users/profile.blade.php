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

    <div class="col-lg-5">
        <!-- Active Browser Sessions & Device Security Card -->
        <div class="card admin-card p-4 mb-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold mb-0">Active Sessions</h5>
                <span class="badge bg-success rounded-pill px-2.5 py-1 small">
                    <i class="bi bi-shield-check me-1"></i>Protected
                </span>
            </div>
            <p class="text-muted small mb-3">
                Manage and log out active browser sessions on other devices. Sessions are encrypted at rest with AES-256 and protected against session hijacking.
            </p>

            @if(isset($sessions) && $sessions->isNotEmpty())
                <div class="list-group list-group-flush mb-4 rounded-3 border">
                    @foreach($sessions as $sess)
                        <div class="list-group-item p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background: rgba(120, 162, 47, 0.15); color: #78a22f; font-size: 1.15rem;">
                                    @if($sess->device_type === 'mobile')
                                        <i class="bi bi-phone"></i>
                                    @elseif($sess->device_type === 'tablet')
                                        <i class="bi bi-tablet"></i>
                                    @else
                                        <i class="bi bi-laptop"></i>
                                    @endif
                                </div>
                                <div class="flex-grow-1 min-w-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <strong class="small text-truncate">{{ $sess->browser }} on {{ $sess->platform }}</strong>
                                        @if($sess->is_current_device)
                                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-0.5" style="font-size: 0.65rem;">This Device</span>
                                        @endif
                                    </div>
                                    <div class="text-muted small" style="font-size: 0.76rem;">
                                        IP: {{ $sess->ip_address }} &bull; {{ $sess->is_current_device ? 'Active now' : $sess->last_active }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Log Out Other Sessions Action -->
            <button type="button" class="btn btn-outline-danger w-100 rounded-pill py-2.5 fw-semibold d-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#logoutOtherDevicesModal">
                <i class="bi bi-box-arrow-right"></i> Log Out Other Browser Sessions
            </button>
        </div>

        <!-- Security Best Practices Notice -->
        <div class="p-3 rounded-3 small" style="background: rgba(120, 162, 47, 0.08); border: 1px solid rgba(120, 162, 47, 0.25);">
            <div class="d-flex align-items-center gap-2 mb-1.5 text-success fw-bold">
                <i class="bi bi-lock-fill"></i> Session Security Active
            </div>
            <ul class="mb-0 ps-3 text-muted" style="font-size: 0.78rem; line-height: 1.5;">
                <li>Cookies are flag-protected (HttpOnly, SameSite=Lax, Secure HTTPS).</li>
                <li>Database sessions are encrypted at rest with AES-256-CBC.</li>
                <li>Changing your password automatically terminates all other active sessions.</li>
            </ul>
        </div>
    </div>
</div>

<!-- Logout Other Devices Modal -->
<div class="modal fade" id="logoutOtherDevicesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('session.logout-other-devices') }}" method="POST" class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            @csrf
            <div class="modal-header border-bottom py-3 px-4">
                <h5 class="modal-title fw-bold">Log Out Other Browser Sessions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted small mb-3">
                    Please enter your account password to confirm you want to sign out of all other active browser sessions across all your devices.
                </p>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Current Account Password *</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password to confirm" required>
                </div>
            </div>
            <div class="modal-footer border-top py-2.5 px-4 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">
                    <i class="bi bi-box-arrow-right me-1"></i> Confirm &amp; Sign Out Other Devices
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
