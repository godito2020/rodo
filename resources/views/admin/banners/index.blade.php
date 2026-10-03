@extends('layouts.admin')

@section('title', 'Banners & Popups')
@section('page_title', 'Administración de Banners & Popup Promocional')

@section('content')
<div class="row g-4">
    <!-- 1. Promotional Popup Settings Card (User requirement) -->
    <div class="col-lg-5">
        <div class="card-custom p-4">
            <h5 class="text-white fw-bold mb-3 pb-2 border-bottom border-secondary">
                <i class="fas fa-window-maximize text-warning me-2"></i> Popup Promocional de Portada
            </h5>
            <p class="text-muted small mb-4">
                Configura la ventana emergente con cuenta regresiva y oferta especial que se mostrará al visitante en la tienda.
            </p>

            <form action="{{ route('admin.banners.update_popup') }}" method="POST">
                @csrf
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="popup_active" id="popupActive" value="1" {{ $popupActive ? 'checked' : '' }}>
                    <label class="form-check-label text-light fw-bold" for="popupActive">
                        Activar Popup en Portada
                    </label>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Título del Popup *</label>
                    <input type="text" name="popup_title" class="form-control" required placeholder="Ej: ¡Feria de Electromovilidad RODOPERU!" value="{{ old('popup_title', $popupTitle) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Descripción / Oferta</label>
                    <textarea name="popup_subtitle" class="form-control" rows="3" placeholder="Bono de descuento de hasta $3,000...">{{ old('popup_subtitle', $popupSubtitle) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Fecha Límite Cuenta Regresiva (Countdown)</label>
                    <input type="datetime-local" name="popup_countdown" class="form-control" value="{{ $popupCountdown ? date('Y-m-d\TH:i', strtotime($popupCountdown)) : '' }}">
                    <small class="text-muted" style="font-size: 0.75rem;">Muestra días, horas, minutos y segundos restantes en tiempo real.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Texto del Botón</label>
                    <input type="text" name="popup_button_text" class="form-control" placeholder="Ej: Ver Ofertas Exclusivas" value="{{ old('popup_button_text', $popupButtonText) }}">
                </div>

                <div class="mb-4">
                    <label class="form-label text-light small fw-bold">Enlace de Destino (URL)</label>
                    <input type="text" name="popup_button_url" class="form-control" placeholder="/productos?destacados=1" value="{{ old('popup_button_url', $popupButtonUrl) }}">
                </div>

                <button type="submit" class="btn btn-electric w-100 py-2 fw-bold">
                    <i class="fas fa-save me-1"></i> Guardar Configuración de Popup
                </button>
            </form>
        </div>
    </div>

    <!-- 2. Banners Grid List -->
    <div class="col-lg-7">
        <div class="card-custom">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="text-white"><i class="fas fa-ad text-info me-2"></i> Banners Promocionales & Intermedios</span>
                <a href="{{ route('admin.banners.create') }}" class="btn btn-sm btn-electric">
                    <i class="fas fa-plus me-1"></i> Nuevo Banner
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Ubicación</th>
                            <th>Enlace</th>
                            <th class="text-center">Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banners as $b)
                            <tr>
                                <td>
                                    <div class="text-white fw-bold">{{ $b->title }}</div>
                                    <small class="text-muted">{{ Str::limit($b->subtitle, 45) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-dark border border-secondary text-uppercase">{{ $b->type }}</span>
                                </td>
                                <td>
                                    <span class="text-light small">{{ $b->button_text ?: 'Sin botón' }}</span>
                                    <small class="text-muted d-block font-monospace" style="font-size: 0.72rem;">{{ $b->button_url }}</small>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $b->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $b->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('admin.banners.edit', $b->id) }}" class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.banners.destroy', $b->id) }}" method="POST" onsubmit="return confirm('¿Eliminar banner?')">
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
                                <td colspan="5" class="text-center text-muted py-4">No hay banners intermedios registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
