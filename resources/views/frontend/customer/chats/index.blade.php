@extends('layouts.app')

@section('title', 'Mis Chats con Asesores | RODOPERU')

@section('content')
<div class="py-4" style="background: #091022; border-bottom: 1px solid var(--border-dark);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}" class="text-info text-decoration-none">Mi Cuenta</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Mis Chats con Asesores</li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold text-white mb-0"><i class="fas fa-comments text-info me-2"></i> Mis Conversaciones con Vendedores y Soporte</h1>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card-custom">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="text-white">Historial de Conversaciones Técnicas</span>
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-electric">
                    <i class="fas fa-plus me-1"></i> Nueva Consulta sobre un Producto
                </a>
            </div>
            <div class="p-3">
                @forelse($conversations as $conv)
                    @php
                        $unread = $conv->unreadCountForCustomer();
                    @endphp
                    <a href="{{ route('customer.chat_show', $conv->id) }}" class="d-flex flex-column flex-md-row justify-content-between align-items-md-center p-3 rounded border border-dark bg-dark mb-3 text-decoration-none hover-glow">
                        <div class="d-flex align-items-center gap-3">
                            @if($conv->product)
                                <img src="{{ $conv->product->main_image_url }}" alt="{{ $conv->product->name }}" width="55" height="55" class="rounded p-1 bg-dark border border-secondary" style="object-fit: contain;">
                            @else
                                <div class="p-3 bg-secondary rounded text-white"><i class="fas fa-comment-dots fs-4"></i></div>
                            @endif
                            <div>
                                <div class="text-white fw-bold fs-6">
                                    {{ $conv->subject }}
                                    @if($unread > 0)
                                        <span class="badge bg-danger ms-2">{{ $unread }} nuevo(s)</span>
                                    @endif
                                </div>
                                <small class="text-muted">
                                    {{ $conv->latestMessage ? Str::limit($conv->latestMessage->message, 90) : 'Sin mensajes aún' }}
                                </small>
                            </div>
                        </div>
                        <div class="text-md-end mt-2 mt-md-0">
                            <span class="badge {{ $conv->status === 'open' ? 'pill-badge-cyan' : ($conv->status === 'resolved' ? 'bg-success' : 'bg-secondary') }}">
                                {{ ucfirst($conv->status) }}
                            </span>
                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                                {{ $conv->last_message_at ? $conv->last_message_at->diffForHumans() : '' }}
                            </small>
                        </div>
                    </a>
                @empty
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-comments fs-1 mb-3 d-block"></i>
                        No tienes conversaciones abiertas con nuestros vendedores. Puedes iniciar un chat directamente desde la ficha de cualquier producto.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
