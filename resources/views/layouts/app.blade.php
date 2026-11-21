@include('layouts.partials.shell', [
    'space' => 'Espace stagiaire',
    'home' => 'stagiaire.dashboard',
    'nav' => [
        ['route' => 'stagiaire.dashboard', 'active' => 'stagiaire.dashboard', 'icon' => 'home', 'label' => 'Tableau de bord'],
        ['route' => 'stagiaire.demandes.index', 'active' => 'stagiaire.demandes.*', 'icon' => 'inbox', 'label' => 'Mes demandes'],
        ['route' => 'stagiaire.documents.index', 'active' => 'stagiaire.documents.*', 'icon' => 'document', 'label' => 'Mes documents'],
    ],
])
