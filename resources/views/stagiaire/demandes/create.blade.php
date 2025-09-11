@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 shadow rounded">
    <h2 class="text-xl font-bold mb-4">Nouvelle demande de stage</h2>

    <form method="POST" action="{{ route('stagiaire.demandes.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="service_id" class="block font-medium">Service</label>
            <select name="service_id" id="service_id" class="border rounded px-3 py-2 w-full" required>
                <option value="">-- Choisir un service --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->nom_service }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <h3 class="font-semibold">Documents à fournir</h3>
            @foreach($typesDocuments as $type)
                <div class="mt-2">
                    <label class="block text-sm font-medium">
                        {{ $type->libelle }}
                        @if($type->obligatoire) <span class="text-red-500">*</span> @endif
                    </label>
                    <input type="file" name="documents[{{ $type->id }}]"
                        class="border rounded px-3 py-2 w-full"
                        accept="{{ $type->type_fichier === 'image' ? 'image/*' : '.pdf,.jpg,.jpeg,.png' }}">
                </div>
            @endforeach
        </div>

        <button type="submit" class="bg-blue-600 text-gray-100 px-4 py-2 rounded">
            Soumettre la demande
        </button>
    </form>
</div>
@endsection
