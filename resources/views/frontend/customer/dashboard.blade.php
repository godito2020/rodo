@extends('layouts.app')

@section('title', 'Mi Cuenta | Panel de Cliente RODOPERU')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
@endphp

@section('content')
<div class="py-4" style="background: #091022; border-bottom: 1px solid var(--border-dark);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Panel de Cliente</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold text-white mb-0">Bienvenido, {{ $user->name }}</h1>
                <small class="text-muted">{{ $user->email }} &bull; {{ $user->company_name ?: 'Cliente Particular' }}</small>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline-electric btn-sm">
                <i class="fas fa-shopping-bag me-1"></i> Seguir Comprando
            </a>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Sidebar Navigation -->
            <div class="col-lg-3">
                <div class="p-3 rounded-3 border border-secondary" style="background: #0f182e;">
                    <div class="nav flex-column nav-pills gap-1">
                        <a href="{{ route('customer.dashboard') }}" class="nav-link active bg-primary text-white fw-bold">
                            <i class="fas fa-tachometer-alt me-2"></i> Resumen
                        </a>
                        <a href="{{ route('customer.orders') }}" class="nav-link text-light hover-cyan">
                            <i class="fas fa-box me-2 text-info"></i> Mis Pedidos
                        </a>
                        <a href="{{ route('customer.chats') }}" class="nav-link text-light hover-cyan">
                            <i class="fas fa-comments me-2 text-info"></i> Mis Consultas & Chats
                        </a>
                        <a href="{{ route('customer.profile') }}" class="nav-link text-light hover-cyan">
                            <i class="fas fa-user-edit me-2 text-info"></i> Mi Perfil y Clave
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- Stat Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3 col-6">
                        <div class="p-3 rounded-3 border border-secondary bg-dark text-center">
                            <i class="fas fa-shopping-cart text-info fs-3 mb-1"></i>
                            <div class="h3 text-white fw-bold mb-0">{{ $totalOrders }}</div>
                            <small class="text-muted">Total Pedidos</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="p-3 rounded-3 border border-warning bg-dark text-center">
                            <i class="fas fa-clock text-warning fs-3 mb-1"></i>
                            <div class="h3 text-warning fw-bold mb-0">{{ $pendingOrders }}</div>
                            <small class="text-muted">Pendientes</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="p-3 rounded-3 border border-success bg-dark text-center">
                            <i class="fas fa-check-circle text-success fs-3 mb-1"></i>
                            <div class="h3 text-success fw-bold mb-0">{{ $completedOrders }}</div>
                            <small class="text-muted">Entregados</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="p-3 rounded-3 border border-info bg-dark text-center">
                            <i class="fas fa-comments text-info fs-3 mb-1"></i>
                            <div class="h3 text-info fw-bold mb-0">{{ $totalChats }}</div>
                            <small class="text-muted">Consultas Activas</small>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="card-custom mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="text-white"><i class="fas fa-history text-info me-2"></i> Pedidos Recientes</span>
                        <a href="{{ route('customer.orders') }}" class="text-info small text-decoration-none">Ver todos &rarr;</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped align-middle mb-0" style="font-size: 0.9rem;">
                            <thead>
                                <tr>
                                    <th>N° de Pedido</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Pago</th>
                                    <th class="text-end">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $ord)
                                    <tr>
                                        <td class="font-monospace fw-bold text-info">{{ $ord->order_number }}</td>
                                        <td class="text-muted">{{ $ord->created_at?->format('d/m/Y H:i') }}</td>
                                        <td class="text-white fw-bold">{{ $currency }} {{ number_format($ord->total, 2) }}</td>
                                        <td>{!! $ord->status_badge !!}</td>
                                        <td>{!! $ord->payment_badge !!}</td>
                                        <td class="text-end">
                                            <a href="{{ route('customer.order_detail', $ord->order_number) }}" class="btn btn-sm btn-outline-info">
                                                Ver Detalle
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">No tienes pedidos registrados todavía.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Chats with Seller -->
                <div class="card-custom">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="text-white"><i class="fas fa-comments text-info me-2"></i> Mis Conversaciones con Asesores de Ventas</span>
                        <a href="{{ route('customer.chats') }}" class="text-info small text-decoration-none">Ver todos los chats &rarr;</a>
                    </div>
                    <div class="p-3">
                        @forelse($recentChats as $ch)
                            <a href="{{ route('customer.chat_show', $ch->id) }}" class="d-flex justify-content-between align-items-center p-3 rounded border border-dark bg-dark mb-2 text-decoration-none hover-glow">
                                <div>
                                    <div class="text-white fw-bold">{{ $ch->subject }}</div>
                                    <small class="text-muted">
                                        {{ $ch->latestMessage ? Str::limit($ch->latestMessage->message, 80) : 'Sin mensajes aún' }}
                                    </small>
                                </div>
                                <div class="text-end">
                                    <span class="badge {{ $ch->status === 'open' ? 'pill-badge-cyan' : 'bg-secondary' }}">
                                        {{ ucfirst($ch->status) }}
                                    </span>
                                    <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">{{ $ch->last_message_at ? $ch->last_message_at->diffForHumans() : '' }}</small>
                                </div>
                            </a>
                        @empty
                            <div class="text-center text-muted py-3">No tienes consultas activas en este momento.</div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
