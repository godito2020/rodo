@extends('layouts.app')

@section('title', 'Recuperar Contraseña | RODOPERU')

@section('content')

<!-- Masthead Breadcrumb & Title -->
<section class="w-full bg-[#051125] text-white py-10 px-4 sm:px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-[1440px] mx-auto text-center">
        <h1 class="font-headline text-2xl sm:text-3xl font-bold tracking-tight text-white flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[#ffdea6]">lock_reset</span>
            <span>Restablecimiento de Credenciales</span>
        </h1>
        <p class="text-xs sm:text-sm text-slate-400 mt-1">
            Recupera el acceso a tu cuenta corporativa para continuar administrando tus cotizaciones.
        </p>
    </div>
</section>

<section class="max-w-[480px] mx-auto px-4 py-12 font-body">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-lg p-6 sm:p-8 space-y-6">
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mx-auto text-[#051125]">
                <span class="material-symbols-outlined text-2xl">key</span>
            </div>
            <h2 class="font-headline text-xl font-bold text-[#051125]">Recuperar Contraseña</h2>
            <p class="text-xs text-slate-500">Ingresa tu correo registrado para enviarte un enlace de recuperación seguro</p>
        </div>

        @if(session('status'))
            <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-[16px]">check_circle</span>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if(session('direct_link'))
            <div class="p-4 rounded-xl bg-blue-50 border border-blue-200 text-xs text-blue-900 space-y-2">
                <span class="font-metric font-bold block">Enlace de acceso directo generado:</span>
                <a href="{{ session('direct_link') }}" class="block text-center py-2 px-3 rounded-lg bg-[#051125] text-[#ffdea6] font-metric font-bold hover:bg-[#1b263b] transition-colors">
                    Hacer clic aquí para restablecer contraseña
                </a>
            </div>
        @endif

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

        <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label class="block font-metric text-xs font-semibold text-slate-700">Correo Electrónico Registrado</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-3 text-slate-400 text-[18px]">mail</span>
                    <input type="email" name="email" required placeholder="tu-correo@empresa.com" value="{{ old('email') }}" class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-body text-slate-900 bg-slate-50/50">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-[#051125] hover:bg-[#1b263b] text-[#ffdea6] font-headline text-sm font-bold tracking-wide flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transition-all">
                <span>Enviar Instrucciones</span>
                <span class="material-symbols-outlined text-[18px]">send</span>
            </button>

            <div class="text-center pt-3 border-t border-slate-200">
                <a href="{{ route('login') }}" class="font-metric text-xs text-slate-500 hover:text-blue-700 inline-flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">arrow_back</span>
                    <span>Volver al inicio de sesión</span>
                </a>
            </div>
        </form>
    </div>
</section>

@endsection
