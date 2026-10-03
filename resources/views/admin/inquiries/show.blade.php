@extends('layouts.admin')

@section('title', 'Mensaje de ' . $inquiry->name)
@section('page_title', 'Detalle de Mensaje / Cotización')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary">
                <div>
                    <h5 class="text-white fw-bold mb-0">Mensaje de: {{ $inquiry->name }}</h5>
                    <small class="text-muted">Recibido el {{ $inquiry->created_at->format('d/m/Y H:i') }}</small>
                </div>
                <a href="{{ route('admin.inquiries.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver a Mensajes
                </a>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="text-muted small fw-bold text-uppercase">Correo Electrónico</label>
                    <div class="text-white">{{ $inquiry->email }}</div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small fw-bold text-uppercase">Teléfono</label>
                    <div class="text-white">{{ $inquiry->phone ?: 'No especificado' }}</div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small fw-bold text-uppercase">Producto de Interés</label>
                    <div><span class="badge bg-dark border border-info text-info">{{ $inquiry->product_interest ?: 'General' }}</span></div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small fw-bold text-uppercase">Asunto</label>
                    <div class="text-white">{{ $inquiry->subject ?: 'Sin asunto' }}</div>
                </div>
            </div>

            <div class="p-4 rounded-3 border border-secondary bg-dark mb-4">
                <label class="text-muted small fw-bold text-uppercase mb-2 d-block">Mensaje / Requerimiento del Cliente:</label>
                <div class="text-light" style="font-size: 1rem; line-height: 1.8; white-space: pre-line;">{{ $inquiry->message }}</div>
            </div>

            <div class="d-flex gap-3">
                @if($inquiry->phone)
                    <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}&text={{ rawurlencode('Hola ' . $inquiry->name . ', te saludamos de RODOPERU respecto a tu consulta sobre ' . ($inquiry->product_interest ?: 'nuestros vehículos e implementos')) }}" target="_blank" class="btn btn-whatsapp-quote px-4 py-2">
                        <i class="fab fa-whatsapp me-2"></i> Responder por WhatsApp
                    </a>
                @endif
                <a href="mailto:{{ $inquiry->email }}?subject={{ rawurlencode('Respuesta a tu consulta - RODOPERU') }}" class="btn btn-electric px-4 py-2">
                    <i class="fas fa-envelope me-2"></i> Responder por Correo
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
