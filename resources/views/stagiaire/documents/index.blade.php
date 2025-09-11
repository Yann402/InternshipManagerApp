@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Mes documents (Demande #{{ $demande->id }})</h1>

    <a href="{{ route('stagiaire.documents.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
       Ajouter des documents
    </a>

    {{-- Documents fournis par le stagiaire --}}
    <h2 class="text-lg font-semibold mt-6">📄 Documents fournis par moi</h2>
    <table class="w-full border-collapse border border-gray-300 mt-2">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Type</th>
                <th class="border p-2">Statut</th>
                <th class="border p-2">Fichier</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $st_types = $typesDocuments->where('fourni_par', 'stagiaire');
            @endphp

            @forelse ($st_types as $type)
                @php
                    // cherche le document (s'il existe) lié à ce type pour la demande courante
                    $doc = $documents->firstWhere('type_document_id', $type->id);
                @endphp
                <tr>
                    <td class="border p-2">{{ $type->libelle }}</td>
                    <td class="border p-2">
                        {{ $doc ? ucfirst(str_replace('_',' ', $doc->statut)) : 'Non fourni' }}
                    </td>
                    <td class="border p-2">
                        @if ($doc && $doc->chemin_fichier)
                            <a href="{{ asset('storage/'.$doc->chemin_fichier) }}" target="_blank" class="text-blue-600">Voir</a>
                        @else
                            <span class="text-gray-500">Aucun fichier</span>
                        @endif
                    </td>
                    <td class="border p-2 space-x-2">
                        @if($doc)
                            <a href="{{ route('stagiaire.documents.edit', $doc) }}" class="text-blue-600">Modifier</a>
                            <form action="{{ route('stagiaire.documents.destroy', $doc) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600" onclick="return confirm('Supprimer ce document ?')">Supprimer</button>
                            </form>
                        @else
                            <a href="{{ route('stagiaire.documents.create') }}" class="text-green-600">Ajouter</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border p-2 text-center text-gray-500">Aucun type de document configuré</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Documents générés par le responsable --}}
    <h2 class="text-lg font-semibold mt-6">📑 Documents générés par le responsable</h2>
    <table class="w-full border-collapse border border-gray-300 mt-2">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Type</th>
                <th class="border p-2">Statut</th>
                <th class="border p-2">Fichier</th>
            </tr>
        </thead>
        <tbody>
            @php $r_types = $typesDocuments->where('fourni_par', 'responsable'); @endphp

            @forelse ($r_types as $type)
                @php $doc = $documents->firstWhere('type_document_id', $type->id); @endphp
                <tr>
                    <td class="border p-2">{{ $type->libelle }}</td>
                    <td class="border p-2">
                        {{ $doc ? ucfirst(str_replace('_',' ', $doc->statut)) : 'Non disponible' }}
                    </td>
                    <td class="border p-2">
                        @if ($doc && $doc->chemin_fichier)
                            <a href="{{ asset('storage/'.$doc->chemin_fichier) }}" target="_blank" class="text-blue-600">Télécharger</a>
                        @else
                            <span class="text-gray-500">Non disponible</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="border p-2 text-center text-gray-500">Aucun type généré</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection