@extends('layouts.app')

@section('header')
    <div>
        <h1 class="page-title">Mes demandes</h1>
        <p class="page-sub">Vous pouvez modifier ou supprimer une demande tant qu'elle est en attente ou refusée.</p>
    </div>
    <a href="{{ route('stagiaire.demandes.create') }}" class="btn-primary">
        <x-icon name="plus" class="h-4 w-4" /> Nouvelle demande
    </a>
@endsection

@section('content')
    <div class="panel">
        @if($demandes->isEmpty())
            <div class="empty">
                <p>Vous n'avez encore déposé aucune demande.</p>
                <a href="{{ route('stagiaire.demandes.create') }}" class="btn-primary mt-4">Déposer ma première demande</a>
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Date de dépôt</th>
                            <th>Statut</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($demandes as $demande)
                        <tr>
                            <td class="font-medium tabular-nums">#{{ $demande->id }}</td>
                            <td class="tabular-nums">{{ $demande->created_at->format('d/m/Y') }}</td>
                            <td><x-status :value="$demande->statut" /></td>
                            <td class="text-right">
                                <div class="inline-flex items-center gap-4">
                                    <a href="{{ route('stagiaire.demandes.show', $demande) }}" class="link">Voir</a>
                                    @if(in_array($demande->statut, ['en_attente','refusée']))
                                        <a href="{{ route('stagiaire.demandes.edit', $demande) }}" class="link">Modifier</a>
                                        <form action="{{ route('stagiaire.demandes.destroy', $demande) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Supprimer cette demande ?')" class="link-danger">Supprimer</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
