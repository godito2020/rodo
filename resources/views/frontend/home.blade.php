@extends('layouts.app')

@php
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '+51987654321');
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
@endphp

@section('title', 'RODOPERU | Movilidad Eléctrica & Implementos Rodoviarios de Alto Rendimiento')

@push('styles')
<style>
    /* =========================================================================
       REDISEÑO PRINCIPAL: ESTILO LIMPIO, ELEGANTE Y PARALLAX DE PROFUNDIDAD
       ========================================================================= */

    /* 1. Hero Introductorio de Alto Impacto */
    .hero-parallax-intro {
        min-height: 80vh;
        background: radial-gradient(circle at 50% 40%, #0d1e40 0%, #070d1e 75%, #040813 100%);
        border-bottom: 1px solid rgba(0, 242, 254, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 5rem 1rem 4rem;
        position: relative;
        overflow: hidden;
    }

    .hero-parallax-intro::before {
        content: '';
        position: absolute;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(0, 242, 254, 0.12) 0%, transparent 70%);
        top: 20%;
        left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }

    .hero-title-main {
        font-family: 'Rajdhani', sans-serif;
        font-size: clamp(2.5rem, 6vw, 4.5rem);
        font-weight: 800;
        letter-spacing: 1px;
        line-height: 1.1;
        text-transform: uppercase;
        background: linear-gradient(135deg, #ffffff 30%, #a0e9ff 70%, #00f2fe 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .scroll-down-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(0, 242, 254, 0.08);
        border: 1px solid var(--electric-cyan);
        color: var(--electric-cyan);
        padding: 0.6rem 1.4rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-top: 2rem;
        animation: floatPulse 2.5s infinite ease-in-out;
    }

    @keyframes floatPulse {
        0%, 100% { transform: translateY(0); box-shadow: 0 0 10px rgba(0, 242, 254, 0.2); }
        50% { transform: translateY(-8px); box-shadow: 0 0 25px rgba(0, 242, 254, 0.45); }
    }

    /* 2. Sección Maestra Parallax con GSAP y ScrollTrigger */
    .parallax-master-showcase {
        background: #060b18;
        padding: 5rem 0 6rem;
        position: relative;
    }

    .rodo-parallax-item {
        margin-bottom: 7rem;
        position: relative;
    }
    .rodo-parallax-item:last-child {
        margin-bottom: 3rem;
    }

    /* Marco rígido que encapsula la imagen (evita desbordamientos y da acabado de vitrina) */
    .parallax-viewport-frame {
        position: relative;
        overflow: hidden;
        border-radius: 24px;
        background: #091226;
        border: 1px solid rgba(0, 242, 254, 0.25);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.75);
        height: 480px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Imagen sobre la que actúa GSAP: Escala 0.7 -> 1.2, Opacidad 0 -> 1, Recorrido 600px, 20% lag */
    .parallax-showcase-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        will-change: transform, opacity;
        transform-origin: center center;
    }

    /* Tarjeta informativa lateral */
    .parallax-info-card {
        background: rgba(13, 22, 44, 0.9);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    }

    .pill-tech-badge {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 2px;
        padding: 0.4rem 1rem;
        border-radius: 30px;
        display: inline-block;
        margin-bottom: 1rem;
        text-transform: uppercase;
    }

    /* 3. Franja de Métricas Técnicas */
    .spec-mini-box {
        background: #091122;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 0.75rem;
        text-align: center;
    }

    /* 4. Tarjetas de Propuesta de Valor */
    .clean-feature-box {
        background: #091122;
        border: 1px solid rgba(255, 255, 255, 0.07);
        border-radius: 14px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        height: 100%;
    }
    .clean-feature-box:hover {
        border-color: var(--electric-cyan);
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 242, 254, 0.15);
    }

    /* 5. Simulador */
    .clean-sim-panel {
        background: #091224;
        border: 1px solid rgba(0, 242, 254, 0.2);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.5);
    }
</style>
@endpush

@section('content')

    <!-- =========================================================================
         1. HERO DE VANGUARDIA: ENTRADA LIMPIA Y CUE DE SCROLL PARALLAX
         ========================================================================= -->
    <header class="hero-parallax-intro">
        <div class="container position-relative" style="z-index: 2;">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: rgba(0, 242, 254, 0.12); border: 1px solid rgba(0, 242, 254, 0.4);">
                <i class="fas fa-bolt text-info" style="font-size: 0.85rem;"></i>
                <span class="text-info fw-bold small" style="letter-spacing: 2px;">RODOPERU · ELECTROMOVILIDAD & CARGA PESADA</span>
            </div>

            <h1 class="hero-title-main mb-3">
                TECNOLOGÍA EN MOVIMIENTO &<br>POTENCIA DE TRANSPORTE
            </h1>

            <p class="text-light fs-5 mx-auto mb-4" style="max-width: 760px; line-height: 1.7; opacity: 0.9;">
                Fusionamos vehículos 100% eléctricos de alta autonomía con los legendarios implementos rodoviarios <strong>Facchini</strong>. Ingeniería homologada para el territorio peruano.
            </p>

            <div class="d-flex flex-wrap gap-3 justify-content-center mb-3">
                <a href="#experiencia-parallax" class="btn btn-electric btn-lg px-4 py-3 fw-bold">
                    <i class="fas fa-layer-group me-2"></i> Ver Modelos en Parallax
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                    <i class="fas fa-th-large me-2"></i> Catálogo Completo
                </a>
            </div>

            <a href="#experiencia-parallax" class="scroll-down-badge text-decoration-none">
                <i class="fas fa-arrow-down"></i> Desplázate hacia abajo para ver el Parallax <i class="fas fa-arrow-down"></i>
            </a>
        </div>
    </header>

    <!-- =========================================================================
         2. FRANJA ORDENADA DE VALOR TÉCNICO (Sin emojis clásicos)
         ========================================================================= -->
    <section class="py-4 home-tech-strip">
        <div class="container">
            <div class="row g-3">
                <div class="col-lg-3 col-sm-6">
                    <div class="clean-feature-box d-flex align-items-center gap-3">
                        <div class="rounded-3 text-info d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; min-width: 52px; min-height: 52px; background: rgba(0, 242, 254, 0.12); font-size: 1.4rem;">
                            <i class="fas fa-bolt-lightning"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-white fs-6">100% ELÉCTRICO</div>
                            <small class="text-muted">Ahorro de hasta 75% en costo x km</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="clean-feature-box d-flex align-items-center gap-3">
                        <div class="rounded-3 text-warning d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; min-width: 52px; min-height: 52px; background: rgba(255, 145, 0, 0.12); font-size: 1.4rem;">
                            <i class="fas fa-truck-front"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-white fs-6">CALIDAD FACCHINI</div>
                            <small class="text-muted">Semirremolques y tolvas reforzadas</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="clean-feature-box d-flex align-items-center gap-3">
                        <div class="rounded-3 text-success d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; min-width: 52px; min-height: 52px; background: rgba(0, 230, 118, 0.12); font-size: 1.4rem;">
                            <i class="fas fa-charging-station"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-white fs-6">HASTA 520 KM</div>
                            <small class="text-muted">Autonomía y carga rápida europea CCS2</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="clean-feature-box d-flex align-items-center gap-3">
                        <div class="rounded-3 text-primary d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; min-width: 52px; min-height: 52px; background: rgba(79, 172, 254, 0.12); font-size: 1.4rem;">
                            <i class="fas fa-shield-halved"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-white fs-6">SOPORTE EN PERÚ</div>
                            <small class="text-muted">Homologación MTC y repuestos en stock</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         3. SECCIÓN PARALLAX CON EFECTO DE DESPLAZAMIENTO (GSAP & SCROLLTRIGGER)
         - 3 imágenes de ejemplo
         - Escala suave desde 0.7 hasta 1.2
         - Opacidad de 0 a 1 a lo largo de 600px de recorrido de scroll
         - Ease 'power2.out'
         - Desplazamiento vertical 20% más lento que el scroll (lag de 120px)
         ========================================================================= -->
    <main class="parallax-master-showcase" id="experiencia-parallax">
        <div class="container">

            <div class="text-center mb-5 pb-3">
                <span class="badge py-2 px-3 mb-2" style="background: rgba(0, 242, 254, 0.15); color: #00f2fe; border: 1px solid #00f2fe; letter-spacing: 2px;">
                    <i class="fas fa-cubes me-1"></i> EXPERIENCIA DE PROFUNDIDAD
                </span>
                <h2 class="display-5 fw-bold text-white mb-2" style="font-family: 'Rajdhani', sans-serif;">
                    LÍNEAS DE INGENIERÍA EN PARALLAX
                </h2>
                <p class="text-muted mx-auto fs-5" style="max-width: 680px;">
                    Haz scroll y observa cómo cada imagen escala dinámicamente desde 0.7 hasta 1.2 ganando opacidad y profundidad cinemática.
                </p>
            </div>

            <!-- IMAGEN 1: SUV 100% Eléctrico Insignia -->
            <section class="rodo-parallax-item" data-id="1">
                <div class="row align-items-center g-5">
                    <div class="col-lg-7">
                        <div class="parallax-viewport-frame">
                            <img src="{{ asset('images/parallax/parallax-1-ev-suv.svg') }}" 
                                 alt="RODOPERU EV-600 Grand SUV Eléctrico" 
                                 class="parallax-showcase-img">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="parallax-info-card parallax-content">
                            <span class="pill-tech-badge pill-badge-cyan">
                                <i class="fas fa-bolt me-1"></i> ELECTROMOVILIDAD PURA
                            </span>
                            <h3 class="display-6 fw-bold text-white mb-3" style="font-family: 'Rajdhani', sans-serif;">
                                RODOPERU EV-600 INSIGNIA
                            </h3>
                            <p class="text-light mb-4" style="line-height: 1.7;">
                                Arquitectura modular de última generación. Cero emisiones de CO2, coeficiente aerodinámico optimizado y batería Blade LFP de máxima seguridad contra impactos y temperatura.
                            </p>
                            <div class="row g-2 mb-4 text-center">
                                <div class="col-4">
                                    <div class="spec-mini-box">
                                        <div class="h5 text-info fw-bold mb-0">520 km</div>
                                        <small class="text-muted" style="font-size: 0.72rem;">Autonomía</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="spec-mini-box">
                                        <div class="h5 text-info fw-bold mb-0">30 min</div>
                                        <small class="text-muted" style="font-size: 0.72rem;">Carga Rápida</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="spec-mini-box">
                                        <div class="h5 text-info fw-bold mb-0">82 kWh</div>
                                        <small class="text-muted" style="font-size: 0.72rem;">Batería LFP</small>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.index', ['categoria' => 'vehiculos-electricos']) }}" class="btn btn-electric px-4 py-2 fw-bold">
                                    Ver Especificaciones <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                                <a href="https://api.whatsapp.com/send?phone={{ $whatsappClean }}&text={{ rawurlencode('Hola RODOPERU, solicito asesoría técnica y cotización del modelo EV-600 Insignia.') }}" target="_blank" class="btn btn-outline-info px-3 py-2">
                                    <i class="fab fa-whatsapp"></i> Asesor
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- IMAGEN 2: Semirremolque Facchini 3 Ejes -->
            <section class="rodo-parallax-item" data-id="2">
                <div class="row align-items-center g-5 flex-lg-row-reverse">
                    <div class="col-lg-7">
                        <div class="parallax-viewport-frame" style="border-color: rgba(255, 145, 0, 0.35);">
                            <img src="{{ asset('images/parallax/parallax-2-facchini-truck.svg') }}" 
                                 alt="Semirremolque Facchini 3 Ejes" 
                                 class="parallax-showcase-img">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="parallax-info-card parallax-content" style="border-color: rgba(255, 145, 0, 0.25);">
                            <span class="pill-tech-badge pill-badge-amber">
                                <i class="fas fa-truck-moving me-1"></i> CARGA PESADA FACCHINI
                            </span>
                            <h3 class="display-6 fw-bold text-white mb-3" style="font-family: 'Rajdhani', sans-serif;">
                                SEMIRREMOLQUES FACCHINI 3 EJES
                            </h3>
                            <p class="text-light mb-4" style="line-height: 1.7;">
                                Robustez de estándar internacional. Estructura de acero de alta resistencia para transporte minero, portacontenedor y carga seca en las rutas más exigentes del país.
                            </p>
                            <div class="row g-2 mb-4 text-center">
                                <div class="col-4">
                                    <div class="spec-mini-box">
                                        <div class="h5 text-warning fw-bold mb-0">35 Ton</div>
                                        <small class="text-muted" style="font-size: 0.72rem;">Carga Útil</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="spec-mini-box">
                                        <div class="h5 text-warning fw-bold mb-0">3 Ejes</div>
                                        <small class="text-muted" style="font-size: 0.72rem;">Suspensión</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="spec-mini-box">
                                        <div class="h5 text-warning fw-bold mb-0">14.5 m</div>
                                        <small class="text-muted" style="font-size: 0.72rem;">Longitud</small>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.index', ['categoria' => 'implementos-rodoviarios']) }}" class="btn btn-outline-warning px-4 py-2 fw-bold">
                                    Ver Furgones y Tolvas <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                                <a href="https://api.whatsapp.com/send?phone={{ $whatsappClean }}&text={{ rawurlencode('Hola RODOPERU, deseo cotizar semirremolques Facchini para transporte de carga.') }}" target="_blank" class="btn btn-amber px-3 py-2 fw-bold">
                                    <i class="fab fa-whatsapp"></i> Cotizar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- IMAGEN 3: Urban Sedan EV para Flotas -->
            <section class="rodo-parallax-item" data-id="3">
                <div class="row align-items-center g-5">
                    <div class="col-lg-7">
                        <div class="parallax-viewport-frame" style="border-color: rgba(0, 230, 118, 0.35);">
                            <img src="{{ asset('images/parallax/parallax-3-ev-sedan.svg') }}" 
                                 alt="RODOPERU Urban Sedan EV Cero Emisiones" 
                                 class="parallax-showcase-img">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="parallax-info-card parallax-content" style="border-color: rgba(0, 230, 118, 0.25);">
                            <span class="pill-tech-badge pill-badge-green">
                                <i class="fas fa-leaf me-1"></i> EFICIENCIA CORPORATIVA & FLOTAS
                            </span>
                            <h3 class="display-6 fw-bold text-white mb-3" style="font-family: 'Rajdhani', sans-serif;">
                                RODOPERU URBAN SEDAN EV
                            </h3>
                            <p class="text-light mb-4" style="line-height: 1.7;">
                                Rendimiento superior y costo operacional mínimo para flotas ejecutivas o movilidad diaria. Menos de S/ 0.05 por kilómetro de recorrido eléctrico en Lima Metropolitana.
                            </p>
                            <div class="row g-2 mb-4 text-center">
                                <div class="col-4">
                                    <div class="spec-mini-box">
                                        <div class="h5 text-success fw-bold mb-0">S/ 0.05</div>
                                        <small class="text-muted" style="font-size: 0.72rem;">Costo x Km</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="spec-mini-box">
                                        <div class="h5 text-success fw-bold mb-0">400 km</div>
                                        <small class="text-muted" style="font-size: 0.72rem;">Autonomía</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="spec-mini-box">
                                        <div class="h5 text-success fw-bold mb-0">0% CO2</div>
                                        <small class="text-muted" style="font-size: 0.72rem;">Emisiones</small>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.destacados') }}" class="btn btn-outline-success px-4 py-2 fw-bold">
                                    Ver Destacados <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                                <a href="{{ route('contacto') }}" class="btn btn-neon-green px-3 py-2 fw-bold">
                                    <i class="fas fa-calculator me-1"></i> Cotizar Flota
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>

    <!-- =========================================================================
         4. CATÁLOGO ORDENADO: VEHÍCULOS ELÉCTRICOS DISPONIBLES
         ========================================================================= -->
    <section class="py-5 home-section-ev">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
                <div>
                    <span class="text-info fw-bold text-uppercase" style="letter-spacing: 1.5px; font-size: 0.85rem;">CATÁLOGO DE MOVILIDAD</span>
                    <h2 class="display-6 fw-bold text-white mb-0" style="font-family: 'Rajdhani', sans-serif;">Modelos 100% Eléctricos</h2>
                </div>
                <a href="{{ route('products.index', ['categoria' => 'vehiculos-electricos']) }}" class="btn btn-outline-electric mt-3 mt-md-0">
                    Ver Todos los EV <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="row g-4">
                @forelse($electricVehicles as $prod)
                    <div class="col-lg-4 col-md-6">
                        @include('frontend.products.partials.card', ['product' => $prod])
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-muted">No hay vehículos eléctricos disponibles en este momento.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- =========================================================================
         5. SIMULADOR INTERACTIVO DE IMPACTO Y AHORRO ENERGÉTICO
         ========================================================================= -->
    <section class="py-5 home-section-sim">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <span class="badge pill-badge-green fw-bold px-3 py-2 mb-2">
                        <i class="fas fa-calculator me-1"></i> SIMULADOR DE IMPACTO ECONÓMICO
                    </span>
                    <h2 class="display-6 fw-bold text-white mb-3" style="font-family: 'Rajdhani', sans-serif;">
                        Calcula el Retorno de Inversión
                    </h2>
                    <p class="text-muted" style="line-height: 1.6;">
                        El costo de electricidad por kilómetro en Perú equivale a menos de una cuarta parte de lo que pagas en gasolina o diésel. Simula el recorrido promedio diario y comprueba el retorno de inversión.
                    </p>
                    <ul class="list-unstyled text-light mb-4">
                        <li class="mb-2"><i class="fas fa-check-circle text-info me-2"></i> <strong>Cero consumo</strong> de combustible fósil.</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-info me-2"></i> <strong>70% de reducción</strong> en mantenimiento preventivo.</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-info me-2"></i> <strong>Mayor valor residual</strong> y beneficios tributarios corporativos.</li>
                    </ul>
                </div>
                <div class="col-lg-7">
                    <div class="clean-sim-panel">
                        <h4 class="text-white mb-4"><i class="fas fa-sliders-h text-info me-2"></i> Ajusta tus Parámetros:</h4>
                        
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <label class="form-label text-light fw-bold">Kilómetros Recorridos al Día:</label>
                                <span class="badge bg-dark border border-info text-info fs-6 fw-bold" id="km-display">80 km</span>
                            </div>
                            <input type="range" class="form-range" id="km-slider" min="20" max="300" step="10" value="80">
                        </div>

                        <div class="row g-3 text-center mb-4">
                            <div class="col-6">
                                <div class="p-3 bg-dark rounded border border-danger">
                                    <small class="text-muted d-block mb-1">Gasto Anual Combustible Fósil</small>
                                    <div class="h4 text-danger fw-bold mb-0" id="gas-cost-display">USD $3,840</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-dark rounded border border-success">
                                    <small class="text-muted d-block mb-1">Gasto Anual Eléctrico RODO</small>
                                    <div class="h4 text-success fw-bold mb-0" id="ev-cost-display">USD $890</div>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 rounded text-center" style="background: rgba(0, 242, 254, 0.08); border: 1px dashed var(--electric-cyan);">
                            <span class="text-muted d-block mb-1">Ahorro Neto Anual Estimado:</span>
                            <div class="display-6 fw-bold text-info" id="savings-display">USD $2,950 / año</div>
                            <small class="text-light">¡Equivalente a más de S/ 11,000 Soles de ahorro directo por unidad!</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         6. IMPLEMENTOS RODOVIARIOS FACCHINI
         ========================================================================= -->
    <section class="py-5 home-section-facchini">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
                <div>
                    <span class="text-warning fw-bold text-uppercase" style="letter-spacing: 1.5px; font-size: 0.85rem;">POTENCIA & CARGA PESADA</span>
                    <h2 class="display-6 fw-bold text-white mb-0" style="font-family: 'Rajdhani', sans-serif;">Semirremolques Facchini</h2>
                </div>
                <a href="{{ route('products.index', ['categoria' => 'implementos-rodoviarios']) }}" class="btn btn-outline-warning mt-3 mt-md-0">
                    Ver Semirremolques <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="row g-4">
                @forelse($roadImplements as $prod)
                    <div class="col-lg-4 col-md-6">
                        @include('frontend.products.partials.card', ['product' => $prod])
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-muted">No hay implementos rodoviarios disponibles.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- =========================================================================
         7. MARCAS HOMOLOGADAS
         ========================================================================= -->
    <section class="py-5 home-section-brands">
        <div class="container text-center">
            <span class="text-muted fw-bold text-uppercase" style="letter-spacing: 2px; font-size: 0.82rem;">MARCAS OFICIALES & TECNOLOGÍA INTEGRADA</span>
            <div class="row g-4 justify-content-center align-items-center mt-3">
                @foreach($brands as $brand)
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="p-3 bg-dark rounded border border-secondary text-center hover-glow" style="transition: all 0.3s;">
                            <div class="fw-bold text-white fs-6 mb-1">{{ $brand->name }}</div>
                            <small class="text-info" style="font-size: 0.72rem;">Certificado Oficial</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- =========================================================================
         8. NOVEDADES & ARTÍCULOS TÉCNICOS
         ========================================================================= -->
    <section class="py-5 home-section-news">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <span class="text-info fw-bold text-uppercase" style="letter-spacing: 1.5px; font-size: 0.85rem;">ACTUALIDAD & TENDENCIAS</span>
                    <h2 class="display-6 fw-bold text-white mb-0" style="font-family: 'Rajdhani', sans-serif;">Novedades del Sector</h2>
                </div>
                <a href="{{ route('novedades.index') }}" class="btn btn-outline-secondary text-white border-secondary">
                    Ver Artículos <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="row g-4">
                @foreach($recentArticles as $art)
                    <div class="col-lg-4 col-md-6">
                        <div class="card-custom h-100 overflow-hidden d-flex flex-column">
                            <img src="{{ $art->image_url }}" alt="{{ $art->title }}" class="w-100" style="height: 180px; object-fit: cover;">
                            <div class="p-4 d-flex flex-column flex-grow-1">
                                <span class="badge bg-dark border border-info text-info mb-2 align-self-start">{{ $art->category }}</span>
                                <h5 class="text-white mb-2">
                                    <a href="{{ route('novedades.show', $art->slug) }}" class="text-white text-decoration-none hover-cyan">
                                        {{ $art->title }}
                                    </a>
                                </h5>
                                <p class="text-muted small flex-grow-1" style="line-height: 1.6;">
                                    {{ Str::limit($art->summary, 120) }}
                                </p>
                                <a href="{{ route('novedades.show', $art->slug) }}" class="text-info text-decoration-none fw-bold small">
                                    Leer Artículo Completo <i class="fas fa-chevron-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- =========================================================================
         9. FRANJA FINAL DE LLAMADO A LA ACCIÓN (CTA)
         ========================================================================= -->
    <section class="py-5 text-center text-md-start home-cta-section">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h2 class="display-6 fw-bold text-white mb-2" style="font-family: 'Rajdhani', sans-serif;">
                        ¿Listo para modernizar tu flota de transporte?
                    </h2>
                    <p class="text-light mb-0 fs-5">
                        Habla hoy con un asesor técnico de RODOPERU y recibe cotización formal, planes de leasing vehicular o configuración especial a pedido.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-lg-end">
                        <a href="https://api.whatsapp.com/send?phone={{ $whatsappClean }}&text={{ rawurlencode('Hola RODOPERU, deseo asesoría técnica y cotización comercial.') }}" target="_blank" class="btn btn-whatsapp-quote btn-lg px-4 py-3">
                            <i class="fab fa-whatsapp me-2"></i> WhatsApp Asesor
                        </a>
                        <a href="{{ route('contacto') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                            <i class="fas fa-envelope me-2"></i> Cotizar en Línea
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // =========================================================================
        // INICIALIZACIÓN DE GSAP Y SCROLLTRIGGER: PARALLAX ZOOM & PROFUNDIDAD
        // =========================================================================
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);

            const parallaxCards = document.querySelectorAll('.rodo-parallax-item');

            parallaxCards.forEach((item) => {
                const img = item.querySelector('.parallax-showcase-img');
                const content = item.querySelector('.parallax-content');

                if (img) {
                    /*
                     * CONFIGURACIÓN SOLICITADA POR EL USUARIO:
                     * 1. Escalar suavemente desde 0.7 hasta 1.2
                     * 2. Pasar de opacidad 0 a 1
                     * 3. A lo largo de 600px de recorrido de scroll (end: "+=600")
                     * 4. Con ease: 'power2.out'
                     * 5. Moverse verticalmente un 20% más lento que el scroll para sensación de profundidad
                     *    (Lag de 20% sobre 600px = 120px de desplazamiento rezagado en dirección del scroll).
                     */
                    gsap.fromTo(img,
                        {
                            scale: 0.7,
                            opacity: 0,
                            y: 0
                        },
                        {
                            scale: 1.2,
                            opacity: 1,
                            y: 120, // Desplazamiento rezagado (20% de 600px)
                            ease: 'power2.out',
                            scrollTrigger: {
                                trigger: item,
                                start: 'top 85%',   // Se activa al entrar al 85% de la pantalla
                                end: '+=600',       // Recorrido exacto de 600px
                                scrub: 1,           // Suavizado dinámico fluido
                                invalidateOnRefresh: true
                            }
                        }
                    );
                }

                if (content) {
                    // Animación sincronizada para el bloque de texto descriptivo
                    gsap.fromTo(content,
                        {
                            opacity: 0,
                            y: 35
                        },
                        {
                            opacity: 1,
                            y: 0,
                            ease: 'power2.out',
                            scrollTrigger: {
                                trigger: item,
                                start: 'top 80%',
                                end: '+=450',
                                scrub: 1
                            }
                        }
                    );
                }
            });
        }

        // =========================================================================
        // LÓGICA DEL SIMULADOR INTERACTIVO DE AHORRO ELÉCTRICO
        // =========================================================================
        const kmSlider = document.getElementById('km-slider');
        const kmDisplay = document.getElementById('km-display');
        const gasCostDisplay = document.getElementById('gas-cost-display');
        const evCostDisplay = document.getElementById('ev-cost-display');
        const savingsDisplay = document.getElementById('savings-display');

        if (kmSlider) {
            kmSlider.addEventListener('input', function() {
                const km = parseInt(this.value);
                kmDisplay.innerText = km + ' km';

                const annualKm = km * 300;
                const gasCost = Math.round(annualKm * 0.16);
                const evCost = Math.round(annualKm * 0.037);
                const savings = gasCost - evCost;

                gasCostDisplay.innerText = 'USD $' + gasCost.toLocaleString();
                evCostDisplay.innerText = 'USD $' + evCost.toLocaleString();
                savingsDisplay.innerText = 'USD $' + savings.toLocaleString() + ' / año';
            });
        }
    });
</script>
@endpush
