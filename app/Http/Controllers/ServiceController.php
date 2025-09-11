<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    /**
     * Liste des services (pagination pour gros volume)
     */
    public function index()
    {
        $services = Service::with(['division','responsable'])->orderBy('nom_service')->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    /**
     * Formulaire création
     */
    public function create()
    {
        $divisions = Division::orderBy('nom_division')->get();
        // Responsables disponibles (scope responsables ou filtre role)
        $responsables = User::where('role','responsable')->orderBy('nom')->orderBy('prenom')->get();

        return view('admin.services.create', compact('divisions','responsables'));
    }

    /**
     * Enregistrement
     */
    public function store(Request $request)
    {
        $responsableIds = User::where('role','responsable')->pluck('id')->toArray();

        $data = $request->validate([
            'nom_service'   => [
                'required','string','max:255',
                Rule::unique('services')->where(fn($q) => 
                    $q->where('division_id', $request->division_id)
                )
            ],
            'division_id'   => ['required','exists:divisions,id'],
            'responsable_id'=> ['nullable','integer', Rule::in($responsableIds)],
        ]);


        Service::create($data);

        return redirect()->route('admin.services.index')->with('ok','Service créé.');
    }

    /**
     * Formulaire edition
     */
    public function edit(Service $service)
    {
        $divisions = Division::orderBy('nom_division')->get();
        $responsables = User::where('role','responsable')->orderBy('nom')->orderBy('prenom')->get();

        return view('admin.services.edit', compact('service','divisions','responsables'));
    }

    /**
     * Mise à jour
     */
    public function update(Request $request, Service $service)
    {
        $responsableIds = User::where('role','responsable')->pluck('id')->toArray();

        $data = $request->validate([
            'nom_service'   => [
                'required','string','max:255',
                Rule::unique('services')
                    ->where(fn($q) => $q->where('division_id', $request->division_id))
                    ->ignore($service->id),
            ],
            'division_id'   => ['required','exists:divisions,id'],
            'responsable_id'=> ['nullable','integer', Rule::in($responsableIds)],
        ]);


        $service->update($data);

        return redirect()->route('admin.services.index')->with('ok','Service mis à jour.');
    }

    /**
     * Suppression
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('ok','Service supprimé.');
    }

    /**
     * Optionnel : JSON pour lister les services d'une division (utile côté stagiaire)
     * Route recommandée (si tu veux) : 
     * Route::get('/admin/services/by-division/{division}', [ServiceController::class,'byDivision'])->name('services.byDivision');
     */
    public function byDivision(Division $division)
    {
        return response()->json(
            $division->services()->select('id','nom_service')->orderBy('nom_service')->get()
        );
    }
}