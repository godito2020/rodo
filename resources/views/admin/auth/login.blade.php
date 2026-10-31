<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso Administrativo | RODOPERU Control Panel</title>
    <link rel="icon" type="image/png" href="{{ asset(\App\Models\Setting::get('favicon_path', 'favicon.png')) }}">

    <!-- Google Fonts: Space Grotesk, Inter, JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600;700&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --admin-navy-dark: #030c1c;
            --admin-navy-card: #0b172d;
            --admin-border: #1a2a44;
            --gold-primary: #B39255;
            --gold-light: #ffdea6;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--admin-navy-dark);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: radial-gradient(circle at 50% 20%, rgba(179,146,85,0.08) 0%, rgba(3,12,28,0.95) 70%);
        }

        .font-headline {
            font-family: 'Space Grotesk', sans-serif;
        }

        .font-metric {
            font-family: 'JetBrains Mono', monospace;
        }

        .material-symbols-outlined {
            vertical-align: middle;
        }

        .login-card {
            background-color: var(--admin-navy-card);
            border: 1px solid var(--admin-border);
            border-radius: 20px;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.4);
        }

        .form-control {
            background-color: #060f1e;
            border: 1px solid #1e3150;
            color: #ffffff;
            border-radius: 10px;
            font-size: 0.9rem;
            padding: 10px 14px;
        }

        .form-control:focus {
            background-color: #09152b;
            border-color: var(--gold-primary);
            color: #ffffff;
            box-shadow: 0 0 0 3px rgba(179, 146, 85, 0.25);
        }

        .input-group-text {
            background-color: #060f1e;
            border-color: #1e3150;
            color: var(--gold-light);
            border-radius: 10px 0 0 10px;
        }

        .btn-electric {
            background: linear-gradient(135deg, var(--gold-primary) 0%, #d4ad65 100%);
            color: #051125;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 12px;
            transition: all 0.2s;
        }

        .btn-electric:hover {
            color: #000;
            box-shadow: 0 4px 18px rgba(179, 146, 85, 0.4);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="mx-auto p-4 p-md-5 login-card" style="max-width: 450px;">
            <div class="text-center mb-4">
                <img src="{{ asset(\App\Models\Setting::get('logo_path', 'images/logo/RODO.png')) }}" alt="RODOPERU" height="48" class="mb-3" style="object-fit: contain;">
                <h4 class="text-white font-headline fw-bold mb-1" style="letter-spacing: -0.01em;">PANEL DE CONTROL</h4>
                <div class="mt-2">
                    <span class="badge font-metric" style="background: rgba(179,146,85,0.15); color: var(--gold-light); border: 1px solid rgba(179,146,85,0.4); font-size: 0.65rem; letter-spacing: 1.5px;">
                        ACCESO ADMINISTRATIVO OFICIAL
                    </span>
                </div>
            </div>

            @if(session('error'))
                <div class="alert alert-danger py-2.5 small border-0 text-white mb-3" style="background-color: #991b1b; border-radius: 10px;">
                    <i class="fas fa-exclamation-circle me-1 text-warning"></i> {{ session('error') }}
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="alert alert-danger py-2.5 small border-0 text-white mb-3" style="background-color: #991b1b; border-radius: 10px;">
                    @foreach($errors->all() as $err)
                        <div><i class="fas fa-times-circle me-1 text-warning"></i> {{ $err }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label font-metric text-light small fw-bold">Correo de Administrador</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                        <input type="email" name="email" class="form-control" required placeholder="admin@rodoperu.com" value="{{ old('email', 'admin@rodoperu.com') }}" style="border-radius: 0 10px 10px 0;">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label font-metric text-light small fw-bold">Contraseña Maestra</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" required placeholder="••••••••" value="admin123" style="border-radius: 0 10px 10px 0;">
                    </div>
                </div>

                <button type="submit" class="btn btn-electric w-100 py-3 mb-3 d-flex align-items-center justify-content-center gap-2">
                    <span class="material-symbols-outlined" style="font-size: 20px;">login</span>
                    <span>Ingresar al Panel de Control</span>
                </button>

                <div class="text-center mt-3 pt-3 border-top border-secondary" style="border-color: var(--admin-border) !important;">
                    <a href="{{ route('home') }}" class="font-metric text-muted small text-decoration-none d-inline-flex align-items-center gap-1 hover:text-white">
                        <span class="material-symbols-outlined" style="font-size: 16px;">arrow_back</span>
                        <span>Volver a la Web Principal</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
