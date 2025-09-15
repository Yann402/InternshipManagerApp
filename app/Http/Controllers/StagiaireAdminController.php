<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;

class StagiaireAdminController extends Controller
{
    public function index()
    {
        $stagiaires = User::where('role', 'stagiaire')->with('service')->get();
        return view('admin.stagiaires.index', compact('stagiaires'));
    }

    public function create()
    {
        $services = Service::all();
        return view('admin.stagiaires.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'service_id' => 'nullable|exists:services,id',
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => bcrypt($request->password),
            'role'       => 'stagiaire',
            'service_id' => $request->service_id,
        ]);

        return redirect()->route('admin.stagiaires.index')->with('success', 'Stagiaire ajouté avec succès.');
    }

    public function edit($id)
    {
        $stagiaire = User::where('role', 'stagiaire')->findOrFail($id);
        $services = Service::all();
        return view('admin.stagiaires.edit', compact('stagiaire', 'services'));
    }

    public function update(Request $request, $id)
    {
        $stagiaire = User::where('role', 'stagiaire')->findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $stagiaire->id,
            'service_id' => 'nullable|exists:services,id',
        ]);

        $stagiaire->update([
            'name'       => $request->name,
            'email'      => $request->email,
            'service_id' => $request->service_id,
        ]);

        return redirect()->route('admin.stagiaires.index')->with('success', 'Stagiaire mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $stagiaire = User::where('role', 'stagiaire')->findOrFail($id);
        $stagiaire->delete();

        return redirect()->route('admin.stagiaires.index')->with('success', 'Stagiaire supprimé avec succès.');
    }
}
