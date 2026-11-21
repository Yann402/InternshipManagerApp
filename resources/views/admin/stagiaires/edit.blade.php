@extends('layouts.admin')

@section('header')
    <div>
        <a href="{{ route('admin.stagiaires.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Stagiaires</a>
        <h1 class="page-title">Modifier : {{ $stagiaire->prenom }} {{ $stagiaire->nom }}</h1>
    </div>
@endsection

@section('content')
<form action="{{ route('admin.stagiaires.update', $stagiaire->id) }}" method="POST" class="panel panel-body max-w-2xl">
    @csrf @method('PUT')
    <div class="grid gap-x-4 sm:grid-cols-2">
        <div class="field">
            <label for="nom" class="label">Nom</label>
            <input id="nom" type="text" name="nom" value="{{ old('nom', $stagiaire->nom) }}" class="input">
            @error('nom') <p class="error">{{ $message }}</p> @enderror
        </div>
        <div class="field">
            <label for="prenom" class="label">Prénom</label>
            <input id="prenom" type="text" name="prenom" value="{{ old('prenom', $stagiaire->prenom) }}" class="input">
            @error('prenom') <p class="error">{{ $message }}</p> @enderror
        </div>
        <div class="field sm:col-span-2">
            <label for="email" class="label">Adresse e-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email', $stagiaire->email) }}" class="input">
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>
        <div class="field">
            <label for="password" class="label">Nouveau mot de passe <span class="font-normal text-muted">(facultatif)</span></label>
            <input id="password" type="password" name="password" class="input">
        </div>
        <div class="field">
            <label for="password_confirmation" class="label">Confirmation</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="input">
        </div>
    </div>
    <div class="flex items-center gap-3">
        <button type="submit" class="btn-primary">Enregistrer les modifications</button>
        <a href="{{ route('admin.stagiaires.index') }}" class="btn-secondary">Annuler</a>
    </div>
</form>
@endsection
