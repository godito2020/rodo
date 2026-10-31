@extends('layouts.app')

@section('title', 'RODOPERU | Contacto & Asesoría Técnica de Flotas')

@section('meta_description', 'Comuníquese con los ingenieros y asesores comerciales de RODOPERU S.A.C. Visite nuestro showroom y patio de pruebas en Ate, Lima.')

@php
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '+51987654321');
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
    $companyPhone = \App\Models\Setting::get('company_phone', '+51 (01) 719-8900');
    $supportEmail = \App\Models\Setting::get('support_email', 'ventas@rodoperu.com');
    $salesEmail = \App\Models\Setting::get('sales_email', 'cotizaciones@rodoperu.com');
    $companyAddress = \App\Models\Setting::get('company_address', 'Av. Nicolas Ayllon 2925 el Agustino - Lima');
    $companyLocationTitle = \App\Models\Setting::get('company_location_title', 'Sede Central El Agustino - Lima');
    $companyLocationDescription = \App\Models\Setting::get('company_location_description', 'Showroom comercial, patio de maniobras y atención corporativa personalizada de flotas pesadas y electromovilidad.');
    $companySchedule = \App\Models\Setting::get('company_schedule', 'Lunes a Viernes de 08:30 a 18:00 | Sábado de 09:00 a 13:00');
@endphp

@section('content')

<!-- Top Breadcrumb -->
<div class="w-full bg-slate-100 py-3 border-b border-slate-200">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 flex items-center justify-between font-metric text-xs text-slate-600">
        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[15px]">home</span>
                <span>Inicio</span>
            </a>
            <span>/</span>
            <span class="text-[#051125] font-bold">Contacto Corporativo &amp; Sedes</span>
        </div>
        <div class="hidden sm:flex items-center gap-4">
            <span class="inline-flex items-center gap-1.5 text-emerald-700 font-semibold">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Atención Comercial Activa</span>
            </span>
        </div>
    </div>
</div>

<!-- Visual Banner -->
<section class="relative w-full text-white overflow-hidden py-14" style="background: linear-gradient(135deg, #07153b 0%, #0d2a78 60%, #155dfc 100%);">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
            <div class="max-w-3xl space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#1b263b] rounded-full text-[#ffdea6] font-metric text-xs uppercase font-semibold border border-white/10">
                    <span class="w-2 h-2 rounded-full bg-[#ffdea6] animate-pulse"></span>
                    <span>Atención Corporativa &amp; Flotas {{ date('Y') }}</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-5xl font-bold tracking-tight uppercase leading-tight">
                    Contacto Directo &amp; Asesoría Técnica
                </h1>
                <p class="font-body text-sm sm:text-base text-slate-200 leading-relaxed">
                    Canales inmediatos de ingeniería para evaluación de flota pesada, electromovilidad JMEV, tolvas y semirremolques Facchini. Programe su visita a nuestro showroom industrial en Ate con patio de pruebas.
                </p>
            </div>

            <!-- Response Time Badge -->
            <div class="flex items-center gap-4 bg-[#1b263b]/90 backdrop-blur px-6 py-4 rounded-2xl shadow-xl shrink-0 border border-white/15">
                <div class="w-12 h-12 rounded-xl bg-[#051125] flex items-center justify-center text-[#ffdea6]">
                    <span class="material-symbols-outlined text-[28px]">speed</span>
                </div>
                <div>
                    <div class="font-headline text-xl font-bold text-white">&lt; 15 Minutos</div>
                    <div class="font-body text-xs text-slate-300">Tiempo de respuesta comercial</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Interaction Section -->
<section class="max-w-[1440px] mx-auto w-full px-4 sm:px-6 lg:px-12 py-14 font-body">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left: Formulario Corporativo B2B -->
        <div class="lg:col-span-7 bg-white rounded-2xl p-6 sm:p-10 shadow-md border border-slate-200">
            <div class="pb-4 mb-6 border-b border-slate-100">
                <span class="font-metric text-xs text-[#765a23] uppercase font-bold">Mesa de Cotizaciones</span>
                <h2 class="font-headline text-2xl font-bold text-[#051125] mt-1">Solicitud de Ingeniería &amp; Configuración</h2>
            </div>

            <form action="{{ route('contacto.submit') }}" method="POST" class="space-y-4">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Nombres y Apellidos *</label>
                        <input type="text" name="name" required class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm" placeholder="Ej. Carlos Mendoza">
                    </div>
                    <div>
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Razón Social / RUC *</label>
                        <input type="text" name="subject" required class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm" placeholder="Ej. TransLog S.A.C. / 2060...">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Correo Corporativo *</label>
                        <input type="email" name="email" required class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm" placeholder="cmendoza@empresa.com.pe">
                    </div>
                    <div>
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Celular / WhatsApp *</label>
                        <input type="tel" name="phone" required class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm" placeholder="+51 987 654 321">
                    </div>
                </div>

                <div>
                    <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Tipo de Solución de Interés *</label>
                    <select name="product_interest" class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm bg-white">
                        <option value="Vehículos 100% Eléctricos JMEV/RODO">Vehículos 100% Eléctricos JMEV / RODO</option>
                        <option value="Semirremolques Furgón Facchini">Semirremolques Furgón Facchini 3 Ejes</option>
                        <option value="Tolvas Mineras Basculantes Hardox 450">Tolvas Mineras Basculantes Hardox 450 Facchini</option>
                        <option value="Plataformas Multimodal Porta-Contenedor">Plataformas Multimodal Porta-Contenedor</option>
                        <option value="Cisternas Tanque de Combustible">Cisternas Tanque de Combustible 10,000 Gal</option>
                        <option value="Repuestos y Mantenimiento Postventa">Repuestos y Mantenimiento Postventa</option>
                        <option value="Otra Consulta">Otra Consulta Corporativa</option>
                    </select>
                </div>

                <div>
                    <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Detalle del Requerimiento o Ruta *</label>
                    <textarea name="message" rows="3" required class="w-full p-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm" placeholder="Indíquenos el tonelaje, número de unidades o ruta de operación..."></textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 rounded-xl bg-[#051125] hover:bg-[#1b263b] text-white font-headline text-sm font-bold flex items-center justify-center gap-2 shadow-md transition-all">
                        <span class="material-symbols-outlined text-[20px] text-[#ffdea6]">send</span>
                        <span>Enviar Solicitud a Mesa de Cotizaciones</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Right: Canales Prioritarios & Sede -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- Canales Directos -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-md border border-slate-200 space-y-4">
                <h3 class="font-headline text-xl font-bold text-[#051125]">Canales Directos</h3>
                
                <a href="https://wa.me/{{ $whatsappClean }}" target="_blank" class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center gap-4 hover:bg-emerald-100 transition-colors">
                    <div class="w-12 h-12 rounded-full bg-[#25D366] text-white flex items-center justify-center shrink-0">
                        <i class="fab fa-whatsapp text-2xl"></i>
                    </div>
                    <div>
                        <span class="font-metric text-xs text-emerald-800 font-bold block uppercase">WhatsApp Flotas Inmediato</span>
                        <span class="font-headline text-base font-bold text-[#051125]">{{ $whatsappNumber }}</span>
                    </div>
                </a>

                <a href="tel:{{ preg_replace('/[^0-9]/', '', $companyPhone) }}" class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex items-center gap-4 hover:bg-slate-100 transition-colors">
                    <div class="w-12 h-12 rounded-full bg-[#051125] text-[#ffdea6] flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px]">call</span>
                    </div>
                    <div>
                        <span class="font-metric text-xs text-slate-500 font-bold block uppercase">Central Telefónica Lima</span>
                        <span class="font-headline text-base font-bold text-[#051125]">{{ $companyPhone }}</span>
                    </div>
                </a>

                <a href="mailto:{{ $supportEmail }}" class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex items-center gap-4 hover:bg-slate-100 transition-colors">
                    <div class="w-12 h-12 rounded-full bg-[#051125] text-[#ffdea6] flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px]">mail</span>
                    </div>
                    <div>
                        <span class="font-metric text-xs text-slate-500 font-bold block uppercase">Correo de Proformas</span>
                        <span class="font-headline text-sm font-bold text-[#051125]">{{ $supportEmail }}</span>
                    </div>
                </a>
            </div>

            <!-- Sede & Showroom -->
            <div class="bg-[#051125] text-white rounded-2xl p-6 sm:p-8 shadow-xl border border-white/10 space-y-4" style="background: linear-gradient(135deg, #051125 0%, #0d1b33 60%, #15274d 100%);">
                <div class="flex items-center gap-2 text-[#ffdea6] font-metric text-xs font-bold uppercase">
                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                    <span>Showroom Industrial &amp; Patio de Pruebas</span>
                </div>
                
                <h4 class="font-headline text-xl font-bold text-white">{{ $companyLocationTitle }}</h4>
                <div class="space-y-1.5">
                    <p class="text-sm font-semibold text-white flex items-start gap-1.5">
                        <span class="material-symbols-outlined text-[17px] text-[#ffdea6] shrink-0 mt-0.5">pin_drop</span>
                        <span>{{ $companyAddress }}</span>
                    </p>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        {{ $companyLocationDescription }}
                    </p>
                </div>

                <div class="pt-2 flex items-center gap-2 text-xs text-[#ffdea6] font-metric">
                    <span class="material-symbols-outlined text-[16px]">schedule</span>
                    <span>Horario: {{ $companySchedule }}</span>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
