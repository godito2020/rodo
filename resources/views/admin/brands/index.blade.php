@extends('layouts.admin')

@section('title', 'Marcas')
@section('page_title', 'Marcas Ligadas a Productos')

@section('content')
<div class="row g-4">
    <!-- List -->
    <div class="col-lg-8">
        <div class="card-custom">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="text-white"><i class="fas fa-tags text-info me-2"></i> Marcas Registradas</span>
                <span class="badge bg-dark border border-secondary">{{ $brands->count() }} marcas</span>
            </div>
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Marca</th>
                            <th>Descripción</th>
                            <th class="text-center">Productos</th>
                            <th class="text-center">Destacada</th>
                            <th class="text-center">Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($brands as $b)
                            <tr>
                                <td>
                                    <div class="text-white fw-bold">{{ $b->name }}</div>
                                    <small class="text-muted font-monospace">{{ $b->slug }}</small>
                                </td>
                                <td>
                                    <small class="text-muted">{{ Str::limit($b->description, 50) ?: 'Sin descripción' }}</small>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-dark border border-info text-info">{{ $b->products_count }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $b->is_featured ? 'bg-warning text-dark' : 'bg-secondary' }}">
                                        {{ $b->is_featured ? 'Sí' : 'No' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $b->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $b->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('admin.brands.edit', $b->id) }}" class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.brands.destroy', $b->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta marca?')">
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
                                <td colspan="6" class="text-center text-muted py-4">No hay marcas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Column -->
    <div class="col-lg-4">
        <div class="card-custom p-4">
            <h5 class="text-white fw-bold mb-3 pb-2 border-bottom border-secondary"><i class="fas fa-plus-circle text-info me-2"></i> Nueva Marca</h5>

            <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Nombre de la Marca *</label>
                    <input type="text" name="name" class="form-control" required placeholder="Ej: Facchini Rodoviários">
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Sitio Web Oficial (Opcional)</label>
                    <input type="url" name="website" class="form-control" placeholder="https://www.facchini.com.br">
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Descripción</label>
                    <textarea name="description" class="form-control" rows="2" placeholder="Breve reseña de la marca..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Orden</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="is_featured" id="brandFeatured" value="1">
                    <label class="form-check-label text-light small" for="brandFeatured">Marca Destacada en Inicio</label>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="is_active" id="brandActive" value="1" checked>
                    <label class="form-check-label text-light small" for="brandActive">Marca Activa</label>
                </div>

                <button type="submit" class="btn btn-electric w-100 py-2 fw-bold">
                    Guardar Marca
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
