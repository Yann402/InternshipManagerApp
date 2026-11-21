@extends('layouts.app')

@section('header')
    <div>
        <a href="{{ route('stagiaire.documents.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Mes documents</a>
        <h1 class="page-title">{{ $document->typeDocument->libelle }}</h1>
    </div>
@endsection

@section('content')
<div class="panel panel-body">
    @if($document->chemin_fichier)
        @if($document->typeDocument->type_fichier === 'pdf')
            <iframe src="{{ asset('storage/'.$document->chemin_fichier) }}" class="h-[70vh] w-full rounded-md border border-line" title="{{ $document->typeDocument->libelle }}"></iframe>
        @else
            <img src="{{ asset('storage/'.$document->chemin_fichier) }}" alt="{{ $document->typeDocument->libelle }}" class="max-w-md rounded-md border border-line">
        @endif
    @else
        <p class="empty">Aucun fichier disponible.</p>
    @endif
</div>
@endsection
