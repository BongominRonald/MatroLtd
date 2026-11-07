<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#14141a">
    <title>BRX AGRO GLOBAL - Importação e Exportação Ltda | Brazilian Commodity Origination</title>
    <meta content="BRX Agro Global, Importação e Exportação Ltda, Brazilian agro commodities, bulk soybeans, ICUMSA 45 sugar, yellow corn, green coffee, SGS inspection, escrow settlement, Port of Santos, CNPJ 38.471.480/0001-41" name="keywords">
    <meta content="BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA coordinates direct institutional origination of Brazilian agro-commodities for international buyers. Sourced from certified cooperatives, verified by SGS &amp; MAPA, and secured with Tier-1 bank escrow." name="description">

    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Fonts: Arovia / Matro Brand Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Relief:wght@400;700&family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Theme State Initializer (Fast, prevent flash) -->
    <script>
        try {
            document.documentElement.setAttribute('data-theme', localStorage.getItem('sh-theme') || 'dark');
        } catch (e) {}
    </script>

    <style>
        /* ===== Theme Tokens (Using Arovia / Matro Color Palette) ===== */
        :root {
            --sh-primary: #78a22f;          /* Agrovia Primary Olive Green */
            --sh-primary-dark: #5e8024;     /* Darker Olive Green */
            --sh-emerald: #10b981;          /* Emerald Green Accent */
            --sh-gold: #f59e0b;             /* Gold / Yellow Accent */
            --sh-black: #14141a;            /* Fume-style Deep Charcoal/Black */
            --sh-surface: #1b1b24;          /* Surface Card Background */
            --sh-surface-alt: #161620;      /* Slightly darker section background */
            --sh-border: rgba(255, 255, 255, 0.12);
            --sh-input-bg: #161620;

            --bs-body-bg: #14141a;
            --bs-body-color: #ececf1;
            --bs-secondary-color: rgba(236, 236, 241, 0.68);
            --bs-border-color: rgba(255, 255, 255, 0.12);
            --bs-emphasis-color: #ffffff;
            --bs-link-color: #93c441;
            --bs-link-hover-color: var(--sh-primary);
        }

        html[data-theme="light"] {
            --sh-surface: #ffffff;
            --sh-surface-alt: #f1f2f6;
            --sh-border: rgba(20, 20, 26, 0.12);
            --sh-input-bg: #ffffff;

            --bs-body-bg: #f7f7f9;
            --bs-body-color: #17171c;
            --bs-secondary-color: rgba(35, 35, 44, 0.72);
            --bs-border-color: rgba(20, 20, 26, 0.14);
            --bs-emphasis-color: #14141a;
            --bs-link-color: #5e8024;
        }

        /* Universal Theme Visibility Helpers */
        .sh-text-title { color: var(--bs-emphasis-color) !important; }
        .sh-text-body { color: var(--bs-body-color) !important; }
        .sh-text-muted { color: var(--bs-secondary-color) !important; }
        .sh-card-bg { background-color: var(--sh-surface) !important; border-color: var(--bs-border-color) !important; }
        .sh-box-bg { background-color: var(--sh-surface-alt) !important; border-color: var(--bs-border-color) !important; }

        /* Universal Dropdowns & Filter Buttons */
        .dropdown-menu {
            background-color: var(--sh-surface) !important;
            border: 1px solid var(--bs-border-color) !important;
        }
        .dropdown-item {
            color: var(--bs-body-color) !important;
        }
        .dropdown-item:hover, .dropdown-item:focus {
            background-color: rgba(120, 162, 47, 0.15) !important;
            color: var(--sh-primary) !important;
        }
        .agro-filter-btn {
            border-color: var(--bs-border-color) !important;
            color: var(--bs-body-color) !important;
            background: transparent;
            transition: all .15s ease;
        }
        .agro-filter-btn:hover,
        .agro-filter-btn.active {
            background-color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
            color: #ffffff !important;
        }
        .sh-input {
            background-color: var(--sh-input-bg) !important;
            color: var(--bs-body-color) !important;
            border: 1px solid var(--bs-border-color) !important;
        }
        .sh-input:focus {
            background-color: var(--sh-input-bg) !important;
            color: var(--bs-body-color) !important;
            border-color: var(--sh-primary) !important;
            box-shadow: 0 0 0 0.25rem rgba(120, 162, 47, 0.25) !important;
        }
        .sh-input::placeholder {
            color: var(--bs-secondary-color) !important;
            opacity: 0.75;
        }
        .sh-input option {
            background-color: var(--sh-surface);
            color: var(--bs-body-color);
        }
        .form-label {
            color: var(--bs-emphasis-color) !important;
        }

        /* ===== Typography (Arovia / Matro Font Family) ===== */
        body {
            font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 1rem;
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            transition: background-color .25s ease, color .25s ease;
        }

        h1, h2, h3, h4, h5, h6,
        .sh-title, .navbar-brand, .sh-brand-title {
            font-family: 'Comic Relief', 'Open Sans', system-ui, sans-serif;
            font-weight: 700;
            color: var(--bs-emphasis-color);
        }

        /* ===== BRX AGRO GLOBAL Brand Emblem & Artistic Typography Lockup ===== */
        .brx-navbar-brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            padding: 0;
            margin-right: 1.25rem;
            flex-shrink: 0;
            transition: opacity .2s ease;
        }
        .brx-navbar-brand:hover {
            opacity: 0.94;
        }
        .brx-navbar-emblem {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.22);
            border: 2px solid var(--sh-primary);
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .brx-navbar-brand:hover .brx-navbar-emblem {
            transform: scale(1.06);
            box-shadow: 0 4px 14px rgba(120, 162, 47, 0.4);
        }
        .brx-brand-wrap {
            display: flex;
            flex-direction: column;
            justify-content: center;
            line-height: 1.1;
        }
        .brx-brand-row {
            display: flex;
            align-items: baseline;
            gap: 5px;
        }
        .brx-name-lead {
            font-family: 'Comic Relief', 'Open Sans', system-ui, sans-serif;
            font-weight: 900;
            font-size: 1.16rem;
            letter-spacing: 0.8px;
            line-height: 1;
        }
        .brx-name-tag {
            font-family: 'Comic Relief', 'Open Sans', system-ui, sans-serif;
            font-weight: 800;
            font-size: 0.94rem;
            letter-spacing: 1px;
            line-height: 1;
        }
        .brx-legal-sub {
            font-family: 'Open Sans', system-ui, -apple-system, sans-serif;
            font-size: 0.52rem;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            display: block;
            margin-top: 3px;
            line-height: 1.1;
            white-space: nowrap;
        }

        /* Light Theme Brand Colors */
        html[data-theme="light"] .brx-name-lead {
            color: #14532d !important; /* Deep Brazilian Emerald Green */
        }
        html[data-theme="light"] .brx-name-tag {
            color: #5e8024 !important; /* Rich Olive */
        }
        html[data-theme="light"] .brx-legal-sub {
            color: #334155 !important; /* Elegant Slate */
        }

        /* Dark Theme Brand Colors */
        html[data-theme="dark"] .brx-name-lead {
            color: #22c55e !important; /* Bright Emerald */
        }
        html[data-theme="dark"] .brx-name-tag {
            color: #93c441 !important; /* Vibrant Olive */
        }
        html[data-theme="dark"] .brx-legal-sub {
            color: rgba(255, 255, 255, 0.72) !important;
        }

        /* ===== Navbar (Straightline Horizontal Layout) ===== */
        .sh-navbar {
            z-index: 1030;
            padding-top: 0.55rem !important;
            padding-bottom: 0.55rem !important;
            transition: background-color .25s ease, border-color .25s ease, box-shadow .25s ease;
        }
        @media (min-width: 992px) {
            .sh-nav-straightline {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                align-items: center !important;
                white-space: nowrap !important;
                gap: 0.2rem !important;
                margin-bottom: 0;
            }
            .sh-nav-straightline .nav-item {
                flex-shrink: 0;
            }
            .sh-navbar .nav-link {
                font-weight: 600;
                font-size: 0.82rem;
                padding: 0.35rem 0.45rem !important;
                border-radius: 6px;
                white-space: nowrap;
                transition: color .2s ease, background-color .2s ease;
            }
        }
        @media (min-width: 1400px) {
            .sh-nav-straightline {
                gap: 0.4rem !important;
            }
            .sh-navbar .nav-link {
                font-size: 0.86rem;
                padding: 0.4rem 0.55rem !important;
            }
        }
        .sh-navbar .nav-link:hover,
        .sh-navbar .nav-link.active {
            color: var(--sh-primary) !important;
        }
        .sh-nav-dropdown .dropdown-menu {
            border-radius: 10px;
            padding: 0.5rem 0;
            min-width: 220px;
            box-shadow: 0 14px 35px rgba(0, 0, 0, 0.25);
        }
        .sh-nav-dropdown .dropdown-header {
            color: var(--sh-primary);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 0.4rem 1rem;
        }
        .sh-nav-dropdown .dropdown-item {
            font-size: 0.86rem;
            padding: 0.45rem 1rem;
            transition: all .15s ease;
        }
        .sh-nav-dropdown .dropdown-item:hover {
            background: rgba(120, 162, 47, 0.15);
            color: var(--sh-primary);
        }
        @media (min-width: 992px) {
            .sh-nav-dropdown:hover > .dropdown-menu {
                display: block;
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            .sh-nav-dropdown > .dropdown-menu {
                display: block;
                opacity: 0;
                visibility: hidden;
                transform: translateY(6px);
                transition: opacity .2s ease, transform .2s ease;
            }
        }
        @media (max-width: 991.98px) {
            .sh-navbar .navbar-nav {
                text-align: center;
                padding-top: 1rem;
                padding-bottom: 1rem;
            }
            .sh-navbar .sh-nav-actions {
                justify-content: center;
                width: 100%;
                padding-top: 0.5rem;
            }
            .brx-name-lead { font-size: 1.05rem; }
            .brx-name-tag { font-size: 0.85rem; }
            .brx-legal-sub { font-size: 0.46rem; }
            .brx-navbar-emblem { width: 38px; height: 38px; }
        }

        /* ===== Navbar Actions (Theme, Search, Cart, Login, Signup) ===== */
        .sh-icon-btn,
        .sh-theme-toggle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.22) !important;
            background: rgba(255, 255, 255, 0.12) !important;
            color: #ffffff !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all .2s ease;
            text-decoration: none;
            padding: 0;
            flex-shrink: 0;
        }
        .sh-icon-btn:hover,
        .sh-theme-toggle:hover {
            color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
            background: rgba(120, 162, 47, 0.25) !important;
            transform: scale(1.05);
        }
        html[data-theme="light"] .sh-icon-btn,
        html[data-theme="light"] .sh-theme-toggle {
            background: rgba(20, 20, 26, 0.06) !important;
            border-color: rgba(20, 20, 26, 0.18) !important;
            color: #14141a !important;
        }
        html[data-theme="light"] .sh-icon-btn:hover,
        html[data-theme="light"] .sh-theme-toggle:hover {
            color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
            background: rgba(120, 162, 47, 0.15) !important;
        }

        .sh-cart-icon {
            position: relative;
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.12) !important;
            border: 1px solid rgba(255, 255, 255, 0.22) !important;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            text-decoration: none;
            cursor: pointer;
            transition: all .2s ease;
            flex-shrink: 0;
        }
        .sh-cart-icon:hover {
            background: rgba(120, 162, 47, 0.25) !important;
            border-color: var(--sh-primary) !important;
            color: var(--sh-primary) !important;
            transform: scale(1.05);
        }
        html[data-theme="light"] .sh-cart-icon {
            color: #14141a !important;
            background: rgba(20, 20, 26, 0.06) !important;
            border-color: rgba(20, 20, 26, 0.18) !important;
        }
        html[data-theme="light"] .sh-cart-icon:hover {
            color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
            background: rgba(120, 162, 47, 0.15) !important;
        }
        .sh-cart-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: var(--sh-primary) !important;
            color: #ffffff !important;
            font-size: .65rem;
            font-weight: 700;
            border-radius: 999px;
            min-width: 19px;
            height: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            border: 2px solid var(--sh-surface);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.35);
        }

        .btn-sh-login {
            background: #198754 !important;
            color: #ffffff !important;
            border: 2px solid #198754 !important;
            font-family: 'Comic Relief', 'Open Sans', system-ui;
            font-weight: 700;
            font-size: 0.86rem;
            padding: .38rem 1.1rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all .2s ease;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(25, 135, 84, 0.35);
        }
        .btn-sh-login:hover {
            background: #157347 !important;
            border-color: #157347 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(25, 135, 84, 0.5);
            transform: translateY(-1px);
        }

        .sh-toggler {
            width: 40px;
            height: 36px;
            padding: 0;
            border-radius: 8px;
            background: transparent;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        .sh-toggler .bar {
            display: block;
            width: 20px;
            height: 1.5px;
            transition: transform .25s ease, opacity .2s ease;
        }
        .sh-toggler[aria-expanded="true"] .bar:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
        .sh-toggler[aria-expanded="true"] .bar:nth-child(2) { opacity: 0; }
        .sh-toggler[aria-expanded="true"] .bar:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

        /* ===== LIGHT THEME: 100% Explicit High Contrast for Navbar Elements ===== */
        html[data-theme="light"] .sh-navbar {
            background-color: #ffffff !important;
            border-bottom: 1px solid rgba(20, 20, 26, 0.12) !important;
            box-shadow: 0 2px 14px rgba(0, 0, 0, 0.05) !important;
        }
        html[data-theme="light"] .sh-navbar .nav-link {
            color: #1e293b !important;
        }
        html[data-theme="light"] .sh-navbar .nav-link:hover,
        html[data-theme="light"] .sh-navbar .nav-link.active {
            color: var(--sh-primary) !important;
        }
        html[data-theme="light"] .sh-navbar .sh-icon-btn,
        html[data-theme="light"] .sh-navbar .sh-theme-toggle {
            color: #0f172a !important;
            border: 1.5px solid rgba(15, 23, 42, 0.22) !important;
            background-color: #f1f5f9 !important;
        }
        html[data-theme="light"] .sh-navbar .sh-icon-btn i,
        html[data-theme="light"] .sh-navbar .sh-theme-toggle i {
            color: #0f172a !important;
            font-weight: 700 !important;
        }
        html[data-theme="light"] .sh-navbar .sh-icon-btn:hover,
        html[data-theme="light"] .sh-navbar .sh-theme-toggle:hover {
            color: #ffffff !important;
            background-color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
        }
        html[data-theme="light"] .sh-navbar .sh-icon-btn:hover i,
        html[data-theme="light"] .sh-navbar .sh-theme-toggle:hover i {
            color: #ffffff !important;
        }
        html[data-theme="light"] .sh-navbar .sh-cart-icon,
        html[data-theme="light"] .sh-navbar .sh-cart-icon i {
            color: #0f172a !important;
            font-weight: 700 !important;
        }
        html[data-theme="light"] .sh-navbar .sh-cart-icon:hover,
        html[data-theme="light"] .sh-navbar .sh-cart-icon:hover i {
            color: var(--sh-primary) !important;
        }
        html[data-theme="light"] .sh-navbar .btn-sh-login {
            color: #0f172a !important;
            border: 1.5px solid rgba(15, 23, 42, 0.25) !important;
            background-color: #f1f5f9 !important;
        }
        html[data-theme="light"] .sh-navbar .btn-sh-login:hover {
            color: #ffffff !important;
            background-color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
        }
        html[data-theme="light"] .sh-navbar .sh-toggler {
            border: 1.5px solid rgba(15, 23, 42, 0.25) !important;
            background-color: #f1f5f9 !important;
        }
        html[data-theme="light"] .sh-navbar .sh-toggler .bar {
            background-color: #0f172a !important;
        }

        /* ===== DARK THEME: 100% Explicit High Contrast for Navbar Elements ===== */
        html[data-theme="dark"] .sh-navbar {
            background-color: #14141a !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.45) !important;
        }
        html[data-theme="dark"] .sh-navbar .nav-link {
            color: rgba(255, 255, 255, 0.88) !important;
        }
        html[data-theme="dark"] .sh-navbar .nav-link:hover,
        html[data-theme="dark"] .sh-navbar .nav-link.active {
            color: var(--sh-primary) !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-icon-btn,
        html[data-theme="dark"] .sh-navbar .sh-theme-toggle {
            color: #ffffff !important;
            border: 1.5px solid rgba(255, 255, 255, 0.2) !important;
            background-color: rgba(255, 255, 255, 0.05) !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-icon-btn i,
        html[data-theme="dark"] .sh-navbar .sh-theme-toggle i {
            color: #ffffff !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-icon-btn:hover,
        html[data-theme="dark"] .sh-navbar .sh-theme-toggle:hover {
            color: #ffffff !important;
            background-color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-icon-btn:hover i,
        html[data-theme="dark"] .sh-navbar .sh-theme-toggle:hover i {
            color: #ffffff !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-cart-icon,
        html[data-theme="dark"] .sh-navbar .sh-cart-icon i {
            color: #ffffff !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-cart-icon:hover,
        html[data-theme="dark"] .sh-navbar .sh-cart-icon:hover i {
            color: var(--sh-primary) !important;
        }
        html[data-theme="dark"] .sh-navbar .btn-sh-login {
            color: #ffffff !important;
            border: 1.5px solid rgba(255, 255, 255, 0.3) !important;
            background-color: rgba(255, 255, 255, 0.06) !important;
        }
        html[data-theme="dark"] .sh-navbar .btn-sh-login:hover {
            color: #ffffff !important;
            background-color: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-toggler {
            border: 1.5px solid rgba(255, 255, 255, 0.25) !important;
        }
        html[data-theme="dark"] .sh-navbar .sh-toggler .bar {
            background-color: #ffffff !important;
        }

        /* ===== General Buttons ===== */
        .btn-sh-primary {
            background: var(--sh-primary);
            border-color: var(--sh-primary);
            color: #fff;
            font-family: 'Comic Relief', 'Open Sans', system-ui;
            font-weight: 600;
            padding: .5rem 1.3rem;
            border-radius: 8px;
            transition: all .2s ease;
        }
        .btn-sh-primary:hover {
            background: var(--sh-primary-dark);
            border-color: var(--sh-primary-dark);
            color: #fff;
        }
        .btn-sh-outline-white {
            color: #fff;
            border: 2px solid rgba(255, 255, 255, 0.35);
            font-family: 'Comic Relief', 'Open Sans', system-ui;
            font-weight: 600;
            padding: .55rem 1.4rem;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(4px);
            transition: all .2s ease;
        }
        .btn-sh-outline-white:hover {
            background: var(--sh-primary);
            border-color: var(--sh-primary);
            color: #fff;
        }
        .btn-sh-login {
            background: #198754 !important;
            color: #ffffff !important;
            border: 2px solid #198754 !important;
            font-family: 'Comic Relief', 'Open Sans', system-ui;
            font-weight: 700;
            padding: .35rem 1rem;
            border-radius: 8px;
            transition: all .2s ease;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(25, 135, 84, 0.35);
        }
        .btn-sh-login:hover {
            background: #157347 !important;
            border-color: #157347 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(25, 135, 84, 0.5);
            transform: translateY(-1px);
        }
        html[data-theme="light"] .btn-sh-login {
            background: #198754 !important;
            border-color: #198754 !important;
            color: #ffffff !important;
        }
        html[data-theme="light"] .btn-sh-login:hover {
            background: #157347 !important;
            border-color: #157347 !important;
            color: #ffffff !important;
        }
        .btn-sh-outline {
            border: 2px solid var(--bs-body-color);
            color: var(--bs-body-color);
            font-weight: 600;
            padding: .5rem 1.25rem;
            border-radius: 8px;
            background: transparent;
            text-decoration: none;
            transition: all .2s ease;
        }
        .btn-sh-outline:hover {
            background: var(--bs-emphasis-color);
            color: var(--bs-body-bg);
            border-color: var(--bs-emphasis-color);
        }

        html[data-theme="light"] .btn-sh-outline-white {
            color: var(--bs-emphasis-color);
            border-color: var(--bs-border-color);
            background: transparent;
        }
        html[data-theme="light"] .btn-sh-outline-white:hover {
            background: var(--sh-primary);
            border-color: var(--sh-primary);
            color: #fff;
        }

        /* Hero buttons must always be white on the dark image background */
        .sh-hero .btn-sh-outline-white,
        html[data-theme="light"] .sh-hero .btn-sh-outline-white {
            color: #ffffff !important;
            border: 2px solid rgba(255, 255, 255, 0.45) !important;
            background: rgba(255, 255, 255, 0.08) !important;
        }
        .sh-hero .btn-sh-outline-white:hover,
        html[data-theme="light"] .sh-hero .btn-sh-outline-white:hover {
            background: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
            color: #ffffff !important;
        }

        .btn-close {
            transition: filter .2s ease;
        }
        html[data-theme="dark"] .btn-close,
        [data-theme="dark"] .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        html[data-theme="light"] .btn-close,
        [data-theme="light"] .btn-close {
            filter: none;
        }

        /* ===== Accordion Theme Rules ===== */
        .sh-accordion .accordion-item {
            background-color: var(--sh-surface) !important;
            border: 1px solid var(--bs-border-color) !important;
        }
        .sh-accordion .accordion-button {
            background-color: var(--sh-surface) !important;
            color: var(--bs-emphasis-color) !important;
        }
        .sh-accordion .accordion-button:not(.collapsed) {
            background-color: rgba(120, 162, 47, 0.12) !important;
            color: var(--sh-primary) !important;
        }
        .sh-accordion .accordion-body {
            background-color: var(--sh-surface) !important;
            color: var(--bs-secondary-color) !important;
        }
        html[data-theme="dark"] .sh-accordion .accordion-button::after {
            filter: invert(1) grayscale(100%);
        }
        html[data-theme="light"] .sh-accordion .accordion-button::after {
            filter: none;
        }

        /* ===== Hero Carousel ===== */
        .sh-hero {
            background: var(--sh-black);
            position: relative;
        }
        .sh-hero-slide {
            position: relative;
            overflow: hidden;
            min-height: min(84vh, 720px);
            display: flex;
            align-items: center;
        }
        .sh-hero-bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1.05);
            animation: sh-hero-zoom 10s ease-out forwards;
        }
        @keyframes sh-hero-zoom {
            from { transform: scale(1.08); }
            to { transform: scale(1); }
        }
        .sh-hero-scrim {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(90deg, rgba(20, 20, 26, 0.94) 0%, rgba(20, 20, 26, 0.72) 48%, rgba(20, 20, 26, 0.25) 100%),
                linear-gradient(0deg, rgba(20, 20, 26, 0.8) 0%, rgba(20, 20, 26, 0) 40%);
        }
        .sh-hero-content {
            position: relative;
            z-index: 2;
            padding-top: 4.5rem;
            padding-bottom: 4.5rem;
            max-width: 720px;
        }
        .sh-hero .eyebrow {
            color: var(--sh-primary);
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-size: .8rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sh-hero .eyebrow::before {
            content: "";
            width: 36px;
            height: 2px;
            background: var(--sh-primary);
            display: inline-block;
        }
        .sh-hero h1 {
            color: #fff;
            font-size: clamp(2.2rem, 4.5vw + .5rem, 3.8rem);
            line-height: 1.15;
            text-shadow: 0 2px 24px rgba(0, 0, 0, 0.6);
        }
        .sh-hero h1 span {
            color: var(--sh-primary);
        }
        .sh-hero p.lead {
            color: rgba(255, 255, 255, 0.88);
            font-size: clamp(1rem, .5vw + .85rem, 1.25rem);
        }
        .sh-hero-stats > div {
            border-left: 2px solid var(--sh-primary);
            padding-left: 12px;
        }

        /* ===== Feature Strip ===== */
        .sh-strip {
            background: var(--sh-primary);
            color: #fff;
        }
        .sh-strip .item i {
            font-size: 1.7rem;
            margin-bottom: .25rem;
        }
        .sh-strip .item strong {
            font-size: 1rem;
        }
        .sh-strip .item small {
            opacity: 0.9;
            font-size: .82rem;
            line-height: 1.2;
        }

        /* ===== Product Card (Exact fume-main architecture) ===== */
        .sh-product-card {
            background: var(--sh-surface);
            border-radius: 12px;
            overflow: hidden;
            transition: box-shadow .2s ease, transform .2s ease;
            position: relative;
            border: 1px solid var(--bs-border-color);
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .sh-product-card:hover {
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.25);
            transform: translateY(-4px);
            border-color: var(--sh-primary);
        }
        .sh-product-img {
            aspect-ratio: 1 / 1;
            position: relative;
            overflow: hidden;
            display: block;
            background: #000;
        }
        .sh-product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }
        .sh-product-card:hover .sh-product-img img {
            transform: scale(1.06);
        }
        .sh-badge-sale, .sh-badge-new {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 2;
            color: #fff;
            font-size: .62rem;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 999px;
            letter-spacing: .5px;
        }
        .sh-badge-sale { background: var(--sh-primary); }
        .sh-badge-new { background: #10b981; }
        .sh-badge-original {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 2;
            background: rgba(20, 20, 26, 0.65);
            color: rgba(255, 255, 255, 0.85);
            font-size: .6rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 999px;
            text-decoration: line-through;
            backdrop-filter: blur(4px);
        }
        .sh-card-body {
            padding: 14px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }
        .sh-card-brand {
            color: var(--bs-secondary-color);
            font-size: .68rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .sh-card-name {
            color: var(--bs-emphasis-color);
            font-size: .95rem;
            font-weight: 700;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .sh-card-price {
            display: flex;
            align-items: baseline;
            gap: 6px;
            flex-wrap: wrap;
            margin-top: 4px;
        }
        .price-now {
            color: var(--sh-primary);
            font-weight: 800;
            font-size: 1.05rem;
        }
        .price-old {
            text-decoration: line-through;
            color: var(--bs-secondary-color);
            font-size: .75rem;
        }
        .sh-discount-tag {
            display: inline-block;
            background: rgba(120, 162, 47, 0.16);
            color: var(--sh-primary);
            font-size: .62rem;
            font-weight: 700;
            padding: 0 6px;
            border-radius: 999px;
        }
        .sh-card-rating {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: .65rem;
        }
        .sh-card-rating .stars {
            color: var(--sh-gold);
        }
        .sh-card-cart-btn {
            width: 100%;
            padding: 8px 0;
            background: var(--sh-primary);
            color: #fff;
            border: none;
            border-radius: 999px;
            font-weight: 600;
            font-size: .85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: auto;
            transition: all .2s;
            cursor: pointer;
            text-decoration: none;
        }
        .sh-card-cart-btn:hover {
            background: var(--sh-primary-dark);
            color: #fff;
        }

        /* ===== Section Titles ===== */
        .sh-eyebrow {
            color: var(--sh-primary);
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-size: 0.8rem;
            margin-bottom: .25rem;
        }
        .sh-title {
            font-weight: 800;
            color: var(--bs-emphasis-color);
        }

        /* ===== Category Cards ===== */
        .sh-cat-card {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            height: 220px;
            display: flex;
            align-items: flex-end;
            text-decoration: none;
            border: 1px solid var(--bs-border-color);
        }
        .sh-cat-card img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s ease;
        }
        .sh-cat-card:hover img {
            transform: scale(1.08);
        }
        .sh-cat-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(20, 20, 26, 0.88), rgba(20, 20, 26, 0.1));
        }
        .sh-cat-card .label {
            position: relative;
            z-index: 2;
            padding: 1.25rem;
            color: #fff;
        }
        .sh-cat-card .label h5 {
            font-weight: 700;
            margin-bottom: .2rem;
            color: #fff;
        }
        .sh-cat-card .label span {
            color: var(--sh-primary);
            font-weight: 600;
            font-size: .85rem;
        }

        /* ===== Promo Banner ===== */
        .sh-promo {
            background: var(--sh-primary);
            border-radius: 18px;
            overflow: hidden;
            position: relative;
            color: #fff;
        }
        .sh-promo h3 {
            color: #fff;
            font-weight: 800;
        }
        .sh-promo p {
            color: rgba(255, 255, 255, 0.92);
        }

        /* ===== Testimonials ===== */
        .sh-testimonial {
            background: var(--sh-surface);
            border-radius: 14px;
            padding: 1.5rem;
            height: 100%;
            border: 1px solid var(--bs-border-color);
        }
        .sh-stars {
            color: var(--sh-gold);
            letter-spacing: 2px;
        }

        /* ===== Footer (Horizontal Layout Across All Elements) ===== */
        .sh-footer {
            background: #111116 !important;
            color: rgba(255, 255, 255, 0.72) !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        .sh-footer h6,
        .sh-footer .sh-footer-col h6,
        .sh-footer .sh-footer-col-brand h6,
        .sh-footer .sh-footer-col-contact h6 {
            color: #ffffff !important;
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 1rem;
            letter-spacing: 0.5px;
        }
        .sh-footer a {
            color: rgba(255, 255, 255, 0.7) !important;
            text-decoration: none;
            transition: color .2s ease;
        }
        .sh-footer a:hover {
            color: var(--sh-primary) !important;
        }
        .sh-footer .social-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.25) !important;
            background: rgba(255, 255, 255, 0.05);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff !important;
            margin-right: .5rem;
            transition: all .2s ease;
        }
        .sh-footer .social-icon:hover {
            background: var(--sh-primary) !important;
            border-color: var(--sh-primary) !important;
            color: #ffffff !important;
        }
        .sh-footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .sh-footer-horizontal-wrap {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;
            align-items: flex-start;
            gap: 2.25rem;
            width: 100%;
        }
        .sh-footer-col-brand {
            flex: 2.2 1 240px;
            min-width: 210px;
            max-width: 290px;
        }
        .sh-footer-col {
            flex: 1.1 1 125px;
            min-width: 115px;
        }
        .sh-footer-col-contact {
            flex: 1.8 1 220px;
            min-width: 200px;
        }

        @media (max-width: 1199.98px) {
            .sh-footer-horizontal-wrap {
                flex-wrap: wrap;
                gap: 2rem 1.5rem;
            }
            .sh-footer-col-brand {
                flex: 1 1 100%;
                max-width: 100%;
                border-bottom: 1px solid var(--sh-border);
                padding-bottom: 1.25rem;
                margin-bottom: 0.25rem;
            }
            .sh-footer-col {
                flex: 1 1 calc(25% - 1.5rem);
                min-width: 130px;
            }
            .sh-footer-col-contact {
                flex: 1 1 calc(50% - 1.5rem);
                min-width: 220px;
            }
        }
        @media (max-width: 767.98px) {
            .sh-footer-horizontal-wrap {
                flex-wrap: wrap;
                gap: 1.5rem 1rem;
            }
            .sh-footer-col {
                flex: 1 1 calc(50% - 1rem);
            }
            .sh-footer-col-contact {
                flex: 1 1 100%;
            }
        }

        /* ===== Mobile Bottom Navigation (sh-tabbar) ===== */
        .sh-tabbar {
            display: none;
        }
        @media (max-width: 991.98px) {
            .sh-tabbar {
                display: flex;
                position: fixed;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 1045;
                background: rgba(20, 20, 26, 0.98);
                backdrop-filter: blur(12px);
                border-top: 1px solid rgba(255, 255, 255, 0.12);
                padding: 6px 4px calc(6px + env(safe-area-inset-bottom));
                justify-content: space-around;
                align-items: center;
            }
            body { padding-bottom: 64px; }
        }
        .sh-tabbar > a {
            flex: 1 1 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            font-size: .68rem;
            font-weight: 600;
            position: relative;
            transition: color .18s ease;
        }
        .sh-tabbar > a.active, .sh-tabbar > a:hover { color: var(--sh-primary); }
        html[data-theme="light"] .sh-tabbar {
            background: rgba(255, 255, 255, 0.98);
            border-top: 1px solid rgba(20, 20, 26, 0.12);
        }
        html[data-theme="light"] .sh-tabbar > a {
            color: rgba(20, 20, 26, 0.68);
        }
        html[data-theme="light"] .sh-tabbar > a.active,
        html[data-theme="light"] .sh-tabbar > a:hover {
            color: var(--sh-primary);
        }
        .sh-tabbar-badge {
            position: absolute;
            top: -2px;
            left: calc(50% + 6px);
            min-width: 16px;
            height: 16px;
            padding: 0 4px;
            background: var(--sh-primary);
            color: #fff;
            font-size: .58rem;
            font-weight: 700;
            line-height: 16px;
            text-align: center;
            border-radius: 999px;
        }

        /* ===== Agrovia Commodity Cart Drawer ===== */
        .sh-cart-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(10, 12, 16, 0.72);
            backdrop-filter: blur(4px);
            z-index: 1055;
            opacity: 0;
            visibility: hidden;
            transition: opacity .25s ease, visibility .25s ease;
        }
        .sh-cart-backdrop.show {
            opacity: 1;
            visibility: visible;
        }
        .sh-cart-offcanvas {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            width: 440px !important;
            max-width: 100vw !important;
            background: var(--sh-surface) !important;
            color: var(--bs-body-color) !important;
            border-left: 1px solid var(--sh-border) !important;
            box-shadow: -10px 0 40px rgba(0, 0, 0, 0.5);
            z-index: 1060;
            transform: translateX(100%);
            transition: transform .32s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
        }
        .sh-cart-offcanvas.show {
            transform: translateX(0);
        }
        .sh-cart-offcanvas .offcanvas-header {
            border-bottom: 1px solid var(--sh-border);
            padding: 1.1rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .sh-cart-offcanvas .offcanvas-body {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            flex: 1 1 auto;
        }
        .sh-cart-items-container {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }
        .sh-cart-item {
            background: var(--sh-surface-alt, rgba(255, 255, 255, 0.04));
            border: 1px solid var(--sh-border);
            border-radius: 12px;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: border-color .2s ease, transform .2s ease;
        }
        .sh-cart-item:hover {
            border-color: rgba(120, 162, 47, 0.45);
            transform: translateY(-1px);
        }
        .sh-cart-thumb {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--sh-border);
            flex-shrink: 0;
        }
        .sh-cart-qty-ctrl {
            display: inline-flex;
            align-items: center;
            background: var(--sh-surface);
            border: 1px solid var(--sh-border);
            border-radius: 30px;
            padding: 2px 4px;
        }
        .sh-cart-qty-btn {
            background: transparent;
            border: none;
            color: var(--bs-body-color);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            cursor: pointer;
            transition: background .15s ease, color .15s ease;
        }
        .sh-cart-qty-btn:hover {
            background: var(--sh-primary);
            color: #fff;
        }
        .sh-cart-qty-val {
            font-size: .85rem;
            font-weight: 700;
            padding: 0 8px;
            min-width: 26px;
            text-align: center;
            color: var(--bs-emphasis-color);
        }
        .sh-cart-assurance-card {
            background: rgba(120, 162, 47, 0.08);
            border: 1px solid rgba(120, 162, 47, 0.25);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: .8rem;
        }
        .sh-cart-summary-box {
            background: var(--sh-surface-alt, rgba(255, 255, 255, 0.04));
            border: 1px solid var(--sh-border);
            border-radius: 12px;
            padding: 14px;
        }

        /* ===== Cart Toast ===== */
        .sh-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 12px;
            background: #1b1b24;
            color: #fff;
            padding: 14px 20px;
            border-radius: 12px;
            border: 1px solid var(--sh-primary);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.5);
            min-width: 280px;
            max-width: 380px;
            transform: translateX(130%);
            opacity: 0;
            transition: transform .4s cubic-bezier(.16, 1, .3, 1), opacity .4s ease;
        }
        .sh-toast.sh-toast-show { transform: translateX(0); opacity: 1; }
        .sh-toast.sh-toast-hide { transform: translateX(130%); opacity: 0; }
        .sh-toast-icon { color: var(--sh-primary); font-size: 1.4rem; flex-shrink: 0; }

        /* ===== Scroll Top ===== */
        .sh-scroll-top {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--sh-primary);
            color: #fff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all .25s ease;
            z-index: 999;
        }
        .sh-scroll-top.visible { opacity: 1; visibility: visible; }
        .sh-scroll-top:hover { background: var(--sh-primary-dark); }
        @media (max-width: 991.98px) {
            .sh-scroll-top { bottom: 74px; right: 16px; }
        }
    </style>
</head>

<body>

    <!-- 1. STICKY TOP NAVBAR (Horizontal Straightline Layout) -->
    <nav class="navbar navbar-expand-lg sh-navbar sticky-top" id="top">
        <div class="container-fluid px-3 px-xl-4" style="max-width: 1540px;">
            <!-- Brand Lockup with Emblem Logo and Balanced Typography -->
            <a class="navbar-brand brx-navbar-brand py-0 me-2 me-xl-3" href="{{ route('home') }}" title="BRX Agro Global Importação e Exportação Ltda">
                <img src="{{ asset('img/brx-emblem-nav.png') }}" alt="BRX Agro Global Logo" class="brx-navbar-emblem" width="44" height="44">
                <div class="brx-brand-wrap">
                    <div class="brx-brand-row">
                        <span class="brx-name-lead">BRX</span>
                        <span class="brx-name-tag">AGRO GLOBAL</span>
                    </div>
                    <span class="brx-legal-sub">IMPORTAÇÃO E EXPORTAÇÃO LTDA</span>
                </div>
            </a>

            <!-- Mobile Hamburger Toggler (visible on small screens) -->
            <button class="navbar-toggler sh-toggler d-lg-none me-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

            <!-- Nav Links on a Straight Line Horizontally -->
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto sh-nav-straightline">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item dropdown sh-nav-dropdown">
                        <a class="nav-link dropdown-toggle" href="#products" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li class="dropdown-header text-uppercase">Commodity Sectors</li>
                            <li><a class="dropdown-item agro-nav-cat-filter" href="#products" data-filter="Grains & Rice"><i class="bi bi-circle-fill text-success me-2 small"></i>Grains &amp; Rice</a></li>
                            <li><a class="dropdown-item agro-nav-cat-filter" href="#products" data-filter="Oil & Sugar"><i class="bi bi-circle-fill text-success me-2 small"></i>Oil &amp; Sugar</a></li>
                            <li><a class="dropdown-item agro-nav-cat-filter" href="#products" data-filter="Nuts & Seeds"><i class="bi bi-circle-fill text-success me-2 small"></i>Nuts &amp; Seeds</a></li>
                            <li><a class="dropdown-item agro-nav-cat-filter" href="#products" data-filter="Lentils & Pulses"><i class="bi bi-circle-fill text-success me-2 small"></i>Lentils &amp; Pulses</a></li>
                            <li><a class="dropdown-item agro-nav-cat-filter" href="#products" data-filter="Spices & Specialty"><i class="bi bi-circle-fill text-success me-2 small"></i>Spices &amp; Specialty</a></li>
                            <li><hr class="dropdown-divider border-secondary my-1"></li>
                            <li><a class="dropdown-item fw-bold" href="#products"><i class="bi bi-grid-fill text-success me-2"></i>Shop All Products</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown sh-nav-dropdown">
                        <a class="nav-link dropdown-toggle" href="#products" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Store
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item py-2 fw-semibold" href="#products"><i class="bi bi-bag-check text-success me-2"></i>Shop All</a></li>
                            <li><a class="dropdown-item py-2 fw-semibold" href="#rfq-desk"><i class="bi bi-file-earmark-text text-success me-2"></i>Direct RFQ</a></li>
                            <li><hr class="dropdown-divider border-secondary my-1"></li>
                            <li><a class="dropdown-item py-2" href="#insights"><i class="bi bi-geo-alt text-success me-2"></i>Harvest Basins</a></li>
                            <li><a class="dropdown-item py-2" href="javascript:void(0)" onclick="document.getElementById('cartTriggerBtn').click()"><i class="bi bi-cart3 text-success me-2"></i>Sample Cart</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#process">Process</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#insights">Insights</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>

                <!-- Navbar Actions (Theme / Cart / Search / Auth) -->
                <div class="sh-nav-actions d-flex align-items-center gap-2 gap-xl-3 ms-lg-auto mt-3 mt-lg-0">
                    <!-- Theme Toggle -->
                    <button type="button" class="sh-icon-btn sh-theme-toggle" id="themeToggleBtn" aria-label="Toggle dark / light theme" title="Toggle Theme">
                        <i class="bi bi-moon-stars"></i>
                    </button>

                    <!-- Search Trigger Modal -->
                    <button type="button" class="sh-icon-btn" id="searchTriggerBtn" data-bs-toggle="modal" data-bs-target="#searchModal" title="Search Products">
                        <i class="bi bi-search"></i>
                    </button>

                    <!-- Cart Icon with Badge -->
                    <a href="javascript:void(0)" class="sh-cart-icon" id="cartTriggerBtn" aria-label="Cart" title="View Cart">
                        <i class="bi bi-cart3"></i>
                        <span class="sh-cart-badge" id="cartCountBadge">0</span>
                    </a>

                    <!-- Auth Dropdown / Buttons -->
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-sh-primary btn-sm dropdown-toggle d-inline-flex align-items-center gap-1" data-bs-toggle="dropdown">
                                <i class="bi bi-person"></i> {{ Str::limit(auth()->user()->name, 12) }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="background: var(--sh-surface); border: 1px solid var(--bs-border-color);">
                                <li class="px-3 py-2 border-bottom small text-muted">
                                    Signed in as <strong class="d-block sh-text-title">{{ auth()->user()->email }}</strong>
                                </li>
                                @if (auth()->user()->isAdmin())
                                    <li>
                                        <a class="dropdown-item py-2 text-warning fw-bold" href="{{ route('admin.dashboard') }}">
                                             <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.products.index') }}">
                                            <i class="bi bi-box-seam me-2"></i>Manage Products
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.inquiries.index') }}">
                                            <i class="bi bi-envelope me-2"></i>Trade Inquiries
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider border-secondary my-1"></li>
                                @endif
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sh-login btn-sm">Log in</a>
                        <a href="{{ route('register') }}" class="btn btn-sh-primary btn-sm">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        <!-- 2. HERO CAROUSEL (Exact fume-main layout) -->
        <section class="sh-hero">
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                </div>
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="sh-hero-slide">
                            <img src="{{ asset('img/carousel-1.jpg') }}" alt="Brazilian Farm Sourcing" class="sh-hero-bg">
                            <div class="sh-hero-scrim"></div>
                            <div class="container sh-hero-content">
                                <div class="eyebrow mb-3">Direct Harvest Basin Sourcing</div>
                                <h1 class="mb-4">From Brazilian Farms to <span style="color: var(--sh-primary);">Global Tables</span></h1>
                                <p class="lead mb-4">Direct bulk origination of Brazilian Non-GMO Soybeans, Refined Cane Sugar (ICUMSA 45), Yellow Corn, and Pulses. Backed by MAPA phytosanitary clearance, independent SGS assays, and secure bank escrow.</p>
                                <div class="d-flex gap-3 flex-wrap">
                                    <a href="#products" class="btn btn-sh-primary btn-lg">Explore Agricultural Products</a>
                                    <a href="#rfq-desk" class="btn btn-sh-outline-white btn-lg">Request Bulk RFQ</a>
                                </div>
                                <div class="d-flex gap-4 mt-5 flex-wrap sh-hero-stats">
                                    <div>
                                        <div class="fs-4 fw-bold text-white">{{ number_format($totalStock ?? 2500) }}+ MT</div>
                                        <small class="text-white-50">Active Supply</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">100% SGS</div>
                                        <small class="text-white-50">Pre-Shipment Tested</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">Zero Risk</div>
                                        <small class="text-white-50">Bank Escrow Protection</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">Santos &amp; Paranaguá</div>
                                        <small class="text-white-50">Deepwater Exit Ports</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="sh-hero-slide">
                            <img src="{{ asset('img/carousel-2.jpg') }}" alt="Export Grade Commodities" class="sh-hero-bg" loading="lazy" decoding="async">
                            <div class="sh-hero-scrim"></div>
                            <div class="container sh-hero-content">
                                <div class="eyebrow mb-3">Bulk Contracts &amp; Spot Lots</div>
                                <h1 class="mb-4">Source Certified Grains, <span style="color: var(--sh-primary);">Sugar &amp; Specialty</span></h1>
                                <p class="lead mb-4">Eliminate trading middlemen with accredited farm cooperatives across Mato Grosso, Paraná, and Goiás. Complete origin traceability and guaranteed international loading schedules.</p>
                                <div class="d-flex gap-3 flex-wrap">
                                    <a href="#products" class="btn btn-sh-primary btn-lg">Explore Agricultural Products</a>
                                    <a href="#rfq-desk" class="btn btn-sh-outline-white btn-lg">Request Bulk RFQ</a>
                                </div>
                                <div class="d-flex gap-4 mt-5 flex-wrap sh-hero-stats">
                                    <div>
                                        <div class="fs-4 fw-bold text-white">Grade #1</div>
                                        <small class="text-white-50">Export Quality</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">FOB &amp; CIF</div>
                                        <small class="text-white-50">Global IncoTerms</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">&lt; 4 Hours</div>
                                        <small class="text-white-50">Quote Turnaround</small>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-white">USD / EUR / BRL</div>
                                        <small class="text-white-50">Settlement Currency</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </section>

        <!-- 3. SEARCH BAR STRIP (Under Hero, exact fume-main layout) -->
        <section class="py-4" style="background: var(--sh-surface-alt); border-bottom: 1px solid var(--bs-border-color);">
            <div class="container">
                <form action="#products" method="GET" class="mx-auto" style="max-width: 620px;" onsubmit="event.preventDefault(); var q = $('#quickSearchInput').val().toLowerCase(); $('.agro-filter-btn[data-filter=\'all\']').click(); $('.product-item').each(function(){ var t = $(this).text().toLowerCase(); $(this).toggle(t.indexOf(q) !== -1); }); $('html, body').animate({scrollTop: $('#products').offset().top - 80}, 600);">
                    <div class="input-group">
                        <input type="text" id="quickSearchInput" class="form-control form-control-lg sh-input" placeholder="Search Brazilian commodities, grades, harvest basins..." style="border-radius: 8px 0 0 8px; font-size: 1rem;">
                        <button type="submit" class="btn btn-sh-primary btn-lg" style="border-radius: 0 8px 8px 0;">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- 4. SERVICES / FEATURE STRIP (Exact fume-main layout) -->
        <section class="sh-strip py-3" id="services">
            <div class="container">
                <div class="row text-center g-3">
                    <div class="col-6 col-md-3 item d-flex flex-column align-items-center">
                        <i class="bi bi-truck"></i>
                        <strong>Bulk &amp; Port Freight</strong>
                        <small>Deepwater container &amp; vessel loading</small>
                    </div>
                    <div class="col-6 col-md-3 item d-flex flex-column align-items-center">
                        <i class="bi bi-shield-check"></i>
                        <strong>Bank Escrow Settlement</strong>
                        <small>Zero default counterparty protection</small>
                    </div>
                    <div class="col-6 col-md-3 item d-flex flex-column align-items-center">
                        <i class="bi bi-award"></i>
                        <strong>SGS &amp; MAPA Assays</strong>
                        <small>100% pre-loading lab assay inspection</small>
                    </div>
                    <div class="col-6 col-md-3 item d-flex flex-column align-items-center">
                        <i class="bi bi-headset"></i>
                        <strong>24/7 Trade Desk</strong>
                        <small>Direct WhatsApp &amp; São Paulo HQ</small>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. FEATURED PRODUCTS (Exact fume-main product grid architecture) -->
        <section class="py-5" id="products">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                    <div>
                        <div class="sh-eyebrow">Export Catalog</div>
                        <h2 class="sh-title mb-0">Featured Agro Products</h2>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <button type="button" class="btn btn-sm btn-outline-secondary agro-filter-btn active" data-filter="all">All</button>
                        @if (isset($categories) && $categories->isNotEmpty())
                            @foreach ($categories as $cat)
                                <button type="button" class="btn btn-sm btn-outline-secondary agro-filter-btn" data-filter="{{ $cat->name }}">{{ $cat->name }}</button>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Product Grid: 4 columns like fume-main -->
                <div class="row row-cols-2 row-cols-md-4 g-3 g-md-4" id="catalogGrid">
                    @forelse ($products as $product)
                        <div class="col product-item" data-category="{{ $product->category->name ?? 'Grains & Rice' }}">
                            <div class="sh-product-card">
                                <div class="sh-product-img">
                                    <a href="javascript:void(0)" class="quick-view-trigger" data-product="{{ $product->name }}" data-price="${{ number_format($product->price, 2) }} / {{ $product->unit ?? 'MT' }}" data-image="{{ asset($product->image ?: 'img/service-1.jpg') }}">
                                        <img src="{{ asset($product->image ?: 'img/service-1.jpg') }}" alt="{{ $product->name }}" loading="lazy" decoding="async">
                                    </a>
                                    @if ($product->unit == 'Metric Ton')
                                        <span class="sh-badge-sale">BULK / B2B</span>
                                    @elseif ($product->is_new)
                                        <span class="sh-badge-new">NEW</span>
                                    @endif
                                    @if ($product->original_price)
                                        <span class="sh-badge-original">${{ number_format($product->original_price, 2) }}</span>
                                    @endif
                                </div>
                                <div class="sh-card-body">
                                    <div class="sh-card-brand">{{ $product->origin ?? 'Brazil' }} · {{ $product->category->name ?? 'Agro' }}</div>
                                    <a href="javascript:void(0)" class="text-decoration-none quick-view-trigger" data-product="{{ $product->name }}" data-price="${{ number_format($product->price, 2) }} / {{ $product->unit ?? 'MT' }}" data-image="{{ asset($product->image ?: 'img/service-1.jpg') }}">
                                        <div class="sh-card-name">{{ $product->name }}</div>
                                    </a>
                                    <div class="sh-card-price">
                                        <span class="price-now">${{ number_format($product->price, 2) }}</span>
                                        <small class="text-muted">/ {{ $product->unit ?? 'MT' }}</small>
                                        @if ($product->original_price)
                                            <span class="price-old">${{ number_format($product->original_price, 2) }}</span>
                                            <span class="sh-discount-tag">-{{ round((1 - $product->price / $product->original_price) * 100) }}%</span>
                                        @endif
                                    </div>
                                    <div class="sh-card-rating">
                                        <span class="stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </span>
                                        <span class="count text-muted">({{ number_format($product->stock) }} {{ $product->unit == 'Metric Ton' ? 'MT' : 'units' }})</span>
                                    </div>
                                    <div class="d-flex gap-2 mt-auto pt-2">
                                        <button type="button" class="sh-card-cart-btn btn-add-cart" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-unit="{{ $product->unit ?? 'MT' }}" data-image="{{ asset($product->image ?: 'img/service-1.jpg') }}" data-origin="{{ $product->origin ?? 'Brazil' }}">
                                            <i class="bi bi-bag"></i> Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Clean Fallbacks if DB has no items -->
                        <div class="col product-item" data-category="Grains & Rice">
                            <div class="sh-product-card">
                                <div class="sh-product-img">
                                    <img src="{{ asset('img/service-1.jpg') }}" alt="Brazilian Non-GMO Soybeans" loading="lazy" decoding="async">
                                    <span class="sh-badge-sale">BULK</span>
                                    <span class="sh-badge-original">$520.00</span>
                                </div>
                                <div class="sh-card-body">
                                    <div class="sh-card-brand">Mato Grosso · Grains &amp; Rice</div>
                                    <div class="sh-card-name">Brazilian Non-GMO Soybeans</div>
                                    <div class="sh-card-price"><span class="price-now">$485.00</span> <small class="text-muted">/ MT</small></div>
                                    <button class="sh-card-cart-btn btn-add-cart" data-name="Brazilian Non-GMO Soybeans" data-price="485.00" data-unit="MT" data-image="{{ asset('img/service-1.jpg') }}" data-origin="Mato Grosso"><i class="bi bi-bag"></i> Add to Cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="col product-item" data-category="Oil & Sugar">
                            <div class="sh-product-card">
                                <div class="sh-product-img">
                                    <img src="{{ asset('img/service-2.jpg') }}" alt="Refined Cane Sugar ICUMSA 45" loading="lazy" decoding="async">
                                    <span class="sh-badge-sale">BULK</span>
                                    <span class="sh-badge-original">$580.00</span>
                                </div>
                                <div class="sh-card-body">
                                    <div class="sh-card-brand">São Paulo · Oil &amp; Sugar</div>
                                    <div class="sh-card-name">Refined Cane Sugar (ICUMSA 45)</div>
                                    <div class="sh-card-price"><span class="price-now">$540.00</span> <small class="text-muted">/ MT</small></div>
                                    <button class="sh-card-cart-btn btn-add-cart" data-name="Refined Cane Sugar (ICUMSA 45)" data-price="540.00" data-unit="MT" data-image="{{ asset('img/service-2.jpg') }}" data-origin="São Paulo"><i class="bi bi-bag"></i> Add to Cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="col product-item" data-category="Grains & Rice">
                            <div class="sh-product-card">
                                <div class="sh-product-img">
                                    <img src="{{ asset('img/service-3.jpg') }}" alt="Yellow Corn Maize Grade 2" loading="lazy" decoding="async">
                                    <span class="sh-badge-new">NEW</span>
                                </div>
                                <div class="sh-card-body">
                                    <div class="sh-card-brand">Goiás · Grains &amp; Rice</div>
                                    <div class="sh-card-name">Yellow Corn (Maize Grade 2)</div>
                                    <div class="sh-card-price"><span class="price-now">$245.00</span> <small class="text-muted">/ MT</small></div>
                                    <button class="sh-card-cart-btn btn-add-cart" data-name="Yellow Corn (Maize Grade 2)" data-price="245.00" data-unit="MT" data-image="{{ asset('img/service-3.jpg') }}" data-origin="Goiás"><i class="bi bi-bag"></i> Add to Cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="col product-item" data-category="Spices & Specialty">
                            <div class="sh-product-card">
                                <div class="sh-product-img">
                                    <img src="{{ asset('img/service-5.jpg') }}" alt="Arabica Green Coffee Beans" loading="lazy" decoding="async">
                                    <span class="sh-badge-sale">EXPORT</span>
                                </div>
                                <div class="sh-card-body">
                                    <div class="sh-card-brand">Minas Gerais · Specialty</div>
                                    <div class="sh-card-name">Arabica Green Coffee Beans</div>
                                    <div class="sh-card-price"><span class="price-now">$3,850.00</span> <small class="text-muted">/ MT</small></div>
                                    <button class="sh-card-cart-btn btn-add-cart" data-name="Arabica Green Coffee Beans" data-price="3850.00" data-unit="MT" data-image="{{ asset('img/service-5.jpg') }}" data-origin="Minas Gerais"><i class="bi bi-bag"></i> Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- 6. CATEGORY CARDS & BASIN INSIGHTS -->
        <section class="py-5" id="insights" style="background: var(--sh-surface-alt); border-top: 1px solid var(--bs-border-color); border-bottom: 1px solid var(--bs-border-color);">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                    <div>
                        <div class="sh-eyebrow">Agro Basins</div>
                        <h2 class="sh-title mb-0">Harvest Categories</h2>
                    </div>
                </div>
                <div class="row g-3 g-md-4">
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card">
                            <img src="{{ asset('img/service-1.jpg') }}" alt="Grains & Soybeans" loading="lazy" decoding="async">
                            <div class="label">
                                <h5>Grains &amp; Soybeans</h5>
                                <span>Mato Grosso &amp; Paraná</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card">
                            <img src="{{ asset('img/service-2.jpg') }}" alt="Cane Sugar & Oils" loading="lazy" decoding="async">
                            <div class="label">
                                <h5>Sugar &amp; Sweeteners</h5>
                                <span>São Paulo Mills</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card">
                            <img src="{{ asset('img/service-5.jpg') }}" alt="Specialty Coffee" loading="lazy" decoding="async">
                            <div class="label">
                                <h5>Specialty Coffee</h5>
                                <span>Sul de Minas Gerais</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card">
                            <img src="{{ asset('img/service-7.jpg') }}" alt="Pulses & Seeds" loading="lazy" decoding="async">
                            <div class="label">
                                <h5>Pulses &amp; Seeds</h5>
                                <span>Carioca &amp; Brazil Nuts</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 7. PROMO BANNER (Exact fume-main layout with Arovia color) -->
        <section class="py-5">
            <div class="container py-3">
                <div class="sh-promo p-4 p-md-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h3 class="mb-2">Bulk Commercial Agro Allocations — FOB &amp; CIF Terms</h3>
                            <p class="mb-0">Trade directly with accredited Brazilian farm cooperatives. All settlements are backed by Tier-1 bank escrow with certified pre-loading SGS assays.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                            <a href="#rfq-desk" class="btn btn-light btn-lg fw-bold text-dark">Request Trade RFQ</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 8. PROCESS: 4-Step Bulk Fulfillment Architecture -->
        <section class="py-5" id="process" style="background: var(--sh-surface-alt); border-top: 1px solid var(--bs-border-color);">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                    <div>
                        <div class="sh-eyebrow">Institutional Workflow</div>
                        <h2 class="sh-title mb-0">End-to-End Trade Fulfillment Process</h2>
                    </div>
                    <span class="badge bg-success px-3 py-2 fs-6">SGS &amp; Escrow Compliant</span>
                </div>
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="p-4 rounded-3 h-100 sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 fw-bold" style="width: 42px; height: 42px; background: rgba(120, 162, 47, 0.16); color: var(--sh-primary);">01</div>
                            <h5 class="fw-bold sh-text-title mb-2">Basin Sourcing</h5>
                            <p class="small sh-text-muted mb-0">Contract allocations secured directly from certified agricultural cooperatives across Mato Grosso, Paraná, and São Paulo.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-4 rounded-3 h-100 sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 fw-bold" style="width: 42px; height: 42px; background: rgba(120, 162, 47, 0.16); color: var(--sh-primary);">02</div>
                            <h5 class="fw-bold sh-text-title mb-2">SGS Lab Assays</h5>
                            <p class="small sh-text-muted mb-0">Independent pre-shipment sampling for moisture, protein, foreign matter, and MAPA phytosanitary compliance.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-4 rounded-3 h-100 sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 fw-bold" style="width: 42px; height: 42px; background: rgba(120, 162, 47, 0.16); color: var(--sh-primary);">03</div>
                            <h5 class="fw-bold sh-text-title mb-2">Bank Escrow / LC</h5>
                            <p class="small sh-text-muted mb-0">Tier-1 escrow settlement and irrevocable documentary letters of credit ensure zero counterparty settlement risk.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-4 rounded-3 h-100 sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 fw-bold" style="width: 42px; height: 42px; background: rgba(120, 162, 47, 0.16); color: var(--sh-primary);">04</div>
                            <h5 class="fw-bold sh-text-title mb-2">Port Vessel Dispatch</h5>
                            <p class="small sh-text-muted mb-0">Terminal berth coordination at Port of Santos and Paranaguá with live vessel telemetry until discharge.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 9. BLOG / TRADE INSIGHTS -->
        <section class="py-5" id="blog" style="background: var(--bs-body-bg); border-top: 1px solid var(--bs-border-color);">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                    <div>
                        <div class="sh-eyebrow">Trade Digest</div>
                        <h2 class="sh-title mb-0">Market Reports &amp; Commodity Insights</h2>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="p-4 rounded-3 h-100 d-flex flex-column sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <span class="badge bg-secondary align-self-start mb-2">Crop Outlook</span>
                            <h5 class="fw-bold sh-text-title mb-2">2026/27 Brazilian Soybean Crop Forecast</h5>
                            <p class="small sh-text-muted mb-3 flex-grow-1">Mato Grosso record yields and favorable moisture levels drive high export availability for early vessel bookings.</p>
                            <a href="#rfq-desk" class="text-success small fw-semibold text-decoration-none">Inquire Basin Availability <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 rounded-3 h-100 d-flex flex-column sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <span class="badge bg-secondary align-self-start mb-2">Trade Guide</span>
                            <h5 class="fw-bold sh-text-title mb-2">IncoTerms 2020: CIF vs FOB Port Risk</h5>
                            <p class="small sh-text-muted mb-3 flex-grow-1">Analyzing demurrage responsibility, marine insurance clauses, and title handover protocols for bulk buyers.</p>
                            <a href="#rfq-desk" class="text-success small fw-semibold text-decoration-none">Inquire Terms Guide <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 rounded-3 h-100 d-flex flex-column sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <span class="badge bg-secondary align-self-start mb-2">Logistics</span>
                            <h5 class="fw-bold sh-text-title mb-2">Raw Sugar (ICUMSA 45) Port Allocations</h5>
                            <p class="small sh-text-muted mb-3 flex-grow-1">Santos terminal conveyor upgrade schedule and containerized pallet shipment lead times for Middle East ports.</p>
                            <a href="#rfq-desk" class="text-success small fw-semibold text-decoration-none">Inquire Port Schedules <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 10. ABOUT US SECTION -->
        <section class="py-5" id="about" style="background: var(--sh-surface-alt); border-top: 1px solid var(--bs-border-color);">
            <div class="container py-3">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="sh-eyebrow">About BRX Agro Global</div>
                        <h2 class="sh-title mb-3">Direct Brazilian Agro Trade Facilitation</h2>
                        <p class="sh-text-muted mb-3">
                            <strong>BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA</strong> connects international commodity buyers and institutional food conglomerates directly with certified agricultural cooperatives across Brazil's most productive basins.
                        </p>
                        <p class="sh-text-muted mb-4">
                            Headquartered at Rua Marconi, 87 Centro in São Paulo, our multi-lingual trade desk coordinates harvest basin allocations, laboratory assay verifications, and deepwater vessel logistics to deliver institutional grade commodities on FOB and CIF terms.
                        </p>
                        <div class="d-flex gap-4">
                            <div>
                                <h3 class="fw-bold mb-0" style="color: var(--sh-primary) !important;">100%</h3>
                                <small class="sh-text-muted">SGS Assay Inspected</small>
                            </div>
                            <div class="border-start border-secondary ps-4">
                                <h3 class="fw-bold mb-0" style="color: var(--sh-primary) !important;">15+</h3>
                                <small class="sh-text-muted">Certified Co-op Basins</small>
                            </div>
                            <div class="border-start border-secondary ps-4">
                                <h3 class="fw-bold mb-0" style="color: var(--sh-primary) !important;">Zero</h3>
                                <small class="sh-text-muted">Counterparty Default</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-3 rounded-4 sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <img src="{{ asset('img/about-2.jpg') }}" alt="About BRX Agro Global Desk" class="img-fluid rounded-3 w-100 object-fit-cover" style="max-height: 320px;" onerror="this.src='{{ asset('img/service-1.jpg') }}'" loading="lazy" decoding="async">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 11. DIRECT TRADE DESK & RFQ INQUIRIES (CONTACT) -->
        <div id="contact"></div>
        <section class="py-5" id="rfq-desk" style="background: var(--bs-body-bg); border-top: 1px solid var(--bs-border-color); border-bottom: 1px solid var(--bs-border-color);">
            <div class="container py-3">
                <div class="row g-5 align-items-start">
                    <div class="col-lg-5">
                        <div class="sh-eyebrow">Trade Desk</div>
                        <h2 class="sh-title mb-3">Institutional RFQ Inquiries</h2>
                        <p class="sh-text-muted mb-4">Connect directly with our Brazilian commodity export team. Request indicative FOB/CIF quotes, technical SGS assay sheets, or spot allocations.</p>

                        <div class="p-4 rounded-3 mb-4 sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="bi bi-geo-alt fs-4 text-success" style="color: var(--sh-primary) !important;"></i>
                                <div>
                                    <strong class="d-block sh-text-title">Trading Headquarters</strong>
                                    <small class="sh-text-muted">Rua Marconi, 87 Centro, CEP 01047-906, São Paulo - SP, Brazil</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="bi bi-whatsapp fs-4 text-success"></i>
                                <div>
                                    <strong class="d-block sh-text-title">Direct WhatsApp Desk</strong>
                                    <a href="https://wa.me/5511958353433" target="_blank" rel="noopener" class="text-success text-decoration-none fw-bold small">+55 (11) 95835-3433</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-envelope fs-4 text-success" style="color: var(--sh-primary) !important;"></i>
                                <div>
                                    <strong class="d-block sh-text-title">Corporate Desk</strong>
                                    <small class="sh-text-muted">tradedesk@brxagroglobal.com / inquiries@brxagroglobal.com</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="p-4 p-md-5 rounded-4 sh-card-bg" style="border: 1px solid var(--bs-border-color);">
                            <h4 class="fw-bold sh-text-title mb-2">Request Trade Quote (RFQ)</h4>
                            <p class="sh-text-muted small mb-4">Complete the form below to receive formal indicative pricing, SGS specifications, and vessel allocation schedule.</p>

                            <div id="rfqAlert" class="alert d-none mb-3"></div>

                            <form id="rfqInquiryForm">
                                <input type="hidden" name="role" value="buyer">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Target Commodity *</label>
                                        <select name="buyer_detail" class="form-select sh-input" required>
                                            <option value="Brazilian Non-GMO Soybeans">Brazilian Non-GMO Soybeans</option>
                                            <option value="Refined Cane Sugar (ICUMSA 45)">Refined Cane Sugar (ICUMSA 45)</option>
                                            <option value="Yellow Corn (Maize Grade 2)">Yellow Corn (Maize Grade 2)</option>
                                            <option value="Arabica Green Coffee Beans">Arabica Green Coffee Beans</option>
                                            <option value="Lentils & Pulses">Lentils &amp; Pulses</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Volume Required (Metric Tons) *</label>
                                        <input type="text" name="volume" class="form-control sh-input" placeholder="e.g. 500 MT / 2,500 MT" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Full Name *</label>
                                        <input type="text" name="name" class="form-control sh-input" placeholder="First and last name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Corporate Email *</label>
                                        <input type="email" name="email" class="form-control sh-input" placeholder="importer@company.com" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Company Name *</label>
                                        <input type="text" name="company" class="form-control sh-input" placeholder="Trading company name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Discharge Port / Country *</label>
                                        <input type="text" name="country" class="form-control sh-input" placeholder="e.g. Port of Rotterdam" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Contract Message &amp; Instructions</label>
                                        <textarea name="message" class="form-control sh-input" rows="3" placeholder="Specify any moisture, protein or packaging requirements..."></textarea>
                                    </div>
                                    <div class="col-12 pt-2">
                                        <button type="submit" id="rfqSubmitBtn" class="btn btn-sh-primary w-100 py-3 text-white fw-bold">
                                            <i class="bi bi-send me-2"></i> Submit RFQ to Trade Desk
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 12. TESTIMONIALS SECTION (Exact fume-main layout) -->
        <section class="py-5" style="background: var(--bs-body-bg);">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                    <div>
                        <div class="sh-eyebrow">Client Feedback</div>
                        <h2 class="sh-title mb-0">What Our Importers Say</h2>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="sh-testimonial">
                            <div class="sh-stars mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p class="fst-italic sh-text-muted mb-3">"Securing 12,500 MT of Brazilian Non-GMO Soybeans through Santos was handled with absolute professionalism. The pre-shipment SGS assay matched our exact feed parameters."</p>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/testimonial-1.jpg') }}" alt="Pieter van der Berg" class="rounded-circle me-3 object-fit-cover" width="46" height="46" loading="lazy" decoding="async">
                                <div>
                                    <h6 class="mb-0 sh-text-title fw-bold">Pieter van der Berg</h6>
                                    <small class="sh-text-muted">Procurement · Rotterdam, Netherlands</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sh-testimonial">
                            <div class="sh-stars mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p class="fst-italic sh-text-muted mb-3">"The ICUMSA 45 refined sugar arrived on time with complete phytosanitary certificates and zero broken bags. BRX Agro Global's direct desk communicated vessel telemetry daily."</p>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/testimonial-2.jpg') }}" alt="Tariq Al-Mansoor" class="rounded-circle me-3 object-fit-cover" width="46" height="46" loading="lazy" decoding="async">
                                <div>
                                    <h6 class="mb-0 sh-text-title fw-bold">Tariq Al-Mansoor</h6>
                                    <small class="sh-text-muted">VP Supply Chain · Jebel Ali, Dubai</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sh-testimonial">
                            <div class="sh-stars mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p class="fst-italic sh-text-muted mb-3">"Direct co-op pricing eliminated the broker markup we usually pay on yellow maize. Clean title handover at the discharge port made customs processing effortless."</p>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/testimonial-3.jpg') }}" alt="Wei Chen" class="rounded-circle me-3 object-fit-cover" width="46" height="46" loading="lazy" decoding="async">
                                <div>
                                    <h6 class="mb-0 sh-text-title fw-bold">Wei Chen</h6>
                                    <small class="sh-text-muted">Agro Commodity Trader · Qingdao, China</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 13. FAQ SECTION -->
        <section class="py-5" id="faq" style="background: var(--sh-surface-alt); border-top: 1px solid var(--bs-border-color);">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                    <div>
                        <div class="sh-eyebrow">Knowledge Base</div>
                        <h2 class="sh-title mb-0">Frequently Asked Questions</h2>
                    </div>
                </div>
                <div class="accordion sh-accordion" id="agroFaqAccordion">
                    <div class="accordion-item mb-3 rounded-3 overflow-hidden">
                        <h2 class="accordion-header" id="faqH1">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqC1">
                                How does bank escrow protect international commodity buyers?
                            </button>
                        </h2>
                        <div id="faqC1" class="accordion-collapse collapse" data-bs-parent="#agroFaqAccordion">
                            <div class="accordion-body small">
                                Funds are deposited into a regulated Tier-1 escrow account and released only when verified SGS inspection assay certificates and official Bills of Lading are verified by the escrow agent.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3 rounded-3 overflow-hidden">
                        <h2 class="accordion-header" id="faqH2">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqC2">
                                What quality assurance certificates accompany shipments?
                            </button>
                        </h2>
                        <div id="faqC2" class="accordion-collapse collapse" data-bs-parent="#agroFaqAccordion">
                            <div class="accordion-body small">
                                Every batch is accompanied by an independent SGS Laboratory Assay, MAPA (Brazilian Ministry of Agriculture) Phytosanitary Certificate, Certificate of Origin, and Fumigation Certificate.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3 rounded-3 overflow-hidden">
                        <h2 class="accordion-header" id="faqH3">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqC3">
                                What is the minimum order quantity (MOQ) for bulk shipments?
                            </button>
                        </h2>
                        <div id="faqC3" class="accordion-collapse collapse" data-bs-parent="#agroFaqAccordion">
                            <div class="accordion-body small">
                                Standard containerized shipments start at 200 to 500 Metric Tons. For Panamax / Supramax breakbulk vessel allocations, spot contracts typically start at 12,500 Metric Tons.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item rounded-3 overflow-hidden">
                        <h2 class="accordion-header" id="faqH4">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqC4">
                                Which discharge ports are supported under CIF contracts?
                            </button>
                        </h2>
                        <div id="faqC4" class="accordion-collapse collapse" data-bs-parent="#agroFaqAccordion">
                            <div class="accordion-body small">
                                We regularly execute CIF charters to major deepwater ports including Rotterdam, Antwerp, Jebel Ali, Qingdao, Shanghai, Dammam, and Alexandria.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- 10. FOOTER (Horizontal Layout Across All Elements) -->
    <footer class="sh-footer pt-5 pb-4">
        <div class="container-fluid px-3 px-md-5" style="max-width: 1440px;">
            <div class="sh-footer-horizontal-wrap mb-4">
                <!-- Col 1: Brand & Mission -->
                <div class="sh-footer-col-brand">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <img src="{{ asset('img/brx-emblem-nav.png') }}" alt="BRX AGRO GLOBAL" class="rounded-circle" style="width: 44px; height: 44px; object-fit: cover; border: 2px solid var(--sh-primary); flex-shrink: 0;" width="44" height="44" loading="lazy">
                        <div>
                            <div class="fw-bold text-white fs-6" style="letter-spacing: 0.5px; line-height: 1.1;">BRX <span style="color: var(--sh-primary);">AGRO GLOBAL</span></div>
                            <small class="text-white-50 d-block" style="font-size: 0.52rem; letter-spacing: 1.2px; text-transform: uppercase;">Importação e Exportação Ltda</small>
                        </div>
                    </div>
                    <div class="small text-success fw-semibold mb-2" style="font-size: 0.72rem; letter-spacing: 0.5px;">CNPJ: 38.471.480/0001-41</div>
                    <p class="small text-white-50 mb-3" style="line-height: 1.6;">
                        Direct institutional trade facilitation between certified Brazilian agricultural cooperatives and global commodity buyers.
                    </p>
                    <div class="d-flex align-items-center mt-3">
                        <a href="https://wa.me/5511958353433" target="_blank" rel="noopener" class="social-icon" title="WhatsApp Desk"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="social-icon" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        <a href="mailto:tradedesk@brxagroglobal.com" class="social-icon" title="Email Desk"><i class="bi bi-envelope"></i></a>
                    </div>
                </div>

                <!-- Col 2: Shop -->
                <div class="sh-footer-col">
                    <h6>Shop</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2"><a href="#products">Soybeans &amp; Grains</a></li>
                        <li class="mb-2"><a href="#products">ICUMSA 45 Sugar</a></li>
                        <li class="mb-2"><a href="#products">Yellow Maize Grade 2</a></li>
                        <li class="mb-2"><a href="#products">Specialty Coffee</a></li>
                        <li class="mb-2"><a href="#products">Pulses &amp; Lentils</a></li>
                    </ul>
                </div>

                <!-- Col 3: Company -->
                <div class="sh-footer-col">
                    <h6>Company</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2"><a href="#about">About BRX Agro Global</a></li>
                        <li class="mb-2"><a href="#rfq-desk">Brazilian Trade Desk</a></li>
                        <li class="mb-2"><a href="#products">Harvest Basins</a></li>
                        <li class="mb-2"><a href="#rfq-desk">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Col 4: Account -->
                <div class="sh-footer-col">
                    <h6>Account</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2"><a href="{{ route('login') }}">Client Login</a></li>
                        <li class="mb-2"><a href="{{ route('register') }}">Register Account</a></li>
                        @auth
                            @if(auth()->user()->isAdmin())
                                <li class="mb-2"><a href="{{ route('admin.dashboard') }}" class="text-warning fw-semibold"><i class="bi bi-speedometer2 me-1"></i>Admin Dashboard</a></li>
                            @endif
                            <li class="mb-2"><a href="{{ route('admin.orders.index') }}">My Orders</a></li>
                        @endauth
                    </ul>
                </div>

                <!-- Col 5: Legal -->
                <div class="sh-footer-col">
                    <h6>Legal</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2"><a href="javascript:void(0)">Phytosanitary Terms</a></li>
                        <li class="mb-2"><a href="javascript:void(0)">Bank Escrow Rules</a></li>
                        <li class="mb-2"><a href="javascript:void(0)">IncoTerms 2020 Guide</a></li>
                    </ul>
                </div>

                <!-- Col 6: Contact -->
                <div class="sh-footer-col sh-footer-col-contact">
                    <h6>Contact</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2 d-flex align-items-start gap-2">
                            <i class="bi bi-geo-alt me-1 text-success" style="color: var(--sh-primary) !important; flex-shrink: 0; margin-top: 3px;"></i>
                            <span>Rua Marconi, 87 Centro, CEP 01047-906, São Paulo - SP, Brazil</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center gap-2">
                            <i class="bi bi-whatsapp me-1 text-success" style="flex-shrink: 0;"></i>
                            <a href="https://wa.me/5511958353433" target="_blank" rel="noopener" class="text-success text-decoration-none fw-bold">+55 (11) 95835-3433</a>
                        </li>
                        <li class="mb-2 d-flex align-items-center gap-2">
                            <i class="bi bi-envelope me-1 text-success" style="color: var(--sh-primary) !important; flex-shrink: 0;"></i>
                            <a href="mailto:tradedesk@brxagroglobal.com" class="text-decoration-none text-white-50">tradedesk@brxagroglobal.com</a>
                        </li>
                        <li class="mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-clock me-1 text-success" style="color: var(--sh-primary) !important; flex-shrink: 0;"></i>
                            <span>Mon - Fri: 08:00 - 18:00 BRT</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="sh-footer-bottom mt-4 pt-4 text-center small text-white-50 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <div>
                    &copy; {{ date('Y') }} BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA. CNPJ: 38.471.480/0001-41. All rights reserved.
                </div>
                <div class="d-flex gap-3">
                    <span><i class="bi bi-shield-check text-success me-1"></i> Bank Escrow Protected</span>
                    <span><i class="bi bi-patch-check text-success me-1"></i> SGS Tested</span>
                    <span><i class="bi bi-award text-success me-1"></i> MAPA Certified</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- 11. MOBILE BOTTOM TAB BAR (Exact fume-main sh-tabbar layout) -->
    <nav class="sh-tabbar" aria-label="Mobile navigation">
        <a href="{{ route('home') }}" class="active">
            <i class="bi bi-house-fill"></i>
            <span>Home</span>
        </a>
        <a href="#products">
            <i class="bi bi-bag"></i>
            <span>Shop</span>
        </a>
        <a href="#rfq-desk">
            <i class="bi bi-file-earmark-text"></i>
            <span>RFQ</span>
        </a>
        <a href="javascript:void(0)" class="mobile-cart-trigger position-relative">
            <i class="bi bi-cart3"></i>
            <span>Cart</span>
            <span class="sh-tabbar-badge mobileCartBadge">0</span>
        </a>
        <a href="{{ auth()->check() ? route('admin.dashboard') : route('login') }}">
            <i class="bi bi-person{{ auth()->check() ? '-fill' : '' }}"></i>
            <span>{{ auth()->check() ? 'Account' : 'Login' }}</span>
        </a>
    </nav>

    <!-- 12. CART TOAST NOTIFICATION (Exact fume-main architecture) -->
    <div id="sh-toast" class="sh-toast">
        <div class="sh-toast-icon"><i class="bi bi-check-circle-fill"></i></div>
        <div class="sh-toast-body">
            <div class="sh-toast-message fw-bold small" id="shToastMsg">Item added to cart!</div>
            <div class="sh-toast-count small text-white-50" id="shToastCount">1 item(s) in cart</div>
        </div>
    </div>

    <!-- 13. SCROLL TO TOP BUTTON (Exact fume-main architecture) -->
    <button id="sh-scroll-top" class="sh-scroll-top" aria-label="Scroll to top">
        <i class="bi bi-chevron-up"></i>
    </button>

    <!-- Modals & Drawers -->

    <!-- Agrovia Cart Drawer Backdrop & Offcanvas -->
    <div id="agroviaCartBackdrop" class="sh-cart-backdrop" onclick="closeCartDrawer()"></div>

    <div id="agroviaCartDrawer" class="sh-cart-offcanvas" role="dialog" aria-modal="true" aria-labelledby="cartDrawerTitle">
        <!-- Drawer Header -->
        <div class="offcanvas-header">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background: rgba(120, 162, 47, 0.15); color: var(--sh-primary); font-size: 1.15rem;">
                    <i class="bi bi-cart3"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold sh-text-title d-flex align-items-center gap-2" id="cartDrawerTitle" style="font-size: 1.05rem;">
                        Agro-Commodity Cart
                        <span class="badge rounded-pill" id="cartDrawerCountBadge" style="background: var(--sh-primary); font-size: 0.7rem; font-weight: 700;">0 lots</span>
                    </h5>
                    <small class="text-muted" style="font-size: 0.75rem;">Brazilian Origination &amp; Sample Desk</small>
                </div>
            </div>
            <button type="button" class="btn btn-sm text-secondary p-1" onclick="closeCartDrawer()" aria-label="Close cart" style="font-size: 1.25rem; line-height: 1;">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <!-- Drawer Body -->
        <div class="offcanvas-body">
            <!-- Empty State -->
            <div id="cartEmptyState" class="text-center py-5 my-auto d-none">
                <div class="mb-3 text-muted opacity-50" style="font-size: 3.5rem;">
                    <i class="bi bi-basket3"></i>
                </div>
                <h5 class="fw-bold sh-text-title mb-2">Your Sample Cart is Empty</h5>
                <p class="text-muted small mb-4 px-3">
                    You have not added any commodity lots yet. Browse our harvest catalog or select physical samples for laboratory analysis.
                </p>
                <a href="#products" class="btn btn-sh-primary btn-sm px-4 py-2" onclick="closeCartDrawer()">
                    <i class="bi bi-grid-3x3-gap me-1"></i> Browse Commodities
                </a>
            </div>

            <!-- Populated Cart Content -->
            <div id="cartPopulatedContent" class="d-flex flex-column flex-grow-1">
                <!-- Cart Items List -->
                <div id="cartItemsList" class="sh-cart-items-container">
                    <!-- Items rendered dynamically by JS -->
                </div>

                <!-- Quality & Settlement Assurance Card -->
                <div class="sh-cart-assurance-card mb-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <i class="bi bi-shield-check" style="color: var(--sh-primary); font-size: 1.1rem;"></i>
                        <strong class="sh-text-title">SGS Assayed &amp; MAPA Phyto Cleared</strong>
                    </div>
                    <div class="text-muted" style="font-size: 0.78rem; line-height: 1.4;">
                        Every lot includes physical assay verification, non-GMO certificates, and export clearance through Brazilian ports under zero-risk bank escrow protection.
                    </div>
                </div>

                <!-- Cart Summary Box -->
                <div class="sh-cart-summary-box mt-auto">
                    <div class="d-flex justify-content-between align-items-center mb-2 small">
                        <span class="text-muted">Total Sample Lots:</span>
                        <strong class="sh-text-title" id="cartSummaryLotCount">0</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2 small">
                        <span class="text-muted">Loading Ports:</span>
                        <span class="fw-semibold sh-text-title">Santos &amp; Paranaguá (BR)</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2 small">
                        <span class="text-muted">Escrow &amp; Assay Protection:</span>
                        <span class="text-success fw-bold"><i class="bi bi-check-circle me-1"></i>Included</span>
                    </div>
                    <hr class="my-2 border-secondary border-opacity-25">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="d-block fw-bold sh-text-title" style="font-size: 0.95rem;">Estimated Total:</span>
                            <small class="text-muted" style="font-size: 0.72rem;">FOB Santos / Paranaguá</small>
                        </div>
                        <span class="fw-bold" style="color: var(--sh-primary); font-size: 1.35rem;" id="cartSummaryTotalVal">$0.00</span>
                    </div>

                    <!-- Action Buttons -->
                    <button type="button" id="btnOpenCheckout" class="btn btn-sh-primary w-100 py-2 fw-bold d-flex align-items-center justify-content-center gap-2" style="font-size: 0.95rem;">
                        <i class="bi bi-lock-fill"></i> Proceed to Trade Checkout
                    </button>

                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top border-secondary border-opacity-25">
                        <button type="button" onclick="clearCart()" class="btn btn-link text-danger text-decoration-none p-0 small" style="font-size: 0.8rem;">
                            <i class="bi bi-trash3 me-1"></i> Clear Cart
                        </button>
                        <a href="#rfq-desk" onclick="closeCartDrawer()" class="small text-decoration-none" style="color: var(--sh-primary); font-size: 0.8rem;">
                            <i class="bi bi-file-earmark-text me-1"></i> Need 500+ MT? Direct RFQ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agrovia Trade Checkout Modal -->
    <div class="modal fade" id="agroviaCheckoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: var(--sh-surface); color: var(--bs-body-color); border: 1px solid var(--sh-border);">
                <div class="modal-header border-bottom border-secondary border-opacity-25 py-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: rgba(120, 162, 47, 0.15); color: var(--sh-primary);">
                            <i class="bi bi-shield-lock-fill fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold sh-text-title mb-0" style="font-size: 1.15rem;">Commodity Dispatch &amp; Trade Checkout</h5>
                            <small class="text-muted" style="font-size: 0.78rem;">Verified Brazilian Institutional Origination</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <form id="checkoutOrderForm">
                        <!-- Step 1: Order Items Summary Preview -->
                        <div class="mb-4 p-3 rounded-3 sh-box-bg" style="border: 1px solid var(--bs-border-color);">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold sh-text-title small"><i class="bi bi-list-check text-success me-1"></i> Selected Commodity Lots:</span>
                                <span class="badge bg-success" id="checkoutItemCountBadge">0 items</span>
                            </div>
                            <div id="checkoutItemsList" class="small mb-2" style="max-height: 160px; overflow-y: auto;">
                                <!-- dynamically rendered items -->
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-2 border-top border-secondary border-opacity-25">
                                <span class="fw-semibold text-muted small">Total Commercial Value:</span>
                                <span class="fw-bold fs-5" style="color: var(--sh-primary);" id="checkoutTotalVal">$0.00</span>
                            </div>
                        </div>

                        <!-- Step 2: Buyer & Logistics Details -->
                        <h6 class="fw-bold sh-text-title mb-3 small text-uppercase" style="letter-spacing: 0.5px;">
                            <i class="bi bi-person-badge text-success me-1"></i> 1. Buyer &amp; Corporate Entity
                        </h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Representative / Contact Name <span class="text-danger">*</span></label>
                                <input type="text" name="customer_name" class="form-control sh-input rounded-3" value="{{ auth()->check() ? auth()->user()->name : '' }}" placeholder="e.g. John Doe / Procuring Officer" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Corporate Email (for SGS &amp; Invoice) <span class="text-danger">*</span></label>
                                <input type="email" name="customer_email" class="form-control sh-input rounded-3" value="{{ auth()->check() ? auth()->user()->email : '' }}" placeholder="buyer@company.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Contact Phone / WhatsApp</label>
                                <input type="text" name="customer_phone" class="form-control sh-input rounded-3" placeholder="+1 (555) 019-2834">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Destination Port / Discharge Facility <span class="text-danger">*</span></label>
                                <select name="shipping_address" class="form-select sh-input rounded-3" required>
                                    <option value="Rotterdam Port (NLRTM), Netherlands - CIF">Port of Rotterdam (NLRTM) - CIF</option>
                                    <option value="Qingdao Port (CNTAO), China - CIF">Port of Qingdao (CNTAO) - CIF</option>
                                    <option value="Jebel Ali Port (AEJEA), Dubai UAE - CIF">Port of Jebel Ali (AEJEA), Dubai - CIF</option>
                                    <option value="Santos Export Terminal (BRSSZ), Brazil - FOB" selected>Port of Santos (BRSSZ) - FOB Brazilian Berth</option>
                                    <option value="Paranaguá Port (BRPNG), Brazil - FOB">Port of Paranaguá (BRPNG) - FOB</option>
                                    <option value="Air Courier Laboratory Sample Express">Air Courier Laboratory Sample Express (DHL/FedEx)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Step 3: Settlement Instrument -->
                        <h6 class="fw-bold sh-text-title mb-3 small text-uppercase" style="letter-spacing: 0.5px;">
                            <i class="bi bi-credit-card-2-front text-success me-1"></i> 2. Settlement &amp; Escrow Instrument
                        </h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Payment Instrument</label>
                                <select name="payment_method" class="form-select sh-input rounded-3">
                                    <option value="Tier-1 Bank Escrow (LC / Irrevocable Documentary Credit)" selected>Tier-1 Bank Escrow (Irrevocable LC / MT700)</option>
                                    <option value="Direct Bank Wire (SWIFT T/T against SGS Inspection Certificate)">Direct Bank Wire (SWIFT T/T against SGS Assays)</option>
                                    <option value="Institutional Digital Settlement (USDT / USDC Escrow)">Digital Asset Escrow (USDT / USDC)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Special Phytosanitary / Assay Instructions</label>
                                <input type="text" name="notes" class="form-control sh-input rounded-3" placeholder="e.g., Request Non-GMO IP certificate, Moisture < 12%">
                            </div>
                        </div>

                        <!-- Assurance Strip -->
                        <div class="p-3 rounded-3 mb-4 small d-flex flex-wrap gap-3 align-items-center justify-content-between" style="background: rgba(120, 162, 47, 0.08); border: 1px solid rgba(120, 162, 47, 0.25);">
                            <div><i class="bi bi-patch-check-fill text-success me-1"></i> 100% Pre-Shipment Assay</div>
                            <div><i class="bi bi-shield-fill-check text-success me-1"></i> Bank Escrow Protected</div>
                            <div><i class="bi bi-file-earmark-lock text-success me-1"></i> Official MAPA Export Clearance</div>
                        </div>

                        <!-- Order Alert message container -->
                        <div id="checkoutAlertBox" class="alert d-none mb-3 py-2 px-3 small rounded-3"></div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-2">
                            <button type="submit" id="btnSubmitOrder" class="btn btn-sh-primary flex-grow-1 py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                                <span class="spinner-border spinner-border-sm d-none" id="orderSubmitSpinner" role="status"></span>
                                <i class="bi bi-check2-circle fs-5" id="orderSubmitIcon"></i>
                                <span id="orderSubmitText">Confirm &amp; Place Commodity Order</span>
                            </button>
                            <button type="button" class="btn btn-sh-outline px-4" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: var(--sh-surface); color: var(--bs-body-color);">
                <div class="modal-header border-bottom border-secondary border-opacity-25 py-3">
                    <h5 class="modal-title fw-bold sh-text-title" id="qvModalTitle">Commodity Quick View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="rounded-3 overflow-hidden mb-3" style="height: 200px;">
                        <img id="qvModalImg" src="" alt="" class="w-100 h-100 object-fit-cover">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h4 class="fw-bold sh-text-title mb-0" id="qvModalName"></h4>
                        <span class="badge rounded-pill" id="qvModalOrigin" style="background: rgba(120, 162, 47, 0.2); color: var(--sh-primary); border: 1px solid rgba(120, 162, 47, 0.3);">Brazil</span>
                    </div>
                    <p class="fs-5 fw-bold mb-3" style="color: var(--sh-primary);" id="qvModalPrice" data-price="485.00" data-unit="MT"></p>
                    <div class="p-3 rounded-3 mb-3 small sh-box-bg" style="border: 1px solid var(--bs-border-color);">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="sh-text-muted">SGS Assay:</span>
                            <span class="sh-text-title fw-bold">100% Pre-Shipment Tested</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="sh-text-muted">Settlement:</span>
                            <span class="text-success fw-bold">Bank Escrow Protected</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="sh-text-muted">Loading Port:</span>
                            <span class="sh-text-title fw-bold">Santos / Paranaguá (BR)</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" id="qvAddToCartBtn" class="btn btn-sh-primary flex-fill">
                            <i class="bi bi-bag me-1"></i> Add to Sample Cart
                        </button>
                        <button type="button" class="btn btn-sh-outline" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: var(--sh-surface); color: var(--bs-body-color);">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold sh-text-title"><i class="bi bi-search me-2" style="color: var(--sh-primary);"></i>Search Commodities</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="text" id="modalSearchInput" class="form-control form-control-lg rounded-pill mb-3 sh-input" placeholder="Type commodity name, grade, or basin...">
                    <div class="small sh-text-muted">Press <kbd class="sh-box-bg sh-text-title border border-secondary px-2 py-1">Esc</kbd> to exit.</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        (function () {
            "use strict";

            // Theme Toggle Functionality (fume-main theme switcher)
            var root = document.documentElement;
            function updateThemeIcons() {
                var isLight = root.getAttribute('data-theme') === 'light';
                document.querySelectorAll('#themeToggleBtn i, .sh-theme-toggle i').forEach(function (icon) {
                    icon.className = isLight ? 'bi bi-sun' : 'bi bi-moon-stars';
                });
            }
            updateThemeIcons();

            document.querySelectorAll('#themeToggleBtn, .sh-theme-toggle').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var current = root.getAttribute('data-theme') || 'dark';
                    var next = current === 'light' ? 'dark' : 'light';
                    root.setAttribute('data-theme', next);
                    try { localStorage.setItem('sh-theme', next); } catch (e) {}
                    updateThemeIcons();
                });
            });

            // Cart State & Notification
            var cart = [];
            try {
                cart = JSON.parse(localStorage.getItem('agroviaCart') || '[]');
                // Ensure items have proper structure
                cart = cart.map(function (item) {
                    return {
                        name: item.name || 'Commodity Lot',
                        price: parseFloat(item.price) || 485.00,
                        unit: item.unit || 'MT',
                        image: item.image || '{{ asset('img/service-1.jpg') }}',
                        origin: item.origin || 'Brazil',
                        qty: parseInt(item.qty, 10) || 1
                    };
                });
            } catch (e) {
                cart = [];
            }

            function saveCart() {
                try {
                    localStorage.setItem('agroviaCart', JSON.stringify(cart));
                } catch (e) {}
            }

            function updateCartCount() {
                var total = cart.reduce(function (sum, item) { return sum + (parseInt(item.qty, 10) || 1); }, 0);
                $('#cartCountBadge, .mobileCartBadge').text(total);
                $('#cartDrawerCountBadge').text(total + (total === 1 ? ' lot' : ' lots'));
                return total;
            }
            updateCartCount();

            function triggerToast(message, total) {
                var toast = document.getElementById('sh-toast');
                if (!toast) return;
                document.getElementById('shToastMsg').textContent = message;
                document.getElementById('shToastCount').textContent = total + ' lot(s) in cart';
                toast.classList.remove('sh-toast-hide');
                toast.classList.add('sh-toast-show');
                setTimeout(function () {
                    toast.classList.remove('sh-toast-show');
                    toast.classList.add('sh-toast-hide');
                }, 3000);
            }

            // Agrovia Cart Drawer Functions
            function openCartDrawer() {
                renderCartDrawer();
                var backdrop = document.getElementById('agroviaCartBackdrop');
                var drawer = document.getElementById('agroviaCartDrawer');
                if (backdrop) backdrop.classList.add('show');
                if (drawer) drawer.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
            window.openCartDrawer = openCartDrawer;

            function closeCartDrawer() {
                var backdrop = document.getElementById('agroviaCartBackdrop');
                var drawer = document.getElementById('agroviaCartDrawer');
                if (backdrop) backdrop.classList.remove('show');
                if (drawer) drawer.classList.remove('show');
                document.body.style.overflow = '';
            }
            window.closeCartDrawer = closeCartDrawer;

            function renderCartDrawer() {
                updateCartCount();
                var $empty = $('#cartEmptyState');
                var $pop = $('#cartPopulatedContent');
                var $list = $('#cartItemsList');

                if (cart.length === 0) {
                    $empty.removeClass('d-none');
                    $pop.addClass('d-none');
                    $('#cartSummaryTotalVal').text('$0.00');
                    $('#cartSummaryLotCount').text('0');
                    return;
                }

                $empty.addClass('d-none');
                $pop.removeClass('d-none');
                $list.empty();

                var grandTotal = 0;
                var totalLots = 0;

                cart.forEach(function (item, index) {
                    var price = parseFloat(item.price) || 0;
                    var qty = parseInt(item.qty, 10) || 1;
                    var lineTotal = price * qty;
                    grandTotal += lineTotal;
                    totalLots += qty;

                    var itemHtml = `
                        <div class="sh-cart-item">
                            <img src="${item.image || '{{ asset('img/service-1.jpg') }}'}" alt="${item.name}" class="sh-cart-thumb">
                            <div class="flex-grow-1 min-w-0">
                                <div class="d-flex justify-content-between align-items-start gap-1">
                                    <h6 class="mb-0 fw-bold sh-text-title text-truncate" style="font-size: 0.88rem;" title="${item.name}">${item.name}</h6>
                                    <button type="button" class="btn btn-link text-danger p-0 border-0" onclick="removeCartItem(${index})" title="Remove item" style="font-size: 0.9rem; line-height: 1;">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                                <div class="d-flex align-items-center gap-1 my-1">
                                    <span class="badge" style="background: rgba(120, 162, 47, 0.15); color: var(--sh-primary); font-size: 0.68rem; padding: 2px 6px;">
                                        ${item.origin || 'Brazil'}
                                    </span>
                                    <span class="text-muted" style="font-size: 0.72rem;">· SGS Assayed</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div class="sh-cart-qty-ctrl">
                                        <button type="button" class="sh-cart-qty-btn" onclick="changeItemQty(${index}, -1)" title="Decrease">-</button>
                                        <span class="sh-cart-qty-val">${qty}</span>
                                        <button type="button" class="sh-cart-qty-btn" onclick="changeItemQty(${index}, 1)" title="Increase">+</button>
                                    </div>
                                    <div class="text-end">
                                        <span class="fw-bold" style="color: var(--sh-primary); font-size: 0.95rem;">$${lineTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</span>
                                        <small class="text-muted d-block" style="font-size: 0.68rem;">($${price.toFixed(2)}/${item.unit || 'MT'})</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    $list.append(itemHtml);
                });

                $('#cartSummaryLotCount').text(totalLots);
                $('#cartSummaryTotalVal').text('$' + grandTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            }
            window.renderCartDrawer = renderCartDrawer;

            function changeItemQty(index, delta) {
                if (!cart[index]) return;
                cart[index].qty = (parseInt(cart[index].qty, 10) || 1) + delta;
                if (cart[index].qty <= 0) {
                    cart.splice(index, 1);
                }
                saveCart();
                renderCartDrawer();
                triggerToast('Cart updated', updateCartCount());
            }
            window.changeItemQty = changeItemQty;

            function removeCartItem(index) {
                if (!cart[index]) return;
                var removedName = cart[index].name;
                cart.splice(index, 1);
                saveCart();
                renderCartDrawer();
                triggerToast(removedName + ' removed from cart', updateCartCount());
            }
            window.removeCartItem = removeCartItem;

            function clearCart() {
                if (cart.length === 0) return;
                if (confirm('Are you sure you want to clear your commodity sample cart?')) {
                    cart = [];
                    saveCart();
                    renderCartDrawer();
                    triggerToast('Cart cleared', 0);
                }
            }
            window.clearCart = clearCart;

            // Add to Cart Buttons
            var currentQvProduct = '';
            var currentQvPrice = 485.00;
            var currentQvUnit = 'MT';
            var currentQvImage = '{{ asset('img/service-1.jpg') }}';
            var currentQvOrigin = 'Brazil';

            $(document).on('click', '.btn-add-cart', function (e) {
                e.preventDefault();
                var prodName = $(this).attr('data-name') || 'Agricultural Commodity';
                var prodPrice = parseFloat($(this).attr('data-price')) || 485.00;
                var prodUnit = $(this).attr('data-unit') || 'MT';
                var prodImage = $(this).attr('data-image') || '{{ asset('img/service-1.jpg') }}';
                var prodOrigin = $(this).attr('data-origin') || 'Brazil';

                var existing = cart.find(function (i) { return i.name === prodName; });
                if (existing) {
                    existing.qty = (parseInt(existing.qty, 10) || 1) + 1;
                } else {
                    cart.push({
                        name: prodName,
                        price: prodPrice,
                        unit: prodUnit,
                        image: prodImage,
                        origin: prodOrigin,
                        qty: 1
                    });
                }
                saveCart();
                var total = updateCartCount();
                triggerToast(prodName + ' added to cart!', total);
                openCartDrawer();
            });

            // Quick View Trigger
            $(document).on('click', '.quick-view-trigger', function () {
                currentQvProduct = $(this).attr('data-product') || 'Brazilian Agro Commodity';
                var displayPrice = $(this).attr('data-price') || '$485.00 / MT';
                currentQvImage = $(this).attr('data-image') || '{{ asset('img/service-1.jpg') }}';
                currentQvOrigin = $(this).attr('data-origin') || 'Brazil';
                currentQvUnit = $(this).attr('data-unit') || 'MT';

                var rawPrice = $(this).attr('data-rawprice');
                if (rawPrice) {
                    currentQvPrice = parseFloat(rawPrice) || 485.00;
                } else {
                    var match = displayPrice.replace(/[^0-9.]/g, '');
                    currentQvPrice = parseFloat(match) || 485.00;
                }

                $('#qvModalTitle').text(currentQvProduct);
                $('#qvModalName').text(currentQvProduct);
                $('#qvModalPrice').text(displayPrice).attr('data-price', currentQvPrice).attr('data-unit', currentQvUnit);
                $('#qvModalOrigin').text(currentQvOrigin);
                $('#qvModalImg').attr('src', currentQvImage);

                var modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
                modal.show();
            });

            $('#qvAddToCartBtn').on('click', function () {
                if (!currentQvProduct) return;
                var existing = cart.find(function (i) { return i.name === currentQvProduct; });
                if (existing) {
                    existing.qty = (parseInt(existing.qty, 10) || 1) + 1;
                } else {
                    cart.push({
                        name: currentQvProduct,
                        price: currentQvPrice,
                        unit: currentQvUnit,
                        image: currentQvImage,
                        origin: currentQvOrigin,
                        qty: 1
                    });
                }
                saveCart();
                var total = updateCartCount();
                triggerToast(currentQvProduct + ' added to cart!', total);
                var qvEl = document.getElementById('quickViewModal');
                var qvInstance = bootstrap.Modal.getInstance(qvEl);
                if (qvInstance) { qvInstance.hide(); }
                openCartDrawer();
            });

            $('#cartTriggerBtn, .mobile-cart-trigger').on('click', function (e) {
                e.preventDefault();
                openCartDrawer();
            });

            // Open Checkout Modal from Cart Drawer
            $('#btnOpenCheckout').on('click', function () {
                if (cart.length === 0) {
                    alert('Your sample cart is currently empty. Please select commodity lots first.');
                    return;
                }
                closeCartDrawer();

                var $chkList = $('#checkoutItemsList');
                $chkList.empty();
                var totalVal = 0;
                var lotCount = 0;

                cart.forEach(function (item) {
                    var price = parseFloat(item.price) || 0;
                    var qty = parseInt(item.qty, 10) || 1;
                    var sub = price * qty;
                    totalVal += sub;
                    lotCount += qty;

                    $chkList.append(`
                        <div class="d-flex justify-content-between align-items-center py-1 border-bottom border-secondary border-opacity-10">
                            <div>
                                <strong class="sh-text-title">${item.name}</strong>
                                <span class="text-muted ms-1">(${qty} &times; $${price.toFixed(2)}/${item.unit || 'MT'})</span>
                            </div>
                            <span class="fw-bold" style="color: var(--sh-primary);">$${sub.toFixed(2)}</span>
                        </div>
                    `);
                });

                $('#checkoutItemCountBadge').text(lotCount + (lotCount === 1 ? ' item' : ' items'));
                $('#checkoutTotalVal').text('$' + totalVal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                $('#checkoutAlertBox').addClass('d-none');

                var checkoutModal = new bootstrap.Modal(document.getElementById('agroviaCheckoutModal'));
                checkoutModal.show();
            });

            // Submit Checkout Order via AJAX
            $('#checkoutOrderForm').on('submit', function (e) {
                e.preventDefault();
                if (cart.length === 0) {
                    alert('Your cart is empty.');
                    return;
                }

                var $btn = $('#btnSubmitOrder');
                var $spinner = $('#orderSubmitSpinner');
                var $icon = $('#orderSubmitIcon');
                var $text = $('#orderSubmitText');
                var $alert = $('#checkoutAlertBox');

                $btn.prop('disabled', true);
                $spinner.removeClass('d-none');
                $icon.addClass('d-none');
                $text.text('Transmitting Order to Brazilian Export Desk...');

                var formData = {
                    customer_name: $('input[name="customer_name"]').val(),
                    customer_email: $('input[name="customer_email"]').val(),
                    customer_phone: $('input[name="customer_phone"]').val(),
                    shipping_address: $('select[name="shipping_address"]').val(),
                    payment_method: $('select[name="payment_method"]').val(),
                    notes: $('input[name="notes"]').val(),
                    items: cart.map(function (item) {
                        return {
                            name: item.name,
                            qty: parseInt(item.qty, 10) || 1,
                            price: parseFloat(item.price) || 0
                        };
                    })
                };

                $.ajax({
                    url: '{{ route('checkout.store') }}',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    },
                    success: function (res) {
                        $alert.removeClass('d-none alert-danger').addClass('alert-success').html(`
                            <h6 class="fw-bold mb-1"><i class="bi bi-check-circle-fill me-1"></i> Order Recorded Successfully!</h6>
                            <p class="mb-1">Order Ref: <strong>${res.order_number}</strong></p>
                            <p class="mb-0 small text-muted">${res.message}</p>
                        `);

                        // Clear cart
                        cart = [];
                        saveCart();
                        updateCartCount();
                        renderCartDrawer();

                        setTimeout(function () {
                            var chkModalEl = document.getElementById('agroviaCheckoutModal');
                            var chkInstance = bootstrap.Modal.getInstance(chkModalEl);
                            if (chkInstance) {
                                chkInstance.hide();
                            }
                            $btn.prop('disabled', false);
                            $spinner.addClass('d-none');
                            $icon.removeClass('d-none');
                            $text.text('Confirm & Place Commodity Order');
                            triggerToast('Order ' + res.order_number + ' Placed!', 0);
                        }, 2500);
                    },
                    error: function (xhr) {
                        var errMsg = 'Unable to complete checkout. Please review form fields or contact our trade desk directly.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errMsg = xhr.responseJSON.message;
                        }
                        $alert.removeClass('d-none alert-success').addClass('alert-danger').text(errMsg);
                        $btn.prop('disabled', false);
                        $spinner.addClass('d-none');
                        $icon.removeClass('d-none');
                        $text.text('Confirm & Place Commodity Order');
                    }
                });
            });

            // Category Filter Buttons
            $('.agro-filter-btn').on('click', function () {
                $('.agro-filter-btn').removeClass('active btn-primary').addClass('btn-outline-secondary');
                $(this).addClass('active btn-primary').removeClass('btn-outline-secondary');
                var filter = $(this).attr('data-filter');
                $('.product-item').each(function () {
                    var cat = $(this).attr('data-category');
                    if (filter === 'all' || cat === filter) {
                        $(this).stop(true, true).fadeIn(250);
                    } else {
                        $(this).stop(true, true).fadeOut(150);
                    }
                });
            });

            // Dropdown Category Filter in Navbar
            $(document).on('click', '.agro-nav-cat-filter', function (e) {
                var targetCat = $(this).attr('data-filter');
                if (targetCat) {
                    var $matchBtn = $('.agro-filter-btn').filter(function () {
                        return $(this).text().trim().toLowerCase() === targetCat.toLowerCase();
                    });
                    if ($matchBtn.length > 0) {
                        $matchBtn.click();
                    } else {
                        $('.agro-filter-btn').removeClass('active btn-primary').addClass('btn-outline-secondary');
                        $('.product-item').each(function () {
                            var cat = ($(this).attr('data-category') || '').toLowerCase();
                            if (cat.indexOf(targetCat.toLowerCase()) !== -1) {
                                $(this).stop(true, true).fadeIn(250);
                            } else {
                                $(this).stop(true, true).fadeOut(150);
                            }
                        });
                    }
                    var prodSec = document.getElementById('products');
                    if (prodSec) {
                        prodSec.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });

            // Scroll to Top Button
            var scrollBtn = document.getElementById('sh-scroll-top');
            if (scrollBtn) {
                window.addEventListener('scroll', function () {
                    scrollBtn.classList.toggle('visible', window.scrollY > 350);
                });
                scrollBtn.addEventListener('click', function () {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }

            // RFQ In-Page Form Submission
            $('#rfqInquiryForm').on('submit', function (e) {
                e.preventDefault();
                var $form = $(this);
                var $btn = $('#rfqSubmitBtn');
                var origText = $btn.html();
                $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Transmitting to Brazilian Desk...');

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var formData = $form.serialize();

                $.ajax({
                    url: '/inquiries',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    success: function (res) {
                        var ref = res.reference || ('AGRO-INQ-' + Math.random().toString(36).substring(2, 8).toUpperCase());
                        $('#rfqAlert').removeClass('d-none alert-danger').addClass('alert alert-success').html(
                            '<strong>Inquiry Received!</strong> Reference Code: <code>' + ref + '</code>. Our São Paulo trade desk will contact your company within 4 business hours.'
                        );
                        triggerToast('RFQ Transmitted! Ref: ' + ref, updateCartCount());
                        $form[0].reset();
                    },
                    error: function (xhr) {
                        var errorMsg = 'Failed to submit inquiry. Please check required fields or contact WhatsApp directly.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        $('#rfqAlert').removeClass('d-none alert-success').addClass('alert alert-danger').text(errorMsg);
                    },
                    complete: function () {
                        $btn.prop('disabled', false).html(origText);
                    }
                });
            });

            // Modal Search Filter
            $('#modalSearchInput').on('input', function () {
                var val = $(this).val().toLowerCase();
                $('.product-item').each(function () {
                    var text = $(this).text().toLowerCase();
                    $(this).toggle(text.indexOf(val) !== -1);
                });
            });

        })();
    </script>
</body>

</html>
