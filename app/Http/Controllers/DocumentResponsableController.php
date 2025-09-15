<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentResponsableController extends Controller
{
    public function index()
    {
        $responsable = Auth::user();

        $serviceId = $responsable->service ? $responsable->service->id : null;

        // Documents fournis par stagiaires
        $docsStagiaire = Document::with(['demande.stagiaire', 'typeDocument'])
            ->whereHas('typeDocument', fn($q) => $q->where('fourni_par', 'stagiaire'))
            ->when($serviceId, function ($q) use ($serviceId) {
                $q->whereHas('demande', fn($query) => $query->where('service_id', $serviceId));
            })
            ->latest()
            ->get();

        // Documents générés par responsables
        $docsResponsable = Document::with(['demande.stagiaire', 'typeDocument'])
            ->whereHas('typeDocument', fn($q) => $q->where('fourni_par', 'responsable'))
            ->when($serviceId, function ($q) use ($serviceId) {
                $q->whereHas('demande', fn($query) => $query->where('service_id', $serviceId));
            })
            ->latest()
            ->get();

        return view('responsable.documents.index', compact('docsStagiaire', 'docsResponsable'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'demande_id' => 'required|exists:demandes,id',
            'type_document_id' => 'required|exists:types_documents,id',
            'document' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ]);

        $path = $request->file('document')->store('documents_responsable', 'public');

        $doc = Document::updateOrCreate(
            [
                'demande_id' => $request->demande_id,
                'type_document_id' => $request->type_document_id,
            ],
            [
                'chemin_fichier' => $path,
                'statut' => 'disponible',
            ]
        );

        return redirect()->route('responsable.documents.index')->with('success', 'Document généré avec succès.');
    }


    /**
     * Voir un document (téléchargement ou affichage dans le navigateur)
     */
    public function show($id)
    {
        $doc = Document::findOrFail($id);

        if (!$doc->chemin_fichier || !Storage::disk('public')->exists($doc->chemin_fichier)) {
            abort(404, "Fichier introuvable");
        }

        return response()->file(storage_path('app/public/' . $doc->chemin_fichier));
    }

    public function destroy($id)
    {
        $doc = Document::findOrFail($id);

        // Supprimer le fichier physique
        if ($doc->chemin_fichier && Storage::disk('public')->exists($doc->chemin_fichier)) {
            Storage::disk('public')->delete($doc->chemin_fichier);
        }

        // Mettre à jour le document comme "non disponible"
        $doc->update([
            'chemin_fichier' => null,
            'statut' => 'non_disponible',
        ]);

        return back()->with('success', 'Le fichier a été supprimé. Le document est marqué comme non disponible.');
    }



    public function update(Request $request, Document $document)
    {
        $this->authorizeDocument($document);

        $request->validate(['statut' => 'required|in:valide,refuse']);

        $document->update(['statut' => $request->statut]);

        // Si tous les documents d'une demande sont valides → changer statut de la demande
        $demande = $document->demande;
        if ($demande->documents()->where('statut', '!=', 'valide')->count() === 0) {
            $demande->update(['statut' => 'valide']);
        }

        return back()->with('success', 'Document mis à jour.');
    }


    private function authorizeDocument(Document $document)
    {
        $responsable = Auth::user();
        $serviceId = $responsable->service ? $responsable->service->id : null;

        if (!$serviceId || $document->demande->service_id !== $serviceId) {
            abort(403, 'Accès interdit');
        }
    }

}
