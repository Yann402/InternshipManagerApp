@extends('layouts.app')

@section('header')
    <div>
        <a href="{{ route('stagiaire.demandes.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Mes demandes</a>
        <h1 class="page-title">Modifier la demande #{{ $demande->id }}</h1>
    </div>
@endsection

@section('content')
    <form action="{{ route('stagiaire.demandes.update', $demande) }}" method="POST" class="panel panel-body max-w-xl">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="service_id" class="label">Service souhaité</label>
            <select id="service_id" name="service_id" class="input" required>
                @foreach($services as $s)
                    <option value="{{ $s->id }}" @if($demande->service_id == $s->id) selected @endif>{{ $s->nom_service }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Enregistrer les modifications</button>
            <a href="{{ route('stagiaire.demandes.index') }}" class="btn-secondary">Annuler</a>
        </div>
    </form>
@endsection
