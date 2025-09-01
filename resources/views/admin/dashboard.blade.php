@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tableau de bord Administrateur</h1>
    <p>Bienvenue, {{ auth()->user()->name }} !</p>

    <ul>
        <li><a href="{{ route('services.index') }}">Gérer les services</a></li>
        <li><a href="{{ route('divisions.index') }}">Gérer les divisions</a></li>
        <li><a href="{{ route('utilisateurs.index') }}">Gérer les utilisateurs</a></li>
    </ul>
</div>
@endsection