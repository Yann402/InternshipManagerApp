@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-lg">
    <h1 class="text-2xl font-bold mb-6">Ajouter un type de document</h1>

    <form action="{{ route('admin.types_documents.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium">Libellé</label>
            <input type="text" name="libelle" value="{{ old('libelle') }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300">
            @error('libelle') 
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Obligatoire</label>
            <input type="checkbox" name="obligatoire" value="1" {{ old('obligatoire') ? 'checked' : '' }}>
        </div>

        <div>
            <label class="block text-sm font-medium">Fourni par</label>
            <select name="fourni_par" class="w-full border rounded px-3 py-2">
                <option value="stagiaire" {{ old('fourni_par') === 'stagiaire' ? 'selected' : '' }}>Stagiaire</option>
                <option value="responsable" {{ old('fourni_par') === 'responsable' ? 'selected' : '' }}>Responsable</option>
            </select>
            @error('fourni_par') 
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Type de fichier attendu</label>
            <select name="type_fichier" class="w-full border rounded px-3 py-2">
                <option value="pdf" {{ old('type_fichier') === 'pdf' ? 'selected' : '' }}>PDF</option>
                <option value="image" {{ old('type_fichier') === 'image' ? 'selected' : '' }}>Image (jpg, jpeg, png)</option>
            </select>
            @error('type_fichier') 
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" 
                class="bg-blue-600 text-gray-100 px-4 py-2 rounded hover:bg-blue-700">
            Enregistrer
        </button>
    </form>
</div>
@endsection
