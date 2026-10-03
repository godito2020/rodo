@extends('layouts.app')

@section('title', 'Mis Pedidos | RODOPERU')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
@endphp

@section('content')
<div class="py-4" style="background: #091022; border-bottom: 1px solid var(--border-dark);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}" class="text-info text-decoration-none">Mi Cuenta</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Mis Pedidos</li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold text-white mb-0"><i class="fas fa-boxes text-info me-2"></i> Historial de Mis Pedidos</h1>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card-custom">
            <div class="table-responsive">
                <table class="table table-dark table-striped align-middle mb-0" style="font-size: 0.95rem;">
                    <thead>
                        <tr>
                            <th>N° Pedido</th>
                            <th>Fecha</th>
                            <th>Artículos</th>
                            <th>Método Pago</th>
                            <th>Total</th>
                            <th>Estado Orden</th>
                            <th>Estado Pago</th>
                            <th class="text-end">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $ord)
                            <tr>
                                <td class="font-monospace fw-bold text-info">{{ $ord->order_number }}</td>
                                <td class="text-muted small">{{ $ord->created_at?->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="badge bg-dark border border-secondary">{{ $ord->items->count() }} unidad(es)</span>
                                </td>
                                <td>
                                    <span class="text-light small text-uppercase">{{ $ord->payment_method }}</span>
                                </td>
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
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class="fas fa-box-open fs-2 mb-2 d-block"></i>
                                    Aún no has registrado ningún pedido.
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
    </div>
</div>
@endsection
