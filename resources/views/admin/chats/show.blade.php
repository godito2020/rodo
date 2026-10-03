@extends('layouts.admin')

@section('title', 'Chat con Cliente: ' . ($conversation->user->name ?? 'Cliente'))
@section('page_title', 'Conversación en Vivo')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
@endphp

@section('content')
<div class="row g-4">
    <!-- Left: Product Reference & Customer details -->
    <div class="col-lg-4">
        <!-- Customer Card -->
        <div class="card-custom p-4 mb-4">
            <h6 class="text-info fw-bold mb-3 text-uppercase">Datos del Cliente</h6>
            <div class="fw-bold text-white fs-6 mb-1">{{ $conversation->user ? $conversation->user->name : 'Cliente' }}</div>
            <p class="text-muted small mb-2"><i class="fas fa-envelope text-info me-1"></i> {{ $conversation->user ? $conversation->user->email : '' }}</p>
            <p class="text-muted small mb-3"><i class="fas fa-phone text-info me-1"></i> {{ $conversation->user ? $conversation->user->phone : 'Sin teléfono' }}</p>

            @if($conversation->user && $conversation->user->phone)
                <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $conversation->user->phone) }}" target="_blank" class="btn btn-whatsapp-quote btn-sm w-100 mb-2">
                    <i class="fab fa-whatsapp me-1"></i> Abrir WhatsApp del Cliente
                </a>
            @endif

            <form action="{{ route('admin.chats.update_status', $conversation->id) }}" method="POST">
                @csrf
                <label class="form-label text-light small fw-bold mt-2">Estado de la Consulta:</label>
                <div class="input-group">
                    <select name="status" class="form-select form-select-sm">
                        <option value="open" {{ $conversation->status === 'open' ? 'selected' : '' }}>Abierta</option>
                        <option value="in_progress" {{ $conversation->status === 'in_progress' ? 'selected' : '' }}>En Curso</option>
                        <option value="resolved" {{ $conversation->status === 'resolved' ? 'selected' : '' }}>Resuelta</option>
                        <option value="closed" {{ $conversation->status === 'closed' ? 'selected' : '' }}>Cerrada</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-outline-info">Actualizar</button>
                </div>
            </form>
        </div>

        <!-- Product Reference Card -->
        @if($conversation->product)
            <div class="card-custom p-4">
                <span class="text-info fw-bold small text-uppercase mb-2 d-block">PRODUCTO RELACIONADO</span>
                <div class="text-center p-3 bg-dark rounded border border-dark mb-3">
                    <img src="{{ $conversation->product->main_image_url }}" alt="" class="img-fluid" style="max-height: 140px; object-fit: contain;">
                </div>
                <h6 class="text-white fw-bold mb-1">{{ $conversation->product->name }}</h6>
                <small class="text-muted d-block font-monospace mb-2">SKU: {{ $conversation->product->sku }}</small>
                <div class="text-info fw-bold mb-3">
                    {{ $currency }} {{ number_format($conversation->product->effective_price, 2) }}
                </div>
                <a href="{{ route('products.show', $conversation->product->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary text-light w-100">
                    <i class="fas fa-external-link-alt me-1"></i> Ver Ficha en Tienda
                </a>
            </div>
        @endif
    </div>

    <!-- Right: Message Stream & Reply Box -->
    <div class="col-lg-8">
        <div class="card-custom d-flex flex-column" style="height: 620px;">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="text-white mb-0">{{ $conversation->subject }}</h5>
                    <small class="text-muted">Chat iniciado por el cliente</small>
                </div>
                <a href="{{ route('admin.chats.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver a la Bandeja
                </a>
            </div>

            <!-- Messages Stream -->
            <div class="p-4 flex-grow-1 overflow-auto d-flex flex-column gap-3" id="admin-chat-messages" style="background: #090e1c;">
                @foreach($conversation->messages as $msg)
                    @if($msg->sender_type === 'customer')
                        <!-- Customer Bubble -->
                        <div class="align-self-start text-start" style="max-width: 80%;">
                            <div class="p-3 rounded-3" style="background: #1e293b; color: #ffffff; border: 1px solid var(--border-dark);">
                                <div class="d-flex align-items-center gap-1 mb-1">
                                    <span class="badge bg-primary" style="font-size: 0.65rem;">CLIENTE</span>
                                    <small class="text-light fw-bold">{{ $conversation->user ? $conversation->user->name : 'Cliente' }}</small>
                                </div>
                                {{ $msg->message }}
                            </div>
                            <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">{{ $msg->created_at->format('H:i') }}</small>
                        </div>
                    @elseif($msg->sender_type === 'admin')
                        <!-- Admin / Seller Bubble -->
                        <div class="align-self-end text-end" style="max-width: 80%;">
                            <div class="p-3 rounded-3 text-start" style="background: linear-gradient(135deg, var(--electric-cyan) 0%, var(--electric-blue) 100%); color: #070d1e; font-weight: 500;">
                                <div class="d-flex align-items-center gap-1 mb-1">
                                    <span class="badge bg-dark text-info" style="font-size: 0.65rem;">TÚ (ASESOR)</span>
                                </div>
                                {{ $msg->message }}
                            </div>
                            <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">{{ $msg->created_at->format('H:i') }}</small>
                        </div>
                    @else
                        <!-- Bot Bubble -->
                        <div class="align-self-start text-start" style="max-width: 80%;">
                            <div class="p-3 rounded-3" style="background: #111a2d; color: #94a3b8; border: 1px dashed #334155;">
                                <span class="badge bg-secondary mb-1" style="font-size: 0.65rem;">SISTEMA / BOT</span>
                                <div>{{ $msg->message }}</div>
                            </div>
                            <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">{{ $msg->created_at->format('H:i') }}</small>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Reply Box -->
            <div class="p-3 border-top border-secondary bg-dark">
                <form action="{{ route('admin.chats.reply', $conversation->id) }}" method="POST" class="d-flex gap-2">
                    @csrf
                    <input type="text" name="message" class="form-control bg-dark text-white border-secondary" placeholder="Escribe tu respuesta al cliente..." required autocomplete="off">
                    <button type="submit" class="btn btn-electric px-4 fw-bold">
                        <i class="fas fa-paper-plane me-1"></i> Responder
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const box = document.getElementById('admin-chat-messages');
    if (box) {
        box.scrollTop = box.scrollHeight;
    }
</script>
@endpush
