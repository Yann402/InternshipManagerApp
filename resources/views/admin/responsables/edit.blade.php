@extends('layouts.admin')

@section('title', 'Éditer Responsable')

@section('content')
<h2 class="text-xl font-semibold mb-4">Éditer Responsable</h2>

<form action="{{ route('admin.responsables.update', $responsable) }}" method="POST" class="space-y-4">
    @csrf @method('PUT')

    <div>
        <label>Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $responsable->nom) }}" class="border p-2 w-full">
    </div>

    <div>
        <label>Prénom</label>
        <input type="text" name="prenom" value="{{ old('prenom', $responsable->prenom) }}" class="border p-2 w-full">
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $responsable->email) }}" class="border p-2 w-full">
    </div>

    <div>
        <label>Nouveau mot de passe (laisser vide pour garder)</label>
        <input type="password" name="password" class="border p-2 w-full">
    </div>

    <div>
        <label>Confirmer mot de passe</label>
        <input type="password" name="password_confirmation" class="border p-2 w-full">
    </div>

    <div>
        <label>Poste</label>
        <input type="text" name="poste" value="{{ old('poste', $responsable->poste) }}" class="border p-2 w-full">
    </div>

    <div>
        <label>Spécialité</label>
        <input type="text" name="specialite" value="{{ old('specialite', $responsable->specialite) }}" class="border p-2 w-full">
    </div>

    <div>
        <label>Service (optionnel)</label>
        <select name="service_id" class="border p-2 w-full">
            <option value="">— Aucun —</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}" {{ $responsable->service_id == $service->id ? 'selected' : '' }}>
                    {{ $service->nom_service }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">Mettre à jour</button>
</form>
@endsection