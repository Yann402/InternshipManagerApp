@extends('layouts.admin')

@section('header')
    <div>
        <h1 class="page-title">Statistiques</h1>
        <p class="page-sub">Vue d'ensemble des stagiaires et du traitement des documents.</p>
    </div>
@endsection

@section('content')
@php
    $totalDocs = $docsValides + $docsRefuses + $docsAttente;
    $pct = fn ($n) => $totalDocs > 0 ? round($n * 100 / $totalDocs) : 0;
@endphp

<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    <div class="stat">
        <p class="stat-label">Stagiaires</p>
        <p class="stat-value">{{ $totalStagiaires }}</p>
    </div>
    <div class="stat">
        <x-status value="valide" />
        <p class="stat-value">{{ $docsValides }}</p>
    </div>
    <div class="stat">
        <x-status value="en_attente" />
        <p class="stat-value">{{ $docsAttente }}</p>
    </div>
    <div class="stat">
        <x-status value="refuse" />
        <p class="stat-value">{{ $docsRefuses }}</p>
    </div>
</div>

<section class="panel panel-body mt-6">
    <div class="flex flex-wrap items-baseline justify-between gap-2">
        <h2 class="panel-title">Traitement des documents</h2>
        <p class="text-sm text-muted">{{ $totalDocs }} documents au total</p>
    </div>
    @if($totalDocs > 0)
        <div class="mt-4 flex h-3 overflow-hidden rounded-full bg-paper" role="img"
             aria-label="{{ $pct($docsValides) }} % validés, {{ $pct($docsAttente) }} % en attente, {{ $pct($docsRefuses) }} % refusés">
            <div class="bg-emerald-600" style="width: {{ $pct($docsValides) }}%"></div>
            <div class="bg-amber-500" style="width: {{ $pct($docsAttente) }}%"></div>
            <div class="bg-red-600" style="width: {{ $pct($docsRefuses) }}%"></div>
        </div>
        <ul class="mt-3 flex flex-wrap gap-x-6 gap-y-1 text-sm text-muted">
            <li><span class="mr-1.5 inline-block h-2 w-2 rounded-full bg-emerald-600"></span>Validés {{ $pct($docsValides) }} %</li>
            <li><span class="mr-1.5 inline-block h-2 w-2 rounded-full bg-amber-500"></span>En attente {{ $pct($docsAttente) }} %</li>
            <li><span class="mr-1.5 inline-block h-2 w-2 rounded-full bg-red-600"></span>Refusés {{ $pct($docsRefuses) }} %</li>
        </ul>
    @else
        <p class="mt-4 text-sm text-muted">Aucun document n'a encore été déposé.</p>
    @endif
</section>

<section class="panel panel-body mt-6">
    <h2 class="panel-title">Stagiaires par service</h2>
    @php $counts = collect($servicesCounts)->values(); $max = max(1, (int) $counts->max()); @endphp
    @if(count($servicesLabels))
        <ul class="mt-5 space-y-3">
            @foreach($servicesLabels as $i => $label)
                @php $n = (int) ($counts[$i] ?? 0); @endphp
                <li class="grid grid-cols-[minmax(8rem,14rem)_1fr_2.5rem] items-center gap-4 text-sm">
                    <span class="truncate" title="{{ $label }}">{{ $label }}</span>
                    <span class="h-2.5 rounded-full bg-paper">
                        <span class="block h-2.5 rounded-full bg-pine-700" style="width: {{ round($n * 100 / $max) }}%"></span>
                    </span>
                    <span class="text-right font-medium tabular-nums">{{ $n }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <p class="mt-4 text-sm text-muted">Aucun service configuré.</p>
    @endif
</section>
@endsection
