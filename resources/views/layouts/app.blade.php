<!DOCTYPE html>
<html lang="es" class="light" id="html-root">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $siteName = \App\Models\Setting::get('site_name', 'RODOPERU');
        $siteTagline = \App\Models\Setting::get('site_tagline', 'Electromovilidad & Implementos Rodoviarios');
        $defaultTitle = $siteName . ' | ' . $siteTagline;
        $metaTitle = $metaTitle ?? \App\Models\Setting::get('seo_meta_title', $defaultTitle);
        $metaDescription = $metaDescription ?? \App\Models\Setting::get('seo_meta_description', 'Líderes en transporte sostenible y carga pesada en Perú. Vehículos 100% eléctricos JMEV y semirremolques, tolvas y furgones Facchini.');
        $metaKeywords = $metaKeywords ?? \App\Models\Setting::get('seo_meta_keywords', 'vehiculos electricos peru, semirremolques facchini, jmev peru, tolvas mineras, rodoperu, camion electrico lima');
        $metaImage = $metaImage ?? asset(\App\Models\Setting::get('logo_path', 'images/logo/RODO.png'));
        $faviconPath = \App\Models\Setting::get('favicon_path', 'favicon.png');
        $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
        $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '+51987654321');
        $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
        $companyPhone = \App\Models\Setting::get('company_phone', '+51 (01) 719-8900');
        $supportEmail = \App\Models\Setting::get('support_email', 'ventas@rodoperu.com');
        $cartCount = count(session('cart', []));
    @endphp

    <title>@yield('title', $metaTitle)</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', $metaDescription)">
    <meta name="keywords" content="@yield('meta_keywords', $metaKeywords)">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / WhatsApp Preview -->
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
    <link rel="icon" type="image/png" href="{{ asset($faviconPath) }}?v=3">
    <link rel="shortcut icon" href="{{ asset($faviconPath) }}?v=3">

    <!-- Schema.org JSON-LD Structured Data for High-Tier Industrial SEO -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "AutoDealer",
      "name": "RODOPERU S.A.C.",
      "alternateName": "RODOPERU Electromovilidad y Carga Pesada",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('images/logo/RODO.png') }}",
      "image": "{{ asset('images/catalog/hero-ev-stage.jpg') }}",
      "description": "Distribuidor oficial de vehículos comerciales 100% eléctricos JMEV e implementos rodoviarios y semirremolques pesados Facchini en Perú.",
      "telephone": "{{ $companyPhone }}",
      "email": "{{ $supportEmail }}",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "Av. Evitamiento Km 8.5, Zona Industrial",
        "addressLocality": "Ate",
        "addressRegion": "Lima",
        "postalCode": "15022",
        "addressCountry": "PE"
      },
      "geo": {
        "@@type": "GeoCoordinates",
        "latitude": "-12.0432",
        "longitude": "-76.9658"
      },
      "openingHoursSpecification": {
        "@@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
        "opens": "08:30",
        "closes": "18:00"
      },
      "sameAs": [
        "https://facebook.com/rodoperu",
        "https://instagram.com/rodoperu_oficial",
        "https://linkedin.com/company/rodoperu"
      ]
    }
    </script>

    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600;700&family=Space+Grotesk:wght@600;700&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS with Stitch Design Tokens -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#051125",
                    "primary-container": "#1b263b",
                    "secondary": "#765a23",
                    "secondary-fixed": "#ffdea6",
                    "secondary-container": "#fed894",
                    "on-secondary-fixed": "#271900",
                    "tertiary": "#041221",
                    "tertiary-container": "#1a2737",
                    "surface": "#f9faf5",
                    "surface-container-lowest": "#ffffff",
                    "surface-container-low": "#f3f4f0",
                    "surface-container": "#edeeea",
                    "surface-container-high": "#e8e8e4",
                    "surface-container-highest": "#e2e3df",
                    "on-surface": "#1a1c1a",
                    "on-surface-variant": "#45474d",
                    "outline": "#75777d",
                    "outline-variant": "#c5c6cd",
                    "rodo-blue": "#0284c7",
                    "rodo-cyan": "#00d2ff",
                    "facchini-gold": "#B39255",
                    "rodo-green": "#10b981",
                },
                fontFamily: {
                    "headline": ["Space Grotesk", "sans-serif"],
                    "body": ["Inter", "sans-serif"],
                    "metric": ["JetBrains Mono", "monospace"],
                    "spec": ["JetBrains Mono", "monospace"],
                    "roboto": ["Roboto", "sans-serif"]
                }
            }
        }
    };
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #1a1c1a;
            background-color: #f9faf5;
            -webkit-font-smoothing: antialiased;
        }

        .dark body {
            background-color: #051125;
            color: #f8fafc;
        }

        /* Material Symbols optical styling */
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        /* Metric font */
        .font-metric {
            font-family: 'JetBrains Mono', monospace;
        }
        .font-headline {
            font-family: 'Space Grotesk', sans-serif;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }

        /* Pulsing indicator */
        .pulse-beacon {
            animation: beacon-pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes beacon-pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.15); }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-surface text-on-surface antialiased flex flex-col min-h-screen">

    <!-- 1. TOP UTILITY STRIP -->
    <header class="fixed top-0 left-0 w-full z-50 shadow-[0_2px_12px_rgba(0,0,0,0.08)] bg-white">
        <div class="w-full text-white" style="background: linear-gradient(90deg, #07153b 0%, #0d2a78 60%, #155dfc 100%);">
            <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 h-10 flex items-center justify-between font-metric text-[12px]">
                <div class="flex items-center gap-4">
                    <span class="hidden lg:flex items-center gap-1.5 text-secondary-fixed font-semibold">
                        <span class="material-symbols-outlined text-[16px]">electric_bolt</span>
                        <span>Líderes en Electromovilidad Perú</span>
                    </span>
                    <span class="hidden lg:inline text-white/30">|</span>
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $companyPhone) }}" class="flex items-center gap-1 text-slate-200 hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[15px] text-[#B39255]">call</span>
                        <span>{{ $companyPhone }}</span>
                    </a>
                    <span class="hidden sm:inline text-white/30">|</span>
                    <a href="mailto:{{ $supportEmail }}" class="hidden sm:flex items-center gap-1 text-slate-200 hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[15px] text-[#B39255]">mail</span>
                        <span>{{ $supportEmail }}</span>
                    </a>
                </div>

                <div class="flex items-center gap-4">
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20asesoria%20comercial%20de%20unidades" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1.5 text-[#25D366] hover:text-white transition-colors font-semibold">
                        <i class="fab fa-whatsapp text-[15px]"></i>
                        <span>WhatsApp: {{ $whatsappNumber }}</span>
                    </a>
                    <span class="hidden md:inline text-white/30">|</span>
                    <span class="hidden md:inline px-2.5 py-0.5 rounded text-[11px] font-semibold tracking-wider uppercase bg-[#1B263B] text-[#B39255] border border-[#B39255]/40">
                        DISTRIBUIDOR OFICIAL FACCHINI &amp; JMEV
                    </span>
                </div>
            </div>
        </div>

        <!-- 2. MAIN NAVIGATION BAR -->
        <div class="w-full bg-white/95 backdrop-blur-xl border-b border-slate-200">
            <div class="h-20 max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 flex items-center justify-between gap-4">
                
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                    <img src="{{ asset('images/logo/RODO.png') }}" alt="RODOPERU Logo" class="h-10 sm:h-12 w-auto object-contain transition-transform group-hover:scale-105 duration-300" onerror="this.outerHTML='<span class=\'font-headline text-2xl font-bold tracking-tight text-primary\'>RODO<span class=\'text-blue-600\'>PERU</span></span>'">
                    <div class="flex flex-col">
                        <span class="font-headline text-[20px] font-bold tracking-tight text-[#051125] leading-none uppercase">RODOPERU</span>
                        <span class="font-metric text-[10px] tracking-[0.2em] text-[#B39255] uppercase mt-1 font-semibold">Electromovilidad &amp; Carga</span>
                    </div>
                </a>

                <!-- Nav Links Desktop -->
                <nav class="hidden xl:flex items-center gap-1 font-body text-sm font-medium">
                    <a href="{{ route('home') }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request()->routeIs('home') ? 'bg-[#051125] text-white font-semibold shadow-sm' : 'text-slate-700 hover:text-primary hover:bg-slate-100' }}">
                        Inicio
                    </a>
                    <a href="{{ route('products.index', ['categoria' => 'vehiculos-electricos']) }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request('categoria') == 'vehiculos-electricos' ? 'bg-[#051125] text-white font-semibold' : 'text-slate-700 hover:text-primary hover:bg-slate-100' }}">
                        Vehículos Eléctricos
                    </a>
                    <a href="{{ route('products.index', ['categoria' => 'implementos-rodoviarios']) }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request('categoria') == 'implementos-rodoviarios' ? 'bg-[#051125] text-white font-semibold' : 'text-slate-700 hover:text-primary hover:bg-slate-100' }}">
                        Implementos Rodoviarios
                    </a>
                    <a href="{{ route('simulador') }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request()->routeIs('simulador') ? 'bg-[#051125] text-white font-semibold' : 'text-slate-700 hover:text-primary hover:bg-slate-100' }}">
                        Simulador de Ahorro
                    </a>
                    <a href="{{ route('empresa') }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request()->routeIs('empresa') ? 'bg-[#051125] text-white font-semibold' : 'text-slate-700 hover:text-primary hover:bg-slate-100' }}">
                        Empresa
                    </a>
                    <a href="{{ route('novedades.index') }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request()->routeIs('novedades*') ? 'bg-[#051125] text-white font-semibold' : 'text-slate-700 hover:text-primary hover:bg-slate-100' }}">
                        Novedades
                    </a>
                    <a href="{{ route('contacto') }}" class="px-3.5 py-2 rounded-lg transition-colors {{ request()->routeIs('contacto') ? 'bg-[#051125] text-white font-semibold' : 'text-slate-700 hover:text-primary hover:bg-slate-100' }}">
                        Contacto
                    </a>
                </nav>

                <!-- Action Strip Right -->
                <div class="flex items-center gap-2.5 sm:gap-3">
                    
                    <!-- Cotizar Button -->
                    <button type="button" onclick="openQuickQuoteModal()" class="hidden sm:inline-flex items-center justify-center gap-1.5 h-10 px-4 rounded bg-[#051125] text-white text-xs font-semibold hover:bg-[#1b263b] transition-all shadow-sm border border-[#051125]">
                        <span class="material-symbols-outlined text-[17px] text-[#B39255]">request_quote</span>
                        <span>Cotizar en Línea</span>
                    </button>

                    <!-- WhatsApp Advisor -->
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20comunicarme%20con%20un%20asesor%20comercial." target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-1.5 h-10 px-3.5 rounded bg-[#25D366] text-white text-xs font-semibold hover:bg-[#20bd5a] transition-all shadow-sm">
                        <i class="fab fa-whatsapp text-[16px]"></i>
                        <span class="hidden md:inline">Asesor WhatsApp</span>
                    </a>

                    <!-- Cart icon with badge -->
                    <a href="{{ route('cart.index') }}" class="relative w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-800 transition-colors" title="Carrito de Cotizaciones / Pedidos">
                        <span class="material-symbols-outlined text-[20px]">shopping_cart</span>
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-blue-600 text-white font-bold text-[10px] w-5 h-5 rounded-full flex items-center justify-center border-2 border-white shadow-sm">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- User Account Dropdown -->
                    <div class="relative group">
                        <button type="button" class="w-10 h-10 rounded-full bg-[#051125] text-white flex items-center justify-center hover:bg-[#1b263b] transition-colors" aria-label="Cuenta de usuario">
                            <span class="material-symbols-outlined text-[20px]">person</span>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-2 hidden group-hover:block z-50 font-body text-xs">
                            @auth
                                <div class="px-4 py-2 border-b border-slate-100">
                                    <p class="font-bold text-slate-800 truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-[11px] text-slate-500 truncate">{{ auth()->user()->email }}</p>
                                </div>
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-blue-700 hover:bg-blue-50 font-semibold">
                                        <span class="material-symbols-outlined text-[16px]">admin_panel_settings</span> Panel de Control
                                    </a>
                                @endif
                                <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-slate-700 hover:bg-slate-50">
                                    <span class="material-symbols-outlined text-[16px]">dashboard</span> Mi Cuenta
                                </a>
                                <a href="{{ route('customer.orders') }}" class="flex items-center gap-2 px-4 py-2 text-slate-700 hover:bg-slate-50">
                                    <span class="material-symbols-outlined text-[16px]">inventory_2</span> Mis Pedidos
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-100 mt-1">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50">
                                        <span class="material-symbols-outlined text-[16px]">logout</span> Cerrar Sesión
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2 text-slate-700 hover:bg-slate-50 font-semibold">
                                    <span class="material-symbols-outlined text-[16px]">login</span> Iniciar Sesión
                                </a>
                                <a href="{{ route('register') }}" class="flex items-center gap-2 px-4 py-2 text-slate-700 hover:bg-slate-50">
                                    <span class="material-symbols-outlined text-[16px]">person_add</span> Registrarse
                                </a>
                                <div class="border-t border-slate-100 my-1"></div>
                                <a href="{{ route('admin.login') }}" class="flex items-center gap-2 px-4 py-2 text-slate-500 hover:text-slate-800 hover:bg-slate-50">
                                    <span class="material-symbols-outlined text-[16px]">lock</span> Acceso Admin
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Mobile Menu Hamburger -->
                    <button type="button" onclick="toggleMobileNav()" class="xl:hidden w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-800 hover:bg-slate-200 transition-colors" aria-label="Abrir Menú">
                        <span class="material-symbols-outlined text-[24px]">menu</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div id="mobile-nav" class="hidden xl:hidden bg-white border-b border-slate-200 px-6 py-4 shadow-lg animate-fadeIn font-body text-sm space-y-2">
            <a href="{{ route('home') }}" class="block py-2 text-slate-800 font-semibold hover:text-blue-700">Inicio</a>
            <a href="{{ route('products.index', ['categoria' => 'vehiculos-electricos']) }}" class="block py-2 text-slate-800 font-semibold hover:text-blue-700">Vehículos 100% Eléctricos</a>
            <a href="{{ route('products.index', ['categoria' => 'implementos-rodoviarios']) }}" class="block py-2 text-slate-800 font-semibold hover:text-blue-700">Implementos Rodoviarios Facchini</a>
            <a href="{{ route('simulador') }}" class="block py-2 text-slate-800 font-semibold hover:text-blue-700">Simulador de Ahorro y ROI</a>
            <a href="{{ route('empresa') }}" class="block py-2 text-slate-800 font-semibold hover:text-blue-700">Empresa &amp; Respaldo</a>
            <a href="{{ route('novedades.index') }}" class="block py-2 text-slate-800 font-semibold hover:text-blue-700">Novedades &amp; Blog</a>
            <a href="{{ route('contacto') }}" class="block py-2 text-slate-800 font-semibold hover:text-blue-700">Contacto &amp; Sedes</a>
            <div class="pt-3 border-t border-slate-200 flex flex-col gap-2">
                <button type="button" onclick="openQuickQuoteModal()" class="w-full py-2.5 rounded bg-[#051125] text-white font-semibold text-center text-xs">
                    Cotizar en Línea
                </button>
                <a href="https://wa.me/{{ $whatsappClean }}" target="_blank" class="w-full py-2.5 rounded bg-[#25D366] text-white font-semibold text-center text-xs flex items-center justify-center gap-1.5">
                    <i class="fab fa-whatsapp"></i> WhatsApp Corporativo
                </a>
            </div>
        </div>
    </header>

    <!-- CONTENT WRAPPER -->
    <main class="w-full pt-[7.5rem] flex-grow">
        @if(session('success'))
            <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 mt-4">
                <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm font-body text-sm">
                    <span class="material-symbols-outlined text-emerald-600 text-[22px]">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 mt-4">
                <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm font-body text-sm">
                    <span class="material-symbols-outlined text-red-600 text-[22px]">error</span>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="w-full bg-[#051125] text-white mt-20 border-t border-slate-800" style="background: linear-gradient(135deg, #051125 0%, #0d1b33 60%, #15274d 100%);">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-white/10">
                
                <!-- Col 1: Brand & Credentials -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo/RODO.png') }}" alt="RODOPERU" class="h-10 w-auto object-contain brightness-0 invert" onerror="this.style.display='none'">
                        <span class="font-headline text-2xl text-white uppercase tracking-tight font-bold">RODOPERU S.A.C.</span>
                    </div>
                    <p class="font-body text-sm text-slate-300 max-w-md leading-relaxed">
                        Líderes estratégicos en transporte sostenible e implementos de alta resistencia para minería, agroindustria y logística pesada en todo el Perú. Representantes oficiales de Facchini y pioneros en flotas comerciales 100% eléctricas JMEV.
                    </p>
                    <div class="flex flex-wrap items-center gap-2 pt-2">
                        <span class="px-2.5 py-1 rounded bg-white/10 text-[#ffdea6] font-metric text-xs border border-[#ffdea6]/30">FACCHINI PERÚ</span>
                        <span class="px-2.5 py-1 rounded bg-white/10 text-[#ffdea6] font-metric text-xs border border-[#ffdea6]/30">JMEV ELECTROMOVILIDAD</span>
                        <span class="px-2.5 py-1 rounded bg-white/10 text-[#ffdea6] font-metric text-xs border border-[#ffdea6]/30">ISO 9001:2015</span>
                    </div>
                </div>

                <!-- Col 2: Modelos Eléctricos -->
                <div class="space-y-3">
                    <h4 class="font-headline text-white uppercase tracking-wider text-sm font-bold text-[#ffdea6]">Modelos Eléctricos</h4>
                    <ul class="space-y-2 font-body text-xs text-slate-300">
                        <li><a href="{{ route('products.index', ['categoria' => 'vehiculos-electricos']) }}" class="hover:text-white transition-colors">JMEV EV-2 Urban Delivery</a></li>
                        <li><a href="{{ route('products.index', ['categoria' => 'vehiculos-electricos']) }}" class="hover:text-white transition-colors">RODO EV-600 Grand SUV</a></li>
                        <li><a href="{{ route('products.index', ['categoria' => 'vehiculos-electricos']) }}" class="hover:text-white transition-colors">Cargo E-Van 1.5T Utilitario</a></li>
                        <li><a href="{{ route('products.index', ['categoria' => 'vehiculos-electricos']) }}" class="hover:text-white transition-colors">Camiones BYD Commercial</a></li>
                        <li><a href="{{ route('simulador') }}" class="hover:text-white transition-colors">Simulador de Ahorro y ROI</a></li>
                    </ul>
                </div>

                <!-- Col 3: Implementos Facchini -->
                <div class="space-y-3">
                    <h4 class="font-headline text-white uppercase tracking-wider text-sm font-bold text-[#ffdea6]">Implementos Facchini</h4>
                    <ul class="space-y-2 font-body text-xs text-slate-300">
                        <li><a href="{{ route('products.index', ['categoria' => 'implementos-rodoviarios']) }}" class="hover:text-white transition-colors">Semirremolques Furgón 3 Ejes</a></li>
                        <li><a href="{{ route('products.index', ['categoria' => 'implementos-rodoviarios']) }}" class="hover:text-white transition-colors">Tolvas Mineras Acero Hardox 450</a></li>
                        <li><a href="{{ route('products.index', ['categoria' => 'implementos-rodoviarios']) }}" class="hover:text-white transition-colors">Plataformas Multimodal Porta-Contenedor</a></li>
                        <li><a href="{{ route('products.index', ['categoria' => 'implementos-rodoviarios']) }}" class="hover:text-white transition-colors">Cisternas Combustible 10,000 Gal</a></li>
                        <li><a href="{{ route('contacto') }}" class="hover:text-white transition-colors">Repuestos y Soporte Postventa</a></li>
                    </ul>
                </div>

                <!-- Col 4: Sede Central -->
                <div class="space-y-3">
                    <h4 class="font-headline text-white uppercase tracking-wider text-sm font-bold text-[#ffdea6]">Contacto &amp; Planta</h4>
                    <div class="space-y-2.5 font-body text-xs text-slate-300">
                        <div class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-[18px] text-[#ffdea6] shrink-0">location_on</span>
                            <span>Av. Evitamiento Km 8.5, Zona Industrial, Ate - Lima, Perú</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-[#ffdea6] shrink-0">call</span>
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', $companyPhone) }}" class="hover:text-white transition-colors">{{ $companyPhone }}</a>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-[#ffdea6] shrink-0">mail</span>
                            <a href="mailto:{{ $supportEmail }}" class="hover:text-white transition-colors">{{ $supportEmail }}</a>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-[#ffdea6] shrink-0">schedule</span>
                            <span>Lun - Vie: 08:30 - 18:00 | Sáb: 09:00 - 13:00</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Legal Bar -->
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 font-body text-xs text-slate-400">
                <div class="flex flex-wrap items-center gap-4">
                    <span class="font-metric text-[#ffdea6] font-semibold">RUC: 20601234567</span>
                    <span>&copy; {{ date('Y') }} RODOPERU S.A.C. Todos los derechos reservados.</span>
                    <span class="px-2 py-0.5 rounded bg-slate-800 text-slate-300 font-metric text-[10px] font-semibold border border-slate-700">v2.0</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('contacto') }}" class="hover:text-white transition-colors flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">menu_book</span>
                        <span>Libro de Reclamaciones</span>
                    </a>
                    <span>|</span>
                    <a href="{{ route('admin.login') }}" class="hover:text-white transition-colors">Acceso Administrativo</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Action Button -->
    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20asesoria%20comercial%20inmediata" target="_blank" rel="noopener noreferrer" class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-[#25D366] text-white rounded-full shadow-[0_8px_24px_rgba(37,211,102,0.4)] hover:scale-110 active:scale-95 transition-all flex items-center justify-center group" aria-label="WhatsApp Directo">
        <i class="fab fa-whatsapp text-2xl group-hover:rotate-12 transition-transform"></i>
    </a>

    <!-- QUICK QUOTE MODAL (Cotizar en Línea) -->
    <div id="quickQuoteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75 backdrop-blur-sm hidden">
        <div class="relative w-full max-w-lg bg-white rounded-2xl p-6 sm:p-8 shadow-2xl font-body">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div>
                    <span class="font-metric text-xs uppercase text-[#B39255] font-bold">Atención Comercial B2B</span>
                    <h3 class="font-headline text-xl font-bold text-[#051125]">Cotizar Unidades &amp; Flotas</h3>
                </div>
                <button type="button" onclick="closeQuickQuoteModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            
            <form onsubmit="handleQuickQuote(event)" class="mt-4 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Nombre o Razón Social *</label>
                    <input type="text" id="quoteName" required class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-sm" placeholder="Ej. Transportes Los Andes S.A.C.">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Teléfono / WhatsApp *</label>
                        <input type="tel" id="quotePhone" required class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-sm" placeholder="Ej. 987654321">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Correo Electrónico</label>
                        <input type="email" id="quoteEmail" class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-sm" placeholder="contacto@empresa.pe">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Equipo de Interés *</label>
                    <select id="quoteEquipment" required class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-sm bg-white">
                        <option value="JMEV EV-2 Urban City Car">JMEV EV-2 Urban City Car (100% Eléctrico)</option>
                        <option value="RODO EV-600 Grand SUV">RODO EV-600 Grand SUV Ejecutivo</option>
                        <option value="Cargo E-Van 1.5T Utilitario">RODO Cargo E-Van 1.5T Utilitario</option>
                        <option value="Camión Ligero BYD 4.5T">Camión Ligero RODO E-Truck / BYD 4.5T</option>
                        <option value="Semirremolque Furgón Facchini 3 Ejes">Semirremolque Furgón Facchini 3 Ejes (105 m³)</option>
                        <option value="Tolva Basculante Media Caña 35m3 Facchini">Tolva Basculante Media Caña 35m³ Facchini Hardox</option>
                        <option value="Plataforma Multimodal Porta Contenedor Facchini">Plataforma Multimodal Porta Contenedor Facchini</option>
                        <option value="Cisterna Combustible 10,000 Gal Facchini">Cisterna Combustible 10,000 Gal Facchini</option>
                        <option value="Otra configuración o flota personalizada">Otra Consulta o Flota Personalizada</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Detalle o Cantidad de Unidades</label>
                    <textarea id="quoteMessage" rows="2" class="w-full p-3 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-sm" placeholder="Indíquenos ruta de operación o número de unidades..."></textarea>
                </div>

                <div class="pt-2 flex gap-3">
                    <button type="submit" class="flex-1 py-3 rounded-xl bg-[#25D366] hover:bg-[#20bd5a] text-white font-semibold text-sm flex items-center justify-center gap-2 shadow-md transition-all">
                        <i class="fab fa-whatsapp text-lg"></i>
                        <span>Enviar a Asesor por WhatsApp</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- TECHNICAL SPECIFICATION MODAL (Ficha Técnica) -->
    <div id="specModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75 backdrop-blur-sm hidden">
        <div class="relative w-full max-w-2xl bg-white rounded-2xl p-6 sm:p-8 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto font-body">
            <div class="flex items-center justify-between pb-4 border-b border-slate-200">
                <div>
                    <span class="font-metric text-xs uppercase text-[#B39255] font-bold" id="specModalSku">SKU: ---</span>
                    <h3 class="font-headline text-xl sm:text-2xl font-bold text-[#051125]" id="specModalTitle">Modelo Vehicular</h3>
                </div>
                <button type="button" onclick="closeSpecModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            
            <p class="text-slate-600 text-sm leading-relaxed" id="specModalDesc">
                Especificaciones homologadas para el mercado peruano.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-4 rounded-xl bg-slate-50 border border-slate-100" id="specModalGrid">
                <!-- Injected via JS -->
            </div>

            <div class="pt-3 flex flex-col sm:flex-row justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="closeSpecModal()" class="px-4 py-2.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs">
                    Cerrar
                </button>
                <a href="#" id="specModalWhatsAppBtn" target="_blank" class="px-5 py-2.5 rounded-lg bg-[#25D366] hover:bg-[#20bd5a] text-white font-semibold text-xs flex items-center justify-center gap-2 shadow-sm">
                    <i class="fab fa-whatsapp text-sm"></i>
                    <span>Solicitar Cotización Formal</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function toggleMobileNav() {
            const nav = document.getElementById('mobile-nav');
            nav.classList.toggle('hidden');
        }

        function openQuickQuoteModal(prefillEquipment) {
            if (prefillEquipment) {
                const select = document.getElementById('quoteEquipment');
                if (select) select.value = prefillEquipment;
            }
            document.getElementById('quickQuoteModal').classList.remove('hidden');
        }

        function closeQuickQuoteModal() {
            document.getElementById('quickQuoteModal').classList.add('hidden');
        }

        function handleQuickQuote(e) {
            e.preventDefault();
            const name = document.getElementById('quoteName').value.trim();
            const phone = document.getElementById('quotePhone').value.trim();
            const email = document.getElementById('quoteEmail').value.trim();
            const equipment = document.getElementById('quoteEquipment').value;
            const msg = document.getElementById('quoteMessage').value.trim();

            let waText = `¡Hola RODOPERU! 👋 Mi nombre / empresa es *${name}* (Teléfono: ${phone}${email ? ', Email: ' + email : ''}).\n\n`;
            waText += `Deseo cotizar el equipo: *${equipment}*.\n`;
            if (msg) {
                waText += `Detalles del requerimiento: ${msg}\n`;
            }
            waText += `\nSolicito disponibilidad y proforma oficial. ¡Muchas gracias!`;

            const url = `https://wa.me/{{ $whatsappClean }}?text=${encodeURIComponent(waText)}`;
            window.open(url, '_blank');
            closeQuickQuoteModal();
        }

        function openSpecModalData(sku, title, desc, specsArray) {
            document.getElementById('specModalSku').innerText = 'SKU: ' + sku;
            document.getElementById('specModalTitle').innerText = title;
            document.getElementById('specModalDesc').innerText = desc;

            const grid = document.getElementById('specModalGrid');
            grid.innerHTML = '';
            
            if (Array.isArray(specsArray)) {
                specsArray.forEach(s => {
                    const el = document.createElement('div');
                    el.className = 'py-1.5 px-3 bg-white rounded-lg border border-slate-100';
                    el.innerHTML = `
                        <span class="block font-metric text-[11px] text-slate-500 uppercase">${s.key || s[0]}</span>
                        <span class="font-headline text-xs font-bold text-[#051125]">${s.value || s[1]}</span>
                    `;
                    grid.appendChild(el);
                });
            }

            const waBtn = document.getElementById('specModalWhatsAppBtn');
            waBtn.href = `https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20cotizacion%20y%20ficha%20tecnica%20de%20${encodeURIComponent(title)}%20(SKU:%20${encodeURIComponent(sku)})`;

            document.getElementById('specModal').classList.remove('hidden');
        }

        function closeSpecModal() {
            document.getElementById('specModal').classList.add('hidden');
        }
    </script>

    @stack('scripts')
</body>
</html>
