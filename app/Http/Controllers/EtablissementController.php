<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use Illuminate\Http\Request;

class EtablissementController extends Controller
{
    public function index()
    {
        $etablissements = Etablissement::all();
        return view('etablissements.index', compact('etablissements'));
    }

    public function create()
    {
        return view('etablissements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nom_etablissement' => 'required|string|max:255',
            'address_etablissement' => 'nullable|string',
            'telFax_etablissement' => 'nullable|string',
            'mail_etablissement' => 'nullable|email',
        ]);

        Etablissement::create($request->all());

        return redirect()->route('etablissements.index')
                         ->with('success', 'Établissement créé avec succès.');
    }

    public function show(Etablissement $etablissement)
    {
        return view('etablissements.show', compact('etablissement'));
    }

    public function edit(Etablissement $etablissement)
    {
        return view('etablissements.edit', compact('etablissement'));
    }

    public function update(Request $request, Etablissement $etablissement)
    {
        $request->validate([
            'Nom_etablissement' => 'required|string|max:255',
            'address_etablissement' => 'nullable|string',
            'telFax_etablissement' => 'nullable|string',
            'mail_etablissement' => 'nullable|email',
        ]);

        $etablissement->update($request->all());

        return redirect()->route('etablissements.index')
                         ->with('success', 'Établissement mis à jour.');
    }

    public function destroy(Etablissement $etablissement)
    {
        $etablissement->delete();
        return redirect()->route('etablissements.index')
                         ->with('success', 'Établissement supprimé.');
    }
}
