@extends('layouts.responsable')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">➕ Ajouter un encadrant</h2>

    <form action="{{ route('responsable.encadrants.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block">Nom</label>
            <input type="text" name="nom" class="border rounded px-3 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block">Prénom</label>
            <input type="text" name="prenom" class="border rounded px-3 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block">Email</label>
            <input type="email" name="email" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block">Téléphone</label>
            <input type="text" name="telephone" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block">Spécialité</label>
            <input type="text" name="specialite" class="border rounded px-3 py-2 w-full">
        </div>
        <button class="bg-blue-500 text-gray-100 px-4 py-2 rounded hover:bg-blue-600">Enregistrer</button>
    </form>
</div>
@endsection
