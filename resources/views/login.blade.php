<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login - Matro E-Commerce</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Relief:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="mb-3">
                <a href="/" class="text-decoration-none text-secondary small"><i class="fa fa-arrow-left me-1"></i>Back to Matro Store</a>
            </div>
            <div class="bg-white rounded-3 shadow p-4 p-md-5">
                <div class="d-flex align-items-center mb-4">
                    <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle me-3 shadow-sm" style="width: 44px; height: 44px;">
                        <i class="fa fa-shopping-basket fs-5"></i>
                    </span>
                    <div>
                        <h3 class="fw-bold mb-0 text-dark">Matro Login</h3>
                        <small class="text-muted">Welcome back to your account</small>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger py-2 small">{{ $errors->first() }}</div>
                @endif
                <form method="POST" action="/login">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Email Address</label>
                        <input type="email" name="email" class="form-control rounded-pill" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Password</label>
                        <input type="password" name="password" class="form-control rounded-pill" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label small" for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-custom rounded-pill w-100 py-2 fw-bold text-white shadow-sm">Login</button>
                </form>
                <div class="mt-4 pt-3 border-top text-center">
                    <p class="mb-0 text-secondary small">Don't have an account yet? <a href="/register" class="text-primary fw-bold text-decoration-none">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
