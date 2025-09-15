@extends('layouts.admin')

@section('title', 'Responsables')

@section('content')
<div class="flex justify-between mb-4">
    <h2 class="text-xl font-semibold">Liste des responsables</h2>
    <a href="{{ route('admin.responsables.create') }}" class="px-4 py-2 bg-green-600 text-green-600 mr-4 rounded">+ Ajouter</a>
</div>

<table class="w-full bg-white rounded shadow">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2 text-left">Nom</th>
            <th class="p-2 text-left">Prénom</th>
            <th class="p-2 text-left">Email</th>
            <th class="p-2 text-left">Poste</th>
            <th class="p-2 text-left">Spécialité</th>
            <th class="p-2 text-left">Service</th>
            <th class="p-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($responsables as $r)
        <tr class="border-t">
            <td class="p-2">{{ $r->nom }}</td>
            <td class="p-2">{{ $r->prenom }}</td>
            <td class="p-2">{{ $r->email }}</td>
            <td class="p-2">{{ $r->poste ?? '—' }}</td>
            <td class="p-2">{{ $r->specialite ?? '—' }}</td>
            <td class="p-2">
                {{ optional($r->service)->nom_service ?? '— Aucun —' }}
            </td>
            <td class="p-2 space-x-2">
                <a href="{{ route('admin.responsables.edit', $r) }}" class="text-blue-600">Éditer</a>
                <form action="{{ route('admin.responsables.destroy', $r) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Supprimer ?')" class="text-red-600">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $responsables->links() }}
</div>
@endsection
