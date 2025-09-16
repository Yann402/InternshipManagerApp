<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StagiaireAdminController extends Controller
{
    public function index()
    {
        $stagiaires = User::where('role', 'stagiaire')->get();
        return view('admin.stagiaires.index', compact('stagiaires'));
    }

    public function create()
    {
        return view('admin.stagiaires.create'); // plus besoin de services
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'formation' => 'nullable|string|max:255',
            'niveau_etude' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'formation' => $validated['formation'] ?? null,
            'niveau_etude' => $validated['niveau_etude'] ?? null,
            'telephone' => $validated['telephone'] ?? null,
            'adresse' => $validated['adresse'] ?? null,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'stagiaire', // si tu utilises un champ "role"
        ]);

        return redirect()->route('admin.stagiaires.index')
            ->with('success', 'Le stagiaire a été créé avec succès ✅');
    }

    public function edit($id)
    {
        $stagiaire = User::where('role', 'stagiaire')->findOrFail($id);
        return view('admin.stagiaires.edit', compact('stagiaire'));
    }

    public function update(Request $request, $id)
    {
        $stagiaire = User::where('role', 'stagiaire')->findOrFail($id);

        $request->validate([
            'nom'       => 'required|string|max:255',
            'prenom'    => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $stagiaire->id,
            'password'  => 'nullable|min:6|confirmed',
        ]);

        $data = $request->only(['nom', 'prenom', 'email']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $stagiaire->update($data);

        return redirect()->route('admin.stagiaires.index')->with('success', 'Stagiaire mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $stagiaire = User::where('role', 'stagiaire')->findOrFail($id);
        $stagiaire->delete();

        return redirect()->route('admin.stagiaires.index')->with('success', 'Stagiaire supprimé avec succès.');
    }

    public function show($id)
    {
        $stagiaire = User::where('role', 'stagiaire')
            ->with([
                'demandes.service.responsable',
                'demandes.documents.typeDocument',
                'demandes.encadrant',
                'demandes.entreprise'
            ])
            ->findOrFail($id);

        return view('admin.stagiaires.show', compact('stagiaire'));
    }
}
