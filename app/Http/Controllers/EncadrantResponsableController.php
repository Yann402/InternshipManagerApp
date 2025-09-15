<?php

namespace App\Http\Controllers;

use App\Models\Encadrant;
use Illuminate\Http\Request;

class EncadrantResponsableController extends Controller
{
    public function index()
    {
        $encadrants = Encadrant::orderBy('nom')->paginate(15);
        return view('responsable.encadrants.index', compact('encadrants'));
    }

    public function create()
    {
        return view('responsable.encadrants.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom'=> 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string|max:20',
            'specialite' => 'nullable|string|max:255',
        ]);

        Encadrant::create($data);
        return redirect()->route('responsable.encadrants.index')->with('success', 'Encadrant ajouté.');
    }

    public function edit(Encadrant $encadrant)
    {
        return view('responsable.encadrants.edit', compact('encadrant'));
    }

    public function update(Request $request, Encadrant $encadrant)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom'=> 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string|max:20',
            'specialite' => 'nullable|string|max:255',
        ]);

        $encadrant->update($data);
        return redirect()->route('responsable.encadrants.index')->with('success', 'Encadrant mis à jour.');
    }

    public function destroy(Encadrant $encadrant)
    {
        $encadrant->delete();
        return back()->with('success', 'Encadrant supprimé.');
    }
}
