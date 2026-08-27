<?php

namespace App\Http\Controllers;

use App\Models\Fonction;   //
use App\Models\Corps;      //

use Illuminate\Http\Request;

class FonctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 // -------------------------------------------------index---------------------------------------------
    public function index()
    {
        $fonctions = Fonction::with('corps')->get();
        $corps = Corps::all(); // adapte au vrai nom du modèle Corps

        return view('pages.fonction.fonctions', compact('fonctions', 'corps'));
    }

    // -------------------------------------------------store---------------------------------------------
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_fonction'      => 'required|string|max:255',
            'code_fonction'     => 'required|string|max:50|unique:fonctions,code_fonction',
            'section'           => 'nullable|string|max:255',
            'niveau'            => 'nullable|integer|min:0',
            'taux_prime'        => 'nullable|numeric|min:0',
            'valeur_indiciere'  => 'nullable|numeric|min:0',
            'id_corps'          => 'required|integer|exists:corps,id_corps',
        ]);

        Fonction::create($validated);

        return redirect()->route('fonctions')->with('message', 'Fonction ajoutée avec succès.');
    }

    // -------------------------------------------------edit---------------------------------------------
    public function edit($id_fonction)
    {
        $fonction = Fonction::findOrFail($id_fonction);

        $corps = Corps::all();

        return view('pages.fonction.Modefier_Fonction', compact('fonction', 'corps'));
    }

    // -------------------------------------------------update---------------------------------------------
    public function update(Request $request, $id_fonction)
    {
        $fonction = Fonction::findOrFail($id_fonction);

        $validated = $request->validate([
            'nom_fonction'      => 'required|string|max:255',
            'code_fonction'     => 'required|string|max:50|unique:fonctions,code_fonction,' . $id_fonction . ',id_fonction',
            'section'           => 'nullable|string|max:255',
            'niveau'            => 'nullable|integer|min:0',
            'taux_prime'        => 'nullable|numeric|min:0',
            'valeur_indiciere'  => 'nullable|numeric|min:0',
            'id_corps'          => 'required|integer|exists:corps,id_corps',
        ]);

        $fonction->update($validated);

        return redirect()->route('fonctions')->with('message', 'Fonction modifiée avec succès.');
    }

    // -------------------------------------------------destroy---------------------------------------------
    public function destroy($id_fonction)
    {
        $fonction = Fonction::findOrFail($id_fonction);
        $fonction->delete();

        return redirect()->route('fonctions')->with('message', 'Fonction supprimée avec succès.');
    }
}
