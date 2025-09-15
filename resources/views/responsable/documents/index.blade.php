@extends('layouts.responsable')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <h2 class="text-lg font-semibold mb-4">📄 Documents fournis par les stagiaires</h2>

    <table class="min-w-full bg-white border rounded-lg mb-6">
        <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
            <tr>
                <th class="py-3 px-6">Type</th>
                <th class="py-3 px-6">Demande</th>
                <th class="py-3 px-6">Statut</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($docsStagiaire as $doc)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-6">{{ $doc->typeDocument->libelle }}</td>
                    <td class="py-3 px-6">#{{ $doc->demande_id }}</td>
                    <td class="py-3 px-6">{{ ucfirst($doc->statut) }}</td>
                    <td class="py-3 px-6 text-center space-x-2">
                        <a href="{{ route('responsable.documents.show', $doc->id) }}"
                           class="bg-blue-500 text-gray-100 px-3 py-1 rounded">Voir</a>

                        <form action="{{ route('responsable.documents.update', $doc->id) }}" method="POST" class="inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="statut" value="valide">
                            <button class="bg-green-500 text-gray-100 px-3 py-1 rounded">Valider</button>
                        </form>

                        <form action="{{ route('responsable.documents.update', $doc->id) }}" method="POST" class="inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="statut" value="refuse">
                            <button class="bg-red-500 text-gray-100 px-3 py-1 rounded">Refuser</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-3">Aucun document stagiaire trouvé</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2 class="text-lg font-semibold mb-4">📑 Documents générés par le responsable</h2>

    <table class="min-w-full bg-white border rounded-lg">
        <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
            <tr>
                <th class="py-3 px-6">Type</th>
                <th class="py-3 px-6">Demande</th>
                <th class="py-3 px-6">Statut</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($docsResponsable as $doc)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-6">{{ $doc->typeDocument->libelle }}</td>
                    <td class="py-3 px-6">#{{ $doc->demande_id }}</td>
                    <td class="py-3 px-6">{{ ucfirst($doc->statut) }}</td>
                    <td class="py-3 px-6 text-center space-x-2">
                        @if($doc->chemin_fichier)
                            <a href="{{ route('responsable.documents.show', $doc->id) }}"
                               class="bg-blue-500 text-gray-100 px-3 py-1 rounded">Voir</a>

                            {{-- Bouton Modifier --}}
                            <form action="{{ route('responsable.documents.store') }}" 
                                method="POST" enctype="multipart/form-data" 
                                class="inline"
                                onsubmit="return checkFile(this)">
                                @csrf
                                <input type="hidden" name="demande_id" value="{{ $doc->demande_id }}">
                                <input type="hidden" name="type_document_id" value="{{ $doc->type_document_id }}">
                                <input type="file" name="document" class="mb-2">
                                <button type="submit" class="bg-yellow-500 text-gray-100 px-3 py-1 rounded">Modifier</button>
                            </form>

                            <script>
                            function checkFile(form) {
                                const fileInput = form.querySelector('input[name="document"]');
                                if (!fileInput.value) {
                                    alert("⚠️ Choisissez un fichier avant de cliquer sur Modifier !");
                                    return false; // bloque la soumission
                                }
                                return true;
                            }
                            </script>



                            {{-- Bouton Supprimer --}}
                            <form action="{{ route('responsable.documents.destroy', $doc->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-gray-100 px-3 py-1 rounded">Supprimer</button>
                            </form>
                        @else
                        <form action="{{ route('responsable.documents.store') }}" 
                            method="POST" 
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="demande_id" value="{{ $doc->demande_id }}">
                            <input type="hidden" name="type_document_id" value="{{ $doc->type_document_id }}">

                            <input type="file" name="document" class="mb-2">
                            <button type="submit">Générer</button>
                        </form>

                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-3">Aucun document responsable trouvé</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
