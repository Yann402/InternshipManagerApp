<x-guest-layout>
    <h1 class="text-2xl font-semibold tracking-tight">Créer un compte stagiaire</h1>
    <p class="mt-1 text-sm text-muted">Ces informations accompagneront vos demandes de stage.</p>

    <form method="POST" action="{{ route('register') }}" class="mt-8">
        @csrf

        <div class="grid grid-cols-1 gap-x-4 sm:grid-cols-2">
            <div class="field">
                <x-input-label for="nom" value="Nom" />
                <x-text-input id="nom" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="family-name" />
                <x-input-error :messages="$errors->get('nom')" />
            </div>
            <div class="field">
                <x-input-label for="prenom" value="Prénom" />
                <x-text-input id="prenom" type="text" name="prenom" :value="old('prenom')" required autocomplete="given-name" />
                <x-input-error :messages="$errors->get('prenom')" />
            </div>
        </div>

        <div class="field">
            <x-input-label for="formation" value="Formation" />
            <x-text-input id="formation" type="text" name="formation" :value="old('formation')" placeholder="Ex. : 1re année du cycle ingénieur en informatique" required />
            <x-input-error :messages="$errors->get('formation')" />
        </div>

        <div class="grid grid-cols-1 gap-x-4 sm:grid-cols-2">
            <div class="field">
                <x-input-label for="niveau_etude" value="Niveau d'études" />
                <x-text-input id="niveau_etude" type="text" name="niveau_etude" :value="old('niveau_etude')" placeholder="Ex. : Bac+3" required />
                <x-input-error :messages="$errors->get('niveau_etude')" />
            </div>
            <div class="field">
                <x-input-label for="telephone" value="Téléphone" />
                <x-text-input id="telephone" type="text" name="telephone" :value="old('telephone')" placeholder="06 00 00 00 00" required />
                <x-input-error :messages="$errors->get('telephone')" />
            </div>
        </div>

        <div class="field">
            <x-input-label for="adresse" value="Adresse" />
            <x-text-input id="adresse" type="text" name="adresse" :value="old('adresse')" required />
            <x-input-error :messages="$errors->get('adresse')" />
        </div>

        <div class="field">
            <x-input-label for="email" value="Adresse e-mail" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="grid grid-cols-1 gap-x-4 sm:grid-cols-2">
            <div class="field">
                <x-input-label for="password" value="Mot de passe" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>
            <div class="field">
                <x-input-label for="password_confirmation" value="Confirmation" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" />
            </div>
        </div>

        <x-primary-button class="w-full">Créer mon compte</x-primary-button>
    </form>

    <p class="mt-8 text-sm text-muted">Déjà inscrit ? <a href="{{ route('login') }}" class="link">Se connecter</a></p>
</x-guest-layout>
