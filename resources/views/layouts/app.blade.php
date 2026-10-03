<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Instant Theme Detection Script (Zero FOUC) -->
    <script>
        (function() {
            var savedTheme = localStorage.getItem('rodo_theme') || 'system';
            var resolvedTheme = savedTheme;
            if (savedTheme === 'system') {
                resolvedTheme = (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : 'light';
            }
            document.documentElement.setAttribute('data-bs-theme', resolvedTheme);
            document.documentElement.setAttribute('data-rodo-theme-pref', savedTheme);
        })();
    </script>

    @php
        $siteName = \App\Models\Setting::get('site_name', 'RODOPERU');
        $siteTagline = \App\Models\Setting::get('site_tagline', 'Electromovilidad e Implementos Rodoviarios');
        $defaultTitle = $siteName . ' | ' . $siteTagline;
        $metaTitle = $metaTitle ?? \App\Models\Setting::get('seo_meta_title', $defaultTitle);
        $metaDescription = $metaDescription ?? \App\Models\Setting::get('seo_meta_description', 'Líderes en automóviles y camiones 100% eléctricos y semirremolques rodoviarios en Perú.');
        $metaKeywords = $metaKeywords ?? \App\Models\Setting::get('seo_meta_keywords', 'vehiculos electricos peru, semirremolques facchini, jmev peru, rodoperu');
        $metaImage = $metaImage ?? asset(\App\Models\Setting::get('logo_path', 'images/logo/RODO.png'));
        $faviconPath = \App\Models\Setting::get('favicon_path', 'favicon.png');
        $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
        $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '+51987654321');
        $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
        $companyPhone = \App\Models\Setting::get('company_phone', '+51 (01) 719-8900');
        $supportEmail = \App\Models\Setting::get('support_email', 'ventas@rodoperu.com');
    @endphp

    <title>@yield('title', $metaTitle)</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', $metaDescription)">
    <meta name="keywords" content="@yield('meta_keywords', $metaKeywords)">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook / WhatsApp Preview -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $metaTitle)">
    <meta property="og:description" content="@yield('meta_description', $metaDescription)">
    <meta property="og:image" content="{{ $metaImage }}">
    <meta property="og:site_name" content="{{ $siteName }}">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $metaTitle)">
    <meta name="twitter:description" content="@yield('meta_description', $metaDescription)">
    <meta name="twitter:image" content="{{ $metaImage }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset($faviconPath) }}?v=2">
    <link rel="shortcut icon" href="{{ asset($faviconPath) }}?v=2">

    <!-- Fonts: Orbitron / Montserrat / Syne -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Frameworks & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom Theme Styling (Fusion Facchini Industrial + JMEV Futuristic EV) -->
    <style>
        :root, [data-bs-theme="dark"] {
            --primary-dark: #070d1e;
            --secondary-dark: #0f172a;
            --card-dark: #162035;
            --border-dark: #243452;
            --electric-cyan: #00f2fe;
            --electric-blue: #4facfe;
            --neon-green: #00e676;
            --industrial-amber: #ff9100;
            --text-light: #f8fafc;
            --text-muted: #94a3b8;
            --rodo-bg-body: #070d1e;
            --rodo-bg-surface: #0f172a;
            --rodo-bg-card: #162035;
            --rodo-bg-card-subtle: #0f182d;
            --rodo-border: #243452;
            --rodo-border-subtle: rgba(255, 255, 255, 0.12);
            --rodo-text-primary: #f8fafc;
            --rodo-text-secondary: #94a3b8;
            --rodo-text-muted: #94a3b8;
            --rodo-text-heading: #ffffff;
            --rodo-input-bg: #0d162a;
            --rodo-input-color: #f8fafc;
            --rodo-input-border: #243452;
            --rodo-input-placeholder: #64748b;
            --navbar-bg: rgba(7, 13, 30, 0.98);
            --navbar-border: rgba(0, 242, 254, 0.18);
            --navbar-link: #cbd5e1;
            --navbar-link-hover: #ffffff;
            --footer-bg: #060a17;
            --dropdown-bg: #0f172a;
            --dropdown-color: #e2e8f0;
        }

        [data-bs-theme="light"] {
            --primary-dark: #f8fafc;
            --secondary-dark: #ffffff;
            --card-dark: #ffffff;
            --border-dark: #e2e8f0;
            --electric-cyan: #0284c7;
            --electric-blue: #0369a1;
            --neon-green: #15803d;
            --industrial-amber: #d97706;
            --text-light: #0f172a;
            --text-muted: #64748b;
            --rodo-bg-body: #f8fafc;
            --rodo-bg-surface: #ffffff;
            --rodo-bg-card: #ffffff;
            --rodo-bg-card-subtle: #f1f5f9;
            --rodo-border: #e2e8f0;
            --rodo-border-subtle: #cbd5e1;
            --rodo-text-primary: #0f172a;
            --rodo-text-secondary: #334155;
            --rodo-text-muted: #64748b;
            --rodo-text-heading: #0f172a;
            --rodo-input-bg: #ffffff;
            --rodo-input-color: #0f172a;
            --rodo-input-border: #cbd5e1;
            --rodo-input-placeholder: #94a3b8;
            --navbar-bg: rgba(255, 255, 255, 0.98);
            --navbar-border: rgba(0, 0, 0, 0.08);
            --navbar-link: #334155;
            --navbar-link-hover: #0f172a;
            --footer-bg: #0b1329;
            --dropdown-bg: #ffffff;
            --dropdown-color: #1e293b;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--rodo-bg-body);
            color: var(--rodo-text-primary);
            overflow-x: hidden;
            transition: background-color 0.25s ease, color 0.25s ease;
        }

        h1, h2, h3, h4, h5, h6, .brand-font {
            font-family: 'Rajdhani', 'Montserrat', sans-serif;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Top Bar */
        .top-announcement-bar {
            background: linear-gradient(90deg, #0b132b 0%, #1c2541 50%, #0b132b 100%);
            border-bottom: 1px solid var(--border-dark);
            font-size: 0.82rem;
            color: #cbd5e1;
            padding: 7px 0;
        }

        .top-announcement-bar a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.2s;
        }
        .top-announcement-bar a:hover {
            color: var(--electric-cyan);
        }

        /* Sticky Navigation - Tight, Adjusted & High-End */
        .rodo-navbar {
            background: rgba(7, 13, 30, 0.98);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(0, 242, 254, 0.18);
            padding: 8px 0;
            z-index: 1020;
        }

        .rodo-navbar .navbar-brand img {
            height: 38px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .rodo-navbar .navbar-nav {
            align-items: center;
            gap: 2px;
        }

        .rodo-navbar .nav-link {
            font-size: 0.88rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            color: #cbd5e1 !important;
            padding: 7px 12px !important;
            border-radius: 6px;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            position: relative;
            transition: all 0.2s ease;
            height: 38px;
        }

        .rodo-navbar .nav-link:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.05);
        }

        .rodo-navbar .nav-link.active {
            color: var(--electric-cyan) !important;
            background: rgba(0, 242, 254, 0.08);
            font-weight: 700;
        }

        .rodo-navbar .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 12px;
            right: 12px;
            height: 2px;
            background: var(--electric-cyan);
            border-radius: 2px;
            box-shadow: 0 0 8px var(--electric-cyan);
        }

        /* Search Bar - Compact, perfectly proportioned */
        .rodo-search-box {
            position: relative;
            width: 175px;
            transition: width 0.3s ease;
        }
        .rodo-search-box:focus-within {
            width: 220px;
        }
        .rodo-search-box input {
            background-color: #0f182d;
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #ffffff;
            border-radius: 20px;
            padding-left: 32px;
            padding-right: 12px;
            font-size: 0.82rem;
            height: 38px;
            transition: all 0.25s ease;
        }
        .rodo-search-box input:focus {
            background-color: #14223d;
            border-color: var(--electric-cyan);
            box-shadow: 0 0 10px rgba(0, 242, 254, 0.25);
            color: #ffffff;
        }
        .rodo-search-box .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 0.8rem;
            pointer-events: none;
        }

        /* Unified Header Action Buttons (Cart, Account, Cotizar) */
        .header-action-btn {
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            white-space: nowrap;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0 14px;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .header-btn-cart {
            width: 38px;
            padding: 0;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #f1f5f9;
            position: relative;
        }
        .header-btn-cart:hover {
            border-color: var(--electric-cyan);
            color: var(--electric-cyan);
            background: rgba(0, 242, 254, 0.06);
        }

        .header-btn-user {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #f1f5f9;
        }
        .header-btn-user:hover {
            border-color: var(--electric-cyan);
            color: #ffffff;
            background: rgba(255, 255, 255, 0.05);
        }

        .header-btn-theme {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #f1f5f9;
            padding: 0 10px;
            cursor: pointer;
        }
        .header-btn-theme:hover {
            border-color: var(--electric-cyan);
            color: var(--electric-cyan);
            background: rgba(0, 242, 254, 0.06);
        }

        .header-btn-quote {
            background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
            color: #050a18 !important;
            border: none;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 2px 10px rgba(0, 242, 254, 0.3);
            gap: 6px;
        }
        .header-btn-quote:hover {
            box-shadow: 0 0 16px rgba(0, 242, 254, 0.55);
            transform: translateY(-1px);
            color: #000 !important;
        }

        /* Auto suggest box */
        #search-results-dropdown {
            position: absolute;
            top: 105%;
            left: 0;
            right: 0;
            background: #111b2e;
            border: 1px solid var(--border-dark);
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            z-index: 9999;
            display: none;
            max-height: 380px;
            overflow-y: auto;
        }

        /* Buttons & Badges */
        .btn-electric {
            background: linear-gradient(135deg, var(--electric-cyan) 0%, var(--electric-blue) 100%);
            color: #070d1e;
            font-weight: 700;
            border: none;
            padding: 10px 22px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0, 242, 254, 0.3);
        }
        .btn-electric:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 242, 254, 0.5);
            color: #000;
        }

        .btn-outline-electric {
            border: 1.5px solid var(--electric-cyan);
            color: var(--electric-cyan);
            font-weight: 600;
            border-radius: 6px;
            padding: 8px 18px;
            transition: all 0.3s;
            background: transparent;
        }
        .btn-outline-electric:hover {
            background: var(--electric-cyan);
            color: #070d1e;
            box-shadow: 0 0 15px rgba(0, 242, 254, 0.4);
        }

        .btn-whatsapp-quote {
            background-color: #25d366;
            color: #ffffff;
            font-weight: 700;
            border-radius: 6px;
            border: none;
            transition: all 0.3s;
        }
        .btn-whatsapp-quote:hover {
            background-color: #20ba5a;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
        }

        /* Product Cards */
        .product-card {
            background: var(--card-dark);
            border: 1px solid var(--border-dark);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .product-card:hover {
            transform: translateY(-6px);
            border-color: rgba(0, 242, 254, 0.5);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4), 0 0 15px rgba(0, 242, 254, 0.15);
        }
        .product-card .card-img-wrap {
            position: relative;
            overflow: hidden;
            background: #0b1323;
            height: 230px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .product-card .card-img-wrap img {
            max-height: 100%;
            width: 100%;
            object-fit: contain;
            transition: transform 0.4s ease;
            padding: 10px;
        }
        .product-card:hover .card-img-wrap img {
            transform: scale(1.05);
        }

        .product-badge-tech {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(0, 242, 254, 0.2);
            color: var(--electric-cyan);
            border: 1px solid var(--electric-cyan);
            border-radius: 4px;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 3px 8px;
            text-transform: uppercase;
        }

        .product-badge-discount {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #ef4444;
            color: #ffffff;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 3px 8px;
        }

        .product-card .card-body {
            padding: 18px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-card .product-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 6px;
            text-decoration: none;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.6rem;
        }
        .product-card .product-title:hover {
            color: var(--electric-cyan);
        }

        .spec-pill {
            background: #111b2e;
            border: 1px solid #22324e;
            color: #94a3b8;
            font-size: 0.72rem;
            border-radius: 4px;
            padding: 3px 7px;
            margin-right: 5px;
            margin-bottom: 5px;
            display: inline-block;
        }

        /* Floating WhatsApp Button */
        .floating-whatsapp {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 60px;
            height: 60px;
            background: #25d366;
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.5);
            z-index: 1000;
            transition: all 0.3s;
            text-decoration: none;
        }
        .floating-whatsapp:hover {
            transform: scale(1.1);
            color: #ffffff;
            box-shadow: 0 6px 25px rgba(37, 211, 102, 0.7);
        }

        /* Floating Chatbot Widget */
        .floating-chatbot-btn {
            position: fixed;
            bottom: 95px;
            right: 25px;
            width: 54px;
            height: 54px;
            background: linear-gradient(135deg, var(--electric-cyan) 0%, var(--electric-blue) 100%);
            color: #070d1e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 4px 18px rgba(0, 242, 254, 0.5);
            z-index: 999;
            cursor: pointer;
            transition: all 0.3s;
        }
        .floating-chatbot-btn:hover {
            transform: scale(1.08);
            box-shadow: 0 6px 22px rgba(0, 242, 254, 0.8);
        }

        .chatbot-window {
            position: fixed;
            bottom: 160px;
            right: 25px;
            width: 350px;
            max-width: 90vw;
            background: #0f172a;
            border: 1px solid var(--border-dark);
            border-radius: 14px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.6);
            z-index: 1001;
            display: none;
            flex-direction: column;
            overflow: hidden;
        }

        .chatbot-header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-bottom: 1px solid var(--border-dark);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chatbot-body {
            height: 320px;
            overflow-y: auto;
            padding: 14px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            background: #090e1a;
        }

        .chatbot-bubble {
            max-width: 82%;
            padding: 9px 13px;
            border-radius: 12px;
            font-size: 0.84rem;
            line-height: 1.4;
        }
        .chatbot-bubble.bot {
            background: #1e293b;
            color: #f1f5f9;
            align-self: flex-start;
            border-bottom-left-radius: 2px;
        }
        .chatbot-bubble.user {
            background: linear-gradient(135deg, var(--electric-cyan) 0%, var(--electric-blue) 100%);
            color: #070d1e;
            align-self: flex-end;
            font-weight: 500;
            border-bottom-right-radius: 2px;
        }

        .chatbot-footer {
            padding: 10px;
            background: #111928;
            border-top: 1px solid var(--border-dark);
            display: flex;
            gap: 6px;
        }

        /* Footer */
        .rodo-footer {
            background-color: #060a17;
            border-top: 2px solid var(--border-dark);
            color: var(--text-muted);
            padding-top: 60px;
            padding-bottom: 30px;
            font-size: 0.9rem;
        }
        .rodo-footer a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }
        .rodo-footer a:hover {
            color: var(--electric-cyan);
        }
        .rodo-footer h5 {
            color: #ffffff;
            font-size: 1.1rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        .rodo-footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 35px;
            height: 2px;
            background: var(--electric-cyan);
        }

        /* Dropdown custom */
        .dropdown-menu-dark-custom, .rodo-dropdown-menu {
            background-color: var(--dropdown-bg);
            border: 1px solid var(--rodo-border);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            border-radius: 10px;
        }
        .dropdown-menu-dark-custom .dropdown-item, .rodo-dropdown-menu .dropdown-item {
            color: var(--dropdown-color);
            padding: 8px 16px;
            font-size: 0.88rem;
            transition: all 0.2s ease;
        }
        .dropdown-menu-dark-custom .dropdown-item:hover, .rodo-dropdown-menu .dropdown-item:hover {
            background-color: rgba(0, 242, 254, 0.1);
            color: var(--electric-cyan);
        }

        /* ----------------------------------------------------
           HIGH-CONTRAST FORM CONTROLS (CRITICAL CONTRAST FIX)
           ---------------------------------------------------- */
        .form-control, .form-select {
            background-color: var(--rodo-input-bg) !important;
            color: var(--rodo-input-color) !important;
            border: 1px solid var(--rodo-input-border) !important;
            border-radius: 8px;
            font-size: 0.92rem;
            transition: all 0.2s ease;
        }
        .form-control:focus, .form-select:focus {
            background-color: var(--rodo-input-bg) !important;
            color: var(--rodo-input-color) !important;
            border-color: var(--electric-cyan) !important;
            box-shadow: 0 0 10px rgba(0, 242, 254, 0.25) !important;
        }
        .form-control::placeholder {
            color: var(--rodo-input-placeholder) !important;
            opacity: 1;
        }
        .input-group-text {
            background-color: var(--rodo-bg-card-subtle) !important;
            border-color: var(--rodo-input-border) !important;
            color: var(--rodo-text-secondary) !important;
        }
        .form-check-input {
            background-color: var(--rodo-input-bg);
            border-color: var(--rodo-input-border);
        }
        .form-check-input:checked {
            background-color: var(--electric-cyan);
            border-color: var(--electric-cyan);
        }

        /* ----------------------------------------------------
           HIGH-CONTRAST BADGES & BUTTONS (CRITICAL CONTRAST FIX)
           ---------------------------------------------------- */
        .pill-badge-cyan, .badge-cyan {
            background-color: rgba(0, 242, 254, 0.15) !important;
            color: #00f2fe !important;
            border: 1px solid rgba(0, 242, 254, 0.5) !important;
            font-weight: 700;
        }
        .pill-badge-amber, .badge-amber {
            background-color: rgba(255, 145, 0, 0.18) !important;
            color: #ffb74d !important;
            border: 1px solid rgba(255, 145, 0, 0.5) !important;
            font-weight: 700;
        }
        .pill-badge-green, .badge-green {
            background-color: rgba(0, 230, 118, 0.18) !important;
            color: #00e676 !important;
            border: 1px solid rgba(0, 230, 118, 0.5) !important;
            font-weight: 700;
        }

        .btn-amber {
            background-color: #ff9100;
            color: #070d1e !important;
            font-weight: 700;
            border: none;
            transition: all 0.25s ease;
        }
        .btn-amber:hover {
            background-color: #ffa726;
            color: #000000 !important;
            box-shadow: 0 4px 15px rgba(255, 145, 0, 0.4);
        }

        .btn-neon-green {
            background-color: #00e676;
            color: #070d1e !important;
            font-weight: 700;
            border: none;
            transition: all 0.25s ease;
        }
        .btn-neon-green:hover {
            background-color: #33eb91;
            color: #000000 !important;
            box-shadow: 0 4px 15px rgba(0, 230, 118, 0.4);
        }

        /* Dark Mode: Prevent any dark-on-dark text accidents */
        [data-bs-theme="dark"] .text-dark:not(.btn-electric):not(.btn-amber):not(.btn-neon-green):not(.btn-warning):not(.badge-warning):not(.header-btn-quote) {
            color: #f8fafc !important;
        }
        [data-bs-theme="dark"] .bg-info.text-dark,
        [data-bs-theme="dark"] .badge.bg-info.text-dark {
            background-color: rgba(0, 242, 254, 0.2) !important;
            color: #00f2fe !important;
            border: 1px solid rgba(0, 242, 254, 0.4) !important;
        }
        [data-bs-theme="dark"] .bg-warning.text-dark,
        [data-bs-theme="dark"] .badge.bg-warning.text-dark {
            background-color: rgba(255, 145, 0, 0.2) !important;
            color: #ffb74d !important;
            border: 1px solid rgba(255, 145, 0, 0.4) !important;
        }
        [data-bs-theme="dark"] .bg-success.text-dark,
        [data-bs-theme="dark"] .badge.bg-success.text-dark {
            background-color: rgba(0, 230, 118, 0.2) !important;
            color: #00e676 !important;
            border: 1px solid rgba(0, 230, 118, 0.4) !important;
        }
        [data-bs-theme="dark"] .text-muted {
            color: #94a3b8 !important;
        }

        /* ----------------------------------------------------
           LIGHT MODE OVERRIDES & PURITY
           ---------------------------------------------------- */
        [data-bs-theme="light"] .rodo-navbar {
            background: rgba(255, 255, 255, 0.98);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 2px 14px rgba(0, 0, 0, 0.06);
        }
        [data-bs-theme="light"] .rodo-navbar .nav-link {
            color: #334155 !important;
        }
        [data-bs-theme="light"] .rodo-navbar .nav-link:hover {
            color: #0f172a !important;
            background: rgba(0, 0, 0, 0.04);
        }
        [data-bs-theme="light"] .rodo-navbar .nav-link.active {
            color: #0284c7 !important;
            background: rgba(2, 132, 199, 0.08);
        }
        [data-bs-theme="light"] .rodo-navbar .nav-link.active::after {
            background: #0284c7;
            box-shadow: 0 0 8px rgba(2, 132, 199, 0.5);
        }
        [data-bs-theme="light"] .rodo-search-box input {
            background-color: #f1f5f9;
            border-color: #cbd5e1;
            color: #0f172a;
        }
        [data-bs-theme="light"] .rodo-search-box input:focus {
            background-color: #ffffff;
            border-color: #0284c7;
            color: #0f172a;
            box-shadow: 0 0 10px rgba(2, 132, 199, 0.2);
        }
        [data-bs-theme="light"] #search-results-dropdown {
            background: #ffffff;
            border-color: #cbd5e1;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        [data-bs-theme="light"] #search-results-dropdown a {
            color: #0f172a !important;
            border-color: #e2e8f0 !important;
        }
        [data-bs-theme="light"] .header-btn-cart,
        [data-bs-theme="light"] .header-btn-user,
        [data-bs-theme="light"] .header-btn-theme {
            border-color: #cbd5e1;
            color: #334155;
        }
        [data-bs-theme="light"] .header-btn-cart:hover,
        [data-bs-theme="light"] .header-btn-user:hover,
        [data-bs-theme="light"] .header-btn-theme:hover {
            border-color: #0284c7;
            color: #0284c7;
            background: rgba(2, 132, 199, 0.06);
        }
        [data-bs-theme="light"] .header-btn-quote {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff !important;
            box-shadow: 0 2px 10px rgba(2, 132, 199, 0.3);
        }
        [data-bs-theme="light"] .header-btn-quote:hover {
            color: #ffffff !important;
            box-shadow: 0 0 16px rgba(2, 132, 199, 0.5);
        }
        [data-bs-theme="light"] .btn-electric {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3);
        }
        [data-bs-theme="light"] .btn-electric:hover {
            color: #ffffff !important;
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.5);
        }
        [data-bs-theme="light"] .btn-outline-electric {
            border-color: #0284c7;
            color: #0284c7;
        }
        [data-bs-theme="light"] .btn-outline-electric:hover {
            background: #0284c7;
            color: #ffffff !important;
        }
        [data-bs-theme="light"] .product-card {
            background: #ffffff;
            border-color: #e2e8f0;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        }
        [data-bs-theme="light"] .product-card:hover {
            border-color: #0284c7;
            box-shadow: 0 12px 28px rgba(0,0,0,0.1), 0 0 12px rgba(2, 132, 199, 0.15);
        }
        [data-bs-theme="light"] .product-card .card-img-wrap {
            background: #f8fafc;
        }
        [data-bs-theme="light"] .product-card .product-title {
            color: #0f172a;
        }
        [data-bs-theme="light"] .product-card .product-title:hover {
            color: #0284c7;
        }
        [data-bs-theme="light"] .spec-pill {
            background: #f1f5f9;
            border-color: #e2e8f0;
            color: #475569;
        }
        [data-bs-theme="light"] .pill-badge-cyan,
        [data-bs-theme="light"] .badge-cyan {
            background-color: #e0f2fe !important;
            color: #0369a1 !important;
            border-color: #7dd3fc !important;
        }
        [data-bs-theme="light"] .pill-badge-amber,
        [data-bs-theme="light"] .badge-amber {
            background-color: #fef3c7 !important;
            color: #b45309 !important;
            border-color: #fcd34d !important;
        }
        [data-bs-theme="light"] .pill-badge-green,
        [data-bs-theme="light"] .badge-green {
            background-color: #dcfce7 !important;
            color: #15803d !important;
            border-color: #86efac !important;
        }

        /* Light mode text & container adaptations */
        [data-bs-theme="light"] h1.text-white,
        [data-bs-theme="light"] h2.text-white,
        [data-bs-theme="light"] h3.text-white,
        [data-bs-theme="light"] h4.text-white,
        [data-bs-theme="light"] h5.text-white,
        [data-bs-theme="light"] h6.text-white,
        [data-bs-theme="light"] p.text-white,
        [data-bs-theme="light"] span.text-white:not(.badge):not(.btn),
        [data-bs-theme="light"] div.text-white:not(.btn):not(.badge) {
            color: #0f172a !important;
        }
        [data-bs-theme="light"] .text-light {
            color: #334155 !important;
        }
        [data-bs-theme="light"] .text-muted {
            color: #64748b !important;
        }
        [data-bs-theme="light"] .border-secondary,
        [data-bs-theme="light"] .border-dark {
            border-color: #e2e8f0 !important;
        }
        [data-bs-theme="light"] .bg-dark:not(.top-announcement-bar):not(.rodo-footer) {
            background-color: #f1f5f9 !important;
            color: #0f172a !important;
        }
        [data-bs-theme="light"] div[style*="background: #0f182e"],
        [data-bs-theme="light"] div[style*="background: #0f1930"],
        [data-bs-theme="light"] div[style*="background: #091022"],
        [data-bs-theme="light"] div[style*="background: #0b1323"] {
            background-color: #ffffff !important;
        }
        [data-bs-theme="light"] section[style*="background: #080f22"],
        [data-bs-theme="light"] div[style*="background: #091022"] {
            background-color: #f8fafc !important;
        }
        [data-bs-theme="light"] section[style*="linear-gradient(135deg, #091326"] {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important;
            border-color: #cbd5e1 !important;
        }
        [data-bs-theme="light"] .table-dark {
            --bs-table-bg: #ffffff;
            --bs-table-striped-bg: #f8fafc;
            --bs-table-color: #0f172a;
            --bs-table-border-color: #e2e8f0;
        }
        [data-bs-theme="light"] .table-dark td,
        [data-bs-theme="light"] .table-dark th {
            color: #0f172a !important;
        }
        [data-bs-theme="light"] .table-dark td.text-info {
            color: #0284c7 !important;
        }

        /* Light mode Chatbot */
        [data-bs-theme="light"] .chatbot-window {
            background: #ffffff;
            border-color: #cbd5e1;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        [data-bs-theme="light"] .chatbot-header {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-bottom: 1px solid #cbd5e1;
        }
        [data-bs-theme="light"] .chatbot-header h6 {
            color: #0f172a !important;
        }
        [data-bs-theme="light"] .chatbot-header #chatbot-close-btn {
            color: #0f172a !important;
        }
        [data-bs-theme="light"] .chatbot-body {
            background: #f8fafc;
        }
        [data-bs-theme="light"] .chatbot-bubble.bot {
            background: #ffffff;
            color: #1e293b;
            border: 1px solid #e2e8f0;
        }
        [data-bs-theme="light"] .chatbot-footer {
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
        }

        /* Parallax & Hero light mode adaptation */
        [data-bs-theme="light"] .hero-parallax-intro {
            background: radial-gradient(circle at 50% 40%, #e0f2fe 0%, #f1f5f9 60%, #f8fafc 100%);
            border-bottom: 1px solid #e2e8f0;
        }
        [data-bs-theme="light"] .hero-title-main {
            background: linear-gradient(135deg, #0f172a 30%, #0369a1 80%, #0284c7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        [data-bs-theme="light"] .scroll-down-badge {
            background: rgba(2, 132, 199, 0.08);
            border-color: #0284c7;
            color: #0284c7;
        }
        [data-bs-theme="light"] .parallax-master-showcase {
            background: #f1f5f9;
        }
        [data-bs-theme="light"] .parallax-viewport-frame {
            background: #ffffff;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }
        [data-bs-theme="light"] .parallax-info-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid #e2e8f0;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.07);
        }
        [data-bs-theme="light"] .spec-mini-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }
        [data-bs-theme="light"] .clean-feature-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        }
        [data-bs-theme="light"] .clean-sim-panel {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.07);
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- 1. Top Announcement Bar -->
    <div class="top-announcement-bar d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-4">
                <span><i class="fas fa-phone-alt text-info me-1"></i> {{ $companyPhone }}</span>
                <span><i class="fab fa-whatsapp text-success me-1"></i> <a href="https://api.whatsapp.com/send?phone={{ $whatsappClean }}" target="_blank">{{ $whatsappNumber }}</a></span>
                <span><i class="fas fa-envelope text-warning me-1"></i> {{ $supportEmail }}</span>
                <span class="badge bg-dark border border-secondary text-info"><i class="fas fa-bolt me-1"></i> Líderes en Electromovilidad Perú</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ \App\Models\Setting::get('social_facebook', '#') }}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="{{ \App\Models\Setting::get('social_instagram', '#') }}" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="{{ \App\Models\Setting::get('social_linkedin', '#') }}" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="{{ \App\Models\Setting::get('social_youtube', '#') }}" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="{{ \App\Models\Setting::get('social_tiktok', '#') }}" target="_blank" title="TikTok"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>
    </div>

    <!-- 2. Sticky Navbar (Clean, Fitted & Modern) -->
    <nav class="navbar navbar-expand-lg rodo-navbar sticky-top">
        <div class="container-fluid px-xl-5 px-lg-4 px-3">
            <!-- Brand Logo -->
            <a class="navbar-brand d-flex align-items-center me-3" href="{{ route('home') }}">
                <img src="{{ asset(\App\Models\Setting::get('logo_path', 'images/logo/RODO.png')) }}" alt="{{ $siteName }}" height="38" class="d-inline-block">
            </a>

            <!-- Mobile Toggler -->
            <button class="navbar-toggler text-white border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#rodoNavbarContent">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="rodoNavbarContent">
                <!-- Navigation Tabs (Sleek, Clean, No awkward icon stacking) -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('empresa') ? 'active' : '' }}" href="{{ route('empresa') }}">
                            Empresa
                        </a>
                    </li>
                    <!-- Products Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('products.*') && !request()->routeIs('products.destacados') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                            Productos
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark-custom">
                            <li><a class="dropdown-item" href="{{ route('products.index', ['categoria' => 'vehiculos-electricos']) }}"><i class="fas fa-bolt text-info me-2"></i> Vehículos 100% Eléctricos</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.index', ['categoria' => 'suvs-electricos']) }}"><i class="fas fa-car-side text-info me-2"></i> SUVs Eléctricos</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.index', ['categoria' => 'camiones-utilitarios-electricos']) }}"><i class="fas fa-truck-pickup text-info me-2"></i> Camiones & Utilitarios EV</a></li>
                            <li><hr class="dropdown-divider border-secondary"></li>
                            <li><a class="dropdown-item" href="{{ route('products.index', ['categoria' => 'implementos-rodoviarios']) }}"><i class="fas fa-trailer text-warning me-2"></i> Implementos Rodoviarios (Facchini)</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.index', ['categoria' => 'semirremolques-furgon']) }}"><i class="fas fa-box text-warning me-2"></i> Semirremolques Furgón</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.index', ['categoria' => 'tolvas-y-basculantes']) }}"><i class="fas fa-mountain text-warning me-2"></i> Tolvas Basculantes Mineras</a></li>
                            <li><hr class="dropdown-divider border-secondary"></li>
                            <li><a class="dropdown-item fw-bold text-info" href="{{ route('products.index') }}"><i class="fas fa-th-large me-2"></i> Ver Catálogo Completo</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.destacados') ? 'active' : '' }}" href="{{ route('products.destacados') }}">
                            Destacados
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('novedades.*') ? 'active' : '' }}" href="{{ route('novedades.index') }}">
                            Novedades
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}" href="{{ route('contacto') }}">
                            Contacto
                        </a>
                    </li>
                </ul>

                <!-- Live Search Box with Auto-Suggest -->
                <div class="rodo-search-box me-3 position-relative d-none d-md-block">
                    <form action="{{ route('products.index') }}" method="GET" id="global-search-form">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" name="buscar" id="global-search-input" class="form-control" placeholder="Buscar modelo o SKU..." value="{{ request('buscar') }}" autocomplete="off">
                    </form>
                    <div id="search-results-dropdown"></div>
                </div>

                <!-- Right Actions: Cart, User Account & Cotizar -->
                <div class="d-flex align-items-center gap-2">
                    <!-- Cart Button -->
                    @php
                        $cartCount = array_sum(array_column(session()->get('cart', []), 'quantity'));
                    @endphp
                    <a href="{{ route('cart.index') }}" class="header-action-btn header-btn-cart position-relative" title="Carrito de Compras">
                        <i class="fas fa-shopping-cart text-info"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-counter-badge" style="font-size: 0.65rem;">
                            {{ $cartCount }}
                        </span>
                    </a>

                    <!-- Theme Switcher Dropdown (Claro / Oscuro / Sistema) -->
                    <div class="dropdown" id="theme-selector-dropdown">
                        <button class="header-action-btn header-btn-theme dropdown-toggle" type="button" id="themeDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false" title="Cambiar Tema (Claro / Oscuro / Sistema)">
                            <i class="fas fa-moon me-1 text-info" id="theme-btn-icon"></i>
                            <span class="d-none d-xl-inline" id="theme-btn-label" style="font-size: 0.8rem;">Tema</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end rodo-dropdown-menu" aria-labelledby="themeDropdownBtn" style="min-width: 175px;">
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center justify-content-between py-2" onclick="setRodoTheme('light')">
                                    <span><i class="fas fa-sun text-warning me-2"></i> Claro</span>
                                    <i class="fas fa-check text-info theme-check d-none" data-theme-check="light"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center justify-content-between py-2" onclick="setRodoTheme('dark')">
                                    <span><i class="fas fa-moon text-info me-2"></i> Oscuro</span>
                                    <i class="fas fa-check text-info theme-check d-none" data-theme-check="dark"></i>
                                </button>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center justify-content-between py-2" onclick="setRodoTheme('system')">
                                    <span><i class="fas fa-desktop text-secondary me-2"></i> Sistema</span>
                                    <i class="fas fa-check text-info theme-check d-none" data-theme-check="system"></i>
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- User Account / Auth Dropdown -->
                    @auth
                        <div class="dropdown">
                            <button class="header-action-btn header-btn-user dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle text-info me-1"></i> {{ Str::words(Auth::user()->name, 1, '') }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark-custom">
                                <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}"><i class="fas fa-tachometer-alt me-2 text-info"></i> Mi Cuenta</a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.orders') }}"><i class="fas fa-box-open me-2 text-info"></i> Mis Pedidos</a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.chats') }}"><i class="fas fa-comments me-2 text-info"></i> Mis Chats con Asesor</a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.profile') }}"><i class="fas fa-id-card me-2 text-info"></i> Mi Perfil</a></li>
                                @if(Auth::user()->isAdmin())
                                    <li><hr class="dropdown-divider border-secondary"></li>
                                    <li><a class="dropdown-item text-warning fw-bold" href="{{ route('admin.dashboard') }}"><i class="fas fa-user-shield me-2"></i> Panel de Control Admin</a></li>
                                @endif
                                <li><hr class="dropdown-divider border-secondary"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="header-action-btn header-btn-user">
                            <i class="fas fa-user me-1 text-info"></i> Ingresar
                        </a>
                    @endauth

                    <!-- Cotizar WhatsApp Button (Strictly Inline, Perfectly Adjusted Height) -->
                    <a href="https://api.whatsapp.com/send?phone={{ $whatsappClean }}&text={{ rawurlencode('Hola RODOPERU, deseo asesoría técnica y cotización comercial.') }}" target="_blank" class="header-action-btn header-btn-quote">
                        <i class="fab fa-whatsapp fs-6"></i>
                        <span>Cotizar</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Alert Messages -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 bg-success text-white shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 bg-danger text-white shadow-sm" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show border-0 pill-badge-cyan shadow-sm" role="alert">
                <i class="fas fa-info-circle me-2"></i> {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(isset($errors) && $errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0 bg-danger text-white shadow-sm" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li><i class="fas fa-times-circle me-1"></i> {{ $err }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Main Content Yield -->
    <main>
        @yield('content')
    </main>

    <!-- 3. Floating WhatsApp -->
    <a href="https://api.whatsapp.com/send?phone={{ $whatsappClean }}&text={{ rawurlencode('¡Hola RODOPERU! Deseo información de sus vehículos eléctricos e implementos.') }}" target="_blank" class="floating-whatsapp" title="Hablar por WhatsApp con un Asesor">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- 4. Floating Chatbot Button & Modal -->
    <div class="floating-chatbot-btn" id="chatbot-toggle-btn" title="Asistente Virtual RODOPERU">
        <i class="fas fa-robot"></i>
    </div>

    <div class="chatbot-window" id="rodo-chatbot-box">
        <div class="chatbot-header">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-info p-2 rounded-circle text-white"><i class="fas fa-bolt"></i></span>
                <div>
                    <h6 class="mb-0 text-white font-weight-bold" style="font-size: 0.95rem;">RODO Asistente Virtual</h6>
                    <small class="text-success" style="font-size: 0.75rem;"><i class="fas fa-circle" style="font-size: 8px;"></i> En línea 24/7</small>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-link text-white text-decoration-none" id="chatbot-close-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="chatbot-body" id="chatbot-messages">
            <div class="chatbot-bubble bot">
                ¡Hola! Bienvenido a <strong>RODOPERU</strong>. Soy tu asistente virtual. ¿En qué podemos orientarte hoy?
            </div>
            <div class="d-flex flex-wrap gap-1 mt-2">
                <button class="btn btn-sm btn-outline-info py-1 px-2 chatbot-quick-q" data-q="¿Qué autonomía tienen sus autos eléctricos?"><i class="fas fa-bolt me-1"></i> Autonomía EV</button>
                <button class="btn btn-sm btn-outline-info py-1 px-2 chatbot-quick-q" data-q="¿Tienen semirremolques Facchini en stock?"><i class="fas fa-truck-moving me-1"></i> Facchini Stock</button>
                <button class="btn btn-sm btn-outline-info py-1 px-2 chatbot-quick-q" data-q="¿Cuáles son los métodos de pago disponibles?"><i class="fas fa-credit-card me-1"></i> Medios de Pago</button>
                <button class="btn btn-sm btn-outline-info py-1 px-2 chatbot-quick-q" data-q="Quiero hablar con un asesor humano"><i class="fas fa-headset me-1"></i> Asesor Humano</button>
            </div>
        </div>
        <div class="chatbot-footer">
            <input type="text" id="chatbot-user-input" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="Escribe tu consulta...">
            <button class="btn btn-sm btn-electric" id="chatbot-send-btn"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>

    <!-- 5. Promotional Modal Popup (Configurable from Admin) -->
    @php
        $popupActive = \App\Models\Setting::get('popup_active', '1') == '1';
        $popupTitle = \App\Models\Setting::get('popup_title', '');
        $popupSubtitle = \App\Models\Setting::get('popup_subtitle', '');
        $popupButtonText = \App\Models\Setting::get('popup_button_text', '');
        $popupButtonUrl = \App\Models\Setting::get('popup_button_url', '');
        $popupCountdown = \App\Models\Setting::get('popup_countdown', '');
    @endphp
    @if($popupActive && !empty($popupTitle))
    <div class="modal fade" id="rodoPromoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: #0f172a; border: 2px solid var(--electric-cyan); border-radius: 14px;">
                <div class="modal-header border-0 pb-0">
                    <span class="badge bg-danger text-uppercase px-3 py-2 font-weight-bold"><i class="fas fa-fire me-1"></i> OFERTA LIMITADA</span>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center pt-2 pb-4">
                    <img src="{{ asset(\App\Models\Setting::get('logo_path', 'images/logo/RODO.png')) }}" alt="RODOPERU" height="42" class="mb-3">
                    <h3 class="text-white font-weight-bold mb-2">{{ $popupTitle }}</h3>
                    <p class="text-light mb-3" style="font-size: 0.95rem;">{{ $popupSubtitle }}</p>

                    @if(!empty($popupCountdown))
                        <div class="d-flex justify-content-center gap-3 my-3">
                            <div class="bg-dark p-2 rounded border border-secondary text-center" style="min-width: 60px;">
                                <div class="h4 mb-0 text-info fw-bold" id="popup-days">15</div>
                                <small class="text-muted" style="font-size: 10px;">DÍAS</small>
                            </div>
                            <div class="bg-dark p-2 rounded border border-secondary text-center" style="min-width: 60px;">
                                <div class="h4 mb-0 text-info fw-bold" id="popup-hours">08</div>
                                <small class="text-muted" style="font-size: 10px;">HORAS</small>
                            </div>
                            <div class="bg-dark p-2 rounded border border-secondary text-center" style="min-width: 60px;">
                                <div class="h4 mb-0 text-info fw-bold" id="popup-mins">45</div>
                                <small class="text-muted" style="font-size: 10px;">MIN</small>
                            </div>
                            <div class="bg-dark p-2 rounded border border-secondary text-center" style="min-width: 60px;">
                                <div class="h4 mb-0 text-info fw-bold" id="popup-secs">20</div>
                                <small class="text-muted" style="font-size: 10px;">SEG</small>
                            </div>
                        </div>
                    @endif

                    @if(!empty($popupButtonText))
                        <a href="{{ $popupButtonUrl ?: route('products.index') }}" class="btn btn-electric w-100 py-3 mt-2 font-weight-bold">
                            {{ $popupButtonText }} <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- 6. Footer -->
    <footer class="rodo-footer">
        <div class="container">
            <div class="row g-4 mb-5">
                <!-- Col 1: Brand & Bio -->
                <div class="col-lg-4 col-md-6">
                    <img src="{{ asset(\App\Models\Setting::get('logo_path', 'images/logo/RODO.png')) }}" alt="{{ $siteName }}" height="50" class="mb-3">
                    <p class="text-muted" style="font-size: 0.92rem; line-height: 1.6;">
                        <strong>{{ $siteName }}</strong> es la empresa líder en soluciones de transporte en el Perú, fusionando la más avanzada tecnología automotriz de <strong>vehículos 100% eléctricos</strong> con la durabilidad de <strong>implementos rodoviarios y semirremolques</strong> de clase mundial.
                    </p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="{{ \App\Models\Setting::get('social_facebook', '#') }}" class="btn btn-outline-secondary btn-sm rounded-circle"><i class="fab fa-facebook-f text-white"></i></a>
                        <a href="{{ \App\Models\Setting::get('social_instagram', '#') }}" class="btn btn-outline-secondary btn-sm rounded-circle"><i class="fab fa-instagram text-white"></i></a>
                        <a href="{{ \App\Models\Setting::get('social_linkedin', '#') }}" class="btn btn-outline-secondary btn-sm rounded-circle"><i class="fab fa-linkedin-in text-white"></i></a>
                        <a href="{{ \App\Models\Setting::get('social_youtube', '#') }}" class="btn btn-outline-secondary btn-sm rounded-circle"><i class="fab fa-youtube text-white"></i></a>
                        <a href="{{ \App\Models\Setting::get('social_tiktok', '#') }}" class="btn btn-outline-secondary btn-sm rounded-circle"><i class="fab fa-tiktok text-white"></i></a>
                    </div>
                </div>

                <!-- Col 2: Navigation Links -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h5>Enlaces</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}"><i class="fas fa-angle-right me-1 text-info"></i> Inicio</a></li>
                        <li class="mb-2"><a href="{{ route('empresa') }}"><i class="fas fa-angle-right me-1 text-info"></i> Empresa</a></li>
                        <li class="mb-2"><a href="{{ route('products.index') }}"><i class="fas fa-angle-right me-1 text-info"></i> Productos</a></li>
                        <li class="mb-2"><a href="{{ route('products.destacados') }}"><i class="fas fa-angle-right me-1 text-info"></i> Destacados</a></li>
                        <li class="mb-2"><a href="{{ route('novedades.index') }}"><i class="fas fa-angle-right me-1 text-info"></i> Novedades</a></li>
                        <li class="mb-2"><a href="{{ route('contacto') }}"><i class="fas fa-angle-right me-1 text-info"></i> Contacto</a></li>
                    </ul>
                </div>

                <!-- Col 3: Categories -->
                <div class="col-lg-3 col-md-6 col-6">
                    <h5>Líneas de Producto</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('products.index', ['categoria' => 'vehiculos-electricos']) }}"><i class="fas fa-bolt text-info me-1"></i> Vehículos Eléctricos</a></li>
                        <li class="mb-2"><a href="{{ route('products.index', ['categoria' => 'suvs-electricos']) }}"><i class="fas fa-car-side text-info me-1"></i> SUVs Eléctricos</a></li>
                        <li class="mb-2"><a href="{{ route('products.index', ['categoria' => 'camiones-utilitarios-electricos']) }}"><i class="fas fa-truck text-info me-1"></i> Camiones & Flotas EV</a></li>
                        <li class="mb-2"><a href="{{ route('products.index', ['categoria' => 'semirremolques-furgon']) }}"><i class="fas fa-trailer text-warning me-1"></i> Semirremolques Furgón</a></li>
                        <li class="mb-2"><a href="{{ route('products.index', ['categoria' => 'tolvas-y-basculantes']) }}"><i class="fas fa-mountain text-warning me-1"></i> Tolvas Basculantes</a></li>
                        <li class="mb-2"><a href="{{ route('products.index', ['categoria' => 'cisternas-y-tanques']) }}"><i class="fas fa-tint text-warning me-1"></i> Cisternas de Combustible</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Locations -->
                <div class="col-lg-3 col-md-6">
                    <h5>Contacto Directo</h5>
                    <p class="mb-2"><i class="fas fa-map-marker-alt text-info me-2"></i> {{ \App\Models\Setting::get('company_address', 'Av. Evitamiento Km 8.5, Ate - Lima, Perú') }}</p>
                    <p class="mb-2"><i class="fas fa-phone-alt text-info me-2"></i> {{ $companyPhone }}</p>
                    <p class="mb-2"><i class="fab fa-whatsapp text-success me-2"></i> {{ $whatsappNumber }}</p>
                    <p class="mb-3"><i class="fas fa-envelope text-info me-2"></i> {{ $supportEmail }}</p>
                    <div class="p-3 bg-dark rounded border border-secondary">
                        <small class="text-white d-block mb-1 font-weight-bold">Medios de Pago Seguros:</small>
                        <div class="d-flex gap-2 align-items-center">
                            <span class="badge bg-primary">BCP</span>
                            <span class="badge bg-info text-white">BBVA</span>
                            <span class="badge bg-purple" style="background:#702082;">YAPE</span>
                            <span class="badge bg-cyan" style="background:#00a3e0;">PLIN</span>
                            <span class="badge bg-secondary"><i class="fab fa-cc-visa"></i></span>
                            <span class="badge bg-secondary"><i class="fab fa-cc-mastercard"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-secondary mb-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <small class="text-muted">
                    &copy; {{ date('Y') }} <strong>RODOPERU S.A.C.</strong> Todos los derechos reservados. RUC 20601234567.
                </small>
                <div class="d-flex gap-3 mt-2 mt-md-0" style="font-size: 0.8rem;">
                    <a href="{{ route('seo.sitemap') }}" target="_blank">Mapa de Sitio (Sitemap)</a>
                    <span>•</span>
                    <a href="{{ route('empresa') }}">Políticas de Garantía</a>
                    <span>•</span>
                    <a href="{{ route('contacto') }}">Libro de Reclamaciones</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts: Bootstrap 5.3 + Live Search + Chatbot JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // 1. Auto Show Promotional Popup once per session
        document.addEventListener('DOMContentLoaded', function () {
            const promoModalEl = document.getElementById('rodoPromoModal');
            if (promoModalEl && !sessionStorage.getItem('rodo_promo_seen')) {
                setTimeout(function () {
                    const promoModal = new bootstrap.Modal(promoModalEl);
                    promoModal.show();
                    sessionStorage.setItem('rodo_promo_seen', '1');
                }, 1500);
            }

            // 2. Countdown Timer Logic
            const countdownTarget = "{{ $popupCountdown }}";
            if (countdownTarget) {
                const targetDate = new Date(countdownTarget).getTime();
                setInterval(function () {
                    const now = new Date().getTime();
                    const distance = targetDate - now;
                    if (distance > 0) {
                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const mins = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const secs = Math.floor((distance % (1000 * 60)) / 1000);

                        const dEl = document.getElementById('popup-days');
                        const hEl = document.getElementById('popup-hours');
                        const mEl = document.getElementById('popup-mins');
                        const sEl = document.getElementById('popup-secs');
                        if (dEl) dEl.innerText = days;
                        if (hEl) hEl.innerText = hours < 10 ? '0' + hours : hours;
                        if (mEl) mEl.innerText = mins < 10 ? '0' + mins : mins;
                        if (sEl) sEl.innerText = secs < 10 ? '0' + secs : secs;
                    }
                }, 1000);
            }

            // 3. Live Search Auto-Suggest
            const searchInput = document.getElementById('global-search-input');
            const searchDropdown = document.getElementById('search-results-dropdown');
            let debounceTimer;

            if (searchInput && searchDropdown) {
                searchInput.addEventListener('input', function () {
                    const query = this.value.trim();
                    clearTimeout(debounceTimer);
                    if (query.length < 2) {
                        searchDropdown.style.display = 'none';
                        searchDropdown.innerHTML = '';
                        return;
                    }

                    debounceTimer = setTimeout(() => {
                        fetch("{{ route('api.search-suggest') }}?q=" + encodeURIComponent(query))
                            .then(res => res.json())
                            .then(data => {
                                if (data.length === 0) {
                                    searchDropdown.innerHTML = '<div class="p-3 text-muted text-center" style="font-size:0.85rem;">No se encontraron productos. Presione Enter para ver catálogo completo.</div>';
                                    searchDropdown.style.display = 'block';
                                    return;
                                }

                                let html = '<div class="p-2">';
                                data.forEach(item => {
                                    html += `
                                        <a href="${item.url}" class="d-flex align-items-center gap-3 p-2 text-decoration-none border-bottom border-dark" style="color:#ffffff;">
                                            <img src="${item.image}" alt="${item.name}" width="42" height="42" style="object-fit:contain; background:#0b1323; border-radius:4px;">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <div class="fw-bold text-truncate" style="font-size:0.88rem;">${item.name}</div>
                                                <small class="text-muted">SKU: ${item.sku}</small>
                                            </div>
                                            <div class="text-end">
                                                <span class="badge bg-dark border border-info text-info">${item.price}</span>
                                            </div>
                                        </a>
                                    `;
                                });
                                html += `<a href="{{ route('products.index') }}?buscar=${encodeURIComponent(query)}" class="d-block text-center p-2 text-info fw-bold" style="font-size:0.82rem;">Ver todos los resultados &rarr;</a></div>`;
                                searchDropdown.innerHTML = html;
                                searchDropdown.style.display = 'block';
                            });
                    }, 300);
                });

                document.addEventListener('click', function (e) {
                    if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
                        searchDropdown.style.display = 'none';
                    }
                });
            }

            // 4. Floating Chatbot Interactions
            const chatbotToggleBtn = document.getElementById('chatbot-toggle-btn');
            const chatbotBox = document.getElementById('rodo-chatbot-box');
            const chatbotCloseBtn = document.getElementById('chatbot-close-btn');
            const chatbotMessages = document.getElementById('chatbot-messages');
            const chatbotUserInput = document.getElementById('chatbot-user-input');
            const chatbotSendBtn = document.getElementById('chatbot-send-btn');

            if (chatbotToggleBtn && chatbotBox) {
                chatbotToggleBtn.addEventListener('click', () => {
                    chatbotBox.style.display = (chatbotBox.style.display === 'flex') ? 'none' : 'flex';
                });
                chatbotCloseBtn.addEventListener('click', () => {
                    chatbotBox.style.display = 'none';
                });

                const botFaqs = {
                    'autonomía': 'Nuestros vehículos 100% eléctricos ofrecen autonomías que van desde 300 km (en modelos urbanos como JMEV EV-2) hasta más de 520 km (en SUVs como el RODO EV-600). Cuentan con sistema de frenado regenerativo.',
                    'facchini': 'Somos distribuidores e integradores oficiales de Facchini en Perú. Contamos con furgones de carga seca de 14.6m, tolvas basculantes Hardox de 35m³ y plataformas multimodales para entrega inmediata.',
                    'pago': 'Aceptamos transferencias bancarias en Soles y Dólares (BCP, BBVA, Interbank), Yape, Plin, tarjetas de crédito/débito y opciones de financiamiento leasing vehicular.',
                    'asesor': '¡Excelente! Puedes contactar de inmediato a nuestro equipo de ventas haciendo clic en el botón verde de WhatsApp o llamando al {{ $companyPhone }}.'
                };

                function sendChatbotMessage(text) {
                    if (!text) return;
                    // Append user bubble
                    const userBubble = document.createElement('div');
                    userBubble.className = 'chatbot-bubble user';
                    userBubble.innerText = text;
                    chatbotMessages.appendChild(userBubble);
                    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;

                    // Compute response
                    setTimeout(() => {
                        let answer = 'Gracias por escribirnos. Un asesor de RODOPERU puede profundizar en esta información. Te recomendamos cotizar por WhatsApp para enviarte ficha técnica completa.';
                        const lower = text.toLowerCase();

                        if (lower.includes('autonom') || lower.includes('bater') || lower.includes('km')) {
                            answer = botFaqs['autonomía'];
                        } else if (lower.includes('facchini') || lower.includes('furgon') || lower.includes('tolva') || lower.includes('semirremolque')) {
                            answer = botFaqs['facchini'];
                        } else if (lower.includes('pago') || lower.includes('precio') || lower.includes('cuota') || lower.includes('bcp')) {
                            answer = botFaqs['pago'];
                        } else if (lower.includes('asesor') || lower.includes('humano') || lower.includes('contacto') || lower.includes('telefono')) {
                            answer = botFaqs['asesor'];
                        }

                        const botBubble = document.createElement('div');
                        botBubble.className = 'chatbot-bubble bot';
                        botBubble.innerHTML = answer;
                        chatbotMessages.appendChild(botBubble);
                        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
                    }, 400);
                }

                if (chatbotSendBtn) {
                    chatbotSendBtn.addEventListener('click', () => {
                        const val = chatbotUserInput.value.trim();
                        if (val) {
                            sendChatbotMessage(val);
                            chatbotUserInput.value = '';
                        }
                    });
                    chatbotUserInput.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter') {
                            const val = chatbotUserInput.value.trim();
                            if (val) {
                                sendChatbotMessage(val);
                                chatbotUserInput.value = '';
                            }
                        }
                    });
                }

                document.querySelectorAll('.chatbot-quick-q').forEach(btn => {
                    btn.addEventListener('click', function () {
                        sendChatbotMessage(this.dataset.q);
                    });
                });
            }
        });
    </script>

    <!-- Theme Switcher Core Handler (Light / Dark / System) -->
    <script>
        function updateThemeUI(pref, resolved) {
            // Update checkmark indicators in dropdown
            document.querySelectorAll('.theme-check').forEach(function(el) {
                if (el.getAttribute('data-theme-check') === pref) {
                    el.classList.remove('d-none');
                } else {
                    el.classList.add('d-none');
                }
            });

            // Update main navbar theme button icon and label
            var icon = document.getElementById('theme-btn-icon');
            var label = document.getElementById('theme-btn-label');
            if (icon) {
                if (pref === 'system') {
                    icon.className = 'fas fa-desktop me-1 text-secondary';
                    if (label) label.textContent = 'Auto (' + (resolved === 'dark' ? 'Osc' : 'Clar') + ')';
                } else if (pref === 'light') {
                    icon.className = 'fas fa-sun me-1 text-warning';
                    if (label) label.textContent = 'Claro';
                } else {
                    icon.className = 'fas fa-moon me-1 text-info';
                    if (label) label.textContent = 'Oscuro';
                }
            }
        }

        function setRodoTheme(pref) {
            localStorage.setItem('rodo_theme', pref);
            var resolved = pref;
            if (pref === 'system') {
                resolved = (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : 'light';
            }
            document.documentElement.setAttribute('data-bs-theme', resolved);
            document.documentElement.setAttribute('data-rodo-theme-pref', pref);
            updateThemeUI(pref, resolved);
        }

        // Listen for OS scheme change if user is on system mode
        if (window.matchMedia) {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
                var currentPref = localStorage.getItem('rodo_theme') || 'system';
                if (currentPref === 'system') {
                    var newResolved = e.matches ? 'dark' : 'light';
                    document.documentElement.setAttribute('data-bs-theme', newResolved);
                    updateThemeUI('system', newResolved);
                }
            });
        }

        // Initialize UI icons & checkmarks on page load
        (function() {
            var currentPref = localStorage.getItem('rodo_theme') || 'system';
            var currentResolved = document.documentElement.getAttribute('data-bs-theme') || 'dark';
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    updateThemeUI(currentPref, currentResolved);
                });
            } else {
                updateThemeUI(currentPref, currentResolved);
            }
        })();
    </script>
    <!-- GSAP & ScrollTrigger CDN for high-performance animations & parallax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    @stack('scripts')
</body>
</html>
