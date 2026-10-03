@extends('layouts.admin')

@section('title', 'Sliders de Inicio')
@section('page_title', 'Administración de Sliders Principales')

@section('content')
<div class="card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="text-white mb-0"><i class="fas fa-images text-info me-2"></i> Sliders del Encabezado Principal</h5>
            <small class="text-muted">Imágenes y llamadas a la acción en la portada de RODOPERU</small>
        </div>
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-electric btn-sm">
            <i class="fas fa-plus me-1"></i> Nuevo Slider
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 120px;">Imagen</th>
                    <th>Título & Subtítulo</th>
                    <th>Badge Promocional</th>
                    <th>Botón & Enlace</th>
                    <th class="text-center">Orden</th>
                    <th class="text-center">Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sliders as $s)
                    <tr>
                        <td>
                            <img src="{{ $s->image_url }}" alt="{{ $s->title }}" class="img-fluid rounded border border-secondary" style="max-height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="text-white fw-bold">{{ $s->title }}</div>
                            <small class="text-muted">{{ $s->subtitle }}</small>
                        </td>
                        <td>
                            <span class="badge bg-dark border border-info text-info">{{ $s->badge ?: '—' }}</span>
                        </td>
                        <td>
                            <span class="text-light small fw-bold">{{ $s->button_text ?: 'Sin botón' }}</span>
                            <small class="text-muted d-block font-monospace" style="font-size: 0.72rem;">{{ $s->button_url }}</small>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-secondary">{{ $s->order }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $s->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $s->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('admin.sliders.edit', $s->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.sliders.destroy', $s->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este slider?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">No hay sliders registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
