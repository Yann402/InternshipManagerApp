<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DivisionController extends Controller
{


    /**
     * Liste des divisions
     */
    public function index()
    {
        $divisions = Division::withCount('services')->orderBy('nom_division')->get();

        return view('admin.divisions.index', compact('divisions'));
    }

    /**
     * Formulaire création
     */
    public function create()
    {
        return view('admin.divisions.create');
    }

    /**
     * Enregistrement
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom_division' => ['required','string','max:255','unique:divisions,nom_division'],
        ]);

        Division::create($data);

        return redirect()->route('admin.divisions.index')->with('ok','Division créée.');
    }

    /**
     * Formulaire édition
     */
    public function edit(Division $division)
    {
        return view('admin.divisions.edit', compact('division'));
    }

    /**
     * Mise à jour
     */
    public function update(Request $request, Division $division)
    {
        $data = $request->validate([
            'nom_division' => [
                'required','string','max:255',
                Rule::unique('divisions','nom_division')->ignore($division->id),
            ],
        ]);

        $division->update($data);

        return redirect()->route('admin.divisions.index')->with('ok','Division mise à jour.');
    }

    /**
     * Suppression
     */
    public function destroy(Division $division)
    {
        $division->delete(); // cascade sur services si FK onDelete('cascade')
        return back()->with('ok','Division supprimée.');
    }
}
