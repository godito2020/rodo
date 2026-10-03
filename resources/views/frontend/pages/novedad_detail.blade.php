@extends('layouts.app')

@php
    $metaTitle = $article->meta_title ?: ($article->title . ' | RODOPERU');
    $metaDescription = $article->meta_description ?: Str::limit(strip_tags($article->summary), 155);
    $metaImage = $article->image_url;
@endphp

@section('title', $metaTitle)
@section('meta_description', $metaDescription)

@section('content')
<div class="py-4" style="background: #091022; border-bottom: 1px solid var(--border-dark);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('novedades.index') }}" class="text-info text-decoration-none">Novedades</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($article->title, 40) }}</li>
            </ol>
        </nav>
        <span class="badge bg-dark border border-info text-info mb-2">{{ $article->category }}</span>
        <h1 class="display-6 fw-bold text-white mb-2">{{ $article->title }}</h1>
        <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Publicado el {{ $article->created_at->format('d de F, Y') }} &bull; {{ $article->views_count }} visualizaciones</small>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="rounded-4 overflow-hidden mb-4 border border-secondary">
                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-100" style="max-height: 420px; object-fit: cover;">
                </div>

                @if($article->summary)
                    <div class="p-3 rounded-3 mb-4 border-start border-4 border-info bg-dark text-light lead" style="font-size: 1.1rem; line-height: 1.7;">
                        {{ $article->summary }}
                    </div>
                @endif

                <div class="text-light" style="font-size: 1.05rem; line-height: 1.9;">
                    {!! $article->content !!}
                </div>

                <!-- Social Share -->
                <div class="mt-5 p-4 rounded-3 border border-secondary bg-dark d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                    <span class="fw-bold text-white"><i class="fas fa-share-alt text-info me-2"></i> Compartir este artículo:</span>
                    <div class="d-flex gap-2">
                        <a href="https://api.whatsapp.com/send?text={{ rawurlencode($article->title . ' - ' . url()->current()) }}" target="_blank" class="btn btn-sm btn-success">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-primary">
                            <i class="fab fa-facebook-f me-1"></i> Facebook
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ rawurlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-info text-white">
                            <i class="fab fa-linkedin-in me-1"></i> LinkedIn
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                @if($relatedArticles->count() > 0)
                <div class="p-4 rounded-3 border border-secondary mb-4" style="background: #0f182e;">
                    <h5 class="text-white fw-bold mb-3"><i class="fas fa-newspaper text-info me-2"></i> Artículos Relacionados</h5>
                    <div class="d-flex flex-column gap-3">
                        @foreach($relatedArticles as $rel)
                            <a href="{{ route('novedades.show', $rel->slug) }}" class="text-decoration-none text-light border-bottom border-dark pb-2">
                                <div class="small fw-bold hover-cyan">{{ $rel->title }}</div>
                                <small class="text-muted" style="font-size: 0.75rem;">{{ $rel->category }}</small>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="p-4 rounded-3 border border-secondary" style="background: #0d1527;">
                    <h5 class="text-white fw-bold mb-3"><i class="fas fa-envelope text-info me-2"></i> Asesoría Personalizada</h5>
                    <p class="text-muted small mb-3">¿Requieres un estudio de costos operativos para renovar la flota de tu empresa?</p>
                    <a href="{{ route('contacto') }}" class="btn btn-electric w-100 py-2">Solicitar Análisis</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
