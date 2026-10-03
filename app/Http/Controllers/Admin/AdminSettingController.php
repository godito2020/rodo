<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $inputs = $request->except(['_token', 'logo', 'favicon']);

        foreach ($inputs as $key => $value) {
            Setting::set($key, $value ?? '');
        }

        // Handle Logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $fileName);
            Setting::set('logo_path', 'uploads/settings/' . $fileName, 'branding');
        }

        // Handle Favicon upload
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $fileName = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $fileName);
            Setting::set('favicon_path', 'uploads/settings/' . $fileName, 'branding');
            
            // Also copy to root public/favicon.png for browser direct requests
            @copy(public_path('uploads/settings/' . $fileName), public_path('favicon.png'));
        }

        return back()->with('success', 'Configuraciones del sistema actualizadas exitosamente.');
    }

    public function testSmtp(Request $request)
    {
        $request->validate([
            'test_email' => 'required|email',
        ]);

        $testEmail = $request->test_email;

        try {
            // Dynamically set mail configuration from database settings
            $smtpHost = Setting::get('smtp_host', config('mail.mailers.smtp.host'));
            $smtpPort = Setting::get('smtp_port', config('mail.mailers.smtp.port'));
            $smtpUser = Setting::get('smtp_username', config('mail.mailers.smtp.username'));
            $smtpPass = Setting::get('smtp_password', config('mail.mailers.smtp.password'));
            $smtpEnc = Setting::get('smtp_encryption', config('mail.mailers.smtp.scheme'));
            $fromAddress = Setting::get('smtp_from_address', config('mail.from.address'));
            $fromName = Setting::get('smtp_from_name', config('mail.from.name'));

            Config::set('mail.default', 'smtp');
            Config::set('mail.mailers.smtp.host', $smtpHost);
            Config::set('mail.mailers.smtp.port', (int)$smtpPort);
            Config::set('mail.mailers.smtp.username', $smtpUser);
            Config::set('mail.mailers.smtp.password', $smtpPass);
            Config::set('mail.mailers.smtp.scheme', $smtpEnc);
            Config::set('mail.from.address', $fromAddress);
            Config::set('mail.from.name', $fromName);

            Mail::raw("¡Excelente! La configuración de correo SMTP para RODOPERU está funcionando correctamente.\n\nFecha y hora: " . now()->toDateTimeString(), function ($message) use ($testEmail, $fromAddress, $fromName) {
                $message->to($testEmail)
                        ->from($fromAddress, $fromName)
                        ->subject("Prueba de Conexión SMTP Exitosa - RODOPERU");
            });

            return back()->with('success', "Correo de prueba enviado con éxito a {$testEmail}.");
        } catch (\Exception $e) {
            return back()->with('error', "Error al conectar con el servidor SMTP: " . $e->getMessage());
        }
    }
}
