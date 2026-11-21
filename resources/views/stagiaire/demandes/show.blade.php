@extends('layouts.app')

@section('header')
    <div>
        <a href="{{ route('stagiaire.demandes.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Mes demandes</a>
        <div class="flex flex-wrap items-center gap-3">
            <h1 class="page-title">Demande #{{ $demande->id }}</h1>
            <x-status :value="$demande->statut" />
        </div>
        <p class="page-sub">Déposée le {{ $demande->created_at->format('d/m/Y') }} auprès du service {{ $demande->service->nom_service }}</p>
    </div>
@endsection

@section('content')
    @if($demande->statut === 'refusée')
        <div class="alert-error">
            <p class="font-medium">Motif du refus</p>
            <p class="mt-1">{{ $demande->motif_refus ?? 'Non spécifié' }}</p>
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-[minmax(0,3fr)_minmax(0,2fr)]">
        <div class="space-y-6">
            <section class="panel panel-body">
                <h2 class="section-title">Responsable du service</h2>
                @if($demande->service && $demande->service->responsable)
                    <dl class="dl">
                        <dt>Nom</dt><dd>{{ $demande->service->responsable->nom }} {{ $demande->service->responsable->prenom }}</dd>
                        <dt>E-mail</dt><dd>{{ $demande->service->responsable->email }}</dd>
                        <dt>Spécialité</dt><dd>{{ $demande->service->responsable->specialite ?? '—' }}</dd>
                    </dl>
                @else
                    <p class="text-sm text-muted">Aucun responsable n'est encore rattaché à ce service.</p>
                @endif
            </section>

            <section class="panel panel-body">
                <h2 class="section-title">Encadrant</h2>
                @if($demande->encadrant)
                    <dl class="dl">
                        <dt>Nom</dt><dd>{{ $demande->encadrant->nom }} {{ $demande->encadrant->prenom }}</dd>
                        <dt>E-mail</dt><dd>{{ $demande->encadrant->email }}</dd>
                        <dt>Spécialité</dt><dd>{{ $demande->encadrant->specialite }}</dd>
                    </dl>
                @else
                    <p class="text-sm text-muted">L'encadrant vous sera affecté quand la demande sera acceptée.</p>
                @endif
            </section>

            <section class="panel panel-body">
                <h2 class="section-title">Structure d'accueil</h2>
                @if($demande->entreprise)
                    <dl class="dl">
                        <dt>Nom</dt><dd>{{ $demande->entreprise->nom }}</dd>
                        <dt>Adresse</dt><dd>{{ $demande->entreprise->adresse }}</dd>
                        <dt>E-mail</dt><dd>{{ $demande->entreprise->email }}</dd>
                        <dt>Téléphone</dt><dd>{{ $demande->entreprise->telephone }}</dd>
                    </dl>
                @else
                    <p class="text-sm text-muted">Aucune structure d'accueil renseignée pour le moment.</p>
                @endif
            </section>
        </div>

        <section class="panel self-start">
            <div class="border-b border-line px-6 py-4">
                <h2 class="panel-title">Documents</h2>
            </div>
            @if($demande->documents->isEmpty())
                <p class="empty">Aucun document pour cette demande.</p>
            @else
                <ul class="divide-y divide-line">
                    @foreach($demande->documents as $doc)
                        <li class="flex items-center justify-between gap-4 px-6 py-3 text-sm">
                            <div>
                                <p class="font-medium">{{ $doc->typeDocument->libelle }}</p>
                                <p class="text-xs text-muted">{{ strtoupper($doc->typeDocument->type_fichier) }}</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <x-status :value="$doc->statut" />
                                @if($doc->chemin_fichier)
                                    <a href="{{ asset('storage/' . $doc->chemin_fichier) }}" target="_blank" class="link">Ouvrir</a>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </div>
@endsection
