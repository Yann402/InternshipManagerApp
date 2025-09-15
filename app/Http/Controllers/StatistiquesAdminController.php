<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Document;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StatistiquesAdminController extends Controller
{
    public function index()
    {
        // total de comptes users ayant le rôle 'stagiaire'
        $totalStagiaires = User::where('role', 'stagiaire')->count();

        // documents (statuts côté document)
        $docsValides = Document::where('statut', 'valide')->count();
        $docsRefuses = Document::where('statut', 'refuse')->count();
        $docsAttente = Document::where('statut', 'en_attente')->count();

        // calcul des stagiaires par service :
        // on compte les user_id distincts dans la table "demandes" groupés par service_id
        $countsByService = DB::table('demandes')
            ->join('users', 'demandes.user_id', '=', 'users.id')
            ->where('users.role', 'stagiaire')
            ->select('demandes.service_id', DB::raw('COUNT(DISTINCT demandes.user_id) as cnt'))
            ->groupBy('demandes.service_id')
            ->pluck('cnt', 'service_id'); // collection [service_id => cnt]

        // récupérer la liste des services (pour affichage, même ceux à 0)
        $services = Service::orderBy('nom_service')->get();

        $servicesLabels = $services->pluck('nom_service')->toArray();
        $servicesCounts = $services->map(function ($s) use ($countsByService) {
            return (int) ($countsByService[$s->id] ?? 0);
        })->toArray();

        return view('admin.statistiques.index', compact(
            'totalStagiaires',
            'docsValides',
            'docsRefuses',
            'docsAttente',
            'servicesLabels',
            'servicesCounts'
        ));
    }
}
