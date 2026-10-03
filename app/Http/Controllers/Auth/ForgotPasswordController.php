<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $email = $request->email;
        $user = User::where('email', $email)->first();

        // Create reset token
        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $token,
                'created_at' => now(),
            ]
        );

        $resetUrl = route('password.reset', ['token' => $token, 'email' => $email]);

        // Attempt sending email via configured mailer
        try {
            // Check if mailer can send or if we notify with reset link
            // In local/cpanel setup, if mail server is not configured yet, we display the link or mail it.
            $siteName = Setting::get('site_name', 'RODOPERU');
            
            // We can send via standard mail or log
            Mail::send('emails.password_reset', ['resetUrl' => $resetUrl, 'user' => $user], function ($message) use ($email, $siteName) {
                $message->to($email);
                $message->subject("Restablecimiento de Contraseña - {$siteName}");
            });

            return back()->with('status', 'Hemos enviado el enlace para restablecer su contraseña a su correo electrónico.');
        } catch (\Exception $e) {
            // Provide a direct helper link in case SMTP is not configured in local environment
            return back()->with('status', 'Se ha generado la solicitud de restablecimiento.')->with('direct_link', $resetUrl);
        }
    }
}
