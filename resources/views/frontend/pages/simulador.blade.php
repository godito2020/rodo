@extends('layouts.app')

@section('title', 'RODOPERU | Simulador de Ahorro TCO & Retorno de Inversión de Flotas')

@section('meta_description', 'Evalúe el impacto financiero y ahorro de costos operativos (TCO) al migrar su flota a vehículos 100% eléctricos en el Perú. Herramienta corporativa para gerentes de logística.')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '+51987654321');
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
@endphp

@section('content')

<!-- Header Breadcrumb & Indicator -->
<div class="w-full bg-slate-100 py-3 border-b border-slate-200">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 flex items-center justify-between font-metric text-xs text-slate-600">
        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[15px]">home</span>
                <span>Inicio</span>
            </a>
            <span>/</span>
            <span class="text-[#051125] font-bold">Simulador Corporativo TCO &amp; ROI</span>
        </div>
        <div class="hidden sm:flex items-center gap-3">
            <span class="inline-flex items-center gap-1.5 text-emerald-700 font-semibold">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Parámetros Tarifarios Regulados OSINERGMIN / MTC 2026</span>
            </span>
        </div>
    </div>
</div>

<!-- Hero Section -->
<section class="relative bg-[#051125] text-white py-14 px-4 sm:px-6 lg:px-12 overflow-hidden shadow-xl" style="background: linear-gradient(135deg, #07153b 0%, #0d2a78 60%, #155dfc 100%);">
    <div class="absolute -right-24 -top-24 w-96 h-96 rounded-full bg-[#ffdea6]/10 blur-3xl pointer-events-none"></div>
    <div class="max-w-[1440px] mx-auto flex flex-col lg:flex-row items-center justify-between gap-10 relative z-10">
        <div class="max-w-3xl space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#1b263b] rounded-full text-[#ffdea6] border border-white/10 font-metric text-xs uppercase tracking-wider font-semibold">
                <span class="material-symbols-outlined text-[17px]">query_stats</span>
                <span>Herramienta Financiera Corporativa B2B</span>
            </div>
            <h1 class="font-headline text-3xl sm:text-5xl font-bold tracking-tight text-white leading-tight">
                Simulador de Ahorro TCO &amp; Retorno de Inversión
            </h1>
            <p class="font-body text-sm sm:text-base text-slate-200 leading-relaxed">
                Evalúe cuantitativamente la transición energética de su flota comercial. Diseñado para directores de operaciones, finanzas y logística en el territorio peruano con tarifas reales de electricidad y combustibles.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-3">
                <div class="p-4 bg-[#1b263b]/80 border border-white/10 rounded-xl">
                    <div class="font-metric text-2xl text-[#ffdea6] font-bold flex items-center gap-1">
                        <span>75%</span>
                        <span class="material-symbols-outlined text-[20px]">trending_down</span>
                    </div>
                    <p class="font-metric text-[11px] text-slate-300 uppercase mt-1">Costo Energético</p>
                    <p class="font-body text-[10px] text-slate-400">Vs diésel y gasolina en ruta</p>
                </div>
                <div class="p-4 bg-[#1b263b]/80 border border-white/10 rounded-xl">
                    <div class="font-metric text-2xl text-[#ffdea6] font-bold flex items-center gap-1">
                        <span>70%</span>
                        <span class="material-symbols-outlined text-[20px]">engineering</span>
                    </div>
                    <p class="font-metric text-[11px] text-slate-300 uppercase mt-1">Mantenimiento Preventivo</p>
                    <p class="font-body text-[10px] text-slate-400">Sin aceites, bujías ni fajas</p>
                </div>
                <div class="p-4 bg-[#1b263b]/80 border border-white/10 rounded-xl">
                    <div class="font-metric text-2xl text-[#ffdea6] font-bold flex items-center gap-1">
                        <span>SUNAT</span>
                        <span class="material-symbols-outlined text-[20px]">receipt_long</span>
                    </div>
                    <p class="font-metric text-[11px] text-slate-300 uppercase mt-1">Depreciación Acelerada</p>
                    <p class="font-body text-[10px] text-slate-400">Incentivo Ley N° 31696</p>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-96 flex flex-col gap-3">
            <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-[#1b263b] aspect-[4/3] border border-white/15">
                <img src="{{ asset('images/catalog/fleet-hub-sim.jpg') }}" alt="Flota de vehículos comerciales eléctricos" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-[#051125] via-transparent to-transparent"></div>
                <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-white">
                    <div>
                        <span class="font-metric text-[10px] text-[#ffdea6] block uppercase tracking-wider">TECNOLOGÍA VALIDADA</span>
                        <span class="font-headline text-lg font-bold">Cero Emisiones en Ruta</span>
                    </div>
                    <span class="material-symbols-outlined text-[30px] text-[#ffdea6]">bolt</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Interactive Simulator Workspace -->
<section class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 py-14 w-full font-body">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Columna Izquierda: Parámetros de Operación -->
        <div class="lg:col-span-6 bg-white p-6 sm:p-8 rounded-2xl shadow-md border border-slate-200 space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <div class="flex items-center justify-between">
                    <h2 class="font-headline text-2xl font-bold text-[#051125]">Configuración de Flota</h2>
                    <span class="font-metric text-xs text-[#765a23] font-bold bg-[#ffdea6]/30 px-2.5 py-1 rounded">PASO 1 / VARIABLES</span>
                </div>
                <p class="text-xs text-slate-500 mt-1">Ajuste las variables reales de su operación vehicular en Perú.</p>
            </div>

            <!-- 1. Modelo Vehicular -->
            <div class="space-y-2">
                <label class="font-metric text-xs uppercase text-[#051125] font-bold block">1. Modelo Vehicular Corporativo</label>
                <div class="grid grid-cols-1 gap-2" id="sim-vehicle-selector">
                    <button type="button" onclick="selectSimVehicle('jmev', 0.13, 38, 0.14, this)" class="sim-v-btn active text-left p-3.5 rounded-xl border-2 border-blue-600 bg-blue-50/50 transition-all flex items-center justify-between">
                        <div>
                            <span class="font-headline text-sm font-bold text-[#051125] block">JMEV EV-2 Urban City Car</span>
                            <span class="text-[11px] text-slate-500">Supervisión, mensajería y personal técnico</span>
                        </div>
                        <span class="font-metric text-xs text-blue-700 font-bold">13 kWh / 100km</span>
                    </button>

                    <button type="button" onclick="selectSimVehicle('van', 0.22, 32, 0.22, this)" class="sim-v-btn text-left p-3.5 rounded-xl border border-slate-200 hover:border-slate-300 bg-white transition-all flex items-center justify-between">
                        <div>
                            <span class="font-headline text-sm font-bold text-[#051125] block">RODO Cargo E-Van 1.5T</span>
                            <span class="text-[11px] text-slate-500">Última milla, paquetería y retail urbano</span>
                        </div>
                        <span class="font-metric text-xs text-slate-700 font-bold">22 kWh / 100km</span>
                    </button>

                    <button type="button" onclick="selectSimVehicle('suv', 0.20, 28, 0.26, this)" class="sim-v-btn text-left p-3.5 rounded-xl border border-slate-200 hover:border-slate-300 bg-white transition-all flex items-center justify-between">
                        <div>
                            <span class="font-headline text-sm font-bold text-[#051125] block">RODO EV-600 Grand SUV Ejecutivo</span>
                            <span class="text-[11px] text-slate-500">Transporte VIP, minería y directores</span>
                        </div>
                        <span class="font-metric text-xs text-slate-700 font-bold">20 kWh / 100km</span>
                    </button>

                    <button type="button" onclick="selectSimVehicle('truck', 0.55, 14, 0.48, this)" class="sim-v-btn text-left p-3.5 rounded-xl border border-slate-200 hover:border-slate-300 bg-white transition-all flex items-center justify-between">
                        <div>
                            <span class="font-headline text-sm font-bold text-[#051125] block">Camión Ligero RODO E-Truck 4.5T</span>
                            <span class="text-[11px] text-slate-500">Distribución pesada ligera e interurbana</span>
                        </div>
                        <span class="font-metric text-xs text-slate-700 font-bold">55 kWh / 100km</span>
                    </button>
                </div>
            </div>

            <!-- 2. Cantidad de Unidades en Flota -->
            <div class="space-y-2 pt-2">
                <div class="flex justify-between items-center">
                    <label class="font-metric text-xs uppercase text-[#051125] font-bold">2. Cantidad de Vehículos en Flota</label>
                    <span class="font-metric text-sm font-bold text-blue-700 bg-blue-50 px-3 py-1 rounded-lg border border-blue-200" id="sim-fleet-display">5 Unidades</span>
                </div>
                <input type="range" id="sim-fleet" min="1" max="50" step="1" value="5" oninput="runSimulation()" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-blue-600">
                <div class="flex justify-between font-metric text-[10px] text-slate-400">
                    <span>1 Unidad (Piloto)</span>
                    <span>15 Unidades</span>
                    <span>50 Unidades (Gran Flota)</span>
                </div>
            </div>

            <!-- 3. Kilometraje Diario -->
            <div class="space-y-2 pt-2">
                <div class="flex justify-between items-center">
                    <label class="font-metric text-xs uppercase text-[#051125] font-bold">3. Recorrido Diario Promedio por Unidad</label>
                    <span class="font-metric text-sm font-bold text-blue-700 bg-blue-50 px-3 py-1 rounded-lg border border-blue-200" id="sim-km-display">90 km/día</span>
                </div>
                <input type="range" id="sim-km" min="30" max="300" step="10" value="90" oninput="runSimulation()" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-blue-600">
                <div class="flex justify-between font-metric text-[10px] text-slate-400">
                    <span>30 km/día</span>
                    <span>150 km/día</span>
                    <span>300 km/día</span>
                </div>
            </div>

            <!-- 4. Tarifas de Referencia en Perú -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <label class="block font-metric text-[11px] text-slate-500 uppercase font-semibold mb-1">Precio Diésel / Gasolina</label>
                    <div class="flex items-center gap-1 font-metric text-sm font-bold text-[#051125]">
                        <span>S/.</span>
                        <input type="number" id="sim-fuel-price" value="17.50" step="0.5" oninput="runSimulation()" class="w-20 bg-white border border-slate-300 rounded px-2 py-0.5 text-center font-bold">
                        <span class="text-xs font-normal text-slate-500">/ galón</span>
                    </div>
                </div>

                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <label class="block font-metric text-[11px] text-slate-500 uppercase font-semibold mb-1">Tarifa Electricidad</label>
                    <div class="flex items-center gap-1 font-metric text-sm font-bold text-[#051125]">
                        <span>S/.</span>
                        <input type="number" id="sim-kwh-price" value="0.48" step="0.02" oninput="runSimulation()" class="w-20 bg-white border border-slate-300 rounded px-2 py-0.5 text-center font-bold">
                        <span class="text-xs font-normal text-slate-500">/ kWh</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Columna Derecha: Tablero de Resultados Financieros & ESG -->
        <div class="lg:col-span-6 space-y-6">
            <div class="bg-[#051125] text-white p-6 sm:p-8 rounded-2xl shadow-xl border border-slate-800 space-y-6" style="background: linear-gradient(135deg, #051125 0%, #0d1b33 60%, #15274d 100%);">
                <div class="flex items-center justify-between border-b border-white/10 pb-4">
                    <div>
                        <span class="font-metric text-xs uppercase text-[#ffdea6] font-bold">RESULTADOS ESTIMADOS</span>
                        <h3 class="font-headline text-2xl font-bold text-white">Impacto Económico Flota</h3>
                    </div>
                    <span class="material-symbols-outlined text-[#ffdea6] text-[32px]">payments</span>
                </div>

                <!-- Big Annual Savings Metric -->
                <div class="p-6 rounded-2xl bg-[#ffdea6] text-[#271900] shadow-lg">
                    <span class="font-metric text-xs uppercase font-bold text-[#271900]/80 block">Ahorro Neto Operativo Anual (TCO):</span>
                    <div class="font-headline text-3xl sm:text-4xl font-bold mt-1" id="res-savings-soles">
                        S/. 58,420 Soles / año
                    </div>
                    <div class="font-metric text-base sm:text-lg font-bold text-[#271900]/90 mt-1" id="res-savings-usd">
                        ≈ USD $15,580 / año
                    </div>
                    <span class="block text-[11px] font-semibold mt-2 text-[#271900]/80">
                        * Incluye 75% ahorro energético + 70% ahorro en mantenimiento preventivo
                    </span>
                </div>

                <!-- 2-Grid Cost Comparison -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl bg-[#1b263b] border border-white/10">
                        <span class="font-metric text-[11px] text-slate-400 uppercase block">Costo Anual Diésel Flota</span>
                        <div class="font-metric text-xl font-bold text-white mt-1" id="res-cost-fuel">
                            S/. 78,500
                        </div>
                        <span class="text-[10px] text-slate-400">Combustible convencional fósil</span>
                    </div>

                    <div class="p-4 rounded-xl bg-[#07153b] border border-[#ffdea6]/30">
                        <span class="font-metric text-[11px] text-[#ffdea6] uppercase block">Costo Anual Energía EV</span>
                        <div class="font-metric text-xl font-bold text-[#ffdea6] mt-1" id="res-cost-ev">
                            S/. 20,080
                        </div>
                        <span class="text-[10px] text-slate-300">Tarifa comercial eléctrica</span>
                    </div>
                </div>

                <!-- ESG Environmental Impact -->
                <div class="p-4 rounded-xl bg-[#0a1829] border border-white/10 flex items-center justify-between gap-4">
                    <div class="space-y-1">
                        <span class="font-metric text-xs uppercase text-emerald-400 font-bold block flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">eco</span>
                            <span>Métrica Ambiental (ESG)</span>
                        </span>
                        <div class="font-metric text-xl font-bold text-white" id="res-co2">
                            - 28.5 Toneladas de CO₂
                        </div>
                        <p class="text-[11px] text-slate-400">Emisiones no emitidas al medio ambiente por año.</p>
                    </div>
                    <span class="material-symbols-outlined text-emerald-400 text-[40px] shrink-0">forest</span>
                </div>

                <!-- CTA Button -->
                <div class="pt-2">
                    <a href="#" id="sim-whatsapp-cta" target="_blank" class="w-full py-4 rounded-xl bg-[#25D366] hover:bg-[#20bd5a] text-white font-headline text-sm font-bold flex items-center justify-center gap-2 shadow-lg transition-all">
                        <i class="fab fa-whatsapp text-lg"></i>
                        <span>Solicitar Proforma Oficial con estos Datos</span>
                    </a>
                </div>
            </div>

            <!-- Informative Callout: Beneficios Tributarios -->
            <div class="p-6 bg-slate-100 rounded-2xl border border-slate-200 space-y-2">
                <div class="flex items-center gap-2 text-[#765a23] font-metric text-xs font-bold uppercase">
                    <span class="material-symbols-outlined text-[18px]">verified</span>
                    <span>Marco Regulatorio y Tributario en el Perú</span>
                </div>
                <h4 class="font-headline text-base font-bold text-[#051125]">Beneficios de la Ley N° 31696 para Vehículos Eléctricos</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Las empresas en Perú pueden aplicar una tasa de <strong>depreciación acelerada anual de hasta 50%</strong> para vehículos 100% eléctricos destinados a sus actividades generadoras de renta de tercera categoría, optimizando el flujo de caja corporativo desde el primer año.
                </p>
            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    let currentKwhPer100 = 0.13;
    let currentKmPerGal = 38;
    let currentCo2PerKm = 0.14;
    let currentVehicleName = "JMEV EV-2 Urban City Car";

    function selectSimVehicle(type, kwh100, kmGal, co2, btn) {
        currentKwhPer100 = kwh100;
        currentKmPerGal = kmGal;
        currentCo2PerKm = co2;

        if (type === 'jmev') currentVehicleName = "JMEV EV-2 Urban City Car";
        if (type === 'van') currentVehicleName = "RODO Cargo E-Van 1.5T";
        if (type === 'suv') currentVehicleName = "RODO EV-600 Grand SUV";
        if (type === 'truck') currentVehicleName = "Camión Ligero RODO E-Truck 4.5T";

        document.querySelectorAll('.sim-v-btn').forEach(b => {
            b.className = 'sim-v-btn text-left p-3.5 rounded-xl border border-slate-200 hover:border-slate-300 bg-white transition-all flex items-center justify-between';
        });
        btn.className = 'sim-v-btn active text-left p-3.5 rounded-xl border-2 border-blue-600 bg-blue-50/50 transition-all flex items-center justify-between';

        runSimulation();
    }

    function runSimulation() {
        const fleet = parseInt(document.getElementById('sim-fleet').value);
        const kmDaily = parseInt(document.getElementById('sim-km').value);
        const fuelPrice = parseFloat(document.getElementById('sim-fuel-price').value) || 17.50;
        const kwhPrice = parseFloat(document.getElementById('sim-kwh-price').value) || 0.48;

        document.getElementById('sim-fleet-display').innerText = `${fleet} ${fleet === 1 ? 'Unidad' : 'Unidades'}`;
        document.getElementById('sim-km-display').innerText = `${kmDaily} km/día`;

        const workDays = 300;
        const annualKmTotal = fleet * kmDaily * workDays;

        // 1. Fuel cost: gallons = totalKm / kmPerGal * fuelPrice
        const gallons = annualKmTotal / currentKmPerGal;
        const annualFuelSoles = Math.round(gallons * fuelPrice);

        // 2. EV energy cost: kwh = totalKm * currentKwhPer100 * kwhPrice
        const kwhTotal = annualKmTotal * currentKwhPer100;
        const annualEvSoles = Math.round(kwhTotal * kwhPrice);

        // 3. Maintenance savings: ~ S/. 0.08 / km in ICE vs S/. 0.02 / km in EV
        const maintSavingsSoles = Math.round(annualKmTotal * 0.06);

        // Net savings
        const netSavingsSoles = (annualFuelSoles - annualEvSoles) + maintSavingsSoles;
        const netSavingsUsd = Math.round(netSavingsSoles / 3.75);

        // CO2 reduction in Tonnes
        const co2Tonnes = ((annualKmTotal * currentCo2PerKm) / 1000).toFixed(1);

        document.getElementById('res-savings-soles').innerText = `S/. ${netSavingsSoles.toLocaleString()} Soles / año`;
        document.getElementById('res-savings-usd').innerText = `≈ USD $${netSavingsUsd.toLocaleString()} / año`;
        document.getElementById('res-cost-fuel').innerText = `S/. ${annualFuelSoles.toLocaleString()}`;
        document.getElementById('res-cost-ev').innerText = `S/. ${annualEvSoles.toLocaleString()}`;
        document.getElementById('res-co2').innerText = `- ${co2Tonnes} Toneladas de CO₂`;

        // Update WhatsApp CTA
        const waCta = document.getElementById('sim-whatsapp-cta');
        const text = `¡Hola RODOPERU! He simulado en su web una flota de *${fleet} unidades* del modelo *${currentVehicleName}* con *${kmDaily} km/día*. Ahorro anual estimado: *S/. ${netSavingsSoles.toLocaleString()} Soles* (USD $${netSavingsUsd.toLocaleString()}). Deseo una proforma oficial para mi empresa.`;
        waCta.href = `https://wa.me/{{ $whatsappClean }}?text=${encodeURIComponent(text)}`;
    }

    // Run on load
    document.addEventListener('DOMContentLoaded', runSimulation);
</script>
@endpush
