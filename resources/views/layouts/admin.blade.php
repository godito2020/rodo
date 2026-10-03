<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Panel de Control') | RODOPERU Admin</title>

    <link rel="icon" type="image/png" href="{{ asset(\App\Models\Setting::get('favicon_path', 'favicon.png')) }}">

    <!-- Google Fonts & Bootstrap 5.3 -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Rajdhani:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --sidebar-bg: #0b1329;
            --sidebar-hover: #152243;
            --admin-body-bg: #070d1e;
            --admin-card-bg: #111a31;
            --admin-border: #1e2c4d;
            --electric-cyan: #00f2fe;
            --electric-blue: #4facfe;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--admin-body-bg);
            color: #f1f5f9;
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6, .brand-font {
            font-family: 'Rajdhani', sans-serif;
            letter-spacing: 0.5px;
        }

        .admin-sidebar {
            width: 270px;
            background-color: var(--sidebar-bg);
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
            gap: 12px;
            text-decoration: none;
        }

        .admin-sidebar .sidebar-heading {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #64748b;
            padding: 16px 22px 6px 22px;
            font-weight: 700;
        }

        .admin-sidebar .nav-link {
            color: #94a3b8;
            font-size: 0.88rem;
            font-weight: 500;
            padding: 10px 22px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .admin-sidebar .nav-link:hover, .admin-sidebar .nav-link.active {
            color: #ffffff;
            background-color: var(--sidebar-hover);
            border-left-color: var(--electric-cyan);
        }

        .admin-sidebar .nav-link.active {
            color: var(--electric-cyan);
            font-weight: 600;
        }

        .admin-main {
            margin-left: 270px;
            padding: 25px 30px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .admin-header {
            background-color: var(--sidebar-bg);
            border: 1px solid var(--admin-border);
            border-radius: 12px;
            padding: 14px 24px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-custom {
            background-color: var(--admin-card-bg);
            border: 1px solid var(--admin-border);
            border-radius: 12px;
            color: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
        }

        .card-custom .card-header {
            background-color: rgba(255, 255, 255, 0.02);
            border-bottom: 1px solid var(--admin-border);
            padding: 16px 20px;
            font-weight: 700;
        }

        .table-dark-custom {
            --bs-table-bg: transparent;
            --bs-table-striped-bg: rgba(255, 255, 255, 0.02);
            --bs-table-hover-bg: rgba(0, 242, 254, 0.05);
            color: #e2e8f0;
            border-color: var(--admin-border);
        }

        .table-dark-custom th {
            color: #94a3b8;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid var(--admin-border);
        }

        .form-control, .form-select {
            background-color: #0b1428;
            border: 1px solid var(--admin-border);
            color: #ffffff;
        }
        .form-control:focus, .form-select:focus {
            background-color: #0e1a34;
            border-color: var(--electric-cyan);
            color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 242, 254, 0.2);
        }

        .btn-electric {
            background: linear-gradient(135deg, var(--electric-cyan) 0%, var(--electric-blue) 100%);
            color: #070d1e;
            font-weight: 700;
            border: none;
        }
        .btn-electric:hover {
            color: #000;
            box-shadow: 0 0 15px rgba(0, 242, 254, 0.4);
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
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- 1. Admin Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <img src="{{ asset(\App\Models\Setting::get('logo_path', 'images/logo/RODO.png')) }}" alt="RODOPERU" height="38">
            <div>
                <span class="badge bg-danger ms-1" style="font-size: 0.65rem;">ADMIN PANEL</span>
            </div>
        </a>

        <div class="sidebar-heading">Principal</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-chart-line text-info"></i> Dashboard General
                </a>
            </li>
        </ul>

        <div class="sidebar-heading">Catálogo & Comercio</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                    <i class="fas fa-boxes text-info"></i> Productos & Stock
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-layer-group text-info"></i> Categorías
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}" href="{{ route('admin.brands.index') }}">
                    <i class="fas fa-tags text-info"></i> Marcas
                </a>
            </li>
            <li class="nav-item">
                @php
                    $pendingOrdersCount = \App\Models\Order::where('order_status', 'pending')->count();
                @endphp
                <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }} d-flex justify-content-between align-items-center" href="{{ route('admin.orders.index') }}">
                    <div><i class="fas fa-shopping-bag text-warning"></i> Pedidos</div>
                    @if($pendingOrdersCount > 0)
                        <span class="badge bg-warning text-dark fw-bold">{{ $pendingOrdersCount }}</span>
                    @endif
                </a>
            </li>
        </ul>

        <div class="sidebar-heading">Clientes & Analítica</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}">
                    <i class="fas fa-users text-primary"></i> Gestión de Clientes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}" href="{{ route('admin.analytics.searches') }}">
                    <i class="fas fa-search-dollar text-success"></i> Analítica de Búsquedas
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
                    <div><i class="fas fa-comments text-info"></i> Chat con Clientes</div>
                    @if($unreadChats > 0)
                        <span class="badge bg-danger">{{ $unreadChats }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                @php
                    $unreadInquiries = \App\Models\ContactInquiry::where('is_read', false)->count();
                @endphp
                <a class="nav-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }} d-flex justify-content-between align-items-center" href="{{ route('admin.inquiries.index') }}">
                    <div><i class="fas fa-envelope text-info"></i> Mensajes & Cotizaciones</div>
                    @if($unreadInquiries > 0)
                        <span class="badge bg-info text-white">{{ $unreadInquiries }}</span>
                    @endif
                </a>
            </li>
        </ul>

        <div class="sidebar-heading">Marketing & Contenido</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}" href="{{ route('admin.sliders.index') }}">
                    <i class="fas fa-images text-light"></i> Sliders Principales
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}" href="{{ route('admin.banners.index') }}">
                    <i class="fas fa-ad text-light"></i> Banners & Popups
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}" href="{{ route('admin.articles.index') }}">
                    <i class="fas fa-newspaper text-light"></i> Novedades / Blog
                </a>
            </li>
        </ul>

        <div class="sidebar-heading">Ajustes del Sistema</div>
        <ul class="nav flex-column mb-4">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                    <i class="fas fa-cogs text-warning"></i> Configuración General
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-info" href="{{ route('home') }}" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Ver Tienda Online
                </a>
            </li>
        </ul>
    </aside>

    <!-- 2. Main Admin Area -->
    <div class="admin-main">
        <!-- Admin Topbar -->
        <header class="admin-header">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-outline-secondary d-lg-none" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h4 class="mb-0 text-white font-weight-bold">@yield('page_title', 'Panel de Control')</h4>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-info">
                    <i class="fas fa-store me-1"></i> Ir a la Web
                </a>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle text-white border-secondary" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-shield text-info me-1"></i> {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="fas fa-cog me-2"></i> Configuración</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Flash messages inside admin -->
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

        <!-- Content -->
        <main class="flex-grow-1">
            @yield('content')
        </main>

        <footer class="mt-5 py-3 border-top border-secondary text-muted text-center" style="font-size: 0.82rem;">
            &copy; {{ date('Y') }} RODOPERU Control Panel &bull; Compatible con cPanel & MySQL &bull; Versión 2.0
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
