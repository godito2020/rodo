@extends('layouts.app')

@section('title', 'RODOPERU | Empresa & Respaldo Institucional')

@section('meta_description', 'Conozca la trayectoria, misión, visión e infraestructura de RODOPERU S.A.C. Representantes oficiales de Facchini y pioneros en electromovilidad en el Perú.')

@php
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '+51987654321');
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
    $companyPhone = \App\Models\Setting::get('company_phone', '+51 (01) 719-8900');
@endphp

@section('content')

<!-- 1. BREADCRUMB STRIP -->
<div class="w-full bg-slate-100 py-3 border-b border-slate-200">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 flex items-center justify-between font-metric text-xs text-slate-600">
        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[15px]">home</span>
                <span>Inicio</span>
            </a>
            <span>/</span>
            <span class="text-[#051125] font-bold">Empresa &amp; Respaldo Institucional</span>
        </div>
        <div class="hidden sm:flex items-center gap-4">
            <span class="inline-flex items-center gap-1.5 text-emerald-700 font-semibold">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Sede Industrial Ate Operativa</span>
            </span>
            <span>•</span>
            <span class="font-bold text-[#051125]">RUC: 20601234567</span>
        </div>
    </div>
</div>

<!-- 2. HERO CORPORATIVO -->
<section class="relative w-full bg-[#051125] text-white overflow-hidden py-14 lg:py-20" style="background: linear-gradient(135deg, #07153b 0%, #0d2a78 60%, #155dfc 100%);">
    <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-[#ffdea6]/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <div class="lg:col-span-7 space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#1b263b] text-[#ffdea6] rounded-full font-metric text-xs shadow-sm border border-white/10 font-semibold">
                    <span class="material-symbols-outlined text-[16px]">verified</span>
                    <span class="uppercase tracking-wider">Ingeniería &amp; Respaldo Corporativo</span>
                </div>
                
                <h1 class="font-headline text-3xl sm:text-5xl font-bold text-white tracking-tight leading-tight">
                    Pioneros en <span class="text-[#ffdea6]">Electromovilidad</span> y Respaldo Pesado en el Perú
                </h1>
                
                <p class="font-body text-base text-slate-200 max-w-2xl leading-relaxed">
                    Consolidamos la transición energética y la eficiencia operativa del transporte nacional. Fusionamos tecnología de cero emisiones para última milla corporativa con la robustez estructural de los implementos rodoviarios más reconocidos del continente.
                </p>

                <div class="pt-3 flex flex-wrap items-center gap-3">
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20conocer%20mas%20sobre%20su%20respaldo%20corporativo" target="_blank" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-[#ffdea6] hover:bg-[#fed894] text-[#271900] font-headline text-sm font-bold rounded-lg shadow-xl transition-all">
                        <i class="fab fa-whatsapp text-lg"></i>
                        <span>Contactar Asesor Corporativo</span>
                    </a>
                    <a href="#instalaciones" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-[#1b263b] hover:bg-[#1a2737] text-white font-headline text-sm font-semibold rounded-lg border border-white/15 transition-all">
                        <span class="material-symbols-outlined text-[20px] text-[#ffdea6]">precision_manufacturing</span>
                        <span>Nuestras Instalaciones</span>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5 relative">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-[#1b263b] border border-white/15">
                    <img src="{{ asset('images/catalog/patio-industrial-ate.jpg') }}" alt="Patio Industrial RODOPERU" class="w-full h-[400px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#051125] via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-[#051125]/85 backdrop-blur-md border-t border-white/10">
                        <div class="flex items-center justify-between text-white font-metric text-xs">
                            <span class="flex items-center gap-1.5 text-[#ffdea6]">
                                <span class="material-symbols-outlined text-[18px]">engineering</span>
                                <span>Patio Industrial Ate - Km 8.5</span>
                            </span>
                            <span class="text-slate-300 font-semibold">10,000 m² de Capacidad</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3. MISIÓN Y VISIÓN -->
<section class="w-full py-16 bg-[#f9faf5] font-body">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- Misión -->
            <div class="bg-white p-8 sm:p-10 rounded-2xl shadow-md border border-slate-200 flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-[#051125] text-[#ffdea6] flex items-center justify-center shadow-sm">
                        <span class="material-symbols-outlined text-[26px]">eco</span>
                    </div>
                    <div class="space-y-1">
                        <span class="font-metric text-xs text-[#765a23] uppercase font-bold tracking-wider">PROPÓSITO FUNDAMENTAL</span>
                        <h2 class="font-headline text-2xl font-bold text-[#051125]">Nuestra Misión</h2>
                    </div>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Impulsar la descarbonización del parque automotor peruano e incrementar la productividad de los sectores minero, agroindustrial y logístico mediante flotas 100% eléctricas de vanguardia y carrocerías de máxima durabilidad, respaldadas por un servicio posventa de clase mundial.
                    </p>
                </div>
                <div class="mt-6 pt-4 flex items-center gap-3 bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="material-symbols-outlined text-emerald-600 text-[24px]">co2</span>
                    <span class="font-metric text-xs text-slate-700 uppercase font-semibold">Compromiso directo con la neutralidad de carbono</span>
                </div>
            </div>

            <!-- Visión -->
            <div class="bg-[#051125] text-white p-8 sm:p-10 rounded-2xl shadow-xl border border-white/10 flex flex-col justify-between" style="background: linear-gradient(135deg, #07153b 0%, #0d2a78 60%, #155dfc 100%);">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-[#ffdea6] text-[#271900] flex items-center justify-center shadow-sm">
                        <span class="material-symbols-outlined text-[26px]">explore</span>
                    </div>
                    <div class="space-y-1">
                        <span class="font-metric text-xs text-[#ffdea6] uppercase font-bold tracking-wider">PROYECCIÓN ESTRATÉGICA</span>
                        <h2 class="font-headline text-2xl font-bold text-white">Nuestra Visión</h2>
                    </div>
                    <p class="text-sm text-slate-200 leading-relaxed">
                        Ser el referente institucional absoluto en el Perú para la transición hacia la electromovilidad comercial pesada y el transporte multimodal, reconocidos por la solidez de nuestras homologaciones, excelencia técnica y alianzas exclusivas con fabricantes líderes globales.
                    </p>
                </div>
                <div class="mt-6 pt-4 flex items-center gap-3 bg-[#1b263b]/70 p-3 rounded-xl border border-white/10">
                    <span class="material-symbols-outlined text-[#ffdea6] text-[24px]">workspace_premium</span>
                    <span class="font-metric text-xs text-[#ffdea6] uppercase font-semibold">Liderazgo regional y garantía oficial</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 4. PILARES E INFRAESTRUCTURA -->
<section class="w-full bg-white py-16 border-t border-slate-200 font-body" id="instalaciones">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12">
        <div class="text-center space-y-1 mb-12">
            <span class="font-metric text-xs text-[#765a23] uppercase font-bold tracking-wider">VENTAJAS COMPETITIVAS</span>
            <h3 class="font-headline text-2xl sm:text-3xl font-bold text-[#051125]">Pilares de Excelencia Operativa</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <span class="material-symbols-outlined text-[#051125] text-[36px]">verified_user</span>
                <h4 class="font-headline text-lg font-bold text-[#051125]">Homologación MTC</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    100% de nuestras unidades cuentan con expediente técnico aprobado por el Ministerio de Transportes y Comunicaciones, listas para emplacar y operar.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <span class="material-symbols-outlined text-[#051125] text-[36px]">handshake</span>
                <h4 class="font-headline text-lg font-bold text-[#051125]">Alianzas Tier-1</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Representación directa de Facchini Brasil, celdas de batería CATL y chasis electrificados BYD con soporte directo de fábrica.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <span class="material-symbols-outlined text-[#051125] text-[36px]">warehouse</span>
                <h4 class="font-headline text-lg font-bold text-[#051125]">Patio Central de 10,000 m²</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Showroom comercial, zona de pruebas técnicas de carga y patio de almacenamiento en la estratégica Carretera Central / Evitamiento Km 8.5 en Ate.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <span class="material-symbols-outlined text-[#051125] text-[36px]">build_circle</span>
                <h4 class="font-headline text-lg font-bold text-[#051125]">Servicio Posventa &amp; Repuestos</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Stock permanente de repuestos originales Facchini (ejes, pernos rey, válvulas Wabco) y servicio de diagnóstico de baterías con escáner oficial.
                </p>
            </div>

        </div>
    </div>
</section>

@endsection
