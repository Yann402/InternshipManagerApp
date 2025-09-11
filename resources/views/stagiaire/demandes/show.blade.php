@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">Détails de la demande #{{ $demande->id }}</h2>

    <div class="bg-white shadow rounded p-4">
        <p><strong>Service :</strong> {{ $demande->service->nom_service }}</p>
        <p><strong>Statut :</strong> {{ ucfirst($demande->statut) }}</p>
        <p><strong>Date :</strong> {{ $demande->created_at->format('d/m/Y') }}</p>
    </div>

    <h3 class="text-lg font-semibold mt-4">Responsable du service</h3>
    <div class="bg-white shadow rounded p-4 mt-2">
        @if($demande->service && $demande->service->responsable)
            <p><strong>Nom :</strong> {{ $demande->service->responsable->nom }} {{ $demande->service->responsable->prenom }}</p>
            <p><strong>Email :</strong> {{ $demande->service->responsable->email }}</p>
            <p><strong>Spécialité :</strong> {{ $demande->service->responsable->specialite }}</p>
        @else
            <p>Aucun responsable attribué.</p>
        @endif
    </div>

    <h3 class="mt-6 font-semibold">Documents liés</h3>
    <div class="bg-white shadow rounded p-4 mt-2">
        @if($demande->documents->isEmpty())
            <p>Aucun document pour cette demande.</p>
        @else
            <ul class="list-disc pl-6">
                @foreach($demande->documents as $doc)
                    <li>
                        {{ $doc->typeDocument->libelle }} 
                        (<em>{{ $doc->typeDocument->type_fichier }}</em>) - 
                        <span class="text-gray-600">{{ ucfirst($doc->statut) }}</span>
                        @if($doc->chemin_fichier)
                            <a href="{{ asset('storage/' . $doc->chemin_fichier) }}" 
                               target="_blank" 
                               class="text-blue-600 hover:underline ml-2">
                               Voir
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
