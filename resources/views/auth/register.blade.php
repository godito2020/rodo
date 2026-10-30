@extends('layouts.app')

@section('title', 'Registro de Cuenta Corporativa | RODOPERU')

@section('content')

<!-- Masthead Breadcrumb & Title -->
<section class="w-full bg-[#051125] text-white py-10 px-4 sm:px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-[1440px] mx-auto text-center">
        <h1 class="font-headline text-2xl sm:text-3xl font-bold tracking-tight text-white flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[#ffdea6]">person_add</span>
            <span>Registro de Cliente Corporativo</span>
        </h1>
        <p class="text-xs sm:text-sm text-slate-400 mt-1">
            Crea tu cuenta empresarial para gestionar solicitudes de flota, cotizaciones técnicas y seguimiento de unidades.
        </p>
    </div>
</section>

<section class="max-w-[680px] mx-auto px-4 py-12 font-body">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-lg p-6 sm:p-8 space-y-6">
        <div class="text-center space-y-2">
            <img src="{{ asset(\App\Models\Setting::get('logo_path', 'images/logo/RODO.png')) }}" alt="RODOPERU" class="h-10 mx-auto object-contain">
            <h2 class="font-headline text-xl font-bold text-[#051125]">Crear Cuenta en RODOPERU</h2>
            <p class="text-xs text-slate-500">Completa la ficha técnica para habilitar tu acceso al portal</p>
        </div>

        @if($errors->any())
            <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-xs text-red-700 space-y-1">
                @foreach($errors->all() as $error)
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">error</span>
                        <span>{{ $error }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block font-metric text-xs font-semibold text-slate-700">Nombre Completo *</label>
                    <input type="text" name="name" required value="{{ old('name') }}" placeholder="Ej: Ing. Carlos Valdivia" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-body text-slate-900 bg-slate-50/50">
                </div>

                <div class="space-y-1.5">
                    <label class="block font-metric text-xs font-semibold text-slate-700">Correo Electrónico Corporativo *</label>
                    <input type="email" name="email" required value="{{ old('email') }}" placeholder="gerencia@tuempresa.pe" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-body text-slate-900 bg-slate-50/50">
                </div>

                <div class="space-y-1.5">
                    <label class="block font-metric text-xs font-semibold text-slate-700">Contraseña * (Mínimo 8 caracteres)</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-body text-slate-900 bg-slate-50/50">
                </div>

                <div class="space-y-1.5">
                    <label class="block font-metric text-xs font-semibold text-slate-700">Confirmar Contraseña *</label>
                    <input type="password" name="password_confirmation" required placeholder="••••••••" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-body text-slate-900 bg-slate-50/50">
                </div>

                <div class="space-y-1.5">
                    <label class="block font-metric text-xs font-semibold text-slate-700">Teléfono / WhatsApp *</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+51 987 654 321" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-metric text-slate-900 bg-slate-50/50">
                </div>

                <div class="space-y-1.5">
                    <label class="block font-metric text-xs font-semibold text-slate-700">RUC o DNI (para Facturación)</label>
                    <input type="text" name="dni_ruc" value="{{ old('dni_ruc') }}" placeholder="20601234567" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-metric text-slate-900 bg-slate-50/50">
                </div>

                <div class="sm:col-span-2 space-y-1.5">
                    <label class="block font-metric text-xs font-semibold text-slate-700">Razón Social / Nombre Comercial (Opcional)</label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="Ej: Transportes y Carga Minera S.A.C." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-body text-slate-900 bg-slate-50/50">
                </div>

                <div class="sm:col-span-2 space-y-1.5">
                    <label class="block font-metric text-xs font-semibold text-slate-700">Dirección o Almacén Principal</label>
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Av. Carretera Central Km 10" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-body text-slate-900 bg-slate-50/50">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-[#051125] hover:bg-[#1b263b] text-[#ffdea6] font-headline text-sm font-bold tracking-wide flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transition-all mt-4">
                <span>Registrar Cuenta Corporativa</span>
                <span class="material-symbols-outlined text-[18px]">how_to_reg</span>
            </button>

            <div class="text-center pt-3 border-t border-slate-200">
                <span class="text-xs text-slate-500">¿Ya tienes una cuenta activa?</span>
                <a href="{{ route('login') }}" class="font-metric text-xs font-bold text-blue-700 hover:text-blue-900 ml-1">
                    Iniciar sesión aquí
                </a>
            </div>
        </form>
    </div>
</section>

@endsection
