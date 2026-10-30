@extends('layouts.app')

@section('title', 'Iniciar Sesión Corporativa | RODOPERU')

@section('content')

<!-- Masthead Breadcrumb & Title -->
<section class="w-full bg-[#051125] text-white py-10 px-4 sm:px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-[1440px] mx-auto text-center">
        <h1 class="font-headline text-2xl sm:text-3xl font-bold tracking-tight text-white flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[#ffdea6]">lock</span>
            <span>Portal de Clientes &amp; Flotas</span>
        </h1>
        <p class="text-xs sm:text-sm text-slate-400 mt-1">
            Accede a tu panel para consultar cotizaciones formales, pedidos y estado de entrega.
        </p>
    </div>
</section>

<section class="max-w-[480px] mx-auto px-4 py-12 font-body">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-lg p-6 sm:p-8 space-y-6">
        <div class="text-center space-y-2">
            <img src="{{ asset(\App\Models\Setting::get('logo_path', 'images/logo/RODO.png')) }}" alt="RODOPERU" class="h-10 mx-auto object-contain">
            <h2 class="font-headline text-xl font-bold text-[#051125]">Ingresar a mi Cuenta</h2>
            <p class="text-xs text-slate-500">Ingresa tus credenciales corporativas autorizadas</p>
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

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label class="block font-metric text-xs font-semibold text-slate-700">Correo Electrónico Corporativo</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-3 text-slate-400 text-[18px]">mail</span>
                    <input type="email" name="email" required placeholder="tu-correo@empresa.com" value="{{ old('email') }}" class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-body text-slate-900 bg-slate-50/50">
                </div>
            </div>

            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <label class="block font-metric text-xs font-semibold text-slate-700">Contraseña</label>
                    <a href="{{ route('password.request') }}" class="font-metric text-xs text-blue-700 hover:text-blue-900">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-3 text-slate-400 text-[18px]">key</span>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent font-body text-slate-900 bg-slate-50/50">
                </div>
            </div>

            <div class="flex items-center">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded text-blue-600 focus:ring-blue-500">
                    <span class="font-metric text-xs text-slate-600">Recordar mi sesión en este navegador</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-[#051125] hover:bg-[#1b263b] text-[#ffdea6] font-headline text-sm font-bold tracking-wide flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transition-all">
                <span>Ingresar al Portal</span>
                <span class="material-symbols-outlined text-[18px]">login</span>
            </button>

            <div class="text-center pt-3 border-t border-slate-200">
                <span class="text-xs text-slate-500">¿Aún no tienes cuenta registrada?</span>
                <a href="{{ route('register') }}" class="font-metric text-xs font-bold text-blue-700 hover:text-blue-900 ml-1">
                    Crear cuenta gratis
                </a>
            </div>
        </form>
    </div>
</section>

@endsection
