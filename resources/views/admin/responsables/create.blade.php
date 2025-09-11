@extends('layouts.admin')

@section('title', 'Créer Responsable')

@section('content')
<h2 class="text-xl font-semibold mb-4">Créer un Responsable</h2>

<form action="{{ route('admin.responsables.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label>Nom</label>
        <input type="text" name="nom" value="{{ old('nom') }}" class="border p-2 w-full">
    </div>

    <div>
        <label>Prénom</label>
        <input type="text" name="prenom" value="{{ old('prenom') }}" class="border p-2 w-full">
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="border p-2 w-full">
    </div>

    <div>
        <label>Mot de passe</label>
        <input type="password" name="password" class="border p-2 w-full">
    </div>

    <div>
        <label>Confirmer mot de passe</label>
        <input type="password" name="password_confirmation" class="border p-2 w-full">
    </div>

    <div>
        <label>Poste</label>
        <input type="text" name="poste" value="{{ old('poste') }}" class="border p-2 w-full">
    </div>

    <div>
        <label>Spécialité</label>
        <input type="text" name="specialite" value="{{ old('specialite') }}" class="border p-2 w-full">
    </div>

    <div>
        <label>Service (optionnel)</label>
        <select name="service_id" class="border p-2 w-full">
            <option value="">— Aucun —</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->nom_service }}</option>
            @endforeach
        </select>
    </div>

    <button class="px-4 py-2 bg-green-600 text-gray rounded">Créer</button>
</form>
@endsection