@extends('layouts.admin')

@section('title', 'Analítica de Búsquedas')
@section('page_title', 'Historial & Análisis de Búsquedas de Clientes')

@section('content')
<!-- Header Filter & Period Selector -->
<div class="card-custom mb-4">
    <div class="p-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h5 class="text-white mb-0"><i class="fas fa-search-dollar text-success me-2"></i> Inteligencia Comercial de Búsquedas</h5>
            <small class="text-muted">Analiza la demanda de vehículos, implementos y términos que más interesan a los usuarios</small>
        </div>
        <div class="d-flex align-items-center gap-2">
            <label class="small text-muted text-nowrap mb-0">Periodo:</label>
            <select class="form-select form-select-sm bg-dark text-white border-secondary" onchange="window.location.href='{{ route('admin.analytics.searches') }}?periodo=' + this.value">
                <option value="7" {{ $days == 7 ? 'selected' : '' }}>Últimos 7 días</option>
                <option value="30" {{ $days == 30 ? 'selected' : '' }}>Últimos 30 días</option>
                <option value="90" {{ $days == 90 ? 'selected' : '' }}>Últimos 90 días</option>
                <option value="365" {{ $days == 365 ? 'selected' : '' }}>Último año</option>
            </select>
            <form action="{{ route('admin.analytics.clear') }}" method="POST" onsubmit="return confirm('¿Seguro que deseas vaciar todo el registro de búsquedas?')">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger text-nowrap" title="Vaciar registro">
                    <i class="fas fa-trash-alt me-1"></i> Vaciar Historial
                </button>
            </form>
        </div>
    </div>
</div>

<!-- KPI Indicators -->
<div class="row g-3 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="p-3 rounded-3 border border-secondary bg-dark text-center">
            <span class="text-muted small text-uppercase">Búsquedas Realizadas</span>
            <div class="display-6 fw-bold text-info my-1">{{ number_format($totalSearches) }}</div>
            <small class="text-light">En el periodo seleccionado</small>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="p-3 rounded-3 border border-secondary bg-dark text-center">
            <span class="text-muted small text-uppercase">Usuarios Únicos (IPs)</span>
            <div class="display-6 fw-bold text-success my-1">{{ number_format($uniqueUsers) }}</div>
            <small class="text-light">Interesados activos</small>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="p-3 rounded-3 border border-secondary bg-dark text-center">
            <span class="text-muted small text-uppercase">Palabras Clave Analizadas</span>
            <div class="display-6 fw-bold text-warning my-1">{{ $topKeywords->count() }}</div>
            <small class="text-light">Tendencias detectadas</small>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="p-3 rounded-3 border border-secondary bg-dark text-center">
            <span class="text-muted small text-uppercase">Oportunidades sin Stock</span>
            <div class="display-6 fw-bold text-danger my-1">{{ $zeroResultSearches->count() }}</div>
            <small class="text-light">Búsquedas con 0 resultados</small>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- 1. Top Searched Keywords -->
    <div class="col-lg-6">
        <div class="card-custom h-100">
            <div class="card-header">
                <span class="text-white fw-bold"><i class="fas fa-fire text-danger me-2"></i> Términos y Modelos Más Buscados</span>
            </div>
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle mb-0" style="font-size: 0.9rem;">
                    <thead>
                        <tr>
                            <th>Término / Palabra Clave</th>
                            <th class="text-center">Frecuencia</th>
                            <th class="text-center">Prom. Resultados</th>
                            <th class="text-end">Última Búsqueda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topKeywords as $kw)
                            <tr>
                                <td>
                                    <span class="text-white fw-bold"><i class="fas fa-search text-info me-2"></i> {{ $kw->query }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info text-dark fw-bold px-2 py-1">{{ $kw->total_searches }} veces</span>
                                </td>
                                <td class="text-center">
                                    <span class="text-muted">{{ round($kw->avg_results, 1) }}</span>
                                </td>
                                <td class="text-end text-muted small">
                                    {{ \Carbon\Carbon::parse($kw->last_searched)->diffForHumans() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No hay datos suficientes de búsqueda en este periodo.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 2. Zero Results & Geographic Locations -->
    <div class="col-lg-6">
        <!-- Zero Result Searches (Demanda no cubierta) -->
        <div class="card-custom mb-4">
            <div class="card-header">
                <span class="text-white fw-bold"><i class="fas fa-exclamation-triangle text-warning me-2"></i> Búsquedas Sin Resultados (Demanda Potencial)</span>
            </div>
            <div class="p-3">
                <div class="d-flex flex-wrap gap-2">
                    @forelse($zeroResultSearches as $z)
                        <span class="badge bg-dark border border-danger text-light p-2" style="font-size: 0.85rem;">
                            {{ $z->query }} <span class="badge bg-danger ms-1">{{ $z->total_attempts }}</span>
                        </span>
                    @empty
                        <small class="text-muted">¡Excelente! Todas las búsquedas de los clientes encontraron resultados en el catálogo.</small>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Geographic Locations -->
        <div class="card-custom">
            <div class="card-header">
                <span class="text-white fw-bold"><i class="fas fa-globe-americas text-primary me-2"></i> Lugares & Ciudades de los Clientes</span>
            </div>
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle mb-0" style="font-size: 0.9rem;">
                    <thead>
                        <tr>
                            <th>Ciudad / Región</th>
                            <th>País</th>
                            <th class="text-end">Consultas Registradas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locations as $loc)
                            <tr>
                                <td class="text-white fw-bold">
                                    <i class="fas fa-map-pin text-info me-2"></i> {{ $loc->city ?: 'Lima Metropolitana' }}
                                </td>
                                <td>{{ $loc->country ?: 'Perú' }}</td>
                                <td class="text-end fw-bold text-info">{{ $loc->count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">No hay datos geográficos aún.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Search Logs Table -->
<div class="card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="text-white fw-bold"><i class="fas fa-list me-2 text-info"></i> Registro Detallado de Búsquedas (Logs en Tiempo Real)</span>
    </div>

    <!-- Filter input -->
    <div class="p-3 bg-dark border-bottom border-secondary">
        <form action="{{ route('admin.analytics.searches') }}" method="GET" class="row g-2">
            <input type="hidden" name="periodo" value="{{ $days }}">
            <div class="col-md-6">
                <input type="text" name="termino" class="form-control form-control-sm" placeholder="Buscar en el historial de términos..." value="{{ request('termino') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-sm btn-outline-info w-100">Buscar</button>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0" style="font-size: 0.88rem;">
            <thead>
                <tr>
                    <th>Fecha & Hora</th>
                    <th>Término Buscado</th>
                    <th>Usuario Registrado</th>
                    <th>IP / Ubicación</th>
                    <th class="text-center">Resultados Encontrados</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td class="text-muted">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="text-white fw-bold font-monospace">"{{ $log->query }}"</td>
                        <td>
                            @if($log->user)
                                <span class="text-info fw-semibold">{{ $log->user->name }}</span>
                            @else
                                <span class="text-muted">Visitante Anónimo</span>
                            @endif
                        </td>
                        <td>
                            <span class="text-light">{{ $log->city ?: 'Lima' }}, {{ $log->country ?: 'Perú' }}</span>
                            <small class="text-muted d-block font-monospace" style="font-size: 0.72rem;">{{ $log->ip_address }}</small>
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $log->results_count > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $log->results_count }} unidad(es)
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">No hay registros de búsqueda para mostrar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($logs->hasPages())
        <div class="p-3 border-top border-secondary d-flex justify-content-center">
            {{ $logs->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
