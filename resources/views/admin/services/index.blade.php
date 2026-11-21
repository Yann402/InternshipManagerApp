@extends('layouts.admin')

@section('header')
    <div>
        <h1 class="page-title">Services</h1>
        <p class="page-sub">Les stagiaires déposent leurs demandes auprès de ces services.</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="btn-primary"><x-icon name="plus" class="h-4 w-4" /> Nouveau service</a>
@endsection

@section('content')
<div class="panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Service</th><th>Division</th><th>Responsable</th><th class="text-right">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($services as $s)
                <tr>
                    <td class="font-medium">{{ $s->nom_service }}</td>
                    <td>{{ $s->division?->nom_division ?? '—' }}</td>
                    <td>
                        @if($s->responsable)
                            {{ $s->responsable->prenom }} {{ $s->responsable->nom }}
                        @else
                            <span class="status-wait">À désigner</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <div class="inline-flex items-center gap-4">
                            <a href="{{ route('admin.services.edit', $s->id) }}" class="link">Modifier</a>
                            <form action="{{ route('admin.services.destroy', $s->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Supprimer ce service ?')" class="link-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="empty">Aucun service pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $services->links() }}</div>
@endsection
