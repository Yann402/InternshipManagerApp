@extends('layouts.responsable')

@section('header')
    <div>
        <a href="{{ route('responsable.encadrants.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Encadrants</a>
        <h1 class="page-title">Modifier : {{ $encadrant->prenom }} {{ $encadrant->nom }}</h1>
    </div>
@endsection

@section('content')
<form action="{{ route('responsable.encadrants.update', $encadrant->id) }}" method="POST" class="panel panel-body max-w-2xl">
    @csrf @method('PUT')
    @include('responsable.encadrants._form', ['encadrant' => $encadrant])
    <div class="flex items-center gap-3">
        <button class="btn-primary">Enregistrer les modifications</button>
        <a href="{{ route('responsable.encadrants.index') }}" class="btn-secondary">Annuler</a>
    </div>
</form>
@endsection
