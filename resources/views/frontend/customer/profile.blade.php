@extends('layouts.app')

@section('title', 'Mi Perfil | RODOPERU')

@section('content')
<div class="py-4" style="background: #091022; border-bottom: 1px solid var(--border-dark);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}" class="text-info text-decoration-none">Mi Cuenta</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Mi Perfil</li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold text-white mb-0"><i class="fas fa-user-cog text-info me-2"></i> Configuración de Cuenta y Seguridad</h1>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Profile Data Form -->
            <div class="col-lg-7">
                <div class="p-4 rounded-4 border border-secondary" style="background: #0f182e;">
                    <h4 class="text-white fw-bold mb-4 pb-2 border-bottom border-secondary">Datos Personales y de Empresa</h4>
                    
                    <form action="{{ route('customer.update_profile') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-light small fw-bold">Nombre Completo *</label>
                                <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-light small fw-bold">Correo Electrónico (No modificable)</label>
                                <input type="email" class="form-control" disabled value="{{ $user->email }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-light small fw-bold">Teléfono / Celular</label>
                                <input type="text" name="phone" class="form-control" placeholder="+51 987 654 321" value="{{ old('phone', $user->phone) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-light small fw-bold">DNI o RUC</label>
                                <input type="text" name="dni_ruc" class="form-control" placeholder="10456789012" value="{{ old('dni_ruc', $user->dni_ruc) }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-light small fw-bold">Empresa / Razón Social</label>
                                <input type="text" name="company_name" class="form-control" placeholder="Transportes Express S.A.C." value="{{ old('company_name', $user->company_name) }}">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label text-light small fw-bold">Dirección Habitual de Entrega</label>
                                <input type="text" name="address" class="form-control" placeholder="Av. Principal 123" value="{{ old('address', $user->address) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-light small fw-bold">Ciudad</label>
                                <input type="text" name="city" class="form-control" placeholder="Lima" value="{{ old('city', $user->city) }}">
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-electric px-4 py-2 fw-bold">
                                    Guardar Cambios del Perfil
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Password Change Form -->
            <div class="col-lg-5">
                <div class="p-4 rounded-4 border border-secondary" style="background: #0f182e;">
                    <h4 class="text-white fw-bold mb-4 pb-2 border-bottom border-secondary"><i class="fas fa-lock text-warning me-2"></i> Cambiar Contraseña</h4>
                    
                    <form action="{{ route('customer.update_password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-light small fw-bold">Contraseña Actual *</label>
                            <input type="password" name="current_password" class="form-control" required placeholder="••••••••">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-light small fw-bold">Nueva Contraseña * (Mín. 8 caracteres)</label>
                            <input type="password" name="password" class="form-control" required placeholder="••••••••">
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-light small fw-bold">Confirmar Nueva Contraseña *</label>
                            <input type="password" name="password_confirmation" class="form-control" required placeholder="••••••••">
                        </div>
                        <button type="submit" class="btn btn-outline-warning w-100 py-2 fw-bold">
                            Actualizar Contraseña
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
