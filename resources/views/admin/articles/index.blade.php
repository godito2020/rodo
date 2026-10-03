@extends('layouts.admin')

@section('title', 'Novedades / Blog')
@section('page_title', 'Administración de Novedades & Artículos')

@section('content')
<div class="card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="text-white mb-0"><i class="fas fa-newspaper text-light me-2"></i> Artículos Publicados</h5>
            <small class="text-muted">Total: {{ $articles->total() }} artículos</small>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-electric btn-sm">
            <i class="fas fa-plus me-1"></i> Publicar Artículo
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 80px;">Img</th>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th class="text-center">Vistas</th>
                    <th class="text-center">Estado</th>
                    <th>Fecha</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $art)
                    <tr>
                        <td>
                            <img src="{{ $art->image_url }}" alt="" width="60" height="40" class="rounded object-fit-cover">
                        </td>
                        <td>
                            <div class="text-white fw-bold">{{ $art->title }}</div>
                            <small class="text-muted font-monospace">{{ $art->slug }}</small>
                        </td>
                        <td>
                            <span class="badge bg-dark border border-info text-info">{{ $art->category }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-secondary">{{ $art->views_count }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $art->is_published ? 'bg-success' : 'bg-danger' }}">
                                {{ $art->is_published ? 'Publicado' : 'Borrador' }}
                            </span>
                        </td>
                        <td class="text-muted small">
                            {{ $art->created_at->format('d/m/Y') }}
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('novedades.show', $art->slug) }}" target="_blank" class="btn btn-sm btn-outline-info" title="Ver en la Web">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <a href="{{ route('admin.articles.edit', $art->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.articles.destroy', $art->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este artículo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">No hay artículos publicados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($articles->hasPages())
        <div class="p-3 border-top border-secondary d-flex justify-content-center">
            {{ $articles->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
