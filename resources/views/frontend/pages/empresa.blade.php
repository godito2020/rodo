@extends('layouts.app')

@section('title', 'Nuestra Empresa | RODOPERU - Líderes en Movilidad e Implementos')
@section('meta_description', 'Conoce la historia, misión y visión de RODOPERU, empresa peruana pionera en electromovilidad automotriz y distribución oficial de implementos Facchini.')

@section('content')
<div class="py-5 text-center position-relative overflow-hidden empresa-hero">
    <div class="container position-relative z-1 py-4">
        <span class="badge bg-dark border border-info text-info px-3 py-2 mb-3 text-uppercase font-weight-bold">
            <i class="fas fa-building me-1"></i> IDENTIDAD CORPORATIVA
        </span>
        <h1 class="display-4 fw-bold text-white mb-3">Impulsando el Futuro del Transporte en el Perú</h1>
        <p class="lead text-light mx-auto" style="max-width: 750px;">
            En <strong>RODOPERU</strong> fusionamos la vanguardia tecnológica mundial de la electromovilidad con la solidez de los mejores implementos rodoviarios para la geografía peruana.
        </p>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <!-- Story / Quienes Somos -->
        <div class="row align-items-center g-5 mb-5 pb-4">
            <div class="col-lg-6">
                <span class="text-info fw-bold text-uppercase" style="letter-spacing: 1.5px; font-size: 0.85rem;">QUIÉNES SOMOS</span>
                <h2 class="display-6 fw-bold text-white mb-4">Ingeniería, Potencia y Compromiso con el Medio Ambiente</h2>
                <p class="text-light" style="line-height: 1.8;">
                    <strong>RODOPERU S.A.C.</strong> nace con la visión de liderar la transformación energética del parque automotor y logístico nacional. Combinamos la representación estratégica de marcas globales de vehículos 100% eléctricos (como JMEV y tecnología de baterías CATL) con la distribución e integración de semirremolques de alto tonelaje <strong>Facchini Rodoviários</strong>.
                </p>
                <p class="text-muted" style="line-height: 1.8;">
                    Nuestras operaciones abarcan desde la venta de vehículos eléctricos para transporte particular, corporativo y última milla, hasta la provisión de tolvas basculantes Hardox, furgones de carga seca de 14.6m y cisternas homologadas por Osinergmin.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="p-4 rounded-4 border border-secondary empresa-stat-card">
                    <img src="{{ asset(\App\Models\Setting::get('logo_path', 'images/logo/RODO.png')) }}" alt="RODOPERU" class="img-fluid mb-4 p-3 bg-dark rounded border border-dark">
                    <div class="row g-3 text-center">
                        <div class="col-6">
                            <div class="p-3 bg-dark rounded border border-secondary">
                                <div class="display-6 fw-bold text-info">100%</div>
                                <small class="text-light">Cero Emisiones Directas</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-dark rounded border border-secondary">
                                <div class="display-6 fw-bold text-warning">3 Años</div>
                                <small class="text-light">Garantía Estructural Facchini</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Misión y Visión -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="p-5 rounded-4 border border-secondary h-100 empresa-mv-card">
                    <div class="rodo-icon-circle rodo-icon-cyan">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                    <h3 class="text-white fw-bold mb-3">Nuestra Misión</h3>
                    <p class="text-muted mb-0" style="line-height: 1.8;">
                        Proveer al mercado peruano soluciones integrales de movilidad eléctrica e implementos rodoviarios que maximicen la rentabilidad y seguridad de nuestros clientes, reduciendo radicalmente los costos de operación por kilómetro y acelerando la transición hacia un transporte limpio.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-5 rounded-4 border border-secondary h-100 empresa-mv-card">
                    <div class="rodo-icon-circle rodo-icon-amber">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3 class="text-white fw-bold mb-3">Nuestra Visión</h3>
                    <p class="text-muted mb-0" style="line-height: 1.8;">
                        Ser el referente indiscutible y el principal ecosistema de electrificación automotriz y transporte pesado en el Perú, reconocidos por la excelencia de ingeniería de nuestros vehículos, el respaldo técnico posventa en las 25 regiones y la confianza de los mayores operadores logísticos del país.
                    </p>
                </div>
            </div>
        </div>

        <!-- Alianzas Estratégicas (Facchini & JMEV) -->
        <div class="py-4">
            <div class="text-center mb-4">
                <span class="text-info fw-bold text-uppercase" style="letter-spacing: 1.5px; font-size: 0.85rem;">RESPALDO DE NIVEL INTERNACIONAL</span>
                <h2 class="display-6 fw-bold text-white">Nuestras Alianzas Estratégicas</h2>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($brands as $b)
                    <div class="col-md-4">
                        <div class="p-4 rounded-3 border border-secondary bg-dark h-100 text-center">
                            <h4 class="text-white fw-bold mb-2">{{ $b->name }}</h4>
                            <p class="text-muted small mb-3">{{ $b->description }}</p>
                            @if($b->website)
                                <a href="{{ $b->website }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    Sitio Oficial <i class="fas fa-external-link-alt ms-1"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
