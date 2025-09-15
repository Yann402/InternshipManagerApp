<aside class="w-64 bg-white shadow-md">
    <nav class="mt-6 space-y-6 px-3">
        <!-- Tableau de bord -->
        <a href="{{ route('stagiaire.dashboard') }}" 
           class="flex items-center gap-3 py-2.5 px-4 rounded hover:bg-gray-100">
            <!-- SVG dashboard -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6M5 10v10h14V10" />
            </svg>
            <span>Tableau de bord</span>
        </a>

        <!-- Mes demandes -->
        <a href="{{ route('stagiaire.demandes.index') }}" 
           class="flex items-center gap-3 py-2.5 px-4 rounded hover:bg-gray-100">
            <!-- SVG demandes -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 
                      1.125 0 0 1 13.5 7.125v-1.5a3.375 
                      3.375 0 0 0-3.375-3.375H8.25m0 
                      12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 
                      0-1.125.504-1.125 1.125v17.25c0 
                      .621.504 1.125 1.125 1.125h12.75c.621 
                      0 1.125-.504 1.125-1.125V11.25a9 
                      9 0 0 0-9-9Z" />
            </svg>
            <span>Mes demandes</span>
        </a>

        <!-- Mes documents -->
        <a href="{{ route('stagiaire.documents.index') }}" 
           class="flex items-center gap-3 py-2.5 px-4 rounded hover:bg-gray-100">
            <!-- SVG documents -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 
                      0 0-3.375-3.375h-1.5A1.125 1.125 
                      0 0 1 13.5 7.125v-1.5a3.375 
                      3.375 0 0 0-3.375-3.375H8.25m2.25 
                      0H5.625c-.621 0-1.125.504-1.125 
                      1.125v17.25c0 .621.504 1.125 
                      1.125 1.125h12.75c.621 0 1.125-.504 
                      1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            <span>Mes documents</span>
        </a>
    </nav>
</aside>
