@extends('layouts.app')

@section('header')
    <div>
        <h1 class="page-title">Mes documents</h1>
        <p class="page-sub">Pièces liées à votre demande #{{ $demande->id }}</p>
    </div>
    <a href="{{ route('stagiaire.documents.create') }}" class="btn-primary">
        <x-icon name="plus" class="h-4 w-4" /> Ajouter des documents
    </a>
@endsection

@section('content')
    @php
        $st_types = $typesDocuments->where('fourni_par', 'stagiaire');
        $r_types = $typesDocuments->where('fourni_par', 'responsable');
    @endphp

    <section class="panel">
        <div class="border-b border-line px-6 py-4">
            <h2 class="panel-title">Documents que vous fournissez</h2>
        </div>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr><th>Document</th><th>Statut</th><th>Fichier</th><th class="text-right">Actions</th></tr>
                </thead>
                <tbody>
                @forelse ($st_types as $type)
                    @php $doc = $documents->firstWhere('type_document_id', $type->id); @endphp
                    <tr>
                        <td class="font-medium">{{ $type->libelle }}</td>
                        <td>
                            @if($doc) <x-status :value="$doc->statut" /> @else <span class="status-neutral">Non fourni</span> @endif
                        </td>
                        <td>
                            @if ($doc && $doc->chemin_fichier)
                                <a href="{{ asset('storage/'.$doc->chemin_fichier) }}" target="_blank" class="link">Ouvrir</a>
                            @else
                                <span class="text-muted">Aucun fichier</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <div class="inline-flex items-center gap-4">
                                @if($doc)
                                    <a href="{{ route('stagiaire.documents.edit', $doc) }}" class="link">Remplacer</a>
                                    <form action="{{ route('stagiaire.documents.destroy', $doc) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="link-danger" onclick="return confirm('Supprimer ce document ?')">Supprimer</button>
                                    </form>
                                @else
                                    <a href="{{ route('stagiaire.documents.create') }}" class="link">Ajouter</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="empty">Aucun type de document n'est configuré.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="panel mt-6">
        <div class="border-b border-line px-6 py-4">
            <h2 class="panel-title">Documents établis par le service</h2>
        </div>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr><th>Document</th><th>Statut</th><th class="text-right">Fichier</th></tr>
                </thead>
                <tbody>
                @forelse ($r_types as $type)
                    @php $doc = $documents->firstWhere('type_document_id', $type->id); @endphp
                    <tr>
                        <td class="font-medium">{{ $type->libelle }}</td>
                        <td>@if($doc) <x-status :value="$doc->statut" /> @else <x-status value="non_disponible" /> @endif</td>
                        <td class="text-right">
                            @if ($doc && $doc->chemin_fichier)
                                <a href="{{ asset('storage/'.$doc->chemin_fichier) }}" target="_blank" class="link">Télécharger</a>
                            @else
                                <span class="text-muted">Pas encore disponible</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="empty">Aucun document n'est établi par le service.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
