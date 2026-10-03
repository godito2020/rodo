@extends('layouts.admin')

@section('title', 'Gestionar Pedido ' . $order->order_number)
@section('page_title', 'Detalle de Pedido')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
@endphp

@section('content')
<div class="row g-4">
    <!-- Left: Order Details & Items -->
    <div class="col-lg-8">
        <div class="card-custom mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="text-white"><i class="fas fa-box text-info me-2"></i> Pedido #{{ $order->order_number }}</span>
                <div>
                    <a href="{{ route('admin.orders.print', $order->id) }}" target="_blank" class="btn btn-sm btn-outline-light me-1">
                        <i class="fas fa-print me-1"></i> Imprimir
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                </div>
            </div>

            <!-- Items table -->
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Producto / Modelo</th>
                            <th class="text-center">Precio Unitario</th>
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
                                        <small class="text-info font-monospace">SKU: {{ $it->product->sku }}</small>
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

        <!-- Voucher Verification Section -->
        <div class="card-custom p-4">
            <h5 class="text-white fw-bold mb-3 pb-2 border-bottom border-secondary"><i class="fas fa-receipt text-warning me-2"></i> Comprobante de Pago / Voucher</h5>

            @if($order->voucher_path)
                <div class="row align-items-center g-3">
                    <div class="col-md-4 text-center">
                        <a href="{{ asset($order->voucher_path) }}" target="_blank">
                            <img src="{{ asset($order->voucher_path) }}" alt="Voucher" class="img-fluid rounded border border-secondary p-1 bg-dark" style="max-height: 180px; object-fit: contain;">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="alert alert-info border-0 bg-dark text-light mb-3">
                            <i class="fas fa-info-circle text-info me-1"></i> El cliente ha cargado este comprobante para justificar el pago. Verifica el abono en la cuenta bancaria.
                        </div>
                        <a href="{{ asset($order->voucher_path) }}" target="_blank" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-external-link-alt me-1"></i> Abrir Comprobante a Pantalla Completa
                        </a>
                    </div>
                </div>
            @else
                <div class="p-4 bg-dark rounded border border-secondary text-center text-muted">
                    <i class="fas fa-file-invoice fs-3 mb-2 d-block"></i>
                    El cliente no ha adjuntado voucher aún.
                </div>
            @endif
        </div>
    </div>

    <!-- Right: Update Status & Customer Profile -->
    <div class="col-lg-4">
        <!-- Status Management Form -->
        <div class="card-custom p-4 mb-4">
            <h5 class="text-white fw-bold mb-3 pb-2 border-bottom border-secondary"><i class="fas fa-cogs text-info me-2"></i> Cambiar Estado</h5>

            <form action="{{ route('admin.orders.update_status', $order->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Estado del Pedido</label>
                    <select name="order_status" class="form-select">
                        <option value="pending" {{ $order->order_status === 'pending' ? 'selected' : '' }}>Pendiente</option>
                        <option value="processing" {{ $order->order_status === 'processing' ? 'selected' : '' }}>En Preparación</option>
                        <option value="shipped" {{ $order->order_status === 'shipped' ? 'selected' : '' }}>Despachado</option>
                        <option value="delivered" {{ $order->order_status === 'delivered' ? 'selected' : '' }}>Entregado</option>
                        <option value="cancelled" {{ $order->order_status === 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label text-light small fw-bold">Estado del Pago</label>
                    <select name="payment_status" class="form-select">
                        <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pago Pendiente</option>
                        <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Pago Verificado / Pagado</option>
                        <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Pago Fallido</option>
                        <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Reembolsado</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-electric w-100 py-2 fw-bold">
                    <i class="fas fa-save me-1"></i> Actualizar Estado
                </button>
            </form>
        </div>

        <!-- Customer & Delivery info -->
        <div class="card-custom p-4">
            <h5 class="text-white fw-bold mb-3 pb-2 border-bottom border-secondary"><i class="fas fa-address-card text-info me-2"></i> Información del Cliente</h5>

            <p class="mb-2"><strong class="text-info">Nombre:</strong> <span class="text-white">{{ $order->customer_name }}</span></p>
            <p class="mb-2"><strong class="text-info">Teléfono:</strong> <span class="text-white">{{ $order->customer_phone }}</span></p>
            <p class="mb-2"><strong class="text-info">Email:</strong> <span class="text-white">{{ $order->customer_email }}</span></p>
            <p class="mb-2"><strong class="text-info">DNI/RUC:</strong> <span class="text-white">{{ $order->customer_dni_ruc ?: 'No especificado' }}</span></p>
            <p class="mb-2"><strong class="text-info">Dirección:</strong> <span class="text-white">{{ $order->shipping_address }}</span></p>
            <p class="mb-3"><strong class="text-info">Ciudad:</strong> <span class="text-white">{{ $order->shipping_city }}</span></p>

            @if($order->notes)
                <div class="p-3 bg-dark rounded border border-secondary small text-muted mb-3">
                    <strong>Notas del Cliente:</strong> {{ $order->notes }}
                </div>
            @endif

            <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}&text={{ rawurlencode('Hola ' . $order->customer_name . ', te saludamos de RODOPERU respecto a tu orden ' . $order->order_number) }}" target="_blank" class="btn btn-whatsapp-quote w-100 py-2 btn-sm">
                <i class="fab fa-whatsapp me-1"></i> Contactar por WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection
