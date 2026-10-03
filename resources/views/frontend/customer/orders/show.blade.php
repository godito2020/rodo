@extends('layouts.app')

@section('title', 'Detalle de Pedido ' . $order->order_number . ' | RODOPERU')

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
                <li class="breadcrumb-item"><a href="{{ route('customer.orders') }}" class="text-info text-decoration-none">Mis Pedidos</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $order->order_number }}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold text-white mb-0">Orden #{{ $order->order_number }}</h1>
                <small class="text-muted">Registrado el {{ $order->created_at?->format('d/m/Y H:i') }}</small>
            </div>
            <div class="d-flex gap-2">
                {!! $order->status_badge !!}
                {!! $order->payment_badge !!}
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <!-- Items Table -->
                <div class="card-custom mb-4">
                    <div class="card-header">
                        <span class="text-white"><i class="fas fa-list me-2 text-info"></i> Unidades en esta Orden</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th class="text-center">Precio</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $it)
                                    <tr>
                                        <td>
                                            <div class="text-white fw-bold">{{ $it->product_name }}</div>
                                            @if($it->product)
                                                <small class="text-muted font-monospace">SKU: {{ $it->product->sku }}</small>
                                            @endif
                                        </td>
                                        <td class="text-center text-muted">{{ $currency }} {{ number_format($it->price, 2) }}</td>
                                        <td class="text-center text-white">{{ $it->quantity }}</td>
                                        <td class="text-end text-info fw-bold">{{ $currency }} {{ number_format($it->total, 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr class="border-top border-secondary">
                                    <td colspan="3" class="text-end text-light">Subtotal:</td>
                                    <td class="text-end text-white fw-bold">{{ $currency }} {{ number_format($order->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end text-light">IGV:</td>
                                    <td class="text-end text-white">{{ $currency }} {{ number_format($order->tax, 2) }}</td>
                                </tr>
                                <tr class="fs-5 border-top border-secondary">
                                    <td colspan="3" class="text-end text-white fw-bold">Total Facturado:</td>
                                    <td class="text-end text-info fw-bold">{{ $currency }} {{ number_format($order->total, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Voucher upload form if pending -->
                @if($order->payment_method === 'transfer' || $order->payment_method === 'yape_plin')
                    <div class="p-4 rounded-4 border border-secondary mb-4" style="background: #0f182e;">
                        <h5 class="text-white fw-bold mb-3"><i class="fas fa-receipt text-warning me-2"></i> Comprobante de Pago / Voucher</h5>

                        @if($order->voucher_path)
                            <div class="alert alert-success d-flex align-items-center justify-content-between mb-0">
                                <span><i class="fas fa-check-circle me-2"></i> Voucher adjuntado con éxito. Estado: <strong>En revisión contable</strong></span>
                                <a href="{{ asset($order->voucher_path) }}" target="_blank" class="btn btn-sm btn-outline-light">Ver Comprobante</a>
                            </div>
                        @else
                            <p class="text-muted small mb-3">Si ya realizaste la transferencia o Yape, sube aquí tu comprobante para acelerar la entrega de tu unidad.</p>
                            <form action="{{ route('checkout.voucher', $order->order_number) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <input type="file" name="voucher" class="form-control" required accept="image/*,application/pdf">
                                    <button type="submit" class="btn btn-electric px-4 fw-bold">Subir Voucher</button>
                                </div>
                            </form>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Sidebar Info -->
            <div class="col-lg-4">
                <div class="p-4 rounded-4 border border-secondary mb-4" style="background: #0f182e;">
                    <h5 class="text-white fw-bold mb-3 pb-2 border-bottom border-secondary">Datos de Despacho</h5>
                    <p class="mb-2"><strong class="text-info">Destinatario:</strong> <span class="text-white">{{ $order->customer_name }}</span></p>
                    <p class="mb-2"><strong class="text-info">Teléfono:</strong> <span class="text-white">{{ $order->customer_phone }}</span></p>
                    <p class="mb-2"><strong class="text-info">Correo:</strong> <span class="text-white">{{ $order->customer_email }}</span></p>
                    <p class="mb-2"><strong class="text-info">DNI/RUC:</strong> <span class="text-white">{{ $order->customer_dni_ruc ?: 'No registrado' }}</span></p>
                    <p class="mb-2"><strong class="text-info">Dirección:</strong> <span class="text-white">{{ $order->shipping_address }}</span></p>
                    <p class="mb-3"><strong class="text-info">Ciudad:</strong> <span class="text-white">{{ $order->shipping_city }}</span></p>
                    @if($order->notes)
                        <div class="p-2 bg-dark rounded border border-secondary small text-muted">
                            <strong>Notas:</strong> {{ $order->notes }}
                        </div>
                    @endif
                </div>

                <div class="p-4 rounded-4 border border-info" style="background: rgba(0, 242, 254, 0.05);">
                    <h6 class="text-info fw-bold mb-2"><i class="fas fa-headset me-2"></i> ¿Preguntas sobre tu Despacho?</h6>
                    <p class="text-muted small mb-3">Comunícate con logística indicando tu número de orden <strong>{{ $order->order_number }}</strong>.</p>
                    <a href="https://api.whatsapp.com/send?phone={{ \App\Models\Setting::get('whatsapp_number', '+51987654321') }}&text={{ rawurlencode('Hola RODOPERU, consulto por el estado de mi pedido ' . $order->order_number) }}" target="_blank" class="btn btn-whatsapp-quote w-100 py-2">
                        <i class="fab fa-whatsapp me-1"></i> Consultar Despacho
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
