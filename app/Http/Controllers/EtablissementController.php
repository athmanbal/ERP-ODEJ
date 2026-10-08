<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use Illuminate\Http\Request;

class EtablissementController extends Controller
{
    // -------------------------------------------------index---------------------------------------------
    public function index()
    {
        $etablissements = Etablissement::withCount('fonctionnaires')->get();

        return view('pages.etablissement.etablissements', compact('etablissements'));
    }

    // -------------------------------------------------store---------------------------------------------
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_etablissement'     => 'required|string|max:255|unique:etablissements,nom_etablissement',
            'address_etablissement' => 'nullable|string|max:255',
            'type_etablissement'    => 'nullable|string|max:100',
            'telFax_etablissement'  => 'nullable|string|max:30',
            'mail_etablissement'    => 'nullable|email|max:255',
        ]);

        Etablissement::create($validated);

        return redirect()->route('etablissements')->with('message', 'Établissement ajouté avec succès.');
    }

    // -------------------------------------------------edit---------------------------------------------
    public function edit($id_etablissement)
    {
        $etablissement = Etablissement::findOrFail($id_etablissement);

        return view('pages.etablissement.editEtablissement', compact('etablissement'));
    }

    // -------------------------------------------------update---------------------------------------------
    public function update(Request $request, $id_etablissement)
    {
        $etablissement = Etablissement::findOrFail($id_etablissement);

        $validated = $request->validate([
            'nom_etablissement'     => 'required|string|max:255|unique:etablissements,nom_etablissement,' . $id_etablissement . ',id_etablissement',
            'address_etablissement' => 'nullable|string|max:255',
            'type_etablissement'    => 'nullable|string|max:100',
            'telFax_etablissement'  => 'nullable|string|max:30',
            'mail_etablissement'    => 'nullable|email|max:255',
        ]);

        $etablissement->update($validated);

        return redirect()->route('etablissements')->with('message', 'Établissement modifié avec succès.');
    }

    // -------------------------------------------------destroy---------------------------------------------
    public function destroy($id_etablissement)
    {
        $etablissement = Etablissement::withCount('fonctionnaires')->findOrFail($id_etablissement);

        // Protection : on ne supprime pas un établissement qui a encore des fonctionnaires rattachés
        if ($etablissement->fonctionnaires_count > 0) {
            return redirect()->route('etablissements')
                ->withErrors(['message' => "Suppression impossible : {$etablissement->fonctionnaires_count} fonctionnaire(s) sont rattachés à cet établissement."]);
        }

        $etablissement->delete();

        return redirect()->route('etablissements')->with('message', 'Établissement supprimé avec succès.');
    }
}
