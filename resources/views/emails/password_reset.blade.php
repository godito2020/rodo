<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Restablecer Contraseña - RODOPERU</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #0b132b; color: #ffffff; padding: 30px; margin: 0;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #1c2541; border-radius: 10px; overflow: hidden; border: 1px solid #3a506b;">
        <div style="background-color: #0b132b; padding: 25px; text-align: center; border-bottom: 2px solid #00f2fe;">
            <h1 style="color: #00f2fe; margin: 0; font-size: 26px; letter-spacing: 2px;">RODOPERU</h1>
            <p style="color: #94a3b8; margin: 5px 0 0 0; font-size: 13px;">ELECTROMOVILIDAD E IMPLEMENTOS RODOVIARIOS</p>
        </div>
        <div style="padding: 30px;">
            <h2 style="color: #ffffff; font-size: 20px;">Hola, {{ $user->name }}</h2>
            <p style="color: #cbd5e1; font-size: 15px; line-height: 1.6;">
                Hemos recibido una solicitud para restablecer la contraseña de su cuenta en RODOPERU.
            </p>
            <div style="text-align: center; margin: 35px 0;">
                <a href="{{ $resetUrl }}" style="background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%); color: #0b132b; text-decoration: none; padding: 14px 28px; border-radius: 6px; font-weight: bold; font-size: 16px; display: inline-block;">
                    Restablecer mi Contraseña
                </a>
            </div>
            <p style="color: #94a3b8; font-size: 13px; line-height: 1.5;">
                Si el botón no funciona, copie y pegue el siguiente enlace en su navegador web:<br>
                <a href="{{ $resetUrl }}" style="color: #00f2fe; word-break: break-all;">{{ $resetUrl }}</a>
            </p>
            <p style="color: #64748b; font-size: 12px; margin-top: 30px; border-top: 1px solid #3a506b; padding-top: 15px;">
                Si usted no solicitó este cambio, ignore este mensaje. Su contraseña continuará siendo la misma.
            </p>
        </div>
    </div>
</body>
</html>
