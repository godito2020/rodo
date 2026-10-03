@extends('layouts.app')

@section('title', 'Contacto y Cotizaciones | RODOPERU')
@section('meta_description', 'Comunícate con nuestros asesores en Lima y a nivel nacional. Solicita tu cotización de vehículos eléctricos e implementos Facchini.')

@section('content')
<div class="py-4 contacto-header-bar">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Contacto & Cotizaciones</li>
            </ol>
        </nav>
        <h1 class="h2 fw-bold text-white mb-1"><i class="fas fa-headset text-info me-2"></i> Centro de Atención & Cotizaciones</h1>
        <p class="text-muted small mb-0">Estamos a tu disposición para brindarte asesoría técnica personalizada y cotizaciones formales</p>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="p-4 p-md-5 rounded-4 border border-secondary contacto-form-card">
                    <h3 class="text-white fw-bold mb-2">Envíanos un Mensaje</h3>
                    <p class="text-muted mb-4 small">Completa el formulario y un especialista comercial se comunicará contigo en menos de 2 horas hábiles.</p>

                    <form action="{{ route('contacto.submit') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-light small fw-bold">Nombre Completo / Razón Social *</label>
                                <input type="text" name="name" class="form-control" required placeholder="Ej: Juan Pérez / Transportes S.A.C." value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-light small fw-bold">Correo Electrónico *</label>
                                <input type="email" name="email" class="form-control" required placeholder="correo@empresa.com" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-light small fw-bold">Teléfono o Celular (WhatsApp)</label>
                                <input type="text" name="phone" class="form-control" placeholder="+51 987 654 321" value="{{ old('phone', Auth::check() ? Auth::user()->phone : '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-light small fw-bold">Producto de Interés</label>
                                <input type="text" name="product_interest" class="form-control" placeholder="Ej: SUV RODO EV-600, Furgón Facchini" value="{{ old('product_interest', $productInterest) }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-light small fw-bold">Asunto</label>
                                <input type="text" name="subject" class="form-control" placeholder="Ej: Cotización formal / Consulta técnica / Leasing" value="{{ old('subject') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-light small fw-bold">Detalle de tu Consulta o Requerimiento *</label>
                                <textarea name="message" class="form-control" rows="5" required placeholder="Indícanos cantidad de unidades, ruta de operación o cualquier especificación especial...">{{ old('message') }}</textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-electric btn-lg w-100 py-3 fw-bold">
                                    <i class="fas fa-paper-plane me-2"></i> Enviar Mensaje y Solicitar Cotización
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Direct Contact Info & Map -->
            <div class="col-lg-5">
                <div class="p-4 rounded-4 border border-secondary mb-4 contacto-info-card">
                    <h4 class="text-white fw-bold mb-4">Información Central</h4>
                    
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="contact-icon-circle contact-icon-cyan">
                            <i class="fas fa-map-location-dot"></i>
                        </div>
                        <div>
                            <div class="text-white fw-bold">Sede Principal & Showroom:</div>
                            <div class="text-muted small">{{ \App\Models\Setting::get('company_address', 'Av. Evitamiento Km 8.5, Ate - Lima, Perú') }}</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="contact-icon-circle contact-icon-blue">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div>
                            <div class="text-white fw-bold">Central Telefónica:</div>
                            <div class="text-muted small">{{ \App\Models\Setting::get('company_phone', '+51 (01) 719-8900') }}</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="contact-icon-circle contact-icon-whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div>
                            <div class="text-white fw-bold">Atención Comercial WhatsApp:</div>
                            <div class="text-muted small">{{ \App\Models\Setting::get('whatsapp_number', '+51 987 654 321') }}</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="contact-icon-circle contact-icon-amber">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <div>
                            <div class="text-white fw-bold">Correos Oficiales:</div>
                            <div class="text-muted small">{{ \App\Models\Setting::get('support_email', 'ventas@rodoperu.com') }}</div>
                            <div class="text-muted small">{{ \App\Models\Setting::get('sales_email', 'cotizaciones@rodoperu.com') }}</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="contact-icon-circle contact-icon-purple">
                            <i class="fas fa-business-time"></i>
                        </div>
                        <div>
                            <div class="text-white fw-bold">Horarios de Atención:</div>
                            <div class="text-muted small">Lunes a Viernes: 8:00 AM - 6:30 PM</div>
                            <div class="text-muted small">Sábados: 8:30 AM - 1:00 PM</div>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Frame Simulation -->
                <div class="rounded-4 overflow-hidden border border-secondary shadow-sm" style="height: 250px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.8797371509375!2d-76.96919242404098!3d-12.051838641982767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c65a0b77b1e7%3A0xb35a0928a6fcf7c4!2sAte%2C%20Lima!5e0!3m2!1ses!2spe!4v1700000000000!5m2!1ses!2spe" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
