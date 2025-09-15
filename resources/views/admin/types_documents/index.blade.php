@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Types de documents</h1>

    <a href="{{ route('admin.types_documents.create') }}" 
       class="bg-blue-600 text-green-600 px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
       + Ajouter un type
    </a>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Libellé</th>
                <th class="border p-2">Obligatoire</th>
                <th class="border p-2">Fourni par</th>
                <th class="border p-2">Type fichier</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types_document as $type)
                <tr>
                    <td class="border p-2">{{ $type->libelle }}</td>
                    <td class="border p-2">{{ $type->obligatoire ? 'Oui' : 'Non' }}</td>
                    <td class="border p-2">{{ ucfirst($type->fourni_par) }}</td>
                    <td class="border p-2">{{ $type->type_fichier === 'pdf' ? 'PDF' : 'Image' }}</td>
                    <td class="border p-2 space-x-2">
                        <a href="{{ route('admin.types_documents.edit', $type) }}" class="text-blue-600">Modifier</a>
                        <form action="{{ route('admin.types_documents.destroy', $type) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Supprimer ce type ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
