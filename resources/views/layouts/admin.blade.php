<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Panel de Control') | RODOPERU Control Panel</title>

    <link rel="icon" type="image/png" href="{{ asset(\App\Models\Setting::get('favicon_path', 'favicon.png')) }}">

    <!-- Google Fonts: Space Grotesk, Inter, JetBrains Mono (Stitch Design Tokens) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600;700&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    
    <!-- Bootstrap 5.3 & FontAwesome 6 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            /* Stitch Executive Palette */
            --admin-navy-dark: #030c1c;
            --admin-navy-primary: #051125;
            --admin-navy-card: #0b172d;
            --admin-navy-surface: #0f1e3a;
            --admin-border: #1a2a44;
            --admin-border-light: #25395c;
            --gold-primary: #B39255;
            --gold-light: #ffdea6;
            --gold-hover: #c4a466;
            --electric-blue: #0284c7;
            --electric-cyan: #38bdf8;
            --success-green: #10b981;
            --warning-amber: #f59e0b;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--admin-navy-dark);
            color: #f1f5f9;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6, .brand-font, .font-headline {
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: -0.02em;
        }

        .font-metric, code, .font-monospace, th, .badge, .sku-pill {
            font-family: 'JetBrains Mono', monospace;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 20;
            vertical-align: middle;
        }

        /* Sidebar Styling */
        .admin-sidebar {
            width: 275px;
            background-color: var(--admin-navy-dark);
            border-right: 1px solid var(--admin-border);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1020;
            overflow-y: auto;
            transition: all 0.3s;
        }

        .admin-sidebar .sidebar-brand {
            padding: 22px 20px;
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            text-decoration: none;
            background: linear-gradient(180deg, rgba(5,17,37,0.8) 0%, rgba(3,12,28,0.95) 100%);
        }

        .admin-sidebar .sidebar-heading {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--gold-primary);
            padding: 18px 22px 6px 22px;
            font-weight: 700;
        }

        .admin-sidebar .nav-link {
            color: #94a3b8;
            font-size: 0.86rem;
            font-weight: 500;
            padding: 10px 22px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .admin-sidebar .nav-link:hover {
            color: #ffffff;
            background-color: #0b172d;
            border-left-color: rgba(179, 146, 85, 0.4);
        }

        .admin-sidebar .nav-link.active {
            color: var(--gold-light);
            background: linear-gradient(90deg, rgba(179,146,85,0.15) 0%, rgba(11,23,45,0.7) 100%);
            border-left-color: var(--gold-primary);
            font-weight: 600;
        }

        .admin-main {
            margin-left: 275px;
            padding: 25px 30px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: radial-gradient(circle at 80% 10%, rgba(11,23,45,0.6) 0%, rgba(3,12,28,1) 70%);
        }

        .admin-header {
            background-color: var(--admin-navy-card);
            border: 1px solid var(--admin-border);
            border-radius: 16px;
            padding: 14px 24px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
        }

        .card-custom {
            background-color: var(--admin-navy-card);
            border: 1px solid var(--admin-border);
            border-radius: 16px;
            color: #ffffff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .card-custom .card-header {
            background-color: rgba(255, 255, 255, 0.02);
            border-bottom: 1px solid var(--admin-border);
            padding: 18px 24px;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        .table-dark-custom {
            --bs-table-bg: transparent;
            --bs-table-striped-bg: rgba(255, 255, 255, 0.015);
            --bs-table-hover-bg: rgba(179, 146, 85, 0.06);
            color: #e2e8f0;
            border-color: var(--admin-border);
        }

        .table-dark-custom th {
            color: var(--gold-primary);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid var(--admin-border);
            padding: 14px 16px;
        }

        .table-dark-custom td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--admin-border);
        }

        .form-control, .form-select {
            background-color: #060f1e;
            border: 1px solid var(--admin-border-light);
            color: #ffffff;
            border-radius: 10px;
            font-size: 0.88rem;
        }

        .form-control:focus, .form-select:focus {
            background-color: #09152b;
            border-color: var(--gold-primary);
            color: #ffffff;
            box-shadow: 0 0 0 3px rgba(179, 146, 85, 0.25);
        }

        /* Stitch Buttons */
        .btn-electric {
            background: linear-gradient(135deg, var(--gold-primary) 0%, #d4ad65 100%);
            color: #051125;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            transition: all 0.2s;
        }
        .btn-electric:hover {
            color: #000;
            box-shadow: 0 4px 18px rgba(179, 146, 85, 0.4);
            transform: translateY(-1px);
        }

        .btn-outline-info {
            border: 1px solid rgba(179, 146, 85, 0.5);
            color: var(--gold-light);
            background: transparent;
            border-radius: 10px;
            transition: all 0.2s;
        }
        .btn-outline-info:hover {
            background: var(--gold-primary);
            color: #051125;
            border-color: var(--gold-primary);
        }

        .btn-outline-secondary {
            border-color: var(--admin-border-light);
            color: #cbd5e1;
            border-radius: 10px;
        }
        .btn-outline-secondary:hover {
            background-color: #1b263b;
            color: #ffffff;
            border-color: var(--gold-primary);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
        }
        ::-webkit-scrollbar-track {
            background: #030c1c;
        }
        ::-webkit-scrollbar-thumb {
            background: #1b2942;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #B39255;
        }

        @media (max-width: 992px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            .admin-sidebar.show {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
                padding: 16px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- 1. Admin Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <div class="d-flex align-items-center gap-2">
                <img src="{{ asset(\App\Models\Setting::get('logo_path', 'images/logo/RODO.png')) }}" alt="RODOPERU" height="34" style="object-fit: contain;">
            </div>
            <div>
                <span class="badge" style="background: rgba(179,146,85,0.18); color: var(--gold-light); border: 1px solid rgba(179,146,85,0.4); font-size: 0.65rem; letter-spacing: 1px;">ADMIN</span>
            </div>
        </a>

        <div class="sidebar-heading">Principal</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <span class="material-symbols-outlined text-warning" style="font-size: 19px;">dashboard</span>
                    <span>Dashboard General</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-heading">Catálogo & Comercio</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                    <span class="material-symbols-outlined text-info" style="font-size: 19px;">inventory_2</span>
                    <span>Productos &amp; Stock</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                    <span class="material-symbols-outlined text-info" style="font-size: 19px;">category</span>
                    <span>Categorías</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}" href="{{ route('admin.brands.index') }}">
                    <span class="material-symbols-outlined text-info" style="font-size: 19px;">loyalty</span>
                    <span>Marcas</span>
                </a>
            </li>
            <li class="nav-item">
                @php
                    $pendingOrdersCount = \App\Models\Order::where('order_status', 'pending')->count();
                @endphp
                <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }} d-flex justify-content-between align-items-center" href="{{ route('admin.orders.index') }}">
                    <div class="d-flex align-items-center gap-2">
                        <span class="material-symbols-outlined text-warning" style="font-size: 19px;">shopping_cart</span>
                        <span>Pedidos</span>
                    </div>
                    @if($pendingOrdersCount > 0)
                        <span class="badge font-metric" style="background: var(--gold-primary); color: #051125; font-weight: 700;">{{ $pendingOrdersCount }}</span>
                    @endif
                </a>
            </li>
        </ul>

        <div class="sidebar-heading">Clientes & Analítica</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}">
                    <span class="material-symbols-outlined text-primary" style="font-size: 19px;">group</span>
                    <span>Gestión de Clientes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}" href="{{ route('admin.analytics.searches') }}">
                    <span class="material-symbols-outlined text-success" style="font-size: 19px;">analytics</span>
                    <span>Analítica de Búsquedas</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-heading">Atención & Chat en Vivo</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                @php
                    $unreadChats = \App\Models\ChatConversation::whereIn('status', ['open', 'in_progress'])->count();
                @endphp
                <a class="nav-link {{ request()->routeIs('admin.chats.*') ? 'active' : '' }} d-flex justify-content-between align-items-center" href="{{ route('admin.chats.index') }}">
                    <div class="d-flex align-items-center gap-2">
                        <span class="material-symbols-outlined text-info" style="font-size: 19px;">forum</span>
                        <span>Chat con Clientes</span>
                    </div>
                    @if($unreadChats > 0)
                        <span class="badge bg-danger font-metric">{{ $unreadChats }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                @php
                    $unreadInquiries = \App\Models\ContactInquiry::where('is_read', false)->count();
                @endphp
                <a class="nav-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }} d-flex justify-content-between align-items-center" href="{{ route('admin.inquiries.index') }}">
                    <div class="d-flex align-items-center gap-2">
                        <span class="material-symbols-outlined text-info" style="font-size: 19px;">mail</span>
                        <span>Cotizaciones Web</span>
                    </div>
                    @if($unreadInquiries > 0)
                        <span class="badge bg-info text-dark font-metric">{{ $unreadInquiries }}</span>
                    @endif
                </a>
            </li>
        </ul>

        <div class="sidebar-heading">Marketing & Contenido</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}" href="{{ route('admin.sliders.index') }}">
                    <span class="material-symbols-outlined text-light" style="font-size: 19px;">view_carousel</span>
                    <span>Sliders Principales</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}" href="{{ route('admin.banners.index') }}">
                    <span class="material-symbols-outlined text-light" style="font-size: 19px;">ad_units</span>
                    <span>Banners &amp; Popups</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}" href="{{ route('admin.articles.index') }}">
                    <span class="material-symbols-outlined text-light" style="font-size: 19px;">article</span>
                    <span>Novedades / Blog</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-heading">Ajustes del Sistema</div>
        <ul class="nav flex-column mb-4">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                    <span class="material-symbols-outlined text-warning" style="font-size: 19px;">settings</span>
                    <span>Configuración General</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-warning" href="{{ route('home') }}" target="_blank">
                    <span class="material-symbols-outlined" style="font-size: 19px;">open_in_new</span>
                    <span>Ver Sitio Oficial</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- 2. Main Admin Area -->
    <div class="admin-main">
        <!-- Admin Topbar -->
        <header class="admin-header">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-outline-secondary d-lg-none" id="sidebarToggle" aria-label="Abrir menú">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h4 class="mb-0 text-white font-weight-bold font-headline">@yield('page_title', 'Panel de Control')</h4>
                    <small class="font-metric text-muted" style="font-size: 0.72rem;">RODOPERU Control Center &bull; Edición Ejecutiva</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-info d-none d-sm-inline-flex align-items-center gap-1.5">
                    <span class="material-symbols-outlined" style="font-size: 16px;">storefront</span>
                    <span>Ver Tienda</span>
                </a>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle text-white border-secondary d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                        <span class="material-symbols-outlined text-warning" style="font-size: 18px;">admin_panel_settings</span>
                        <span>{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow-lg" style="background-color: #0b172d; border-color: var(--admin-border);">
                        <li>
                            <div class="px-3 py-2 border-bottom" style="border-color: var(--admin-border) !important;">
                                <div class="font-bold text-white small">{{ Auth::user()->name }}</div>
                                <div class="font-metric text-muted" style="font-size: 0.72rem;">{{ Auth::user()->email }}</div>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('admin.settings.index') }}">
                                <span class="material-symbols-outlined text-muted" style="font-size: 18px;">settings</span>
                                <span>Configuración</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider" style="border-color: var(--admin-border);"></li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger py-2 d-flex align-items-center gap-2">
                                    <span class="material-symbols-outlined" style="font-size: 18px;">logout</span>
                                    <span>Cerrar Sesión</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Flash messages inside admin -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 text-white shadow-sm mb-4" role="alert" style="background-color: #065f46; border-radius: 12px;">
                <i class="fas fa-check-circle me-2 text-warning"></i> {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 text-white shadow-sm mb-4" role="alert" style="background-color: #991b1b; border-radius: 12px;">
                <i class="fas fa-exclamation-triangle me-2 text-warning"></i> {{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(isset($errors) && $errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0 text-white shadow-sm mb-4" role="alert" style="background-color: #991b1b; border-radius: 12px;">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li><i class="fas fa-times-circle me-1"></i> {{ $err }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Content -->
        <main class="flex-grow-1">
            @yield('content')
        </main>

        <footer class="mt-5 py-3 border-top border-secondary text-muted text-center" style="font-size: 0.8rem; border-color: var(--admin-border) !important;">
            <span class="font-metric text-[#ffdea6]">&copy; {{ date('Y') }} RODOPERU S.A.C.</span> &bull; Panel de Administración Ejecutivo &bull; Versión 2.0
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const adminSidebar = document.getElementById('adminSidebar');
        if (sidebarToggle && adminSidebar) {
            sidebarToggle.addEventListener('click', () => {
                adminSidebar.classList.toggle('show');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
