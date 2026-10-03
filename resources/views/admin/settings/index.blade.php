@extends('layouts.admin')

@section('title', 'Configuración del Sistema')
@section('page_title', 'Configuración General & Servidores')

@section('content')
<div class="card-custom">
    <!-- Tabs Header -->
    <div class="card-header p-0 border-bottom border-secondary">
        <ul class="nav nav-tabs border-0" id="settingsTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active px-4 py-3 fw-bold text-white border-0" id="branding-tab" data-bs-toggle="tab" data-bs-target="#tab-branding">
                    <i class="fas fa-palette text-info me-2"></i> Logo & Branding
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link px-4 py-3 fw-bold text-white border-0" id="smtp-tab" data-bs-toggle="tab" data-bs-target="#tab-smtp">
                    <i class="fas fa-server text-warning me-2"></i> Servidor de Correo (SMTP)
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link px-4 py-3 fw-bold text-white border-0" id="payment-tab" data-bs-toggle="tab" data-bs-target="#tab-payment">
                    <i class="fas fa-credit-card text-success me-2"></i> Pasarelas de Pago
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link px-4 py-3 fw-bold text-white border-0" id="social-tab" data-bs-toggle="tab" data-bs-target="#tab-social">
                    <i class="fab fa-whatsapp text-success me-2"></i> WhatsApp & Redes
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link px-4 py-3 fw-bold text-white border-0" id="general-tab" data-bs-toggle="tab" data-bs-target="#tab-general">
                    <i class="fas fa-globe text-primary me-2"></i> General & SEO
                </button>
            </li>
        </ul>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="p-4 tab-content" id="settingsTabContent">
            
            <!-- 1. Branding Tab (Logo & Favicon) -->
            <div class="tab-pane fade show active" id="tab-branding">
                <h5 class="text-white fw-bold mb-3"><i class="fas fa-image text-info me-2"></i> Identidad Corporativa & Logotipos</h5>
                <p class="text-muted small mb-4">Administra el logo principal y el favicon para los navegadores.</p>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="p-4 rounded-3 border border-secondary bg-dark">
                            <label class="form-label text-light fw-bold">Logo Oficial del Sistema</label>
                            <div class="p-3 bg-secondary rounded text-center mb-3">
                                <img src="{{ asset($settings['logo_path'] ?? 'images/logo/RODO.png') }}?v={{ time() }}" alt="Logo RODOPERU" style="max-height: 70px; object-fit: contain;">
                            </div>
                            <label class="form-label text-light small">Subir Nuevo Logo (PNG transparente / SVG)</label>
                            <input type="file" name="logo" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-4 rounded-3 border border-secondary bg-dark">
                            <label class="form-label text-light fw-bold">Favicon (Ícono de Navegador)</label>
                            <div class="p-3 bg-secondary rounded text-center mb-3">
                                <img src="{{ asset($settings['favicon_path'] ?? 'favicon.png') }}?v={{ time() }}" alt="Favicon" style="max-height: 48px; object-fit: contain;">
                            </div>
                            <label class="form-label text-light small">Subir Nuevo Favicon (.ico o PNG cuadrado)</label>
                            <input type="file" name="favicon" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Nombre Comercial de la Empresa</label>
                        <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? 'RODOPERU' }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Eslogan Corporativo</label>
                        <input type="text" name="site_tagline" class="form-control" value="{{ $settings['site_tagline'] ?? '' }}">
                    </div>
                </div>
            </div>

            <!-- 2. SMTP Mail Server Tab -->
            <div class="tab-pane fade" id="tab-smtp">
                <h5 class="text-white fw-bold mb-3"><i class="fas fa-server text-warning me-2"></i> Configuración de Servidor de Correo SMTP</h5>
                <p class="text-muted small mb-4">
                    Configura las credenciales del servidor de correo para el envío de notificaciones de pedidos, cotizaciones y restablecimiento de contraseña.
                </p>

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label text-light small fw-bold">Servidor SMTP (Host)</label>
                        <input type="text" name="smtp_host" class="form-control" placeholder="mail.rodoperu.com / smtp.gmail.com" value="{{ $settings['smtp_host'] ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light small fw-bold">Puerto SMTP</label>
                        <input type="number" name="smtp_port" class="form-control" placeholder="465 / 587 / 2525" value="{{ $settings['smtp_port'] ?? '587' }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Usuario SMTP</label>
                        <input type="text" name="smtp_username" class="form-control" placeholder="ventas@rodoperu.com" value="{{ $settings['smtp_username'] ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Contraseña SMTP</label>
                        <input type="password" name="smtp_password" class="form-control" placeholder="••••••••" value="{{ $settings['smtp_password'] ?? '' }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-light small fw-bold">Cifrado (Encryption)</label>
                        <select name="smtp_encryption" class="form-select">
                            <option value="tls" {{ ($settings['smtp_encryption'] ?? '') === 'tls' ? 'selected' : '' }}>TLS</option>
                            <option value="ssl" {{ ($settings['smtp_encryption'] ?? '') === 'ssl' ? 'selected' : '' }}>SSL</option>
                            <option value="null" {{ ($settings['smtp_encryption'] ?? '') === 'null' ? 'selected' : '' }}>Sin Cifrado</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light small fw-bold">Correo Remitente (From Address)</label>
                        <input type="email" name="smtp_from_address" class="form-control" placeholder="notificaciones@rodoperu.com" value="{{ $settings['smtp_from_address'] ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light small fw-bold">Nombre del Remitente (From Name)</label>
                        <input type="text" name="smtp_from_name" class="form-control" placeholder="RODOPERU Oficial" value="{{ $settings['smtp_from_name'] ?? 'RODOPERU' }}">
                    </div>
                </div>

                <!-- Test Email Box -->
                <div class="p-4 rounded-3 border border-warning bg-dark mt-4">
                    <h6 class="text-warning fw-bold mb-2"><i class="fas fa-paper-plane me-1"></i> Probar Conexión del Servidor SMTP</h6>
                    <p class="text-muted small mb-3">Guarda primero las credenciales arriba y luego ingresa un correo para enviar un mensaje de prueba inmediato.</p>
                    <div class="row g-2">
                        <div class="col-md-8">
                            <input type="email" form="test-smtp-form" name="test_email" class="form-control" placeholder="Ingresa tu correo para recibir la prueba..." required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" form="test-smtp-form" class="btn btn-outline-warning w-100 fw-bold">
                                <i class="fas fa-vial me-1"></i> Enviar Correo de Prueba
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Payment Gateways Tab -->
            <div class="tab-pane fade" id="tab-payment">
                <h5 class="text-white fw-bold mb-3"><i class="fas fa-credit-card text-success me-2"></i> Configuración de Métodos & Pasarelas de Pago</h5>
                
                <div class="row g-4">
                    <!-- Bank Accounts -->
                    <div class="col-12">
                        <div class="p-4 rounded-3 border border-secondary bg-dark">
                            <label class="form-label text-light fw-bold">Cuentas Bancarias e Instrucciones de Transferencia</label>
                            <textarea name="payment_bank_instructions" class="form-control" rows="4">{{ $settings['payment_bank_instructions'] ?? '' }}</textarea>
                            <small class="text-muted" style="font-size: 0.75rem;">Se mostrará en la pantalla final de pago y en los correos de confirmación.</small>
                        </div>
                    </div>

                    <!-- Digital Wallets -->
                    <div class="col-md-6">
                        <div class="p-4 rounded-3 border border-secondary bg-dark">
                            <label class="form-label text-light fw-bold">Número de Yape / Plin Corporativo</label>
                            <input type="text" name="payment_yape_phone" class="form-control" value="{{ $settings['payment_yape_phone'] ?? '' }}">
                        </div>
                    </div>

                    <!-- MercadoPago Online Gateway -->
                    <div class="col-md-6">
                        <div class="p-4 rounded-3 border border-secondary bg-dark">
                            <label class="form-label text-light fw-bold">Pasarela Online: MercadoPago Public Key</label>
                            <input type="text" name="payment_mercadopago_public_key" class="form-control mb-3" placeholder="TEST-..." value="{{ $settings['payment_mercadopago_public_key'] ?? '' }}">
                            <label class="form-label text-light fw-bold">MercadoPago Access Token</label>
                            <input type="password" name="payment_mercadopago_access_token" class="form-control" placeholder="TEST-..." value="{{ $settings['payment_mercadopago_access_token'] ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. WhatsApp & Social Networks Tab -->
            <div class="tab-pane fade" id="tab-social">
                <h5 class="text-white fw-bold mb-3"><i class="fab fa-whatsapp text-success me-2"></i> Integración de WhatsApp & Redes Sociales</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Número de WhatsApp Principal * (Formato Internacional)</label>
                        <input type="text" name="whatsapp_number" class="form-control" placeholder="+51987654321" value="{{ $settings['whatsapp_number'] ?? '+51987654321' }}">
                        <small class="text-muted" style="font-size: 0.75rem;">A este número llegarán las cotizaciones automáticas con modelo y código SKU.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Mensaje de Saludo Predeterminado</label>
                        <input type="text" name="whatsapp_welcome_message" class="form-control" value="{{ $settings['whatsapp_welcome_message'] ?? '' }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Enlace Facebook</label>
                        <input type="url" name="social_facebook" class="form-control" value="{{ $settings['social_facebook'] ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Enlace Instagram</label>
                        <input type="url" name="social_instagram" class="form-control" value="{{ $settings['social_instagram'] ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light small fw-bold">Enlace LinkedIn</label>
                        <input type="url" name="social_linkedin" class="form-control" value="{{ $settings['social_linkedin'] ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light small fw-bold">Enlace YouTube</label>
                        <input type="url" name="social_youtube" class="form-control" value="{{ $settings['social_youtube'] ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light small fw-bold">Enlace TikTok</label>
                        <input type="url" name="social_tiktok" class="form-control" value="{{ $settings['social_tiktok'] ?? '' }}">
                    </div>
                </div>
            </div>

            <!-- 5. General & SEO Tab -->
            <div class="tab-pane fade" id="tab-general">
                <h5 class="text-white fw-bold mb-3"><i class="fas fa-globe text-primary me-2"></i> Parámetros de Operación & SEO</h5>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label text-light small fw-bold">Símbolo de Moneda</label>
                        <input type="text" name="currency_symbol" class="form-control" value="{{ $settings['currency_symbol'] ?? 'USD $' }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light small fw-bold">Código ISO Moneda</label>
                        <input type="text" name="currency_code" class="form-control" value="{{ $settings['currency_code'] ?? 'USD' }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light small fw-bold">Impuesto IGV (%)</label>
                        <input type="number" name="tax_rate" class="form-control" value="{{ $settings['tax_rate'] ?? '18' }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Dirección de la Sede</label>
                        <input type="text" name="company_address" class="form-control" value="{{ $settings['company_address'] ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Central Telefónica</label>
                        <input type="text" name="company_phone" class="form-control" value="{{ $settings['company_phone'] ?? '' }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Correo de Soporte</label>
                        <input type="email" name="support_email" class="form-control" value="{{ $settings['support_email'] ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Correo de Ventas / Cotizaciones</label>
                        <input type="email" name="sales_email" class="form-control" value="{{ $settings['sales_email'] ?? '' }}">
                    </div>

                    <!-- SEO Fields -->
                    <div class="col-12 mt-4 pt-3 border-top border-secondary">
                        <h6 class="text-info fw-bold mb-3 text-uppercase">Posicionamiento en Buscadores (Google SEO)</h6>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Meta Título Predeterminado</label>
                        <input type="text" name="seo_meta_title" class="form-control" value="{{ $settings['seo_meta_title'] ?? '' }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Meta Descripción General (Google Snippet)</label>
                        <textarea name="seo_meta_description" class="form-control" rows="2">{{ $settings['seo_meta_description'] ?? '' }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Palabras Clave (Keywords)</label>
                        <input type="text" name="seo_meta_keywords" class="form-control" value="{{ $settings['seo_meta_keywords'] ?? '' }}">
                    </div>
                </div>
            </div>

        </div>

        <div class="p-4 border-top border-secondary bg-dark text-end">
            <button type="submit" class="btn btn-electric btn-lg px-5 fw-bold">
                <i class="fas fa-save me-2"></i> Guardar Todas las Configuraciones
            </button>
        </div>
    </form>
</div>

<!-- Standalone form for SMTP testing to prevent submitting entire settings -->
<form id="test-smtp-form" action="{{ route('admin.settings.test_smtp') }}" method="POST" style="display:none;">
    @csrf
</form>
@endsection
