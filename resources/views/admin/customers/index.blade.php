@extends('layouts.admin')

@section('title', 'Gestión de Clientes')
@section('page_title', 'Administración de Clientes & Cuentas')

@section('content')
<div class="card-custom">
    <!-- Header -->
    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h5 class="text-white mb-0"><i class="fas fa-users text-primary me-2"></i> Directorio de Clientes</h5>
            <small class="text-muted">Total: {{ $customers->total() }} clientes registrados en la plataforma</small>
        </div>
    </div>

    <!-- Filter Strip -->
    <div class="p-3 border-bottom border-secondary bg-dark">
        <form action="{{ route('admin.customers.index') }}" method="GET" class="row g-2">
            <div class="col-md-6">
                <input type="text" name="buscar" class="form-control form-control-sm" placeholder="Buscar por nombre, email, teléfono, DNI o empresa..." value="{{ request('buscar') }}">
            </div>
            <div class="col-md-3">
                <select name="estado" class="form-select form-select-sm">
                    <option value="">Todos los Estados</option>
                    <option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>Clientes Activos</option>
                    <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Clientes Bloqueados</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-1">
                <button type="submit" class="btn btn-sm btn-outline-info flex-grow-1"><i class="fas fa-search me-1"></i> Filtrar</button>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-outline-secondary" title="Limpiar"><i class="fas fa-undo"></i></a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr>
                    <th>Cliente / Empresa</th>
                    <th>Contacto</th>
                    <th>DNI / RUC</th>
                    <th>Ciudad</th>
                    <th class="text-center">Pedidos</th>
                    <th class="text-center">Estado</th>
                    <th class="text-end" style="width: 200px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $c)
                    <tr>
                        <td>
                            <div class="text-white fw-bold">{{ $c->name }}</div>
                            <small class="text-muted">{{ $c->company_name ?: 'Particular' }}</small>
                        </td>
                        <td>
                            <div class="small text-light">{{ $c->email }}</div>
                            <small class="text-muted">{{ $c->phone ?: 'Sin teléfono' }}</small>
                        </td>
                        <td>
                            <span class="font-monospace small text-light">{{ $c->dni_ruc ?: '—' }}</span>
                        </td>
                        <td>
                            <span class="small text-light">{{ $c->city ?: 'Lima' }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-dark border border-secondary">{{ $c->orders_count }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $c->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $c->is_active ? 'Activo' : 'Bloqueado' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-1">
                                <!-- View Details -->
                                <a href="{{ route('admin.customers.show', $c->id) }}" class="btn btn-sm btn-outline-info" title="Ver Historial">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Reset Password Modal Button -->
                                <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#resetPassModal-{{ $c->id }}" title="Restablecer Contraseña">
                                    <i class="fas fa-key"></i>
                                </button>

                                <!-- Toggle Block / Unblock Button -->
                                <form action="{{ route('admin.customers.toggle_block', $c->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $c->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}" title="{{ $c->is_active ? 'Bloquear Cliente' : 'Desbloquear Cliente' }}">
                                        <i class="fas {{ $c->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                    </button>
                                </form>

                                <!-- Delete Customer Button -->
                                <form action="{{ route('admin.customers.destroy', $c->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar definitivamente a este cliente?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-secondary text-danger" title="Eliminar Cliente">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal: Reset Password -->
                    <div class="modal fade" id="resetPassModal-{{ $c->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="background: #0f182e; border: 1px solid var(--border-dark);">
                                <div class="modal-header border-bottom border-secondary">
                                    <h5 class="modal-title text-white"><i class="fas fa-key text-warning me-2"></i> Restablecer Contraseña</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.customers.reset_password', $c->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <p class="text-light small">
                                            Ingresa la nueva contraseña para el cliente <strong>{{ $c->name }}</strong> ({{ $c->email }}).
                                        </p>
                                        <div class="mb-3">
                                            <label class="form-label text-light small fw-bold">Nueva Contraseña * (Mínimo 8 caracteres)</label>
                                            <input type="text" name="new_password" class="form-control" required placeholder="Ingresa contraseña..." value="Rodo{{ rand(1000, 9999) }}!">
                                            <small class="text-muted" style="font-size: 0.75rem;">Puedes usar la sugerencia generada o ingresar una personalizada.</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top border-secondary">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-sm btn-electric fw-bold">Guardar y Restablecer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            No se encontraron clientes registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($customers->hasPages())
        <div class="p-3 border-top border-secondary d-flex justify-content-center">
            {{ $customers->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
