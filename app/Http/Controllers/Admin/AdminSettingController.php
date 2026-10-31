<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

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

        // Invalidate all setting cache and clear compiled views for immediate reflection across the website
        Cache::flush();
        try {
            Artisan::call('view:clear');
        } catch (\Throwable $e) {}

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
            $smtpPort = (int) Setting::get('smtp_port', config('mail.mailers.smtp.port', 587));
            $smtpUser = Setting::get('smtp_username', config('mail.mailers.smtp.username'));
            $smtpPass = Setting::get('smtp_password', config('mail.mailers.smtp.password'));
            $rawEnc = strtolower(trim((string) Setting::get('smtp_encryption', '')));
            $fromAddress = Setting::get('smtp_from_address', config('mail.from.address', 'ventas@rodoperu.com'));
            $fromName = Setting::get('smtp_from_name', config('mail.from.name', 'RODOPERU'));

            // Symfony Mailer (Laravel 9+) only supports schemes: 'smtp' or 'smtps'
            // 'ssl' maps to 'smtps' (direct SSL wrapper, typically port 465)
            // 'tls' maps to 'smtp' (STARTTLS command, typically port 587 or 25)
            if ($rawEnc === 'ssl' || $rawEnc === 'smtps' || $smtpPort === 465) {
                $scheme = 'smtps';
            } elseif ($rawEnc === 'tls' || $rawEnc === 'smtp' || $smtpPort === 587) {
                $scheme = 'smtp';
            } else {
                $scheme = null; // Auto-detected based on port by Laravel
            }

            Config::set('mail.default', 'smtp');
            Config::set('mail.mailers.smtp.transport', 'smtp');
            Config::set('mail.mailers.smtp.host', $smtpHost);
            Config::set('mail.mailers.smtp.port', $smtpPort);
            Config::set('mail.mailers.smtp.username', $smtpUser);
            Config::set('mail.mailers.smtp.password', $smtpPass);
            Config::set('mail.mailers.smtp.scheme', $scheme);
            Config::set('mail.from.address', $fromAddress);
            Config::set('mail.from.name', $fromName);

            // Purge cached mail transport instance so the new credentials take effect immediately
            Mail::purge('smtp');

            Mail::raw("¡Excelente! La configuración de correo SMTP para RODOPERU está funcionando correctamente.\n\nServidor: {$smtpHost}:{$smtpPort}\nEsquema: " . ($scheme ?? 'auto') . "\nFecha y hora: " . now()->toDateTimeString(), function ($message) use ($testEmail, $fromAddress, $fromName) {
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
