@extends('layouts.admin')

@section('header')
    <div>
        <a href="{{ route('admin.types_documents.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Pièces obligatoires</a>
        <h1 class="page-title">Modifier : {{ $types_document->libelle }}</h1>
    </div>
@endsection

@section('content')
<form action="{{ route('admin.types_documents.update', $types_document) }}" method="POST" class="panel panel-body max-w-xl">
    @csrf
    @method('PUT')
    @include('admin.types_documents._form', ['types_document' => $types_document])
    <div class="flex items-center gap-3">
        <button type="submit" class="btn-primary">Enregistrer les modifications</button>
        <a href="{{ route('admin.types_documents.index') }}" class="btn-secondary">Annuler</a>
    </div>
</form>
@endsection
