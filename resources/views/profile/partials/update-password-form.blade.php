<section>
    <header>
        <h2 class="panel-title">
            Mot de passe
        </h2>

        <p class="mt-1 text-sm text-muted">
            Choisissez un mot de passe long et difficile à deviner.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6">
        @csrf
        @method('put')

        <div class="field">
            <x-input-label for="update_password_current_password" :value="'Mot de passe actuel'" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div class="field">
            <x-input-label for="update_password_password" :value="'Nouveau mot de passe'" />
            <x-text-input id="update_password_password" name="password" type="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" />
        </div>

        <div class="field">
            <x-input-label for="update_password_password_confirmation" :value="'Confirmation'" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Enregistrer</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-700"
                >Enregistré.</p>
            @endif
        </div>
    </form>
</section>
