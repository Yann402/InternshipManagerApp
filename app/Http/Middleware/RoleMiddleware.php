<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles)
    {

        // 1) Récupérer l'utilisateur connecté
        $user = $request->user(); // équivalent à Auth::user()

        // 2) Supporter plusieurs rôles séparés par une virgule ou pipe
        $accepted = array_map('trim', preg_split('/[|,]/', $roles));

        // 3) Si rôle correspondant → laisser passer
        if (in_array($user->role, $accepted, true)) {
            return $next($request);
        }

        // 4) Sinon : accès refusé (403) ou redirection personnalisée
        abort(403, 'Accès non autorisé.');
    }
}
