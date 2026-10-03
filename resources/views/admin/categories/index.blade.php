@extends('layouts.admin')

@section('title', 'Categorías')
@section('page_title', 'Categorías de Productos')

@section('content')
<div class="row g-4">
    <!-- List Column -->
    <div class="col-lg-8">
        <div class="card-custom">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="text-white"><i class="fas fa-layer-group text-info me-2"></i> Árbol de Categorías</span>
                <span class="badge bg-dark border border-secondary">{{ $categories->count() }} registradas</span>
            </div>
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoría Padre</th>
                            <th class="text-center">Productos</th>
                            <th class="text-center">Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $cat)
                            <tr>
                                <td>
                                    <div class="text-white fw-bold {{ $cat->parent_id ? 'ms-3 text-info' : '' }}">
                                        {!! $cat->parent_id ? '<i class="fas fa-level-up-alt fa-rotate-90 me-1"></i>' : '<i class="fas fa-folder text-warning me-1"></i>' !!}
                                        {{ $cat->name }}
                                    </div>
                                    <small class="text-muted font-monospace">{{ $cat->slug }}</small>
                                </td>
                                <td>
                                    <span class="text-muted small">{{ $cat->parent ? $cat->parent->name : 'Principal' }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-dark border border-secondary">{{ $cat->products_count }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $cat->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $cat->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?')">
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
                                <td colspan="5" class="text-center text-muted py-4">No hay categorías registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Create Column -->
    <div class="col-lg-4">
        <div class="card-custom p-4">
            <h5 class="text-white fw-bold mb-3 pb-2 border-bottom border-secondary"><i class="fas fa-plus-circle text-info me-2"></i> Nueva Categoría</h5>

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Nombre *</label>
                    <input type="text" name="name" class="form-control" required placeholder="Ej: Camiones Eléctricos">
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Categoría Padre (Opcional)</label>
                    <select name="parent_id" class="form-select">
                        <option value="">Ninguna (Categoría Principal)</option>
                        @foreach($categories->whereNull('parent_id') as $pCat)
                            <option value="{{ $pCat->id }}">{{ $pCat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Descripción</label>
                    <textarea name="description" class="form-control" rows="2" placeholder="Breve descripción..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Orden de Aparición</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="is_active" id="catActive" value="1" checked>
                    <label class="form-check-label text-light small" for="catActive">Activa</label>
                </div>

                <button type="submit" class="btn btn-electric w-100 py-2 fw-bold">
                    Guardar Categoría
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
