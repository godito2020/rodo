@extends('layouts.app')

@section('title', 'Unidades y Modelos Destacados | RODOPERU')
@section('meta_description', 'Descubre las unidades más destacadas de vehículos 100% eléctricos y semirremolques Facchini para entrega inmediata en Perú.')

@section('content')
<div class="py-4" style="background: #091022; border-bottom: 1px solid var(--border-dark);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Unidades Destacadas</li>
            </ol>
        </nav>
        <h1 class="h2 fw-bold text-white mb-1"><i class="fas fa-star text-warning me-2"></i> Modelos y Unidades Destacadas</h1>
        <p class="text-muted small mb-0">Selección especial de vehículos eléctricos con bonos promocionales e implementos Facchini en stock prioritario</p>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($products as $prod)
                <div class="col-md-6 col-lg-4">
                    @include('frontend.products.partials.card', ['product' => $prod])
                </div>
            @empty
                <div class="col-12 py-5 text-center text-muted">
                    No hay productos destacados en este momento.
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
