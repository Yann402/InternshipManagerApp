@extends('layouts.responsable')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">
            Bienvenue, {{ Auth::user()->name ?? 'Responsable' }}
        </h2>
        <p class="text-gray-600 mb-6">Ceci est votre interface responsable.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="p-4 bg-gray-50 rounded-lg shadow">
                <h3 class="font-semibold mb-2">Demandes en attente</h3>
                <p class="text-2xl font-bold">{{ $stats['demandes_en_attente'] ?? 0 }}</p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg shadow">
                <h3 class="font-semibold mb-2">Demandes en cours</h3>
                <p class="text-2xl font-bold">{{ $stats['demandes_en_cours'] ?? 0 }}</p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg shadow">
                <h3 class="font-semibold mb-2">Demandes validées</h3>
                <p class="text-2xl font-bold">{{ $stats['demandes_validees'] ?? 0 }}</p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg shadow">
                <h3 class="font-semibold mb-2">Demandes refusées</h3>
                <p class="text-2xl font-bold">{{ $stats['demandes_refusees'] ?? 0 }}</p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg shadow">
                <h3 class="font-semibold mb-2">Documents disponibles</h3>
                <p class="text-2xl font-bold">{{ $stats['documents_disponibles'] ?? 0 }}</p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg shadow">
                <h3 class="font-semibold mb-2">Documents en cours</h3>
                <p class="text-2xl font-bold">{{ $stats['documents_en_cours'] ?? 0 }}</p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg shadow">
                <h3 class="font-semibold mb-2">Encadrants</h3>
                <p class="text-2xl font-bold">{{ $stats['encadrants'] ?? 0 }}</p>
            </div>

        </div>
    </div>
@endsection
