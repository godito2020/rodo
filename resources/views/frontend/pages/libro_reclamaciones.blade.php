@extends('layouts.app')

@section('title', 'Libro de Reclamaciones Virtual | RODOPERU S.A.C.')
@section('meta_description', 'Libro de Reclamaciones Virtual oficial de RODOPERU S.A.C. conforme a la Ley N° 29571 (Código de Protección y Defensa del Consumidor) y D.S. 011-2011-PCM.')

@section('content')

<!-- Breadcrumb -->
<div class="w-full bg-slate-100 py-3 border-b border-slate-200">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 flex items-center justify-between font-metric text-xs text-slate-600">
        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[15px]">home</span>
                <span>Inicio</span>
            </a>
            <span>/</span>
            <span class="text-[#051125] font-bold">Libro de Reclamaciones Virtual</span>
        </div>
        <div class="hidden sm:flex items-center gap-2 text-slate-500 font-metric">
            <span class="material-symbols-outlined text-[16px] text-amber-600">gavel</span>
            <span>Ley N° 29571 &bull; INDECOPI Perú</span>
        </div>
    </div>
</div>

<!-- Banner Header -->
<section class="relative w-full text-white overflow-hidden py-12" style="background: linear-gradient(135deg, #07153b 0%, #0d2a78 60%, #155dfc 100%);">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8">
            <div class="max-w-3xl space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#1b263b] rounded-full text-[#ffdea6] font-metric text-xs uppercase font-semibold border border-white/10">
                    <span class="material-symbols-outlined text-[16px] text-[#ffdea6]">verified</span>
                    <span>Libro de Reclamaciones Virtual Oficial</span>
                </div>
                <h1 class="font-headline text-3xl sm:text-5xl font-bold tracking-tight uppercase leading-tight">
                    Libro de Reclamaciones
                </h1>
                <p class="font-body text-sm sm:text-base text-slate-200 leading-relaxed">
                    Conforme a lo establecido en el <strong>Código de Protección y Defensa del Consumidor (Ley N° 29571)</strong> y el <strong>D.S. N° 011-2011-PCM</strong>, ponemos a su disposición este canal oficial para registrar su Reclamo o Queja.
                </p>
            </div>

            <!-- Provider Badge -->
            <div class="bg-[#1b263b]/90 backdrop-blur p-6 rounded-2xl shadow-xl shrink-0 border border-white/15 max-w-sm space-y-2">
                <div class="font-metric text-xs text-[#ffdea6] uppercase font-bold tracking-wider">Proveedor / Razón Social</div>
                <div class="font-headline text-lg font-bold text-white">{{ $companyName }}</div>
                <div class="font-metric text-xs text-slate-300">RUC: <span class="text-white font-bold">{{ $companyRuc }}</span></div>
                <div class="font-body text-xs text-slate-300">{{ $companyAddress }}</div>
            </div>
        </div>
    </div>
</section>

<!-- Content & Form Section -->
<section class="max-w-[1440px] mx-auto w-full px-4 sm:px-6 lg:px-12 py-12 font-body">

    <!-- INDECOPI Connection & Consumer Guidance Bar -->
    <div class="mb-10 bg-slate-50 border border-slate-200 rounded-2xl p-6 sm:p-8 space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-200 pb-5">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-[#051125] text-[#ffdea6] flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[26px]">account_balance</span>
                </div>
                <div>
                    <h3 class="font-headline text-base sm:text-lg font-bold text-[#051125]">Atención al Consumidor &amp; Normativa INDECOPI</h3>
                    <p class="text-xs text-slate-600">Conoce tus derechos como consumidor y los canales oficiales del Estado Peruano.</p>
                </div>
            </div>
            <div>
                <a href="https://enlinea.indecopi.gob.pe/reclamavirtual/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-metric text-xs font-semibold shadow-sm transition-all">
                    <span class="material-symbols-outlined text-[16px] text-[#ffdea6]">open_in_new</span>
                    <span>Portal Reclama Virtual INDECOPI</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs text-slate-700">
            <!-- 1. Plazo Legal -->
            <div class="space-y-1.5 p-4 bg-white rounded-xl border border-slate-200">
                <div class="flex items-center gap-1.5 font-bold text-[#051125] uppercase font-metric">
                    <span class="material-symbols-outlined text-blue-600 text-[18px]">timer</span>
                    <span>Plazo Máximo de Respuesta</span>
                </div>
                <p class="text-slate-600 leading-relaxed">
                    La empresa dará respuesta formal a su reclamo o queja en un plazo <strong>no mayor a 15 días hábiles</strong> mediante correo electrónico o comunicación escrita.
                </p>
            </div>

            <!-- 2. Diferencia Reclamo / Queja -->
            <div class="space-y-1.5 p-4 bg-white rounded-xl border border-slate-200">
                <div class="flex items-center gap-1.5 font-bold text-[#051125] uppercase font-metric">
                    <span class="material-symbols-outlined text-amber-600 text-[18px]">help_outline</span>
                    <span>¿Reclamo o Queja?</span>
                </div>
                <p class="text-slate-600 leading-relaxed">
                    <strong>Reclamo:</strong> Disconformidad relacionada a los productos o servicios adquiridos.<br>
                    <strong>Queja:</strong> Malestar o descontento respecto a la atención al público brindada.
                </p>
            </div>

            <!-- 3. Canales Indecopi -->
            <div class="space-y-1.5 p-4 bg-white rounded-xl border border-slate-200">
                <div class="flex items-center gap-1.5 font-bold text-[#051125] uppercase font-metric">
                    <span class="material-symbols-outlined text-emerald-600 text-[18px]">support_agent</span>
                    <span>SAC INDECOPI Oficial</span>
                </div>
                <p class="text-slate-600 leading-relaxed">
                    Teléfonos: <strong>(01) 224-7777</strong> (Lima) / <strong>0 800-4-4040</strong> (Línea gratuita regiones).<br>
                    Correo: <strong class="text-blue-700">sacreclamo@indecopi.gob.pe</strong>
                </p>
            </div>
        </div>
    </div>

    <!-- Main Complaint Form -->
    <div class="bg-white rounded-2xl p-6 sm:p-10 shadow-lg border border-slate-200">
        
        <div class="border-b border-slate-200 pb-5 mb-8">
            <span class="font-metric text-xs uppercase font-bold text-[#B39255] tracking-wider">Formato Oficial Aprobado</span>
            <h2 class="font-headline text-2xl sm:text-3xl font-bold text-[#051125] mt-1">Hoja de Reclamación Virtual</h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Completa los siguientes campos obligatorios para generar tu código de seguimiento correlativo y constancia digital.
            </p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-300 text-red-800 p-4 rounded-xl mb-6 text-xs sm:text-sm">
                <div class="font-bold mb-1 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-red-600 text-[18px]">error</span>
                    <span>Por favor corrige los siguientes campos:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 text-slate-700">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('libro_reclamaciones.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- 1. Identificación del Consumidor Reclamante -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-200">
                    <span class="w-6 h-6 rounded-full bg-[#051125] text-white font-metric text-xs font-bold flex items-center justify-center">1</span>
                    <h3 class="font-headline text-base sm:text-lg font-bold text-[#051125] uppercase tracking-tight">
                        Identificación del Consumidor Reclamante
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="sm:col-span-2 lg:col-span-1">
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Nombres y Apellidos Completos *</label>
                        <input type="text" name="full_name" required value="{{ old('full_name') }}" class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm" placeholder="Ej. Juan Pérez Ramos">
                    </div>

                    <div>
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Tipo de Documento *</label>
                        <select name="doc_type" required class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm bg-white">
                            <option value="DNI" {{ old('doc_type') == 'DNI' ? 'selected' : '' }}>DNI - Documento Nacional de Identidad</option>
                            <option value="CE" {{ old('doc_type') == 'CE' ? 'selected' : '' }}>Carné de Extranjería</option>
                            <option value="RUC" {{ old('doc_type') == 'RUC' ? 'selected' : '' }}>RUC</option>
                            <option value="Pasaporte" {{ old('doc_type') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Número de Documento *</label>
                        <input type="text" name="doc_number" required value="{{ old('doc_number') }}" class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm font-metric" placeholder="Ej. 45678912">
                    </div>

                    <div>
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Teléfono / Celular de Contacto *</label>
                        <input type="tel" name="phone" required value="{{ old('phone') }}" class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm font-metric" placeholder="+51 987 654 321">
                    </div>

                    <div>
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Correo Electrónico (Para envío de constancia) *</label>
                        <input type="email" name="email" required value="{{ old('email') }}" class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm" placeholder="juan.perez@empresa.com">
                    </div>

                    <div>
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Departamento / Provincia / Distrito</label>
                        <input type="text" name="department" value="{{ old('department') }}" class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm" placeholder="Ej. Lima, Lima, El Agustino">
                    </div>

                    <div class="sm:col-span-2 lg:col-span-3">
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Domicilio / Dirección Completa *</label>
                        <input type="text" name="address" required value="{{ old('address') }}" class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm" placeholder="Av. Principal 123, Urb. Los Robles">
                    </div>
                </div>

                <!-- Minor Checkbox -->
                <div class="pt-2">
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_minor" id="isMinorCheckbox" value="1" onchange="toggleGuardianFields(this)" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 w-4 h-4">
                        <span class="text-xs text-slate-700 font-semibold">El reclamante es menor de edad (Marcar para ingresar datos del padre o apoderado)</span>
                    </label>
                </div>

                <div id="guardianFields" class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 hidden p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <div>
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Nombre Completo del Padre / Apoderado</label>
                        <input type="text" name="guardian_name" value="{{ old('guardian_name') }}" class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 outline-none text-xs sm:text-sm" placeholder="Nombre del apoderado">
                    </div>
                    <div>
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">DNI / Documento del Padre / Apoderado</label>
                        <input type="text" name="guardian_doc" value="{{ old('guardian_doc') }}" class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 outline-none text-xs sm:text-sm font-metric" placeholder="N° de documento">
                    </div>
                </div>
            </div>

            <!-- 2. Identificación del Bien Contratado -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-200">
                    <span class="w-6 h-6 rounded-full bg-[#051125] text-white font-metric text-xs font-bold flex items-center justify-center">2</span>
                    <h3 class="font-headline text-base sm:text-lg font-bold text-[#051125] uppercase tracking-tight">
                        Identificación del Bien Contratado
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Tipo de Bien *</label>
                        <div class="flex items-center gap-4 h-11 px-3.5 rounded-lg border border-slate-200 bg-slate-50">
                            <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-slate-700">
                                <input type="radio" name="contracted_type" value="producto" {{ old('contracted_type', 'producto') == 'producto' ? 'checked' : '' }} class="text-blue-600">
                                <span>Producto</span>
                            </label>
                            <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-slate-700">
                                <input type="radio" name="contracted_type" value="servicio" {{ old('contracted_type') == 'servicio' ? 'checked' : '' }} class="text-blue-600">
                                <span>Servicio</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Moneda del Monto</label>
                        <select name="currency" class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 outline-none text-xs sm:text-sm bg-white">
                            <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>Dólares Americanos (USD $)</option>
                            <option value="PEN" {{ old('currency') == 'PEN' ? 'selected' : '' }}>Soles Peruanos (PEN S/)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Monto Reclamado (Opcional)</label>
                        <input type="number" step="0.01" name="claimed_amount" value="{{ old('claimed_amount') }}" class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 outline-none text-xs sm:text-sm font-metric" placeholder="0.00">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Descripción del Producto o Servicio Contratado *</label>
                        <input type="text" name="product_description" required value="{{ old('product_description') }}" class="w-full h-11 px-3.5 rounded-lg border border-slate-200 focus:border-blue-600 outline-none text-xs sm:text-sm" placeholder="Ej. Camión Eléctrico JMEV EV-2 / Furgón Facchini 3 Ejes / Servicio de Mantenimiento Postventa...">
                    </div>
                </div>
            </div>

            <!-- 3. Detalle de la Reclamación -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-200">
                    <span class="w-6 h-6 rounded-full bg-[#051125] text-white font-metric text-xs font-bold flex items-center justify-center">3</span>
                    <h3 class="font-headline text-base sm:text-lg font-bold text-[#051125] uppercase tracking-tight">
                        Detalle de la Reclamación
                    </h3>
                </div>

                <div>
                    <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-2">Selecciona el Tipo de Reclamación *</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="p-4 rounded-xl border-2 cursor-pointer transition-all flex items-start gap-3 hover:border-blue-500 bg-slate-50" id="labelReclamo">
                            <input type="radio" name="claim_type" value="reclamo" {{ old('claim_type', 'reclamo') == 'reclamo' ? 'checked' : '' }} class="mt-1 text-blue-600" onchange="highlightType(this)">
                            <div>
                                <span class="font-headline text-sm font-bold text-[#051125] block uppercase">Reclamo</span>
                                <span class="text-xs text-slate-600 block mt-0.5">Disconformidad relacionada a los productos o servicios adquiridos.</span>
                            </div>
                        </label>
                        <label class="p-4 rounded-xl border-2 cursor-pointer transition-all flex items-start gap-3 hover:border-blue-500 bg-slate-50" id="labelQueja">
                            <input type="radio" name="claim_type" value="queja" {{ old('claim_type') == 'queja' ? 'checked' : '' }} class="mt-1 text-blue-600" onchange="highlightType(this)">
                            <div>
                                <span class="font-headline text-sm font-bold text-[#051125] block uppercase">Queja</span>
                                <span class="text-xs text-slate-600 block mt-0.5">Malestar o descontento respecto a la atención al público brindada.</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Detalle y Hechos Materia del Reclamo o Queja *</label>
                    <textarea name="details" rows="4" required class="w-full p-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm" placeholder="Explique de manera detallada lo ocurrido, fechas, circunstancias y cualquier dato relevante...">{{ old('details') }}</textarea>
                </div>

                <div>
                    <label class="block font-metric text-xs uppercase text-[#051125] font-semibold mb-1">Pedido Concreto del Consumidor *</label>
                    <textarea name="consumer_request" rows="2" required class="w-full p-3.5 rounded-lg border border-slate-200 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none text-xs sm:text-sm" placeholder="Especifique qué solución o acción solicita por parte de RODOPERU S.A.C...">{{ old('consumer_request') }}</textarea>
                </div>
            </div>

            <!-- Declaración Jurada y Términos -->
            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 space-y-3">
                <label class="inline-flex items-start gap-2.5 cursor-pointer">
                    <input type="checkbox" name="terms_accepted" value="1" required class="mt-0.5 rounded border-slate-300 text-blue-600 focus:ring-blue-500 w-4 h-4">
                    <span class="text-xs text-slate-700 leading-relaxed">
                        Declaro bajo juramento que los datos consignados en la presente Hoja de Reclamación son verdaderos y fidedignos, de acuerdo a lo dispuesto por la <strong>Ley N° 29571</strong> y el <strong>D.S. N° 011-2011-PCM</strong>. Acepto recibir la respuesta formal a través del correo electrónico proporcionado.
                    </span>
                </label>
            </div>

            <!-- Botón de Envío -->
            <div class="text-center pt-2">
                <button type="submit" class="w-full sm:w-auto px-10 py-4 rounded-xl bg-[#051125] hover:bg-[#1b263b] text-white font-headline text-sm font-bold flex items-center justify-center gap-2 shadow-lg transition-all mx-auto">
                    <span class="material-symbols-outlined text-[20px] text-[#ffdea6]">send</span>
                    <span>Registrar Hoja de Reclamación &amp; Emitir Constancia</span>
                </button>
                <p class="text-slate-500 font-metric text-[11px] mt-2">
                    Al enviar, se generará tu código correlativo oficial y recibirás una copia en PDF por correo electrónico.
                </p>
            </div>
        </form>

    </div>

</section>

<script>
function toggleGuardianFields(checkbox) {
    const fields = document.getElementById('guardianFields');
    if (checkbox.checked) {
        fields.classList.remove('hidden');
    } else {
        fields.classList.add('hidden');
    }
}

function highlightType(radio) {
    const labelR = document.getElementById('labelReclamo');
    const labelQ = document.getElementById('labelQueja');
    if (radio.value === 'reclamo') {
        labelR.classList.add('border-blue-600', 'bg-blue-50/50');
        labelQ.classList.remove('border-blue-600', 'bg-blue-50/50');
    } else {
        labelQ.classList.add('border-blue-600', 'bg-blue-50/50');
        labelR.classList.remove('border-blue-600', 'bg-blue-50/50');
    }
}
</script>

@endsection
