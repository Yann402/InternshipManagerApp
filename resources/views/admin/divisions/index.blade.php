@extends('layouts.admin')

@section('header')
    <div>
        <h1 class="page-title">Divisions</h1>
        <p class="page-sub">Chaque division regroupe plusieurs services.</p>
    </div>
    <a href="{{ route('admin.divisions.create') }}" class="btn-primary"><x-icon name="plus" class="h-4 w-4" /> Nouvelle division</a>
@endsection

@section('content')
<div class="panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Division</th><th>Services</th><th class="text-right">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($divisions as $d)
                <tr>
                    <td class="font-medium">{{ $d->nom_division }}</td>
                    <td>
                        <span class="tabular-nums">{{ $d->services_count ?? $d->services->count() }}</span>
                        <a href="{{ route('admin.services.create', ['division_id' => $d->id]) }}" class="link ml-3">Ajouter un service</a>
                    </td>
                    <td class="text-right">
                        <div class="inline-flex items-center gap-4">
                            <a href="{{ route('admin.divisions.edit', $d->id) }}" class="link">Modifier</a>
                            <form action="{{ route('admin.divisions.destroy', $d->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Supprimer cette division ?')" class="link-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="empty">Aucune division pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
