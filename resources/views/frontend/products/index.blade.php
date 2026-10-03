@extends('layouts.app')

@section('title', 'Catálogo de Vehículos Eléctricos e Implementos Rodoviarios | RODOPERU')
@section('meta_description', 'Explora nuestro catálogo completo de SUVs eléctricos, city cars, camiones EV, semirremolques furgón y tolvas Facchini en Perú.')

@section('content')
<div class="py-4" style="background: #091022; border-bottom: 1px solid var(--border-dark);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Catálogo de Productos</li>
            </ol>
        </nav>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
            <div>
                <h1 class="h2 fw-bold text-white mb-0">Catálogo General de Unidades</h1>
                <p class="text-muted small mb-0">Mostrando {{ $products->total() }} modelos disponibles con entrega y soporte oficial en Perú</p>
            </div>
            @if(request('buscar'))
                <span class="badge bg-dark border border-info text-info p-2 mt-2 mt-md-0">
                    Búsqueda: "{{ request('buscar') }}" 
                    <a href="{{ route('products.index') }}" class="text-danger ms-2"><i class="fas fa-times"></i></a>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Sidebar Filters -->
            <div class="col-lg-3">
                <div class="p-4 rounded-3 border border-secondary" style="background: #0f182e; position: sticky; top: 100px;">
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-secondary">
                        <h5 class="text-white mb-0"><i class="fas fa-filter text-info me-2"></i> Filtros</h5>
                        <a href="{{ route('products.index') }}" class="text-muted small text-decoration-none hover-cyan">Limpiar</a>
                    </div>

                    <form action="{{ route('products.index') }}" method="GET" id="catalog-filter-form">
                        @if(request('buscar'))
                            <input type="hidden" name="buscar" value="{{ request('buscar') }}">
                        @endif

                        <!-- Categories filter -->
                        <div class="mb-4">
                            <label class="form-label text-light fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Categorías</label>
                            <div class="d-flex flex-column gap-2" style="font-size: 0.88rem;">
                                <a href="{{ route('products.index', array_merge(request()->except('categoria'), ['page' => 1])) }}" class="text-decoration-none {{ !request('categoria') ? 'text-info fw-bold' : 'text-light' }}">
                                    <i class="fas fa-th-large me-1"></i> Todas las Categorías
                                </a>
                                @foreach($categories as $cat)
                                    <div>
                                        <a href="{{ route('products.index', array_merge(request()->all(), ['categoria' => $cat->slug, 'page' => 1])) }}" class="text-decoration-none {{ request('categoria') === $cat->slug ? 'text-info fw-bold' : 'text-light' }}">
                                            <strong>{{ $cat->name }}</strong> ({{ $cat->products_count }})
                                        </a>
                                        @if($cat->children->count() > 0)
                                            <div class="ms-3 mt-1 d-flex flex-column gap-1">
                                                @foreach($cat->children as $sub)
                                                    <a href="{{ route('products.index', array_merge(request()->all(), ['categoria' => $sub->slug, 'page' => 1])) }}" class="text-decoration-none small {{ request('categoria') === $sub->slug ? 'text-info fw-bold' : 'text-muted' }}">
                                                        • {{ $sub->name }} ({{ $sub->products_count }})
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Brand filter -->
                        <div class="mb-4">
                            <label class="form-label text-light fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Marcas</label>
                            <div class="d-flex flex-column gap-2">
                                @foreach($brands as $b)
                                    <label class="form-check text-light mb-0 small" style="cursor: pointer;">
                                        <input class="form-check-input" type="radio" name="marca" value="{{ $b->slug }}" {{ request('marca') === $b->slug ? 'checked' : '' }} onchange="document.getElementById('catalog-filter-form').submit()">
                                        <span class="ms-1">{{ $b->name }} ({{ $b->products_count }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-4">
                            <label class="form-label text-light fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Rango de Precio (USD $)</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" name="precio_min" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="Mín" value="{{ request('precio_min') }}">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="precio_max" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="Máx" value="{{ request('precio_max') }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-outline-info w-100 mt-2">Aplicar Precio</button>
                        </div>

                        <!-- Destacados Checkbox -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="destacados" value="1" id="filter-destacados" {{ request('destacados') ? 'checked' : '' }} onchange="document.getElementById('catalog-filter-form').submit()">
                            <label class="form-check-label text-light small" for="filter-destacados">
                                Solo Unidades Destacadas
                            </label>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <!-- Sorting & View options -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center p-3 rounded-3 border border-secondary mb-4" style="background: #0f182e;">
                    <div class="text-muted small mb-2 mb-sm-0">
                        Mostrando {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} de {{ $products->total() }} resultados
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <label class="small text-muted text-nowrap mb-0">Ordenar por:</label>
                        <select class="form-select form-select-sm bg-dark text-white border-secondary" style="width: auto;" onchange="window.location.href = this.value">
                            <option value="{{ request()->fullUrlWithQuery(['orden' => 'recientes']) }}" {{ request('orden') === 'recientes' ? 'selected' : '' }}>Más Recientes</option>
                            <option value="{{ request()->fullUrlWithQuery(['orden' => 'precio_bajo']) }}" {{ request('orden') === 'precio_bajo' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
                            <option value="{{ request()->fullUrlWithQuery(['orden' => 'precio_alto']) }}" {{ request('orden') === 'precio_alto' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
                            <option value="{{ request()->fullUrlWithQuery(['orden' => 'populares']) }}" {{ request('orden') === 'populares' ? 'selected' : '' }}>Más Vistos / Populares</option>
                            <option value="{{ request()->fullUrlWithQuery(['orden' => 'nombre_asc']) }}" {{ request('orden') === 'nombre_asc' ? 'selected' : '' }}>Nombre: A - Z</option>
                        </select>
                    </div>
                </div>

                <!-- Cards Grid -->
                <div class="row g-4">
                    @forelse($products as $prod)
                        <div class="col-md-6 col-xl-4">
                            @include('frontend.products.partials.card', ['product' => $prod])
                        </div>
                    @empty
                        <div class="col-12 py-5 text-center">
                            <div class="p-5 rounded-4 border border-secondary bg-dark">
                                <i class="fas fa-search fs-1 text-muted mb-3"></i>
                                <h4 class="text-white">No encontramos unidades con los filtros seleccionados</h4>
                                <p class="text-muted">Prueba buscando con otros términos o restablece los filtros para ver todo el inventario.</p>
                                <a href="{{ route('products.index') }}" class="btn btn-electric px-4 py-2 mt-2">
                                    Ver Todo el Catálogo
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
