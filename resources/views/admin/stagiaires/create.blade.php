@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
    <h2 class="text-xl font-semibold mb-4">➕ Ajouter un stagiaire</h2>

    <form action="{{ route('admin.stagiaires.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Nom</label>
            <input type="text" name="nom" value="{{ old('nom') }}" class="w-full border p-2 rounded">
            @error('nom') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Prénom</label>
            <input type="text" name="prenom" value="{{ old('prenom') }}" class="w-full border p-2 rounded">
            @error('prenom') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2 rounded">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Mot de passe</label>
            <input type="password" name="password" class="w-full border p-2 rounded">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Service</label>
            <select name="service_id" class="w-full border p-2 rounded">
                <option value="">-- Sélectionner un service --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->libelle }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-green-500 text-green-600 px-4 py-2 rounded">✅ Enregistrer</button>
        <a href="{{ route('admin.stagiaires.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">⬅ Retour</a>
    </form>
</div>
@endsection
