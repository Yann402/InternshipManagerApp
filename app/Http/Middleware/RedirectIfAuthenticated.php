<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch (Auth::user()->role) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'responsable':
                        return redirect()->route('responsable.interface');
                    case 'stagiaire':
                        return redirect()->route('stagiaire.dashboard');
                }
            }
        }

        return $next($request);
    }
}
