<aside class="w-64 bg-white">
    <div class="p-4 text-lg font-bold text-blue-600">
        {{ config('app.name', 'Laravel') }}
    </div>

    <nav class="mt-6 space-y-1">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 py-2.5 px-4 rounded hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 
                    .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 
                    1.125-1.125h2.25c.621 0 1.125.504 
                    1.125 1.125V21h4.125c.621 0 
                    1.125-.504 1.125-1.125V9.75M8.25 
                    21h8.25" />
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- Divisions & Services -->
        <a href="{{ route('admin.divisions.index') }}" class="flex items-center gap-3 py-2.5 px-4 rounded hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 
                    6.75h1.5m-1.5 3h1.5m-1.5 
                    3h1.5m3-6H15m-1.5 3H15m-1.5 
                    3H15M9 21v-3.375c0-.621.504-1.125 
                    1.125-1.125h3.75c.621 0 1.125.504 
                    1.125 1.125V21" />
            </svg>
            <span>Divisions & Services</span>
        </a>

        <!-- Responsables -->
        <a href="{{ route('admin.responsables.index') }}" class="flex items-center gap-3 py-2.5 px-4 rounded hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 
                    0 3.75 3.75 0 0 1 7.5 
                    0ZM4.501 20.118a7.5 7.5 0 0 1 
                    14.998 0A17.933 17.933 0 0 1 12 
                    21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <span>Responsables</span>
        </a>

        <!-- Stagiaires -->
        <a href="{{ route('admin.stagiaires.index') }}" class="flex items-center gap-3 py-2.5 px-4 rounded hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4.26 10.147a60.438 60.438 0 0 
                    0-.491 6.347A48.62 48.62 0 0 1 12 
                    20.904a48.62 48.62 0 0 1 8.232-4.41 
                    60.46 60.46 0 0 
                    0-.491-6.347m-15.482 0a50.636 50.636 
                    0 0 0-2.658-.813A59.906 59.906 0 0 
                    1 12 3.493a59.903 59.903 0 0 1 10.399 
                    5.84c-.896.248-1.783.52-2.658.814m-15.482 
                    0A50.717 50.717 0 0 1 12 13.489a50.702 
                    50.702 0 0 1 7.74-3.342M6.75 15a.75.75 
                    0 1 0 0-1.5.75.75 0 0 0 0 
                    1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 
                    8.443m-7.007 11.55A5.981 5.981 0 0 0 
                    6.75 15.75v-1.5" />
            </svg>
            <span>Stagiaires</span>
        </a>

        <!-- Pièces obligatoires -->
        <a href="{{ route('admin.types_documents.index') }}" class="flex items-center gap-3 py-2.5 px-4 rounded hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 
                    0-3.375-3.375h-1.5A1.125 1.125 0 0 1 
                    13.5 7.125v-1.5a3.375 3.375 0 0 
                    0-3.375-3.375H8.25m2.25 
                    0H5.625c-.621 0-1.125.504-1.125 
                    1.125v17.25c0 .621.504 1.125 1.125 
                    1.125h12.75c.621 0 1.125-.504 
                    1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            <span>Pièces obligatoires</span>
        </a>

        <!-- Statistiques -->
        <a href="{{ route('admin.statistiques.index') }}" class="flex items-center gap-3 py-2.5 px-4 rounded hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 13.125C3 12.504 3.504 12 
                    4.125 12h2.25c.621 0 1.125.504 
                    1.125 1.125v6.75C7.5 20.496 6.996 
                    21 6.375 21h-2.25A1.125 1.125 0 0 
                    1 3 19.875v-6.75ZM9.75 
                    8.625c0-.621.504-1.125 
                    1.125-1.125h2.25c.621 0 1.125.504 
                    1.125 1.125v11.25c0 .621-.504 
                    1.125-1.125 1.125h-2.25a1.125 
                    1.125 0 0 1-1.125-1.125V8.625ZM16.5 
                    4.125c0-.621.504-1.125 
                    1.125-1.125h2.25C20.496 3 21 
                    3.504 21 4.125v15.75c0 .621-.504 
                    1.125-1.125 1.125h-2.25a1.125 
                    1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>
            <span>Statistiques</span>
        </a>
    </nav>
</aside>
