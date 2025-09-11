@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">Modifier ma demande</h2>

    <form action="{{ route('stagiaire.demandes.update', $demande) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">Service</label>
            <select name="service_id" class="w-full border rounded p-2" required>
                @foreach($services as $s)
                    <option value="{{ $s->id }}" @if($demande->service_id == $s->id) selected @endif>
                        {{ $s->nom_service }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Mettre à jour</button>
    </form>
@endsection
