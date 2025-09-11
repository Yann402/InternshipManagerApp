<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'formation' => ['nullable', 'string', 'max:255'],
            'niveau_etude' => ['nullable', 'string', 'max:255'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'adresse' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => $request->password,
            'formation' => $request->formation,
            'niveau_etude' => $request->niveau_etude,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ]);


        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('login');
    }
}
