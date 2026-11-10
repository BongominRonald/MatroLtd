<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BRX AGRO GLOBAL — Sign In & Register</title>
    <!-- Badge Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">

    <!-- Local Self-Hosted Assets -->
    <link rel="stylesheet" href="{{ asset('lib/boxicons/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/comic-relief.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/open-sans.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>

    <!-- Notification Toast -->
    <div id="toast" class="toast" role="alert" aria-live="assertive">
        <i id="toastIcon" class='bx bx-info-circle'></i>
        <span id="toastMsg"></span>
    </div>

    <div class="wrapper">
        <div class="top-nav-bar">
            <a href="{{ route('home') }}" class="back-home-link">
                <i class='bx bx-left-arrow-alt'></i> Back to Homepage
            </a>
        </div>

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
                <div class="produce-preview-card animation" style="--li: 0s; --lo: 0.35s;">
                    <img src="{{ asset('img/sunflower-bg.webp') }}" alt="Sunflower Plants and Sunflower Oil" class="produce-card-img" onerror="this.onerror=null;this.src='{{ asset('img/sunflower-bg.jpg') }}'">
                    <div class="produce-card-badge gold">
                        <i class='bx bxs-sun'></i> Sunflowers &amp; Pure Oil
                    </div>
                </div>
                <h2 class="animation" style="--li: 0.1s; --lo: 0.25s;">WELCOME BACK!</h2>
                <p class="animation" style="--li: 0.2s; --lo: 0.15s;">
                    Sign in to continue to your account.
                </p>
            </div>

            <!-- ================= REGISTER FORM ================= -->
            <div class="form-box Register">
                <h2 class="animation" style="--li: 0s; --lo: 0.6s;">Register</h2>
                <div class="register-peppers-strip animation" style="--li: 0.04s; --lo: 0.55s;">
                    <img src="{{ asset('img/bell-peppers-bg.webp') }}" alt="Green, Yellow &amp; Red Bell Peppers" class="peppers-strip-thumb" onerror="this.onerror=null;this.src='{{ asset('img/bell-peppers-bg.jpg') }}'">
                    <div class="peppers-strip-text">
                        <span class="peppers-pill-group">
                            <span class="pill green">Green</span>
                            <span class="pill yellow">Yellow</span>
                            <span class="pill red">Red</span>
                        </span>
                        <span class="peppers-subtitle">Farm Fresh Bell Peppers</span>
                    </div>
                </div>
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
                <div class="produce-preview-card animation" style="--li: 0s; --lo: 0.35s;">
                    <img src="{{ asset('img/bell-peppers-bg.webp') }}" alt="Fresh Green, Yellow and Red Bell Peppers" class="produce-card-img" onerror="this.onerror=null;this.src='{{ asset('img/bell-peppers-bg.jpg') }}'">
                    <div class="produce-card-badge peppers">
                        <span class="pepper-dot green"></span>
                        <span class="pepper-dot yellow"></span>
                        <span class="pepper-dot red"></span>
                        <span>Bell Peppers</span>
                    </div>
                </div>
                <h2 class="animation" style="--li: 0.1s; --lo: 0.25s;">FRESH PRODUCE</h2>
                <p class="animation" style="--li: 0.2s; --lo: 0.15s;">
                    Create an account to source verified green, yellow &amp; red bell peppers.
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
                    <a id="btnGoHome" href="{{ isset($authenticatedUser) && $authenticatedUser?->isAdmin() ? route('admin.dashboard') : route('home') }}" class="btn btn-go-home">
                        Continue to Homepage
                    </a>
                    <button id="btnLogout" data-logout-url="{{ route('logout') }}" class="btn btn-logout">Sign Out</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
    <script src="{{ asset('script.js') }}"></script>
</body>

</html>
