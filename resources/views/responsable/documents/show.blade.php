@extends('layouts.responsable')

@section('header')
    <div>
        <a href="{{ route('responsable.documents.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Documents</a>
        <div class="flex flex-wrap items-center gap-3">
            <h1 class="page-title">{{ optional($document->typeDocument)->libelle ?? 'Document' }}</h1>
            <x-status :value="$document->statut" />
        </div>
        <p class="page-sub">Demande #{{ $document->demande_id }}</p>
    </div>
    <div class="flex items-center gap-2">
        <form action="{{ route('responsable.documents.update', $document->id) }}" method="POST" class="inline">
            @csrf
            @method('PUT')
            <input type="hidden" name="statut" value="valide">
            <button class="btn-success">Valider</button>
        </form>
        <form action="{{ route('responsable.documents.update', $document->id) }}" method="POST" class="inline">
            @csrf
            @method('PUT')
            <input type="hidden" name="statut" value="refuse">
            <button class="btn-danger">Refuser</button>
        </form>
    </div>
@endsection

@section('content')
<div class="panel panel-body">
    @if($document->chemin_fichier)
        @if(optional($document->typeDocument)->type_fichier === 'image')
            <img src="{{ asset('storage/'.$document->chemin_fichier) }}" alt="{{ optional($document->typeDocument)->libelle }}" class="max-w-md rounded-md border border-line">
        @else
            <iframe src="{{ asset('storage/'.$document->chemin_fichier) }}" class="h-[70vh] w-full rounded-md border border-line" title="Aperçu du document"></iframe>
        @endif
    @else
        <p class="empty">Aucun fichier déposé pour ce document.</p>
    @endif
</div>
@endsection
