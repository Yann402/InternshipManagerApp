@extends('layouts.admin')

@section('header')
    <div>
        <h1 class="page-title">Bonjour {{ Auth::user()->prenom }}</h1>
        <p class="page-sub">Paramétrez l'organisation des services et suivez l'activité des stages.</p>
    </div>
@endsection

@section('content')
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ([
            ['admin.divisions.index', 'building', 'Divisions', 'Les grandes entités qui regroupent les services.'],
            ['admin.services.index', 'squares', 'Services', 'Les services qui accueillent les stagiaires et leur responsable.'],
            ['admin.responsables.index', 'user', 'Responsables', 'Les comptes des responsables qui traitent les demandes.'],
            ['admin.stagiaires.index', 'academic', 'Stagiaires', 'Les comptes stagiaires et leurs demandes.'],
            ['admin.types_documents.index', 'clipboard', 'Pièces obligatoires', 'Les documents demandés aux stagiaires ou établis par les services.'],
            ['admin.statistiques.index', 'chart', 'Statistiques', "L'activité des demandes par statut et par service."],
        ] as [$route, $icon, $title, $text])
            <a href="{{ route($route) }}" class="panel panel-body group block hover:border-pine-600">
                <x-icon :name="$icon" class="h-6 w-6 text-pine-700" />
                <h2 class="mt-4 panel-title group-hover:text-pine-700">{{ $title }}</h2>
                <p class="mt-1 text-sm text-muted">{{ $text }}</p>
            </a>
        @endforeach
    </div>
@endsection
