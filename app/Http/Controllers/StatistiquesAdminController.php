<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;

class StatistiquesAdminController extends Controller
{
    public function index()
    {
        $totalStagiaires = User::where('role', 'stagiaire')->count();

        $docsValides = Document::where('statut', 'valide')->count();
        $docsRefuses = Document::where('statut', 'refuse')->count();
        $docsAttente = Document::whereNull('statut')->count();

        return view('admin.statistiques.index', compact(
            'totalStagiaires',
            'docsValides',
            'docsRefuses',
            'docsAttente'
        ));
    }
}
