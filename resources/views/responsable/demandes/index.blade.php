@extends('layouts.responsable')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">📥 Demandes reçues</h2>

    <table class="min-w-full bg-white border rounded-lg">
        <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
            <tr>
                <th class="py-3 px-6 text-left">Stagiaire</th>
                <th class="py-3 px-6 text-left">Date soumission</th>
                <th class="py-3 px-6 text-left">Statut</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
            @forelse($demandes as $demande)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-6">{{ $demande->stagiaire->nom }} {{ $demande->stagiaire->prenom }}</td>
                    <td class="py-3 px-6">{{ $demande->date_soumission ?? $demande->created_at->format('d/m/Y') }}</td>
                    <td class="py-3 px-6">
                        <span class="px-2 py-1 rounded text-xs
                            @if($demande->statut == 'en_attente') bg-yellow-200 text-yellow-800
                            @elseif($demande->statut == 'en_cours') bg-blue-200 text-blue-800
                            @elseif($demande->statut == 'validée') bg-green-200 text-green-800
                            @else bg-red-200 text-red-800 @endif">
                            {{ ucfirst($demande->statut) }}
                        </span>
                    </td>
                    <td class="py-3 px-6 text-center space-x-2">
                        <a href="{{ route('responsable.demandes.show', $demande->id) }}"
                           class="bg-blue-500 text-gray-100 px-3 py-1 rounded hover:bg-blue-600">Détails</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-3">Aucune demande reçue</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
