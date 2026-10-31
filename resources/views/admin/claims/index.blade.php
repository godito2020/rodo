@extends('layouts.admin')

@section('title', 'Libro de Reclamaciones')
@section('page_title', 'Gestión de Reclamaciones (Normativa INDECOPI)')

@section('content')
<!-- Metric Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card-custom p-3 border-danger">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small font-metric text-uppercase">Reclamos Pendientes</span>
                    <h3 class="mb-0 text-danger fw-bold font-headline mt-1">{{ $pendingCount }}</h3>
                    <small class="text-muted font-metric">En plazo de 15 días hábiles</small>
                </div>
                <div class="p-3 rounded-3 bg-danger bg-opacity-10 text-danger">
                    <span class="material-symbols-outlined text-[28px]">pending_actions</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card-custom p-3 border-warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small font-metric text-uppercase">En Evaluación</span>
                    <h3 class="mb-0 text-warning fw-bold font-headline mt-1">{{ $inProcessCount }}</h3>
                    <small class="text-muted font-metric">Revisión técnica o legal</small>
                </div>
                <div class="p-3 rounded-3 bg-warning bg-opacity-10 text-warning">
                    <span class="material-symbols-outlined text-[28px]">hourglass_top</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card-custom p-3 border-success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small font-metric text-uppercase">Atendidos / Resueltos</span>
                    <h3 class="mb-0 text-success fw-bold font-headline mt-1">{{ $resolvedCount }}</h3>
                    <small class="text-muted font-metric">Respuesta enviada formalmente</small>
                </div>
                <div class="p-3 rounded-3 bg-success bg-opacity-10 text-success">
                    <span class="material-symbols-outlined text-[28px]">task_alt</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Table Card -->
<div class="card-custom">
    <!-- Header & Filter Form -->
    <div class="card-header border-bottom border-secondary p-3">
        <form action="{{ route('admin.claims.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-dark border-secondary text-muted"><i class="fas fa-search"></i></span>
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Buscar por código, cliente o DNI...">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Todos los Estados --</option>
                    <option value="pendiente" {{ request('status') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="en_proceso" {{ request('status') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                    <option value="atendido" {{ request('status') == 'atendido' ? 'selected' : '' }}>Atendido</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="claim_type" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Tipo (Reclamo / Queja) --</option>
                    <option value="reclamo" {{ request('claim_type') == 'reclamo' ? 'selected' : '' }}>Reclamos (Producto/Servicio)</option>
                    <option value="queja" {{ request('claim_type') == 'queja' ? 'selected' : '' }}>Quejas (Atención)</option>
                </select>
            </div>
            <div class="col-md-2 text-end">
                <a href="{{ route('admin.claims.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="fas fa-undo me-1"></i> Limpiar
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr>
                    <th>N° Correlativo</th>
                    <th>Consumidor</th>
                    <th>Tipo</th>
                    <th>Bien Contratado</th>
                    <th>Fecha Registro</th>
                    <th>Plazo Legal (15 d.h.)</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($claims as $claim)
                    <tr>
                        <td>
                            <span class="font-metric fw-bold text-warning">{{ $claim->claim_number }}</span>
                        </td>
                        <td>
                            <div class="fw-bold text-white">{{ $claim->full_name }}</div>
                            <small class="font-metric text-muted">{{ $claim->doc_type }}: {{ $claim->doc_number }} &bull; {{ $claim->phone }}</small>
                        </td>
                        <td>
                            @if($claim->claim_type === 'reclamo')
                                <span class="badge bg-danger text-white font-metric">RECLAMO</span>
                            @else
                                <span class="badge bg-warning text-dark font-metric">QUEJA</span>
                            @endif
                        </td>
                        <td>
                            <div class="text-white text-truncate" style="max-width: 200px;" title="{{ $claim->product_description }}">
                                {{ $claim->product_description }}
                            </div>
                            <small class="text-muted font-metric">{{ ucfirst($claim->contracted_type) }}</small>
                        </td>
                        <td>
                            <div class="font-metric text-white">{{ $claim->created_at->format('d/m/Y') }}</div>
                            <small class="font-metric text-muted">{{ $claim->created_at->format('H:i') }}</small>
                        </td>
                        <td>
                            @if($claim->status === 'atendido')
                                <span class="badge bg-success font-metric">RESUELTO</span>
                            @else
                                @php $days = $claim->days_remaining; @endphp
                                @if($days < 0)
                                    <span class="badge bg-danger font-metric">VENCIDO ({{ abs($days) }} d.)</span>
                                @elseif($days <= 3)
                                    <span class="badge bg-danger font-metric">URGENTE: {{ $days }} días</span>
                                @else
                                    <span class="badge bg-info text-dark font-metric">{{ $days }} días restantes</span>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($claim->status === 'pendiente')
                                <span class="badge bg-danger font-metric">Pendiente</span>
                            @elseif($claim->status === 'en_proceso')
                                <span class="badge bg-warning text-dark font-metric">En Proceso</span>
                            @else
                                <span class="badge bg-success font-metric">Atendido</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.claims.show', $claim->id) }}" class="btn btn-sm btn-outline-info me-1" title="Ver detalle y responder">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.claims.print', $claim->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="Imprimir hoja oficial">
                                <i class="fas fa-print"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <span class="material-symbols-outlined text-[48px] text-secondary mb-2 d-block">inventory</span>
                            No se encontraron reclamaciones registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($claims->hasPages())
        <div class="p-3 border-top border-secondary d-flex justify-content-end">
            {{ $claims->links() }}
        </div>
    @endif
</div>
@endsection
