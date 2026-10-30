@extends('layouts.app')

@section('title', 'Unidades & Flotas Destacadas | RODOPERU')
@section('meta_description', 'Descubre las unidades más destacadas de vehículos 100% eléctricos y semirremolques Facchini para entrega inmediata en Perú.')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '+51987654321');
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
@endphp

@section('content')

<!-- Masthead Breadcrumb & Header -->
<section class="w-full bg-[#051125] text-white py-12 px-4 sm:px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-[1440px] mx-auto">
        <nav class="flex items-center gap-2 font-metric text-xs text-slate-400 mb-3" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#ffdea6] transition-colors">Inicio</a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-[#ffdea6] transition-colors">Catálogo</a>
            <span>/</span>
            <span class="text-[#ffdea6]">Unidades Destacadas</span>
        </nav>
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 text-[#ffdea6] font-metric text-xs tracking-wider uppercase font-bold mb-2">
                    <span class="material-symbols-outlined text-[16px]">verified</span>
                    <span>Disponibilidad Inmediata en Patio Ate</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl font-bold tracking-tight text-white">
                    Unidades &amp; Modelos Destacados
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 mt-2 max-w-2xl leading-relaxed">
                    Vehículos 100% eléctricos con homologación oficial e implementos pesados Facchini con chasis de alta resistencia listos para despacho nacional.
                </p>
            </div>
            <a href="{{ route('products.index') }}" class="px-5 py-2.5 rounded-xl bg-[#1b263b] hover:bg-slate-800 text-slate-200 border border-slate-700 font-metric text-xs font-bold flex items-center gap-2 shrink-0 transition-colors">
                <span class="material-symbols-outlined text-[16px]">filter_list</span>
                <span>Ver Todo el Catálogo</span>
            </a>
        </div>
    </div>
</section>

<!-- Products Grid Section -->
<section class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 py-12 font-body">
    @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $prod)
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div>
                        <!-- Image Container -->
                        <div class="relative w-full h-56 bg-slate-50 border-b border-slate-100 overflow-hidden flex items-center justify-center p-4">
                            <img src="{{ $prod->main_image_url }}" alt="{{ $prod->name }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-500">
                            
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 flex flex-col gap-1.5 items-start">
                                @if($prod->category)
                                    <span class="px-2.5 py-0.5 rounded bg-[#051125] text-[#ffdea6] font-metric text-[10px] font-bold tracking-wider uppercase">
                                        {{ $prod->category->name }}
                                    </span>
                                @endif
                                <span class="px-2.5 py-0.5 rounded bg-amber-500 text-white font-metric text-[10px] font-bold">
                                    ★ DESTACADO
                                </span>
                            </div>

                            @if($prod->brand)
                                <span class="absolute top-3 right-3 font-metric text-[10px] font-bold px-2 py-0.5 rounded bg-white/90 border border-slate-200 text-slate-700">
                                    {{ $prod->brand->name }}
                                </span>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 space-y-3">
                            <div class="flex items-center justify-between text-[11px] font-metric text-slate-400">
                                <span>SKU: {{ $prod->sku }}</span>
                                <span class="text-emerald-700 font-semibold flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Stock Vigente
                                </span>
                            </div>

                            <a href="{{ route('products.show', $prod->slug) }}" class="font-headline font-bold text-base text-[#051125] group-hover:text-blue-700 transition-colors line-clamp-2 block leading-snug">
                                {{ $prod->name }}
                            </a>

                            <!-- Technical specs pills preview -->
                            @if(!empty($prod->technical_specs) && is_array($prod->technical_specs))
                                <div class="grid grid-cols-2 gap-2 pt-1">
                                    @foreach(array_slice($prod->technical_specs, 0, 2) as $spec)
                                        <div class="bg-slate-50 border border-slate-200 rounded-lg p-2 font-metric text-[11px]">
                                            <span class="text-slate-400 block text-[9px] uppercase tracking-wider truncate">{{ $spec['key'] }}</span>
                                            <span class="font-bold text-[#051125] truncate block">{{ $spec['value'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Card Footer & Pricing -->
                    <div class="p-5 pt-0 border-t border-slate-100 mt-4 space-y-3">
                        <div class="pt-3 flex items-baseline justify-between">
                            @if($prod->show_price)
                                <div>
                                    <span class="font-metric text-[10px] text-slate-400 uppercase block">Inversión Desde</span>
                                    <div class="flex items-baseline gap-2">
                                        <span class="font-metric text-xl font-bold text-[#051125]">
                                            {{ $currency }} {{ number_format($prod->effective_price, 2) }}
                                        </span>
                                        @if($prod->has_discount)
                                            <span class="font-metric text-xs text-slate-400 line-through">
                                                {{ $currency }} {{ number_format($prod->price, 2) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div>
                                    <span class="font-metric text-[10px] text-slate-400 uppercase block">Condición Comercial</span>
                                    <span class="font-metric text-sm font-bold text-blue-800">
                                        Cotización a Medida
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-2 pt-1">
                            <a href="{{ route('products.show', $prod->slug) }}" class="py-2.5 px-3 rounded-xl border border-slate-300 hover:border-slate-800 text-[#051125] font-metric text-xs font-bold text-center transition-colors">
                                Ficha Técnica
                            </a>

                            @if($prod->action_type === 'buy' || $prod->action_type === 'both')
                                <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $prod->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full py-2.5 px-3 rounded-xl bg-[#051125] hover:bg-[#1b263b] text-[#ffdea6] font-metric text-xs font-bold text-center transition-all shadow">
                                        Cotizar / Comprar
                                    </button>
                                </form>
                            @else
                                <a href="{{ $prod->whatsapp_inquiry_url }}" target="_blank" class="py-2.5 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-metric text-xs font-bold text-center transition-colors flex items-center justify-center gap-1">
                                    <i class="fab fa-whatsapp"></i>
                                    <span>WhatsApp</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10 flex justify-center">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-2xl border border-slate-200 p-8 max-w-md mx-auto">
            <span class="material-symbols-outlined text-4xl text-slate-400 mb-2">inventory_2</span>
            <h3 class="font-headline font-bold text-base text-[#051125]">No hay unidades destacadas por el momento</h3>
            <p class="text-xs text-slate-500 mt-1 mb-4">Revisa nuestro catálogo completo para ver todas las unidades disponibles.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#051125] text-[#ffdea6] font-headline text-xs font-bold">
                Ver Catálogo General
            </a>
        </div>
    @endif
</section>

@endsection
