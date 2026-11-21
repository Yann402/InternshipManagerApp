@extends('layouts.admin')

@section('header')
    <div>
        <a href="{{ route('admin.stagiaires.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Stagiaires</a>
        <h1 class="page-title">{{ $stagiaire->prenom }} {{ $stagiaire->nom }}</h1>
        <p class="page-sub">{{ $stagiaire->email }}</p>
    </div>
    <a href="{{ route('admin.stagiaires.edit', $stagiaire->id) }}" class="btn-secondary">Modifier le compte</a>
@endsection

@section('content')
<h2 class="section-title">Demandes de stage</h2>
<div class="space-y-6">
    @forelse($stagiaire->demandes as $demande)
        <section class="panel">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-line px-6 py-4">
                <div>
                    <h3 class="panel-title">{{ $demande->service->nom_service }}</h3>
                    <p class="text-sm text-muted">Déposée le {{ $demande->created_at->format('d/m/Y') }}</p>
                </div>
                <x-status :value="$demande->statut" />
            </div>
            <div class="grid gap-6 p-6 md:grid-cols-2">
                <dl class="dl sm:grid-cols-[8rem_1fr]">
                    <dt>Responsable</dt>
                    <dd>
                        @if($demande->service && $demande->service->responsable)
                            {{ $demande->service->responsable->nom }} {{ $demande->service->responsable->prenom }}
                            <span class="block font-normal text-muted">{{ $demande->service->responsable->email }}</span>
                        @else
                            <span class="font-normal text-muted">Non désigné</span>
                        @endif
                    </dd>
                    <dt>Structure</dt>
                    <dd>
                        @if($demande->entreprise)
                            {{ $demande->entreprise->nom }}
                            <span class="block font-normal text-muted">{{ $demande->entreprise->email }}</span>
                        @else
                            <span class="font-normal text-muted">Non renseignée</span>
                        @endif
                    </dd>
                </dl>
                <div>
                    <p class="mb-2 text-sm text-muted">Documents</p>
                    @if($demande->documents->isEmpty())
                        <p class="text-sm text-muted">Aucun document.</p>
                    @else
                        <ul class="divide-y divide-line rounded-md border border-line">
                            @foreach($demande->documents as $doc)
                                <li class="flex items-center justify-between gap-3 px-3 py-2 text-sm">
                                    <span>{{ $doc->typeDocument->libelle }}</span>
                                    <span class="flex items-center gap-3">
                                        <x-status :value="$doc->statut" />
                                        @if($doc->chemin_fichier)
                                            <a href="{{ asset('storage/' . $doc->chemin_fichier) }}" target="_blank" class="link">Ouvrir</a>
                                        @endif
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </section>
    @empty
        <div class="panel"><p class="empty">Ce stagiaire n'a encore déposé aucune demande.</p></div>
    @endforelse
</div>
@endsection
