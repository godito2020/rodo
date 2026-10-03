<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso Administrativo | RODOPERU Control Panel</title>
    <link rel="icon" type="image/png" href="{{ asset(\App\Models\Setting::get('favicon_path', 'favicon.png')) }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Rajdhani:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #070d1e;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-electric {
            background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
            color: #070d1e;
            font-weight: 700;
            border: none;
        }
        .btn-electric:hover {
            box-shadow: 0 0 15px rgba(0, 242, 254, 0.5);
            color: #000;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="mx-auto p-4 p-md-5 rounded-4 border border-secondary shadow-lg" style="max-width: 440px; background: #0b1328;">
            <div class="text-center mb-4">
                <img src="{{ asset(\App\Models\Setting::get('logo_path', 'images/logo/RODO.png')) }}" alt="RODOPERU" height="50" class="mb-3">
                <h4 class="text-white fw-bold mb-1" style="font-family: 'Rajdhani', sans-serif; letter-spacing: 1px;">PANEL DE CONTROL</h4>
                <span class="badge bg-danger">ACCESO RESTRINGIDO</span>
            </div>

            @if(session('error'))
                <div class="alert alert-danger py-2 small border-0 bg-danger text-white mb-3">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="alert alert-danger py-2 small border-0 bg-danger text-white mb-3">
                    @foreach($errors->all() as $err)
                        <div>{{ $err }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-light small fw-bold">Correo de Administrador</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-secondary text-info"><i class="fas fa-user-shield"></i></span>
                        <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required placeholder="admin@rodoperu.com" value="{{ old('email', 'admin@rodoperu.com') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-light small fw-bold">Contraseña Maestra</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-secondary text-info"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required placeholder="••••••••" value="admin123">
                    </div>
                </div>

                <button type="submit" class="btn btn-electric w-100 py-3 fw-bold mb-3">
                    <i class="fas fa-key me-2"></i> Iniciar Sesión de Administrador
                </button>

                <div class="text-center">
                    <a href="{{ route('home') }}" class="text-muted small text-decoration-none">
                        <i class="fas fa-arrow-left me-1"></i> Volver a la Web Principal
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
