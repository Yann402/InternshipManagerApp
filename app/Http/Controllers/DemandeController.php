<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Service;
use App\Models\TypeDocument;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    public function index()
    {
        $demandes = Demande::where('user_id', Auth::id())
            ->with('service')
            ->orderByDesc('created_at')
            ->get();

        return view('stagiaire.demandes.index', compact('demandes'));
    }

    public function create()
    {
        $services = Service::orderBy('nom_service')->get();

        // 👉 Uniquement les documents que le stagiaire doit fournir
        $typesDocuments = TypeDocument::where('fourni_par', 'stagiaire')
            ->orderBy('libelle')
            ->get();

        return view('stagiaire.demandes.create', compact('services', 'typesDocuments'));
    }

    public function store(Request $request)
    {
        $typesDocuments = TypeDocument::all();

        $rules = [
            'service_id' => 'required|exists:services,id',
        ];

        foreach ($typesDocuments as $type) {
            $mimes = $type->type_fichier === 'image' ? 'jpg,jpeg,png' : 'pdf';

            if ($type->fourni_par === 'stagiaire' && $type->obligatoire) {
                $rules["documents.{$type->id}"] = "required|file|mimes:$mimes|max:2048";
            } elseif ($type->fourni_par === 'stagiaire') {
                $rules["documents.{$type->id}"] = "nullable|file|mimes:$mimes|max:2048";
            }
        }

        $validated = $request->validate($rules);

        $demande = Demande::create([
            'user_id' => Auth::id(),
            'service_id' => $validated['service_id'],
            'date_soumission' => now(),
            'statut' => 'en_attente',
        ]);

        foreach ($typesDocuments as $type) {
            if ($type->fourni_par === 'stagiaire') {
                $file = $request->file("documents.{$type->id}");
                $chemin = null;
                $date_upload = null;

                if ($file) {
                    $chemin = $file->store('documents', 'public');
                    $date_upload = now();
                }

                Document::create([
                    'demande_id' => $demande->id,
                    'type_document_id' => $type->id,
                    'chemin_fichier' => $chemin,
                    'statut' => $file ? 'en_attente' : 'manquant',
                    'date_upload' => $date_upload,
                ]);
            } else {
                // 👉 Document généré par le responsable
                Document::create([
                    'demande_id' => $demande->id,
                    'type_document_id' => $type->id,
                    'chemin_fichier' => null,
                    'statut' => 'non_disponible',
                    'date_upload' => null,
                ]);
            }
        }

        return redirect()->route('stagiaire.demandes.index')
            ->with('success', 'Demande soumise avec succès.');
    }

    public function show(Demande $demande)
    {
        if ($demande->user_id !== Auth::id()) {
            abort(403);
        }

        $demande->load('documents.typeDocument', 'service.responsable');

        return view('stagiaire.demandes.show', compact('demande'));
    }

    public function edit(Demande $demande)
    {
        if ($demande->user_id !== Auth::id()) abort(403);

        if (!in_array($demande->statut, ['en_attente', 'refusée'])) {
            return redirect()->route('stagiaire.demandes.index')
                ->with('error', 'Modification non autorisée.');
        }

        $services = Service::orderBy('nom_service')->get();
        $typesDocuments = TypeDocument::where('fourni_par', 'stagiaire')
            ->orderBy('libelle')
            ->get();

        $demande->load('documents');

        return view('stagiaire.demandes.edit', compact('demande', 'services', 'typesDocuments'));
    }

    public function update(Request $request, Demande $demande)
    {
        if ($demande->user_id !== Auth::id()) abort(403);

        if (!in_array($demande->statut, ['en_attente', 'refusée'])) {
            return redirect()->route('stagiaire.demandes.index')
                ->with('error', 'Modification non autorisée.');
        }

        $typesDocuments = TypeDocument::where('fourni_par', 'stagiaire')->get();

        $rules = [
            'service_id' => 'required|exists:services,id',
        ];

        foreach ($typesDocuments as $type) {
            $mimes = $type->type_fichier === 'image' ? 'jpg,jpeg,png' : 'pdf';
            $rules["documents.{$type->id}"] = "nullable|file|mimes:$mimes|max:2048";
        }

        $validated = $request->validate($rules);

        $demande->update([
            'service_id' => $validated['service_id'],
        ]);

        foreach ($typesDocuments as $type) {
            $file = $request->file("documents.{$type->id}");

            if ($file) {
                $chemin = $file->store('documents', 'public');

                $doc = Document::firstOrNew([
                    'demande_id' => $demande->id,
                    'type_document_id' => $type->id,
                ]);

                $doc->chemin_fichier = $chemin;
                $doc->date_upload = now();
                $doc->statut = 'en_attente';
                $doc->save();
            }
        }

        return redirect()->route('stagiaire.demandes.index')
            ->with('success', 'Demande mise à jour.');
    }

    public function destroy(Demande $demande)
    {
        if ($demande->user_id !== Auth::id()) abort(403);

        if (!in_array($demande->statut, ['en_attente', 'refusée'])) {
            return redirect()->route('stagiaire.demandes.index')
                ->with('error', 'Suppression non autorisée.');
        }

        $demande->delete();

        return redirect()->route('stagiaire.demandes.index')
            ->with('success', 'Demande supprimée.');
    }
}
