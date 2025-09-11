@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">Mes demandes</h2>

    <div class="bg-white shadow rounded p-4">
        <a href="{{ route('stagiaire.demandes.create') }}"
           class="mb-4 inline-block bg-blue-600 text-green-600 px-4 py-2 rounded hover:bg-blue-700">
            + Nouvelle demande
        </a>

        @if($demandes->isEmpty())
            <p class="text-gray-500">Aucune demande trouvée.</p>
        @else
            <table class="w-full border border-gray-200 text-sm">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Statut</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($demandes as $demande)
                    <tr>
                        <td class="px-4 py-2 border">{{ $demande->id }}</td>
                        <td class="px-4 py-2 border">{{ $demande->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 border">
                            <span class="px-2 py-1 rounded text-xs 
                                @if($demande->statut === 'en_attente') bg-yellow-200 text-yellow-800
                                @elseif($demande->statut === 'en_cours') bg-blue-200 text-blue-800
                                @elseif($demande->statut === 'validée') bg-green-200 text-green-800
                                @elseif($demande->statut === 'refusée') bg-red-200 text-red-800
                                @endif">
                                {{ ucfirst($demande->statut) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border space-x-2">
                            <a href="{{ route('stagiaire.demandes.show', $demande) }}"
                               class="text-blue-600 hover:underline">Détails</a>

                            @if(in_array($demande->statut, ['en_attente','refusée']))
                                <a href="{{ route('stagiaire.demandes.edit', $demande) }}"
                                   class="text-yellow-600 hover:underline">Modifier</a>
                                <form action="{{ route('stagiaire.demandes.destroy', $demande) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Supprimer cette demande ?')"
                                            class="text-red-600 hover:underline">Supprimer</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
