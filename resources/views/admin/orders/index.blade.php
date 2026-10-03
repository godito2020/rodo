@extends('layouts.admin')

@section('title', 'Gestión de Pedidos')
@section('page_title', 'Administración de Pedidos & Cotizaciones')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
@endphp

@section('content')
<div class="card-custom">
    <!-- Header -->
    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h5 class="text-white mb-0"><i class="fas fa-shopping-bag text-warning me-2"></i> Pedidos Recibidos</h5>
            <small class="text-muted">Total: {{ $orders->total() }} pedidos</small>
        </div>
    </div>

    <!-- Filters Strip -->
    <div class="p-3 border-bottom border-secondary bg-dark">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-2">
            <div class="col-md-4">
                <input type="text" name="buscar" class="form-control form-control-sm" placeholder="Buscar por N° Orden, cliente, correo o celular..." value="{{ request('buscar') }}">
            </div>
            <div class="col-md-3">
                <select name="estado" class="form-select form-select-sm">
                    <option value="">Todos los Estados de Orden</option>
                    <option value="pending" {{ request('estado') === 'pending' ? 'selected' : '' }}>Pendiente</option>
                    <option value="processing" {{ request('estado') === 'processing' ? 'selected' : '' }}>En Preparación</option>
                    <option value="shipped" {{ request('estado') === 'shipped' ? 'selected' : '' }}>Despachado</option>
                    <option value="delivered" {{ request('estado') === 'delivered' ? 'selected' : '' }}>Entregado</option>
                    <option value="cancelled" {{ request('estado') === 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="pago" class="form-select form-select-sm">
                    <option value="">Todos los Estados de Pago</option>
                    <option value="pending" {{ request('pago') === 'pending' ? 'selected' : '' }}>Pago Pendiente</option>
                    <option value="paid" {{ request('pago') === 'paid' ? 'selected' : '' }}>Pagado</option>
                    <option value="failed" {{ request('pago') === 'failed' ? 'selected' : '' }}>Fallido</option>
                    <option value="refunded" {{ request('pago') === 'refunded' ? 'selected' : '' }}>Reembolsado</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-sm btn-outline-info flex-grow-1"><i class="fas fa-search me-1"></i> Filtrar</button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary" title="Limpiar"><i class="fas fa-undo"></i></a>
            </div>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr>
                    <th>N° Pedido</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Método</th>
                    <th>Total</th>
                    <th class="text-center">Estado Orden</th>
                    <th class="text-center">Estado Pago</th>
                    <th class="text-center">Voucher</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $ord)
                    <tr>
                        <td class="font-monospace fw-bold text-info">
                            <a href="{{ route('admin.orders.show', $ord->id) }}" class="text-info text-decoration-none">
                                {{ $ord->order_number }}
                            </a>
                        </td>
                        <td>
                            <div class="text-white fw-bold">{{ $ord->customer_name }}</div>
                            <small class="text-muted">{{ $ord->customer_phone }} &bull; {{ $ord->customer_email }}</small>
                        </td>
                        <td class="text-muted small">
                            {{ $ord->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td>
                            <span class="badge bg-dark border border-secondary text-uppercase">{{ $ord->payment_method }}</span>
                        </td>
                        <td class="text-white fw-bold">
                            {{ $currency }} {{ number_format($ord->total, 2) }}
                        </td>
                        <td class="text-center">
                            {!! $ord->status_badge !!}
                        </td>
                        <td class="text-center">
                            {!! $ord->payment_badge !!}
                        </td>
                        <td class="text-center">
                            @if($ord->voucher_path)
                                <a href="{{ asset($ord->voucher_path) }}" target="_blank" class="badge bg-success text-decoration-none">
                                    <i class="fas fa-paperclip me-1"></i> Ver
                                </a>
                            @else
                                <span class="badge bg-secondary">Sin Voucher</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('admin.orders.show', $ord->id) }}" class="btn btn-sm btn-outline-info" title="Ver Detalle y Gestionar">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.orders.print', $ord->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary text-light" title="Imprimir Guía / Factura">
                                    <i class="fas fa-print"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-5">
                            No se encontraron órdenes registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
        <div class="p-3 border-top border-secondary d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
