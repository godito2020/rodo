@extends('layouts.admin')

@section('title', 'Editar Banner: ' . $banner->title)
@section('page_title', 'Modificar Banner')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary">
                <h5 class="text-white fw-bold mb-0">Modificar Banner</h5>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
            </div>

            <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Título del Banner *</label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title', $banner->title) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Subtítulo / Texto</label>
                        <textarea name="subtitle" class="form-control" rows="2">{{ old('subtitle', $banner->subtitle) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Ubicación / Tipo *</label>
                        <select name="type" class="form-select">
                            <option value="middle" {{ $banner->type === 'middle' ? 'selected' : '' }}>Intermedio en Portada</option>
                            <option value="hero_side" {{ $banner->type === 'hero_side' ? 'selected' : '' }}>Lateral Destacado</option>
                            <option value="footer" {{ $banner->type === 'footer' ? 'selected' : '' }}>Pie de Página</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Orden</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $banner->order) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Texto del Botón</label>
                        <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $banner->button_text) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Enlace de Destino (URL)</label>
                        <input type="text" name="button_url" class="form-control" value="{{ old('button_url', $banner->button_url) }}">
                    </div>

                    <div class="col-12">
                        @if($banner->image_path)
                            <div class="p-2 bg-dark rounded border border-secondary mb-2">
                                <img src="{{ $banner->image_url }}" alt="" class="img-fluid" style="max-height: 100px;">
                            </div>
                        @endif
                        <label class="form-label text-light small fw-bold">Reemplazar Imagen</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="bannerActive" value="1" {{ $banner->is_active ? 'checked' : '' }}>
                            <label class="form-check-label text-light small" for="bannerActive">Banner Activo</label>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-electric w-100 py-3 fw-bold">
                            Actualizar Banner
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
