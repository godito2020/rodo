@extends('layouts.app')

@section('title', 'Iniciar Sesión | RODOPERU')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="mx-auto p-4 p-md-5 rounded-4 border border-secondary" style="max-width: 480px; background: #0f182e;">
            <div class="text-center mb-4">
                <img src="{{ asset(\App\Models\Setting::get('logo_path', 'images/logo/RODO.png')) }}" alt="RODOPERU" height="48" class="mb-3">
                <h3 class="text-white fw-bold">Iniciar Sesión</h3>
                <p class="text-muted small">Accede a tu cuenta de cliente para seguir tus pedidos y consultas</p>
            </div>

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-secondary text-muted"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" required placeholder="correo@ejemplo.com" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label text-light small fw-bold mb-0">Contraseña</label>
                        <a href="{{ route('password.request') }}" class="text-info small text-decoration-none">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-secondary text-muted"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" required placeholder="••••••••">
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                    <label class="form-check-label text-muted small" for="rememberMe">
                        Recordar mi sesión en este dispositivo
                    </label>
                </div>

                <button type="submit" class="btn btn-electric w-100 py-3 fw-bold mb-3">
                    Ingresar a mi Cuenta <i class="fas fa-sign-in-alt ms-1"></i>
                </button>

                <div class="text-center text-muted small">
                    ¿Aún no tienes cuenta? 
                    <a href="{{ route('register') }}" class="text-info fw-bold text-decoration-none">Regístrate gratis aquí</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
