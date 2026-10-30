@extends('layouts.app')

@section('title', 'Carrito de Compras Corporativo | RODOPERU')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
    $taxRate = (float)\App\Models\Setting::get('tax_rate', 18);
    $tax = round($total * ($taxRate / 100), 2);
    $grandTotal = $total + $tax;
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '+51987654321');
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
@endphp

@section('content')

<!-- Masthead Breadcrumb & Title -->
<section class="w-full bg-[#051125] text-white py-10 px-4 sm:px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-[1440px] mx-auto">
        <nav class="flex items-center gap-2 font-metric text-xs text-slate-400 mb-3" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#ffdea6] transition-colors">Inicio</a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-[#ffdea6] transition-colors">Flota &amp; Equipos</a>
            <span>/</span>
            <span class="text-[#ffdea6]">Carrito de Adquisición</span>
        </nav>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-white flex items-center gap-3">
                    <span class="material-symbols-outlined text-3xl sm:text-4xl text-[#ffdea6]">shopping_cart</span>
                    <span>Carrito de Cotización &amp; Adquisición</span>
                </h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1">
                    Gestiona las unidades seleccionadas para compra directa o emisión de proforma corporativa oficial.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded bg-[#1b263b] border border-slate-700 text-xs font-metric text-slate-300">
                    <span class="material-symbols-outlined text-[16px] text-emerald-400">verified</span>
                    <span>Facturación Electrónica SUNAT</span>
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 py-10 font-body">
    @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Cart Items List (8 cols) -->
            <div class="lg:col-span-8 space-y-4">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                        <span class="font-headline font-bold text-sm text-[#051125] uppercase tracking-wider">
                            Equipos en Lista ({{ count($cart) }})
                        </span>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" onclick="return confirm('¿Seguro que deseas vaciar la lista de equipos?')" class="font-metric text-xs text-red-600 hover:text-red-700 font-bold flex items-center gap-1 transition-colors">
                                <span class="material-symbols-outlined text-[16px]">delete_sweep</span>
                                <span>Vaciar Carrito</span>
                            </button>
                        </form>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @foreach($cart as $id => $item)
                            <div class="p-6 flex flex-col sm:flex-row items-center sm:items-start gap-5 hover:bg-slate-50/60 transition-colors">
                                <!-- Image -->
                                <div class="w-24 h-24 bg-slate-100 rounded-xl overflow-hidden shrink-0 border border-slate-200 p-2 flex items-center justify-center">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-contain">
                                </div>

                                <!-- Info -->
                                <div class="flex-1 text-center sm:text-left space-y-1">
                                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
                                        <span class="font-metric text-[11px] text-slate-400 uppercase">SKU: {{ $item['sku'] }}</span>
                                    </div>
                                    <a href="{{ route('products.show', $item['slug']) }}" class="font-headline font-bold text-base text-[#051125] hover:text-blue-700 transition-colors block">
                                        {{ $item['name'] }}
                                    </a>
                                    <div class="font-metric text-xs text-slate-500">
                                        Precio Unitario: <strong class="text-slate-800">{{ $currency }} {{ number_format($item['price'], 2) }}</strong>
                                    </div>
                                </div>

                                <!-- Quantity Controller -->
                                <div class="flex flex-col items-center gap-1 shrink-0">
                                    <span class="font-metric text-[10px] text-slate-400 uppercase">Cantidad</span>
                                    <form action="{{ route('cart.update') }}" method="POST" class="flex items-center border border-slate-300 rounded-lg overflow-hidden bg-white shadow-sm">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99" class="w-16 py-1.5 px-2 text-center font-metric text-xs font-bold text-[#051125] focus:outline-none" onchange="this.form.submit()">
                                    </form>
                                </div>

                                <!-- Subtotal & Remove -->
                                <div class="flex flex-col items-center sm:items-end justify-between self-stretch shrink-0">
                                    <div class="text-right">
                                        <span class="font-metric text-[10px] text-slate-400 uppercase block">Subtotal</span>
                                        <span class="font-metric text-base font-bold text-[#051125]">
                                            {{ $currency }} {{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </span>
                                    </div>
                                    <form action="{{ route('cart.remove') }}" method="POST" class="mt-2 sm:mt-0">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <button type="submit" class="text-slate-400 hover:text-red-600 transition-colors p-1" title="Quitar equipo">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="p-4 bg-slate-50 border-t border-slate-200 flex flex-wrap items-center justify-between gap-3">
                        <a href="{{ route('products.index') }}" class="font-metric text-xs font-bold text-[#051125] hover:text-blue-700 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                            <span>Continuar Explorando Catálogo</span>
                        </a>
                        <span class="font-metric text-xs text-slate-500">
                            Precios no incluyen flete fuera de Lima Metropolitana
                        </span>
                    </div>
                </div>
            </div>

            <!-- Summary Card (4 cols) -->
            <div class="lg:col-span-4 sticky top-28">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-md p-6 space-y-6">
                    <h3 class="font-headline text-lg font-bold text-[#051125] pb-3 border-b border-slate-200">
                        Resumen de Cotización
                    </h3>

                    <div class="space-y-3 font-metric text-sm">
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Subtotal Equipos:</span>
                            <span class="font-bold text-slate-900">{{ $currency }} {{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span>IGV Ley ({{ $taxRate }}%):</span>
                            <span class="font-bold text-slate-900">{{ $currency }} {{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="pt-3 border-t border-slate-200 flex items-baseline justify-between">
                            <span class="font-headline font-bold text-base text-[#051125]">Total Liquidación:</span>
                            <span class="font-metric text-2xl font-bold text-blue-700">
                                {{ $currency }} {{ number_format($grandTotal, 2) }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-3 pt-2">
                        <a href="{{ route('checkout.index') }}" class="w-full py-3.5 px-6 rounded-xl bg-[#051125] hover:bg-[#1b263b] text-[#ffdea6] font-headline text-sm font-bold tracking-wide flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transition-all">
                            <span>Finalizar Pedido / Checkout</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>

                        <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20emitir%20orden%20formal%20para%20los%20equipos%20seleccionados%20por%20valor%20total%20de%20{{ urlencode($currency . ' ' . number_format($grandTotal, 2)) }}" target="_blank" class="w-full py-3 px-6 rounded-xl border border-emerald-600 text-emerald-700 hover:bg-emerald-50 font-metric text-xs font-bold tracking-wide flex items-center justify-center gap-2 transition-colors">
                            <i class="fab fa-whatsapp text-[16px]"></i>
                            <span>Validar con Asesor Corporativo</span>
                        </a>
                    </div>

                    <!-- Trust indicators -->
                    <div class="pt-4 border-t border-slate-200 space-y-2 font-metric text-xs text-slate-500">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-emerald-600 text-[18px]">shield</span>
                            <span>Garantía de Fábrica: Hasta 5 años o 150,000 km</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-600 text-[18px]">local_shipping</span>
                            <span>Entrega inmediata en Patio Central Ate Km 8.5</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#765a23] text-[18px]">description</span>
                            <span>Emisión de Factura, Guía y Ficha Homologada</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @else
        <!-- Empty Cart -->
        <div class="max-w-xl mx-auto text-center py-16 px-4">
            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-400">
                <span class="material-symbols-outlined text-4xl">shopping_cart</span>
            </div>
            <h2 class="font-headline text-2xl font-bold text-[#051125] mb-2">Tu lista de equipos está vacía</h2>
            <p class="text-slate-600 text-sm mb-6 leading-relaxed">
                Aún no has agregado unidades al carrito. Explora nuestro catálogo de electromovilidad JMEV e implementos rodoviarios pesados Facchini.
            </p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#051125] text-[#ffdea6] font-headline font-bold text-sm shadow hover:bg-[#1b263b] transition-all">
                <span class="material-symbols-outlined text-[18px]">view_in_ar</span>
                <span>Explorar Catálogo Completo</span>
            </a>
        </div>
    @endif
</section>

@endsection
