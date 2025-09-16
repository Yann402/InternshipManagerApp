@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">👨‍🎓 Liste des stagiaires</h2>

    <a href="{{ route('admin.stagiaires.create') }}" class="bg-indigo-500 text-green-600 px-4 py-2 rounded mb-4 inline-block">➕ Ajouter un stagiaire</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white border rounded-lg">
        <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
            <tr>
                <th class="py-3 px-6">Nom</th>
                <th class="py-3 px-6">Prénom</th>
                <th class="py-3 px-6">Email</th>
                <th class="py-3 px-6">Service</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stagiaires as $stagiaire)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-6">{{ $stagiaire->nom }}</td>
                    <td class="py-3 px-6">{{ $stagiaire->prenom }}</td>
                    <td class="py-3 px-6">{{ $stagiaire->email }}</td>
                    <td class="py-3 px-6">
                        <a href="{{ route('admin.stagiaires.show', $stagiaire->id) }}" 
                        class="bg-indigo-500 text-indigo-600 px-3 py-1 rounded">
                        Voir
                        </a>
                    </td>
                    <td class="py-3 px-6 text-center space-x-2">
                        <a href="{{ route('admin.stagiaires.edit', $stagiaire->id) }}" class="bg-blue-500 text-green-600 px-3 py-1 rounded">✏️ Modifier</a>
                        <form action="{{ route('admin.stagiaires.destroy', $stagiaire->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Supprimer ce stagiaire ?')" class="bg-red-500 text-red-600 px-3 py-1 rounded">🗑 Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-3">Aucun stagiaire trouvé</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
