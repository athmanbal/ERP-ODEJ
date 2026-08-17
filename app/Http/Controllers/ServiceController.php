<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Afficher la liste des services
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Afficher le formulaire d'ajout
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Enregistrer un nouveau service
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Service::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('services.index')->with('success', 'Service ajouté avec succès');
    }

    /**
     * Afficher un service (facultatif si tu veux)
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Formulaire de modification
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Mettre à jour un service
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $service->update([
            'nom' => $request->nom,
        ]);

        return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès');
    }

    /**
     * Supprimer un service
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service supprimé avec succès');
    }
}
