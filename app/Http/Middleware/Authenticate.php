<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /**
     * Redirige l’utilisateur non authentifié vers la page de login.
     */
    protected function redirectTo($request): ?string
    {
        // Si l'utilisateur est déjà connecté
        if (Auth::check()) {
            switch (Auth::user()->role) {
                case 'admin':
                    return route('admin.dashboard');
                case 'responsable':
                    return route('responsable.interface');
                case 'stagiaire':
                    return route('stagiaire.dashboard');
                default:
                    return route('/'); // fallback
            }
        }

        // Si l'utilisateur n'est pas connecté et qu'il n'attend pas du JSON
        if (! $request->expectsJson()) {
            return route('login');
        }

        return null;
    }
}
