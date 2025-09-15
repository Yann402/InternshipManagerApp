<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Service;
use App\Models\Encadrant;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeResponsableController extends Controller
{
    public function index()
    {
        $responsable = Auth::user();
        $service = $responsable->service; // relation hasOne Service

        // si pas de service associé, retourner une collection vide pour la vue
        if (! $service) {
            $demandes = collect();
            return view('responsable.demandes.index', compact('demandes'));
        }

        $demandes = Demande::where('service_id', $service->id)
            ->with(['stagiaire', 'documents.typeDocument', 'service'])
            ->latest()
            ->get();

        return view('responsable.demandes.index', compact('demandes'));
    }

    public function show(Demande $demande)
    {
        $responsable = Auth::user();
        $service = $responsable->service;

        if (! $service || $demande->service_id !== $service->id) {
            abort(403, 'Accès interdit');
        }

        // si on ouvre la demande et qu'elle est "en_attente", on la marque en_cours
        if ($demande->statut === 'en_attente') {
            $demande->update(['statut' => 'en_cours']);
            // ne mettre en_cours que les docs concernés (évite d'écraser des statuts déjà définis)
            $demande->documents()->whereIn('statut', ['en_attente', 'manquant'])->update(['statut' => 'en_cours']);
        }

        $services = Service::orderBy('nom_service')->get();

        // recharge les relations nécessaires
        $demande->load('documents.typeDocument', 'stagiaire', 'service');

        return view('responsable.demandes.show', compact('demande', 'services'));
    }

    public function accepter(Demande $demande)
    {
        $this->authorizeDemande($demande);

        return redirect()->route('responsable.demandes.assigner.form', $demande->id);
    }


    public function refuser(Request $request, Demande $demande)
    {
        $this->authorizeDemande($demande);

        $request->validate(['motif' => 'required|string|max:500']);

        $demande->update([
            'statut' => 'refusée',
            'motif_refus' => $request->motif // suppose que tu as cette colonne
        ]);

        return back()->with('success', 'Demande refusée.');
    }

    public function transferer(Request $request, Demande $demande)
    {
        $this->authorizeDemande($demande);

        $request->validate(['service_id' => 'required|exists:services,id']);

        $demande->update([
            'service_id' => $request->service_id,
            'statut' => 'en_attente',
        ]);

        return back()->with('success', 'Demande transférée.');
    }

    private function authorizeDemande(Demande $demande)
    {
        $responsable = Auth::user();
        $service = $responsable->service;
        if (! $service || $demande->service_id !== $service->id) {
            abort(403, 'Action non autorisée');
        }
    }


    public function assignerForm(Demande $demande)
    {
        $this->authorizeDemande($demande);

        $encadrants = Encadrant::orderBy('nom')->get();
        $entreprises = Entreprise::orderBy('nom')->get();

        return view('responsable.demandes.assignation', compact('demande', 'encadrants', 'entreprises'));
    }

    public function assignerStore(Request $request, Demande $demande)
    {
        $this->authorizeDemande($demande);

        // === Encadrant ===
        if ($request->filled('encadrant_id')) {
            $encadrant_id = $request->encadrant_id;
        } elseif ($request->filled('encadrant_nom') && $request->filled('encadrant_prenom')) {
            $encadrant = Encadrant::create([
                'nom' => $request->encadrant_nom,
                'prenom' => $request->encadrant_prenom,
                'email' => $request->encadrant_email,
                'telephone' => $request->encadrant_telephone,
            ]);
            $encadrant_id = $encadrant->id;
        } else {
            $encadrant_id = null;
        }

        // === Entreprise ===
        if ($request->filled('entreprise_id')) {
            $entreprise_id = $request->entreprise_id;
        } elseif ($request->filled('entreprise_nom')) {
            $entreprise = Entreprise::create([
                'nom' => $request->entreprise_nom,
                'adresse' => $request->entreprise_adresse,
                'email' => $request->entreprise_email,
                'telephone' => $request->entreprise_telephone,
                'secteur' => $request->entreprise_secteur,
            ]);
            $entreprise_id = $entreprise->id;
        } else {
            $entreprise_id = null;
        }

        // 👉 Validation finale : une demande est validée seulement si un encadrant est attribué
        if ($encadrant_id) {
            $demande->update([
                'statut' => 'validée',
                'encadrant_id' => $encadrant_id,
                'entreprise_id' => $entreprise_id,
            ]);
        } else {
            // pas d’encadrant choisi, reste en cours
            $demande->update([
                'statut' => 'en_cours',
                'entreprise_id' => $entreprise_id,
            ]);
        }

        return redirect()->route('responsable.demandes.index')
            ->with('success', 'Encadrant et entreprise assignés avec succès.');
    }


}
