@extends('layouts.app')

@section('title', 'Finalizar Adquisición & Checkout Corporativo | RODOPERU')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
    $user = $user ?? \Illuminate\Support\Facades\Auth::user();
@endphp

@section('content')

<!-- Masthead Breadcrumb & Title -->
<section class="w-full bg-[#051125] text-white py-10 px-4 sm:px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-[1440px] mx-auto">
        <nav class="flex items-center gap-2 font-metric text-xs text-slate-400 mb-3" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#ffdea6] transition-colors">Inicio</a>
            <span>/</span>
            <a href="{{ route('cart.index') }}" class="hover:text-[#ffdea6] transition-colors">Carrito</a>
            <span>/</span>
            <span class="text-[#ffdea6]">Checkout &amp; Liquidación</span>
        </nav>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-white flex items-center gap-3">
                    <span class="material-symbols-outlined text-3xl sm:text-4xl text-[#ffdea6]">verified_user</span>
                    <span>Finalizar Pedido &amp; Adjudicación Formal</span>
                </h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1">
                    Ingresa los datos para la emisión de proforma vinculante o facturación corporativa oficial.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded bg-[#1b263b] border border-slate-700 text-xs font-metric text-slate-300">
                    <span class="material-symbols-outlined text-[16px] text-emerald-400">lock</span>
                    <span>Transacción Encriptada 256-bit</span>
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Main Checkout Form Section -->
<section class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 py-10 font-body">
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Form Fields (7 cols) -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- 1. Customer Details -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-5">
                    <div class="flex items-center gap-3 pb-3 border-b border-slate-200">
                        <span class="w-8 h-8 rounded-lg bg-[#051125] text-[#ffdea6] font-metric text-sm font-bold flex items-center justify-center">1</span>
                        <h2 class="font-headline text-lg font-bold text-[#051125]">
                            Datos de la Razón Social / Comprador
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block font-metric text-xs font-semibold text-slate-700">Razón Social o Nombre Completo *</label>
                            <input type="text" name="customer_name" required value="{{ old('customer_name', $user ? $user->name : '') }}" placeholder="Ej: Transportes del Sur S.A.C." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-body text-slate-900 bg-slate-50/50">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block font-metric text-xs font-semibold text-slate-700">RUC o DNI (para Facturación) *</label>
                            <input type="text" name="customer_dni_ruc" required value="{{ old('customer_dni_ruc', $user ? $user->dni_ruc : '') }}" placeholder="Ej: 20123456789" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-metric text-slate-900 bg-slate-50/50">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block font-metric text-xs font-semibold text-slate-700">Correo Electrónico Corporativo *</label>
                            <input type="email" name="customer_email" required value="{{ old('customer_email', $user ? $user->email : '') }}" placeholder="logistica@empresa.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-body text-slate-900 bg-slate-50/50">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block font-metric text-xs font-semibold text-slate-700">Teléfono / WhatsApp de Contacto *</label>
                            <input type="text" name="customer_phone" required value="{{ old('customer_phone', $user ? $user->phone : '') }}" placeholder="+51 987 654 321" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-metric text-slate-900 bg-slate-50/50">
                        </div>
                    </div>
                </div>

                <!-- 2. Delivery Address -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-5">
                    <div class="flex items-center gap-3 pb-3 border-b border-slate-200">
                        <span class="w-8 h-8 rounded-lg bg-[#051125] text-[#ffdea6] font-metric text-sm font-bold flex items-center justify-center">2</span>
                        <h2 class="font-headline text-lg font-bold text-[#051125]">
                            Punto de Despacho o Entrega
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="sm:col-span-2 space-y-1.5">
                            <label class="block font-metric text-xs font-semibold text-slate-700">Dirección de Destino o Base de Flota *</label>
                            <input type="text" name="shipping_address" required value="{{ old('shipping_address', $user ? $user->address : '') }}" placeholder="Av. Los Ingenieros 450, Almacén Central" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-body text-slate-900 bg-slate-50/50">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block font-metric text-xs font-semibold text-slate-700">Ciudad / Departamento *</label>
                            <input type="text" name="shipping_city" required value="{{ old('shipping_city', $user ? $user->city : 'Lima') }}" placeholder="Lima / Callao" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-body text-slate-900 bg-slate-50/50">
                        </div>

                        <div class="sm:col-span-3 space-y-1.5">
                            <label class="block font-metric text-xs font-semibold text-slate-700">Instrucciones Especiales o Requerimiento de Flete (Opcional)</label>
                            <textarea name="notes" rows="2" placeholder="Indicar si se retira con camión grúa propio o se solicita flete a mina/provincia..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-body text-slate-900 bg-slate-50/50">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 3. Payment Method -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-5">
                    <div class="flex items-center gap-3 pb-3 border-b border-slate-200">
                        <span class="w-8 h-8 rounded-lg bg-[#051125] text-[#ffdea6] font-metric text-sm font-bold flex items-center justify-center">3</span>
                        <h2 class="font-headline text-lg font-bold text-[#051125]">
                            Modalidad de Pago &amp; Adjudicación
                        </h2>
                    </div>

                    <div class="space-y-3">
                        <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-300 hover:border-blue-600 cursor-pointer bg-slate-50/60 transition-all">
                            <input type="radio" name="payment_method" value="transfer" checked class="mt-1 text-blue-600 focus:ring-blue-500">
                            <div>
                                <div class="font-headline font-bold text-sm text-[#051125] flex items-center gap-2">
                                    <span class="material-symbols-outlined text-blue-600 text-[18px]">account_balance</span>
                                    <span>Transferencia Bancaria Corporativa (BCP / BBVA / Interbank)</span>
                                </div>
                                <p class="text-xs text-slate-600 mt-0.5">
                                    Podrás adjuntar el comprobante o número de operación para validación y facturación inmediata.
                                </p>
                            </div>
                        </label>

                        <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-300 hover:border-emerald-600 cursor-pointer bg-slate-50/60 transition-all">
                            <input type="radio" name="payment_method" value="quote" class="mt-1 text-emerald-600 focus:ring-emerald-500">
                            <div>
                                <div class="font-headline font-bold text-sm text-[#051125] flex items-center gap-2">
                                    <span class="material-symbols-outlined text-emerald-600 text-[18px]">request_quote</span>
                                    <span>Orden de Compra / Proforma Formal B2B</span>
                                </div>
                                <p class="text-xs text-slate-600 mt-0.5">
                                    Emisión de cotización sellada con plazos de fabricación, reserva de chasis y condiciones de leasing vehicular.
                                </p>
                            </div>
                        </label>

                        <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-300 hover:border-purple-600 cursor-pointer bg-slate-50/60 transition-all">
                            <input type="radio" name="payment_method" value="yape_plin" class="mt-1 text-purple-600 focus:ring-purple-500">
                            <div>
                                <div class="font-headline font-bold text-sm text-[#051125] flex items-center gap-2">
                                    <span class="material-symbols-outlined text-purple-600 text-[18px]">phone_android</span>
                                    <span>Billetera Digital (Yape / Plin Corporativo)</span>
                                </div>
                                <p class="text-xs text-slate-600 mt-0.5">
                                    Abono instantáneo para repuestos o separación de unidades de demostración.
                                </p>
                            </div>
                        </label>

                        <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-300 hover:border-amber-600 cursor-pointer bg-slate-50/60 transition-all">
                            <input type="radio" name="payment_method" value="gateway" class="mt-1 text-amber-600 focus:ring-amber-500">
                            <div>
                                <div class="font-headline font-bold text-sm text-[#051125] flex items-center gap-2">
                                    <span class="material-symbols-outlined text-amber-600 text-[18px]">credit_card</span>
                                    <span>Pasarela de Pago Online (Tarjetas Visa / Mastercard / Amex)</span>
                                </div>
                                <p class="text-xs text-slate-600 mt-0.5">
                                    Procesamiento seguro mediante pasarela bancaria certificada.
                                </p>
                            </div>
                        </label>
                    </div>
                </div>

            </div>

            <!-- Right Summary (5 cols) -->
            <div class="lg:col-span-5 sticky top-28 space-y-4">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-md p-6 space-y-5">
                    <h3 class="font-headline text-lg font-bold text-[#051125] pb-3 border-b border-slate-200">
                        Resumen del Pedido ({{ count($cart) }})
                    </h3>

                    <!-- Units scroll list -->
                    <div class="space-y-3 max-h-60 overflow-y-auto pr-1 divide-y divide-slate-100">
                        @foreach($cart as $item)
                            <div class="pt-3 first:pt-0 flex items-center gap-3">
                                <div class="w-14 h-14 bg-slate-50 rounded-lg border border-slate-200 p-1 shrink-0 flex items-center justify-center">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-contain">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-headline text-xs font-bold text-[#051125] truncate">{{ $item['name'] }}</h4>
                                    <div class="font-metric text-[11px] text-slate-500">
                                        Cant: <strong class="text-slate-800">{{ $item['quantity'] }}</strong> &bull; {{ $currency }} {{ number_format($item['price'], 2) }}
                                    </div>
                                </div>
                                <div class="font-metric text-xs font-bold text-slate-900 shrink-0">
                                    {{ $currency }} {{ number_format($item['price'] * $item['quantity'], 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4 border-t border-slate-200 space-y-2.5 font-metric text-xs">
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Subtotal Neto:</span>
                            <span class="font-bold text-slate-900">{{ $currency }} {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span>IGV (18%):</span>
                            <span class="font-bold text-slate-900">{{ $currency }} {{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="pt-3 border-t border-slate-200 flex items-baseline justify-between">
                            <span class="font-headline font-bold text-base text-[#051125]">Monto Final Liquidación:</span>
                            <span class="font-metric text-2xl font-bold text-blue-700">
                                {{ $currency }} {{ number_format($total, 2) }}
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-[#051125] hover:bg-[#1b263b] text-[#ffdea6] font-headline text-sm font-bold tracking-wide flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transition-all">
                        <span class="material-symbols-outlined text-[18px]">verified</span>
                        <span>Confirmar &amp; Procesar Adquisición</span>
                    </button>

                    <p class="font-metric text-[11px] text-slate-400 text-center leading-relaxed">
                        Al confirmar, se generará la orden oficial de RODOPERU S.A.C. y recibirás el comprobante con validez legal por correo electrónico.
                    </p>
                </div>
            </div>

        </div>
    </form>
</section>

@endsection
