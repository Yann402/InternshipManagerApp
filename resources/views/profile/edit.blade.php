@extends(match (Auth::user()->role) {
    'admin' => 'layouts.admin',
    'responsable' => 'layouts.responsable',
    default => 'layouts.app',
})

@section('header')
    <div>
        <h1 class="page-title">Mon profil</h1>
        <p class="page-sub">Vos informations de connexion et la sécurité de votre compte.</p>
    </div>
@endsection

@section('content')
    <div class="max-w-2xl space-y-6">
        <div class="panel panel-body">@include('profile.partials.update-profile-information-form')</div>
        <div class="panel panel-body">@include('profile.partials.update-password-form')</div>
        <div class="panel panel-body border-red-200">@include('profile.partials.delete-user-form')</div>
    </div>
@endsection
