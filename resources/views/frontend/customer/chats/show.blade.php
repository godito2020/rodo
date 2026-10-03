@extends('layouts.app')

@section('title', 'Chat sobre: ' . $conversation->subject . ' | RODOPERU')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
@endphp

@section('content')
<div class="py-3" style="background: #091022; border-bottom: 1px solid var(--border-dark);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}" class="text-info text-decoration-none">Mi Cuenta</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.chats') }}" class="text-info text-decoration-none">Mis Chats</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Conversación</li>
            </ol>
        </nav>
    </div>
</div>

<div class="py-4">
    <div class="container">
        <div class="row g-4">
            <!-- Left: Product Reference Card (if tied to product) -->
            <div class="col-lg-4">
                @if($conversation->product)
                    <div class="p-4 rounded-4 border border-secondary mb-4" style="background: #0f182e;">
                        <span class="text-info fw-bold small text-uppercase mb-2 d-block">PRODUCTO EN CONSULTA</span>
                        <div class="text-center p-3 bg-dark rounded border border-dark mb-3">
                            <img src="{{ $conversation->product->main_image_url }}" alt="{{ $conversation->product->name }}" class="img-fluid" style="max-height: 160px; object-fit: contain;">
                        </div>
                        <h5 class="text-white fw-bold mb-1">{{ $conversation->product->name }}</h5>
                        <small class="text-muted d-block mb-2 font-monospace">SKU: {{ $conversation->product->sku }}</small>

                        @if($conversation->product->show_price)
                            <div class="h5 text-info fw-bold mb-3">
                                {{ $currency }} {{ number_format($conversation->product->effective_price, 2) }}
                            </div>
                        @else
                            <div class="badge bg-secondary mb-3">Precio a Cotizar</div>
                        @endif

                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('products.show', $conversation->product->slug) }}" target="_blank" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-external-link-alt me-1"></i> Ver Ficha del Producto
                            </a>
                            <a href="{{ $conversation->product->whatsapp_inquiry_url }}" target="_blank" class="btn btn-whatsapp-quote btn-sm">
                                <i class="fab fa-whatsapp me-1"></i> Consultar también por WhatsApp
                            </a>
                        </div>
                    </div>
                @else
                    <div class="p-4 rounded-4 border border-secondary mb-4" style="background: #0f182e;">
                        <h5 class="text-white fw-bold mb-2">Consulta General</h5>
                        <p class="text-muted small">Atención directa con nuestro equipo técnico y de posventa.</p>
                    </div>
                @endif
            </div>

            <!-- Right: Interactive Chat Conversation Box -->
            <div class="col-lg-8">
                <div class="card-custom d-flex flex-column" style="height: 600px;">
                    <!-- Chat Header -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="text-white mb-0">{{ $conversation->subject }}</h5>
                            <small class="text-muted">Asesoría técnica en línea</small>
                        </div>
                        <span class="badge {{ $conversation->status === 'open' ? 'pill-badge-cyan' : 'bg-success' }}">
                            {{ ucfirst($conversation->status) }}
                        </span>
                    </div>

                    <!-- Chat Message Stream -->
                    <div class="p-4 flex-grow-1 overflow-auto d-flex flex-column gap-3" id="chat-messages-container" style="background: #090e1c;">
                        @foreach($conversation->messages as $msg)
                            @if($msg->sender_type === 'customer')
                                <!-- Customer Message Bubble -->
                                <div class="align-self-end text-end" style="max-width: 80%;">
                                    <div class="p-3 rounded-3 text-start" style="background: linear-gradient(135deg, var(--electric-cyan) 0%, var(--electric-blue) 100%); color: #070d1e; font-weight: 500;">
                                        {{ $msg->message }}
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">Tú &bull; {{ $msg->created_at->format('H:i') }}</small>
                                </div>
                            @elseif($msg->sender_type === 'admin')
                                <!-- Admin / Seller Message Bubble -->
                                <div class="align-self-start text-start" style="max-width: 80%;">
                                    <div class="p-3 rounded-3 text-start" style="background: #1e293b; color: #ffffff; border: 1px solid var(--border-dark);">
                                        <div class="d-flex align-items-center gap-1 mb-1">
                                            <span class="badge bg-danger" style="font-size: 0.65rem;">ASESOR RODOPERU</span>
                                            <small class="text-info font-weight-bold">{{ $msg->sender ? $msg->sender->name : 'Vendedor' }}</small>
                                        </div>
                                        {{ $msg->message }}
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">{{ $msg->created_at->format('H:i') }}</small>
                                </div>
                            @else
                                <!-- Bot Message Bubble -->
                                <div class="align-self-start text-start" style="max-width: 80%;">
                                    <div class="p-3 rounded-3 text-start" style="background: #162035; color: #cbd5e1; border: 1px dashed #334155;">
                                        <div class="d-flex align-items-center gap-1 mb-1">
                                            <span class="badge bg-secondary" style="font-size: 0.65rem;">BOT AUTOMÁTICO</span>
                                        </div>
                                        {{ $msg->message }}
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">{{ $msg->created_at->format('H:i') }}</small>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Chat Input Box -->
                    <div class="p-3 border-top border-secondary bg-dark">
                        <form action="{{ route('customer.chat_send', $conversation->id) }}" method="POST" id="chat-send-form" class="d-flex gap-2">
                            @csrf
                            <input type="text" name="message" id="chat-input" class="form-control bg-dark text-white border-secondary" placeholder="Escribe tu mensaje o consulta al vendedor..." required autocomplete="off">
                            <button type="submit" class="btn btn-electric px-4 fw-bold">
                                <i class="fas fa-paper-plane me-1"></i> Enviar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Scroll chat stream to bottom automatically
    const chatContainer = document.getElementById('chat-messages-container');
    if (chatContainer) {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }
</script>
@endpush
