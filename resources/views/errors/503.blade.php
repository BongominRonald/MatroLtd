<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Unavailable / Under Maintenance — BRX AGRO GLOBAL</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('lib/boxicons/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/open-sans.css') }}">
    <style>
        :root {
            --primary: #155724;
            --primary-dark: #0c3315;
            --accent: #28a745;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --bg-light: #f9fafb;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        body {
            background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 50%, #f9fafb 100%);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .error-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 45px rgba(15, 81, 50, 0.08), 0 4px 12px rgba(0, 0, 0, 0.04);
            max-width: 540px;
            width: 100%;
            padding: 48px 36px;
            text-align: center;
            border: 1px solid rgba(22, 101, 52, 0.1);
        }
        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            background: #ecfdf5;
            border-radius: 9999px;
            color: var(--primary);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 24px;
            border: 1px solid #d1fae5;
        }
        .code-display {
            font-size: 5rem;
            font-weight: 800;
            line-height: 1;
            color: #b91c1c;
            margin-bottom: 12px;
            letter-spacing: -2px;
        }
        .error-icon {
            font-size: 3.5rem;
            color: #b91c1c;
            margin-bottom: 16px;
            display: inline-block;
        }
        h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 12px;
        }
        p {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 32px;
        }
        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
        }
        .btn-primary {
            background: var(--primary);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(21, 87, 36, 0.25);
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }
        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 1.5px solid #d1fae5;
        }
        .btn-outline:hover {
            background: #ecfdf5;
        }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="brand-badge">
            <i class='bx bx-globe'></i> BRX AGRO GLOBAL
        </div>
        <div class="code-display">503</div>
        <h1>Something Went Wrong</h1>
        <p>Our servers encountered a temporary hiccup while processing your request. Our technical team has been notified. Please try refreshing in a few moments.</p>
        <div class="actions">
            <a href="{ route('home') }}" class="btn btn-primary">
                <i class='bx bx-home-alt'></i> Back to Homepage
            </a>
            <a href="https://api.whatsapp.com/send?phone=5511958353433&text=Hello%20BRX%20Agro%20Global,%20I%20need%20assistance." target="_blank" class="btn btn-outline">
                <i class='bx bxl-whatsapp'></i> Chat on WhatsApp
            </a>
        </div>
    </div>
</body>
</html>
