@extends('layouts.app')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
    $metaTitle = $product->meta_title ?: ($product->name . ' | RODOPERU');
    $metaDescription = $product->meta_description ?: Str::limit(strip_tags($product->short_description), 155);
    $metaKeywords = $product->meta_keywords ?: ($product->name . ', ' . ($product->brand->name ?? '') . ', vehiculos electricos, facchini');
    $metaImage = $product->main_image_url;
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '+51987654321');
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
    $specs = is_array($product->technical_specs) ? $product->technical_specs : [];
    $isFacchini = str_contains(strtolower($product->sku), 'fac') || str_contains(strtolower($product->name), 'facchini');
@endphp

@section('title', $metaTitle)
@section('meta_description', $metaDescription)
@section('meta_keywords', $metaKeywords)

@push('styles')
<script type="application/ld+json">
{!! json_encode(array_filter([
    '@context' => 'https://schema.org/',
    '@type' => 'Product',
    'name' => $product->name,
    'image' => $product->main_image_url,
    'description' => strip_tags($product->short_description),
    'sku' => $product->sku,
    'brand' => [
        '@type' => 'Brand',
        'name' => $product->brand->name ?? 'RODOPERU'
    ],
    'offers' => $product->show_price ? [
        '@type' => 'Offer',
        'url' => url()->current(),
        'priceCurrency' => 'USD',
        'price' => $product->effective_price,
        'availability' => 'https://schema.org/InStock',
        'itemCondition' => 'https://schema.org/NewCondition'
    ] : null
]), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('content')

<!-- 1. BREADCRUMB -->
<div class="w-full bg-slate-100 py-3 border-b border-slate-200">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 flex items-center justify-between font-metric text-xs text-slate-600">
        <nav aria-label="Breadcrumb" class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[15px]">home</span>
                <span>Inicio</span>
            </a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-primary transition-colors">Catálogo</a>
            @if($product->category)
                <span>/</span>
                <a href="{{ route('products.index', ['categoria' => $product->category->slug]) }}" class="hover:text-primary transition-colors">{{ $product->category->name }}</a>
            @endif
            <span>/</span>
            <span class="text-[#051125] font-bold truncate max-w-xs sm:max-w-md">{{ $product->name }}</span>
        </nav>
        <span class="font-metric text-xs text-slate-500 hidden sm:inline">SKU: {{ $product->sku }}</span>
    </div>
</div>

<!-- 2. PRODUCT MAIN STAGE -->
<section class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 py-12 font-body">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        
        <!-- Left: Image Showcase & Gallery -->
        <div class="lg:col-span-7 space-y-4">
            <div class="rounded-2xl bg-white p-6 shadow-md border border-slate-200">
                <!-- Main Preview Display -->
                <div class="relative w-full aspect-[4/3] rounded-xl overflow-hidden bg-slate-50 flex items-center justify-center p-4">
                    <img id="mainProductImage" src="{{ $product->main_image_url }}" alt="{{ $product->name }}" class="w-full h-full object-contain transition-all duration-300">
                    
                    <div class="absolute top-3 left-3 flex flex-col gap-1">
                        <span class="px-2.5 py-1 rounded {{ $isFacchini ? 'bg-[#ffdea6] text-[#271900]' : 'bg-[#051125] text-white' }} font-metric text-xs font-bold shadow-sm">
                            {{ $isFacchini ? 'FACCHINI BRASIL' : 'ELECTROMOVILIDAD' }}
                        </span>
                    </div>

                    @if($product->has_discount)
                        <div class="absolute top-3 right-3 bg-red-600 text-white font-metric text-xs font-bold px-2.5 py-1 rounded shadow-sm">
                            -{{ $product->discount_percentage }}% DESCUENTO
                        </div>
                    @endif
                </div>

                <!-- Thumbnails -->
                @if($product->images->count() > 1)
                    <div class="flex items-center gap-3 mt-4 overflow-x-auto pb-2">
                        @foreach($product->images as $img)
                            <button type="button" onclick="changeProductImage('{{ asset($img->image_path) }}', this)" class="w-20 h-20 rounded-xl border-2 {{ $loop->first ? 'border-blue-600 ring-2 ring-blue-600/30' : 'border-slate-200' }} p-1 bg-slate-50 overflow-hidden shrink-0 hover:border-blue-500 transition-all">
                                <img src="{{ asset($img->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Guarantee Ribbon -->
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs text-slate-600 font-metric">
                <span class="flex items-center gap-1.5 text-slate-800 font-bold">
                    <span class="material-symbols-outlined text-emerald-600 text-[20px]">verified</span>
                    <span>Homologación MTC / Garantía de Fábrica</span>
                </span>
                <span class="text-slate-500">Stock para Entrega Inmediata en Lima</span>
            </div>
        </div>

        <!-- Right: Specifications, Pricing & Actions -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-md border border-slate-200 space-y-5">
                
                <!-- Category, Brand, SKU -->
                <div class="space-y-1">
                    <div class="flex items-center justify-between font-metric text-xs">
                        <span class="text-[#765a23] font-bold uppercase tracking-wider">{{ $product->brand->name ?? 'RODOPERU' }}</span>
                        <span class="text-slate-400">SKU: {{ $product->sku }}</span>
                    </div>
                    <h1 class="font-headline text-2xl sm:text-3xl font-bold text-[#051125] leading-tight">
                        {{ $product->name }}
                    </h1>
                </div>

                <!-- Price Box -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                    @if($product->show_price)
                        <div>
                            <span class="font-metric text-xs text-slate-500 uppercase block">Precio Oficial</span>
                            <div class="font-headline text-2xl sm:text-3xl font-bold text-[#051125]">
                                {{ $currency }} {{ number_format($product->effective_price, 2) }}
                            </div>
                            @if($product->has_discount)
                                <span class="font-metric text-xs text-slate-400 line-through">
                                    {{ $currency }} {{ number_format($product->price, 2) }}
                                </span>
                            @endif
                        </div>
                    @else
                        <div>
                            <span class="font-metric text-xs text-slate-500 uppercase block">Modalidad Comercial</span>
                            <div class="font-headline text-xl font-bold text-[#765a23]">
                                Cotización a Medida
                            </div>
                        </div>
                    @endif

                    <div class="text-right">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded bg-emerald-100 text-emerald-800 font-metric text-xs font-bold">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span>{{ $product->stock > 0 ? 'En Stock' : 'A Pedido' }}</span>
                        </span>
                        <span class="block font-metric text-[10px] text-slate-400 mt-1">Garantía Oficial Perú</span>
                    </div>
                </div>

                <!-- Short Description -->
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    {{ $product->short_description ?? 'Vehículo / implemento con especificaciones reforzadas para la geografía nacional, ideal para minería, distribución urbana y logística interprovincial.' }}
                </p>

                <!-- Technical Specs Quick Grid -->
                @if(count($specs) > 0)
                    <div class="space-y-2">
                        <span class="font-metric text-xs font-bold text-[#051125] uppercase block">Especificaciones Técnicas Clave:</span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 font-metric text-xs">
                            @foreach($specs as $spec)
                                <div class="py-2 px-3 rounded-lg bg-slate-50 border border-slate-100 flex justify-between items-center">
                                    <span class="text-slate-500 text-[11px]">{{ $spec['key'] }}:</span>
                                    <span class="font-bold text-[#051125] text-right">{{ $spec['value'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Call to Action Buttons -->
                <div class="space-y-3 pt-2">
                    <!-- WhatsApp Priority Button -->
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20cotizar%20el%20equipo%20{{ urlencode($product->name) }}%20(SKU:%20{{ $product->sku }})" target="_blank" class="w-full py-3.5 rounded-xl bg-[#25D366] hover:bg-[#20bd5a] text-white font-headline text-sm font-bold flex items-center justify-center gap-2 shadow-md transition-all">
                        <i class="fab fa-whatsapp text-lg"></i>
                        <span>Cotizar de Inmediato por WhatsApp</span>
                    </a>

                    <!-- Direct Cart Button (if buy or both) -->
                    @if($product->action_type === 'buy' || $product->action_type === 'both')
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="flex items-center gap-2">
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock > 0 ? $product->stock : 10 }}" class="w-20 h-11 px-3 border border-slate-300 rounded-xl text-center font-metric font-bold text-sm">
                                <button type="submit" class="flex-1 h-11 rounded-xl bg-[#051125] hover:bg-[#1b263b] text-white font-headline text-xs font-bold flex items-center justify-center gap-2 transition-all shadow-sm">
                                    <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                                    <span>Agregar al Carrito de Pedidos</span>
                                </button>
                            </div>
                        </form>
                    @endif

                    <!-- Quick Quote Modal trigger -->
                    <button type="button" onclick="openQuickQuoteModal('{{ addslashes($product->name) }}')" class="w-full py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-[#051125] font-headline text-xs font-semibold flex items-center justify-center gap-1.5 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">contact_mail</span>
                        <span>Solicitar Proforma Corporativa Formal</span>
                    </button>
                </div>

            </div>
        </div>

    </div>

    <!-- 3. DETAILED SPECS & DESCRIPTION TABS -->
    @if($product->description)
        <div class="mt-12 bg-white rounded-2xl p-6 sm:p-10 shadow-md border border-slate-200 space-y-4">
            <h3 class="font-headline text-xl font-bold text-[#051125] border-b border-slate-100 pb-3">
                Descripción Técnica &amp; Rendimiento Operativo
            </h3>
            <div class="prose max-w-none text-slate-600 text-sm leading-relaxed">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    @endif

</section>

@endsection

@push('scripts')
<script>
    function changeProductImage(src, btn) {
        document.getElementById('mainProductImage').src = src;
        document.querySelectorAll('button[onclick^="changeProductImage"]').forEach(b => {
            b.className = 'w-20 h-20 rounded-xl border-2 border-slate-200 p-1 bg-slate-50 overflow-hidden shrink-0 hover:border-blue-500 transition-all';
        });
        btn.className = 'w-20 h-20 rounded-xl border-2 border-blue-600 ring-2 ring-blue-600/30 p-1 bg-slate-50 overflow-hidden shrink-0';
    }
</script>
@endpush
