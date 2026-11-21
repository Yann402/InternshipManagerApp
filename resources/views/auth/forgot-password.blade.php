<x-guest-layout>
    <div class="mb-6 text-sm text-muted">
        Indiquez votre adresse e-mail : vous recevrez un lien pour choisir un nouveau mot de passe.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="'Adresse e-mail'" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="mt-6 flex items-center justify-end">
            <x-primary-button>
                Recevoir le lien
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
