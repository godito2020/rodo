@extends('layouts.admin')

@section('title', 'Nuevo Banner')
@section('page_title', 'Crear Banner Promocional')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary">
                <h5 class="text-white fw-bold mb-0">Nuevo Banner</h5>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
            </div>

            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Título del Banner *</label>
                        <input type="text" name="title" class="form-control" required placeholder="Ej: Bonos de Fin de Año en Implementos" value="{{ old('title') }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Subtítulo / Texto</label>
                        <textarea name="subtitle" class="form-control" rows="2">{{ old('subtitle') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Ubicación / Tipo *</label>
                        <select name="type" class="form-select">
                            <option value="middle">Intermedio en Portada</option>
                            <option value="hero_side">Lateral Destacado</option>
                            <option value="footer">Pie de Página</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Orden</label>
                        <input type="number" name="order" class="form-control" value="0">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Texto del Botón</label>
                        <input type="text" name="button_text" class="form-control" placeholder="Ej: Conoce Más" value="{{ old('button_text') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Enlace de Destino (URL)</label>
                        <input type="text" name="button_url" class="form-control" placeholder="/contacto" value="{{ old('button_url') }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Imagen de Banner (Opcional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="bannerActive" value="1" checked>
                            <label class="form-check-label text-light small" for="bannerActive">Banner Activo</label>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-electric w-100 py-3 fw-bold">
                            Guardar Banner
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
