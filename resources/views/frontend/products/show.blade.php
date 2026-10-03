@extends('layouts.app')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
    $metaTitle = $product->meta_title ?: ($product->name . ' | RODOPERU');
    $metaDescription = $product->meta_description ?: Str::limit(strip_tags($product->short_description), 155);
    $metaKeywords = $product->meta_keywords ?: ($product->name . ', ' . ($product->brand->name ?? '') . ', vehiculos electricos, facchini');
    $metaImage = $product->main_image_url;
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
<div class="py-3" style="background: #091022; border-bottom: 1px solid var(--border-dark);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-info text-decoration-none">Productos</a></li>
                @if($product->category)
                    <li class="breadcrumb-item"><a href="{{ route('products.index', ['categoria' => $product->category->slug]) }}" class="text-info text-decoration-none">{{ $product->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Left: Gallery Showcase (JMEV / Facchini Style) -->
            <div class="col-lg-6">
                <div class="p-3 rounded-4 border border-secondary" style="background: #0d1527;">
                    <!-- Main Image Preview -->
                    <div class="d-flex align-items-center justify-content-center p-4 rounded-3 mb-3" style="background: #070d1a; min-height: 380px;">
                        <img id="mainProductDisplayImage" src="{{ $product->main_image_url }}" alt="{{ $product->name }}" class="img-fluid" style="max-height: 380px; object-fit: contain; transition: all 0.3s;">
                    </div>

                    <!-- Thumbnails row -->
                    @if($product->images->count() > 1)
                        <div class="d-flex gap-2 overflow-auto pb-2">
                            @foreach($product->images as $img)
                                <div class="border rounded p-1 cursor-pointer thumbnail-box {{ $loop->first ? 'border-info' : 'border-secondary' }}" style="width: 75px; height: 75px; background: #070d1a; flex-shrink: 0; cursor: pointer;" onclick="changeMainImage('{{ asset($img->image_path) }}', this)">
                                    <img src="{{ asset($img->image_path) }}" alt="{{ $product->name }}" class="w-100 h-100" style="object-fit: contain;">
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-4 p-3 rounded border border-dark text-center" style="background: rgba(0, 242, 254, 0.05);">
                        <small class="text-muted"><i class="fas fa-check-double text-info me-1"></i> Unidad Homologada para Perú con Respaldo y Garantía de Fábrica</small>
                    </div>
                </div>
            </div>

            <!-- Right: Product Information & Purchase / WhatsApp Actions -->
            <div class="col-lg-6">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-dark border border-info text-info text-uppercase px-3 py-1 font-weight-bold">
                        {{ $product->brand->name ?? 'RODOPERU' }}
                    </span>
                    <span class="text-muted small">|</span>
                    <span class="badge bg-secondary text-light">SKU: {{ $product->sku }}</span>
                    @if($product->stock > 0)
                        <span class="badge bg-success text-white"><i class="fas fa-check-circle me-1"></i> En Stock</span>
                    @else
                        <span class="badge pill-badge-amber"><i class="fas fa-clock me-1"></i> Fabricación / A Pedido</span>
                    @endif
                </div>

                <h1 class="display-6 fw-bold text-white mb-3">{{ $product->name }}</h1>

                <!-- Short description -->
                @if($product->short_description)
                    <p class="text-light lead mb-4" style="font-size: 1.05rem; line-height: 1.6;">
                        {{ $product->short_description }}
                    </p>
                @endif

                <!-- Pricing Box (Respecting show_price setting) -->
                <div class="p-4 rounded-3 border border-secondary mb-4" style="background: #0f1930;">
                    @if($product->show_price)
                        <div class="d-flex align-items-baseline gap-3">
                            <span class="display-5 fw-bold text-white">
                                {{ $currency }} {{ number_format($product->effective_price, 2) }}
                            </span>
                            @if($product->has_discount)
                                <span class="fs-4 text-decoration-line-through text-muted">
                                    {{ $currency }} {{ number_format($product->price, 2) }}
                                </span>
                                <span class="badge bg-danger fs-6">-{{ $product->discount_percentage }}% OFF</span>
                            @endif
                        </div>
                        <small class="text-muted d-block mt-1">Precio incluye IGV. Facturación electrónica inmediata.</small>
                    @else
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 rounded-circle bg-dark text-warning border border-secondary fs-3">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <div>
                                <h4 class="text-white fw-bold mb-0">Precio Disponible a Cotización</h4>
                                <small class="text-muted">Por configuración técnica y opciones de personalización, solicite cotización directa.</small>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons: Buy / WhatsApp / Seller Chat -->
                <div class="d-flex flex-column gap-3 mb-4">
                    @if($product->action_type === 'buy' || $product->action_type === 'both')
                        <form action="{{ route('cart.add') }}" method="POST" class="d-flex gap-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div style="width: 100px;">
                                <input type="number" name="quantity" class="form-control form-control-lg bg-dark text-white border-secondary text-center fw-bold" value="1" min="1" max="{{ max(1, $product->stock) }}">
                            </div>
                            <button type="submit" class="btn btn-electric btn-lg flex-grow-1 py-3 fw-bold">
                                <i class="fas fa-shopping-cart me-2"></i> Añadir al Carrito
                            </button>
                        </form>
                    @endif

                    @if($product->action_type === 'whatsapp' || $product->action_type === 'both')
                        <a href="{{ $product->whatsapp_inquiry_url }}" target="_blank" class="btn btn-whatsapp-quote btn-lg py-3 fw-bold d-flex align-items-center justify-content-center">
                            <i class="fab fa-whatsapp fs-4 me-2"></i> Consultar por WhatsApp
                        </a>
                        <small class="text-muted text-center" style="font-size: 0.78rem;">
                            <i class="fas fa-info-circle me-1"></i> Se enviará automáticamente el modelo y código SKU al asesor comercial.
                        </small>
                    @endif

                    <!-- User Chat with Seller Button -->
                    <div class="pt-2">
                        <form action="{{ route('customer.chat_start') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-outline-info w-100 py-2 fw-semibold">
                                <i class="fas fa-comments me-2"></i> Chatear en Vivo con Asesor Técnico sobre esta Unidad
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Value Highlights Cards -->
                <div class="row g-2 pt-3 border-top border-secondary">
                    <div class="col-4 text-center">
                        <div class="p-2 rounded bg-dark border border-secondary">
                            <i class="fas fa-truck text-info d-block mb-1"></i>
                            <small class="text-light" style="font-size: 0.75rem;">Entrega en Todo Perú</small>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="p-2 rounded bg-dark border border-secondary">
                            <i class="fas fa-shield-alt text-success d-block mb-1"></i>
                            <small class="text-light" style="font-size: 0.75rem;">Garantía de Fábrica</small>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="p-2 rounded bg-dark border border-secondary">
                            <i class="fas fa-tools text-warning d-block mb-1"></i>
                            <small class="text-light" style="font-size: 0.75rem;">Servicio Técnico</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Technical Specifications Table (Facchini / JMEV Style) -->
        <div class="mt-5 pt-4">
            <ul class="nav nav-pills mb-4 gap-2 border-bottom border-secondary pb-3" id="productDetailTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active px-4 py-2 fw-bold text-uppercase" id="specs-tab" data-bs-toggle="pill" data-bs-target="#specs-pane">
                        <i class="fas fa-list-alt me-2"></i> Ficha Técnica
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link px-4 py-2 fw-bold text-uppercase" id="desc-tab" data-bs-toggle="pill" data-bs-target="#desc-pane">
                        <i class="fas fa-align-left me-2"></i> Descripción Detallada
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="productDetailTabsContent">
                <!-- Technical specs pane -->
                <div class="tab-pane fade show active" id="specs-pane">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="table-responsive rounded-3 border border-secondary overflow-hidden">
                                <table class="table table-dark table-striped mb-0" style="font-size: 0.95rem;">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold text-info" style="width: 35%;">Marca Homologada</td>
                                            <td class="text-white">{{ $product->brand->name ?? 'RODOPERU' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-info">Código de Modelo (SKU)</td>
                                            <td class="text-white font-monospace">{{ $product->sku }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-info">Categoría / Aplicación</td>
                                            <td class="text-white">{{ $product->category->name ?? 'General' }}</td>
                                        </tr>
                                        @if(!empty($product->technical_specs) && is_array($product->technical_specs))
                                            @foreach($product->technical_specs as $spec)
                                                <tr>
                                                    <td class="fw-bold text-info">{{ $spec['key'] }}</td>
                                                    <td class="text-white">{{ $spec['value'] }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <div class="p-4 rounded-3 border border-info" style="background: rgba(0, 242, 254, 0.05);">
                                <h5 class="text-info fw-bold mb-3"><i class="fas fa-file-pdf me-2"></i> ¿Deseas la Ficha en PDF?</h5>
                                <p class="text-muted small mb-3">
                                    Nuestros ingenieros de producto pueden enviarte los planos de carga, curva de potencia o especificaciones de basculamiento.
                                </p>
                                <a href="https://api.whatsapp.com/send?phone={{ \App\Models\Setting::get('whatsapp_number', '+51987654321') }}&text={{ rawurlencode('Hola RODOPERU, solicito la ficha técnica en PDF y planos del modelo ' . $product->name . ' (SKU: ' . $product->sku . ')') }}" target="_blank" class="btn btn-outline-electric w-100 py-2">
                                    <i class="fab fa-whatsapp me-1"></i> Pedir Ficha Técnica PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description pane -->
                <div class="tab-pane fade" id="desc-pane">
                    <div class="p-4 rounded-3 border border-secondary text-light" style="background: #0f182e; font-size: 1rem; line-height: 1.8;">
                        @if($product->description)
                            {!! $product->description !!}
                        @else
                            <p>{{ $product->short_description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Related products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-5 pt-5 border-top border-secondary">
            <h3 class="display-6 fw-bold text-white mb-4">Modelos Relacionados</h3>
            <div class="row g-4">
                @foreach($relatedProducts as $rel)
                    <div class="col-md-6 col-lg-3">
                        @include('frontend.products.partials.card', ['product' => $rel])
                    </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>
@endsection

@push('scripts')
<script>
    function changeMainImage(src, element) {
        document.getElementById('mainProductDisplayImage').src = src;
        document.querySelectorAll('.thumbnail-box').forEach(el => {
            el.classList.remove('border-info');
            el.classList.add('border-secondary');
        });
        element.classList.remove('border-secondary');
        element.classList.add('border-info');
    }
</script>
@endpush
