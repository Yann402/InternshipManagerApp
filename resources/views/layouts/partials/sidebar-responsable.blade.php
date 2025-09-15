<div class="w-64 bg-white shadow-md p-6">
    <h2 class="text-xl font-bold mb-6">Menu Responsable</h2>
        <nav class="mt-6 space-y-6">
        <!-- Tableau de bord -->
        <a href="{{ route('responsable.interface') }}" 
           class="flex items-center gap-3 py-2.5 rounded hover:bg-gray-100">
            <!-- SVG dashboard -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6M5 10v10h14V10" />
            </svg>
            <span>Tableau de bord</span>
        </a>

        <!-- Demandes -->
        <a href="{{ route('responsable.demandes.index') }}" 
           class="flex items-center gap-3 py-2.5 rounded hover:bg-gray-100">
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
            <span>Demandes</span>
        </a>

        <!-- Mes documents -->
        <a href="{{ route('responsable.documents.index') }}" 
           class="flex items-center gap-3 py-2.5 rounded hover:bg-gray-100">
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
            <span>Documents</span>
        </a>

        <!-- Encacrants -->
        <a href="{{ route('responsable.encadrants.index') }}" 
           class="flex items-center gap-3 py-2.5 rounded hover:bg-gray-100">
            <!-- SVG encadrants -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 
                    0 3.75 3.75 0 0 1 7.5 
                    0ZM4.501 20.118a7.5 7.5 0 0 1 
                    14.998 0A17.933 17.933 0 0 1 12 
                    21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <span>Encadrants</span>
        </a>
    </nav>
</div>
