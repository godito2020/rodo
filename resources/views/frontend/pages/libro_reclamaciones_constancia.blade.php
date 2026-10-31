@extends('layouts.app')

@section('title', 'Constancia de Reclamación ' . $claim->claim_number . ' | RODOPERU S.A.C.')

@section('content')
<section class="max-w-[1000px] mx-auto w-full px-4 sm:px-6 py-12 font-body">

    <!-- Success Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
        
        <!-- Header -->
        <div class="p-6 sm:p-8 text-white text-center" style="background: linear-gradient(135deg, #051125 0%, #0d2a78 100%);">
            <div class="w-16 h-16 rounded-full bg-emerald-500/20 text-emerald-400 mx-auto flex items-center justify-center mb-3 border border-emerald-400/30">
                <span class="material-symbols-outlined text-[36px]">check_circle</span>
            </div>
            <span class="font-metric text-xs uppercase font-bold text-[#ffdea6] tracking-wider">Constancia Digital Oficial</span>
            <h1 class="font-headline text-2xl sm:text-3xl font-bold uppercase mt-1">Hoja de Reclamación Registrada</h1>
            <p class="text-xs sm:text-sm text-slate-200 mt-1 max-w-lg mx-auto">
                Tu requerimiento ha sido ingresado exitosamente en el Libro de Reclamaciones Virtual de RODOPERU S.A.C.
            </p>

            <div class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#1b263b] text-[#ffdea6] font-metric text-sm sm:text-base font-bold border border-white/20">
                <span class="material-symbols-outlined text-[20px]">tag</span>
                <span>N° CORRELATIVO: {{ $claim->claim_number }}</span>
            </div>
        </div>

        <!-- Body Details -->
        <div class="p-6 sm:p-10 space-y-6">
            
            <!-- Legal Deadline Box -->
            <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 flex items-start gap-3">
                <span class="material-symbols-outlined text-amber-600 text-[24px] shrink-0 mt-0.5">schedule</span>
                <div class="text-xs text-amber-900 leading-relaxed">
                    <strong class="font-bold">Plazo Legal de Atención (INDECOPI):</strong>
                    De conformidad con la Ley N° 29571 y el D.S. N° 011-2011-PCM, daremos respuesta formal a tu reclamo en un plazo máximo de <strong>15 días hábiles</strong> (fecha límite estimada: <strong>{{ $claim->deadline->format('d/m/Y') }}</strong>) a través del correo electrónico consignado: <strong>{{ $claim->email }}</strong>.
                </div>
            </div>

            <!-- Summary Table -->
            <div class="rounded-xl border border-slate-200 overflow-hidden text-xs">
                <div class="bg-slate-100 px-4 py-3 font-headline font-bold text-[#051125] uppercase text-xs">
                    Resumen de la Reclamación
                </div>
                <div class="divide-y divide-slate-100">
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-3.5 gap-1">
                        <span class="font-bold text-slate-500 font-metric uppercase">Consumidor:</span>
                        <span class="sm:col-span-2 text-slate-800 font-semibold">{{ $claim->full_name }} ({{ $claim->doc_type }}: {{ $claim->doc_number }})</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-3.5 gap-1 bg-slate-50/50">
                        <span class="font-bold text-slate-500 font-metric uppercase">Contacto:</span>
                        <span class="sm:col-span-2 text-slate-800">{{ $claim->phone }} &bull; {{ $claim->email }}</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-3.5 gap-1">
                        <span class="font-bold text-slate-500 font-metric uppercase">Domicilio:</span>
                        <span class="sm:col-span-2 text-slate-800">{{ $claim->address }} {{ $claim->district ? '- ' . $claim->district : '' }}</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-3.5 gap-1 bg-slate-50/50">
                        <span class="font-bold text-slate-500 font-metric uppercase">Tipo:</span>
                        <span class="sm:col-span-2 font-bold text-blue-700 uppercase">{{ strtoupper($claim->claim_type) }} (Bien: {{ ucfirst($claim->contracted_type) }})</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-3.5 gap-1">
                        <span class="font-bold text-slate-500 font-metric uppercase">Bien Contratado:</span>
                        <span class="sm:col-span-2 text-slate-800">{{ $claim->product_description }}</span>
                    </div>
                    @if($claim->claimed_amount)
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-3.5 gap-1 bg-slate-50/50">
                        <span class="font-bold text-slate-500 font-metric uppercase">Monto Reclamado:</span>
                        <span class="sm:col-span-2 text-slate-800 font-metric font-bold">{{ $claim->currency }} {{ number_format((float)$claim->claimed_amount, 2) }}</span>
                    </div>
                    @endif
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-3.5 gap-1">
                        <span class="font-bold text-slate-500 font-metric uppercase">Detalle:</span>
                        <span class="sm:col-span-2 text-slate-800 leading-relaxed">{{ $claim->details }}</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-3.5 gap-1 bg-slate-50/50">
                        <span class="font-bold text-slate-500 font-metric uppercase">Pedido Concreto:</span>
                        <span class="sm:col-span-2 text-slate-800 font-semibold leading-relaxed">{{ $claim->consumer_request }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4 border-t border-slate-200">
                <a href="{{ route('libro_reclamaciones.print', $claim->claim_number) }}" target="_blank" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-headline text-xs font-bold flex items-center justify-center gap-2 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[18px] text-[#ffdea6]">print</span>
                    <span>Imprimir / Descargar Hoja Oficial</span>
                </a>

                <a href="{{ route('home') }}" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-headline text-xs font-bold flex items-center justify-center gap-2 transition-all">
                    <span class="material-symbols-outlined text-[18px]">home</span>
                    <span>Volver a la Página Principal</span>
                </a>
            </div>

            <!-- Indecopi Info Footer -->
            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 text-[11px] text-slate-500 text-center space-y-1">
                <p>
                    RODOPERU S.A.C. &bull; RUC 20601234567 &bull; {{ $companyAddress }}
                </p>
                <p>
                    Si transcurrido el plazo legal de 15 días hábiles no ha recibido respuesta o no está conforme con la misma, puede presentar su reclamo ante el <a href="https://enlinea.indecopi.gob.pe/reclamavirtual/" target="_blank" class="text-blue-600 font-bold underline">Servicio de Atención al Ciudadano del INDECOPI</a>.
                </p>
            </div>

        </div>

    </div>

</section>
@endsection
