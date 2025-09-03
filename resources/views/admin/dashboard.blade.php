<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-gray-800 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-gray-700">
            Admin Panel
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">🏠 Dashboard</a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">🏢 Divisions & Services</a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">👔 Responsables</a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">🎓 Stagiaires</a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">📂 Pièces obligatoires</a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">📊 Statistiques</a>
        </nav>
        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full py-2 px-4 bg-red-600 hover:bg-red-700 rounded">
                    🚪 Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <!-- Contenu principal -->
    <main class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-6">Bienvenue, Administrateur 👋</h1>

        <!-- Exemple de cartes -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-lg font-semibold">Divisions</h2>
                <p class="text-2xl font-bold text-blue-600">5</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-lg font-semibold">Services</h2>
                <p class="text-2xl font-bold text-green-600">12</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-lg font-semibold">Stagiaires</h2>
                <p class="text-2xl font-bold text-purple-600">45</p>
            </div>
        </div>
    </main>

</body>
</html>