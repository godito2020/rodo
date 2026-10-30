@extends('layouts.app')

@section('title', 'RODOPERU | Novedades, Tendencias & Centro Técnico')

@section('meta_description', 'Artículos técnicos, análisis de normativas MTC, especificaciones de semirremolques Facchini y casos de éxito de electromovilidad en el Perú.')

@php
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '+51987654321');
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
@endphp

@section('content')

<!-- Technical Bar Indicator -->
<div class="w-full bg-slate-100 py-3 border-b border-slate-200">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 flex flex-wrap items-center justify-between gap-4 font-metric text-xs text-slate-600">
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded bg-slate-200 text-[#051125] font-bold">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>CENTRO TÉCNICO &amp; REGULATORIO</span>
            </span>
            <span class="hidden md:inline">Actualizado conforme a directivas vigentes del MTC y Ley N° 31696</span>
        </div>
        <div class="flex items-center gap-4">
            <span class="flex items-center gap-1 text-[#051125] font-semibold">
                <span class="material-symbols-outlined text-[16px] text-[#765a23]">verified</span>
                <span>Ingeniería Certificada Facchini &amp; JMEV</span>
            </span>
        </div>
    </div>
</div>

<!-- Editorial Masthead Header -->
<section class="w-full bg-white px-4 sm:px-6 lg:px-12 pt-10 pb-8 border-b border-slate-200 font-body">
    <div class="max-w-[1440px] mx-auto">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-6">
            <div class="space-y-2 max-w-3xl">
                <div class="inline-flex items-center gap-2 text-[#765a23] font-metric text-xs tracking-wider uppercase font-bold">
                    <span>Boletín de Inteligencia Logística</span>
                    <span>/</span>
                    <span>Edición {{ date('Y') }}</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-bold text-[#051125] tracking-tight">
                    Novedades, Tendencias &amp; Casos de Éxito
                </h1>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    Análisis de ingeniería, reglamentación del MTC y metodologías operativas para acelerar la transición energética y rentabilizar flotas pesadas en el territorio peruano.
                </p>
            </div>

            <!-- Micro stats panel -->
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 flex items-center gap-6 shrink-0 shadow-sm">
                <div>
                    <span class="font-metric text-[10px] text-slate-500 uppercase block">Impacto CO₂ Flotas</span>
                    <span class="font-metric text-2xl font-bold text-[#051125] block">-68%</span>
                    <span class="font-metric text-[10px] text-emerald-700 font-semibold">Promedio vs Diésel</span>
                </div>
                <div class="w-px h-10 bg-slate-200"></div>
                <div>
                    <span class="font-metric text-[10px] text-slate-500 uppercase block">TCO Operativo</span>
                    <span class="font-metric text-2xl font-bold text-[#051125] block">4.2 Años</span>
                    <span class="font-metric text-[10px] text-blue-700 font-semibold">Retorno de Inversión EV</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Articles Section -->
<section class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 py-12 font-body">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Article 1: Electromovilidad 2026 -->
        <article class="bg-white rounded-2xl shadow-md overflow-hidden border border-slate-200 flex flex-col justify-between group hover:shadow-xl transition-all duration-300">
            <div>
                <div class="relative w-full h-52 bg-slate-100 overflow-hidden">
                    <img src="{{ asset('images/catalog/ev-charging-peru.jpg') }}" alt="Carga de vehículos comerciales eléctricos" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-0.5 rounded bg-[#051125] text-[#ffdea6] font-metric text-xs font-bold">ELECTROMOVILIDAD</span>
                    </div>
                </div>
                <div class="p-6 space-y-2.5">
                    <div class="flex items-center gap-3 font-metric text-[11px] text-slate-400">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">schedule</span> 6 min lectura</span>
                        <span>•</span>
                        <span>{{ date('F Y') }}</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-[#051125] group-hover:text-blue-700 transition-colors leading-snug">
                        Electromovilidad en el Perú: Por qué el {{ date('Y') }} es el año ideal para renovar tu flota
                    </h3>
                    <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                        Evaluación integral de costos energéticos, estaciones de carga rápida CCS2 y depreciación acelerada de hasta 50% según el régimen tributario nacional.
                    </p>
                </div>
            </div>
            <div class="p-6 pt-0 border-t border-slate-100 mt-4 flex items-center justify-between">
                <a href="https://wa.me/{{ $whatsappClean }}?text=Deseo%20el%20informe%20completo%20de%20flotas%20electricas%202026" target="_blank" class="font-metric text-xs font-bold text-blue-700 hover:text-blue-900 flex items-center gap-1">
                    <span>Solicitar Informe PDF</span>
                    <span class="material-symbols-outlined text-[16px]">download</span>
                </a>
                <span class="font-metric text-[10px] text-slate-400">Ingeniería RODO</span>
            </div>
        </article>

        <!-- Article 2: Semirremolques Facchini en Rutas Peruanas -->
        <article class="bg-white rounded-2xl shadow-md overflow-hidden border border-slate-200 flex flex-col justify-between group hover:shadow-xl transition-all duration-300">
            <div>
                <div class="relative w-full h-52 bg-slate-100 overflow-hidden">
                    <img src="{{ asset('images/catalog/andes-heavy-haul.jpg') }}" alt="Semirremolque Facchini en carretera andina" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-0.5 rounded bg-[#ffdea6] text-[#271900] font-metric text-xs font-bold">IMPLEMENTOS PESADOS</span>
                    </div>
                </div>
                <div class="p-6 space-y-2.5">
                    <div class="flex items-center gap-3 font-metric text-[11px] text-slate-400">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">schedule</span> 8 min lectura</span>
                        <span>•</span>
                        <span>{{ date('F Y') }}</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-[#051125] group-hover:text-blue-700 transition-colors leading-snug">
                        Claves técnicas para elegir el semirremolque ideal según la ruta y la carga en el Perú
                    </h3>
                    <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                        Diferencias de rendimiento entre acero Hardox 450 y estructural tradicional en tolvas mineras, tipos de suspensión y compatibilidad con tractoras 6x4.
                    </p>
                </div>
            </div>
            <div class="p-6 pt-0 border-t border-slate-100 mt-4 flex items-center justify-between">
                <a href="https://wa.me/{{ $whatsappClean }}?text=Deseo%20la%20guia%20tecnica%20de%20semirremolques%20Facchini" target="_blank" class="font-metric text-xs font-bold text-blue-700 hover:text-blue-900 flex items-center gap-1">
                    <span>Solicitar Guía Técnica</span>
                    <span class="material-symbols-outlined text-[16px]">download</span>
                </a>
                <span class="font-metric text-[10px] text-slate-400">Ingeniería Facchini</span>
            </div>
        </article>

        <!-- Article 3: Mantenimiento y Baterías LFP -->
        <article class="bg-white rounded-2xl shadow-md overflow-hidden border border-slate-200 flex flex-col justify-between group hover:shadow-xl transition-all duration-300">
            <div>
                <div class="relative w-full h-52 bg-slate-100 overflow-hidden">
                    <img src="{{ asset('images/catalog/patio-industrial-ate.jpg') }}" alt="Centro de diagnóstico y telemetría" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-0.5 rounded bg-[#051125] text-[#ffdea6] font-metric text-xs font-bold">TECNOLOGÍA &amp; SERVICIO</span>
                    </div>
                </div>
                <div class="p-6 space-y-2.5">
                    <div class="flex items-center gap-3 font-metric text-[11px] text-slate-400">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">schedule</span> 5 min lectura</span>
                        <span>•</span>
                        <span>{{ date('F Y') }}</span>
                    </div>
                    <h3 class="font-headline text-lg font-bold text-[#051125] group-hover:text-blue-700 transition-colors leading-snug">
                        Baterías LFP y gestión térmica: La ciencia detrás de los 520 km de autonomía
                    </h3>
                    <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                        Cómo la química LiFePO4 de CATL y Blade Cell resisten la altitud en pasos como Ticlio (4,818 msnm) sin degradación prematura de celdas.
                    </p>
                </div>
            </div>
            <div class="p-6 pt-0 border-t border-slate-100 mt-4 flex items-center justify-between">
                <a href="https://wa.me/{{ $whatsappClean }}?text=Deseo%20conocer%20mas%20sobre%20baterias%20LFP%20y%20altitud" target="_blank" class="font-metric text-xs font-bold text-blue-700 hover:text-blue-900 flex items-center gap-1">
                    <span>Consultar a un Ingeniero</span>
                    <span class="material-symbols-outlined text-[16px]">chat</span>
                </a>
                <span class="font-metric text-[10px] text-slate-400">Telemetría RODO</span>
            </div>
        </article>

    </div>
</section>

@endsection
