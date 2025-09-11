@extends('layouts.admin')

@section('title', 'Divisions')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Divisions</h2>
        <a href="{{ route('admin.divisions.create') }}" class="px-4 py-2 bg-blue-600 text-green-600 mr-4 rounded">+ Nouvelle division</a>
    </div>

    @if(session('ok'))
        <div class="mb-4 text-green-700">{{ session('ok') }}</div>
    @endif

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Nom</th>
                    <th class="px-4 py-3 text-left"># Services</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($divisions as $d)
                <tr>
                    <td class="px-4 py-3">{{ $d->id }}</td>
                    <td class="px-4 py-3">{{ $d->nom_division }}</td>
                    <td class="px-4 py-3">
                        {{ $d->services_count ?? $d->services->count() }}
                        <a href="{{ route('admin.services.create', ['division_id' => $d->id]) }}" class="text-green-600 mr-4">Ajouter</a>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.divisions.edit', $d->id) }}" class="text-blue-600 mr-4">Éditer</a>
                        <form action="{{ route('admin.divisions.destroy', $d->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer ?')" class="text-red-600">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td class="px-4 py-6" colspan="4">Aucune division.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection