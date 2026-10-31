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
                    <span class="small text-uppercase fw-bold font-metric" style="color: #ffdea6; letter-spacing: 1px;">Ventas Totales</span>
                    <h3 class="text-white fw-bold mb-0 mt-1 font-metric">{{ $currency }} {{ number_format($totalSales, 2) }}</h3>
                </div>
                <div class="p-3 rounded-circle text-success fs-3" style="background-color: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.4);">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <small class="text-success mt-2 d-block font-metric fw-semibold"><i class="fas fa-chart-line me-1"></i> Órdenes pagadas</small>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="small text-uppercase fw-bold font-metric" style="color: #ffdea6; letter-spacing: 1px;">Total Pedidos</span>
                    <h3 class="text-white fw-bold mb-0 mt-1 font-metric">{{ $totalOrders }}</h3>
                </div>
                <div class="p-3 rounded-circle text-warning fs-3" style="background-color: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.4);">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
            <small class="text-warning mt-2 d-block font-metric fw-semibold"><i class="fas fa-clock me-1"></i> {{ $pendingOrders }} órdenes pendientes</small>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="small text-uppercase fw-bold font-metric" style="color: #ffdea6; letter-spacing: 1px;">Productos & Stock</span>
                    <h3 class="text-white fw-bold mb-0 mt-1 font-metric">{{ $totalProducts }}</h3>
                </div>
                <div class="p-3 rounded-circle fs-3" style="color: #38bdf8; background-color: rgba(56, 189, 248, 0.15); border: 1px solid rgba(56, 189, 248, 0.4);">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
            <a href="{{ route('admin.products.index') }}" class="small text-decoration-none mt-2 d-block font-metric fw-semibold" style="color: #38bdf8;">Gestionar catálogo &rarr;</a>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="small text-uppercase fw-bold font-metric" style="color: #ffdea6; letter-spacing: 1px;">Clientes Registrados</span>
                    <h3 class="text-white fw-bold mb-0 mt-1 font-metric">{{ $totalCustomers }}</h3>
                </div>
                <div class="p-3 rounded-circle fs-3" style="color: #a78bfa; background-color: rgba(167, 139, 250, 0.15); border: 1px solid rgba(167, 139, 250, 0.4);">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <a href="{{ route('admin.customers.index') }}" class="small text-decoration-none mt-2 d-block font-metric fw-semibold" style="color: #38bdf8;">Ver clientes &rarr;</a>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Orders Table -->
    <div class="col-lg-8">
        <div class="card-custom h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="text-white font-headline fs-6"><i class="fas fa-history text-warning me-2"></i> Últimos Pedidos Recibidos</span>
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
                                <td class="font-monospace fw-bold" style="color: #ffdea6;">{{ $ord->order_number }}</td>
                                <td>
                                    <div class="fw-bold text-white">{{ $ord->customer_name }}</div>
                                    <small style="color: #cbd5e1;">{{ $ord->customer_email }}</small>
                                </td>
                                <td class="text-white fw-bold font-metric">{{ $currency }} {{ number_format($ord->total, 2) }}</td>
                                <td>{!! $ord->status_badge !!}</td>
                                <td>{!! $ord->payment_badge !!}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.orders.show', $ord->id) }}" class="btn btn-sm btn-outline-info" title="Ver detalle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4" style="color: #cbd5e1;">No se han registrado pedidos recientemente.</td>
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
                <span class="text-white font-headline fs-6"><i class="fas fa-search text-success me-2"></i> Lo que más buscan los clientes</span>
                <a href="{{ route('admin.analytics.searches') }}" class="small text-decoration-none font-metric" style="color: #38bdf8;">Analítica &rarr;</a>
            </div>
            <div class="p-3">
                <div class="d-flex flex-column gap-2">
                    @forelse($topSearches as $ts)
                        <div class="d-flex justify-content-between align-items-center p-2.5 rounded" style="background-color: #061122; border: 1px solid #1e3150;">
                            <span class="text-white fw-semibold"><i class="fas fa-tag text-warning me-1"></i> {{ $ts->query }}</span>
                            <span class="badge font-metric" style="background: rgba(56, 189, 248, 0.15); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.4);">{{ $ts->count }} búsquedas</span>
                        </div>
                    @empty
                        <div class="text-center py-3 small" style="color: #cbd5e1;">Aún no hay búsquedas registradas en el historial.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Customer Chats -->
        <div class="card-custom">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="text-white font-headline fs-6"><i class="fas fa-comments text-info me-2"></i> Chats de Clientes en Vivo</span>
                <a href="{{ route('admin.chats.index') }}" class="small text-decoration-none font-metric" style="color: #38bdf8;">Ver todos &rarr;</a>
            </div>
            <div class="p-3">
                @forelse($recentChats as $rc)
                    <a href="{{ route('admin.chats.show', $rc->id) }}" class="d-flex justify-content-between align-items-center p-2.5 rounded mb-2 text-decoration-none" style="background-color: #061122; border: 1px solid #1e3150; transition: border-color 0.2s;">
                        <div>
                            <div class="text-white small fw-bold">{{ $rc->user ? $rc->user->name : 'Cliente' }}</div>
                            <small style="color: #cbd5e1;">{{ Str::limit($rc->subject, 30) }}</small>
                        </div>
                        <span class="badge font-metric {{ $rc->status === 'open' ? 'bg-danger' : 'bg-secondary' }}">
                            {{ ucfirst($rc->status) }}
                        </span>
                    </a>
                @empty
                    <div class="text-center py-3 small" style="color: #cbd5e1;">No hay chats abiertos.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
