@extends('layouts.admin')

@section('title', 'Editar Artículo: ' . $article->title)
@section('page_title', 'Modificar Artículo')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary">
                <h5 class="text-white fw-bold mb-0">Modificar Artículo</h5>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
            </div>

            <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label text-light small fw-bold">Título del Artículo *</label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title', $article->title) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light small fw-bold">Categoría *</label>
                        <input type="text" name="category" class="form-control" required value="{{ old('category', $article->category) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Resumen / Extracto</label>
                        <textarea name="summary" class="form-control" rows="2">{{ old('summary', $article->summary) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Contenido del Artículo *</label>
                        <textarea name="content" class="form-control" rows="8" required>{{ old('content', $article->content) }}</textarea>
                    </div>

                    <div class="col-12">
                        @if($article->image_path)
                            <div class="p-2 bg-dark rounded border border-secondary mb-2">
                                <img src="{{ $article->image_url }}" alt="" class="img-fluid" style="max-height: 120px;">
                            </div>
                        @endif
                        <label class="form-label text-light small fw-bold">Reemplazar Imagen</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Meta Título (SEO)</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $article->meta_title) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Meta Descripción (SEO)</label>
                        <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description', $article->meta_description) }}">
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_published" id="artPublish" value="1" {{ $article->is_published ? 'checked' : '' }}>
                            <label class="form-check-label text-light small" for="artPublish">Artículo Publicado en el Blog</label>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-electric w-100 py-3 fw-bold">
                            Actualizar Artículo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
