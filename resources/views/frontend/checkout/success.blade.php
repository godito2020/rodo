@extends('layouts.app')

@section('title', 'Pedido Confirmado | RODOPERU')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
    $bankInstructions = \App\Models\Setting::get('payment_bank_instructions', "Banco BCP Cta Cte Dólares: 191-88992233-1-45 (CCI: 002-1910088992233145-56)\nBanco BBVA Cta Cte Soles: 0011-0345-0100098765\nTitular: RODOPERU S.A.C. - RUC 20601234567");
    $yapePhone = \App\Models\Setting::get('payment_yape_phone', '987 654 321 (RODOPERU S.A.C.)');
@endphp

@section('content')
<div class="py-5">
    <div class="container">
        <div class="mx-auto" style="max-width: 800px;">
            <!-- Success Card -->
            <div class="p-5 rounded-4 border border-secondary text-center mb-4" style="background: #0f182e;">
                <div class="p-3 rounded-circle text-success bg-dark border border-success d-inline-block fs-1 mb-3">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="display-6 fw-bold text-white mb-2">¡Gracias por tu Pedido!</h2>
                <p class="text-light lead mb-3">
                    Tu orden <strong class="text-info font-monospace">{{ $order->order_number }}</strong> ha sido registrada exitosamente.
                </p>
                <div class="d-flex justify-content-center gap-2 mb-4">
                    {!! $order->status_badge !!}
                    {!! $order->payment_badge !!}
                </div>
            </div>

            <!-- Payment Instructions & Voucher Upload -->
            @if($order->payment_method === 'transfer' || $order->payment_method === 'yape_plin')
                <div class="p-4 rounded-4 border border-info mb-4" style="background: rgba(0, 242, 254, 0.05);">
                    <h4 class="text-info fw-bold mb-3"><i class="fas fa-university me-2"></i> Instrucciones de Pago</h4>
                    
                    @if($order->payment_method === 'transfer')
                        <div class="p-3 bg-dark rounded border border-secondary text-light mb-3 font-monospace small" style="white-space: pre-line; line-height: 1.7;">
                            {{ $bankInstructions }}
                        </div>
                    @else
                        <div class="p-3 bg-dark rounded border border-secondary text-light mb-3">
                            <div class="fw-bold text-success mb-1"><i class="fas fa-mobile-alt me-1"></i> Número de Yape / Plin Oficial:</div>
                            <div class="fs-5 text-white font-monospace">{{ $yapePhone }}</div>
                        </div>
                    @endif

                    <!-- Voucher Upload Form -->
                    <div class="p-4 rounded-3 border border-secondary bg-dark">
                        <h5 class="text-white fw-bold mb-2"><i class="fas fa-receipt text-warning me-2"></i> Adjuntar Voucher o Comprobante de Abono</h5>
                        <p class="text-muted small mb-3">Sube una foto o PDF de la transferencia para que nuestro equipo contable valide y procese de inmediato tu pedido.</p>

                        @if($order->voucher_path)
                            <div class="alert alert-success d-flex align-items-center justify-content-between mb-0">
                                <span><i class="fas fa-check-circle me-2"></i> Voucher ya adjuntado y en verificación contable.</span>
                                <a href="{{ asset($order->voucher_path) }}" target="_blank" class="btn btn-sm btn-outline-light">Ver Voucher</a>
                            </div>
                        @else
                            <form action="{{ route('checkout.voucher', $order->order_number) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <input type="file" name="voucher" class="form-control" required accept="image/*,application/pdf">
                                    <button type="submit" class="btn btn-electric px-4 fw-bold">
                                        <i class="fas fa-upload me-1"></i> Subir Voucher
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Order Details Table -->
            <div class="p-4 rounded-4 border border-secondary mb-4" style="background: #0f182e;">
                <h4 class="text-white fw-bold mb-3 pb-2 border-bottom border-secondary">Detalle de Unidades</h4>

                <div class="table-responsive">
                    <table class="table table-dark table-striped mb-0">
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
                                    <td class="text-white fw-semibold">{{ $it->product_name }}</td>
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
                                <td colspan="3" class="text-end text-white fw-bold">Total General:</td>
                                <td class="text-end text-info fw-bold">{{ $currency }} {{ number_format($order->total, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Actions row -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary text-white">
                    <i class="fas fa-home me-1"></i> Volver a la Tienda
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-electric">
                    <i class="fas fa-shopping-bag me-1"></i> Ver Más Productos
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
