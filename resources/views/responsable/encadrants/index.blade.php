@extends('layouts.responsable')

@section('header')
    <div>
        <h1 class="page-title">Encadrants</h1>
        <p class="page-sub">Personnes que vous pouvez affecter aux stagiaires acceptés.</p>
    </div>
    <a href="{{ route('responsable.encadrants.create') }}" class="btn-primary"><x-icon name="plus" class="h-4 w-4" /> Ajouter un encadrant</a>
@endsection

@section('content')
<div class="panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Nom</th><th>E-mail</th><th>Téléphone</th><th>Spécialité</th><th class="text-right">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($encadrants as $encadrant)
                    <tr>
                        <td class="font-medium">{{ $encadrant->prenom }} {{ $encadrant->nom }}</td>
                        <td>{{ $encadrant->email }}</td>
                        <td class="tabular-nums">{{ $encadrant->telephone }}</td>
                        <td>{{ $encadrant->specialite }}</td>
                        <td class="text-right">
                            <div class="inline-flex items-center gap-4">
                                <a href="{{ route('responsable.encadrants.edit', $encadrant->id) }}" class="link">Modifier</a>
                                <form action="{{ route('responsable.encadrants.destroy', $encadrant->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="link-danger" onclick="return confirm('Supprimer cet encadrant ?')">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">Aucun encadrant enregistré.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
