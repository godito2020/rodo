@extends('layouts.app')

@section('title', 'Recuperar Contraseña | RODOPERU')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="mx-auto p-4 p-md-5 rounded-4 border border-secondary" style="max-width: 480px; background: #0f182e;">
            <div class="text-center mb-4">
                <div class="p-3 rounded-circle text-info bg-dark border border-secondary d-inline-block fs-3 mb-3">
                    <i class="fas fa-key"></i>
                </div>
                <h3 class="text-white fw-bold">Recuperar Contraseña</h3>
                <p class="text-muted small">Ingresa el correo electrónico asociado a tu cuenta para enviarte las instrucciones de restablecimiento.</p>
            </div>

            @if(session('status'))
                <div class="alert alert-success border-0 bg-success text-white shadow-sm mb-3">
                    <i class="fas fa-check-circle me-1"></i> {{ session('status') }}
                </div>
            @endif

            @if(session('direct_link'))
                <div class="alert alert-info border-0 bg-dark text-info border border-info mb-3">
                    <small class="d-block fw-bold mb-1">Enlace directo generado para restablecimiento:</small>
                    <a href="{{ session('direct_link') }}" class="btn btn-sm btn-electric w-100 fw-bold">
                        Hacer Clic Aquí para Restablecer
                    </a>
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label text-light small fw-bold">Correo Electrónico Registrado</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-secondary text-muted"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" required placeholder="correo@ejemplo.com" value="{{ old('email') }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-electric w-100 py-3 fw-bold mb-3">
                    <i class="fas fa-paper-plane me-1"></i> Enviar Enlace de Recuperación
                </button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-muted small text-decoration-none hover-cyan">
                        <i class="fas fa-arrow-left me-1"></i> Volver a Iniciar Sesión
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
