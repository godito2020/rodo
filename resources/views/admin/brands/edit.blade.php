@extends('layouts.admin')

@section('title', 'Editar Marca: ' . $brand->name)
@section('page_title', 'Modificar Marca')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary">
                <h5 class="text-white fw-bold mb-0">Modificar: {{ $brand->name }}</h5>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
            </div>

            <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Nombre *</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $brand->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Sitio Web</label>
                    <input type="url" name="website" class="form-control" value="{{ old('website', $brand->website) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Descripción</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $brand->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Orden</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $brand->order) }}">
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="is_featured" id="brandFeatured" value="1" {{ $brand->is_featured ? 'checked' : '' }}>
                    <label class="form-check-label text-light small" for="brandFeatured">Marca Destacada en Inicio</label>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="is_active" id="brandActive" value="1" {{ $brand->is_active ? 'checked' : '' }}>
                    <label class="form-check-label text-light small" for="brandActive">Marca Activa</label>
                </div>

                <button type="submit" class="btn btn-electric w-100 py-2 fw-bold">
                    Actualizar Marca
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
