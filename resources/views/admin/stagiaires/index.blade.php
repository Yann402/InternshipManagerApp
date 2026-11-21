@extends('layouts.admin')

@section('header')
    <div>
        <h1 class="page-title">Stagiaires</h1>
        <p class="page-sub">Comptes stagiaires inscrits ou créés par l'administration.</p>
    </div>
    <a href="{{ route('admin.stagiaires.create') }}" class="btn-primary"><x-icon name="plus" class="h-4 w-4" /> Ajouter un stagiaire</a>
@endsection

@section('content')
<div class="panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Nom</th><th>E-mail</th><th class="text-right">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($stagiaires as $stagiaire)
                    <tr>
                        <td class="font-medium">
                            <a href="{{ route('admin.stagiaires.show', $stagiaire->id) }}" class="hover:text-pine-700 hover:underline">{{ $stagiaire->prenom }} {{ $stagiaire->nom }}</a>
                        </td>
                        <td>{{ $stagiaire->email }}</td>
                        <td class="text-right">
                            <div class="inline-flex items-center gap-4">
                                <a href="{{ route('admin.stagiaires.show', $stagiaire->id) }}" class="link">Voir les demandes</a>
                                <a href="{{ route('admin.stagiaires.edit', $stagiaire->id) }}" class="link">Modifier</a>
                                <form action="{{ route('admin.stagiaires.destroy', $stagiaire->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Supprimer ce stagiaire ?')" class="link-danger">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="empty">Aucun stagiaire inscrit.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
