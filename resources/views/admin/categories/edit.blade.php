@extends('layouts.admin')

@section('title', 'Editar Categoría: ' . $category->name)
@section('page_title', 'Editar Categoría')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary">
                <h5 class="text-white fw-bold mb-0">Modificar: {{ $category->name }}</h5>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
            </div>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Nombre *</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $category->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Categoría Padre</label>
                    <select name="parent_id" class="form-select">
                        <option value="">Ninguna (Categoría Principal)</option>
                        @foreach($parentCategories as $pCat)
                            <option value="{{ $pCat->id }}" {{ $category->parent_id == $pCat->id ? 'selected' : '' }}>{{ $pCat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Descripción</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Orden</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $category->order) }}">
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="is_active" id="catActive" value="1" {{ $category->is_active ? 'checked' : '' }}>
                    <label class="form-check-label text-light small" for="catActive">Categoría Activa</label>
                </div>

                <button type="submit" class="btn btn-electric w-100 py-2 fw-bold">
                    Actualizar Categoría
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
