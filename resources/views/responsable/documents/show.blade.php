@extends('layouts.responsable')

@section('content')
<div class="mt-6 space-x-2">
    <form action="{{ route('responsable.documents.update', $document->id) }}" method="POST" class="inline">
        @csrf
        @method('PUT')
        <input type="hidden" name="statut" value="valide">
        <button class="bg-green-500 text-gray-100 px-3 py-1 rounded hover:bg-green-600">✅ Valider</button>
    </form>

    <form action="{{ route('responsable.documents.update', $document->id) }}" method="POST" class="inline">
        @csrf
        @method('PUT')
        <input type="hidden" name="statut" value="refuse">
        <button class="bg-red-500 text-gray-100 px-3 py-1 rounded hover:bg-red-600">❌ Refuser</button>
    </form>
</div>

@endsection
