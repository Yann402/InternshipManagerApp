@extends('layouts.admin')

@section('title', 'Créer division')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Ajouter une division</h2>

    @error('nom_division')
        <div class="text-red-600 mb-2">{{ $message }}</div>
    @enderror

    <form action="{{ route('admin.divisions.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block font-medium mb-1">Nom de la division</label>
            <input type="text" name="nom_division" value="{{ old('nom_division') }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <button class="ml-3 text-gray-600">Enregistrer</button>
            <a href="{{ route('admin.divisions.index') }}" class="ml-3 text-gray-600">Annuler</a>
        </div>
    </form>
</div>
@endsection