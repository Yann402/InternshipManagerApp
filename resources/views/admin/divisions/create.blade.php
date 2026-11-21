@extends('layouts.admin')

@section('header')
    <div>
        <a href="{{ route('admin.divisions.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Divisions</a>
        <h1 class="page-title">Nouvelle division</h1>
    </div>
@endsection

@section('content')
<form action="{{ route('admin.divisions.store') }}" method="POST" class="panel panel-body max-w-xl">
    @csrf
    <div class="field">
        <label for="nom_division" class="label">Nom de la division</label>
        <input id="nom_division" type="text" name="nom_division" value="{{ old('nom_division') }}" class="input" required>
        @error('nom_division') <p class="error">{{ $message }}</p> @enderror
    </div>
    <div class="flex items-center gap-3">
        <button class="btn-primary">Enregistrer</button>
        <a href="{{ route('admin.divisions.index') }}" class="btn-secondary">Annuler</a>
    </div>
</form>
@endsection
