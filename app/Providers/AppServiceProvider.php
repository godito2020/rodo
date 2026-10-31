<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (Schema::hasTable('settings')) {
                $smtpHost = Setting::get('smtp_host');
                if (!empty($smtpHost)) {
                    $smtpPort = (int) Setting::get('smtp_port', 587);
                    $rawEnc = strtolower(trim((string) Setting::get('smtp_encryption', '')));
                    $scheme = ($rawEnc === 'ssl' || $rawEnc === 'smtps' || $smtpPort === 465) ? 'smtps' : 'smtp';

                    Config::set('mail.default', 'smtp');
                    Config::set('mail.mailers.smtp.transport', 'smtp');
                    Config::set('mail.mailers.smtp.host', $smtpHost);
                    Config::set('mail.mailers.smtp.port', $smtpPort);
                    Config::set('mail.mailers.smtp.username', Setting::get('smtp_username'));
                    Config::set('mail.mailers.smtp.password', Setting::get('smtp_password'));
                    Config::set('mail.mailers.smtp.scheme', $scheme);
                    Config::set('mail.from.address', Setting::get('smtp_from_address', config('mail.from.address', 'ventas@rodoperu.com')));
                    Config::set('mail.from.name', Setting::get('smtp_from_name', config('mail.from.name', 'RODOPERU')));
                }
            }
        } catch (\Throwable $e) {
            // Ignore during migrations or CLI commands when database is not ready
        }
    }
}
