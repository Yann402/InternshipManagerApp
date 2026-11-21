@extends('layouts.responsable')

@section('header')
    <div>
        <a href="{{ route('responsable.encadrants.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Encadrants</a>
        <h1 class="page-title">Ajouter un encadrant</h1>
    </div>
@endsection

@section('content')
<form action="{{ route('responsable.encadrants.store') }}" method="POST" class="panel panel-body max-w-2xl">
    @csrf
    @include('responsable.encadrants._form')
    <div class="flex items-center gap-3">
        <button class="btn-primary">Enregistrer</button>
        <a href="{{ route('responsable.encadrants.index') }}" class="btn-secondary">Annuler</a>
    </div>
</form>
@endsection
