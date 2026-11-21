{{-- Coque commune aux trois espaces : $space (libellé), $nav (liens), $home (route d'accueil) --}}
@php $user = Auth::user(); $fullName = trim(($user->prenom ?? '') . ' ' . ($user->nom ?? '')); @endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $space }} | Gestion des stages</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=ibm-plex-sans:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div x-data="{ open: false }" class="min-h-screen lg:flex">

    {{-- Barre latérale --}}
    <aside :class="{ '!translate-x-0': open }"
           class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col bg-pine-700 transition-transform lg:static lg:translate-x-0">
        <a href="{{ route($home) }}" class="flex items-center gap-3 px-5 py-5">
            <span class="flex h-9 w-9 items-center justify-center rounded-md bg-white text-pine-700">
                <x-icon name="clipboard" class="h-5 w-5" />
            </span>
            <span class="leading-tight">
                <span class="block text-sm font-semibold text-white">Gestion des stages</span>
                <span class="block text-xs text-pine-100/80">CHU Ibn Sina, DSI</span>
            </span>
        </a>

        <p class="px-5 pb-2 pt-4 text-xs font-medium text-pine-100/70">{{ $space }}</p>
        <nav class="flex-1 space-y-1 px-3">
            @foreach ($nav as $item)
                <a href="{{ route($item['route']) }}"
                   class="nav-item {{ request()->routeIs($item['active']) ? 'is-active' : '' }}"
                   @if (request()->routeIs($item['active'])) aria-current="page" @endif>
                    <x-icon :name="$item['icon']" />
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="border-t border-white/10 p-3">
            <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'is-active' : '' }}">
                <x-icon name="user" />
                <span class="truncate">{{ $fullName ?: $user->email }}</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item w-full">
                    <x-icon name="logout" />
                    <span>Se déconnecter</span>
                </button>
            </form>
        </div>
    </aside>
    <div x-show="open" x-cloak @click="open = false" class="fixed inset-0 z-30 bg-ink/40 lg:hidden"></div>

    {{-- Zone principale --}}
    <div class="flex min-w-0 flex-1 flex-col">
        <header class="flex h-14 items-center gap-3 border-b border-line bg-white px-4 lg:hidden">
            <button type="button" @click="open = true" class="rounded-md p-1.5 text-muted hover:bg-paper" aria-label="Ouvrir le menu">
                <x-icon name="menu" class="h-6 w-6" />
            </button>
            <span class="text-sm font-semibold">Gestion des stages</span>
        </header>

        <main class="mx-auto w-full max-w-6xl flex-1 px-4 py-8 sm:px-8">
            @include('layouts.partials.flash')
            @hasSection('header')
                <div class="page-head">@yield('header')</div>
            @endif
            @yield('content')
        </main>

        @include('layouts.partials.footer')
    </div>
</div>
@yield('scripts')
</body>
</html>
