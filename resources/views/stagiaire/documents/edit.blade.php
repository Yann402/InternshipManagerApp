@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Modifier le document</h1>

    <form action="{{ route('stagiaire.documents.update', $document) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">{{ $document->typeDocument->libelle }}</label>

            <input 
                type="file" 
                name="fichier" 
                class="w-full border rounded px-3 py-2"
                accept="{{ $document->typeDocument->type_fichier === 'pdf' ? '.pdf' : 'image/*' }}"
            >

            @error('fichier') 
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Mettre à jour
        </button>
    </form>
</div>
@endsection
