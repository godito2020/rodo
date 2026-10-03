@extends('layouts.admin')

@section('title', 'Mensajes & Cotizaciones')
@section('page_title', 'Bandeja de Mensajes & Cotizaciones Web')

@section('content')
<div class="card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="text-white mb-0"><i class="fas fa-envelope text-info me-2"></i> Consultas Recibidas del Formulario Web</h5>
            <small class="text-muted">Total: {{ $inquiries->total() }} mensajes</small>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr>
                    <th>Remitente</th>
                    <th>Contacto</th>
                    <th>Producto de Interés</th>
                    <th>Asunto</th>
                    <th>Fecha</th>
                    <th class="text-center">Estado</th>
                    <th class="text-end">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inquiries as $inq)
                    <tr>
                        <td>
                            <div class="text-white fw-bold">{{ $inq->name }}</div>
                        </td>
                        <td>
                            <div class="small text-light">{{ $inq->email }}</div>
                            <small class="text-muted">{{ $inq->phone ?: 'Sin teléfono' }}</small>
                        </td>
                        <td>
                            <span class="badge bg-dark border border-info text-info">{{ $inq->product_interest ?: 'Consulta General' }}</span>
                        </td>
                        <td class="text-light small">
                            {{ $inq->subject ?: 'Sin asunto' }}
                        </td>
                        <td class="text-muted small">
                            {{ $inq->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $inq->is_read ? 'bg-secondary' : 'bg-info text-dark' }}">
                                {{ $inq->is_read ? 'Leído' : 'Nuevo' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('admin.inquiries.show', $inq->id) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.inquiries.destroy', $inq->id) }}" method="POST" onsubmit="return confirm('¿Eliminar mensaje?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">No hay mensajes o cotizaciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($inquiries->hasPages())
        <div class="p-3 border-top border-secondary d-flex justify-content-center">
            {{ $inquiries->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
