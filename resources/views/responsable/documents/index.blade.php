@extends('layouts.responsable')

@section('header')
    <div>
        <h1 class="page-title">Documents</h1>
        <p class="page-sub">Vérifiez les pièces des stagiaires et déposez les documents que vous établissez.</p>
    </div>
@endsection

@section('content')
<section class="panel">
    <div class="border-b border-line px-6 py-4">
        <h2 class="panel-title">Pièces fournies par les stagiaires</h2>
    </div>
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Document</th><th>Demande</th><th>Statut</th><th class="text-right">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($docsStagiaire as $doc)
                    <tr>
                        <td class="font-medium">{{ $doc->typeDocument->libelle }}</td>
                        <td class="tabular-nums">#{{ $doc->demande_id }}</td>
                        <td><x-status :value="$doc->statut" /></td>
                        <td class="text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ route('responsable.documents.show', $doc->id) }}" class="btn-secondary px-3 py-1.5">Voir</a>
                                <form action="{{ route('responsable.documents.update', $doc->id) }}" method="POST" class="inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="statut" value="valide">
                                    <button class="btn-success px-3 py-1.5">Valider</button>
                                </form>
                                <form action="{{ route('responsable.documents.update', $doc->id) }}" method="POST" class="inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="statut" value="refuse">
                                    <button class="btn-danger px-3 py-1.5">Refuser</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="empty">Aucune pièce à vérifier.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<section class="panel mt-6">
    <div class="border-b border-line px-6 py-4">
        <h2 class="panel-title">Documents établis par le service</h2>
        <p class="mt-1 text-sm text-muted">Déposez le fichier pour le rendre disponible au stagiaire.</p>
    </div>
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Document</th><th>Demande</th><th>Statut</th><th class="text-right">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($docsResponsable as $doc)
                    <tr>
                        <td class="font-medium">{{ $doc->typeDocument->libelle }}</td>
                        <td class="tabular-nums">#{{ $doc->demande_id }}</td>
                        <td><x-status :value="$doc->statut" /></td>
                        <td class="text-right">
                            <div class="inline-flex flex-wrap items-center justify-end gap-2">
                                @if($doc->chemin_fichier)
                                    <a href="{{ route('responsable.documents.show', $doc->id) }}" class="btn-secondary px-3 py-1.5">Voir</a>
                                @endif
                                <form action="{{ route('responsable.documents.store') }}" method="POST" enctype="multipart/form-data"
                                      class="inline-flex items-center gap-2" onsubmit="return checkFile(this)">
                                    @csrf
                                    <input type="hidden" name="demande_id" value="{{ $doc->demande_id }}">
                                    <input type="hidden" name="type_document_id" value="{{ $doc->type_document_id }}">
                                    <input type="file" name="document" class="input-file max-w-56" aria-label="Fichier pour {{ $doc->typeDocument->libelle }}">
                                    <button type="submit" class="btn-primary px-3 py-1.5">{{ $doc->chemin_fichier ? 'Remplacer' : 'Déposer' }}</button>
                                </form>
                                @if($doc->chemin_fichier)
                                    <form action="{{ route('responsable.documents.destroy', $doc->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button class="btn-danger px-3 py-1.5" onclick="return confirm('Supprimer ce document ?')">Supprimer</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="empty">Aucun document à établir.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<script>
    function checkFile(form) {
        if (!form.querySelector('input[name="document"]').value) {
            alert('Choisissez un fichier avant de valider.');
            return false;
        }
        return true;
    }
</script>
@endsection
