@extends('layouts.responsable')

@section('content')
<div class="container">
    <h2>Assignation d'un encadrant et d'une entreprise</h2>

    <form action="{{ route('responsable.demandes.assigner.store', $demande->id) }}" method="POST">
        @csrf

        {{-- === Encadrant === --}}
        <h4>Encadrant</h4>
        <div class="mb-3">
            <label for="encadrant_id" class="form-label">Choisir un encadrant existant</label>
            <select name="encadrant_id" id="encadrant_id" class="form-select">
                <option value="">-- Aucun (je vais en créer un nouveau) --</option>
                @foreach($encadrants as $encadrant)
                    <option value="{{ $encadrant->id }}">{{ $encadrant->nom }} {{ $encadrant->prenom }}</option>
                @endforeach
            </select>
        </div>

        <h5>Ou créer un nouvel encadrant</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nom</label>
                <input type="text" name="encadrant_nom" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Prénom</label>
                <input type="text" name="encadrant_prenom" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="encadrant_email" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Téléphone</label>
                <input type="text" name="encadrant_telephone" class="form-control">
            </div>
        </div>

        <hr>

        {{-- === Entreprise === --}}
        <h4>Entreprise</h4>
        <div class="mb-3">
            <label for="entreprise_id" class="form-label">Choisir une entreprise existante</label>
            <select name="entreprise_id" id="entreprise_id" class="form-select">
                <option value="">-- Aucune (je vais en créer une nouvelle) --</option>
                @foreach($entreprises as $entreprise)
                    <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                @endforeach
            </select>
        </div>

        <h5>Ou créer une nouvelle entreprise</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nom</label>
                <input type="text" name="entreprise_nom" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Adresse</label>
                <input type="text" name="entreprise_adresse" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="entreprise_email" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Téléphone</label>
                <input type="text" name="entreprise_telephone" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Secteur</label>
                <input type="text" name="entreprise_secteur" class="form-control">
            </div>
        </div>

        <hr>

        <button type="submit" class="btn btn-primary">Valider l'assignation</button>
    </form>
</div>
@endsection
