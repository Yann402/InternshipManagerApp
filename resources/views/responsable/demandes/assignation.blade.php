@extends('layouts.responsable')

@section('header')
    <div>
        <a href="{{ route('responsable.demandes.show', $demande->id) }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Retour à la demande</a>
        <h1 class="page-title">Accepter la demande #{{ $demande->id }}</h1>
        <p class="page-sub">Choisissez un encadrant et une structure d'accueil existants, ou créez-les.</p>
    </div>
@endsection

@section('content')
<form action="{{ route('responsable.demandes.assigner.store', $demande->id) }}" method="POST" class="max-w-3xl space-y-6">
    @csrf

    <section class="panel panel-body">
        <h2 class="panel-title">Encadrant</h2>
        <div class="mt-4">
            <label for="encadrant_id" class="label">Encadrant existant</label>
            <select name="encadrant_id" id="encadrant_id" class="input">
                <option value="">Aucun, j'en crée un nouveau</option>
                @foreach($encadrants as $encadrant)
                    <option value="{{ $encadrant->id }}">{{ $encadrant->nom }} {{ $encadrant->prenom }}</option>
                @endforeach
            </select>
        </div>
        <fieldset class="mt-6 border-t border-line pt-5">
            <legend class="text-sm font-medium text-muted">Ou nouvel encadrant</legend>
            <div class="mt-3 grid gap-x-4 sm:grid-cols-2">
                <div class="field"><label class="label" for="encadrant_nom">Nom</label><input id="encadrant_nom" type="text" name="encadrant_nom" class="input"></div>
                <div class="field"><label class="label" for="encadrant_prenom">Prénom</label><input id="encadrant_prenom" type="text" name="encadrant_prenom" class="input"></div>
                <div class="field"><label class="label" for="encadrant_email">E-mail</label><input id="encadrant_email" type="email" name="encadrant_email" class="input"></div>
                <div class="field"><label class="label" for="encadrant_telephone">Téléphone</label><input id="encadrant_telephone" type="text" name="encadrant_telephone" class="input"></div>
            </div>
        </fieldset>
    </section>

    <section class="panel panel-body">
        <h2 class="panel-title">Structure d'accueil</h2>
        <div class="mt-4">
            <label for="entreprise_id" class="label">Structure existante</label>
            <select name="entreprise_id" id="entreprise_id" class="input">
                <option value="">Aucune, j'en crée une nouvelle</option>
                @foreach($entreprises as $entreprise)
                    <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                @endforeach
            </select>
        </div>
        <fieldset class="mt-6 border-t border-line pt-5">
            <legend class="text-sm font-medium text-muted">Ou nouvelle structure</legend>
            <div class="mt-3 grid gap-x-4 sm:grid-cols-2">
                <div class="field"><label class="label" for="entreprise_nom">Nom</label><input id="entreprise_nom" type="text" name="entreprise_nom" class="input"></div>
                <div class="field"><label class="label" for="entreprise_secteur">Secteur</label><input id="entreprise_secteur" type="text" name="entreprise_secteur" class="input"></div>
                <div class="field sm:col-span-2"><label class="label" for="entreprise_adresse">Adresse</label><input id="entreprise_adresse" type="text" name="entreprise_adresse" class="input"></div>
                <div class="field"><label class="label" for="entreprise_email">E-mail</label><input id="entreprise_email" type="email" name="entreprise_email" class="input"></div>
                <div class="field"><label class="label" for="entreprise_telephone">Téléphone</label><input id="entreprise_telephone" type="text" name="entreprise_telephone" class="input"></div>
            </div>
        </fieldset>
    </section>

    <div class="flex items-center gap-3">
        <button type="submit" class="btn-success">Valider l'affectation</button>
        <a href="{{ route('responsable.demandes.show', $demande->id) }}" class="btn-secondary">Annuler</a>
    </div>
</form>
@endsection
