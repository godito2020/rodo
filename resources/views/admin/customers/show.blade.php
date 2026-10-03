@extends('layouts.admin')

@section('title', 'Perfil de Cliente: ' . $customer->name)
@section('page_title', 'Detalle y Expediente del Cliente')

@php
    $currency = \App\Models\Setting::get('currency_symbol', 'USD $');
@endphp

@section('content')
<div class="row g-4">
    <!-- Left: Customer info -->
    <div class="col-lg-4">
        <div class="card-custom p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-white fw-bold mb-0">Datos del Cliente</h5>
                <span class="badge {{ $customer->is_active ? 'bg-success' : 'bg-danger' }}">
                    {{ $customer->is_active ? 'Activo' : 'Bloqueado' }}
                </span>
            </div>

            <div class="text-center p-3 bg-dark rounded border border-dark mb-4">
                <div class="p-3 rounded-circle bg-secondary d-inline-block text-white fs-3 mb-2">
                    <i class="fas fa-user"></i>
                </div>
                <h5 class="text-white fw-bold mb-1">{{ $customer->name }}</h5>
                <small class="text-info">{{ $customer->company_name ?: 'Cliente Particular' }}</small>
            </div>

            <p class="mb-2"><strong class="text-info">Email:</strong> <span class="text-white">{{ $customer->email }}</span></p>
            <p class="mb-2"><strong class="text-info">Teléfono:</strong> <span class="text-white">{{ $customer->phone ?: 'No registrado' }}</span></p>
            <p class="mb-2"><strong class="text-info">DNI/RUC:</strong> <span class="text-white font-monospace">{{ $customer->dni_ruc ?: 'No registrado' }}</span></p>
            <p class="mb-2"><strong class="text-info">Dirección:</strong> <span class="text-white">{{ $customer->address ?: 'No registrada' }}</span></p>
            <p class="mb-3"><strong class="text-info">Ciudad:</strong> <span class="text-white">{{ $customer->city ?: 'Lima' }}</span></p>
            <p class="mb-3"><strong class="text-info">Registrado el:</strong> <span class="text-muted small">{{ $customer->created_at->format('d/m/Y H:i') }}</span></p>

            <div class="d-flex flex-column gap-2 pt-3 border-top border-secondary">
                <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $customer->phone) }}" target="_blank" class="btn btn-whatsapp-quote btn-sm">
                    <i class="fab fa-whatsapp me-1"></i> Enviar Mensaje WhatsApp
                </a>
                <form action="{{ route('admin.customers.toggle_block', $customer->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm w-100 {{ $customer->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}">
                        <i class="fas {{ $customer->is_active ? 'fa-ban' : 'fa-check' }} me-1"></i>
                        {{ $customer->is_active ? 'Bloquear Acceso del Cliente' : 'Desbloquear Acceso' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Right: Customer Orders & Chat History -->
    <div class="col-lg-8">
        <!-- Customer Orders Table -->
        <div class="card-custom mb-4">
            <div class="card-header">
                <span class="text-white"><i class="fas fa-boxes text-info me-2"></i> Historial de Pedidos Realizados ({{ $customer->orders->count() }})</span>
            </div>
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th>N° Pedido</th>
                            <th>Fecha</th>
                            <th>Artículos</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Pago</th>
                            <th class="text-end">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customer->orders as $ord)
                            <tr>
                                <td class="font-monospace fw-bold text-info">{{ $ord->order_number }}</td>
                                <td class="text-muted small">{{ $ord->created_at->format('d/m/Y') }}</td>
                                <td>{{ $ord->items->count() }} unidad(es)</td>
                                <td class="text-white fw-bold">{{ $currency }} {{ number_format($ord->total, 2) }}</td>
                                <td>{!! $ord->status_badge !!}</td>
                                <td>{!! $ord->payment_badge !!}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.orders.show', $ord->id) }}" class="btn btn-sm btn-outline-info">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Este cliente no ha realizado pedidos aún.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Customer Chats Table -->
        <div class="card-custom">
            <div class="card-header">
                <span class="text-white"><i class="fas fa-comments text-info me-2"></i> Consultas & Chats con Vendedores</span>
            </div>
            <div class="p-3">
                @forelse($customer->chatConversations as $ch)
                    <div class="d-flex justify-content-between align-items-center p-3 rounded bg-dark border border-secondary mb-2">
                        <div>
                            <div class="text-white fw-bold">{{ $ch->subject }}</div>
                            <small class="text-muted">{{ $ch->last_message_at ? $ch->last_message_at->diffForHumans() : '' }}</small>
                        </div>
                        <a href="{{ route('admin.chats.show', $ch->id) }}" class="btn btn-sm btn-outline-info">
                            Abrir Conversación
                        </a>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">No hay consultas de chat registradas con este cliente.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
