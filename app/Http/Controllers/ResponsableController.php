<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Demande;
use App\Models\Document;
use App\Models\Encadrant;

class ResponsableController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $service = $user->service ?? null;

        if (!$service) {
            return redirect()->back()->with('error', 'Aucun service associé.');
        }

        // Statistiques
        $stats = [
            'demandes_en_attente' => Demande::where('service_id', $service->id)->where('statut', 'en_attente')->count(),
            'demandes_en_cours'   => Demande::where('service_id', $service->id)->where('statut', 'en_cours')->count(),
            'demandes_validees'   => Demande::where('service_id', $service->id)->where('statut', 'validée')->count(),
            'demandes_refusees'   => Demande::where('service_id', $service->id)->where('statut', 'refusée')->count(),

            'documents_disponibles' => Document::whereHas('demande', function($q) use ($service) {
                $q->where('service_id', $service->id);
            })->where('statut', 'disponible')->count(),

            'documents_en_cours' => Document::whereHas('demande', function($q) use ($service) {
                $q->where('service_id', $service->id);
            })->where('statut', 'en_cours')->count(),

            'encadrants' => Encadrant::count()
        ];

        return view('responsable.interface', compact('stats', 'service'));
    }
}
