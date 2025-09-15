@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-6">📊 Tableau de bord des statistiques</h2>

    <!-- Statistiques globales -->
    <div class="grid grid-cols-3 gap-6 text-center mb-8">
        <div class="bg-blue-100 p-6 rounded-lg shadow">
            <p class="text-2xl font-bold">{{ $totalStagiaires }}</p>
            <p class="text-gray-600">Stagiaires</p>
        </div>

        <div class="bg-green-100 p-6 rounded-lg shadow">
            <p class="text-2xl font-bold">{{ $docsValides }}</p>
            <p class="text-gray-600">Documents validés</p>
        </div>

        <div class="bg-red-100 p-6 rounded-lg shadow">
            <p class="text-2xl font-bold">{{ $docsRefuses }}</p>
            <p class="text-gray-600">Documents refusés</p>
        </div>

        <div class="bg-yellow-100 p-6 rounded-lg shadow col-span-3">
            <p class="text-2xl font-bold">{{ $docsAttente }}</p>
            <p class="text-gray-600">Documents en attente</p>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="grid grid-cols-2 gap-8">
        <!-- Répartition des documents -->
        <div class="bg-white border rounded-lg p-4 shadow">
            <h3 class="text-lg font-semibold mb-3">📑 Répartition des documents</h3>
            <canvas id="docsChart"></canvas>
        </div>

        <!-- Stagiaires par service -->
        <div class="bg-white border rounded-lg p-4 shadow">
            <h3 class="text-lg font-semibold mb-3">👨‍💼 Stagiaires par service</h3>
            <canvas id="stagiairesServiceChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 📑 Documents chart (Pie chart)
    const ctxDocs = document.getElementById('docsChart').getContext('2d');
    new Chart(ctxDocs, {
        type: 'pie',
        data: {
            labels: ['Validés', 'Refusés', 'En attente'],
            datasets: [{
                data: [{{ $docsValides }}, {{ $docsRefuses }}, {{ $docsAttente }}],
                backgroundColor: ['#34d399', '#f87171', '#fbbf24'],
            }]
        }
    });

    // 👨‍💼 Stagiaires par service (Bar chart)
    const ctxServices = document.getElementById('stagiairesServiceChart').getContext('2d');
    new Chart(ctxServices, {
        type: 'bar',
        data: {
            labels: {!! json_encode($servicesLabels) !!},
            datasets: [{
                label: 'Nombre de stagiaires',
                data: {!! json_encode($servicesCounts) !!},
                backgroundColor: '#60a5fa'
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
