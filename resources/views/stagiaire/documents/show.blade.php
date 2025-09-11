@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-xl font-bold mb-4">{{ $document->typeDocument->libelle }}</h2>

    @if($document->chemin_fichier)
        @if($document->typeDocument->type_fichier === 'pdf')
            <iframe src="{{ asset('storage/'.$document->chemin_fichier) }}" class="w-full h-[600px]"></iframe>
        @else
            <img src="{{ asset('storage/'.$document->chemin_fichier) }}" alt="Image document" class="max-w-md rounded shadow">
        @endif
    @else
        <p class="text-gray-600">Aucun fichier disponible.</p>
    @endif
</div>
@endsection
