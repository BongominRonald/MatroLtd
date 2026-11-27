<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin Dashboard') — BRX AGRO GLOBAL</title>

    <!-- Badge Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('img/icon-512x512.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Local Bootstrap 5 CSS & Icons -->
    <link href="{{ asset('lib/bootstrap/bootstrap-5.3.3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">

    <!-- Local Fonts -->
    <link href="{{ asset('fonts/comic-relief.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/open-sans.css') }}" rel="stylesheet">

    <script>
        (function() {
            var savedTheme = localStorage.getItem('sh_theme') || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', savedTheme);
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
        })();
    </script>

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
        :root {
            --matro-green: #78a22f;
            --matro-green-dark: #5c7f21;
            --matro-sidebar: 260px;
            --matro-sidebar-mini: 76px;
            --matro-dark: #121820;
            --matro-darker: #0d1217;
        }

        body {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f4f6f9;
            color: #212529;
            overflow-x: clip;
            width: 100%;
            max-width: 100vw;
        }

        h1, h2, h3, h4, h5, h6, .brand-text, .btn {
            font-family: "Comic Relief", system-ui, sans-serif;
        }

        .admin-shell {
            min-height: 100vh;
            display: flex;
            width: 100%;
            max-width: 100vw;
            overflow-x: clip;
            position: relative;
        }

        /* Sidebar Styling (Borrowed from shoe-haven concept) */
        .matro-sidebar {
            width: var(--matro-sidebar);
            flex: 0 0 var(--matro-sidebar);
            background: var(--matro-dark);
            height: 100vh;
            position: sticky;
            top: 0;
            z-index: 1040;
            overflow: hidden;
            transition: width .25s ease, transform .25s ease;
            border-right: 1px solid rgba(255, 255, 255, 0.07);
        }

        .matro-sidebar-inner {
            height: 100%;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .matro-brand {
            min-height: 74px;
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            gap: .85rem;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            text-decoration: none;
        }

        .matro-brand-mark {
            width: 42px;
            height: 42px;
            flex: 0 0 auto;
            border-radius: 10px;
            background: var(--matro-green);
            color: #fff;
            display: grid;
            place-items: center;
            font-weight: 800;
            font-size: 1.15rem;
            box-shadow: 0 4px 12px rgba(120, 162, 47, 0.35);
        }

        .matro-brand-title {
            font-size: 1.2rem;
            font-weight: 800;
            line-height: 1.2;
            color: #fff;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .matro-brand-sub {
            font-size: .78rem;
            color: rgba(255, 255, 255, .5);
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        .matro-nav {
            flex: 1 1 auto;
            min-height: 0;
            overflow: hidden !important;
            padding: .4rem .85rem .5rem;
            display: flex;
            flex-direction: column !important;
            flex-wrap: nowrap !important;
        }

        .matro-nav-group {
            margin-top: .55rem;
            flex: 0 0 auto;
            width: 100%;
            display: flex;
            flex-direction: column !important;
            flex-wrap: nowrap !important;
        }

        .matro-nav-group:first-child { margin-top: .15rem; }

        .matro-nav-label {
            color: rgba(255, 255, 255, .38);
            font-size: .65rem;
            text-transform: uppercase;
            letter-spacing: .12em;
            font-weight: 700;
            padding: 0 .6rem .3rem;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .matro-nav-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, .08);
        }

        .matro-sidebar .nav-link {
            width: 100%;
            flex: 0 0 auto;
            height: 36px;
            min-height: 36px;
            padding: .35rem .85rem;
            margin: 1px 0;
            border-radius: 8px;
            color: rgba(255, 255, 255, .72);
            font-weight: 600;
            font-size: .86rem;
            display: flex;
            align-items: center;
            gap: .85rem;
            min-width: 0;
            max-width: 100%;
            white-space: nowrap;
            text-decoration: none;
            transition: all .18s ease;
        }

        .matro-sidebar .nav-link span {
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .matro-sidebar .nav-link i {
            width: 22px;
            min-width: 22px;
            text-align: center;
            font-size: 1.05rem;
            color: rgba(255, 255, 255, .6);
            transition: color .18s ease;
        }

        .matro-sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, .07);
        }

        .matro-sidebar .nav-link:hover i {
            color: var(--matro-green);
        }

        .matro-sidebar .nav-link.active {
            color: #fff;
            background: linear-gradient(90deg, rgba(120, 162, 47, 0.28), rgba(120, 162, 47, 0.1));
            box-shadow: inset 3px 0 0 var(--matro-green);
        }

        .matro-sidebar .nav-link.active i {
            color: var(--matro-green);
        }

        .matro-sidebar-footer {
            flex: 0 0 auto;
            margin-top: auto;
            padding: .5rem .85rem;
            border-top: 1px solid rgba(255, 255, 255, .08);
            background: var(--matro-darker);
            display: flex;
            flex-direction: column !important;
            flex-wrap: nowrap !important;
        }

        /* Topbar & Content */
        .admin-main {
            min-width: 0 !important;
            max-width: 100% !important;
            width: 100%;
            flex: 1 1 0% !important;
            display: flex;
            flex-direction: column;
            overflow-x: hidden !important;
            box-sizing: border-box !important;
        }

        .admin-topbar {
            height: 74px;
            position: sticky;
            top: 0;
            z-index: 1030;
            width: 100% !important;
            max-width: 100% !important;
            min-width: 0 !important;
            background: #fff;
            border-bottom: 1px solid #e5e8ec;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            box-sizing: border-box !important;
            transition: background-color .2s ease, border-color .2s ease;
        }

        .admin-content {
            padding: 1.25rem 1.5rem !important;
            max-width: 100% !important;
            width: 100% !important;
            min-width: 0 !important;
            margin: 0 !important;
            flex: 1 1 auto;
            overflow-x: hidden !important;
            box-sizing: border-box !important;
        }

        /* Universal Grid, Card & Table Overflow Defenses */
        .min-w-0 {
            min-width: 0 !important;
        }

        .admin-content .row {
            margin-left: -0.75rem;
            margin-right: -0.75rem;
            max-width: calc(100% + 1.5rem);
        }

        .admin-content .row > * {
            min-width: 0 !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
        }

        .admin-card,
        .sh-stat-card,
        .card {
            min-width: 0 !important;
            max-width: 100% !important;
            overflow: hidden !important;
            box-sizing: border-box !important;
        }

        .table-responsive {
            display: block !important;
            width: 100% !important;
            max-width: 100% !important;
            min-width: 0 !important;
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch;
            box-sizing: border-box !important;
        }

        .table-responsive > .table {
            margin-bottom: 0 !important;
            white-space: nowrap !important;
        }

        .admin-content pre,
        .admin-content code {
            word-break: break-all !important;
        }

        .admin-page-heading h1 {
            font-size: 1.3rem;
            font-weight: 750;
            margin: 0;
            color: #1a202c;
        }

        .sh-breadcrumbs ol {
            display: flex;
            align-items: center;
            gap: .35rem;
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: .75rem;
            color: #8a909c;
        }

        .sh-breadcrumbs a {
            color: #6b7280;
            text-decoration: none;
        }

        .sh-breadcrumbs a:hover {
            color: var(--matro-green);
        }

        .sh-breadcrumbs-sep {
            color: #c4c8d0;
        }

        .admin-user {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            padding: .35rem .75rem;
            cursor: pointer;
            transition: all .2s;
        }

        .admin-user:hover {
            background: #f1f5f9;
        }

        .admin-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: var(--matro-green);
            color: #fff;
            font-weight: 700;
            font-size: .9rem;
        }

        .sh-collapse-btn {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border: 1px solid #e2e8f0;
            background: #fff;
            border-radius: 8px;
            color: #4b5563;
            cursor: pointer;
            transition: all .15s;
        }

        .sh-collapse-btn:hover {
            background: #f8fafc;
            color: #111827;
        }

        /* Stat Cards */
        .sh-stat-card {
            border: 0;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .sh-stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08) !important;
        }

        .sh-stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 1.25rem;
        }

        .admin-card {
            border: 0;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }

        .admin-card .card-header {
            background: #fff;
            border-bottom: 1px solid #edf2f7;
            padding: 1rem 1.25rem;
        }

        .admin-table {
            --bs-table-color: #1e293b;
            --bs-table-bg: transparent;
            --bs-table-hover-bg: #f8fafc;
            --bs-table-hover-color: #0f172a;
        }

        .admin-table th {
            color: #475569 !important;
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            font-weight: 700;
            background: #f8fafc !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: .75rem 1rem;
        }

        .admin-table td {
            color: #1e293b !important;
            padding: .85rem 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .admin-table td a:not(.btn) {
            color: #0f172a !important;
            text-decoration: none;
            transition: color .15s ease;
        }

        .admin-table td a:not(.btn):hover {
            color: var(--matro-green-dark) !important;
            text-decoration: underline !important;
        }

        .admin-table td .text-dark,
        .admin-table td a.text-dark {
            color: #0f172a !important;
        }

        .admin-table td .text-muted,
        .admin-table td small.text-muted {
            color: #64748b !important;
        }

        .admin-thumb {
            width: 46px;
            height: 46px;
            object-fit: cover;
            border-radius: 8px;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
        }

        .btn-matro {
            background: var(--matro-green);
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: .45rem 1rem;
            border: none;
            transition: all .2s;
        }

        .btn-matro:hover {
            background: var(--matro-green-dark);
            color: #fff;
        }

        /* Sidebar layout & Responsive main bounds (Strict 0px Overflow) */
        @media (min-width: 992px) {
            .matro-sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                height: 100vh;
            }
            .admin-main {
                margin-left: var(--matro-sidebar);
                width: calc(100% - var(--matro-sidebar)) !important;
                max-width: calc(100% - var(--matro-sidebar)) !important;
                flex: 0 0 calc(100% - var(--matro-sidebar)) !important;
                transition: margin-left .25s ease, width .25s ease, max-width .25s ease;
            }
            body.sidebar-collapsed .matro-sidebar {
                width: var(--matro-sidebar-mini);
                flex-basis: var(--matro-sidebar-mini);
            }
            body.sidebar-collapsed .admin-main {
                margin-left: var(--matro-sidebar-mini);
                width: calc(100% - var(--matro-sidebar-mini)) !important;
                max-width: calc(100% - var(--matro-sidebar-mini)) !important;
                flex: 0 0 calc(100% - var(--matro-sidebar-mini)) !important;
            }
            body.sidebar-collapsed .matro-brand {
                justify-content: center;
                padding-left: .5rem;
                padding-right: .5rem;
            }
            body.sidebar-collapsed .matro-brand-title,
            body.sidebar-collapsed .matro-brand-sub,
            body.sidebar-collapsed .matro-nav-label,
            body.sidebar-collapsed .matro-nav .nav-link span,
            body.sidebar-collapsed .matro-sidebar-footer .nav-link span {
                display: none;
            }
            body.sidebar-collapsed .matro-nav {
                padding: .5rem .45rem;
            }
            body.sidebar-collapsed .matro-nav-group {
                margin-top: .5rem;
            }
            body.sidebar-collapsed .matro-nav .nav-link {
                justify-content: center;
                padding-left: .35rem;
                padding-right: .35rem;
            }
            body.sidebar-collapsed .matro-sidebar-footer .nav-link {
                justify-content: center;
            }
        }

        /* Mobile drawer */
        @media (max-width: 991.98px) {
            .admin-main {
                width: 100% !important;
                max-width: 100% !important;
                flex: 0 0 100% !important;
            }
            .matro-sidebar {
                position: fixed;
                left: 0;
                top: 0;
                transform: translateX(-100%);
                box-shadow: 10px 0 30px rgba(0,0,0,.3);
            }
            .matro-sidebar.open {
                transform: translateX(0);
            }
            .sh-sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 1039;
                background: rgba(0,0,0,.45);
            }
            .admin-content {
                padding: 1rem;
            }
        }

        /* ===== Dark Theme Adaptations for Admin Dashboard ===== */
        html[data-theme="dark"] body {
            background: #0b0f17;
            color: #e2e8f0;
        }
        html[data-theme="dark"] .admin-topbar {
            background: rgba(17, 24, 39, 0.95);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        }
        html[data-theme="dark"] .admin-page-heading h1 {
            color: #ffffff;
        }
        html[data-theme="dark"] .sh-breadcrumbs a {
            color: #94a3b8;
        }
        html[data-theme="dark"] .sh-breadcrumbs-sep {
            color: #475569;
        }
        html[data-theme="dark"] .sh-collapse-btn {
            background: #1e293b;
            border-color: rgba(255, 255, 255, 0.14);
            color: #f1f5f9;
        }
        html[data-theme="dark"] .sh-collapse-btn:hover {
            background: #334155;
            color: #ffffff;
        }
        html[data-theme="dark"] .admin-card,
        html[data-theme="dark"] .sh-stat-card {
            background: #111827;
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #f8fafc;
            box-shadow: 0 4px 16px rgba(0,0,0,0.3);
        }
        html[data-theme="dark"] .admin-card .card-header {
            background: #111827;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            color: #ffffff;
        }
        html[data-theme="dark"] .admin-card .card-header h5 {
            color: #ffffff;
        }
        html[data-theme="dark"] .admin-table {
            --bs-table-color: #f1f5f9 !important;
            --bs-table-bg: #111827 !important;
            --bs-table-hover-bg: #1e293b !important;
            --bs-table-hover-color: #ffffff !important;
        }
        html[data-theme="dark"] .admin-table th {
            background: #0f172a !important;
            color: #94a3b8 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        html[data-theme="dark"] .admin-table td {
            color: #f1f5f9 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important;
            background-color: transparent !important;
        }
        html[data-theme="dark"] .admin-table tr:hover td {
            background-color: #1e293b !important;
            color: #ffffff !important;
        }
        html[data-theme="dark"] .admin-table td .text-dark,
        html[data-theme="dark"] .admin-table td a.text-dark,
        html[data-theme="dark"] .admin-table td div.text-dark,
        html[data-theme="dark"] .admin-table td span.text-dark {
            color: #f8fafc !important;
        }
        html[data-theme="dark"] .admin-table td a:not(.btn) {
            color: #38bdf8 !important;
        }
        html[data-theme="dark"] .admin-table td a:not(.btn):hover {
            color: #7dd3fc !important;
            text-decoration: underline !important;
        }
        html[data-theme="dark"] .admin-table td .text-muted,
        html[data-theme="dark"] .admin-table td small.text-muted {
            color: #94a3b8 !important;
        }
        html[data-theme="dark"] .admin-table .badge.bg-light {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
        }
        html[data-theme="dark"] .admin-table .badge.bg-light.text-dark {
            color: #f8fafc !important;
        }
        html[data-theme="dark"] .admin-table .badge.bg-light.text-secondary {
            color: #cbd5e1 !important;
        }
        html[data-theme="dark"] .admin-user {
            background: #1e293b;
            border-color: rgba(255, 255, 255, 0.12);
            color: #f8fafc;
        }
        html[data-theme="dark"] .admin-user:hover {
            background: #334155;
        }
        html[data-theme="dark"] .admin-user strong {
            color: #ffffff !important;
        }
        html[data-theme="dark"] .admin-thumb {
            background: #1e293b;
            border-color: rgba(255, 255, 255, 0.1);
        }
        html[data-theme="dark"] .list-group-item {
            background: #111827;
            border-color: rgba(255, 255, 255, 0.08);
            color: #f8fafc;
        }
        html[data-theme="dark"] .list-group-item strong,
        html[data-theme="dark"] .list-group-item .fw-semibold {
            color: #ffffff !important;
        }
        html[data-theme="dark"] .dropdown-menu {
            background: #0f172a;
            border-color: rgba(255, 255, 255, 0.12);
            color: #e2e8f0;
        }
        html[data-theme="dark"] .dropdown-item {
            color: #e2e8f0;
        }
        html[data-theme="dark"] .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
        }
        html[data-theme="dark"] .btn-outline-dark {
            color: #f8fafc !important;
            border-color: rgba(255, 255, 255, 0.25) !important;
            background-color: #1e293b !important;
        }
        html[data-theme="dark"] .btn-outline-dark:hover {
            background-color: #334155 !important;
            color: #ffffff !important;
        }
        html[data-theme="dark"] .btn-outline-secondary {
            color: #e2e8f0 !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
            background-color: rgba(255, 255, 255, 0.05) !important;
        }
        html[data-theme="dark"] .btn-outline-secondary:hover {
            background-color: #475569 !important;
            color: #ffffff !important;
        }
        html[data-theme="dark"] .btn-light {
            background-color: #1e293b !important;
            border-color: rgba(255, 255, 255, 0.14) !important;
            color: #f8fafc !important;
        }
        html[data-theme="dark"] .btn-light:hover {
            background-color: #334155 !important;
            color: #ffffff !important;
        }
        html[data-theme="dark"] .bg-light {
            background-color: #1e293b !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
        }
        html[data-theme="dark"] .text-dark {
            color: #f8fafc !important;
        }
        html[data-theme="dark"] .text-muted {
            color: #94a3b8 !important;
        }

        /* ===== Admin Pagination Styling ===== */
        .admin-card .card-footer {
            background: #f8fafc;
            border-top: 1px solid #edf2f7;
            padding: 0.85rem 1.25rem;
        }

        .pagination {
            margin: 0 !important;
            display: flex !important;
            flex-wrap: wrap !important;
            align-items: center !important;
            gap: 4px !important;
        }

        .pagination .page-item .page-link {
            border-radius: 8px !important;
            padding: 0.35rem 0.75rem !important;
            font-size: 0.85rem !important;
            font-weight: 600 !important;
            color: #334155 !important;
            background-color: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            transition: all 0.15s ease;
            box-shadow: 0 1px 2px rgba(0,0,0,0.03);
            text-decoration: none;
        }

        .pagination .page-item:not(.active):not(.disabled) .page-link:hover {
            background-color: #f1f5f9 !important;
            border-color: #94a3b8 !important;
            color: var(--matro-green) !important;
            transform: translateY(-1px);
        }

        .pagination .page-item.active .page-link {
            background: var(--matro-green) !important;
            border-color: var(--matro-green) !important;
            color: #ffffff !important;
            box-shadow: 0 2px 8px rgba(120, 162, 47, 0.35) !important;
        }

        .pagination .page-item.disabled .page-link {
            color: #94a3b8 !important;
            background-color: #f8fafc !important;
            border-color: #e2e8f0 !important;
            opacity: 0.6;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Dark Theme Pagination & Form Controls */
        html[data-theme="dark"] .admin-card .card-footer {
            background: #0f172a !important;
            border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #94a3b8 !important;
        }
        html[data-theme="dark"] .pagination .page-item .page-link {
            background-color: #1e293b !important;
            border-color: rgba(255, 255, 255, 0.14) !important;
            color: #cbd5e1 !important;
        }
        html[data-theme="dark"] .pagination .page-item:not(.active):not(.disabled) .page-link:hover {
            background-color: #334155 !important;
            border-color: rgba(255, 255, 255, 0.25) !important;
            color: #ffffff !important;
        }
        html[data-theme="dark"] .pagination .page-item.active .page-link {
            background: var(--matro-green) !important;
            border-color: var(--matro-green) !important;
            color: #ffffff !important;
            box-shadow: 0 0 12px rgba(120, 162, 47, 0.4) !important;
        }
        html[data-theme="dark"] .pagination .page-item.disabled .page-link {
            background-color: #0f172a !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            color: #64748b !important;
        }
        html[data-theme="dark"] .form-control,
        html[data-theme="dark"] .form-select {
            background-color: #1e293b !important;
            border-color: rgba(255, 255, 255, 0.14) !important;
            color: #f8fafc !important;
        }
        html[data-theme="dark"] .form-control:focus,
        html[data-theme="dark"] .form-select:focus {
            background-color: #1e293b !important;
            border-color: var(--matro-green) !important;
            color: #ffffff !important;
            box-shadow: 0 0 0 0.25rem rgba(120, 162, 47, 0.25) !important;
        }
        html[data-theme="dark"] .form-control::placeholder {
            color: #64748b !important;
        }
        html[data-theme="dark"] .input-group-text {
            background-color: #0f172a !important;
            border-color: rgba(255, 255, 255, 0.14) !important;
            color: #94a3b8 !important;
        }
        html[data-theme="dark"] .modal-content {
            background-color: #111827 !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #f8fafc !important;
        }
        html[data-theme="dark"] .modal-header,
        html[data-theme="dark"] .modal-footer {
            border-color: rgba(255, 255, 255, 0.1) !important;
        }
        html[data-theme="dark"] .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        html[data-theme="dark"] .bg-primary-subtle {
            background-color: rgba(37, 99, 235, 0.2) !important;
            color: #93c5fd !important;
        }
        html[data-theme="dark"] .bg-success-subtle {
            background-color: rgba(22, 163, 74, 0.2) !important;
            color: #86efac !important;
        }
        html[data-theme="dark"] .bg-warning-subtle {
            background-color: rgba(217, 119, 6, 0.2) !important;
            color: #fde68a !important;
        }
        html[data-theme="dark"] .bg-danger-subtle {
            background-color: rgba(220, 38, 38, 0.2) !important;
            color: #fca5a5 !important;
        }
        html[data-theme="dark"] .table-warning-subtle td {
            background-color: rgba(217, 119, 6, 0.15) !important;
        }
        html[data-theme="dark"] .alert-warning {
            background-color: #3b2a0c !important;
            color: #fde68a !important;
            border: 1px solid rgba(245, 158, 11, 0.3) !important;
        }
        html[data-theme="dark"] .alert-success {
            background-color: #0c331e !important;
            color: #86efac !important;
            border: 1px solid rgba(34, 197, 94, 0.3) !important;
        }
        html[data-theme="dark"] .alert-danger {
            background-color: #3b0c0c !important;
            color: #fca5a5 !important;
            border: 1px solid rgba(239, 68, 68, 0.3) !important;
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="admin-shell">
    <!-- Sidebar -->
    <div class="matro-sidebar" id="adminSidebar">
        <div class="matro-sidebar-inner">
            <a href="{{ route('admin.dashboard') }}" class="matro-brand" aria-label="BRX AGRO GLOBAL Administration">
                <img src="{{ asset('img/BRX Agro Global Product Emblem.png') }}" alt="BRX AGRO GLOBAL" class="rounded-circle" style="width: 36px; height: 36px; object-fit: cover; border: 2px solid var(--matro-green); flex-shrink: 0;">
                <div>
                    <div class="matro-brand-title" style="font-size: 0.95rem; line-height: 1.1;">BRX <span style="color: var(--matro-green);">AGRO</span></div>
                    <div class="matro-brand-sub" style="font-size: 0.52rem; letter-spacing: 0.8px;">GLOBAL LTDA</div>
                </div>
            </a>

            <nav class="matro-nav flex-column" aria-label="Admin navigation">
                @foreach (config('admin-nav', []) as $group)
                    <div class="matro-nav-group">
                        <div class="matro-nav-label">{{ $group['label'] }}</div>
                        @foreach ($group['items'] as $item)
                            @php
                                $isActive = request()->routeIs($item['pattern']);
                            @endphp
                            <a class="nav-link {{ $isActive ? 'active' : '' }}"
                               href="{{ route($item['route']) }}"
                               title="{{ $item['label'] }}">
                                <i class="bi {{ $item['icon'] }}"></i>
                                <span>{{ $item['label'] }}</span>
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </nav>

            <div class="matro-sidebar-footer">
                <a class="nav-link" href="/" title="View Front Store">
                    <i class="bi bi-shop"></i>
                    <span>View Store</span>
                </a>
                <button type="button" class="nav-link w-100 border-0 bg-transparent text-start text-danger" title="Sign Out" data-bs-toggle="modal" data-bs-target="#adminLogoutModal">
                    <i class="bi bi-box-arrow-right text-danger"></i>
                    <span>Sign Out</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div class="sh-sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content Area -->
    <main class="admin-main">
        <!-- Topbar -->
        <header class="admin-topbar d-flex align-items-center justify-content-between px-3 px-lg-4">
            <div class="d-flex align-items-center gap-2 gap-sm-3 min-w-0 flex-shrink-1">
                <button class="sh-collapse-btn flex-shrink-0" id="sidebarToggle" type="button" aria-label="Toggle sidebar">
                    <i class="bi bi-layout-sidebar-inset"></i>
                </button>
                @php
                    $adminRoute = request()->route()?->getName() ?? '';
                    $breadcrumbMap = [
                        'admin.dashboard' => [],
                        'admin.products.index' => [['label' => 'Catalog'], ['label' => 'Products']],
                        'admin.products.create' => [['label' => 'Catalog'], ['label' => 'Products', 'url' => route('admin.products.index')], ['label' => 'Add Product']],
                        'admin.products.edit' => [['label' => 'Catalog'], ['label' => 'Products', 'url' => route('admin.products.index')], ['label' => 'Edit Product']],
                        'admin.categories.index' => [['label' => 'Catalog'], ['label' => 'Categories']],
                        'admin.hero-slides.index' => [['label' => 'Storefront'], ['label' => 'Hero Slides']],
                        'admin.hero-slides.create' => [['label' => 'Storefront'], ['label' => 'Hero Slides', 'url' => route('admin.hero-slides.index')], ['label' => 'Add Slide']],
                        'admin.hero-slides.edit' => [['label' => 'Storefront'], ['label' => 'Hero Slides', 'url' => route('admin.hero-slides.index')], ['label' => 'Edit Slide']],
                        'admin.orders.index' => [['label' => 'Sales'], ['label' => 'Orders']],
                        'admin.orders.show' => [['label' => 'Sales'], ['label' => 'Orders', 'url' => route('admin.orders.index')], ['label' => 'Order Details']],
                        'admin.users.index' => [['label' => 'Customers'], ['label' => 'Directory']],
                        'admin.users.show' => [['label' => 'Customers'], ['label' => 'Directory', 'url' => route('admin.users.index')], ['label' => 'Customer Details']],
                        'admin.inquiries.index' => [['label' => 'Trade Desk'], ['label' => 'Inquiries']],
                        'admin.inquiries.show' => [['label' => 'Trade Desk'], ['label' => 'Inquiries', 'url' => route('admin.inquiries.index')], ['label' => 'Inquiry Details']],
                    ];
                    $breadcrumbs = $breadcrumbMap[$adminRoute] ?? [];
                @endphp
                <div class="admin-page-heading min-w-0">
                    <div class="sh-breadcrumbs text-truncate">
                        <ol class="text-truncate">
                            <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                            @foreach ($breadcrumbs as $crumb)
                                <li class="sh-breadcrumbs-sep">/</li>
                                <li>
                                    @if(isset($crumb['url']))
                                        <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                                    @else
                                        <span>{{ $crumb['label'] }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                    <h1 class="text-truncate mb-0">@yield('page-title', 'Dashboard')</h1>
                </div>
            </div>

            <!-- Topbar Notification Badges & User Menu -->
            <div class="d-flex align-items-center gap-2 gap-md-3 flex-shrink-0 ms-2">
                @php
                    $pendingOrdersCount = \App\Models\Order::where('status', 'pending')->count();
                    $unreadInquiriesCount = \App\Models\Inquiry::where('is_read', false)->count();
                @endphp
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-sm btn-light border d-flex align-items-center justify-content-center px-2 py-1" id="adminThemeToggle" title="Toggle Light / Dark Mode" aria-label="Toggle Theme">
                        <i class="bi bi-moon-stars-fill" id="adminThemeIcon"></i>
                    </button>
                    <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="btn btn-sm btn-light border position-relative d-flex align-items-center gap-1 px-2 py-1" title="Pending Commodity Orders">
                        <i class="bi bi-bell-fill text-warning"></i>
                        <span class="d-none d-sm-inline small fw-semibold">Orders</span>
                        @if($pendingOrdersCount > 0)
                            <span class="badge bg-danger rounded-pill">{{ $pendingOrdersCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-sm btn-light border position-relative d-flex align-items-center gap-1 px-2 py-1" title="Unread Inquiries & Trade Desk Messages">
                        <i class="bi bi-chat-dots-fill text-primary"></i>
                        <span class="d-none d-sm-inline small fw-semibold">Desk</span>
                        @if($unreadInquiriesCount > 0)
                            <span class="badge bg-primary rounded-pill">{{ $unreadInquiriesCount }}</span>
                        @endif
                    </a>
                </div>

                <!-- User Menu -->
                <div class="dropdown">
                    <button class="admin-user d-flex align-items-center gap-2" data-bs-toggle="dropdown" type="button">
                        <div class="admin-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                        <span class="d-none d-md-block text-start">
                            <strong class="d-block small text-dark">{{ auth()->user()->name ?? 'Admin' }}</strong>
                            <small class="text-muted" style="font-size: 11px;">Administrator</small>
                        </span>
                        <i class="bi bi-chevron-down small text-muted"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 py-2">
                        <li><span class="dropdown-item-text small text-muted">{{ auth()->user()->email ?? '' }}</span></li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li><a class="dropdown-item py-2" href="{{ route('admin.profile') }}"><i class="bi bi-person-gear me-2 text-success"></i>Profile &amp; Password</a></li>
                        <li><a class="dropdown-item py-2" href="/"><i class="bi bi-shop me-2 text-primary"></i>View Front Store</a></li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <div class="px-2">
                                <button type="button" class="btn btn-sm btn-outline-danger w-100 rounded-pill" data-bs-toggle="modal" data-bs-target="#adminLogoutModal">
                                    <i class="bi bi-box-arrow-right me-1"></i>Sign out
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Main Workspace -->
        <div class="admin-content">
            @if (session('status') || session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div>{{ session('status') ?: session('success') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <strong>Please check the form errors below:</strong>
                    <ul class="mb-0 mt-1 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</div>

<!-- Admin Logout Confirmation Modal -->
<div class="modal fade" id="adminLogoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-bottom py-2.5 px-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-right text-danger fs-5"></i>
                    <h6 class="modal-title fw-bold text-danger mb-0">Sign Out Confirmation</h6>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 text-center">
                <p class="small text-muted mb-3">
                    Are you sure you want to sign out of the trade desk administrative console?
                </p>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary flex-grow-1 rounded-pill" data-bs-dismiss="modal">Stay Here</button>
                    <form action="/logout" method="POST" class="m-0 flex-grow-1">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger w-100 rounded-pill fw-bold">
                            <i class="bi bi-box-arrow-right me-1"></i> Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Admin Universal Confirmation Modal -->
<div class="modal fade" id="adminConfirmModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-bottom py-2.5 px-3">
                <div class="d-flex align-items-center gap-2">
                    <i id="adminConfirmIcon" class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
                    <h6 class="modal-title fw-bold mb-0" id="adminConfirmTitle">Confirm Action</h6>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <p class="small text-muted mb-0" id="adminConfirmMessage">
                    Are you sure you want to proceed with this action?
                </p>
            </div>
            <div class="modal-footer border-top py-2 px-3 d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-danger rounded-pill px-3 fw-bold" id="adminConfirmBtn">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Local Bootstrap 5 JS -->
<script src="{{ asset('lib/bootstrap/bootstrap-5.3.3.bundle.min.js') }}"></script>

<!-- Sidebar Toggle Script (Shoe-Haven Pattern) -->
<script>
(function() {
    var sidebar = document.getElementById('adminSidebar');
    var toggleBtn = document.getElementById('sidebarToggle');
    var overlay = document.getElementById('sidebarOverlay');

    function isMobile() {
        return window.innerWidth < 992;
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            if (isMobile()) {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('show');
            } else {
                document.body.classList.toggle('sidebar-collapsed');
                try {
                    localStorage.setItem('matro_sidebar_collapsed', document.body.classList.contains('sidebar-collapsed'));
                } catch(e) {}
            }
        });
    }

    if (overlay) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        });
    }

    // Restore desktop preference
    try {
        if (!isMobile() && localStorage.getItem('matro_sidebar_collapsed') === 'true') {
            document.body.classList.add('sidebar-collapsed');
        }
    } catch(e) {}

    // Admin Theme Switcher
    var themeToggleBtn = document.getElementById('adminThemeToggle');
    var themeIcon = document.getElementById('adminThemeIcon');
    function updateThemeIcon(theme) {
        if (!themeIcon) return;
        if (theme === 'dark') {
            themeIcon.className = 'bi bi-sun-fill text-warning';
        } else {
            themeIcon.className = 'bi bi-moon-stars-fill text-dark';
        }
    }
    var currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
    updateThemeIcon(currentTheme);

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function() {
            var active = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', active);
            document.documentElement.setAttribute('data-bs-theme', active);
            try { localStorage.setItem('sh_theme', active); } catch(e) {}
            updateThemeIcon(active);
        });
    }
})();

    // Admin Universal Confirm Helper
    window.confirmAdminAction = function(form, title, message, confirmBtnText, isDanger) {
        var modalEl = document.getElementById('adminConfirmModal');
        if (!modalEl || !window.bootstrap) {
            form.submit();
            return;
        }
        document.getElementById('adminConfirmTitle').textContent = title || 'Confirm Deletion';
        document.getElementById('adminConfirmMessage').textContent = message || 'Are you sure you want to proceed?';
        var btn = document.getElementById('adminConfirmBtn');
        btn.textContent = confirmBtnText || 'Confirm';
        btn.className = 'btn btn-sm rounded-pill px-3 fw-bold ' + (isDanger !== false ? 'btn-danger' : 'btn-primary');
        var icon = document.getElementById('adminConfirmIcon');
        if (icon) {
            icon.className = isDanger !== false ? 'bi bi-trash3-fill text-danger fs-5' : 'bi bi-question-circle-fill text-primary fs-5';
        }
        var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        var newBtn = btn.cloneNode(true);
        btn.parentNode.replaceChild(newBtn, btn);
        newBtn.addEventListener('click', function() {
            modal.hide();
            form.submit();
        });
        modal.show();
    };
</script>

@stack('scripts')
</body>
</html>
