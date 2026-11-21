@extends('layouts.app')

@section('header')
    <div>
        <a href="{{ route('stagiaire.demandes.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Mes demandes</a>
        <h1 class="page-title">Nouvelle demande de stage</h1>
        <p class="page-sub">Choisissez le service visé et joignez les documents demandés.</p>
    </div>
@endsection

@section('content')
<form method="POST" action="{{ route('stagiaire.demandes.store') }}" enctype="multipart/form-data" class="max-w-3xl space-y-6">
    @csrf

    <section class="panel panel-body">
        <h2 class="panel-title">Service</h2>
        <div class="mt-4">
            <label for="service_id" class="label">Service souhaité</label>
            <select name="service_id" id="service_id" class="input" required>
                <option value="">Choisir un service</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>{{ $service->nom_service }}</option>
                @endforeach
            </select>
        </div>
    </section>

    <section class="panel panel-body">
        <h2 class="panel-title">Documents à fournir</h2>
        <p class="mt-1 text-sm text-muted">Les pièces marquées d'un astérisque sont obligatoires.</p>
        <div class="mt-5 divide-y divide-line">
            @foreach($typesDocuments as $type)
                <div class="grid gap-2 py-4 sm:grid-cols-[14rem_1fr] sm:items-center">
                    <label for="doc-{{ $type->id }}" class="text-sm font-medium">
                        {{ $type->libelle }}
                        @if($type->obligatoire) <span class="text-red-700" aria-label="obligatoire">*</span> @endif
                        <span class="block text-xs font-normal text-muted">{{ $type->type_fichier === 'image' ? 'Image' : 'PDF ou image' }}</span>
                    </label>
                    <input type="file" id="doc-{{ $type->id }}" name="documents[{{ $type->id }}]" class="input-file"
                        accept="{{ $type->type_fichier === 'image' ? 'image/*' : '.pdf,.jpg,.jpeg,.png' }}">
                </div>
            @endforeach
        </div>
    </section>

    <div class="flex items-center gap-3">
        <button type="submit" class="btn-primary">Soumettre la demande</button>
        <a href="{{ route('stagiaire.demandes.index') }}" class="btn-secondary">Annuler</a>
    </div>
</form>
@endsection
