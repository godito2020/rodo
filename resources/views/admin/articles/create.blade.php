@extends('layouts.admin')

@section('title', 'Publicar Artículo')
@section('page_title', 'Nuevo Artículo de Novedades / Blog')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary">
                <h5 class="text-white fw-bold mb-0">Redactar Artículo</h5>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
            </div>

            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label text-light small fw-bold">Título del Artículo *</label>
                        <input type="text" name="title" class="form-control" required placeholder="Ej: Avances de la Electromovilidad en Perú 2026" value="{{ old('title') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light small fw-bold">Categoría *</label>
                        <input type="text" name="category" class="form-control" required placeholder="Ej: Electromovilidad, Implementos" value="{{ old('category', 'Electromovilidad') }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Resumen / Extracto</label>
                        <textarea name="summary" class="form-control" rows="2" placeholder="Breve síntesis para redes y lista...">{{ old('summary') }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Contenido del Artículo (HTML o Texto) *</label>
                        <textarea name="content" class="form-control" rows="8" required placeholder="Escribe el cuerpo del artículo con subtítulos y párrafos...">{{ old('content') }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Imagen de Cabecera</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Meta Título (SEO)</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Meta Descripción (SEO)</label>
                        <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description') }}">
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_published" id="artPublish" value="1" checked>
                            <label class="form-check-label text-light small" for="artPublish">Publicar inmediatamente en el blog</label>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-electric w-100 py-3 fw-bold">
                            Publicar Artículo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
