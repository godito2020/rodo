@extends('layouts.admin')

@section('title', 'Productos & Stock')
@section('page_title', 'Administración de Productos & Unidades')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
@endphp

@section('content')
<div class="card-custom">
    <!-- Header & Action -->
    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h5 class="text-white mb-0 font-headline"><i class="fas fa-boxes text-warning me-2"></i> Inventario de Productos</h5>
            <small style="color: #cbd5e1;">Total: {{ $products->total() }} productos registrados en el catálogo</small>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.products.create') }}" class="btn btn-electric btn-sm px-3 d-inline-flex align-items-center gap-1.5">
                <i class="fas fa-plus"></i>
                <span>Nuevo Producto</span>
            </a>
        </div>
    </div>

    <!-- Filters Strip -->
    <div class="p-3 border-bottom" style="background-color: #061122; border-color: #1e3150 !important;">
        <form action="{{ route('admin.products.index') }}" method="GET" class="row g-2">
            <div class="col-md-4">
                <input type="text" name="buscar" class="form-control form-control-sm" placeholder="Buscar por nombre o SKU..." value="{{ request('buscar') }}">
            </div>
            <div class="col-md-3">
                <select name="categoria_id" class="form-select form-select-sm">
                    <option value="">Todas las Categorías</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('categoria_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="brand_id" class="form-select form-select-sm">
                    <option value="">Todas las Marcas</option>
                    @foreach($brands as $b)
                        <option value="{{ $b->id }}" {{ request('brand_id') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-sm btn-outline-info flex-grow-1"><i class="fas fa-search me-1"></i> Filtrar</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary" title="Limpiar"><i class="fas fa-undo"></i></a>
            </div>
        </form>
    </div>

    <!-- Products Table -->
    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 70px;">Img</th>
                    <th>Producto & SKU</th>
                    <th>Categoría & Marca</th>
                    <th>Precio</th>
                    <th class="text-center">Mostrar Precio</th>
                    <th class="text-center">Modo de Acción</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">Estado</th>
                    <th class="text-end" style="width: 140px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $prod)
                    <tr>
                        <td>
                            <img src="{{ $prod->main_image_url }}" alt="{{ $prod->name }}" width="50" height="50" class="rounded p-1" style="background-color: #061122; border: 1px solid #1e3150; object-fit: contain;">
                        </td>
                        <td>
                            <div class="text-white fw-bold">{{ $prod->name }}</div>
                            <small class="font-monospace fw-semibold" style="color: #38bdf8;">SKU: {{ $prod->sku }}</small>
                            @if($prod->is_featured)
                                <span class="badge ms-1" style="background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.4); font-size: 0.65rem;">Destacado</span>
                            @endif
                        </td>
                        <td>
                            <div class="small fw-semibold text-white">{{ $prod->category->name ?? 'Sin Categoría' }}</div>
                            <small class="font-metric fw-semibold" style="color: #ffdea6;">{{ $prod->brand->name ?? 'RODOPERU' }}</small>
                        </td>
                        <td>
                            <span class="text-white fw-bold">{{ $currency }} {{ number_format($prod->effective_price, 2) }}</span>
                            @if($prod->has_discount)
                                <small class="text-danger d-block">-{{ $prod->discount_percentage }}%</small>
                            @endif
                        </td>
                        <!-- Toggle Show Price Button -->
                        <td class="text-center">
                            <form action="{{ route('admin.products.toggle_price', $prod->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $prod->show_price ? 'btn-success' : 'btn-outline-secondary' }}" style="font-size: 0.75rem;" title="Clic para alternar si se muestra el precio o se oculta">
                                    {!! $prod->show_price ? '<i class="fas fa-eye me-1"></i> Visible' : '<i class="fas fa-eye-slash me-1"></i> Oculto' !!}
                                </button>
                            </form>
                        </td>
                        <!-- Action Mode pill -->
                        <td class="text-center">
                            @if($prod->action_type === 'buy')
                                <span class="badge bg-primary"><i class="fas fa-shopping-cart me-1"></i> Solo Compra</span>
                            @elseif($prod->action_type === 'whatsapp')
                                <span class="badge bg-success"><i class="fab fa-whatsapp me-1"></i> Consulta WhatsApp</span>
                            @else
                                <span class="badge bg-info text-dark"><i class="fas fa-exchange-alt me-1"></i> Compra + WhatsApp</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge font-metric {{ $prod->stock > 3 ? '' : 'bg-danger' }}" style="{{ $prod->stock > 3 ? 'background-color: #061122; border: 1px solid #1e3150; color: #f8fafc;' : '' }}">
                                {{ $prod->stock }} unid.
                            </span>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.products.toggle_status', $prod->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $prod->is_active ? 'btn-outline-success' : 'btn-outline-danger' }}" style="font-size: 0.72rem;">
                                    {{ $prod->is_active ? 'Activo' : 'Inactivo' }}
                                </button>
                            </form>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('products.show', $prod->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary text-info" title="Ver en la Web">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
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
                        <td colspan="9" class="text-center text-muted py-5">
                            No se encontraron productos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="p-3 border-top border-secondary d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
