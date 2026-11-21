@extends('layouts.app')

@section('header')
    <div>
        <h1 class="page-title">Bonjour {{ Auth::user()->prenom }}</h1>
        <p class="page-sub">Suivez ici vos demandes de stage et les documents qui les accompagnent.</p>
    </div>
    <a href="{{ route('stagiaire.demandes.create') }}" class="btn-primary">
        <x-icon name="plus" class="h-4 w-4" /> Nouvelle demande
    </a>
@endsection

@section('content')
    <div class="grid gap-6 md:grid-cols-2">
        <a href="{{ route('stagiaire.demandes.index') }}" class="panel panel-body group block hover:border-pine-600">
            <x-icon name="inbox" class="h-6 w-6 text-pine-700" />
            <h2 class="mt-4 panel-title group-hover:text-pine-700">Mes demandes</h2>
            <p class="mt-1 text-sm text-muted">Consultez l'état de vos demandes, modifiez-les tant qu'elles n'ont pas été traitées.</p>
        </a>
        <a href="{{ route('stagiaire.documents.index') }}" class="panel panel-body group block hover:border-pine-600">
            <x-icon name="document" class="h-6 w-6 text-pine-700" />
            <h2 class="mt-4 panel-title group-hover:text-pine-700">Mes documents</h2>
            <p class="mt-1 text-sm text-muted">Déposez les pièces demandées et téléchargez les documents établis par le service.</p>
        </a>
    </div>

    <section class="panel panel-body mt-6">
        <h2 class="panel-title">Comment se déroule une demande</h2>
        <ol class="mt-5 grid gap-6 text-sm md:grid-cols-3">
            <li>
                <x-status value="en_attente" />
                <p class="mt-2 text-muted">Vous choisissez un service et joignez vos documents. La demande attend son examen.</p>
            </li>
            <li>
                <x-status value="en_cours" />
                <p class="mt-2 text-muted">Le responsable du service étudie votre dossier et vérifie vos pièces.</p>
            </li>
            <li>
                <x-status value="validée" />
                <p class="mt-2 text-muted">Votre demande est acceptée et un encadrant vous est affecté.</p>
            </li>
        </ol>
    </section>
@endsection
