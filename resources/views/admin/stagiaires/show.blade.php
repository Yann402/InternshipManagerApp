@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">👨‍🎓 Détails du stagiaire : {{ $stagiaire->nom }} {{ $stagiaire->prenom }}</h2>
    <p><strong>Email :</strong> {{ $stagiaire->email }}</p>

    <h3 class="text-lg font-semibold mt-6">📌 Demandes de stage</h3>

    @forelse($stagiaire->demandes as $demande)
        <div class="border rounded p-4 my-3">
            <p><strong>Service :</strong> {{ $demande->service->nom_service }}</p>
            <p><strong>Statut :</strong> {{ ucfirst($demande->statut) }}</p>
            <p><strong>Date :</strong> {{ $demande->created_at->format('d/m/Y') }}</p>

            <h4 class="font-semibold mt-2">Responsable</h4>
            @if($demande->service && $demande->service->responsable)
                <p>{{ $demande->service->responsable->nom }} {{ $demande->service->responsable->prenom }} ({{ $demande->service->responsable->email }})</p>
            @else
                <p>Aucun responsable assigné.</p>
            @endif

            <h4 class="font-semibold mt-2">Entreprise</h4>
            @if($demande->entreprise)
                <p>{{ $demande->entreprise->nom }} - {{ $demande->entreprise->email }}</p>
            @else
                <p>Aucune entreprise assignée.</p>
            @endif

            <h4 class="font-semibold mt-2">Documents</h4>
            @if($demande->documents->isEmpty())
                <p>Aucun document</p>
            @else
                <ul class="list-disc pl-6">
                    @foreach($demande->documents as $doc)
                        <li>
                            {{ $doc->typeDocument->libelle }} ({{ $doc->typeDocument->type_fichier }}) - 
                            <span class="text-gray-600">{{ ucfirst($doc->statut) }}</span>
                            @if($doc->chemin_fichier)
                                <a href="{{ asset('storage/' . $doc->chemin_fichier) }}" target="_blank" class="text-blue-600 ml-2">Voir</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @empty
        <p class="text-gray-500">Ce stagiaire n’a postulé à aucun service.</p>
    @endforelse

    <a href="{{ route('admin.stagiaires.index') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">⬅ Retour</a>
</div>
@endsection