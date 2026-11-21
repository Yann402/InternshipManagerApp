<x-guest-layout>
    <div class="mb-6 text-sm text-muted">
        Pour continuer, confirmez votre mot de passe.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="'Mot de passe'" />

            <x-text-input id="password"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-primary-button>
                Confirmer
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
