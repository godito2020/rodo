@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
@endphp

<div class="product-card">
    <div class="card-img-wrap">
        <a href="{{ route('products.show', $product->slug) }}" class="w-100 h-100 d-flex align-items-center justify-content-center">
            <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" loading="lazy">
        </a>

        @if($product->category)
            <span class="product-badge-tech">
                {{ $product->category->name }}
            </span>
        @endif

        @if($product->has_discount && $product->show_price)
            <span class="product-badge-discount">
                -{{ $product->discount_percentage }}% OFF
            </span>
        @endif
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <small class="text-info fw-bold text-uppercase" style="font-size: 0.75rem;">
                {{ $product->brand->name ?? 'RODOPERU' }}
            </small>
            <small class="text-muted" style="font-size: 0.72rem;">
                SKU: {{ $product->sku }}
            </small>
        </div>

        <a href="{{ route('products.show', $product->slug) }}" class="product-title" title="{{ $product->name }}">
            {{ $product->name }}
        </a>

        <!-- Specs pills preview -->
        @if(!empty($product->technical_specs) && is_array($product->technical_specs))
            <div class="my-2" style="min-height: 28px;">
                @foreach(array_slice($product->technical_specs, 0, 2) as $spec)
                    <span class="spec-pill">
                        <strong>{{ $spec['key'] }}:</strong> {{ $spec['value'] }}
                    </span>
                @endforeach
            </div>
        @else
            <div class="my-2" style="min-height: 28px;"></div>
        @endif

        <!-- Price display -->
        <div class="my-2 pt-2 border-top border-dark">
            @if($product->show_price)
                <div class="d-flex align-items-baseline gap-2">
                    <span class="fs-5 fw-bold text-white">
                        {{ $currency }} {{ number_format($product->effective_price, 2) }}
                    </span>
                    @if($product->has_discount)
                        <span class="text-decoration-line-through text-muted small">
                            {{ $currency }} {{ number_format($product->price, 2) }}
                        </span>
                    @endif
                </div>
                <small class="text-success" style="font-size: 0.72rem;"><i class="fas fa-check-circle me-1"></i> Stock Disponible</small>
            @else
                <div class="py-1">
                    <span class="badge bg-dark border border-secondary text-light px-3 py-2">
                        <i class="fas fa-lock text-warning me-1"></i> Precio a Cotizar
                    </span>
                    <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">Consulte disponibilidad y plazos de entrega</small>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="mt-auto pt-3 d-flex flex-column gap-2">
            @if($product->action_type === 'buy' || $product->action_type === 'both')
                <form action="{{ route('cart.add') }}" method="POST" class="w-100">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-outline-electric w-100 py-2 d-flex align-items-center justify-content-center gap-2">
                        <i class="fas fa-shopping-cart"></i> Agregar al Carrito
                    </button>
                </form>
            @endif

            @if($product->action_type === 'whatsapp' || $product->action_type === 'both')
                <a href="{{ $product->whatsapp_inquiry_url }}" target="_blank" class="btn btn-whatsapp-quote w-100 py-2 d-flex align-items-center justify-content-center gap-2">
                    <i class="fab fa-whatsapp"></i> Consultar WhatsApp
                </a>
            @endif

            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-link text-info text-decoration-none text-center" style="font-size: 0.8rem;">
                Ver Ficha Técnica <i class="fas fa-chevron-right ms-1"></i>
            </a>
        </div>
    </div>
</div>
