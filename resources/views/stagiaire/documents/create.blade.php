@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Uploader mes documents</h1>

    <form action="{{ route('stagiaire.documents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        @foreach($typesDocuments as $type)
            <div>
                <label class="block text-sm font-medium">
                    {{ $type->libelle }}
                    @if($type->obligatoire) <span class="text-red-500">*</span> @endif
                </label>
                
                <input 
                    type="file" 
                    name="documents[{{ $type->id }}]" 
                    class="w-full border rounded px-3 py-2"
                    accept="{{ $type->type_fichier === 'pdf' ? '.pdf' : 'image/*' }}"
                >

                @error("documents.{$type->id}") 
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        @endforeach

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Enregistrer
        </button>
    </form>
</div>
@endsection
