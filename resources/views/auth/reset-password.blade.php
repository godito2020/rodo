@extends('layouts.app')

@section('title', 'Restablecer Contraseña | RODOPERU')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="mx-auto p-4 p-md-5 rounded-4 border border-secondary" style="max-width: 480px; background: #0f182e;">
            <div class="text-center mb-4">
                <div class="p-3 rounded-circle text-success bg-dark border border-secondary d-inline-block fs-3 mb-3">
                    <i class="fas fa-lock"></i>
                </div>
                <h3 class="text-white fw-bold">Nueva Contraseña</h3>
                <p class="text-muted small">Crea una nueva contraseña segura para tu cuenta</p>
            </div>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" required readonly value="{{ old('email', $email) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Nueva Contraseña (mínimo 8 caracteres)</label>
                    <input type="password" name="password" class="form-control" required placeholder="••••••••">
                </div>

                <div class="mb-4">
                    <label class="form-label text-light small fw-bold">Confirmar Nueva Contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="••••••••">
                </div>

                <button type="submit" class="btn btn-electric w-100 py-3 fw-bold mb-3">
                    Actualizar Contraseña e Ingresar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
