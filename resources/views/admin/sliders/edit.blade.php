@extends('layouts.admin')

@section('title', 'Editar Slider: ' . $slider->title)
@section('page_title', 'Modificar Slider')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary">
                <h5 class="text-white fw-bold mb-0">Modificar Slider</h5>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
            </div>

            <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Título del Slider *</label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title', $slider->title) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Subtítulo</label>
                        <textarea name="subtitle" class="form-control" rows="2">{{ old('subtitle', $slider->subtitle) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Badge Promocional</label>
                        <input type="text" name="badge" class="form-control" value="{{ old('badge', $slider->badge) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Orden</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $slider->order) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Texto del Botón</label>
                        <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $slider->button_text) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Enlace del Botón (URL)</label>
                        <input type="text" name="button_url" class="form-control" value="{{ old('button_url', $slider->button_url) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Imagen Actual:</label>
                        <div class="p-2 bg-dark rounded border border-secondary mb-2">
                            <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}" class="img-fluid" style="max-height: 120px;">
                        </div>
                        <label class="form-label text-light small fw-bold">Reemplazar Imagen (Opcional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="sliderActive" value="1" {{ $slider->is_active ? 'checked' : '' }}>
                            <label class="form-check-label text-light small" for="sliderActive">Slider Activo en la Portada</label>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-electric w-100 py-3 fw-bold">
                            Actualizar Slider
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
