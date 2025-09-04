<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View  // RedirectResponse|View
    {
        // if (Auth::check()) {
        // // Redirection selon rôle
        // switch (Auth::user()->role) {
        //     case 'admin':
        //         return redirect()->route('admin.dashboard');
        //     case 'responsable':
        //         return redirect()->route('responsable.interface');
        //     case 'stagiaire':
        //         return redirect()->route('stagiaire.interface');
        // }
        // }
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // redirection selon rôle
        $user = $request->user();
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'responsable':
                return redirect()->route('responsable.interface');
            case 'stagiaire':
                return redirect()->route('stagiaire.dashboard');
            default:
                return redirect()->route('/');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
