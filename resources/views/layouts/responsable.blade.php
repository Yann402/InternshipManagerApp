@include('layouts.partials.shell', [
    'space' => 'Espace responsable',
    'home' => 'responsable.interface',
    'nav' => [
        ['route' => 'responsable.interface', 'active' => 'responsable.interface', 'icon' => 'home', 'label' => 'Tableau de bord'],
        ['route' => 'responsable.demandes.index', 'active' => 'responsable.demandes.*', 'icon' => 'inbox', 'label' => 'Demandes'],
        ['route' => 'responsable.documents.index', 'active' => 'responsable.documents.*', 'icon' => 'document', 'label' => 'Documents'],
        ['route' => 'responsable.encadrants.index', 'active' => 'responsable.encadrants.*', 'icon' => 'users', 'label' => 'Encadrants'],
    ],
])
