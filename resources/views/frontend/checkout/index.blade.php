@extends('layouts.app')

@section('title', 'Finalizar Pedido / Checkout | RODOPERU')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
    $user = $user ?? \Illuminate\Support\Facades\Auth::user();
@endphp

@section('content')
<div class="py-4" style="background: #091022; border-bottom: 1px solid var(--border-dark);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" class="text-info text-decoration-none">Carrito</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Checkout</li>
            </ol>
        </nav>
        <h1 class="h2 fw-bold text-white mb-0"><i class="fas fa-lock text-info me-2"></i> Finalizar Pedido & Cotización Oficial</h1>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="row g-4">
                <!-- Left: Customer Information & Delivery -->
                <div class="col-lg-7">
                    <!-- 1. Customer Data -->
                    <div class="p-4 rounded-4 border border-secondary mb-4" style="background: #0f182e;">
                        <h4 class="text-white fw-bold mb-3"><i class="fas fa-user-circle text-info me-2"></i> Datos del Comprador / Empresa</h4>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-light small fw-bold">Nombre Completo o Razón Social *</label>
                                <input type="text" name="customer_name" class="form-control" required value="{{ old('customer_name', $user ? $user->name : '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-light small fw-bold">Correo Electrónico *</label>
                                <input type="email" name="customer_email" class="form-control" required value="{{ old('customer_email', $user ? $user->email : '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-light small fw-bold">Teléfono / Celular (WhatsApp) *</label>
                                <input type="text" name="customer_phone" class="form-control" required placeholder="+51 987 654 321" value="{{ old('customer_phone', $user ? $user->phone : '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-light small fw-bold">DNI o RUC (para Facturación)</label>
                                <input type="text" name="customer_dni_ruc" class="form-control" placeholder="20601234567" value="{{ old('customer_dni_ruc', $user ? $user->dni_ruc : '') }}">
                            </div>
                        </div>
                    </div>

                    <!-- 2. Delivery Address -->
                    <div class="p-4 rounded-4 border border-secondary mb-4" style="background: #0f182e;">
                        <h4 class="text-white fw-bold mb-3"><i class="fas fa-map-marker-alt text-info me-2"></i> Dirección de Entrega / Despacho</h4>
                        
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label text-light small fw-bold">Dirección o Almacén de Destino *</label>
                                <input type="text" name="shipping_address" class="form-control" required placeholder="Av. Principal 1234, Zona Industrial" value="{{ old('shipping_address', $user ? $user->address : '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-light small fw-bold">Ciudad / Región *</label>
                                <input type="text" name="shipping_city" class="form-control" required placeholder="Lima / Callao / Arequipa" value="{{ old('shipping_city', $user ? $user->city : 'Lima') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-light small fw-bold">Instrucciones o Notas de Despacho (Opcional)</label>
                                <textarea name="notes" class="form-control" rows="2" placeholder="Indicaciones para coordinación de entrega, horario o flete...">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Payment Method -->
                    <div class="p-4 rounded-4 border border-secondary" style="background: #0f182e;">
                        <h4 class="text-white fw-bold mb-3"><i class="fas fa-credit-card text-info me-2"></i> Método de Pago</h4>
                        
                        <div class="d-flex flex-column gap-3">
                            <label class="p-3 rounded border border-secondary d-flex align-items-center gap-3 cursor-pointer" style="background: #0b1428; cursor: pointer;">
                                <input type="radio" name="payment_method" value="transfer" checked class="form-check-input">
                                <div>
                                    <div class="text-white fw-bold"><i class="fas fa-university text-primary me-2"></i> Transferencia Bancaria (BCP / BBVA / Interbank)</div>
                                    <small class="text-muted">Podrás subir tu comprobante de abono o voucher una vez generada la orden para validación.</small>
                                </div>
                            </label>

                            <label class="p-3 rounded border border-secondary d-flex align-items-center gap-3 cursor-pointer" style="background: #0b1428; cursor: pointer;">
                                <input type="radio" name="payment_method" value="yape_plin" class="form-check-input">
                                <div>
                                    <div class="text-white fw-bold"><i class="fas fa-mobile-alt text-success me-2"></i> Yape / Plin (Billeteras Digitales)</div>
                                    <small class="text-muted">Transferencia directa al número corporativo oficial de RODOPERU.</small>
                                </div>
                            </label>

                            <label class="p-3 rounded border border-secondary d-flex align-items-center gap-3 cursor-pointer" style="background: #0b1428; cursor: pointer;">
                                <input type="radio" name="payment_method" value="gateway" class="form-check-input">
                                <div>
                                    <div class="text-white fw-bold"><i class="fas fa-credit-card text-warning me-2"></i> Pasarela Online (MercadoPago / Visa / Mastercard)</div>
                                    <small class="text-muted">Pago en línea inmediato con tarjeta de crédito o débito.</small>
                                </div>
                            </label>

                            <label class="p-3 rounded border border-secondary d-flex align-items-center gap-3 cursor-pointer" style="background: #0b1428; cursor: pointer;">
                                <input type="radio" name="payment_method" value="quote" class="form-check-input">
                                <div>
                                    <div class="text-white fw-bold"><i class="fas fa-file-contract text-info me-2"></i> Orden de Compra / Cotización Formal</div>
                                    <small class="text-muted">Para empresas y licitaciones: emitiremos la proforma formal con plazos de entrega.</small>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Right: Summary -->
                <div class="col-lg-5">
                    <div class="p-4 rounded-4 border border-secondary" style="background: #0f182e; position: sticky; top: 100px;">
                        <h4 class="text-white fw-bold mb-3 pb-2 border-bottom border-secondary">Resumen del Pedido</h4>

                        <!-- Items list -->
                        <div class="d-flex flex-column gap-3 mb-4 max-vh-50 overflow-auto">
                            @foreach($cart as $item)
                                <div class="d-flex align-items-center gap-3 pb-2 border-bottom border-dark">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" width="50" height="50" class="rounded p-1 bg-dark" style="object-fit: contain;">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <div class="text-white small fw-bold text-truncate">{{ $item['name'] }}</div>
                                        <small class="text-muted">Cant: {{ $item['quantity'] }} &bull; {{ $currency }} {{ number_format($item['price'], 2) }}</small>
                                    </div>
                                    <div class="text-white fw-bold small text-nowrap">
                                        {{ $currency }} {{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between mb-2 text-light">
                            <span>Subtotal:</span>
                            <span class="fw-bold">{{ $currency }} {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 text-light">
                            <span>IGV (18%):</span>
                            <span>{{ $currency }} {{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4 pt-3 border-top border-secondary text-white fs-4 fw-bold">
                            <span>Total a Pagar:</span>
                            <span class="text-info">{{ $currency }} {{ number_format($total, 2) }}</span>
                        </div>

                        <button type="submit" class="btn btn-electric btn-lg w-100 py-3 fw-bold mb-3">
                            <i class="fas fa-check-circle me-2"></i> Confirmar y Procesar Orden
                        </button>

                        <div class="text-center text-muted small">
                            Al hacer clic en confirmar aceptas los términos comerciales y condiciones de RODOPERU S.A.C.
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
