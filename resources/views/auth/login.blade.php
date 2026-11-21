<x-guest-layout>
    <h1 class="text-2xl font-semibold tracking-tight">Connexion</h1>
    <p class="mt-1 text-sm text-muted">Accédez à votre espace avec votre adresse e-mail.</p>

    <x-auth-session-status class="mt-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-8">
        @csrf

        <div class="field">
            <x-input-label for="email" value="Adresse e-mail" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="field">
            <div class="flex items-center justify-between">
                <x-input-label for="password" value="Mot de passe" />
                @if (Route::has('password.request'))
                    <a class="mb-1.5 text-sm link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                @endif
            </div>
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <label for="remember_me" class="mb-6 inline-flex items-center gap-2 text-sm text-muted">
            <input id="remember_me" type="checkbox" class="rounded border-line text-pine-700 focus:ring-pine-600" name="remember">
            Rester connecté
        </label>

        <x-primary-button class="w-full">Se connecter</x-primary-button>
    </form>

    @if (Route::has('register'))
        <p class="mt-8 text-sm text-muted">Pas encore de compte ? <a href="{{ route('register') }}" class="link">Créer un compte stagiaire</a></p>
    @endif
</x-guest-layout>
