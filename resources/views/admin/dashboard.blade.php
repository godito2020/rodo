@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Resumen General del Sistema')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
@endphp

@section('content')
<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Ventas Totales</span>
                    <h3 class="text-white fw-bold mb-0 mt-1">{{ $currency }} {{ number_format($totalSales, 2) }}</h3>
                </div>
                <div class="p-3 rounded-circle bg-dark text-success border border-success fs-3">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <small class="text-success mt-2 d-block"><i class="fas fa-chart-line me-1"></i> Órdenes pagadas</small>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Total Pedidos</span>
                    <h3 class="text-white fw-bold mb-0 mt-1">{{ $totalOrders }}</h3>
                </div>
                <div class="p-3 rounded-circle bg-dark text-info border border-info fs-3">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
            <small class="text-warning mt-2 d-block"><i class="fas fa-clock me-1"></i> {{ $pendingOrders }} órdenes pendientes</small>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Productos & Stock</span>
                    <h3 class="text-white fw-bold mb-0 mt-1">{{ $totalProducts }}</h3>
                </div>
                <div class="p-3 rounded-circle bg-dark text-warning border border-warning fs-3">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
            <a href="{{ route('admin.products.index') }}" class="text-info small text-decoration-none mt-2 d-block">Gestionar catálogo &rarr;</a>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Clientes Registrados</span>
                    <h3 class="text-white fw-bold mb-0 mt-1">{{ $totalCustomers }}</h3>
                </div>
                <div class="p-3 rounded-circle bg-dark text-primary border border-primary fs-3">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <a href="{{ route('admin.customers.index') }}" class="text-info small text-decoration-none mt-2 d-block">Ver clientes &rarr;</a>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Orders Table -->
    <div class="col-lg-8">
        <div class="card-custom h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="text-white"><i class="fas fa-history text-info me-2"></i> Últimos Pedidos Recibidos</span>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-info">Ver Todos los Pedidos</a>
            </div>
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th>N° Pedido</th>
                            <th>Cliente</th>
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
                                <td>
                                    <div class="fw-bold text-white">{{ $ord->customer_name }}</div>
                                    <small class="text-muted">{{ $ord->customer_email }}</small>
                                </td>
                                <td class="text-white fw-bold">{{ $currency }} {{ number_format($ord->total, 2) }}</td>
                                <td>{!! $ord->status_badge !!}</td>
                                <td>{!! $ord->payment_badge !!}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.orders.show', $ord->id) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No se han registrado pedidos recientemente.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Search Analytics Summary & Customer Live Chats -->
    <div class="col-lg-4">
        <!-- Top Searches Card -->
        <div class="card-custom mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="text-white"><i class="fas fa-search text-success me-2"></i> Lo que más buscan los clientes</span>
                <a href="{{ route('admin.analytics.searches') }}" class="text-info small text-decoration-none">Analítica &rarr;</a>
            </div>
            <div class="p-3">
                <div class="d-flex flex-column gap-2">
                    @forelse($topSearches as $ts)
                        <div class="d-flex justify-content-between align-items-center p-2 rounded bg-dark border border-secondary">
                            <span class="text-white fw-semibold"><i class="fas fa-tag text-info me-1"></i> {{ $ts->query }}</span>
                            <span class="badge bg-info text-dark">{{ $ts->count }} búsquedas</span>
                        </div>
                    @empty
                        <div class="text-muted text-center py-3 small">Aún no hay búsquedas registradas en el historial.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Customer Chats -->
        <div class="card-custom">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="text-white"><i class="fas fa-comments text-info me-2"></i> Chats de Clientes en Vivo</span>
                <a href="{{ route('admin.chats.index') }}" class="text-info small text-decoration-none">Ver todos &rarr;</a>
            </div>
            <div class="p-3">
                @forelse($recentChats as $rc)
                    <a href="{{ route('admin.chats.show', $rc->id) }}" class="d-flex justify-content-between align-items-center p-2 rounded bg-dark border border-secondary mb-2 text-decoration-none hover-glow">
                        <div>
                            <div class="text-white small fw-bold">{{ $rc->user ? $rc->user->name : 'Cliente' }}</div>
                            <small class="text-muted">{{ Str::limit($rc->subject, 30) }}</small>
                        </div>
                        <span class="badge {{ $rc->status === 'open' ? 'bg-danger' : 'bg-secondary' }}">
                            {{ $rc->status }}
                        </span>
                    </a>
                @empty
                    <div class="text-muted text-center py-3 small">No hay chats abiertos.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
