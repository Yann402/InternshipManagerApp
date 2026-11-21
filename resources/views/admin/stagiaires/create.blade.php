@extends('layouts.admin')

@section('header')
    <div>
        <a href="{{ route('admin.stagiaires.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Stagiaires</a>
        <h1 class="page-title">Créer un compte stagiaire</h1>
    </div>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.stagiaires.store') }}" class="panel panel-body max-w-3xl">
    @csrf
    <div class="grid gap-x-4 sm:grid-cols-2">
        <div class="field"><label for="nom" class="label">Nom</label><input id="nom" type="text" name="nom" value="{{ old('nom') }}" class="input" required></div>
        <div class="field"><label for="prenom" class="label">Prénom</label><input id="prenom" type="text" name="prenom" value="{{ old('prenom') }}" class="input" required></div>
        <div class="field"><label for="formation" class="label">Formation</label><input id="formation" type="text" name="formation" value="{{ old('formation') }}" class="input"></div>
        <div class="field"><label for="niveau_etude" class="label">Niveau d'études</label><input id="niveau_etude" type="text" name="niveau_etude" value="{{ old('niveau_etude') }}" class="input"></div>
        <div class="field"><label for="telephone" class="label">Téléphone</label><input id="telephone" type="text" name="telephone" value="{{ old('telephone') }}" class="input"></div>
        <div class="field"><label for="adresse" class="label">Adresse</label><input id="adresse" type="text" name="adresse" value="{{ old('adresse') }}" class="input"></div>
        <div class="field sm:col-span-2"><label for="email" class="label">Adresse e-mail</label><input id="email" type="email" name="email" value="{{ old('email') }}" class="input" required></div>
        <div class="field"><label for="password" class="label">Mot de passe</label><input id="password" type="password" name="password" class="input" required></div>
        <div class="field"><label for="password_confirmation" class="label">Confirmation</label><input id="password_confirmation" type="password" name="password_confirmation" class="input" required></div>
    </div>
    <div class="flex items-center gap-3">
        <button type="submit" class="btn-primary">Créer le compte</button>
        <a href="{{ route('admin.stagiaires.index') }}" class="btn-secondary">Annuler</a>
    </div>
</form>
@endsection
