@props(['value'])
@php
$map = [
    'en_attente' => ['status-wait', 'En attente'],
    'en_cours' => ['status-progress', 'En cours'],
    'validée' => ['status-ok', 'Validée'],
    'valide' => ['status-ok', 'Validé'],
    'disponible' => ['status-ok', 'Disponible'],
    'refusée' => ['status-ko', 'Refusée'],
    'refusé' => ['status-ko', 'Refusé'],
    'refuse' => ['status-ko', 'Refusé'],
    'non_disponible' => ['status-neutral', 'Non disponible'],
];
[$class, $label] = $map[$value] ?? ['status-neutral', ucfirst(str_replace('_', ' ', (string) $value))];
@endphp
<span {{ $attributes->merge(['class' => $class]) }}>{{ $label }}</span>
