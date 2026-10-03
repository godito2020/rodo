@extends('layouts.app')

@section('title', 'Registro de Cuenta | RODOPERU')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="mx-auto p-4 p-md-5 rounded-4 border border-secondary" style="max-width: 650px; background: #0f182e;">
            <div class="text-center mb-4">
                <img src="{{ asset(\App\Models\Setting::get('logo_path', 'images/logo/RODO.png')) }}" alt="RODOPERU" height="48" class="mb-3">
                <h3 class="text-white fw-bold">Crear Cuenta de Cliente</h3>
                <p class="text-muted small">Regístrate para gestionar pedidos, cotizaciones personalizadas y chats con asesores</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Nombre Completo *</label>
                        <input type="text" name="name" class="form-control" required placeholder="Ej: Juan Pérez" value="{{ old('name') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Correo Electrónico *</label>
                        <input type="email" name="email" class="form-control" required placeholder="correo@ejemplo.com" value="{{ old('email') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Contraseña * (Mínimo 8 caracteres)</label>
                        <input type="password" name="password" class="form-control" required placeholder="••••••••">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Confirmar Contraseña *</label>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="••••••••">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">Teléfono / WhatsApp</label>
                        <input type="text" name="phone" class="form-control" placeholder="+51 987 654 321" value="{{ old('phone') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light small fw-bold">DNI o RUC</label>
                        <input type="text" name="dni_ruc" class="form-control" placeholder="10456789012" value="{{ old('dni_ruc') }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light small fw-bold">Empresa / Razón Social (Opcional)</label>
                        <input type="text" name="company_name" class="form-control" placeholder="Transportes Express S.A.C." value="{{ old('company_name') }}">
                    </div>

                    <div class="col-md-8">
                        <label class="form-label text-light small fw-bold">Dirección</label>
                        <input type="text" name="address" class="form-control" placeholder="Av. Principal 123" value="{{ old('address') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light small fw-bold">Ciudad</label>
                        <input type="text" name="city" class="form-control" placeholder="Lima" value="{{ old('city', 'Lima') }}">
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-electric w-100 py-3 fw-bold">
                            Registrarme en RODOPERU <i class="fas fa-user-plus ms-1"></i>
                        </button>
                    </div>

                    <div class="col-12 text-center text-muted small mt-3">
                        ¿Ya tienes una cuenta registrada? 
                        <a href="{{ route('login') }}" class="text-info fw-bold text-decoration-none">Inicia sesión aquí</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
