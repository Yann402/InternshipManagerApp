@extends('layouts.responsable')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">👨‍🏫 Encadrants</h2>

    <a href="{{ route('responsable.encadrants.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">➕ Ajouter</a>

    <table class="min-w-full bg-white border rounded-lg">
        <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
            <tr>
                <th class="py-3 px-6 text-left">Nom</th>
                <th class="py-3 px-6 text-left">Prénom</th>
                <th class="py-3 px-6 text-left">Email</th>
                <th class="py-3 px-6 text-left">Téléphone</th>
                <th class="py-3 px-6 text-left">Spécialité</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
            @forelse($encadrants as $encadrant)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-6">{{ $encadrant->nom }}</td>
                    <td class="py-3 px-6">{{ $encadrant->prenom }}</td>
                    <td class="py-3 px-6">{{ $encadrant->email }}</td>
                    <td class="py-3 px-6">{{ $encadrant->telephone }}</td>
                    <td class="py-3 px-6">{{ $encadrant->specialite }}</td>
                    <td class="py-3 px-6 text-center space-x-2">
                        <a href="{{ route('responsable.encadrants.edit', $encadrant->id) }}" 
                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">✏️ Modifier</a>

                        <form action="{{ route('responsable.encadrants.destroy', $encadrant->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">🗑 Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-3">Aucun encadrant enregistré</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
