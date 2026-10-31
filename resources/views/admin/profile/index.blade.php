@extends('layouts.admin')

@section('title', 'Mi Perfil & Seguridad')
@section('page_title', 'Seguridad & Mi Perfil Administrador')

@section('content')
<div class="row g-4">
    <!-- 1. Información del Perfil -->
    <div class="col-lg-6">
        <div class="card-custom h-100">
            <div class="card-header border-bottom border-secondary d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white font-headline fw-bold">
                    <span class="material-symbols-outlined text-info me-2" style="font-size: 22px;">badge</span>
                    Datos de la Cuenta
                </h5>
                <span class="badge px-3 py-1 font-metric" style="background: var(--gold-primary); color: #051125; font-weight: 700;">
                    ROL: {{ strtoupper($user->role ?? 'ADMIN') }}
                </span>
            </div>
            <div class="card-body p-4">
                <p class="text-muted small mb-4">
                    Mantén actualizada la información de contacto del administrador oficial del sistema RODOPERU.
                </p>

                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Nombre Completo *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <small class="text-danger font-metric">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Correo Electrónico (Acceso al Panel) *</label>
                        <input type="email" name="email" class="form-control font-metric" value="{{ old('email', $user->email) }}" required>
                        <small class="text-muted" style="font-size: 0.75rem;">Este correo es el utilizado para iniciar sesión en /admin/login.</small>
                        @error('email')
                            <small class="text-danger font-metric d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-light small fw-bold">Teléfono / Celular de Contacto</label>
                        <input type="text" name="phone" class="form-control font-metric" value="{{ old('phone', $user->phone) }}" placeholder="+51 987 654 321">
                        @error('phone')
                            <small class="text-danger font-metric">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="p-3 rounded-3 mb-4" style="background-color: #061122; border: 1px solid #1e3150;">
                        <div class="d-flex justify-content-between align-items-center small font-metric text-muted">
                            <span>Cuenta creada el:</span>
                            <span class="text-white">{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center small font-metric text-muted mt-2">
                            <span>Último acceso registrado:</span>
                            <span class="text-warning">{{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Sesión activa actual' }}</span>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-outline-info px-4 fw-bold">
                            <i class="fas fa-save me-2"></i> Actualizar Perfil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 2. Seguridad & Cambio de Contraseña -->
    <div class="col-lg-6">
        <div class="card-custom h-100">
            <div class="card-header border-bottom border-secondary d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white font-headline fw-bold">
                    <span class="material-symbols-outlined text-warning me-2" style="font-size: 22px;">lock_reset</span>
                    Cambiar Contraseña
                </h5>
                <span class="badge bg-dark text-warning border border-warning px-2.5 py-1 font-metric">
                    SEGURIDAD
                </span>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-dark border border-warning/30 p-3 mb-4 rounded-3 text-light small" style="background-color: #09152b;">
                    <i class="fas fa-shield-alt text-warning me-2"></i>
                    Para cambiar tu clave, escribe primero tu <strong>contraseña actual</strong> y luego define la <strong>nueva clave</strong> (mínimo 8 caracteres).
                </div>

                <form action="{{ route('admin.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Contraseña Actual *</label>
                        <div class="input-group">
                            <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Ingresa tu clave actual..." required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassVisibility('current_password', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <small class="text-danger font-metric d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold">Nueva Contraseña * (Mínimo 8 caracteres)</label>
                        <div class="input-group">
                            <input type="password" name="password" id="new_password" class="form-control" placeholder="••••••••" required minlength="8">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassVisibility('new_password', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <small class="text-danger font-metric d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-light small fw-bold">Confirmar Nueva Contraseña *</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••" required minlength="8">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassVisibility('password_confirmation', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="p-3 rounded-3 mb-4" style="background-color: #061122; border: 1px solid #1e3150;">
                        <small class="text-muted d-block mb-1 font-metric">Recomendaciones de seguridad:</small>
                        <ul class="text-light small mb-0 ps-3">
                            <li>Combina mayúsculas, minúsculas y números.</li>
                            <li>Evita usar datos públicos o fáciles de adivinar.</li>
                        </ul>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-electric px-4 fw-bold">
                            <i class="fas fa-key me-2"></i> Guardar Nueva Contraseña
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endsection
