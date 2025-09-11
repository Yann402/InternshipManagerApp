@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800">Tableau de bord</h2>
@endsection

@section('content')
    <div class="bg-white shadow rounded p-6">
        <p>Bienvenue sur votre espace stagiaire, {{ Auth::user()->nom }} !</p>
    </div>
@endsection
