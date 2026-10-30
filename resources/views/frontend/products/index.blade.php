@extends('layouts.app')

@section('title', 'RODOPERU | Catálogo Industrial & Flotas Comerciales')

@section('meta_description', 'Catálogo completo de vehículos 100% eléctricos y semirremolques pesados Facchini en Perú. Tolvas basculantes, furgones, plataformas y automóviles comerciales.')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '+51987654321');
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
    $selectedCategory = request('categoria', 'all');
@endphp

@section('content')

<!-- 1. BREADCRUMB & AVAILABILITY BAR -->
<div class="w-full bg-slate-100 py-3 border-b border-slate-200">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 flex flex-wrap items-center justify-between gap-3 font-metric text-xs text-slate-600">
        <nav aria-label="Breadcrumb" class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[15px]">home</span>
                <span>Inicio</span>
            </a>
            <span>/</span>
            <span class="text-[#051125] font-bold">Catálogo Oficial de Equipos &amp; Flotas</span>
        </nav>
        <div class="flex items-center gap-4">
            <span class="inline-flex items-center gap-1.5 text-slate-600">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Disponibilidad Oficial Perú {{ date('Y') }}</span>
            </span>
            <span class="text-slate-300 hidden sm:inline">|</span>
            <a href="https://wa.me/{{ $whatsappClean }}?text=Hola,%20deseo%20asesoria%20sobre%20el%20catalogo%20de%20RODOPERU" target="_blank" class="flex items-center gap-1 text-[#765a23] hover:text-[#051125] font-bold transition-colors">
                <span class="material-symbols-outlined text-[16px]">support_agent</span>
                <span>Línea Directa B2B</span>
            </a>
        </div>
    </div>
</div>

<!-- 2. EDITORIAL HERO BANNER -->
<section class="w-full text-white relative overflow-hidden py-12" style="background: linear-gradient(135deg, #07153b 0%, #0d2a78 60%, #155dfc 100%);">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end">
            <div class="lg:col-span-8 space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#1b263b] rounded text-[#ffdea6] font-metric text-xs border border-white/10 font-semibold">
                    <span class="material-symbols-outlined text-[16px]">verified</span>
                    <span>DISTRIBUCIÓN EXCLUSIVA • INGENIERÍA EN TRANSPORTE PESADO Y CERO EMISIONES</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-white uppercase">
                    Catálogo Industrial &amp; Flotas Comerciales
                </h1>
                <p class="font-body text-sm sm:text-base text-slate-200 max-w-2xl leading-relaxed">
                    Soluciones integrales de transporte en el Perú: vehículos 100% eléctricos de alta autonomía y semirremolques pesados Facchini con ingeniería certificada para operaciones mineras, agroindustriales y de distribución urbana.
                </p>
            </div>

            <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3">
                <div class="bg-[#1b263b]/90 border border-white/10 p-4 rounded-xl flex items-center justify-between shadow-sm">
                    <div>
                        <span class="font-metric text-[11px] text-slate-300 uppercase block">Homologación MTC</span>
                        <p class="font-headline text-lg font-bold text-[#ffdea6]">100% Certificada</p>
                    </div>
                    <span class="material-symbols-outlined text-[#ffdea6] text-[32px]">fact_check</span>
                </div>
                <div class="bg-[#1b263b]/90 border border-white/10 p-4 rounded-xl flex items-center justify-between shadow-sm">
                    <div>
                        <span class="font-metric text-[11px] text-slate-300 uppercase block">Garantía Estructural</span>
                        <p class="font-headline text-lg font-bold text-[#ffdea6]">Chasis &amp; Celdas LFP</p>
                    </div>
                    <span class="material-symbols-outlined text-[#ffdea6] text-[32px]">shield</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. SEARCH & CATEGORY FILTER BAR -->
<section class="w-full bg-white sticky top-[7.5rem] z-40 shadow-sm border-b border-slate-200 font-body">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 py-4 space-y-3">
        
        <!-- Search and Availability -->
        <form action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
            @if(request('categoria'))
                <input type="hidden" name="categoria" value="{{ request('categoria') }}">
            @endif

            <!-- Search input -->
            <div class="md:col-span-8 relative">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
                <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar por modelo, SKU (ej. EV-600, FAC-TOLVA) o tipo de carrocería..." class="w-full h-11 pl-11 pr-4 bg-slate-50 border border-slate-200 text-slate-800 rounded-lg focus:outline-none focus:border-blue-600 focus:bg-white text-xs sm:text-sm">
            </div>

            <!-- Sorting Dropdown -->
            <div class="md:col-span-4 flex items-center gap-2">
                <select name="orden" onchange="this.form.submit()" class="w-full h-11 px-3 bg-slate-50 border border-slate-200 text-slate-800 rounded-lg text-xs font-medium outline-none">
                    <option value="recientes" {{ request('orden') == 'recientes' ? 'selected' : '' }}>Ordenar por: Más Recientes</option>
                    <option value="precio_bajo" {{ request('orden') == 'precio_bajo' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
                    <option value="precio_alto" {{ request('orden') == 'precio_alto' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
                    <option value="nombre_asc" {{ request('orden') == 'nombre_asc' ? 'selected' : '' }}>Nombre: A - Z</option>
                </select>
                @if(request()->hasAny(['buscar', 'categoria', 'orden']))
                    <a href="{{ route('products.index') }}" class="h-11 px-3 rounded-lg bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600" title="Limpiar filtros">
                        <span class="material-symbols-outlined text-[18px]">undo</span>
                    </a>
                @endif
            </div>
        </form>

        <!-- Category Buttons Horizontal Scroll -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none font-metric text-xs uppercase font-semibold">
            <a href="{{ route('products.index', array_merge(request()->except(['categoria', 'page']))) }}" class="whitespace-nowrap px-4 py-2 rounded-lg transition-all {{ !request('categoria') ? 'bg-[#051125] text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Todos los Equipos ({{ $products->total() }})
            </a>
            <a href="{{ route('products.index', array_merge(request()->except('page'), ['categoria' => 'vehiculos-electricos'])) }}" class="whitespace-nowrap px-4 py-2 rounded-lg transition-all {{ request('categoria') == 'vehiculos-electricos' ? 'bg-[#051125] text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                ⚡ Vehículos 100% Eléctricos (JMEV &amp; RODO)
            </a>
            <a href="{{ route('products.index', array_merge(request()->except('page'), ['categoria' => 'implementos-rodoviarios'])) }}" class="whitespace-nowrap px-4 py-2 rounded-lg transition-all {{ request('categoria') == 'implementos-rodoviarios' ? 'bg-[#051125] text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                🚛 Implementos Rodoviarios (Facchini)
            </a>
        </div>
    </div>
</section>

<!-- 4. PRODUCTS MOSAIC GRID -->
<section class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 py-10 w-full font-body">
    
    @if($products->isEmpty())
        <div class="text-center py-20 bg-white rounded-2xl border border-slate-200 p-8">
            <span class="material-symbols-outlined text-slate-300 text-[64px]">search_off</span>
            <h3 class="font-headline text-xl font-bold text-slate-700 mt-2">No se encontraron productos con ese criterio</h3>
            <p class="text-slate-500 text-sm mt-1">Pruebe con otros términos de búsqueda o limpie los filtros.</p>
            <a href="{{ route('products.index') }}" class="inline-block mt-4 px-5 py-2.5 rounded-lg bg-[#051125] text-white text-xs font-semibold">
                Ver todos los productos
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                @php
                    $isFacchini = str_contains(strtolower($product->sku), 'fac') || str_contains(strtolower($product->name), 'facchini');
                    $specs = is_array($product->technical_specs) ? $product->technical_specs : [];
                @endphp
                <div class="rounded-2xl bg-white shadow-md overflow-hidden flex flex-col justify-between group hover:shadow-xl transition-all duration-300 border border-slate-200">
                    <div>
                        <!-- Image Container -->
                        <div class="relative w-full h-52 bg-slate-100 overflow-hidden">
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                            </a>

                            <!-- Badge Category -->
                            <div class="absolute top-2.5 left-2.5 flex flex-col gap-1">
                                <span class="px-2 py-0.5 rounded {{ $isFacchini ? 'bg-[#ffdea6] text-[#271900]' : 'bg-[#051125] text-white' }} font-metric text-[10px] font-bold">
                                    {{ $isFacchini ? 'FACCHINI PESADO' : '100% ELÉCTRICO' }}
                                </span>
                                @if($product->is_featured)
                                    <span class="px-2 py-0.5 rounded bg-emerald-600 text-white font-metric text-[10px] font-bold">DESTACADO</span>
                                @endif
                            </div>

                            @if($product->has_discount)
                                <div class="absolute top-2.5 right-2.5 bg-red-600 text-white font-metric text-xs font-bold px-2 py-0.5 rounded">
                                    -{{ $product->discount_percentage }}%
                                </div>
                            @endif
                        </div>

                        <!-- Card Content -->
                        <div class="p-5 space-y-2.5">
                            <div class="flex items-center justify-between text-slate-500 font-metric text-[11px] uppercase">
                                <span>{{ $product->brand->name ?? 'RODOPERU' }}</span>
                                <span class="font-bold text-slate-700">SKU: {{ $product->sku }}</span>
                            </div>

                            <h3 class="font-headline text-base font-bold text-[#051125] leading-snug line-clamp-2">
                                <a href="{{ route('products.show', $product->slug) }}" class="hover:text-blue-700 transition-colors">
                                    {{ $product->name }}
                                </a>
                            </h3>

                            <p class="font-body text-xs text-slate-600 line-clamp-2">
                                {{ $product->short_description ?? 'Unidad certificada y homologada para operaciones industriales y comerciales en el territorio peruano.' }}
                            </p>

                            <!-- Key Specs Mini Strip -->
                            @if(count($specs) >= 2)
                                <div class="grid grid-cols-2 gap-2 p-2 rounded-lg bg-slate-50 border border-slate-100 font-metric text-[11px]">
                                    <div>
                                        <span class="text-slate-400 block text-[9px] uppercase truncate">{{ $specs[0]['key'] }}</span>
                                        <span class="font-bold text-[#051125] truncate block">{{ $specs[0]['value'] }}</span>
                                    </div>
                                    <div>
                                        <span class="text-slate-400 block text-[9px] uppercase truncate">{{ $specs[1]['key'] }}</span>
                                        <span class="font-bold text-[#051125] truncate block">{{ $specs[1]['value'] }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="p-5 pt-0 space-y-3">
                        <div class="flex items-center justify-between border-t border-slate-100 pt-3">
                            @if($product->show_price)
                                <div>
                                    <span class="font-metric text-base font-bold text-[#051125]">
                                        {{ $currency }} {{ number_format($product->effective_price, 2) }}
                                    </span>
                                    @if($product->has_discount)
                                        <span class="block font-metric text-[10px] text-slate-400 line-through">
                                            {{ $currency }} {{ number_format($product->price, 2) }}
                                        </span>
                                    @endif
                                </div>
                            @else
                                <span class="font-metric text-xs text-[#765a23] font-bold uppercase">
                                    Cotización a Medida
                                </span>
                            @endif

                            <span class="font-metric text-[11px] text-emerald-700 font-semibold flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span>Stock Activo</span>
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <!-- WhatsApp Quote Direct -->
                            <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20cotizar%20el%20equipo%20{{ urlencode($product->name) }}%20(SKU:%20{{ $product->sku }})" target="_blank" class="flex-1 py-2 rounded-lg bg-[#25D366] hover:bg-[#20bd5a] text-white font-headline text-xs font-bold flex items-center justify-center gap-1.5 transition-colors">
                                <i class="fab fa-whatsapp text-sm"></i>
                                <span>WhatsApp</span>
                            </a>

                            <!-- Ficha Técnica Modal Button -->
                            <button type="button" onclick="openSpecModalData('{{ $product->sku }}', '{{ addslashes($product->name) }}', '{{ addslashes($product->short_description ?? '') }}', {{ json_encode($specs) }})" class="px-3 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-headline text-xs font-semibold" title="Ver Ficha Técnica">
                                <span class="material-symbols-outlined text-[18px]">description</span>
                            </button>

                            <!-- Add to cart if enabled -->
                            @if($product->action_type === 'buy' || $product->action_type === 'both')
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="px-3 py-2 rounded-lg bg-[#051125] hover:bg-[#1b263b] text-white font-headline text-xs" title="Agregar al Carrito">
                                        <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $products->links() }}
        </div>
    @endif

</section>

@endsection
