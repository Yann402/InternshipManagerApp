@extends('layouts.admin')

@section('title', 'Services')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Services</h2>
        <a href="{{ route('admin.services.create') }}" class="px-4 py-2 bg-blue-600 text-green-600 mr-4 rounded">+ Nouveau service</a>
    </div>

    @if(session('ok'))
        <div class="mb-4 text-green-700">{{ session('ok') }}</div>
    @endif

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Service</th>
                    <th class="px-4 py-3 text-left">Division</th>
                    <th class="px-4 py-3 text-left">Responsable</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($services as $s)
                <tr>
                    <td class="px-4 py-3">{{ $s->id }}</td>
                    <td class="px-4 py-3">{{ $s->nom_service }}</td>
                    <td class="px-4 py-3">{{ $s->division?->nom_division ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $s->responsable?->nom.' '.$s->responsable?->prenom ?? '-' }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.services.edit', $s->id) }}" class="text-blue-600 mr-4">Éditer</a>
                        <form action="{{ route('admin.services.destroy', $s->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer ?')" class="text-red-600">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td class="px-4 py-6" colspan="5">Aucun service.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $services->links() }}
    </div>
</div>
@endsection