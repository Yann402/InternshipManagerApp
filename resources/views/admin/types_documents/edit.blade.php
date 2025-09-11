@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-lg">
    <h1 class="text-2xl font-bold mb-6">Modifier un type de document</h1>

    <form action="{{ route('admin.types_documents.update', $types_document) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Libellé</label>
            <input type="text" name="libelle" value="{{ old('libelle', $types_document->libelle) }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300">
            @error('libelle') 
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Obligatoire</label>
            <input type="checkbox" name="obligatoire" value="1" {{ old('obligatoire', $types_document->obligatoire) ? 'checked' : '' }}>
        </div>

        <div>
            <label class="block text-sm font-medium">Fourni par</label>
            <select name="fourni_par" class="w-full border rounded px-3 py-2">
                <option value="stagiaire" {{ old('fourni_par', $types_document->fourni_par) === 'stagiaire' ? 'selected' : '' }}>Stagiaire</option>
                <option value="responsable" {{ old('fourni_par', $types_document->fourni_par) === 'responsable' ? 'selected' : '' }}>Responsable</option>
            </select>
            @error('fourni_par') 
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" 
                class="bg-blue-600 text-gray-100 px-4 py-2 rounded hover:bg-blue-700">
            Mettre à jour
        </button>
    </form>
</div>
@endsection