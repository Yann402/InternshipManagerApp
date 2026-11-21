@extends('layouts.responsable')

@section('header')
    <div>
        <h1 class="page-title">Bonjour {{ Auth::user()->prenom }}</h1>
        <p class="page-sub">Voici l'état des demandes et des documents de votre service.</p>
    </div>
    <a href="{{ route('responsable.demandes.index') }}" class="btn-primary">Traiter les demandes</a>
@endsection

@section('content')
    <h2 class="section-title">Demandes</h2>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ([
            ['demandes_en_attente', 'en_attente', 'En attente'],
            ['demandes_en_cours', 'en_cours', 'En cours'],
            ['demandes_validees', 'validée', 'Validées'],
            ['demandes_refusees', 'refusée', 'Refusées'],
        ] as [$key, $status, $label])
            <div class="stat">
                <x-status :value="$status" />
                <p class="stat-value">{{ $stats[$key] ?? 0 }}</p>
            </div>
        @endforeach
    </div>

    <h2 class="section-title mt-8">Documents et encadrement</h2>
    <div class="grid gap-4 sm:grid-cols-3">
        <div class="stat">
            <p class="stat-label">Documents disponibles</p>
            <p class="stat-value">{{ $stats['documents_disponibles'] ?? 0 }}</p>
        </div>
        <div class="stat">
            <p class="stat-label">Documents en cours</p>
            <p class="stat-value">{{ $stats['documents_en_cours'] ?? 0 }}</p>
        </div>
        <a href="{{ route('responsable.encadrants.index') }}" class="stat block hover:border-pine-600">
            <p class="stat-label">Encadrants</p>
            <p class="stat-value">{{ $stats['encadrants'] ?? 0 }}</p>
        </a>
    </div>
@endsection
