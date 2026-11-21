@extends('layouts.admin')

@section('header')
    <div>
        <a href="{{ route('admin.types_documents.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Pièces obligatoires</a>
        <h1 class="page-title">Ajouter un document</h1>
    </div>
@endsection

@section('content')
<form action="{{ route('admin.types_documents.store') }}" method="POST" class="panel panel-body max-w-xl">
    @csrf
    @include('admin.types_documents._form')
    <div class="flex items-center gap-3">
        <button type="submit" class="btn-primary">Enregistrer</button>
        <a href="{{ route('admin.types_documents.index') }}" class="btn-secondary">Annuler</a>
    </div>
</form>
@endsection
