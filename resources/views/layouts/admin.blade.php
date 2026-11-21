@include('layouts.partials.shell', [
    'space' => 'Administration',
    'home' => 'admin.dashboard',
    'nav' => [
        ['route' => 'admin.dashboard', 'active' => 'admin.dashboard', 'icon' => 'home', 'label' => 'Tableau de bord'],
        ['route' => 'admin.divisions.index', 'active' => 'admin.divisions.*', 'icon' => 'building', 'label' => 'Divisions'],
        ['route' => 'admin.services.index', 'active' => 'admin.services.*', 'icon' => 'squares', 'label' => 'Services'],
        ['route' => 'admin.responsables.index', 'active' => 'admin.responsables.*', 'icon' => 'user', 'label' => 'Responsables'],
        ['route' => 'admin.stagiaires.index', 'active' => 'admin.stagiaires.*', 'icon' => 'academic', 'label' => 'Stagiaires'],
        ['route' => 'admin.types_documents.index', 'active' => 'admin.types_documents.*', 'icon' => 'clipboard', 'label' => 'Pièces obligatoires'],
        ['route' => 'admin.statistiques.index', 'active' => 'admin.statistiques.*', 'icon' => 'chart', 'label' => 'Statistiques'],
    ],
])
