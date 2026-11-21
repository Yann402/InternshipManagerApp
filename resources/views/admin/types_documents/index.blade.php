@extends('layouts.admin')

@section('header')
    <div>
        <h1 class="page-title">Pièces obligatoires</h1>
        <p class="page-sub">Documents demandés aux stagiaires ou établis par les services.</p>
    </div>
    <a href="{{ route('admin.types_documents.create') }}" class="btn-primary"><x-icon name="plus" class="h-4 w-4" /> Ajouter un document</a>
@endsection

@section('content')
<div class="panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Document</th><th>Fourni par</th><th>Format</th><th>Obligatoire</th><th class="text-right">Actions</th></tr>
            </thead>
            <tbody>
                @forelse ($types_document as $type)
                    <tr>
                        <td class="font-medium">{{ $type->libelle }}</td>
                        <td>{{ $type->fourni_par === 'stagiaire' ? 'Le stagiaire' : 'Le service' }}</td>
                        <td>{{ $type->type_fichier === 'pdf' ? 'PDF' : 'Image' }}</td>
                        <td>{{ $type->obligatoire ? 'Oui' : 'Non' }}</td>
                        <td class="text-right">
                            <div class="inline-flex items-center gap-4">
                                <a href="{{ route('admin.types_documents.edit', $type) }}" class="link">Modifier</a>
                                <form action="{{ route('admin.types_documents.destroy', $type) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="link-danger" onclick="return confirm('Supprimer ce document ?')">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">Aucun document configuré.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
