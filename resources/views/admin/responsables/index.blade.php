@extends('layouts.admin')

@section('header')
    <div>
        <h1 class="page-title">Responsables</h1>
        <p class="page-sub">Ils examinent les demandes adressées à leur service.</p>
    </div>
    <a href="{{ route('admin.responsables.create') }}" class="btn-primary"><x-icon name="plus" class="h-4 w-4" /> Ajouter un responsable</a>
@endsection

@section('content')
<div class="panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Nom</th><th>E-mail</th><th>Poste</th><th>Spécialité</th><th>Service</th><th class="text-right">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($responsables as $r)
                <tr>
                    <td class="font-medium">{{ $r->prenom }} {{ $r->nom }}</td>
                    <td>{{ $r->email }}</td>
                    <td>{{ $r->poste ?? '—' }}</td>
                    <td>{{ $r->specialite ?? '—' }}</td>
                    <td>{{ optional($r->service)->nom_service ?? '—' }}</td>
                    <td class="text-right">
                        <div class="inline-flex items-center gap-4">
                            <a href="{{ route('admin.responsables.edit', $r) }}" class="link">Modifier</a>
                            <form action="{{ route('admin.responsables.destroy', $r) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Supprimer ce responsable ?')" class="link-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="empty">Aucun responsable pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $responsables->links() }}</div>
@endsection
