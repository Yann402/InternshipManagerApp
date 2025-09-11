@extends('layouts.admin')

@section('title', 'Éditer division')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Modifier la division</h2>

    <form action="{{ route('admin.divisions.update', $division) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium mb-1">Nom de la division</label>
            <input type="text" name="nom_division" value="{{ old('nom_division', $division->nom_division) }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mt-4">
            <button class="ml-3 text-gray-600">Mettre à jour</button>
            <a href="{{ route('admin.divisions.index') }}" class="ml-3 text-gray-600">Annuler</a>
        </div>
    </form>
</div>
@endsection
