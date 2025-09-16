@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-6">➕ Créer un compte stagiaire</h2>

    <form method="POST" action="{{ route('admin.stagiaires.store') }}">
        @csrf

        <!-- Nom -->
        <div class="mb-4">
            <label for="nom" class="block font-medium">Nom</label>
            <input id="nom" type="text" name="nom" class="w-full border rounded p-2" required>
        </div>

        <!-- Prénom -->
        <div class="mb-4">
            <label for="prenom" class="block font-medium">Prénom</label>
            <input id="prenom" type="text" name="prenom" class="w-full border rounded p-2" required>
        </div>

        <!-- Formation -->
        <div class="mb-4">
            <label for="formation" class="block font-medium">Formation</label>
            <input id="formation" type="text" name="formation" class="w-full border rounded p-2">
        </div>

        <!-- Niveau d’études -->
        <div class="mb-4">
            <label for="niveau_etude" class="block font-medium">Niveau d’études</label>
            <input id="niveau_etude" type="text" name="niveau_etude" class="w-full border rounded p-2">
        </div>

        <!-- Téléphone -->
        <div class="mb-4">
            <label for="telephone" class="block font-medium">Téléphone</label>
            <input id="telephone" type="text" name="telephone" class="w-full border rounded p-2">
        </div>

        <!-- Adresse -->
        <div class="mb-4">
            <label for="adresse" class="block font-medium">Adresse</label>
            <input id="adresse" type="text" name="adresse" class="w-full border rounded p-2">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block font-medium">Email</label>
            <input id="email" type="email" name="email" class="w-full border rounded p-2" required>
        </div>

        <!-- Mot de passe -->
        <div class="mb-4">
            <label for="password" class="block font-medium">Mot de passe</label>
            <input id="password" type="password" name="password" class="w-full border rounded p-2" required>
        </div>

        <!-- Confirmation -->
        <div class="mb-4">
            <label for="password_confirmation" class="block font-medium">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="bg-blue-500 text-gray-100 px-4 py-2 rounded">Créer</button>
    </form>
</div>
@endsection