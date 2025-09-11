@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 shadow rounded">
        <h2 class="text-xl font-bold mb-4">Mon profil</h2>

        @include('profile.partials.update-profile-information-form')
        @include('profile.partials.update-password-form')
        @include('profile.partials.delete-user-form')
    </div>
@endsection
