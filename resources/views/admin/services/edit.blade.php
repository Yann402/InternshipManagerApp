@extends('layouts.admin')

@section('header')
    <div>
        <a href="{{ route('admin.services.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm link"><x-icon name="arrow-left" class="h-4 w-4" /> Services</a>
        <h1 class="page-title">Modifier le service</h1>
    </div>
@endsection

@section('content')
<form action="{{ route('admin.services.update', $service) }}" method="POST" class="panel panel-body max-w-2xl">
    @csrf
    @method('PUT')
    @include('admin.services._form', ['service' => $service])
    <div class="flex items-center gap-3">
        <button class="btn-primary">Enregistrer les modifications</button>
        <a href="{{ route('admin.services.index') }}" class="btn-secondary">Annuler</a>
    </div>
</form>
@endsection
