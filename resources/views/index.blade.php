<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#14141a">
    <title>Matro - Brazilian Agro-Commodity Trading &amp; Store</title>
    <meta content="Brazilian agro commodities, bulk soybeans, ICUMSA 45 sugar, yellow corn, green coffee, SGS inspection, escrow settlement, Port of Santos, Matro" name="keywords">
    <meta content="Matro coordinates direct institutional origination of Brazilian agro-commodities for international buyers. Sourced from certified cooperatives, verified by SGS &amp; MAPA, and secured with Tier-1 bank escrow." name="description">

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
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: {
                preflight: false,
            }
        }
    </script>

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
            --sh-border: rgba(255, 255, 255, 0.12);

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
            --sh-border: rgba(20, 20, 26, 0.12);

            --bs-body-bg: #f7f7f9;
            --bs-body-color: #17171c;
            --bs-secondary-color: rgba(35, 35, 44, 0.65);
            --bs-border-color: rgba(20, 20, 26, 0.14);
            --bs-emphasis-color: #14141a;
            --bs-link-color: #5e8024;
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
        }

        /* ===== Navbar (fume-main layout) ===== */
        .sh-navbar {
            background: var(--sh-black);
            border-bottom: 1px solid var(--sh-border);
            z-index: 1030;
        }
        .sh-navbar .navbar-brand {
            color: #fff;
            font-weight: 800;
            letter-spacing: -0.5px;
            font-size: 1.45rem;
        }
        .sh-navbar .navbar-brand span {
            color: var(--sh-primary);
        }
        .sh-navbar .nav-link {
            color: rgba(255, 255, 255, 0.82);
            font-weight: 500;
            font-size: 0.95rem;
            transition: color .2s ease;
        }
        .sh-navbar .nav-link:hover,
        .sh-navbar .nav-link.active {
            color: var(--sh-primary) !important;
        }

        @media (min-width: 992px) {
            .sh-navbar .navbar-nav.mx-auto {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                gap: 1.25rem;
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
        }

        .sh-cart-icon {
            position: relative;
            color: #fff;
            font-size: 1.35rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            width: 38px;
            height: 38px;
        }
        .sh-cart-icon:hover {
            color: var(--sh-primary);
        }
        .sh-cart-badge {
            position: absolute;
            top: 0;
            right: 0;
            background: var(--sh-primary);
            color: #fff;
            font-size: .65rem;
            font-weight: 700;
            border-radius: 999px;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
        }

        .sh-theme-toggle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: transparent;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
            transition: all .2s ease;
        }
        .sh-theme-toggle:hover {
            color: var(--sh-primary);
            border-color: var(--sh-primary);
            background: rgba(120, 162, 47, 0.12);
        }

        .sh-toggler {
            width: 40px;
            height: 36px;
            padding: 0;
            border: 1px solid rgba(255, 255, 255, 0.18);
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
            background: #fff;
            transition: transform .25s ease, opacity .2s ease;
        }
        .sh-toggler[aria-expanded="true"] .bar:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
        .sh-toggler[aria-expanded="true"] .bar:nth-child(2) { opacity: 0; }
        .sh-toggler[aria-expanded="true"] .bar:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

        /* ===== Buttons ===== */
        .btn-sh-primary {
            background: var(--sh-primary);
            border-color: var(--sh-primary);
            color: #fff;
            font-family: 'Comic Relief', 'Open Sans', system-ui;
            font-weight: 600;
            padding: .6rem 1.4rem;
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
            background: var(--sh-black);
            color: rgba(255, 255, 255, 0.68);
            border-top: 1px solid var(--bs-border-color);
        }
        .sh-footer h6 {
            color: #fff;
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 1rem;
            letter-spacing: 0.5px;
        }
        .sh-footer a {
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            transition: color .2s ease;
        }
        .sh-footer a:hover {
            color: var(--sh-primary);
        }
        .sh-footer .social-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin-right: .5rem;
            transition: all .2s ease;
        }
        .sh-footer .social-icon:hover {
            background: var(--sh-primary);
            border-color: var(--sh-primary);
            color: #fff;
        }
        .sh-footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
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
        .sh-tabbar > a i { font-size: 1.25rem; }
        .sh-tabbar > a.active, .sh-tabbar > a:hover { color: var(--sh-primary); }
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

    <!-- 1. STICKY TOP NAVBAR (fume-main navbar layout) -->
    <nav class="navbar navbar-expand-lg sh-navbar py-3 sticky-top">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand d-flex align-items-center me-3" href="{{ route('home') }}">
                <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle me-2 shadow-sm" style="width: 36px; height: 36px; background-color: var(--sh-primary) !important;">
                    <i class="fa fa-shopping-basket"></i>
                </span>
                <span>MATRO <span>AGRO</span></span>
            </a>

            <!-- Mobile Hamburger Toggler -->
            <button class="navbar-toggler sh-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

            <!-- Nav Links & Actions -->
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto gap-lg-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    @if (isset($categories) && $categories->isNotEmpty())
                        @foreach ($categories->take(5) as $cat)
                            <li class="nav-item">
                                <a class="nav-link" href="#products">{{ $cat->name }}</a>
                            </li>
                        @endforeach
                    @else
                        <li class="nav-item"><a class="nav-link" href="#products">Grains &amp; Rice</a></li>
                        <li class="nav-item"><a class="nav-link" href="#products">Oil &amp; Sugar</a></li>
                        <li class="nav-item"><a class="nav-link" href="#products">Nuts &amp; Seeds</a></li>
                        <li class="nav-item"><a class="nav-link" href="#products">Lentils &amp; Pulses</a></li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="#products">Shop All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#rfq-desk">Direct RFQ</a>
                    </li>
                </ul>

                <!-- Navbar Actions (Theme / Cart / Search / Auth) -->
                <div class="sh-nav-actions d-flex align-items-center gap-3 mt-3 mt-lg-0">
                    <!-- Theme Toggle -->
                    <button type="button" class="sh-theme-toggle" aria-label="Toggle dark / light theme" title="Toggle Theme">
                        <i class="bi bi-moon-stars"></i>
                    </button>

                    <!-- Search Trigger Modal -->
                    <button type="button" class="sh-theme-toggle" data-bs-toggle="modal" data-bs-target="#searchModal" title="Search Products">
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
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="background: var(--sh-surface); border: 1px solid var(--sh-border);">
                                <li class="px-3 py-2 border-bottom small text-muted">
                                    Signed in as <strong class="d-block text-white">{{ auth()->user()->email }}</strong>
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
                        <a href="{{ route('login') }}" class="btn btn-sh-outline-white btn-sm">Log in</a>
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
                            <img src="{{ asset('img/carousel-2.jpg') }}" alt="Export Grade Commodities" class="sh-hero-bg">
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
        <section class="py-4" style="background: var(--sh-black); border-bottom: 1px solid var(--sh-border);">
            <div class="container">
                <form action="#products" method="GET" class="mx-auto" style="max-width: 620px;" onsubmit="event.preventDefault(); var q = $('#quickSearchInput').val().toLowerCase(); $('.agro-filter-btn[data-filter=\'all\']').click(); $('.product-item').each(function(){ var t = $(this).text().toLowerCase(); $(this).toggle(t.indexOf(q) !== -1); }); $('html, body').animate({scrollTop: $('#products').offset().top - 80}, 600);">
                    <div class="input-group">
                        <input type="text" id="quickSearchInput" class="form-control form-control-lg" placeholder="Search Brazilian commodities, grades, harvest basins..." style="border: none; border-radius: 8px 0 0 8px; font-size: 1rem; background: var(--sh-surface); color: var(--bs-body-color);">
                        <button type="submit" class="btn btn-sh-primary btn-lg" style="border-radius: 0 8px 8px 0;">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- 4. FEATURE STRIP (Exact fume-main layout) -->
        <section class="sh-strip py-3">
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
                                        <img src="{{ asset($product->image ?: 'img/service-1.jpg') }}" alt="{{ $product->name }}" loading="lazy">
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
                                        <button type="button" class="sh-card-cart-btn btn-add-cart" data-name="{{ $product->name }}">
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
                                    <img src="{{ asset('img/service-1.jpg') }}" alt="Brazilian Non-GMO Soybeans">
                                    <span class="sh-badge-sale">BULK</span>
                                    <span class="sh-badge-original">$520.00</span>
                                </div>
                                <div class="sh-card-body">
                                    <div class="sh-card-brand">Mato Grosso · Grains &amp; Rice</div>
                                    <div class="sh-card-name">Brazilian Non-GMO Soybeans</div>
                                    <div class="sh-card-price"><span class="price-now">$485.00</span> <small class="text-muted">/ MT</small></div>
                                    <button class="sh-card-cart-btn btn-add-cart" data-name="Brazilian Non-GMO Soybeans"><i class="bi bi-bag"></i> Add to Cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="col product-item" data-category="Oil & Sugar">
                            <div class="sh-product-card">
                                <div class="sh-product-img">
                                    <img src="{{ asset('img/service-2.jpg') }}" alt="Refined Cane Sugar ICUMSA 45">
                                    <span class="sh-badge-sale">BULK</span>
                                    <span class="sh-badge-original">$580.00</span>
                                </div>
                                <div class="sh-card-body">
                                    <div class="sh-card-brand">São Paulo · Oil &amp; Sugar</div>
                                    <div class="sh-card-name">Refined Cane Sugar (ICUMSA 45)</div>
                                    <div class="sh-card-price"><span class="price-now">$540.00</span> <small class="text-muted">/ MT</small></div>
                                    <button class="sh-card-cart-btn btn-add-cart" data-name="Refined Cane Sugar (ICUMSA 45)"><i class="bi bi-bag"></i> Add to Cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="col product-item" data-category="Grains & Rice">
                            <div class="sh-product-card">
                                <div class="sh-product-img">
                                    <img src="{{ asset('img/service-3.jpg') }}" alt="Yellow Corn Maize Grade 2">
                                    <span class="sh-badge-new">NEW</span>
                                </div>
                                <div class="sh-card-body">
                                    <div class="sh-card-brand">Goiás · Grains &amp; Rice</div>
                                    <div class="sh-card-name">Yellow Corn (Maize Grade 2)</div>
                                    <div class="sh-card-price"><span class="price-now">$245.00</span> <small class="text-muted">/ MT</small></div>
                                    <button class="sh-card-cart-btn btn-add-cart" data-name="Yellow Corn (Maize Grade 2)"><i class="bi bi-bag"></i> Add to Cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="col product-item" data-category="Spices & Specialty">
                            <div class="sh-product-card">
                                <div class="sh-product-img">
                                    <img src="{{ asset('img/service-5.jpg') }}" alt="Arabica Green Coffee Beans">
                                    <span class="sh-badge-sale">EXPORT</span>
                                </div>
                                <div class="sh-card-body">
                                    <div class="sh-card-brand">Minas Gerais · Specialty</div>
                                    <div class="sh-card-name">Arabica Green Coffee Beans</div>
                                    <div class="sh-card-price"><span class="price-now">$3,850.00</span> <small class="text-muted">/ MT</small></div>
                                    <button class="sh-card-cart-btn btn-add-cart" data-name="Arabica Green Coffee Beans"><i class="bi bi-bag"></i> Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- 6. CATEGORY CARDS SECTION (Exact fume-main category architecture) -->
        <section class="py-5" style="background: var(--sh-black);">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                    <div>
                        <div class="sh-eyebrow">Agro Basins</div>
                        <h2 class="sh-title mb-0 text-white">Harvest Categories</h2>
                    </div>
                </div>
                <div class="row g-3 g-md-4">
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card">
                            <img src="{{ asset('img/service-1.jpg') }}" alt="Grains & Soybeans">
                            <div class="label">
                                <h5>Grains &amp; Soybeans</h5>
                                <span>Mato Grosso &amp; Paraná</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card">
                            <img src="{{ asset('img/service-2.jpg') }}" alt="Cane Sugar & Oils">
                            <div class="label">
                                <h5>Sugar &amp; Sweeteners</h5>
                                <span>São Paulo Mills</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card">
                            <img src="{{ asset('img/service-5.jpg') }}" alt="Specialty Coffee">
                            <div class="label">
                                <h5>Specialty Coffee</h5>
                                <span>Sul de Minas Gerais</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="#products" class="sh-cat-card">
                            <img src="{{ asset('img/service-7.jpg') }}" alt="Pulses & Seeds">
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

        <!-- 8. DIRECT TRADE DESK & RFQ INQUIRIES -->
        <section class="py-5" id="rfq-desk" style="background: var(--sh-surface); border-top: 1px solid var(--sh-border); border-bottom: 1px solid var(--sh-border);">
            <div class="container py-3">
                <div class="row g-5 align-items-start">
                    <div class="col-lg-5">
                        <div class="sh-eyebrow">Trade Desk</div>
                        <h2 class="sh-title mb-3">Institutional RFQ Inquiries</h2>
                        <p class="text-muted mb-4">Connect directly with our Brazilian commodity export team. Request indicative FOB/CIF quotes, technical SGS assay sheets, or spot allocations.</p>

                        <div class="p-4 rounded-3 mb-4" style="background: var(--sh-black); border: 1px solid var(--sh-border);">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="bi bi-geo-alt fs-4 text-success" style="color: var(--sh-primary) !important;"></i>
                                <div>
                                    <strong class="d-block text-white">Trading Headquarters</strong>
                                    <small class="text-white-50">Av. Paulista 1374, Bela Vista, São Paulo - SP, Brazil</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="bi bi-whatsapp fs-4 text-success"></i>
                                <div>
                                    <strong class="d-block text-white">Direct WhatsApp Desk</strong>
                                    <a href="https://wa.me/5511952987545" target="_blank" rel="noopener" class="text-success text-decoration-none fw-bold small">+55 (11) 95298-7545</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-envelope fs-4 text-success" style="color: var(--sh-primary) !important;"></i>
                                <div>
                                    <strong class="d-block text-white">Corporate Desk</strong>
                                    <small class="text-white-50">tradedesk@matro.com / inquiries@matro.com</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="p-4 p-md-5 rounded-4" style="background: var(--sh-black); border: 1px solid var(--sh-border);">
                            <h4 class="fw-bold text-white mb-2">Request Trade Quote (RFQ)</h4>
                            <p class="text-white-50 small mb-4">Complete the form below to receive formal indicative pricing, SGS specifications, and vessel allocation schedule.</p>

                            <div id="rfqAlert" class="alert d-none mb-3"></div>

                            <form id="rfqInquiryForm">
                                <input type="hidden" name="role" value="buyer">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Target Commodity *</label>
                                        <select name="buyer_detail" class="form-select" style="background: var(--sh-surface); color: #fff; border: 1px solid var(--sh-border);" required>
                                            <option value="Brazilian Non-GMO Soybeans">Brazilian Non-GMO Soybeans</option>
                                            <option value="Refined Cane Sugar (ICUMSA 45)">Refined Cane Sugar (ICUMSA 45)</option>
                                            <option value="Yellow Corn (Maize Grade 2)">Yellow Corn (Maize Grade 2)</option>
                                            <option value="Arabica Green Coffee Beans">Arabica Green Coffee Beans</option>
                                            <option value="Lentils & Pulses">Lentils &amp; Pulses</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Volume Required (Metric Tons) *</label>
                                        <input type="text" name="volume" class="form-control" placeholder="e.g. 500 MT / 2,500 MT" style="background: var(--sh-surface); color: #fff; border: 1px solid var(--sh-border);" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Full Name *</label>
                                        <input type="text" name="name" class="form-control" placeholder="First and last name" style="background: var(--sh-surface); color: #fff; border: 1px solid var(--sh-border);" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Corporate Email *</label>
                                        <input type="email" name="email" class="form-control" placeholder="importer@company.com" style="background: var(--sh-surface); color: #fff; border: 1px solid var(--sh-border);" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Company Name *</label>
                                        <input type="text" name="company" class="form-control" placeholder="Trading company name" style="background: var(--sh-surface); color: #fff; border: 1px solid var(--sh-border);" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Discharge Port / Country *</label>
                                        <input type="text" name="country" class="form-control" placeholder="e.g. Port of Rotterdam" style="background: var(--sh-surface); color: #fff; border: 1px solid var(--sh-border);" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Contract Message &amp; Instructions</label>
                                        <textarea name="message" class="form-control" rows="3" placeholder="Specify any moisture, protein or packaging requirements..." style="background: var(--sh-surface); color: #fff; border: 1px solid var(--sh-border);"></textarea>
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

        <!-- 9. TESTIMONIALS SECTION (Exact fume-main layout) -->
        <section class="py-5">
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
                            <p class="fst-italic text-white-50 mb-3">"Securing 12,500 MT of Brazilian Non-GMO Soybeans through Santos was handled with absolute professionalism. The pre-shipment SGS assay matched our exact feed parameters."</p>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/testimonial-1.jpg') }}" alt="" class="rounded-circle me-3 object-fit-cover" width="46" height="46">
                                <div>
                                    <h6 class="mb-0 text-white fw-bold">Pieter van der Berg</h6>
                                    <small class="text-white-50">Procurement · Rotterdam, Netherlands</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sh-testimonial">
                            <div class="sh-stars mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p class="fst-italic text-white-50 mb-3">"The ICUMSA 45 refined sugar arrived on time with complete phytosanitary certificates and zero broken bags. Matro's direct desk communicated vessel telemetry daily."</p>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/testimonial-2.jpg') }}" alt="" class="rounded-circle me-3 object-fit-cover" width="46" height="46">
                                <div>
                                    <h6 class="mb-0 text-white fw-bold">Tariq Al-Mansoor</h6>
                                    <small class="text-white-50">VP Supply Chain · Jebel Ali, Dubai</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sh-testimonial">
                            <div class="sh-stars mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p class="fst-italic text-white-50 mb-3">"Direct co-op pricing eliminated the broker markup we usually pay on yellow maize. Clean title handover at the discharge port made customs processing effortless."</p>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/testimonial-3.jpg') }}" alt="" class="rounded-circle me-3 object-fit-cover" width="46" height="46">
                                <div>
                                    <h6 class="mb-0 text-white fw-bold">Wei Chen</h6>
                                    <small class="text-white-50">Agro Commodity Trader · Qingdao, China</small>
                                </div>
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
                    <h6 class="fs-5 text-white mb-2">MATRO <span style="color: var(--sh-primary);">AGRO</span></h6>
                    <p class="small text-white-50 mb-3" style="line-height: 1.6;">
                        Direct institutional trade facilitation between certified Brazilian agricultural cooperatives and global commodity buyers.
                    </p>
                    <div class="d-flex align-items-center mt-3">
                        <a href="https://wa.me/5511952987545" target="_blank" rel="noopener" class="social-icon" title="WhatsApp Desk"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="social-icon" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        <a href="mailto:tradedesk@matro.com" class="social-icon" title="Email Desk"><i class="bi bi-envelope"></i></a>
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
                        <li class="mb-2"><a href="#products">About Matro</a></li>
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
                            <span>Av. Paulista 1374, São Paulo - SP, Brazil</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center gap-2">
                            <i class="bi bi-whatsapp me-1 text-success" style="flex-shrink: 0;"></i>
                            <a href="https://wa.me/5511952987545" target="_blank" rel="noopener" class="text-success text-decoration-none fw-bold">+55 (11) 95298-7545</a>
                        </li>
                        <li class="mb-2 d-flex align-items-center gap-2">
                            <i class="bi bi-envelope me-1 text-success" style="color: var(--sh-primary) !important; flex-shrink: 0;"></i>
                            <a href="mailto:tradedesk@matro.com" class="text-decoration-none text-white-50">tradedesk@matro.com</a>
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
                    &copy; {{ date('Y') }} Matro Brazilian Agro-Commodity Platform. All rights reserved.
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

    <!-- Modals -->

    <!-- Quick View Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: var(--sh-surface); color: var(--bs-body-color);">
                <div class="modal-header border-bottom border-secondary border-opacity-25 py-3">
                    <h5 class="modal-title fw-bold" id="qvModalTitle">Commodity Quick View</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="rounded-3 overflow-hidden mb-3" style="height: 200px;">
                        <img id="qvModalImg" src="" alt="" class="w-100 h-100 object-fit-cover">
                    </div>
                    <h4 class="fw-bold mb-1" id="qvModalName"></h4>
                    <p class="fs-5 fw-bold mb-3" style="color: var(--sh-primary);" id="qvModalPrice"></p>
                    <div class="p-3 rounded-3 mb-3 small" style="background: var(--sh-black); border: 1px solid var(--sh-border);">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-white-50">SGS Assay:</span>
                            <span class="text-white fw-bold">100% Pre-Shipment Tested</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-white-50">Settlement:</span>
                            <span class="text-success fw-bold">Bank Escrow Protected</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-white-50">Loading Port:</span>
                            <span class="text-white fw-bold">Santos / Paranaguá (BR)</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" id="qvAddToCartBtn" class="btn btn-sh-primary flex-fill">
                            <i class="bi bi-bag me-1"></i> Add to Sample Cart
                        </button>
                        <button type="button" class="btn btn-sh-outline-white" data-bs-dismiss="modal">
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
                    <h5 class="modal-title fw-bold"><i class="bi bi-search me-2" style="color: var(--sh-primary);"></i>Search Commodities</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="text" id="modalSearchInput" class="form-control form-control-lg rounded-pill mb-3" placeholder="Type commodity name, grade, or basin..." style="background: var(--sh-black); border: 1px solid var(--sh-border); color: #fff;">
                    <div class="small text-muted">Press <kbd class="bg-dark text-light border border-secondary px-2 py-1">Esc</kbd> to exit.</div>
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
                document.querySelectorAll('.sh-theme-toggle i').forEach(function (icon) {
                    icon.className = isLight ? 'bi bi-sun' : 'bi bi-moon-stars';
                });
            }
            updateThemeIcons();

            document.querySelectorAll('.sh-theme-toggle').forEach(function (btn) {
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
            try { cart = JSON.parse(localStorage.getItem('agroviaCart') || '[]'); } catch (e) { cart = []; }

            function updateCartCount() {
                var total = cart.reduce(function (sum, item) { return sum + item.qty; }, 0);
                $('#cartCountBadge, .mobileCartBadge').text(total);
                return total;
            }
            updateCartCount();

            function triggerToast(message, total) {
                var toast = document.getElementById('sh-toast');
                if (!toast) return;
                document.getElementById('shToastMsg').textContent = message;
                document.getElementById('shToastCount').textContent = total + ' item(s) in cart';
                toast.classList.remove('sh-toast-hide');
                toast.classList.add('sh-toast-show');
                setTimeout(function () {
                    toast.classList.remove('sh-toast-show');
                    toast.classList.add('sh-toast-hide');
                }, 3000);
            }

            // Add to Cart Buttons
            var currentQvProduct = '';
            $(document).on('click', '.btn-add-cart', function () {
                var prodName = $(this).attr('data-name') || 'Agricultural Commodity';
                var existing = cart.find(function (i) { return i.name === prodName; });
                if (existing) { existing.qty += 1; } else { cart.push({ name: prodName, qty: 1 }); }
                try { localStorage.setItem('agroviaCart', JSON.stringify(cart)); } catch (e) {}
                var total = updateCartCount();
                triggerToast(prodName + ' added to cart!', total);
            });

            // Quick View Trigger
            $(document).on('click', '.quick-view-trigger', function () {
                currentQvProduct = $(this).attr('data-product');
                var price = $(this).attr('data-price');
                var img = $(this).attr('data-image');

                $('#qvModalTitle').text(currentQvProduct);
                $('#qvModalName').text(currentQvProduct);
                $('#qvModalPrice').text(price);
                $('#qvModalImg').attr('src', img);

                var modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
                modal.show();
            });

            $('#qvAddToCartBtn').on('click', function () {
                if (!currentQvProduct) return;
                var existing = cart.find(function (i) { return i.name === currentQvProduct; });
                if (existing) { existing.qty += 1; } else { cart.push({ name: currentQvProduct, qty: 1 }); }
                try { localStorage.setItem('agroviaCart', JSON.stringify(cart)); } catch (e) {}
                var total = updateCartCount();
                triggerToast(currentQvProduct + ' added to cart!', total);
                bootstrap.Modal.getInstance(document.getElementById('quickViewModal')).hide();
            });

            $('#cartTriggerBtn, .mobile-cart-trigger').on('click', function () {
                var total = updateCartCount();
                triggerToast('You have ' + total + ' item(s) in your cart.', total);
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
