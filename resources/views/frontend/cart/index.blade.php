@extends('layouts.app')

@section('title', 'Carrito de Compras | RODOPERU')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
    $taxRate = (float)\App\Models\Setting::get('tax_rate', 18);
    $tax = round($total * ($taxRate / 100), 2);
    $grandTotal = $total + $tax;
@endphp

@section('content')
<div class="py-4" style="background: #091022; border-bottom: 1px solid var(--border-dark);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-info text-decoration-none">Productos</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Carrito de Compras</li>
            </ol>
        </nav>
        <h1 class="h2 fw-bold text-white mb-0"><i class="fas fa-shopping-cart text-info me-2"></i> Mi Carrito de Compras</h1>
    </div>
</div>

<div class="py-5">
    <div class="container">
        @if(count($cart) > 0)
            <div class="row g-4">
                <!-- Cart Items Table -->
                <div class="col-lg-8">
                    <div class="card-custom overflow-hidden">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped align-middle mb-0" style="font-size: 0.95rem;">
                                <thead>
                                    <tr class="border-bottom border-secondary">
                                        <th style="width: 100px;">Producto</th>
                                        <th>Descripción</th>
                                        <th class="text-center" style="width: 120px;">Precio</th>
                                        <th class="text-center" style="width: 140px;">Cantidad</th>
                                        <th class="text-end" style="width: 120px;">Subtotal</th>
                                        <th style="width: 50px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $id => $item)
                                        <tr class="border-bottom border-dark">
                                            <td>
                                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" width="70" height="70" class="rounded p-1 bg-dark" style="object-fit: contain;">
                                            </td>
                                            <td>
                                                <a href="{{ route('products.show', $item['slug']) }}" class="text-white text-decoration-none fw-bold hover-cyan">
                                                    {{ $item['name'] }}
                                                </a>
                                                <small class="text-muted d-block font-monospace">SKU: {{ $item['sku'] }}</small>
                                            </td>
                                            <td class="text-center text-white fw-semibold">
                                                {{ $currency }} {{ number_format($item['price'], 2) }}
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center justify-content-center gap-1">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99" class="form-control form-control-sm bg-dark text-white border-secondary text-center" style="width: 65px;" onchange="this.form.submit()">
                                                </form>
                                            </td>
                                            <td class="text-end text-info fw-bold">
                                                {{ $currency }} {{ number_format($item['price'] * $item['quantity'], 2) }}
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                                    <button type="submit" class="btn btn-sm btn-link text-danger p-0" title="Eliminar del carrito">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-3 bg-dark border-top border-secondary d-flex justify-content-between align-items-center">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary text-white btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Seguir Comprando
                            </a>
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Seguro que deseas vaciar el carrito?')">
                                    <i class="fas fa-trash-alt me-1"></i> Vaciar Carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="p-4 rounded-4 border border-secondary" style="background: #0f182e; position: sticky; top: 100px;">
                        <h4 class="text-white fw-bold mb-4 pb-2 border-bottom border-secondary">Resumen del Pedido</h4>

                        <div class="d-flex justify-content-between mb-3 text-light">
                            <span>Subtotal:</span>
                            <span class="fw-bold">{{ $currency }} {{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 text-light">
                            <span>IGV ({{ $taxRate }}%):</span>
                            <span>{{ $currency }} {{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4 pt-3 border-top border-secondary text-white fs-5 fw-bold">
                            <span>Total Estimado:</span>
                            <span class="text-info">{{ $currency }} {{ number_format($grandTotal, 2) }}</span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn btn-electric btn-lg w-100 py-3 fw-bold mb-3">
                            Continuar al Checkout <i class="fas fa-arrow-right ms-2"></i>
                        </a>

                        <div class="p-3 rounded bg-dark border border-secondary text-muted small">
                            <i class="fas fa-shield-alt text-success me-1"></i> Compra segura garantizada por RODOPERU S.A.C.
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="py-5 text-center">
                <div class="p-5 rounded-4 border border-secondary bg-dark mx-auto" style="max-width: 600px;">
                    <i class="fas fa-shopping-cart fs-1 text-muted mb-3"></i>
                    <h3 class="text-white fw-bold">Tu carrito de compras está vacío</h3>
                    <p class="text-muted">Explora nuestro catálogo para encontrar el vehículo eléctrico o semirremolque que tu negocio necesita.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-electric px-4 py-2 mt-2">
                        Ver Catálogo de Productos
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
