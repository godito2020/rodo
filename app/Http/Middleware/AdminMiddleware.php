<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Por favor inicie sesión como administrador.');
        }

        $user = Auth::user();

        if (!$user->is_active) {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Su cuenta de administrador ha sido suspendida.');
        }

        if (!$user->isAdmin()) {
            return redirect()->route('home')->with('error', 'Acceso denegado. No tiene permisos de administrador.');
        }

        return $next($request);
    }
}
