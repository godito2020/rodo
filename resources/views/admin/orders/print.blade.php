<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Orden {{ $order->order_number }} - RODOPERU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; color: #111; padding: 25px; }
        .invoice-box { max-width: 850px; margin: auto; border: 1px solid #ddd; padding: 30px; border-radius: 8px; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
            .invoice-box { border: none; }
        }
    </style>
</head>
<body>
    <div class="no-print text-end mb-3 container" style="max-width: 850px;">
        <button onclick="window.print()" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> Imprimir Comprobante</button>
        <button onclick="window.close()" class="btn btn-secondary btn-sm">Cerrar</button>
    </div>

    <div class="invoice-box">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-4 mb-4">
            <div>
                <h2 class="fw-bold mb-0 text-dark">RODOPERU S.A.C.</h2>
                <small class="text-muted d-block">RUC: 20601234567</small>
                <small class="text-muted d-block">Av. Evitamiento Km 8.5, Ate - Lima, Perú</small>
                <small class="text-muted d-block">Teléfono: {{ \App\Models\Setting::get('company_phone') }} | ventas@rodoperu.com</small>
            </div>
            <div class="text-end">
                <div class="border p-3 rounded text-center bg-light">
                    <span class="d-block fw-bold text-uppercase small text-muted">COMPROBANTE DE PEDIDO</span>
                    <h4 class="fw-bold mb-0 text-primary">{{ $order->order_number }}</h4>
                    <small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <h6 class="fw-bold text-uppercase small text-muted border-bottom pb-1">Cliente / Facturación:</h6>
                <div class="fw-bold">{{ $order->customer_name }}</div>
                <div>DNI / RUC: {{ $order->customer_dni_ruc ?: 'No registrado' }}</div>
                <div>Email: {{ $order->customer_email }}</div>
                <div>Teléfono: {{ $order->customer_phone }}</div>
            </div>
            <div class="col-6">
                <h6 class="fw-bold text-uppercase small text-muted border-bottom pb-1">Lugar de Despacho:</h6>
                <div>{{ $order->shipping_address }}</div>
                <div>{{ $order->shipping_city }}, Perú</div>
                <div class="mt-2"><strong>Método de Pago:</strong> <span class="text-uppercase">{{ $order->payment_method }}</span></div>
                <div><strong>Estado de Pago:</strong> <span class="badge bg-secondary">{{ $order->payment_status }}</span></div>
            </div>
        </div>

        <table class="table table-bordered mb-4">
            <thead class="table-light">
                <tr>
                    <th>Descripción de Unidad / Implemento</th>
                    <th class="text-center" style="width: 100px;">Cantidad</th>
                    <th class="text-end" style="width: 130px;">P. Unitario</th>
                    <th class="text-end" style="width: 130px;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $it)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $it->product_name }}</div>
                            @if($it->product)
                                <small class="text-muted">SKU: {{ $it->product->sku }}</small>
                            @endif
                        </td>
                        <td class="text-center">{{ $it->quantity }}</td>
                        <td class="text-end">{{ \App\Models\Setting::get('currency_symbol', 'USD $') }} {{ number_format($it->price, 2) }}</td>
                        <td class="text-end">{{ \App\Models\Setting::get('currency_symbol', 'USD $') }} {{ number_format($it->total, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-end fw-bold">Subtotal:</td>
                    <td class="text-end">{{ \App\Models\Setting::get('currency_symbol', 'USD $') }} {{ number_format($order->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end fw-bold">IGV (18%):</td>
                    <td class="text-end">{{ \App\Models\Setting::get('currency_symbol', 'USD $') }} {{ number_format($order->tax, 2) }}</td>
                </tr>
                <tr class="table-light fs-5">
                    <td colspan="3" class="text-end fw-bold">TOTAL:</td>
                    <td class="text-end fw-bold text-primary">{{ \App\Models\Setting::get('currency_symbol', 'USD $') }} {{ number_format($order->total, 2) }}</td>
                </tr>
            </tbody>
        </table>

        @if($order->notes)
            <div class="p-3 bg-light rounded border mb-4">
                <small class="fw-bold d-block text-muted">Observaciones de Entrega:</small>
                <small>{{ $order->notes }}</small>
            </div>
        @endif

        <div class="row pt-5 text-center mt-5">
            <div class="col-6">
                <div style="border-top: 1px solid #aaa; width: 80%; margin: auto; padding-top: 5px;">
                    <small>Firma y Sello RODOPERU S.A.C.</small>
                </div>
            </div>
            <div class="col-6">
                <div style="border-top: 1px solid #aaa; width: 80%; margin: auto; padding-top: 5px;">
                    <small>Conforme Recibido Cliente</small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
