@extends('layouts.admin')

@section('title', 'Nuevo Producto')
@section('page_title', 'Crear Nuevo Producto / Unidad')

@section('content')
<div class="card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="text-white"><i class="fas fa-plus-circle text-info me-2"></i> Formulario de Registro de Unidad</span>
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver a la Lista
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
        @csrf
        <div class="row g-4">
            <!-- Left Column: Core Data -->
            <div class="col-lg-8">
                <div class="p-4 rounded-3 border border-secondary mb-4 bg-dark">
                    <h6 class="text-info fw-bold mb-3 text-uppercase">1. Información Principal</h6>

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label text-light small fw-bold">Nombre del Producto / Modelo *</label>
                            <input type="text" name="name" class="form-control" required placeholder="Ej: SUV RODO EV-600 100% Eléctrico" value="{{ old('name') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-light small fw-bold">Código SKU (Opcional)</label>
                            <input type="text" name="sku" class="form-control" placeholder="Ej: RODO-EV600" value="{{ old('sku') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-light small fw-bold">Categoría *</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Seleccionar Categoría</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-light small fw-bold">Marca Ligada *</label>
                            <select name="brand_id" class="form-select">
                                <option value="">Seleccionar Marca</option>
                                @foreach($brands as $b)
                                    <option value="{{ $b->id }}" {{ old('brand_id') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label text-light small fw-bold">Resumen Corto / Subtítulo</label>
                            <textarea name="short_description" class="form-control" rows="2" placeholder="Breve extracto con los puntos clave (autonomía, capacidad de carga, etc.)">{{ old('short_description') }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label text-light small fw-bold">Descripción Completa (Detalles, beneficios y equipamiento)</label>
                            <textarea name="description" class="form-control" rows="6" placeholder="Descripción detallada de la unidad...">{{ old('description') }}</textarea>
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
                    <p class="text-muted small">Agrega especificaciones técnicas como: Autonomía, Batería, Potencia de Motor, Capacidad de Carga, Ejes, Suspensión, etc.</p>

                    <div id="specs-container">
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
                    </div>
                </div>

                <!-- SEO Tools (Per Product) -->
                <div class="p-4 rounded-3 border border-secondary bg-dark">
                    <h6 class="text-info fw-bold mb-3 text-uppercase">3. Herramientas SEO para Posicionamiento Web</h6>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label text-light small fw-bold">Meta Título (SEO Title)</label>
                            <input type="text" name="meta_title" class="form-control" placeholder="Ej: SUV Eléctrico RODO EV-600 en Perú | Venta y Asesoría Oficial" value="{{ old('meta_title') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-light small fw-bold">Meta Descripción (Snippet de Google)</label>
                            <textarea name="meta_description" class="form-control" rows="2" placeholder="Resumen persuasivo de 140-160 caracteres para Google...">{{ old('meta_description') }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-light small fw-bold">Palabras Clave (Meta Keywords)</label>
                            <input type="text" name="meta_keywords" class="form-control" placeholder="suv electrico peru, rodo ev600, camioneta electrica lima" value="{{ old('meta_keywords') }}">
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
                        <input type="number" step="0.01" name="price" class="form-control" required placeholder="0.00" value="{{ old('price', 0) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Precio de Oferta / Descuento (Opcional)</label>
                        <input type="number" step="0.01" name="sale_price" class="form-control" placeholder="0.00" value="{{ old('sale_price') }}">
                        <small class="text-muted" style="font-size: 0.75rem;">Si se establece, se mostrará el badge de descuento automático.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Stock en Almacén *</label>
                        <input type="number" name="stock" class="form-control" required value="{{ old('stock', 5) }}">
                    </div>

                    <hr class="border-secondary">

                    <!-- User Requirement: Mostrar o No Mostrar Precios -->
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="show_price" id="show_price" value="1" {{ old('show_price', true) ? 'checked' : '' }}>
                        <label class="form-check-label text-light fw-bold" for="show_price">
                            Mostrar Precio al Público
                        </label>
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Si se desmarca, aparecerá como "Precio a Cotizar" para solicitar consulta.</small>
                    </div>

                    <!-- User Requirement: Configurar si en el producto va a ver boton de compra, o boton de consulta por whatsapp o correo -->
                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Acción de Compra / Consulta *</label>
                        <select name="action_type" class="form-select">
                            <option value="both" {{ old('action_type') == 'both' ? 'selected' : '' }}>Ambos (Botón de Compra + Botón de WhatsApp)</option>
                            <option value="buy" {{ old('action_type') == 'buy' ? 'selected' : '' }}>Solo Botón de Compra Directa</option>
                            <option value="whatsapp" {{ old('action_type') == 'whatsapp' ? 'selected' : '' }}>Solo Botón de Consulta por WhatsApp</option>
                        </select>
                        <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">El botón de WhatsApp pre-configurará el mensaje con modelo y SKU para el asesor.</small>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label text-light small" for="is_featured">
                            Marcar como Producto Destacado
                        </label>
                    </div>

                    <div class="form-check mb-0">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                        <label class="form-check-label text-light small" for="is_active">
                            Publicado en Tienda (Activo)
                        </label>
                    </div>
                </div>

                <!-- Multi-image Upload -->
                <div class="p-4 rounded-3 border border-secondary mb-4 bg-dark">
                    <h6 class="text-info fw-bold mb-3 text-uppercase">Imágenes del Producto</h6>
                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Subir Fotos (Múltiple selección)</label>
                        <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                        <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Formatos soportados: JPG, PNG, WEBP, SVG. La primera imagen será la principal.</small>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-electric btn-lg py-3 fw-bold">
                        <i class="fas fa-save me-2"></i> Guardar y Publicar
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('add-spec-btn').addEventListener('click', function() {
        const container = document.getElementById('specs-container');
        const row = document.createElement('div');
        row.className = 'row g-2 mb-2 spec-row';
        row.innerHTML = `
            <div class="col-md-5">
                <input type="text" name="spec_key[]" class="form-control form-control-sm" placeholder="Especificación (Ej: Batería)">
            </div>
            <div class="col-md-6">
                <input type="text" name="spec_val[]" class="form-control form-control-sm" placeholder="Valor (Ej: 86.4 kWh LFP)">
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
