@extends('layouts.responsable')

@section('header')
    <div>
        <h1 class="page-title">Demandes reçues</h1>
        <p class="page-sub">Ouvrez une demande pour l'accepter, la refuser ou la transférer.</p>
    </div>
@endsection

@section('content')
<div class="panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Stagiaire</th>
                    <th>Date de dépôt</th>
                    <th>Statut</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($demandes as $demande)
                    <tr>
                        <td class="font-medium">{{ $demande->stagiaire->nom }} {{ $demande->stagiaire->prenom }}</td>
                        <td class="tabular-nums">{{ $demande->date_soumission ? \Illuminate\Support\Carbon::parse($demande->date_soumission)->format('d/m/Y') : $demande->created_at->format('d/m/Y') }}</td>
                        <td><x-status :value="$demande->statut" /></td>
                        <td class="text-right">
                            <a href="{{ route('responsable.demandes.show', $demande->id) }}" class="link">Examiner</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="empty">Aucune demande reçue pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
