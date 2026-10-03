@extends('layouts.admin')

@section('title', 'Centro de Chat con Clientes')
@section('page_title', 'Centro de Atención & Chats en Vivo')

@section('content')
<div class="card-custom">
    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h5 class="text-white mb-0"><i class="fas fa-comments text-info me-2"></i> Bandeja de Conversaciones con Clientes</h5>
            <small class="text-muted">Responde en tiempo real a las consultas técnicas de productos iniciadas por los clientes</small>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.chats.index') }}" class="btn btn-sm {{ !request('estado') ? 'btn-info text-dark' : 'btn-outline-secondary' }}">Todas</a>
            <a href="{{ route('admin.chats.index', ['estado' => 'open']) }}" class="btn btn-sm {{ request('estado') === 'open' ? 'btn-danger' : 'btn-outline-danger' }}">Abiertas</a>
            <a href="{{ route('admin.chats.index', ['estado' => 'in_progress']) }}" class="btn btn-sm {{ request('estado') === 'in_progress' ? 'btn-warning text-dark' : 'btn-outline-warning' }}">En Curso</a>
            <a href="{{ route('admin.chats.index', ['estado' => 'resolved']) }}" class="btn btn-sm {{ request('estado') === 'resolved' ? 'btn-success' : 'btn-outline-success' }}">Resueltas</a>
        </div>
    </div>

    <div class="p-3">
        <div class="d-flex flex-column gap-3">
            @forelse($conversations as $c)
                @php
                    $unread = $c->unreadCountForAdmin();
                @endphp
                <div class="p-3 rounded-3 bg-dark border {{ $unread > 0 ? 'border-danger' : 'border-secondary' }} d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div class="d-flex align-items-center gap-3">
                        @if($c->product)
                            <img src="{{ $c->product->main_image_url }}" alt="" width="55" height="55" class="rounded p-1 bg-dark border border-secondary" style="object-fit: contain;">
                        @else
                            <div class="p-3 bg-secondary rounded text-white"><i class="fas fa-comment-dots fs-4"></i></div>
                        @endif
                        <div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-white fw-bold fs-6">{{ $c->user ? $c->user->name : 'Cliente' }}</span>
                                <small class="text-muted font-monospace">({{ $c->user ? $c->user->email : '' }})</small>
                                @if($unread > 0)
                                    <span class="badge bg-danger">{{ $unread }} mensaje(s) nuevo(s)</span>
                                @endif
                            </div>
                            <div class="text-info small fw-bold mt-1">
                                <i class="fas fa-tag me-1"></i> {{ $c->subject }}
                            </div>
                            <small class="text-muted d-block mt-1">
                                Último mensaje: {{ $c->latestMessage ? Str::limit($c->latestMessage->message, 80) : '—' }}
                            </small>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="text-end">
                            <span class="badge {{ $c->status === 'open' ? 'bg-danger' : ($c->status === 'resolved' ? 'bg-success' : 'bg-warning text-dark') }}">
                                {{ ucfirst($c->status) }}
                            </span>
                            <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">{{ $c->last_message_at ? $c->last_message_at->diffForHumans() : '' }}</small>
                        </div>
                        <a href="{{ route('admin.chats.show', $c->id) }}" class="btn btn-sm btn-electric">
                            <i class="fas fa-reply me-1"></i> Responder Chat
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-5">
                    <i class="fas fa-comments fs-1 mb-2 d-block"></i>
                    No hay conversaciones registradas en este estado.
                </div>
            @endforelse
        </div>
    </div>

    @if($conversations->hasPages())
        <div class="p-3 border-top border-secondary d-flex justify-content-center">
            {{ $conversations->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
