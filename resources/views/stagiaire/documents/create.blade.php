@extends('layouts.app')

@section('header')
    <div>
        <a href="{{ route('stagiaire.documents.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Mes documents</a>
        <h1 class="page-title">Ajouter des documents</h1>
        <p class="page-sub">Les pièces marquées d'un astérisque sont obligatoires.</p>
    </div>
@endsection

@section('content')
<form action="{{ route('stagiaire.documents.store') }}" method="POST" enctype="multipart/form-data" class="max-w-3xl space-y-6">
    @csrf
    <section class="panel panel-body">
        <div class="divide-y divide-line">
            @foreach($typesDocuments as $type)
                <div class="grid gap-2 py-4 first:pt-0 last:pb-0 sm:grid-cols-[14rem_1fr] sm:items-center">
                    <label for="doc-{{ $type->id }}" class="text-sm font-medium">
                        {{ $type->libelle }}
                        @if($type->obligatoire) <span class="text-red-700" aria-label="obligatoire">*</span> @endif
                        <span class="block text-xs font-normal text-muted">{{ $type->type_fichier === 'pdf' ? 'PDF' : 'Image' }}</span>
                    </label>
                    <div>
                        <input type="file" id="doc-{{ $type->id }}" name="documents[{{ $type->id }}]" class="input-file"
                            accept="{{ $type->type_fichier === 'pdf' ? '.pdf' : 'image/*' }}">
                        @error("documents.{$type->id}") <p class="error">{{ $message }}</p> @enderror
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <div class="flex items-center gap-3">
        <button type="submit" class="btn-primary">Enregistrer</button>
        <a href="{{ route('stagiaire.documents.index') }}" class="btn-secondary">Annuler</a>
    </div>
</form>
@endsection
