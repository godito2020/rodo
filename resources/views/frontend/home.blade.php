@extends('layouts.app')

@section('title', 'RODOPERU | Vehículos 100% Eléctricos y Semirremolques Facchini')

@section('meta_description', 'Distribuidor oficial de vehículos comerciales 100% eléctricos JMEV e implementos rodoviarios pesados Facchini en Perú. Cotizaciones en tiempo real y soporte postventa.')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '+51987654321');
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
@endphp

@section('content')

<!-- 1. HERO SECTION CINEMATIC OVERVIEW -->
<section class="relative w-full bg-[#051125] text-white overflow-hidden py-12 lg:py-16" style="background: linear-gradient(135deg, #07153b 0%, #0d2a78 50%, #155dfc 100%);">
    <!-- Ambient Atmospheric Glow -->
    <div class="absolute inset-0 pointer-events-none opacity-40 bg-[radial-gradient(ellipse_80%_60%_at_50%_-20%,rgba(179,146,85,0.35),transparent_70%)]"></div>
    <div class="absolute -right-32 top-1/4 w-96 h-96 rounded-full bg-[#1b263b] blur-3xl opacity-50 pointer-events-none"></div>

    <div class="relative max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12">
        
        <!-- Top Beacon Tag -->
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#1b263b]/80 border border-white/10 shadow-sm mb-6">
            <span class="w-2.5 h-2.5 rounded-full bg-[#ffdea6] pulse-beacon"></span>
            <span class="font-metric text-xs text-[#ffdea6] uppercase tracking-wider font-semibold">RODOPERU · Líderes en Electromovilidad &amp; Carga Pesada</span>
        </div>

        <!-- Main Headline & Subtitle -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-end mb-10">
            <div class="lg:col-span-8 space-y-4">
                <h1 class="font-headline text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-[1.08] text-white">
                    TECNOLOGÍA EN MOVIMIENTO &amp; <br class="hidden sm:inline">
                    <span class="text-[#ffdea6]">POTENCIA DE TRANSPORTE</span>
                </h1>
                <p class="font-body text-base sm:text-lg text-slate-200 max-w-2xl leading-relaxed">
                    Distribución e ingeniería homologada para el Perú. Fusionamos vehículos 100% eléctricos de alta autonomía urbana e interurbana con los legendarios semirremolques, furgones y tolvas reforzadas <strong>FACCHINI</strong>.
                </p>
            </div>
            
            <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3 justify-end">
                <a href="#showroom-ev" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded bg-[#ffdea6] hover:bg-[#fed894] text-[#271900] font-headline text-sm font-bold transition-all duration-200 shadow-md">
                    <span class="material-symbols-outlined text-[20px]">electric_car</span>
                    <span>Explorar Catálogo Eléctrico</span>
                </a>
                <a href="#facchini-heavy" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded bg-[#1b263b] hover:bg-[#1a2737] text-white font-headline text-sm font-semibold transition-all duration-200 border border-white/15 shadow-sm">
                    <span class="material-symbols-outlined text-[20px] text-[#ffdea6]">local_shipping</span>
                    <span>Cotizar Semirremolques Facchini</span>
                </a>
            </div>
        </div>

        <!-- Dual-Stage Tab Selector -->
        <div class="inline-flex p-1.5 rounded-xl bg-[#051125]/90 border border-white/10 shadow-inner mb-8">
            <button type="button" id="tab-ev" onclick="switchHeroStage('ev')" class="px-5 py-2.5 rounded-lg font-headline text-xs sm:text-sm font-semibold transition-all duration-200 bg-[#ffdea6] text-[#271900] shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">bolt</span>
                <span>Vehículos 100% Eléctricos (JMEV &amp; RODO)</span>
            </button>
            <button type="button" id="tab-facchini" onclick="switchHeroStage('facchini')" class="px-5 py-2.5 rounded-lg font-headline text-xs sm:text-sm font-semibold transition-all duration-200 text-slate-300 hover:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">rv_hookup</span>
                <span>Implementos Rodoviarios (Facchini)</span>
            </button>
        </div>

        <!-- STAGE 1: EV Cinematic Bento -->
        <div id="stage-ev" class="transition-opacity duration-300">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Main EV Feature Card -->
                <div class="lg:col-span-8 relative rounded-2xl overflow-hidden bg-[#1b263b] shadow-2xl min-h-[380px] lg:min-h-[440px] flex flex-col justify-end p-6 sm:p-8">
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/catalog/hero-ev-stage.jpg') }}');"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-[#051125] via-[#051125]/60 to-transparent"></div>
                    
                    <div class="relative z-10 max-w-xl space-y-2">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded bg-[#ffdea6] text-[#271900] font-metric text-xs font-bold">
                            NUEVO LANZAMIENTO LIMA 2026
                        </div>
                        <h2 class="font-headline text-2xl sm:text-3xl font-bold text-white">JMEV EV-2 Urban City &amp; RODO EV-600 Grand</h2>
                        <p class="font-body text-xs sm:text-sm text-slate-200">Menos de S/ 0.05 por kilómetro recorrido. Homologación vehicular MTC vigente y centros de servicio autorizados.</p>
                        
                        <div class="pt-3 flex items-center gap-6">
                            <div>
                                <div class="font-metric text-xl sm:text-2xl text-[#ffdea6] font-bold">Hasta 520 km</div>
                                <div class="font-metric text-[11px] text-slate-300 uppercase">Autonomía Ciclo Mixto</div>
                            </div>
                            <div class="w-px h-8 bg-white/20"></div>
                            <div>
                                <div class="font-metric text-xl sm:text-2xl text-[#ffdea6] font-bold">30 min</div>
                                <div class="font-metric text-[11px] text-slate-300 uppercase">Carga Rápida CCS2</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Telemetry Card -->
                <div class="lg:col-span-4 rounded-2xl bg-[#1b263b] p-6 sm:p-8 shadow-2xl flex flex-col justify-between border border-white/10">
                    <div>
                        <div class="flex items-center justify-between pb-3">
                            <span class="font-metric text-xs text-[#ffdea6] uppercase font-bold tracking-wider">EFICIENCIA DE RECORRIDO</span>
                            <span class="material-symbols-outlined text-[#ffdea6] text-[20px]">insights</span>
                        </div>
                        <h3 class="font-headline text-lg font-bold text-white mb-2">Cero emisiones. Reducción directa del 75% en TCO.</h3>
                        <p class="font-body text-xs text-slate-300 leading-relaxed">Estructura celular con baterías LFP de alta estabilidad térmica diseñada para resistir variaciones altimétricas en el Perú.</p>
                    </div>

                    <!-- Mini Sparkline Telemetry Display -->
                    <div class="my-6 p-4 rounded-xl bg-[#051125] border border-white/10">
                        <div class="flex justify-between font-metric text-xs text-slate-300 mb-1">
                            <span>Rango Térmico Batería</span>
                            <span class="text-[#ffdea6] font-bold">24°C Estable</span>
                        </div>
                        <svg class="w-full h-10 text-[#ffdea6]" fill="none" stroke="currentColor" viewBox="0 0 200 40">
                            <path d="M0,25 Q30,15 60,22 T120,18 T160,20 L200,14" stroke-linecap="round" stroke-width="2.5"></path>
                            <circle class="fill-[#ffdea6]" cx="200" cy="14" r="3.5"></circle>
                        </svg>
                    </div>

                    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20ficha%20tecnica%20de%20flotas%20electricas" target="_blank" class="w-full py-3 rounded-lg bg-[#ffdea6] hover:bg-[#fed894] text-[#271900] font-headline text-xs sm:text-sm font-bold flex items-center justify-center gap-2 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">chat</span>
                        <span>Solicitar Ficha Técnica EV</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- STAGE 2: Facchini Cinematic Bento (Toggled via JS) -->
        <div id="stage-facchini" class="hidden transition-opacity duration-300">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Main Facchini Feature Card -->
                <div class="lg:col-span-8 relative rounded-2xl overflow-hidden bg-[#1b263b] shadow-2xl min-h-[380px] lg:min-h-[440px] flex flex-col justify-end p-6 sm:p-8">
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/catalog/hero-facchini-stage.jpg') }}');"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-[#051125] via-[#051125]/65 to-transparent"></div>
                    
                    <div class="relative z-10 max-w-xl space-y-2">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded bg-[#ffdea6] text-[#271900] font-metric text-xs font-bold">
                            76 AÑOS DE LIDERAZGO REGIONAL
                        </div>
                        <h2 class="font-headline text-2xl sm:text-3xl font-bold text-white">Semirremolques, Furgones &amp; Tolvas Mineras</h2>
                        <p class="font-body text-xs sm:text-sm text-slate-200">Estructuras en Acero Estructural Hardox 450 y suspensión neumática o mecánica reforzada para el corredor minero y transporte interprovincial.</p>
                        
                        <div class="pt-3 flex items-center gap-6">
                            <div>
                                <div class="font-metric text-xl sm:text-2xl text-[#ffdea6] font-bold">Hasta 35 Ton</div>
                                <div class="font-metric text-[11px] text-slate-300 uppercase">Carga Útil Efectiva</div>
                            </div>
                            <div class="w-px h-8 bg-white/20"></div>
                            <div>
                                <div class="font-metric text-xl sm:text-2xl text-[#ffdea6] font-bold">100% Facchini</div>
                                <div class="font-metric text-[11px] text-slate-300 uppercase">Garantía de Fábrica</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Facchini Engineering Spec Card -->
                <div class="lg:col-span-4 rounded-2xl bg-[#1b263b] p-6 sm:p-8 shadow-2xl flex flex-col justify-between border border-white/10">
                    <div>
                        <div class="flex items-center justify-between pb-3">
                            <span class="font-metric text-xs text-[#ffdea6] uppercase font-bold tracking-wider">INGENIERÍA PARA EL PERÚ</span>
                            <span class="material-symbols-outlined text-[#ffdea6] text-[20px]">precision_manufacturing</span>
                        </div>
                        <h3 class="font-headline text-lg font-bold text-white mb-2">Configuraciones homologadas para MTC.</h3>
                        <p class="font-body text-xs text-slate-300 leading-relaxed">Modelos furgón 3 ejes con volumen de hasta 105 m³, tolvas media caña de volteo rápido y plataformas portacontenedor de alta resistencia a la torsión.</p>
                    </div>

                    <div class="my-6 p-4 rounded-xl bg-[#051125] border border-white/10 space-y-2">
                        <div class="flex items-center justify-between font-metric text-xs text-slate-300">
                            <span>Certificación de Soldadura</span>
                            <span class="text-[#ffdea6] font-bold">AWS D1.1</span>
                        </div>
                        <div class="w-full bg-slate-800 rounded-full h-2 overflow-hidden">
                            <div class="bg-[#ffdea6] h-full rounded-full" style="width: 100%"></div>
                        </div>
                        <div class="flex justify-between font-metric text-[11px] text-slate-400">
                            <span>Normas ISO 9001 / 14001</span>
                            <span>Calidad Comprobada</span>
                        </div>
                    </div>

                    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20cotizar%20unidades%20Facchini" target="_blank" class="w-full py-3 rounded-lg bg-[#ffdea6] hover:bg-[#fed894] text-[#271900] font-headline text-xs sm:text-sm font-bold flex items-center justify-center gap-2 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                        <span>Cotizar Unidades Facchini</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Metrics Strip -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 pt-10">
            <div class="p-4 rounded-xl bg-[#1b263b]/80 border border-white/10 shadow-sm flex items-start gap-3">
                <span class="material-symbols-outlined text-[#ffdea6] text-[28px] shrink-0">energy_savings_leaf</span>
                <div>
                    <div class="font-metric text-xl text-[#ffdea6] font-bold leading-tight">75% Ahorro</div>
                    <div class="font-body text-xs text-slate-300">Reducción costo por km EV</div>
                </div>
            </div>
            <div class="p-4 rounded-xl bg-[#1b263b]/80 border border-white/10 shadow-sm flex items-start gap-3">
                <span class="material-symbols-outlined text-[#ffdea6] text-[28px] shrink-0">verified</span>
                <div>
                    <div class="font-metric text-xl text-[#ffdea6] font-bold leading-tight">76 Años</div>
                    <div class="font-body text-xs text-slate-300">Facchini en transporte rodoviario</div>
                </div>
            </div>
            <div class="p-4 rounded-xl bg-[#1b263b]/80 border border-white/10 shadow-sm flex items-start gap-3">
                <span class="material-symbols-outlined text-[#ffdea6] text-[28px] shrink-0">speed</span>
                <div>
                    <div class="font-metric text-xl text-[#ffdea6] font-bold leading-tight">520 km</div>
                    <div class="font-body text-xs text-slate-300">Autonomía ciclo mixto RODO</div>
                </div>
            </div>
            <div class="p-4 rounded-xl bg-[#1b263b]/80 border border-white/10 shadow-sm flex items-start gap-3">
                <span class="material-symbols-outlined text-[#ffdea6] text-[28px] shrink-0">build</span>
                <div>
                    <div class="font-metric text-xl text-[#ffdea6] font-bold leading-tight">100% MTC</div>
                    <div class="font-body text-xs text-slate-300">Homologación y repuestos Lima</div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- 2. SHOWROOM ELECTROMOVILIDAD -->
<section class="w-full bg-[#f9faf5] py-16" id="showroom-ev">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-1.5 font-metric text-xs text-[#765a23] uppercase font-bold">
                    <span class="material-symbols-outlined text-[16px]">ev_station</span>
                    <span>ELECTROMOVILIDAD PURA</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl font-bold text-[#051125]">MOVILIDAD URBANA &amp; SOSTENIBLE</h2>
                <p class="font-body text-sm text-slate-600 max-w-xl">
                    Eficiencia, autonomía y tecnología cero emisiones para empresas, flotas de reparto y conductores exigentes.
                </p>
            </div>
            <a href="{{ route('products.index', ['categoria' => 'vehiculos-electricos']) }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-lg bg-slate-200 hover:bg-slate-300 text-[#051125] font-headline text-xs uppercase font-semibold transition-colors">
                <span>Ver catálogo completo EV</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>

        <!-- Spotlight Featured Card: JMEV EV-2 -->
        <div class="rounded-2xl bg-white shadow-xl overflow-hidden p-6 sm:p-10 mb-10 border border-slate-100">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- Left: Info & Specs -->
                <div class="lg:col-span-6 space-y-5">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="px-2.5 py-1 rounded bg-[#ffdea6] text-[#271900] font-metric text-xs font-bold">DESTACADO URBANO</span>
                        <span class="px-2.5 py-1 rounded bg-slate-100 text-slate-700 font-metric text-xs">SKU: JMEV-EV2</span>
                    </div>

                    <div>
                        <h3 class="font-headline text-2xl sm:text-3xl font-bold text-[#051125]">JMEV EV-2 Urban City Car</h3>
                        <p class="font-body text-sm text-slate-600 mt-2 leading-relaxed">
                            Diseñado para circular con máxima agilidad en Lima y ciudades metropolitanas. Batería de fosfato de hierro y litio (LFP), dirección electroasistida, frenado regenerativo y conector doméstico estándar más carga rápida CCS2.
                        </p>
                    </div>

                    <!-- 3 Specs Badges -->
                    <div class="grid grid-cols-3 gap-3 p-4 rounded-xl bg-slate-50 border border-slate-100 text-center">
                        <div>
                            <div class="font-metric text-lg sm:text-xl text-[#051125] font-bold">302 km</div>
                            <div class="font-metric text-[10px] text-slate-500 uppercase">Autonomía</div>
                        </div>
                        <div>
                            <div class="font-metric text-lg sm:text-xl text-[#051125] font-bold">31.9 kWh</div>
                            <div class="font-metric text-[10px] text-slate-500 uppercase">Batería LFP</div>
                        </div>
                        <div>
                            <div class="font-metric text-lg sm:text-xl text-[#051125] font-bold">6-10 h</div>
                            <div class="font-metric text-[10px] text-slate-500 uppercase">Carga 220V</div>
                        </div>
                    </div>

                    <!-- Actions & Pricing -->
                    <div class="pt-2 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="space-y-0.5">
                            <span class="font-metric text-xs text-emerald-700 font-semibold block flex items-center gap-1">
                                <span class="material-symbols-outlined text-[18px]">verified</span> Stock para Entrega Inmediata
                            </span>
                            <span class="font-metric text-xl font-bold text-[#051125]">{{ $currency }} 17,990.00</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="button" onclick="openSpecModalData('JMEV-EV2', 'JMEV EV-2 Urban City Car', 'Hatchback compacto 100% eléctrico diseñado para movilidad urbana de máxima eficiencia energética.', [ ['Autonomía', '302 km (CLTC)'], ['Batería', '31.9 kWh LFP'], ['Carga AC', '6 - 10 Horas (220V)'], ['Carga Rápida DC', '30-80% en 35 min CCS2'], ['Motor', '35 kW (48 HP) / 125 Nm'], ['Costo/km', 'Menos de S/ 0.05 / km'] ])" class="px-4 py-3 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-800 font-headline text-xs font-semibold">
                                Ficha Técnica
                            </button>
                            <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20cotizar%20el%20JMEV%20EV-2" target="_blank" class="px-5 py-3 rounded-lg bg-[#25D366] hover:bg-[#20bd5a] text-white font-headline text-xs font-bold flex items-center gap-1.5 shadow-sm">
                                <i class="fab fa-whatsapp text-sm"></i>
                                <span>Cotizar por WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right: Studio Visual & Color Switcher -->
                <div class="lg:col-span-6 flex flex-col items-center">
                    <div class="relative w-full aspect-[4/3] max-w-md flex items-center justify-center p-4">
                        <img id="ev2-car-preview" src="{{ asset('images/catalog/jmev-ev2.png') }}" alt="JMEV EV-2 Urban City Car" class="w-full h-auto object-contain transition-all duration-300 drop-shadow-[0_15px_30px_rgba(0,0,0,0.15)]">
                    </div>
                    
                    <!-- Color Swatches -->
                    <div class="flex items-center gap-4 mt-2 p-2 rounded-full bg-slate-100 px-5 shadow-inner">
                        <span class="font-metric text-[11px] uppercase text-slate-500 font-semibold">Color:</span>
                        <button type="button" onclick="setEv2Color('#52c2cf')" class="w-6 h-6 rounded-full bg-[#52c2cf] shadow-sm hover:scale-110 transition-transform ring-2 ring-blue-700" title="Turquesa Aurora"></button>
                        <button type="button" onclick="setEv2Color('#8bc34a')" class="w-6 h-6 rounded-full bg-[#8bc34a] shadow-sm hover:scale-110 transition-transform" title="Verde Lima"></button>
                        <button type="button" onclick="setEv2Color('#ffffff')" class="w-6 h-6 rounded-full bg-[#ffffff] shadow-sm hover:scale-110 transition-transform border border-slate-300" title="Blanco Glaciar"></button>
                        <button type="button" onclick="setEv2Color('#9e9e9e')" class="w-6 h-6 rounded-full bg-[#9e9e9e] shadow-sm hover:scale-110 transition-transform" title="Gris Mercurio"></button>
                    </div>
                </div>

            </div>
        </div>

        <!-- 3-Card EV Commercial Mosaic -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- EV Card 1: RODO EV-600 Grand SUV -->
            <div class="rounded-2xl bg-white shadow-md overflow-hidden flex flex-col justify-between group hover:shadow-xl transition-all duration-300 border border-slate-100">
                <div>
                    <div class="relative w-full h-52 bg-slate-100 overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('{{ asset('images/catalog/rodo-ev600.jpg') }}');"></div>
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-0.5 rounded bg-[#051125] text-white font-metric text-xs font-semibold">SUV EJECUTIVO</span>
                        </div>
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="font-metric text-xs text-slate-500 uppercase">RODO Electric · SKU: RODO-EV600</div>
                        <h4 class="font-headline text-xl font-bold text-[#051125]">RODO EV-600 Grand SUV</h4>
                        <p class="font-body text-xs text-slate-600 line-clamp-2">
                            Conducción asistida Nivel 2.5, tracción AWD, asientos de cuero ventilados y batería Blade Cell de ultra-seguridad.
                        </p>
                        
                        <div class="grid grid-cols-2 gap-2 p-2.5 rounded-lg bg-slate-50 text-center font-metric">
                            <div>
                                <span class="text-sm text-[#051125] font-bold">520 km</span>
                                <span class="block text-[10px] text-slate-500 uppercase">Rango Mixto</span>
                            </div>
                            <div>
                                <span class="text-sm text-[#051125] font-bold">86.4 kWh</span>
                                <span class="block text-[10px] text-slate-500 uppercase">Batería LFP</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 pt-0 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="font-metric text-lg font-bold text-[#051125]">{{ $currency }} 45,900.00</span>
                        <span class="font-metric text-xs text-emerald-700 font-semibold">Entrega 24h</span>
                    </div>
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20cotizar%20RODO%20EV-600%20Grand%20SUV" target="_blank" class="w-full py-2.5 rounded-lg bg-[#25D366] hover:bg-[#20bd5a] text-white font-headline text-xs font-bold flex items-center justify-center gap-1.5 transition-colors">
                        <i class="fab fa-whatsapp text-sm"></i>
                        <span>Cotizar por WhatsApp</span>
                    </a>
                </div>
            </div>

            <!-- EV Card 2: Cargo E-Van 1.5T -->
            <div class="rounded-2xl bg-white shadow-md overflow-hidden flex flex-col justify-between group hover:shadow-xl transition-all duration-300 border border-slate-100">
                <div>
                    <div class="relative w-full h-52 bg-slate-100 overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('{{ asset('images/catalog/rodo-evan15.jpg') }}');"></div>
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-0.5 rounded bg-[#051125] text-white font-metric text-xs font-semibold">LOGÍSTICA URBANA</span>
                        </div>
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="font-metric text-xs text-slate-500 uppercase">RODO Electric · SKU: RODO-EVAN15</div>
                        <h4 class="font-headline text-xl font-bold text-[#051125]">RODO Cargo E-Van 1.5T</h4>
                        <p class="font-body text-xs text-slate-600 line-clamp-2">
                            La solución ideal para distribución última milla. Doble puerta lateral corrediza, piso con textura antideslizante y conector industrial.
                        </p>
                        
                        <div class="grid grid-cols-2 gap-2 p-2.5 rounded-lg bg-slate-50 text-center font-metric">
                            <div>
                                <span class="text-sm text-[#051125] font-bold">280 km</span>
                                <span class="block text-[10px] text-slate-500 uppercase">Autonomía Carga</span>
                            </div>
                            <div>
                                <span class="text-sm text-[#051125] font-bold">6.8 m³</span>
                                <span class="block text-[10px] text-slate-500 uppercase">Volumen Útil</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 pt-0 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="font-metric text-lg font-bold text-[#051125]">{{ $currency }} 29,800.00</span>
                        <span class="font-metric text-xs text-blue-700 font-semibold">Flotas Leasing</span>
                    </div>
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20cotizar%20E-Van%201.5T" target="_blank" class="w-full py-2.5 rounded-lg bg-[#25D366] hover:bg-[#20bd5a] text-white font-headline text-xs font-bold flex items-center justify-center gap-1.5 transition-colors">
                        <i class="fab fa-whatsapp text-sm"></i>
                        <span>Cotizar por WhatsApp</span>
                    </a>
                </div>
            </div>

            <!-- EV Card 3: RODO E-Truck 4.5T -->
            <div class="rounded-2xl bg-white shadow-md overflow-hidden flex flex-col justify-between group hover:shadow-xl transition-all duration-300 border border-slate-100">
                <div>
                    <div class="relative w-full h-52 bg-slate-100 overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('{{ asset('images/catalog/rodo-etruck.jpg') }}');"></div>
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-0.5 rounded bg-[#051125] text-white font-metric text-xs font-semibold">CARGA MEDIANA</span>
                        </div>
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="font-metric text-xs text-slate-500 uppercase">BYD Commercial · SKU: RODO-ET45</div>
                        <h4 class="font-headline text-xl font-bold text-[#051125]">Camión Ligero RODO E-Truck 4.5T</h4>
                        <p class="font-body text-xs text-slate-600 line-clamp-2">
                            Chasis cabinado versátil para furgón seco, baranda o unidad refrigerada. Cero restricciones ambientales para circulación metropolitana.
                        </p>
                        
                        <div class="grid grid-cols-2 gap-2 p-2.5 rounded-lg bg-slate-50 text-center font-metric">
                            <div>
                                <span class="text-sm text-[#051125] font-bold">220 km</span>
                                <span class="block text-[10px] text-slate-500 uppercase">Con Plena Carga</span>
                            </div>
                            <div>
                                <span class="text-sm text-[#051125] font-bold">7,500 kg</span>
                                <span class="block text-[10px] text-slate-500 uppercase">PBV Técnico</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 pt-0 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="font-metric text-xs text-slate-600 font-semibold uppercase">Cotización a Medida</span>
                        <span class="font-metric text-xs text-emerald-700 font-semibold">Chasis Homologado</span>
                    </div>
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20cotizar%20Camion%20Ligero%20E-Truck%204.5T" target="_blank" class="w-full py-2.5 rounded-lg bg-[#25D366] hover:bg-[#20bd5a] text-white font-headline text-xs font-bold flex items-center justify-center gap-1.5 transition-colors">
                        <i class="fab fa-whatsapp text-sm"></i>
                        <span>Cotizar por WhatsApp</span>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- 3. SIMULADOR INTERACTIVO DE AHORRO TCO & ROI FLOTAS -->
<section class="w-full text-white py-16 relative overflow-hidden" id="simulador" style="background: linear-gradient(135deg, #07153b 0%, #0d2a78 60%, #155dfc 100%);">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Left: Impact Explanation -->
            <div class="lg:col-span-5 space-y-4">
                <div class="inline-flex items-center gap-2 font-metric text-xs text-[#ffdea6] uppercase font-bold">
                    <span class="material-symbols-outlined text-[18px]">calculate</span>
                    <span>SIMULADOR DE IMPACTO ECONÓMICO</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl font-bold text-white leading-tight">
                    Calcula el Retorno de Inversión de tu Flota
                </h2>
                <p class="font-body text-sm text-slate-200 leading-relaxed">
                    El costo de energía por kilómetro en Perú equivale a menos de una cuarta parte de lo que pagas en diésel o gasolina. Simula el recorrido promedio diario y comprueba el retorno de inversión inmediato.
                </p>

                <div class="space-y-3 pt-2 font-body text-xs sm:text-sm text-slate-200">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 rounded-full bg-[#1b263b] flex items-center justify-center text-[#ffdea6] shrink-0">
                            <span class="material-symbols-outlined text-[16px]">check</span>
                        </span>
                        <span><strong class="text-[#ffdea6]">Cero consumo</strong> de combustible fósil ni cambios periódicos de aceite.</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 rounded-full bg-[#1b263b] flex items-center justify-center text-[#ffdea6] shrink-0">
                            <span class="material-symbols-outlined text-[16px]">check</span>
                        </span>
                        <span><strong class="text-[#ffdea6]">70% de reducción</strong> directa en costos de mantenimiento preventivo.</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 rounded-full bg-[#1b263b] flex items-center justify-center text-[#ffdea6] shrink-0">
                            <span class="material-symbols-outlined text-[16px]">check</span>
                        </span>
                        <span><strong class="text-[#ffdea6]">Beneficios tributarios</strong> por depreciación acelerada en la Ley N° 31696.</span>
                    </div>
                </div>
            </div>

            <!-- Right: Interactive Tool Console -->
            <div class="lg:col-span-7 rounded-2xl bg-[#051125] p-6 sm:p-8 shadow-2xl border border-white/15 space-y-6">
                <!-- Slider Control -->
                <div>
                    <div class="flex justify-between items-center mb-3">
                        <label for="km-range" class="font-metric text-xs uppercase text-slate-300 font-semibold">
                            Recorrido Promedio Diario por Unidad
                        </label>
                        <div class="px-4 py-1.5 rounded-lg bg-[#1b263b] font-metric text-lg text-[#ffdea6] font-bold border border-white/10">
                            <span id="km-value-display">80</span> km/día
                        </div>
                    </div>
                    <input type="range" id="km-range" min="30" max="300" step="10" value="80" oninput="calculateSavings(this.value)" class="w-full h-2.5 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-[#ffdea6]">
                    <div class="flex justify-between font-metric text-[11px] text-slate-400 mt-2">
                        <span>30 km (Uso Urbano Local)</span>
                        <span>150 km (Reparto Intensivo)</span>
                        <span>300 km (Flota Interurbana)</span>
                    </div>
                </div>

                <!-- Cost Comparison Columns -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-5 rounded-xl bg-[#1b263b] border border-white/10">
                        <span class="font-metric text-[11px] text-slate-400 uppercase block mb-1">Gasto Anual Combustible Fósil</span>
                        <div class="font-metric text-2xl font-bold text-white" id="cost-fossil">
                            USD $3,840
                        </div>
                        <span class="font-body text-[11px] text-slate-400">Cálculo diésel / gasolina 95 comercial</span>
                    </div>

                    <div class="p-5 rounded-xl bg-[#07153b] border border-[#ffdea6]/30">
                        <span class="font-metric text-[11px] text-[#ffdea6] uppercase block mb-1">Gasto Anual Eléctrico RODO</span>
                        <div class="font-metric text-2xl font-bold text-[#ffdea6]" id="cost-electric">
                            USD $890
                        </div>
                        <span class="font-body text-[11px] text-slate-300">Tarifa eléctrica regulada comercial</span>
                    </div>
                </div>

                <!-- Net Result Banner -->
                <div class="p-5 rounded-xl bg-[#ffdea6] text-[#271900] shadow-lg flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div>
                        <span class="font-metric text-xs uppercase text-[#271900]/80 font-bold block">Ahorro Neto Anual Estimado:</span>
                        <div class="font-headline text-2xl font-bold text-[#271900]" id="annual-savings">
                            USD $2,950 / año
                        </div>
                        <div class="font-body text-xs font-semibold text-[#271900]/90" id="annual-soles">
                            ¡Equivalente a aprox. S/ 11,000 Soles de ahorro directo por unidad!
                        </div>
                    </div>
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20evaluar%20ahorro%20de%20flota%20para%2080%20km%20al%20dia" id="calc-cta" target="_blank" class="px-5 py-3 rounded-lg bg-[#051125] hover:bg-[#1b263b] text-white font-headline text-xs font-bold shrink-0 transition-colors shadow-sm">
                        Validar Flota en WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 4. IMPLEMENTOS RODOVIARIOS FACCHINI SECTION -->
<section class="w-full bg-[#f3f4f0] py-16" id="facchini-heavy">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12">
        
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-1.5 font-metric text-xs text-[#765a23] uppercase font-bold">
                    <span class="material-symbols-outlined text-[16px]">hardware</span>
                    <span>INGENIERÍA PESADA FACCHINI BRASIL</span>
                </div>
                <h2 class="font-headline text-3xl sm:text-4xl font-bold text-[#051125]">POTENCIA &amp; CARGA PESADA FACCHINI</h2>
                <p class="font-body text-sm text-slate-600 max-w-2xl">
                    Estructuras reforzadas en acero de alta resistencia para minería, logística portuaria y transporte nacional sobre las geografías más exigentes del Perú.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 rounded bg-[#ffdea6] text-[#271900] font-metric text-xs font-bold">76 AÑOS DE EXPERIENCIA</span>
                <a href="{{ route('products.index', ['categoria' => 'implementos-rodoviarios']) }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-lg bg-[#051125] hover:bg-[#1b263b] text-white font-headline text-xs uppercase font-semibold transition-colors">
                    <span>Catálogo Facchini</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>
        </div>

        <!-- Facchini 4-Card Heavy Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Facchini Card 1: Furgon 3 Ejes -->
            <div class="rounded-2xl bg-white shadow-md overflow-hidden flex flex-col justify-between group hover:shadow-xl transition-all duration-300 border border-slate-200">
                <div>
                    <div class="relative w-full h-48 bg-slate-100 overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('{{ asset('images/catalog/facchini-furgon.jpg') }}');"></div>
                        <div class="absolute top-2.5 left-2.5">
                            <span class="px-2.5 py-0.5 rounded bg-[#ffdea6] text-[#271900] font-metric text-xs font-bold">ENTREGA INMEDIATA</span>
                        </div>
                    </div>
                    <div class="p-5 space-y-2.5">
                        <span class="font-metric text-[11px] text-slate-500 uppercase block">Facchini Rodoviários · SKU: FAC-FURGON3E</span>
                        <h3 class="font-headline text-lg font-bold text-[#051125]">Semirremolque Furgón Carga Seca 3 Ejes</h3>
                        <p class="font-body text-xs text-slate-600 line-clamp-2">
                            Paredes laterales en paneles corrugados de alta rigidez estructural y piso antideslizante de madera de ley tratada 28 mm.
                        </p>
                        
                        <div class="space-y-1 font-metric text-xs pt-1">
                            <div class="flex justify-between py-1 px-2 rounded bg-slate-50 border border-slate-100">
                                <span class="text-slate-500">Longitud:</span>
                                <span class="font-bold text-[#051125]">14,600 mm (48/53 ft)</span>
                            </div>
                            <div class="flex justify-between py-1 px-2 rounded bg-slate-50 border border-slate-100">
                                <span class="text-slate-500">Volumen:</span>
                                <span class="font-bold text-[#051125]">105 m³ de Carga</span>
                            </div>
                            <div class="flex justify-between py-1 px-2 rounded bg-slate-50 border border-slate-100">
                                <span class="text-slate-500">Suspensión:</span>
                                <span class="font-bold text-[#051125]">Neumática Integrada</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-5 pt-0 space-y-2.5">
                    <div class="flex items-center justify-between">
                        <span class="font-metric text-base font-bold text-[#051125]">{{ $currency }} 38,500.00</span>
                        <span class="font-metric text-xs text-emerald-700 font-semibold">Stock en Lima</span>
                    </div>
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20cotizar%20Semirremolque%20Furgon%20Facchini%203%20Ejes" target="_blank" class="w-full py-2.5 rounded-lg bg-[#25D366] hover:bg-[#20bd5a] text-white font-headline text-xs font-bold flex items-center justify-center gap-1.5 transition-colors">
                        <i class="fab fa-whatsapp text-sm"></i>
                        <span>Cotizar por WhatsApp</span>
                    </a>
                </div>
            </div>

            <!-- Facchini Card 2: Tolva Media Caña 35m³ -->
            <div class="rounded-2xl bg-white shadow-md overflow-hidden flex flex-col justify-between group hover:shadow-xl transition-all duration-300 border border-slate-200">
                <div>
                    <div class="relative w-full h-48 bg-slate-100 overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('{{ asset('images/catalog/facchini-tolva.jpg') }}');"></div>
                        <div class="absolute top-2.5 left-2.5">
                            <span class="px-2.5 py-0.5 rounded bg-[#ffdea6] text-[#271900] font-metric text-xs font-bold">MINERÍA PESADA</span>
                        </div>
                    </div>
                    <div class="p-5 space-y-2.5">
                        <span class="font-metric text-[11px] text-slate-500 uppercase block">Facchini Rodoviários · SKU: FAC-TOLVA35M</span>
                        <h3 class="font-headline text-lg font-bold text-[#051125]">Tolva Basculante Media Caña 35m³</h3>
                        <p class="font-body text-xs text-slate-600 line-clamp-2">
                            Cilindro telescópico frontal de 5 etapas, compuerta trasera basculante automática y chasis aligerado de alta torsión.
                        </p>
                        
                        <div class="space-y-1 font-metric text-xs pt-1">
                            <div class="flex justify-between py-1 px-2 rounded bg-slate-50 border border-slate-100">
                                <span class="text-slate-500">Material:</span>
                                <span class="font-bold text-[#051125]">Acero HARDOX 450</span>
                            </div>
                            <div class="flex justify-between py-1 px-2 rounded bg-slate-50 border border-slate-100">
                                <span class="text-slate-500">Capacidad:</span>
                                <span class="font-bold text-[#051125]">35 Metros Cúbicos</span>
                            </div>
                            <div class="flex justify-between py-1 px-2 rounded bg-slate-50 border border-slate-100">
                                <span class="text-slate-500">Cilindro:</span>
                                <span class="font-bold text-[#051125]">Hyva / Facchini HD</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-5 pt-0 space-y-2.5">
                    <div class="flex items-center justify-between">
                        <span class="font-metric text-base font-bold text-[#051125]">{{ $currency }} 46,000.00</span>
                        <span class="font-metric text-xs text-emerald-700 font-semibold">Patio de Entrega</span>
                    </div>
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20cotizar%20Tolva%20Media%20Caña%2035m3%20Facchini" target="_blank" class="w-full py-2.5 rounded-lg bg-[#25D366] hover:bg-[#20bd5a] text-white font-headline text-xs font-bold flex items-center justify-center gap-1.5 transition-colors">
                        <i class="fab fa-whatsapp text-sm"></i>
                        <span>Cotizar por WhatsApp</span>
                    </a>
                </div>
            </div>

            <!-- Facchini Card 3: Plataforma Multimodal 13.5m -->
            <div class="rounded-2xl bg-white shadow-md overflow-hidden flex flex-col justify-between group hover:shadow-xl transition-all duration-300 border border-slate-200">
                <div>
                    <div class="relative w-full h-48 bg-slate-100 overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('{{ asset('images/catalog/facchini-plataforma.jpg') }}');"></div>
                        <div class="absolute top-2.5 left-2.5">
                            <span class="px-2.5 py-0.5 rounded bg-[#ffdea6] text-[#271900] font-metric text-xs font-bold">PUERTOS &amp; CARGA</span>
                        </div>
                    </div>
                    <div class="p-5 space-y-2.5">
                        <span class="font-metric text-[11px] text-slate-500 uppercase block">Facchini Rodoviários · SKU: FAC-PLATAFORMA</span>
                        <h3 class="font-headline text-lg font-bold text-[#051125]">Plataforma Multimodal Porta Contenedor</h3>
                        <p class="font-body text-xs text-slate-600 line-clamp-2">
                            Chasis de viga I en acero de alta resistencia. Apta para transportar 1 contenedor de 40 pies o 2 de 20 pies simultáneos.
                        </p>
                        
                        <div class="space-y-1 font-metric text-xs pt-1">
                            <div class="flex justify-between py-1 px-2 rounded bg-slate-50 border border-slate-100">
                                <span class="text-slate-500">Longitud:</span>
                                <span class="font-bold text-[#051125]">13,500 mm (44.3 ft)</span>
                            </div>
                            <div class="flex justify-between py-1 px-2 rounded bg-slate-50 border border-slate-100">
                                <span class="text-slate-500">Twist Locks:</span>
                                <span class="font-bold text-[#051125]">12 Retráctiles Reforzados</span>
                            </div>
                            <div class="flex justify-between py-1 px-2 rounded bg-slate-50 border border-slate-100">
                                <span class="text-slate-500">Carga:</span>
                                <span class="font-bold text-[#051125]">1x40HQ o 2x20</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-5 pt-0 space-y-2.5">
                    <div class="flex items-center justify-between">
                        <span class="font-metric text-base font-bold text-[#051125]">{{ $currency }} 28,500.00</span>
                        <span class="font-metric text-xs text-blue-700 font-semibold">Lista para Rodar</span>
                    </div>
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20cotizar%20Plataforma%20Portacontenedor%20Facchini" target="_blank" class="w-full py-2.5 rounded-lg bg-[#25D366] hover:bg-[#20bd5a] text-white font-headline text-xs font-bold flex items-center justify-center gap-1.5 transition-colors">
                        <i class="fab fa-whatsapp text-sm"></i>
                        <span>Cotizar por WhatsApp</span>
                    </a>
                </div>
            </div>

            <!-- Facchini Card 4: Cisterna Combustible 10,000 Gal -->
            <div class="rounded-2xl bg-white shadow-md overflow-hidden flex flex-col justify-between group hover:shadow-xl transition-all duration-300 border border-slate-200">
                <div>
                    <div class="relative w-full h-48 bg-slate-100 overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('{{ asset('images/catalog/facchini-cisterna.jpg') }}');"></div>
                        <div class="absolute top-2.5 left-2.5">
                            <span class="px-2.5 py-0.5 rounded bg-[#ffdea6] text-[#271900] font-metric text-xs font-bold">HIDROCARBUROS</span>
                        </div>
                    </div>
                    <div class="p-5 space-y-2.5">
                        <span class="font-metric text-[11px] text-slate-500 uppercase block">Facchini Rodoviários · SKU: FAC-CIST10K</span>
                        <h3 class="font-headline text-lg font-bold text-[#051125]">Cisterna Tanque Combustible 10,000 Gal</h3>
                        <p class="font-body text-xs text-slate-600 line-clamp-2">
                            Norma DOT 406. Cuatro compartimentos independientes con rompeolas internos y válvulas de emergencia neumáticas.
                        </p>
                        
                        <div class="space-y-1 font-metric text-xs pt-1">
                            <div class="flex justify-between py-1 px-2 rounded bg-slate-50 border border-slate-100">
                                <span class="text-slate-500">Capacidad:</span>
                                <span class="font-bold text-[#051125]">10,000 Gal (~38k L)</span>
                            </div>
                            <div class="flex justify-between py-1 px-2 rounded bg-slate-50 border border-slate-100">
                                <span class="text-slate-500">Divisiones:</span>
                                <span class="font-bold text-[#051125]">4 Compartimentos</span>
                            </div>
                            <div class="flex justify-between py-1 px-2 rounded bg-slate-50 border border-slate-100">
                                <span class="text-slate-500">Seguridad:</span>
                                <span class="font-bold text-[#051125]">Norma OSINERGMIN</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-5 pt-0 space-y-2.5">
                    <div class="flex items-center justify-between">
                        <span class="font-metric text-xs text-slate-600 font-semibold uppercase">Cotización Técnica</span>
                        <span class="font-metric text-xs text-amber-700 font-semibold">Bajo Pedido</span>
                    </div>
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20cotizar%20Cisterna%20Combustible%2010k%20Facchini" target="_blank" class="w-full py-2.5 rounded-lg bg-[#25D366] hover:bg-[#20bd5a] text-white font-headline text-xs font-bold flex items-center justify-center gap-1.5 transition-colors">
                        <i class="fab fa-whatsapp text-sm"></i>
                        <span>Cotizar por WhatsApp</span>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- 5. MARCAS OFICIALES & HOMOLOGACIÓN INTEGRADA -->
<section class="w-full bg-white py-16 border-y border-slate-200">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12">
        <div class="text-center space-y-1 mb-10">
            <span class="font-metric text-xs text-[#765a23] uppercase font-bold tracking-wider">RESPALDO Y REPRESENTACIÓN OFICIAL</span>
            <h3 class="font-headline text-2xl sm:text-3xl font-bold text-[#051125]">MARCAS OFICIALES &amp; HOMOLOGACIÓN INTEGRADA</h3>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 items-center">
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col items-center justify-center text-center space-y-1 hover:shadow-md transition-shadow">
                <span class="font-headline text-base font-bold text-[#051125]">RODO Electric</span>
                <span class="font-metric text-[11px] text-[#765a23] font-semibold">Certificado Oficial</span>
            </div>
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col items-center justify-center text-center space-y-1 hover:shadow-md transition-shadow">
                <span class="font-headline text-base font-bold text-[#051125]">FACCHINI</span>
                <span class="font-metric text-[11px] text-[#765a23] font-semibold">Distribuidor Oficial Perú</span>
            </div>
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col items-center justify-center text-center space-y-1 hover:shadow-md transition-shadow">
                <span class="font-headline text-base font-bold text-[#051125]">JMEV Motors</span>
                <span class="font-metric text-[11px] text-[#765a23] font-semibold">Garantía Directa</span>
            </div>
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col items-center justify-center text-center space-y-1 hover:shadow-md transition-shadow">
                <span class="font-headline text-base font-bold text-[#051125]">CATL Power</span>
                <span class="font-metric text-[11px] text-[#765a23] font-semibold">Baterías LFP Tier-1</span>
            </div>
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col items-center justify-center text-center space-y-1 hover:shadow-md transition-shadow">
                <span class="font-headline text-base font-bold text-[#051125]">BYD Commercial</span>
                <span class="font-metric text-[11px] text-[#765a23] font-semibold">Chasis Homologados</span>
            </div>
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col items-center justify-center text-center space-y-1 hover:shadow-md transition-shadow">
                <span class="font-headline text-base font-bold text-[#051125]">ISO 9001 / MTC</span>
                <span class="font-metric text-[11px] text-[#765a23] font-semibold">Norma Nacional</span>
            </div>
        </div>
    </div>
</section>

<!-- 6. PROMOTIONAL CONVERSION BANNER (FERIA DE ELECTROMOVILIDAD) -->
<section class="w-full bg-[#051125] text-white py-14 relative overflow-hidden" style="background: linear-gradient(135deg, #07153b 0%, #0d2a78 60%, #155dfc 100%);">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
        <div class="rounded-2xl bg-[#051125]/90 border border-white/15 p-6 sm:p-10 shadow-2xl flex flex-col lg:flex-row items-center justify-between gap-8">
            <div class="space-y-2 max-w-xl text-center lg:text-left">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded bg-[#ffdea6] text-[#271900] font-metric text-xs font-bold">
                    <span class="material-symbols-outlined text-[16px]">campaign</span>
                    <span>FERIA CORPORATIVA 2026</span>
                </div>
                <h3 class="font-headline text-2xl sm:text-3xl font-bold text-white">¡Feria de Electromovilidad RODOPERU!</h3>
                <p class="font-body text-xs sm:text-sm text-slate-200 leading-relaxed">
                    Bono corporativo exclusivo y condiciones preferenciales en modelos eléctricos seleccionados e implementos Facchini con entrega inmediata. Asesoría tributaria y leasing disponible.
                </p>
            </div>

            <!-- Countdown Timer Blocks -->
            <div class="flex items-center gap-2.5 sm:gap-3">
                <div class="text-center p-3 sm:p-4 rounded-xl bg-[#1b263b] shadow-inner min-w-[65px] border border-white/10">
                    <div class="font-metric text-xl sm:text-2xl text-[#ffdea6] font-bold" id="cd-days">14</div>
                    <div class="font-metric text-[10px] text-slate-300 uppercase">Días</div>
                </div>
                <div class="text-center p-3 sm:p-4 rounded-xl bg-[#1b263b] shadow-inner min-w-[65px] border border-white/10">
                    <div class="font-metric text-xl sm:text-2xl text-[#ffdea6] font-bold" id="cd-hours">08</div>
                    <div class="font-metric text-[10px] text-slate-300 uppercase">Horas</div>
                </div>
                <div class="text-center p-3 sm:p-4 rounded-xl bg-[#1b263b] shadow-inner min-w-[65px] border border-white/10">
                    <div class="font-metric text-xl sm:text-2xl text-[#ffdea6] font-bold" id="cd-minutes">45</div>
                    <div class="font-metric text-[10px] text-slate-300 uppercase">Min</div>
                </div>
                <div class="text-center p-3 sm:p-4 rounded-xl bg-[#1b263b] shadow-inner min-w-[65px] border border-white/10">
                    <div class="font-metric text-xl sm:text-2xl text-[#ffdea6] font-bold" id="cd-seconds">20</div>
                    <div class="font-metric text-[10px] text-slate-300 uppercase">Seg</div>
                </div>
            </div>

            <!-- CTA Direct to Advisor -->
            <div class="shrink-0">
                <a href="https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20el%20bono%20de%20la%20Feria%20de%20Electromovilidad" target="_blank" class="px-6 py-3.5 rounded-xl bg-[#ffdea6] hover:bg-[#fed894] text-[#271900] font-headline text-sm font-bold flex items-center justify-center gap-2 transition-all shadow-md">
                    <span class="material-symbols-outlined text-[20px]">forum</span>
                    <span>Hablar con un Ingeniero Asesor</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 7. NOVEDADES & ARTÍCULOS TÉCNICOS -->
<section class="w-full bg-[#f9faf5] py-16">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
            <div class="space-y-1">
                <span class="font-metric text-xs text-[#765a23] uppercase font-bold tracking-wider">ACTUALIDAD &amp; TENDENCIAS</span>
                <h3 class="font-headline text-2xl sm:text-3xl font-bold text-[#051125]">Novedades del Sector Transporte</h3>
            </div>
            <a href="{{ route('novedades.index') }}" class="inline-flex items-center gap-1 font-metric text-xs text-[#765a23] uppercase font-bold hover:text-[#051125] transition-colors">
                <span>Ver todos los artículos</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Article 1 -->
            <div class="rounded-2xl bg-white shadow-md overflow-hidden flex flex-col sm:flex-row gap-5 p-5 group hover:shadow-xl transition-all border border-slate-100">
                <div class="sm:w-1/3 aspect-[4/3] rounded-xl overflow-hidden relative shrink-0 bg-slate-100">
                    <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-300" style="background-image: url('{{ asset('images/catalog/ev-charging-peru.jpg') }}');"></div>
                </div>
                <div class="flex-1 flex flex-col justify-between space-y-2">
                    <div>
                        <span class="font-metric text-[10px] text-[#765a23] font-bold uppercase tracking-wider">ELECTROMOVILIDAD PERÚ</span>
                        <h4 class="font-headline text-base sm:text-lg font-bold text-[#051125] mt-1 leading-snug">
                            Electromovilidad en el Perú: Por qué el 2026 es el año ideal para renovar tu flota
                        </h4>
                        <p class="font-body text-xs text-slate-600 line-clamp-2 mt-1">
                            Analizamos el retorno de inversión, incentivos tributarios y el drástico ahorro en costos energéticos frente a la volatilidad de los combustibles fósiles.
                        </p>
                    </div>
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Deseo%20leer%20informe%20de%20flotas%20electricas%202026" target="_blank" class="inline-flex items-center gap-1 font-body text-xs font-bold text-blue-700 hover:text-blue-900 transition-colors">
                        <span>Leer informe completo</span>
                        <span class="material-symbols-outlined text-[15px]">north_east</span>
                    </a>
                </div>
            </div>

            <!-- Article 2 -->
            <div class="rounded-2xl bg-white shadow-md overflow-hidden flex flex-col sm:flex-row gap-5 p-5 group hover:shadow-xl transition-all border border-slate-100">
                <div class="sm:w-1/3 aspect-[4/3] rounded-xl overflow-hidden relative shrink-0 bg-slate-100">
                    <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-300" style="background-image: url('{{ asset('images/catalog/andes-heavy-haul.jpg') }}');"></div>
                </div>
                <div class="flex-1 flex flex-col justify-between space-y-2">
                    <div>
                        <span class="font-metric text-[10px] text-[#765a23] font-bold uppercase tracking-wider">IMPLEMENTOS RODOVIARIOS</span>
                        <h4 class="font-headline text-base sm:text-lg font-bold text-[#051125] mt-1 leading-snug">
                            Claves para elegir el semirremolque ideal según la ruta y la carga en el Perú
                        </h4>
                        <p class="font-body text-xs text-slate-600 line-clamp-2 mt-1">
                            Desde la geografía de la sierra central hasta el desierto costero: factores estructurales, tipos de suspensión y durabilidad de los aceros Hardox.
                        </p>
                    </div>
                    <a href="https://wa.me/{{ $whatsappClean }}?text=Deseo%20guia%20para%20elegir%20semirremolque%20Facchini" target="_blank" class="inline-flex items-center gap-1 font-body text-xs font-bold text-blue-700 hover:text-blue-900 transition-colors">
                        <span>Leer guía técnica</span>
                        <span class="material-symbols-outlined text-[15px]">north_east</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    // Hero Pillar Stage Switcher
    function switchHeroStage(stage) {
        const ev = document.getElementById('stage-ev');
        const facchini = document.getElementById('stage-facchini');
        const tabEv = document.getElementById('tab-ev');
        const tabFacchini = document.getElementById('tab-facchini');

        if (stage === 'ev') {
            ev.classList.remove('hidden');
            facchini.classList.add('hidden');
            tabEv.className = 'px-5 py-2.5 rounded-lg font-headline text-xs sm:text-sm font-semibold transition-all duration-200 bg-[#ffdea6] text-[#271900] shadow-sm flex items-center gap-2';
            tabFacchini.className = 'px-5 py-2.5 rounded-lg font-headline text-xs sm:text-sm font-semibold transition-all duration-200 text-slate-300 hover:text-white flex items-center gap-2';
        } else {
            facchini.classList.remove('hidden');
            ev.classList.add('hidden');
            tabFacchini.className = 'px-5 py-2.5 rounded-lg font-headline text-xs sm:text-sm font-semibold transition-all duration-200 bg-[#ffdea6] text-[#271900] shadow-sm flex items-center gap-2';
            tabEv.className = 'px-5 py-2.5 rounded-lg font-headline text-xs sm:text-sm font-semibold transition-all duration-200 text-slate-300 hover:text-white flex items-center gap-2';
        }
    }

    // Color Switcher for EV-2
    function setEv2Color(color) {
        const img = document.getElementById('ev2-car-preview');
        img.style.opacity = '0.35';
        setTimeout(() => {
            img.style.opacity = '1';
        }, 150);
    }

    // Interactive Savings & ROI Calculator
    function calculateSavings(km) {
        document.getElementById('km-value-display').innerText = km;
        const annualDays = 300;
        const fossilCost = Math.round(km * annualDays * 0.16);
        const electricCost = Math.round(km * annualDays * 0.037);
        const annualSavingsUsd = fossilCost - electricCost;
        const annualSavingsSoles = Math.round(annualSavingsUsd * 3.75);

        document.getElementById('cost-fossil').innerText = `USD $${fossilCost.toLocaleString()}`;
        document.getElementById('cost-electric').innerText = `USD $${electricCost.toLocaleString()}`;
        document.getElementById('annual-savings').innerText = `USD $${annualSavingsUsd.toLocaleString()} / año`;
        document.getElementById('annual-soles').innerText = `¡Equivalente a aprox. S/ ${annualSavingsSoles.toLocaleString()} Soles por unidad!`;

        const cta = document.getElementById('calc-cta');
        cta.href = `https://wa.me/{{ $whatsappClean }}?text=Hola%20RODOPERU,%20deseo%20evaluar%20ahorro%20de%20flota%20para%20${km}%20km%20al%20dia%20(Ahorro%20estimado%20USD%20$${annualSavingsUsd})`;
    }

    // Live Countdown Timer
    setInterval(() => {
        const secEl = document.getElementById('cd-seconds');
        if (secEl) {
            let currentSec = parseInt(secEl.innerText);
            if (currentSec > 0) {
                secEl.innerText = (currentSec - 1).toString().padStart(2, '0');
            } else {
                secEl.innerText = '59';
            }
        }
    }, 1000);
</script>
@endpush
