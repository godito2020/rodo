@extends('layouts.admin')

@section('title', 'Editar Producto: ' . $product->name)
@section('page_title', 'Modificar Producto')

@section('content')
<div class="card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="text-white"><i class="fas fa-edit text-warning me-2"></i> Editar: {{ $product->name }}</span>
        <div class="d-flex gap-2">
            <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="btn btn-sm btn-outline-info">
                <i class="fas fa-external-link-alt me-1"></i> Ver en la Web
            </a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver a la Lista
            </a>
        </div>
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-4">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <!-- Left Column: Core Data -->
            <div class="col-lg-8">
                <div class="p-4 rounded-3 border border-secondary mb-4 bg-dark">
                    <h6 class="text-info fw-bold mb-3 text-uppercase">1. Información Principal</h6>

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label text-light small fw-bold">Nombre del Producto / Modelo *</label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-light small fw-bold">Código SKU</label>
                            <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-light small fw-bold">Categoría *</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Seleccionar Categoría</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-light small fw-bold">Marca Ligada</label>
                            <select name="brand_id" class="form-select">
                                <option value="">Seleccionar Marca</option>
                                @foreach($brands as $b)
                                    <option value="{{ $b->id }}" {{ old('brand_id', $product->brand_id) == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label text-light small fw-bold">Resumen Corto / Subtítulo</label>
                            <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $product->short_description) }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label text-light small fw-bold">Descripción Completa</label>
                            <textarea name="description" class="form-control" rows="6">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Technical Specs Builder -->
                <div class="p-4 rounded-3 border border-secondary mb-4 bg-dark">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-info fw-bold mb-0 text-uppercase">2. Ficha Técnica / Especificaciones Dinámicas</h6>
                        <button type="button" class="btn btn-sm btn-outline-info" id="add-spec-btn">
                            <i class="fas fa-plus me-1"></i> Agregar Fila
                        </button>
                    </div>

                    <div id="specs-container">
                        @if(!empty($product->technical_specs) && is_array($product->technical_specs))
                            @foreach($product->technical_specs as $spec)
                                <div class="row g-2 mb-2 spec-row">
                                    <div class="col-md-5">
                                        <input type="text" name="spec_key[]" class="form-control form-control-sm" value="{{ $spec['key'] }}">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="spec_val[]" class="form-control form-control-sm" value="{{ $spec['value'] }}">
                                    </div>
                                    <div class="col-md-1 text-center">
                                        <button type="button" class="btn btn-sm btn-outline-danger w-100 remove-spec-btn"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row g-2 mb-2 spec-row">
                                <div class="col-md-5">
                                    <input type="text" name="spec_key[]" class="form-control form-control-sm" placeholder="Especificación (Ej: Autonomía)">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="spec_val[]" class="form-control form-control-sm" placeholder="Valor (Ej: 520 km NEDC)">
                                </div>
                                <div class="col-md-1 text-center">
                                    <button type="button" class="btn btn-sm btn-outline-danger w-100 remove-spec-btn"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- SEO Tools (Per Product) -->
                <div class="p-4 rounded-3 border border-secondary bg-dark">
                    <h6 class="text-info fw-bold mb-3 text-uppercase">3. Herramientas SEO para Posicionamiento Web</h6>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label text-light small fw-bold">Meta Título (SEO Title)</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $product->meta_title) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-light small fw-bold">Meta Descripción</label>
                            <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $product->meta_description) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-light small fw-bold">Palabras Clave (Meta Keywords)</label>
                            <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $product->meta_keywords) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Pricing, Settings, Images -->
            <div class="col-lg-4">
                <!-- Pricing & Behavior -->
                <div class="p-4 rounded-3 border border-secondary mb-4 bg-dark">
                    <h6 class="text-info fw-bold mb-3 text-uppercase">Precios & Botones de Acción</h6>

                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Precio Regular (USD $) *</label>
                        <input type="number" step="0.01" name="price" class="form-control" required value="{{ old('price', $product->price) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Precio de Oferta / Descuento (Opcional)</label>
                        <input type="number" step="0.01" name="sale_price" class="form-control" value="{{ old('sale_price', $product->sale_price) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Stock en Almacén *</label>
                        <input type="number" name="stock" class="form-control" required value="{{ old('stock', $product->stock) }}">
                    </div>

                    <hr class="border-secondary">

                    <!-- User Requirement: Mostrar o No Mostrar Precios -->
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="show_price" id="show_price" value="1" {{ old('show_price', $product->show_price) ? 'checked' : '' }}>
                        <label class="form-check-label text-light fw-bold" for="show_price">
                            Mostrar Precio al Público
                        </label>
                    </div>

                    <!-- User Requirement: Configurar si en el producto va ver boton de compra, o boton de consulta por whatsapp o correo -->
                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Acción de Compra / Consulta *</label>
                        <select name="action_type" class="form-select">
                            <option value="both" {{ old('action_type', $product->action_type) == 'both' ? 'selected' : '' }}>Ambos (Botón de Compra + Botón de WhatsApp)</option>
                            <option value="buy" {{ old('action_type', $product->action_type) == 'buy' ? 'selected' : '' }}>Solo Botón de Compra Directa</option>
                            <option value="whatsapp" {{ old('action_type', $product->action_type) == 'whatsapp' ? 'selected' : '' }}>Solo Botón de Consulta por WhatsApp</option>
                        </select>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label text-light small" for="is_featured">
                            Marcar como Producto Destacado
                        </label>
                    </div>

                    <div class="form-check mb-0">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label text-light small" for="is_active">
                            Publicado en Tienda (Activo)
                        </label>
                    </div>
                </div>

                <!-- Existing & New Images -->
                <div class="p-4 rounded-3 border border-secondary mb-4 bg-dark">
                    <h6 class="text-info fw-bold mb-3 text-uppercase">Galería de Imágenes</h6>

                    @if($product->images->count() > 0)
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @foreach($product->images as $img)
                                <div class="position-relative border p-1 rounded bg-dark {{ $img->is_primary ? 'border-info' : 'border-secondary' }}" style="width: 80px; height: 80px;">
                                    <img src="{{ asset($img->image_path) }}" alt="" class="w-100 h-100" style="object-fit: contain;">
                                    @if($img->is_primary)
                                        <span class="badge bg-info text-dark position-absolute top-0 start-0 m-1" style="font-size: 8px;">Principal</span>
                                    @else
                                        <!-- Make primary button -->
                                        <button type="submit" form="make-primary-form-{{ $img->id }}" class="btn btn-sm btn-dark position-absolute top-0 start-0 m-1 p-0 px-1" title="Hacer Principal" style="font-size: 8px;">
                                            <i class="fas fa-star text-warning"></i>
                                        </button>
                                    @endif
                                    <!-- Delete image button -->
                                    <button type="submit" form="del-img-form-{{ $img->id }}" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 p-0 px-1" title="Eliminar Imagen" style="font-size: 8px;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div>
                        <label class="form-label text-light small fw-bold">Subir Más Fotos</label>
                        <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-electric btn-lg py-3 fw-bold">
                        <i class="fas fa-save me-2"></i> Actualizar Producto
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Forms for individual image management -->
@foreach($product->images as $img)
    <form id="del-img-form-{{ $img->id }}" action="{{ route('admin.products.delete_image', $img->id) }}" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
    @if(!$img->is_primary)
        <form id="make-primary-form-{{ $img->id }}" action="{{ route('admin.products.primary_image', $img->id) }}" method="POST" style="display:none;">
            @csrf
        </form>
    @endif
@endforeach
@endsection

@push('scripts')
<script>
    document.getElementById('add-spec-btn').addEventListener('click', function() {
        const container = document.getElementById('specs-container');
        const row = document.createElement('div');
        row.className = 'row g-2 mb-2 spec-row';
        row.innerHTML = `
            <div class="col-md-5">
                <input type="text" name="spec_key[]" class="form-control form-control-sm" placeholder="Especificación (Ej: Autonomía)">
            </div>
            <div class="col-md-6">
                <input type="text" name="spec_val[]" class="form-control form-control-sm" placeholder="Valor (Ej: 520 km NEDC)">
            </div>
            <div class="col-md-1 text-center">
                <button type="button" class="btn btn-sm btn-outline-danger w-100 remove-spec-btn"><i class="fas fa-trash-alt"></i></button>
            </div>
        `;
        container.appendChild(row);
    });

    document.addEventListener('click', function(e) {
        if (e.target && (e.target.classList.contains('remove-spec-btn') || e.target.closest('.remove-spec-btn'))) {
            const btn = e.target.classList.contains('remove-spec-btn') ? e.target : e.target.closest('.remove-spec-btn');
            btn.closest('.spec-row').remove();
        }
    });
</script>
@endpush
