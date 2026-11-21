@extends('layouts.responsable')

@section('header')
    <div>
        <a href="{{ route('responsable.demandes.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Demandes reçues</a>
        <div class="flex flex-wrap items-center gap-3">
            <h1 class="page-title">{{ optional($demande->stagiaire)->prenom }} {{ optional($demande->stagiaire)->nom ?? 'Stagiaire inconnu' }}</h1>
            <x-status :value="$demande->statut" />
        </div>
        <p class="page-sub">Demande #{{ $demande->id }}, déposée le {{ $demande->date_soumission ? \Illuminate\Support\Carbon::parse($demande->date_soumission)->format('d/m/Y à H:i') : $demande->created_at->format('d/m/Y à H:i') }}</p>
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
            <section class="panel">
                <div class="border-b border-line px-6 py-4"><h2 class="panel-title">Documents fournis</h2></div>
                @if($demande->documents->isEmpty())
                    <p class="empty">Aucun document joint.</p>
                @else
                    <ul class="divide-y divide-line">
                        @foreach($demande->documents as $doc)
                            <li class="flex items-center justify-between gap-4 px-6 py-3 text-sm">
                                <span class="font-medium">{{ optional($doc->typeDocument)->libelle ?? 'Type manquant' }}</span>
                                <span class="flex items-center gap-3">
                                    <x-status :value="$doc->statut" />
                                    @if($doc->chemin_fichier)
                                        <a href="{{ asset('storage/'.$doc->chemin_fichier) }}" target="_blank" class="link">Ouvrir</a>
                                    @endif
                                </span>
                            </li>
                        @endforeach
                    </ul>
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
                    <p class="text-sm text-muted">Aucun encadrant affecté.</p>
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
                    <p class="text-sm text-muted">Aucune structure d'accueil renseignée.</p>
                @endif
            </section>
        </div>

        {{-- Décision --}}
        <aside class="panel panel-body space-y-6 self-start">
            <div>
                <h2 class="panel-title">Accepter</h2>
                <p class="mt-1 text-sm text-muted">Vous choisirez ensuite l'encadrant et la structure d'accueil.</p>
                <a href="{{ route('responsable.demandes.assigner.form', $demande->id) }}" class="btn-success mt-3 w-full">Accepter la demande</a>
            </div>

            <form action="{{ route('responsable.demandes.refuser', $demande->id) }}" method="POST" class="border-t border-line pt-6">
                @csrf
                <h2 class="panel-title">Refuser</h2>
                <label for="motif" class="label mt-3">Motif communiqué au stagiaire</label>
                <textarea id="motif" name="motif" rows="3" class="input" placeholder="Ex. : dossier incomplet"></textarea>
                <button class="btn-danger mt-3 w-full">Refuser la demande</button>
            </form>

            <form action="{{ route('responsable.demandes.transferer', $demande->id) }}" method="POST" class="border-t border-line pt-6">
                @csrf
                <h2 class="panel-title">Transférer</h2>
                <label for="service_id" class="label mt-3">Vers le service</label>
                <select id="service_id" name="service_id" class="input">
                    @foreach($services as $s)
                        <option value="{{ $s->id }}">{{ $s->nom_service }}</option>
                    @endforeach
                </select>
                <button class="btn-secondary mt-3 w-full">Transférer la demande</button>
            </form>
        </aside>
    </div>
@endsection
