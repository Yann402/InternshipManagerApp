@extends('layouts.app')

@section('header')
    <div>
        <a href="{{ route('stagiaire.documents.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Mes documents</a>
        <h1 class="page-title">Remplacer : {{ $document->typeDocument->libelle }}</h1>
    </div>
@endsection

@section('content')
<form action="{{ route('stagiaire.documents.update', $document) }}" method="POST" enctype="multipart/form-data" class="panel panel-body max-w-xl">
    @csrf
    @method('PUT')
    <div class="field">
        <label for="fichier" class="label">Nouveau fichier ({{ $document->typeDocument->type_fichier === 'pdf' ? 'PDF' : 'image' }})</label>
        <input type="file" id="fichier" name="fichier" class="input-file"
            accept="{{ $document->typeDocument->type_fichier === 'pdf' ? '.pdf' : 'image/*' }}">
        @error('fichier') <p class="error">{{ $message }}</p> @enderror
    </div>
    <div class="flex items-center gap-3">
        <button type="submit" class="btn-primary">Mettre à jour</button>
        <a href="{{ route('stagiaire.documents.index') }}" class="btn-secondary">Annuler</a>
    </div>
</form>
@endsection
