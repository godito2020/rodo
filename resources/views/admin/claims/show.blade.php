@extends('layouts.admin')

@section('title', 'Hoja de Reclamación ' . $claim->claim_number)
@section('page_title', 'Reclamación ' . $claim->claim_number)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('admin.claims.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Volver al Listado
    </a>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.claims.print', $claim->id) }}" target="_blank" class="btn btn-outline-warning btn-sm fw-bold">
            <i class="fas fa-print me-1"></i> Imprimir Hoja Oficial (INDECOPI)
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Left: Complaint Full Information -->
    <div class="col-lg-7">
        <div class="card-custom h-100">
            <div class="card-header border-bottom border-secondary d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white font-headline fw-bold">
                    <span class="material-symbols-outlined text-info me-1" style="font-size: 20px;">description</span>
                    Detalle del Requerimiento
                </h5>
                <span class="badge {{ $claim->claim_type === 'reclamo' ? 'bg-danger' : 'bg-warning text-dark' }} font-metric px-3 py-1">
                    {{ strtoupper($claim->claim_type) }}
                </span>
            </div>
            <div class="card-body p-4 space-y-4">
                
                <!-- Consumidor -->
                <div>
                    <h6 class="text-warning font-headline fw-bold mb-2 text-uppercase" style="font-size: 0.8rem;">1. Consumidor Reclamante</h6>
                    <div class="p-3 rounded-3 bg-dark border border-secondary text-sm">
                        <div class="row g-2">
                            <div class="col-sm-6">
                                <span class="text-muted small d-block">Nombre Completo:</span>
                                <strong class="text-white">{{ $claim->full_name }}</strong>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted small d-block">Documento:</span>
                                <span class="font-metric text-white">{{ $claim->doc_type }}: {{ $claim->doc_number }}</span>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted small d-block">Teléfono / Celular:</span>
                                <a href="tel:{{ $claim->phone }}" class="text-info font-metric">{{ $claim->phone }}</a>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted small d-block">Correo Electrónico:</span>
                                <a href="mailto:{{ $claim->email }}" class="text-info">{{ $claim->email }}</a>
                            </div>
                            <div class="col-12">
                                <span class="text-muted small d-block">Domicilio:</span>
                                <span class="text-white">{{ $claim->address }} {{ $claim->district ? "({$claim->district}, {$claim->province}, {$claim->department})" : '' }}</span>
                            </div>
                            @if($claim->is_minor)
                            <div class="col-12 mt-2 pt-2 border-top border-secondary">
                                <span class="badge bg-secondary mb-1">Menor de Edad</span>
                                <div class="small text-light"><strong>Padre/Apoderado:</strong> {{ $claim->guardian_name }} (Doc: {{ $claim->guardian_doc }})</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Bien Contratado -->
                <div>
                    <h6 class="text-warning font-headline fw-bold mb-2 text-uppercase" style="font-size: 0.8rem;">2. Bien Contratado</h6>
                    <div class="p-3 rounded-3 bg-dark border border-secondary text-sm">
                        <div class="row g-2">
                            <div class="col-sm-6">
                                <span class="text-muted small d-block">Tipo:</span>
                                <strong class="text-white text-uppercase">{{ $claim->contracted_type }}</strong>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted small d-block">Monto Reclamado:</span>
                                <span class="font-metric text-warning fw-bold">
                                    {{ $claim->claimed_amount ? $claim->currency . ' ' . number_format((float)$claim->claimed_amount, 2) : 'No especificado' }}
                                </span>
                            </div>
                            <div class="col-12">
                                <span class="text-muted small d-block">Descripción del Producto / Servicio:</span>
                                <span class="text-white">{{ $claim->product_description }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hechos y Pedido -->
                <div>
                    <h6 class="text-warning font-headline fw-bold mb-2 text-uppercase" style="font-size: 0.8rem;">3. Hechos &amp; Pedido Concreto</h6>
                    <div class="p-3 rounded-3 bg-dark border border-secondary text-sm space-y-3">
                        <div>
                            <span class="text-muted small d-block fw-bold">Detalle de los Hechos (Reclamo / Queja):</span>
                            <div class="text-light p-2 rounded bg-black bg-opacity-30 border border-secondary mt-1" style="white-space: pre-wrap;">{{ $claim->details }}</div>
                        </div>
                        <div>
                            <span class="text-muted small d-block fw-bold">Pedido Concreto del Consumidor:</span>
                            <div class="text-white p-2 rounded bg-black bg-opacity-30 border border-secondary mt-1 fw-bold" style="white-space: pre-wrap;">{{ $claim->consumer_request }}</div>
                        </div>
                    </div>
                </div>

                <!-- Meta & IP -->
                <div class="p-3 rounded-3 bg-dark border border-secondary text-xs text-muted d-flex justify-content-between">
                    <div><strong>Fecha:</strong> {{ $claim->created_at->format('d/m/Y H:i:s') }}</div>
                    <div><strong>IP:</strong> <span class="font-metric">{{ $claim->ip_address ?: 'N/A' }}</span></div>
                </div>

            </div>
        </div>
    </div>

    <!-- Right: Resolution & Response -->
    <div class="col-lg-5">
        <div class="card-custom h-100">
            <div class="card-header border-bottom border-secondary">
                <h5 class="mb-0 text-white font-headline fw-bold">
                    <span class="material-symbols-outlined text-warning me-1" style="font-size: 20px;">gavel</span>
                    Resolución &amp; Respuesta Formal
                </h5>
            </div>
            <div class="card-body p-4">
                
                <!-- Deadline Indicator -->
                <div class="p-3 rounded-3 mb-4 {{ $claim->status === 'atendido' ? 'bg-success bg-opacity-10 border border-success' : ($claim->days_remaining < 0 ? 'bg-danger bg-opacity-10 border border-danger' : 'bg-warning bg-opacity-10 border border-warning') }}">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="small font-metric text-uppercase fw-bold text-white">Plazo Legal INDECOPI (15 d.h.):</span>
                        <span class="badge {{ $claim->status === 'atendido' ? 'bg-success' : ($claim->days_remaining < 0 ? 'bg-danger' : 'bg-warning text-dark') }} font-metric">
                            {{ $claim->status === 'atendido' ? 'ATENDIDO' : ($claim->days_remaining < 0 ? 'PLAZO VENCIDO' : $claim->days_remaining . ' DÍAS RESTANTES') }}
                        </span>
                    </div>
                    <small class="text-muted d-block">
                        Fecha Límite Máxima: <strong class="text-white">{{ $claim->deadline->format('d/m/Y') }}</strong>
                    </small>
                </div>

                <form action="{{ route('admin.claims.update_status', $claim->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Estado del Caso *</label>
                        <select name="status" class="form-select">
                            <option value="pendiente" {{ $claim->status === 'pendiente' ? 'selected' : '' }}>Pendiente (Sin respuesta aún)</option>
                            <option value="en_proceso" {{ $claim->status === 'en_proceso' ? 'selected' : '' }}>En Proceso (Evaluación técnica / legal)</option>
                            <option value="atendido" {{ $claim->status === 'atendido' ? 'selected' : '' }}>Atendido (Resuelto formalmente)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Respuesta Formal de la Empresa</label>
                        <textarea name="response_text" rows="5" class="form-control" placeholder="Redacta la respuesta formal para el consumidor según Ley N° 29571...">{{ old('response_text', $claim->response_text) }}</textarea>
                        <small class="text-muted" style="font-size: 0.72rem;">Esta respuesta quedará grabada en la Hoja de Reclamación oficial.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Notas Internas (Solo visibles para administradores)</label>
                        <textarea name="admin_notes" rows="3" class="form-control" placeholder="Observaciones internas, número de contacto, acuerdos previos...">{{ old('admin_notes', $claim->admin_notes) }}</textarea>
                    </div>

                    <div class="p-3 rounded-3 bg-dark border border-secondary mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="send_email" id="sendEmailCheck" value="1" checked>
                            <label class="form-check-label text-light small" for="sendEmailCheck">
                                <strong>Enviar notificación por correo al consumidor</strong><br>
                                <span class="text-muted">Se enviará una copia formal al correo <code>{{ $claim->email }}</code></span>
                            </label>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-electric px-4 fw-bold">
                            <i class="fas fa-save me-2"></i> Guardar y Actualizar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
