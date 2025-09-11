<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\TypeDocument;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DocumentsController extends Controller
{
    use AuthorizesRequests;
    /**
     * Liste des documents du stagiaire
     */
    public function index()
    {
        $user = Auth::user();
        $demande = Demande::where('user_id', $user->id)->latest()->first();

        if (!$demande) {
            return redirect()->route('stagiaire.dashboard')
                ->with('error', 'Aucune demande trouvée.');
        }

        $documents = $demande->documents()->with('typeDocument')->get();

        $typesDocuments = TypeDocument::orderBy('libelle')->get();

        return view('stagiaire.documents.index', compact('demande', 'documents', 'typesDocuments'));
  }


    /**
     * Formulaire de création
     */
    public function create()
    {
        $typesDocuments = TypeDocument::where('fourni_par', 'stagiaire')->get();
        return view('stagiaire.documents.create', compact('typesDocuments'));
    }

    /**
     * Enregistrement des documents
     */
    public function store(Request $request)
    {
        $typesDocuments = TypeDocument::where('fourni_par', 'stagiaire')->get();

        $rules = [];
        foreach ($typesDocuments as $type) {
            $mimes = $type->type_fichier === 'pdf' ? 'pdf' : 'jpg,jpeg,png';

            $rule = "nullable|file|mimes:$mimes|max:2048";

            if ($type->obligatoire) {
                $rule = "required|file|mimes:$mimes|max:2048";
            }

            // Si c'est une photo : ajouter règle de dimensions
            if ($type->type_fichier === 'image') {
                $rule .= '|dimensions:min_width=200,min_height=200,max_width=2000,max_height=2000';
            }

            $rules["documents.{$type->id}"] = $rule;
        }

        $validated = $request->validate($rules);

        $demande = Demande::where('stagiaire_id', Auth::id())->latest()->firstOrFail();

        foreach ($typesDocuments as $type) {
            if ($request->hasFile("documents.{$type->id}")) {
                $path = $request->file("documents.{$type->id}")->store('documents', 'public');

                Document::updateOrCreate(
                    [
                        'demande_id' => $demande->id,
                        'type_document_id' => $type->id,
                    ],
                    [
                        'chemin_fichier' => $path,
                        'statut' => 'en_attente',
                    ]
                );
            }
        }

        return redirect()->route('stagiaire.documents.index')
            ->with('success', 'Documents envoyés avec succès.');
    }

    /**
     * Voir un document
     */
    public function show(Document $document)
    {
        $this->authorize('view', $document);
        return view('stagiaire.documents.show', compact('document'));
    }

    /**
     * Modifier un document
     */
    public function edit(Document $document)
    {
        $this->authorize('update', $document);
        return view('stagiaire.documents.edit', compact('document'));
    }

    /**
     * Mise à jour
     */
    public function update(Request $request, Document $document)
    {
        $this->authorize('update', $document);

        $type = $document->typeDocument;
        $mimes = $type->type_fichier === 'pdf' ? 'pdf' : 'jpg,jpeg,png';

        $rule = "nullable|file|mimes:$mimes|max:2048";

        if ($type->type_fichier === 'image') {
            $rule .= '|dimensions:min_width=200,min_height=200,max_width=2000,max_height=2000';
        }

        $request->validate([
            'fichier' => $rule,
        ]);

        if ($request->hasFile('fichier')) {
            if ($document->fichier) {
                Storage::disk('public')->delete($document->fichier);
            }

            $path = $request->file('fichier')->store('documents', 'public');
            $document->update([
                'fichier' => $path,
                'statut' => 'en_attente',
            ]);
        }

        return redirect()->route('stagiaire.documents.index')
            ->with('success', 'Document mis à jour.');
    }

    /**
     * Supprimer un document
     */
    public function destroy(Document $document)
    {
        $this->authorize('delete', $document);

        if ($document->fichier) {
            Storage::disk('public')->delete($document->fichier);
        }

        $document->delete();

        return redirect()->route('stagiaire.documents.index')
            ->with('success', 'Document supprimé.');
    }
}
