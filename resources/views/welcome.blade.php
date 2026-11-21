<x-guest-layout>
    <h1 class="text-2xl font-semibold tracking-tight">Bienvenue</h1>
    <p class="mt-2 text-sm text-muted">Cette plateforme permet aux étudiants de déposer leur demande de stage au CHU Ibn Sina, et aux services de la traiter en ligne.</p>

    <div class="mt-8 space-y-3">
        @auth
            @php
                $home = match (Auth::user()->role) {
                    'admin' => route('admin.dashboard'),
                    'responsable' => route('responsable.interface'),
                    default => route('stagiaire.dashboard'),
                };
            @endphp
            <a href="{{ $home }}" class="btn-primary w-full">Accéder à mon espace</a>
        @else
            <a href="{{ route('login') }}" class="btn-primary w-full">Se connecter</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-secondary w-full">Créer un compte stagiaire</a>
            @endif
        @endauth
    </div>
</x-guest-layout>
