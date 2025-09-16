@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
    <h2 class="text-xl font-semibold mb-4">✏️ Modifier le stagiaire</h2>

    <form action="{{ route('admin.stagiaires.update', $stagiaire->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Nom</label>
            <input type="text" name="nom" value="{{ old('nom', $stagiaire->nom) }}" class="w-full border p-2 rounded">
            @error('nom') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Prénom</label>
            <input type="text" name="prenom" value="{{ old('prenom', $stagiaire->prenom) }}" class="w-full border p-2 rounded">
            @error('prenom') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $stagiaire->email) }}" class="w-full border p-2 rounded">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Nouveau mot de passe (facultatif)</label>
            <input type="password" name="password" class="w-full border p-2 rounded">
            <input type="password" name="password_confirmation" placeholder="Confirmer" class="w-full border p-2 rounded mt-2">
        </div>

        <button type="submit" class="bg-blue-500 text-gray-100 px-4 py-2 rounded">💾 Mettre à jour</button>
        <a href="{{ route('admin.stagiaires.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">⬅ Retour</a>
    </form>
</div>
@endsection