@extends('layouts.admin')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Bienvenue, {{ Auth::user()->name ?? 'Admin' }}</h2>
        <p class="text-gray-600">Ceci est votre interface administrateur.</p>
    </div>
@endsection
