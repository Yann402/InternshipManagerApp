<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestion des stages | CHU Ibn Sina</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=ibm-plex-sans:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen lg:grid lg:grid-cols-[minmax(0,5fr)_minmax(0,6fr)]">
    <section class="hidden flex-col justify-between bg-pine-700 p-12 text-white lg:flex">
        <div class="flex items-center gap-3">
            <span class="flex h-10 w-10 items-center justify-center rounded-md bg-white text-pine-700">
                <x-icon name="clipboard" class="h-6 w-6" />
            </span>
            <span class="leading-tight">
                <span class="block font-semibold">Gestion des stages</span>
                <span class="block text-sm text-pine-100/80">CHU Ibn Sina, Division des Systèmes d'Information</span>
            </span>
        </div>
        <div class="max-w-md">
            <p class="text-3xl font-semibold leading-snug">Déposez votre demande de stage et suivez-la jusqu'à votre affectation.</p>
            <ol class="mt-10 space-y-4 text-sm text-pine-100">
                <li class="flex gap-3"><span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full border border-pine-100/50 text-xs">1</span>Vous choisissez un service et joignez vos documents.</li>
                <li class="flex gap-3"><span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full border border-pine-100/50 text-xs">2</span>Le responsable du service étudie votre dossier.</li>
                <li class="flex gap-3"><span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full border border-pine-100/50 text-xs">3</span>Une fois accepté, un encadrant vous est affecté.</li>
            </ol>
        </div>
        <p class="text-xs text-pine-100/70">© {{ date('Y') }} CHU Ibn Sina</p>
    </section>

    <main class="flex min-h-screen items-center justify-center px-6 py-12 lg:min-h-0">
        <div class="w-full max-w-sm">
            <div class="mb-8 flex items-center gap-3 lg:hidden">
                <span class="flex h-9 w-9 items-center justify-center rounded-md bg-pine-700 text-white">
                    <x-icon name="clipboard" class="h-5 w-5" />
                </span>
                <span class="font-semibold">Gestion des stages</span>
            </div>
            {{ $slot }}
        </div>
    </main>
</div>
</body>
</html>
