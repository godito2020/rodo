@extends('layouts.app')

@section('title', 'Novedades, Noticias y Electromovilidad | RODOPERU')
@section('meta_description', 'Últimas noticias y análisis sobre movilidad eléctrica, semirremolques Facchini, tecnología de baterías e innovaciones en el transporte en Perú.')

@section('content')
<div class="py-4" style="background: #091022; border-bottom: 1px solid var(--border-dark);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Novedades & Blog</li>
            </ol>
        </nav>
        <h1 class="h2 fw-bold text-white mb-1"><i class="fas fa-newspaper text-info me-2"></i> Novedades & Artículos de Interés</h1>
        <p class="text-muted small mb-0">Información técnica, estudios de ahorro, regulaciones y lanzamientos oficiales de RODOPERU</p>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="row g-4">
                    @forelse($articles as $art)
                        <div class="col-md-6">
                            <div class="card-custom h-100 overflow-hidden d-flex flex-column">
                                <img src="{{ $art->image_url }}" alt="{{ $art->title }}" class="w-100" style="height: 200px; object-fit: cover;">
                                <div class="p-4 d-flex flex-column flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-dark border border-info text-info">{{ $art->category }}</span>
                                        <small class="text-muted" style="font-size: 0.75rem;">{{ $art->created_at->format('d M, Y') }}</small>
                                    </div>
                                    <h5 class="text-white mb-2 fw-bold">
                                        <a href="{{ route('novedades.show', $art->slug) }}" class="text-white text-decoration-none hover-cyan">
                                            {{ $art->title }}
                                        </a>
                                    </h5>
                                    <p class="text-muted small flex-grow-1" style="line-height: 1.6;">
                                        {{ Str::limit($art->summary, 120) }}
                                    </p>
                                    <a href="{{ route('novedades.show', $art->slug) }}" class="text-info text-decoration-none fw-bold small mt-2">
                                        Continuar Leyendo <i class="fas fa-chevron-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 py-4 text-center text-muted">No hay artículos publicados en este momento.</div>
                    @endforelse
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {{ $articles->links('pagination::bootstrap-5') }}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="p-4 rounded-3 border border-secondary mb-4" style="background: #0f182e;">
                    <h5 class="text-white fw-bold mb-3"><i class="fas fa-fire text-danger me-2"></i> Artículos Recientes</h5>
                    <div class="d-flex flex-column gap-3">
                        @foreach($recentArticles as $rec)
                            <a href="{{ route('novedades.show', $rec->slug) }}" class="text-decoration-none text-light border-bottom border-dark pb-2">
                                <div class="small fw-bold hover-cyan">{{ $rec->title }}</div>
                                <small class="text-muted" style="font-size: 0.75rem;">{{ $rec->created_at->format('d/m/Y') }} &bull; {{ $rec->category }}</small>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="p-4 rounded-3 border border-info text-center" style="background: rgba(0, 242, 254, 0.05);">
                    <i class="fas fa-bolt text-info fs-1 mb-2"></i>
                    <h5 class="text-white fw-bold">¿Tienes dudas sobre Electromovilidad?</h5>
                    <p class="text-muted small">Nuestros asesores técnicos te orientan en infraestructura de carga y dimensionamiento de baterías.</p>
                    <a href="{{ route('contacto') }}" class="btn btn-electric w-100 py-2">Contactar a un Asesor</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
