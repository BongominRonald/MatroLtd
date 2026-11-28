<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ($initialMode ?? 'login') === 'register' ? 'Register Buyer Account — BRX AGRO GLOBAL' : 'Sign In — BRX AGRO GLOBAL' }}</title>
    <meta name="description" content="Sign in or register an institutional commodity buyer account with BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA to place sample orders, request FOB/CIF quotes, and track export shipments.">
    <meta name="robots" content="index, follow">
    @if(!empty(config('services.google.site_verification')))
        <meta name="google-site-verification" content="{{ config('services.google.site_verification') }}">
    @endif
    <link rel="canonical" href="{{ ($initialMode ?? 'login') === 'register' ? route('register') : route('login') }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA">
    <meta property="og:title" content="{{ ($initialMode ?? 'login') === 'register' ? 'Register Buyer Account — BRX AGRO GLOBAL' : 'Sign In — BRX AGRO GLOBAL' }}">
    <meta property="og:description" content="Institutional buyer portal for BRX AGRO GLOBAL Brazilian commodity origination and export.">
    <meta property="og:url" content="{{ ($initialMode ?? 'login') === 'register' ? route('register') : route('login') }}">
    <meta property="og:image" content="{{ asset('img/BRX Agro Global Product Emblem.png') }}">
    <!-- Badge Favicon (With 192x192 & 512x512 Rounded Maskable Icons) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('img/icon-512x512.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="BRX Agro">
    <style>
        @media all and (display-mode: standalone), (display-mode: window-controls-overlay), (display-mode: fullscreen) {
            html {
                background-color: #0b0f14 !important;
                height: 100% !important;
                overflow: hidden !important;
            }
            body {
                border-radius: 16px !important; /* Standard 16px OS window curvature */
                overflow-x: hidden !important;
                overflow-y: auto !important;
                min-height: 100vh !important;
                margin: 0 !important;
                box-shadow: 0 0 0 1px rgba(120, 162, 47, 0.22), 0 12px 48px rgba(0, 0, 0, 0.6) !important;
            }
        }
    </style>

    <!-- Local Self-Hosted Assets -->
    <link rel="stylesheet" href="{{ asset('lib/boxicons/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/comic-relief.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/open-sans.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}?v=3.0">
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
            <!-- Curved Animated Background Shapes (Desktop only) -->
            <div class="curved-shape"></div>
            <div class="curved-shape2"></div>

            <!-- Mobile Dynamic Interactive Switcher -->
            <div class="mobile-auth-switcher">
                <button type="button" class="mobile-tab-btn {{ ($initialMode ?? 'login') !== 'register' ? 'active' : '' }}" id="tabLogin" onclick="switchAuthTab('login')">
                    <i class='bx bx-log-in-circle'></i> Sign In
                </button>
                <button type="button" class="mobile-tab-btn {{ ($initialMode ?? 'login') === 'register' ? 'active' : '' }}" id="tabRegister" onclick="switchAuthTab('register')">
                    <i class='bx bx-user-plus'></i> Register
                </button>
            </div>

            <!-- ================= LOGIN FORM ================= -->
            <div class="form-box Login">
                <h2 class="form-title animation" style="--li: 0s; --lo: 0.5s;">Login</h2>
                <p class="form-subtitle animation" style="--li: 0.04s; --lo: 0.46s;">Sign in to your trade desk account</p>

                <form id="loginForm" action="{{ route('login.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="input-box animation" style="--li: 0.08s; --lo: 0.42s;">
                        <label for="loginUsername" class="field-label">Username</label>
                        <div class="field-control-wrap">
                            <i class='bx bxs-user field-icon'></i>
                            <input type="text" id="loginUsername" name="username" class="field-input" placeholder="Enter your username" value="{{ old('username', session('registered_username', '')) }}" required spellcheck="false" autocomplete="username">
                        </div>
                    </div>

                    <div class="input-box animation" style="--li: 0.16s; --lo: 0.34s;">
                        <label for="loginPassword" class="field-label">Password</label>
                        <div class="field-control-wrap">
                            <i class='bx bx-lock-alt field-icon'></i>
                            <input type="password" id="loginPassword" name="password" class="field-input has-toggle" placeholder="Enter your password" required autocomplete="current-password">
                            <i class='bx bx-hide toggle-pass' id="toggleLoginPass" title="Toggle password visibility" role="button" tabindex="0" aria-label="Toggle password visibility"></i>
                        </div>
                    </div>

                    <!-- Lockout Alert -->
                    <div id="lockoutNotice" class="lockout-notice" style="display: none;">
                        <i class='bx bxs-error-circle'></i>
                        <span id="lockoutTimer"></span>
                    </div>

                    <div class="btn-box animation" style="--li: 0.24s; --lo: 0.26s;">
                        <button type="submit" id="btnLogin" class="btn">Login</button>
                    </div>

                    <div class="oauth-box animation" style="--li: 0.30s; --lo: 0.20s;">
                        <div class="oauth-divider">
                            <span>or continue with</span>
                        </div>
                        <a href="{{ route('auth.google') }}" class="btn-google" id="btnGoogleLogin">
                            <svg class="google-svg" viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
                                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                                <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                                <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                            </svg>
                            <span>Continue with Google</span>
                        </a>
                    </div>

                    <div class="logreg-link animation" style="--li: 0.36s; --lo: 0.14s;">
                        <p>Don't have an account?</p>
                        <a href="javascript:void(0)" class="SignUpLink">Register</a>
                    </div>
                </form>
            </div>

            <!-- ================= LOGIN INFO TEXT (RIGHT SIDE) ================= -->
            <div class="info-text Login">
                <div class="info-content-card">
                    <div class="produce-preview-card animation" style="--li: 0s; --lo: 0.35s;">
                        <img src="{{ asset('img/sunflower-bg.webp') }}" alt="Sunflower Plants and Sunflower Oil" class="produce-card-img" onerror="this.onerror=null;this.src='{{ asset('img/sunflower-bg.jpg') }}'">
                        <div class="produce-card-badge gold">
                            <i class='bx bxs-sun'></i> Sunflowers &amp; Pure Oil
                        </div>
                    </div>
                    <h2 class="animation" style="--li: 0.1s; --lo: 0.25s;">WELCOME BACK!</h2>
                    <p class="animation" style="--li: 0.2s; --lo: 0.15s;">
                        Sign in to your account to review live commodity quotes, orders, and export documents.
                    </p>
                </div>
            </div>

            <!-- ================= REGISTER FORM ================= -->
            <div class="form-box Register">
                <h2 class="form-title animation" style="--li: 0s; --lo: 0.6s;">Register</h2>
                <p class="form-subtitle animation" style="--li: 0.03s; --lo: 0.57s;">Create an institutional buyer account</p>

                <div class="register-peppers-strip animation" style="--li: 0.06s; --lo: 0.54s;">
                    <img src="{{ asset('img/banner-container-cargo.webp') }}" alt="Direct Deepwater Container Cargo &amp; Ocean Freight" class="peppers-strip-thumb" onerror="this.onerror=null;this.src='{{ asset('img/banner-container-cargo.jpg') }}'">
                    <div class="peppers-strip-text">
                        <span class="peppers-pill-group">
                            <span class="pill green">FOB</span>
                            <span class="pill yellow">CIF</span>
                            <span class="pill red">CFR</span>
                        </span>
                        <span class="peppers-subtitle">Santos &bull; Paranagu&aacute; &bull; Global Ports</span>
                    </div>
                </div>

                <form id="registerForm" action="{{ route('register') }}" method="POST" novalidate>
                    @csrf
                    <div class="input-box animation" style="--li: 0.08s; --lo: 0.5s;">
                        <label for="regUsername" class="field-label">Username</label>
                        <div class="field-control-wrap">
                            <i class='bx bxs-user field-icon'></i>
                            <input type="text" id="regUsername" name="username" class="field-input" placeholder="Choose a username (3-20 chars)" required spellcheck="false" autocomplete="username">
                        </div>
                    </div>

                    <div class="input-box animation" style="--li: 0.16s; --lo: 0.4s;">
                        <label for="regEmail" class="field-label">Corporate Email</label>
                        <div class="field-control-wrap">
                            <i class='bx bxs-envelope field-icon'></i>
                            <input type="email" id="regEmail" name="email" class="field-input" placeholder="buyer@company.com" required spellcheck="false" autocomplete="email">
                        </div>
                    </div>

                    <div class="input-box password-box animation" style="--li: 0.24s; --lo: 0.3s;">
                        <label for="regPassword" class="field-label">Password</label>
                        <div class="field-control-wrap">
                            <i class='bx bx-lock-alt field-icon'></i>
                            <input type="password" id="regPassword" name="password" class="field-input has-toggle" placeholder="8+ chars with uppercase & symbol" required autocomplete="new-password">
                            <i class='bx bx-hide toggle-pass' id="toggleRegPass" title="Toggle password visibility" role="button" tabindex="0" aria-label="Toggle password visibility"></i>
                        </div>
                    </div>

                    <!-- Password Strength Meter -->
                    <div id="strengthContainer" class="strength-container animation" style="--li: 0.30s; --lo: 0.25s;">
                        <div class="strength-bar-track">
                            <div id="strengthBar" class="strength-bar"></div>
                        </div>
                        <div class="strength-meta">
                            <span id="strengthLabel" class="strength-label"></span>
                            <span id="strengthHint" class="strength-hint"></span>
                        </div>
                    </div>

                    <div class="btn-box animation" style="--li: 0.36s; --lo: 0.2s;">
                        <button type="submit" id="btnRegister" class="btn">Register</button>
                    </div>

                    <div class="oauth-box animation" style="--li: 0.40s; --lo: 0.15s;">
                        <div class="oauth-divider">
                            <span>or continue with</span>
                        </div>
                        <a href="{{ route('auth.google') }}" class="btn-google" id="btnGoogleRegister">
                            <svg class="google-svg" viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
                                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                                <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                                <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                            </svg>
                            <span>Sign up with Google</span>
                        </a>
                    </div>

                    <div class="logreg-link animation" style="--li: 0.46s; --lo: 0.1s;">
                        <p>Already have an account?</p>
                        <a href="javascript:void(0)" class="SignInLink">Sign In</a>
                    </div>
                </form>
            </div>

            <!-- ================= REGISTER INFO TEXT (LEFT SIDE) ================= -->
            <div class="info-text Register">
                <div class="info-content-card">
                    <div class="produce-preview-card animation" style="--li: 0s; --lo: 0.35s;">
                        <img src="{{ asset('img/banner-container-cargo.webp') }}" alt="Direct Deepwater Container Cargo &amp; Ocean Freight" class="produce-card-img" onerror="this.onerror=null;this.src='{{ asset('img/banner-container-cargo.jpg') }}'">
                        <div class="produce-card-badge peppers">
                            <i class='bx bxs-ship'></i>
                            <span>Container Cargo</span>
                        </div>
                    </div>
                    <h2 class="animation" style="--li: 0.1s; --lo: 0.25s;">CONTAINER LOGISTICS</h2>
                    <p class="animation" style="--li: 0.2s; --lo: 0.15s;">
                        Create an institutional buyer account to request FOB/CIF container quotes and deepwater vessel allocation.
                    </p>
                </div>
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

    <script src="{{ asset('js/auth.js') }}?v=3.0"></script>
</body>

</html>
