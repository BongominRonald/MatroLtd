<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MatroLtd — Sign In & Register</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>

    <!-- Notification Toast -->
    <div id="toast" class="toast" role="alert" aria-live="assertive">
        <i id="toastIcon" class='bx bx-info-circle'></i>
        <span id="toastMsg"></span>
    </div>

    <div class="wrapper">
        <div class="container {{ ($initialMode ?? 'login') === 'register' ? 'active' : '' }}" id="container">
            <!-- Curved Animated Background Shapes -->
            <div class="curved-shape"></div>
            <div class="curved-shape2"></div>

            <!-- ================= LOGIN FORM ================= -->
            <div class="form-box Login">
                <h2 class="animation" style="--li: 0s; --lo: 0.5s;">Login</h2>
                <form id="loginForm" action="{{ route('login.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="input-box animation" style="--li: 0.1s; --lo: 0.4s;">
                        <input type="text" id="loginUsername" name="username" value="{{ old('username', session('registered_username', '')) }}" required spellcheck="false" autocomplete="username">
                        <label for="loginUsername">Username</label>
                        <i class='bx bxs-user'></i>
                    </div>

                    <div class="input-box animation" style="--li: 0.2s; --lo: 0.3s;">
                        <input type="password" id="loginPassword" name="password" required autocomplete="current-password">
                        <label for="loginPassword">Password</label>
                        <i class='bx bx-hide toggle-pass' id="toggleLoginPass" title="Toggle password visibility"
                            role="button" tabindex="0"></i>
                    </div>

                    <!-- Lockout Alert -->
                    <div id="lockoutNotice" class="lockout-notice" style="display: none;">
                        <i class='bx bxs-error-circle'></i>
                        <span id="lockoutTimer"></span>
                    </div>

                    <div class="btn-box animation" style="--li: 0.3s; --lo: 0.2s;">
                        <button type="submit" id="btnLogin" class="btn">Login</button>
                    </div>

                    <div class="logreg-link animation" style="--li: 0.4s; --lo: 0.1s;">
                        <p>Don't have an account?</p>
                        <a href="javascript:void(0)" class="SignUpLink">Sign Up</a>
                    </div>
                </form>
            </div>

            <!-- ================= LOGIN INFO TEXT (RIGHT SIDE) ================= -->
            <div class="info-text Login">
                <h2 class="animation" style="--li: 0s; --lo: 0.3s;">WELCOME<br>BACK!</h2>
                <p class="animation" style="--li: 0.15s; --lo: 0.15s;">
                    Sign in to continue to your account.
                </p>
            </div>

            <!-- ================= REGISTER FORM ================= -->
            <div class="form-box Register">
                <h2 class="animation" style="--li: 0s; --lo: 0.6s;">Register</h2>
                <form id="registerForm" action="{{ route('register') }}" method="POST" novalidate>
                    @csrf
                    <div class="input-box animation" style="--li: 0.08s; --lo: 0.5s;">
                        <input type="text" id="regUsername" name="username" required spellcheck="false" autocomplete="username">
                        <label for="regUsername">Username</label>
                        <i class='bx bxs-user'></i>
                    </div>

                    <div class="input-box animation" style="--li: 0.16s; --lo: 0.4s;">
                        <input type="email" id="regEmail" name="email" required spellcheck="false" autocomplete="email">
                        <label for="regEmail">Email</label>
                        <i class='bx bxs-envelope'></i>
                    </div>

                    <div class="input-box password-box animation" style="--li: 0.24s; --lo: 0.3s;">
                        <input type="password" id="regPassword" name="password" required autocomplete="new-password">
                        <label for="regPassword">Password</label>
                        <i class='bx bx-hide toggle-pass' id="toggleRegPass" title="Toggle password visibility"
                            role="button" tabindex="0"></i>
                    </div>

                    <!-- Password Strength Meter -->
                    <div id="strengthContainer" class="strength-container animation" style="--li: 0.32s; --lo: 0.25s;">
                        <div class="strength-bar-track">
                            <div id="strengthBar" class="strength-bar"></div>
                        </div>
                        <div class="strength-meta">
                            <span id="strengthLabel" class="strength-label"></span>
                            <span id="strengthHint" class="strength-hint"></span>
                        </div>
                    </div>

                    <div class="btn-box animation" style="--li: 0.4s; --lo: 0.2s;">
                        <button type="submit" id="btnRegister" class="btn">Register</button>
                    </div>

                    <div class="logreg-link animation" style="--li: 0.48s; --lo: 0.1s;">
                        <p>Already have an account?</p>
                        <a href="javascript:void(0)" class="SignInLink">Sign In</a>
                    </div>
                </form>
            </div>

            <!-- ================= REGISTER INFO TEXT (LEFT SIDE) ================= -->
            <div class="info-text Register">
                <h2 class="animation" style="--li: 0s; --lo: 0.3s;">WELCOME!</h2>
                <p class="animation" style="--li: 0.15s; --lo: 0.15s;">
                    Create an account to get started.
                </p>
            </div>

            <!-- ================= AUTHENTICATED ACTIVE SESSION VIEW ================= -->
            <div id="authSuccessOverlay" class="auth-overlay" style="display: {{ isset($authenticatedUser) && $authenticatedUser ? 'flex' : 'none' }};">
                <div class="auth-card">
                    <i class='bx bxs-check-shield auth-shield-icon'></i>
                    <h2>Signed In</h2>
                    <p class="auth-user-msg">Welcome back, <strong id="authUsername">{{ $authenticatedUser?->name ?? 'User' }}</strong>!</p>
                    <div class="auth-meta-badge">
                        <span class="auth-dot"></span> Active Session
                    </div>
                    <button id="btnLogout" data-logout-url="{{ route('logout') }}" class="btn btn-logout">Sign Out</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('script.js') }}"></script>
</body>

</html>
