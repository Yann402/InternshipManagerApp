<?php

namespace App\Http\Controllers;

use App\Models\TypeDocument;
use Illuminate\Http\Request;

class TypeDocumentController extends Controller
{
    /**
     * Liste des types de documents
     */
    public function index()
    {
        $types_document = TypeDocument::all();
        return view('admin.types_documents.index', compact('types_document'));
    }

    /**
     * Formulaire création
     */
    public function create()
    {
        return view('admin.types_documents.create');
    }

    /**
     * Enregistrement en BDD
     */
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'obligatoire' => 'nullable|boolean',
            'fourni_par' => 'required|in:stagiaire,responsable',
            'type_fichier' => 'required|in:pdf,image',
        ]);

        TypeDocument::create([
            'libelle' => $request->libelle,
            'obligatoire' => $request->has('obligatoire'),
            'fourni_par' => $request->fourni_par,
            'type_fichier' => $request->type_fichier,
        ]);

        return redirect()->route('admin.types_documents.index')
            ->with('success', 'Type de document créé avec succès.');
    }

    /**
     * Formulaire édition
     */
    public function edit(TypeDocument $types_document)
    {
        return view('admin.types_documents.edit', compact('types_document'));
    }

    /**
     * Mise à jour
     */
    public function update(Request $request, TypeDocument $types_document)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'obligatoire' => 'nullable|boolean',
            'fourni_par' => 'required|in:stagiaire,responsable',
            'type_fichier' => 'required|in:pdf,image',
        ]);

        $types_document->update([
            'libelle' => $request->libelle,
            'obligatoire' => $request->has('obligatoire'),
            'fourni_par' => $request->fourni_par,
            'type_fichier' => $request->type_fichier,
        ]);

        return redirect()->route('admin.types_documents.index')
            ->with('success', 'Type de document mis à jour avec succès.');
    }

    /**
     * Suppression
     */
    public function destroy(TypeDocument $types_document)
    {
        try {
            $types_document->delete();
            return redirect()->route('admin.types_documents.index')
                ->with('success', 'Type de document supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('admin.types_documents.index')
                ->with('error', 'Impossible de supprimer ce type de document car il est utilisé.');
        }
    }
}
