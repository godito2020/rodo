@extends('layouts.app')

@section('title', 'Orden Confirmada ' . $order->order_number . ' | RODOPERU')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
    $bankInstructions = \App\Models\Setting::get('payment_bank_instructions', "Banco BCP Cta Cte Dólares: 191-88992233-1-45 (CCI: 002-1910088992233145-56)\nBanco BBVA Cta Cte Soles: 0011-0345-0100098765\nTitular: RODOPERU S.A.C. - RUC 20601234567");
    $yapePhone = \App\Models\Setting::get('payment_yape_phone', '987 654 321 (RODOPERU S.A.C.)');
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '+51987654321');
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
@endphp

@section('content')

<!-- Masthead Breadcrumb & Success Notice -->
<section class="w-full bg-[#051125] text-white py-12 px-4 sm:px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-[1000px] mx-auto text-center space-y-4">
        <div class="w-16 h-16 rounded-full bg-emerald-500/10 border-2 border-emerald-500 text-emerald-400 flex items-center justify-center mx-auto">
            <span class="material-symbols-outlined text-4xl">check_circle</span>
        </div>
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded bg-[#1b263b] border border-slate-700 text-xs font-metric text-[#ffdea6]">
            <span>ORDEN REGISTRADA EXITOSAMENTE</span>
        </div>
        <h1 class="font-headline text-3xl sm:text-4xl font-bold tracking-tight text-white">
            ¡Gracias por tu Adquisición Corporativa!
        </h1>
        <p class="text-sm sm:text-base text-slate-300 max-w-2xl mx-auto">
            Tu solicitud con orden <strong class="text-[#ffdea6] font-metric">{{ $order->order_number }}</strong> ha sido enviada al área comercial y de operaciones de RODOPERU S.A.C.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
            <span class="px-3 py-1 rounded-full text-xs font-metric font-bold bg-amber-500/20 text-amber-300 border border-amber-500/40">
                Estado: {{ strtoupper($order->status ?? 'Pendiente') }}
            </span>
            <span class="px-3 py-1 rounded-full text-xs font-metric font-bold bg-blue-500/20 text-blue-300 border border-blue-500/40">
                Pago: {{ strtoupper($order->payment_status ?? 'Por Validar') }}
            </span>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="max-w-[1000px] mx-auto px-4 sm:px-6 lg:px-12 py-10 font-body space-y-8">
    
    <!-- Bank Instructions & Voucher Upload -->
    @if($order->payment_method === 'transfer' || $order->payment_method === 'yape_plin')
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-200">
                <span class="material-symbols-outlined text-2xl text-blue-700">account_balance</span>
                <h2 class="font-headline text-lg font-bold text-[#051125]">
                    Instrucciones de Abono &amp; Transferencia
                </h2>
            </div>

            @if($order->payment_method === 'transfer')
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 font-metric text-xs text-slate-700 leading-relaxed whitespace-pre-line">
                    {{ $bankInstructions }}
                </div>
            @else
                <div class="p-4 rounded-xl bg-purple-50 border border-purple-200 flex items-center justify-between">
                    <div>
                        <span class="font-metric text-xs text-purple-700 font-bold block">Billetera Digital Oficial (Yape / Plin)</span>
                        <span class="font-metric text-xl font-bold text-purple-950">{{ $yapePhone }}</span>
                    </div>
                    <span class="material-symbols-outlined text-purple-600 text-3xl">phone_iphone</span>
                </div>
            @endif

            <!-- Voucher Upload Form -->
            <div class="pt-4 border-t border-slate-200">
                <h3 class="font-headline font-bold text-sm text-[#051125] mb-2 flex items-center gap-2">
                    <span class="material-symbols-outlined text-amber-600 text-[18px]">receipt_long</span>
                    <span>Adjuntar Voucher o Comprobante Bancario</span>
                </h3>
                <p class="text-xs text-slate-600 mb-4">
                    Adjunta una fotografía o archivo PDF de la constancia para agilizar la emisión de factura y programación de entrega.
                </p>

                @if($order->voucher_path)
                    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                        <span class="font-metric text-xs text-emerald-800 font-semibold flex items-center gap-2">
                            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                            <span>Comprobante recibido y en revisión contable.</span>
                        </span>
                        <a href="{{ asset($order->voucher_path) }}" target="_blank" class="font-metric text-xs font-bold text-emerald-800 underline hover:text-emerald-950">
                            Ver Archivo
                        </a>
                    </div>
                @else
                    <form action="{{ route('checkout.voucher', $order->order_number) }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                        @csrf
                        <input type="file" name="voucher" required accept="image/*,application/pdf" class="flex-1 text-xs text-slate-700 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#051125] file:text-[#ffdea6] hover:file:bg-[#1b263b] file:cursor-pointer border border-slate-300 rounded-xl p-1 bg-slate-50">
                        <button type="submit" class="py-2.5 px-6 rounded-xl bg-[#051125] hover:bg-[#1b263b] text-[#ffdea6] font-headline text-xs font-bold tracking-wide flex items-center justify-center gap-2 shadow transition-all">
                            <span class="material-symbols-outlined text-[16px]">upload_file</span>
                            <span>Subir Comprobante</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endif

    <!-- Order Items Summary Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
            <h3 class="font-headline font-bold text-sm text-[#051125] uppercase tracking-wider">
                Detalle de Equipos Adjudicados
            </h3>
            <span class="font-metric text-xs text-slate-500">Orden: {{ $order->order_number }}</span>
        </div>

        <div class="divide-y divide-slate-100">
            @foreach($order->items as $it)
                <div class="p-5 flex items-center justify-between gap-4">
                    <div>
                        <h4 class="font-headline font-bold text-sm text-[#051125]">{{ $it->product_name }}</h4>
                        <div class="font-metric text-xs text-slate-500">
                            Cant: <strong class="text-slate-800">{{ $it->quantity }}</strong> &bull; Precio: {{ $currency }} {{ number_format($it->price, 2) }}
                        </div>
                    </div>
                    <div class="font-metric text-sm font-bold text-slate-900">
                        {{ $currency }} {{ number_format($it->total, 2) }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="p-6 bg-slate-50 border-t border-slate-200 space-y-2 font-metric text-xs">
            <div class="flex items-center justify-between text-slate-600">
                <span>Subtotal Neto:</span>
                <span class="font-bold text-slate-900">{{ $currency }} {{ number_format($order->subtotal, 2) }}</span>
            </div>
            <div class="flex items-center justify-between text-slate-600">
                <span>IGV Ley (18%):</span>
                <span class="font-bold text-slate-900">{{ $currency }} {{ number_format($order->tax, 2) }}</span>
            </div>
            <div class="pt-3 border-t border-slate-200 flex items-baseline justify-between">
                <span class="font-headline font-bold text-base text-[#051125]">Monto Total Facturado:</span>
                <span class="font-metric text-2xl font-bold text-blue-700">
                    {{ $currency }} {{ number_format($order->total, 2) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Actions & Assistance -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
        <a href="{{ route('home') }}" class="font-metric text-xs font-bold text-[#051125] hover:text-blue-700 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[16px]">home</span>
            <span>Volver a la Portada</span>
        </a>

        <div class="flex items-center gap-3">
            <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20acabo%20de%20generar%20la%20orden%20{{ $order->order_number }}%20por%20valor%20de%20{{ urlencode($currency . ' ' . number_format($order->total, 2)) }}" target="_blank" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-metric text-xs font-bold flex items-center gap-2 shadow">
                <i class="fab fa-whatsapp"></i>
                <span>Confirmar Vía WhatsApp</span>
            </a>
            <a href="{{ route('products.index') }}" class="px-5 py-2.5 rounded-xl bg-[#051125] hover:bg-[#1b263b] text-[#ffdea6] font-metric text-xs font-bold flex items-center gap-2">
                <span>Ver Más Equipos</span>
            </a>
        </div>
    </div>

</section>

@endsection
