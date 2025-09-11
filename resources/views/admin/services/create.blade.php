@extends('layouts.admin')

@section('title', 'Créer service')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Ajouter un service</h2>

    @error('nom_service')
        <div class="text-red-600 mb-2">{{ $message }}</div>
    @enderror

    <form action="{{ route('admin.services.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Nom du service</label>
                <input type="text" name="nom_service" value="{{ old('nom_service') }}" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Division</label>
                <select name="division_id" class="w-full border rounded p-2" required>
                    <option value="">— Choisir —</option>
                    @foreach($divisions as $d)
                        <option value="{{ $d->id }}" @selected(old('division_id') == $d->id)>{{ $d->nom_division }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Responsable (optionnel)</label>
                <select name="responsable_id" class="w-full border rounded p-2">
                    <option value="">— Aucun —</option>
                    @foreach($responsables as $u)
                        <option value="{{ $u->id }}" @selected(old('responsable_id') == $u->id)>{{ $u->nom }} {{ $u->prenom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-4">
            <button class="ml-3 text-gray-600">Enregistrer</button>
            <a href="{{ route('admin.services.index') }}" class="ml-3 text-gray-600">Annuler</a>
        </div>
    </form>
</div>
@endsection