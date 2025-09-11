<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminResponsableController extends Controller
{
    public function index()
    {
        $responsables = User::with('service') // charge la relation service
            ->where('role', 'responsable')
            ->paginate(15);

        return view('admin.responsables.index', compact('responsables'));
    }

    public function create()
    {
        $services = Service::orderBy('nom_service')->get();
        return view('admin.responsables.create', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'       => 'required|string|max:255',
            'prenom'    => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6|confirmed',
            'service_id'=> 'nullable|exists:services,id',
            'poste'      => 'nullable|string|max:255',
            'specialite' => 'nullable|string|max:255',
        ]);

        $data['role'] = 'responsable';
        $data['password'] = Hash::make($data['password']);

        $responsable = User::create($data);

        // lier au service si choisi
        if (!empty($data['service_id'])) {
            $service = Service::find($data['service_id']);
            $service->update(['responsable_id' => $responsable->id]);
        }

        return redirect()->route('admin.responsables.index')->with('ok', 'Responsable créé.');
    }

    public function edit(User $responsable)
    {
        $services = Service::orderBy('nom_service')->get();
        return view('admin.responsables.edit', compact('responsable', 'services'));
    }

    public function update(Request $request, User $responsable)
    {
        $data = $request->validate([
            'nom'       => 'required|string|max:255',
            'prenom'    => 'required|string|max:255',
            'email'     => ['required','email', Rule::unique('users')->ignore($responsable->id)],
            'password'  => 'nullable|string|min:6|confirmed',
            'service_id'=> 'nullable|exists:services,id',
            'poste'      => 'nullable|string|max:255',
            'specialite' => 'nullable|string|max:255',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $responsable->update($data);

        // mettre à jour son service
        $currentService = Service::where('responsable_id', $responsable->id)->first();

        if ($currentService && $currentService->id != $request->service_id) {
            $currentService->update(['responsable_id' => null]);
        }

        if (!empty($data['service_id'])) {
            $service = Service::find($data['service_id']);
            $service->update(['responsable_id' => $responsable->id]);
    }


        return redirect()->route('admin.responsables.index')->with('ok', 'Responsable mis à jour.');
    }

    public function destroy(User $responsable)
    {
        // libérer le service lié
        Service::where('responsable_id', $responsable->id)->update(['responsable_id' => null]);
        $responsable->delete();

        return back()->with('ok', 'Responsable supprimé.');
    }
}
