@extends('layouts.admin')

@section('title', 'Nuevo Slider')
@section('page_title', 'Crear Slider para Inicio')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary">
                <h5 class="text-white fw-bold mb-0">Nuevo Slider Principal</h5>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
            </div>

            <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Título del Slider *</label>
                        <input type="text" name="title" class="form-control" required placeholder="Ej: Nueva Era de Electromovilidad en el Perú" value="{{ old('title') }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Subtítulo / Bajada</label>
                        <textarea name="subtitle" class="form-control" rows="2" placeholder="Ej: Descubre la línea de vehículos 100% eléctricos de alta autonomía...">{{ old('subtitle') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Badge Promocional (Opcional)</label>
                        <input type="text" name="badge" class="form-control" placeholder="Ej: 100% ELÉCTRICO · CERO EMISIONES" value="{{ old('badge') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Orden</label>
                        <input type="number" name="order" class="form-control" value="0">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Texto del Botón</label>
                        <input type="text" name="button_text" class="form-control" placeholder="Ej: Ver Modelos" value="{{ old('button_text', 'Ver Modelos') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Enlace del Botón (URL)</label>
                        <input type="text" name="button_url" class="form-control" placeholder="/productos?categoria=vehiculos-electricos" value="{{ old('button_url') }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Imagen de Fondo (Recomendado 1600x600 o similar) *</label>
                        <input type="file" name="image" class="form-control" required accept="image/*">
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="sliderActive" value="1" checked>
                            <label class="form-check-label text-light small" for="sliderActive">Slider Activo en la Portada</label>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-electric w-100 py-3 fw-bold">
                            Guardar y Publicar Slider
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
