@extends('layouts.responsable')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">📄 Détails de la demande</h2>

    <p><strong>Stagiaire :</strong> {{ optional($demande->stagiaire)->nom ?? '—' }} {{ optional($demande->stagiaire)->prenom ?? '' }}</p>
    <p><strong>Date soumission :</strong> {{ $demande->date_soumission ?? $demande->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Statut :</strong> {{ ucfirst($demande->statut) }}</p>

    <h3 class="mt-4 font-semibold">Documents fournis :</h3>
    <ul class="list-disc ml-6">
        @foreach($demande->documents as $doc)
            <li>
                {{ optional($doc->typeDocument)->libelle ?? 'Type manquant' }} -
                <span class="text-sm italic">{{ $doc->statut }}</span>
                @if($doc->chemin_fichier)
                    <a href="{{ asset('storage/'.$doc->chemin_fichier) }}" target="_blank" class="text-blue-500 ml-2">Voir</a>
                @endif
            </li>
        @endforeach
    </ul>

    <h3 class="text-lg font-semibold mt-4">Encadrant</h3>
    <div class="bg-white">
        @if($demande->encadrant)
            <p><strong>Nom :</strong> {{ $demande->encadrant->nom }} {{ $demande->encadrant->prenom }}</p>
            <p><strong>Email :</strong> {{ $demande->encadrant->email }}</p>
            <p><strong>Spécialité :</strong> {{ $demande->encadrant->specialite }}</p>
        @else
            <p>Aucun encadrant assigné.</p>
        @endif
    </div>

    <h3 class="text-lg font-semibold mt-4">Entreprise</h3>
    <div class="bg-white">
        @if($demande->entreprise)
            <p><strong>Nom :</strong> {{ $demande->entreprise->nom }}</p>
            <p><strong>Adresse :</strong> {{ $demande->entreprise->adresse }}</p>
            <p><strong>Email :</strong> {{ $demande->entreprise->email }}</p>
            <p><strong>Téléphone :</strong> {{ $demande->entreprise->telephone }}</p>
        @else
            <p>Aucune entreprise assignée.</p>
        @endif
    </div>

    @if($demande->statut === 'refusée')
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4">
        <strong>Motif du refus :</strong> {{ $demande->motif_refus ?? 'Non spécifié' }}
    </div>
    @endif



    <div class="mt-6 flex items-center gap-4">

        {{-- Accepter --}}
        <form action="{{ route('responsable.demandes.assigner.form', $demande->id) }}" method="GET">
            @csrf
            <button class="bg-green-500 text-gray-100 px-4 py-2 rounded-lg shadow hover:bg-green-600 flex items-center gap-2">
                ✅ Accepter
            </button>
        </form>

        {{-- Refuser --}}
        <form action="{{ route('responsable.demandes.refuser', $demande->id) }}" method="POST" class="flex items-center gap-2">
            @csrf
            <input type="text" name="motif" placeholder="Motif du refus" 
                class="border rounded px-2 py-1 focus:outline-none focus:ring focus:ring-red-300">
            <button class="bg-red-500 text-gray-100 px-4 py-2 rounded-lg shadow hover:bg-red-600 flex items-center gap-2">
                ❌ Refuser
            </button>
        </form>

        {{-- Transférer --}}
        <form action="{{ route('responsable.demandes.transferer', $demande->id) }}" method="POST" class="flex items-center gap-2">
            @csrf
            <select name="service_id" class="border rounded px-2 py-1">
                @foreach($services as $s)
                    <option value="{{ $s->id }}">{{ $s->nom_service }}</option>
                @endforeach
            </select>
            <button class="bg-yellow-500 text-gray-100 px-4 py-2 rounded-lg shadow hover:bg-yellow-600 flex items-center gap-2">
                ↔️ Transférer
            </button>
        </form>
    </div>
</div>
@endsection
