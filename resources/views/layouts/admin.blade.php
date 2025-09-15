<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('layouts.partials.sidebar-admin')

        <div class="flex-1 flex flex-col">

            {{-- Header --}}
            @include('layouts.partials.admin-header')

            {{-- Contenu principal --}}
            <main class="flex-1 p-6">
                @yield('content')
            </main>

            @yield('scripts')

            {{-- Footer (commun à tout le monde) --}}
            @include('layouts.partials.footer')

        </div>
    </div>
</body>
</html>