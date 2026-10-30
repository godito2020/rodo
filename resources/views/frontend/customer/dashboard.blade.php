@extends('layouts.app')

@section('title', 'Mi Portal Corporativo | RODOPERU')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
@endphp

@section('content')

<!-- Masthead Breadcrumb & Header -->
<section class="w-full bg-[#051125] text-white py-10 px-4 sm:px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-[1440px] mx-auto">
        <nav class="flex items-center gap-2 font-metric text-xs text-slate-400 mb-3" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#ffdea6] transition-colors">Inicio</a>
            <span>/</span>
            <span class="text-[#ffdea6]">Panel de Cliente</span>
        </nav>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="font-headline text-2xl sm:text-3xl font-bold tracking-tight text-white flex items-center gap-3">
                    <span class="material-symbols-outlined text-3xl text-[#ffdea6]">manage_accounts</span>
                    <span>Bienvenido, {{ $user->name }}</span>
                </h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1">
                    {{ $user->email }} &bull; {{ $user->company_name ?: 'Cliente Corporativo' }} &bull; RUC/DNI: {{ $user->dni_ruc ?: 'No registrado' }}
                </p>
            </div>
            <a href="{{ route('products.index') }}" class="px-5 py-2.5 rounded-xl bg-[#1b263b] hover:bg-slate-800 text-slate-200 border border-slate-700 font-metric text-xs font-bold flex items-center gap-2 shrink-0 transition-colors">
                <span class="material-symbols-outlined text-[16px]">add_shopping_cart</span>
                <span>Explorar Equipos</span>
            </a>
        </div>
    </div>
</section>

<!-- Main Portal Body -->
<section class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 py-10 font-body">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Sidebar (3 cols) -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 space-y-1 font-headline font-bold text-xs">
                <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#051125] text-[#ffdea6] shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">dashboard</span>
                    <span>Resumen General</span>
                </a>
                <a href="{{ route('customer.orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-[#051125] transition-colors">
                    <span class="material-symbols-outlined text-[18px] text-slate-400">package_2</span>
                    <span>Mis Pedidos &amp; Adjudicaciones</span>
                </a>
                <a href="{{ route('customer.chats') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-[#051125] transition-colors">
                    <span class="material-symbols-outlined text-[18px] text-slate-400">forum</span>
                    <span>Consultas Técnicas &amp; Chats</span>
                </a>
                <a href="{{ route('customer.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-[#051125] transition-colors">
                    <span class="material-symbols-outlined text-[18px] text-slate-400">badge</span>
                    <span>Datos de Perfil &amp; Facturación</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="pt-2 border-t border-slate-100">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 transition-colors text-left">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                        <span>Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content Area (9 cols) -->
        <div class="lg:col-span-9 space-y-8">
            
            <!-- Quick Metrics Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm text-center">
                    <span class="material-symbols-outlined text-2xl text-blue-700 mb-1">orders</span>
                    <div class="font-metric text-2xl sm:text-3xl font-bold text-[#051125]">{{ $totalOrders }}</div>
                    <span class="font-metric text-[11px] text-slate-500 uppercase tracking-wider block mt-1">Total Pedidos</span>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm text-center">
                    <span class="material-symbols-outlined text-2xl text-amber-600 mb-1">hourglass_top</span>
                    <div class="font-metric text-2xl sm:text-3xl font-bold text-amber-600">{{ $pendingOrders }}</div>
                    <span class="font-metric text-[11px] text-slate-500 uppercase tracking-wider block mt-1">En Trámite</span>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm text-center">
                    <span class="material-symbols-outlined text-2xl text-emerald-600 mb-1">task_alt</span>
                    <div class="font-metric text-2xl sm:text-3xl font-bold text-emerald-600">{{ $completedOrders }}</div>
                    <span class="font-metric text-[11px] text-slate-500 uppercase tracking-wider block mt-1">Entregados</span>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm text-center">
                    <span class="material-symbols-outlined text-2xl text-purple-600 mb-1">chat</span>
                    <div class="font-metric text-2xl sm:text-3xl font-bold text-purple-600">{{ $totalChats }}</div>
                    <span class="font-metric text-[11px] text-slate-500 uppercase tracking-wider block mt-1">Consultas</span>
                </div>
            </div>

            <!-- Recent Orders Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                    <h2 class="font-headline font-bold text-sm text-[#051125] uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-blue-700">history</span>
                        <span>Pedidos &amp; Adjudicaciones Recientes</span>
                    </h2>
                    <a href="{{ route('customer.orders') }}" class="font-metric text-xs font-bold text-blue-700 hover:text-blue-900">
                        Ver Todos &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left font-body text-xs">
                        <thead class="bg-slate-100 text-slate-700 font-metric text-[11px] uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-3">N° Pedido</th>
                                <th class="px-6 py-3">Fecha</th>
                                <th class="px-6 py-3">Total</th>
                                <th class="px-6 py-3">Estado</th>
                                <th class="px-6 py-3">Pago</th>
                                <th class="px-6 py-3 text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-metric">
                            @forelse($recentOrders as $ord)
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="px-6 py-4 font-bold text-blue-700">{{ $ord->order_number }}</td>
                                    <td class="px-6 py-4 text-slate-500">{{ $ord->created_at?->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 font-bold text-[#051125]">{{ $currency }} {{ number_format($ord->total, 2) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-800 border border-slate-300">
                                            {{ strtoupper($ord->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-800 border border-blue-200">
                                            {{ strtoupper($ord->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('customer.order_detail', $ord->order_number) }}" class="px-3 py-1 rounded-lg border border-slate-300 hover:bg-[#051125] hover:text-[#ffdea6] font-bold transition-colors">
                                            Ver Detalle
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                                        No tienes pedidos registrados todavía.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Chats Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                    <h2 class="font-headline font-bold text-sm text-[#051125] uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-purple-700">forum</span>
                        <span>Conversaciones Técnicas con Asesores</span>
                    </h2>
                    <a href="{{ route('customer.chats') }}" class="font-metric text-xs font-bold text-blue-700 hover:text-blue-900">
                        Ver Todos &rarr;
                    </a>
                </div>

                <div class="p-6 divide-y divide-slate-100">
                    @forelse($recentChats as $ch)
                        <a href="{{ route('customer.chat_show', $ch->id) }}" class="py-3 first:pt-0 last:pb-0 flex items-center justify-between gap-4 group block">
                            <div>
                                <h3 class="font-headline font-bold text-sm text-[#051125] group-hover:text-blue-700 transition-colors">
                                    {{ $ch->subject }}
                                </h3>
                                <p class="text-xs text-slate-500 line-clamp-1 mt-0.5">
                                    {{ $ch->latestMessage ? Str::limit($ch->latestMessage->message, 90) : 'Sin mensajes aún' }}
                                </p>
                            </div>
                            <div class="text-right shrink-0">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-metric font-bold {{ $ch->status === 'open' ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-slate-100 text-slate-600' }}">
                                    {{ ucfirst($ch->status) }}
                                </span>
                                <span class="block font-metric text-[10px] text-slate-400 mt-1">
                                    {{ $ch->last_message_at ? $ch->last_message_at->diffForHumans() : '' }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-6 text-slate-400 text-xs">
                            No tienes consultas activas en este momento.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
