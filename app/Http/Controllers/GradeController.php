<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Affiche la liste des grades.
     */
    public function index()
    {
        $grades = Grade::all();
        return view('grades.index', compact('grades'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        return view('grades.create');
    }

    /**
     * Enregistre un nouveau grade.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_grade' => 'required|unique:grades,code_grade',
            'nom_grade' => 'required|string|max:150',
            'bonification' => 'nullable|integer'
        ]);

        Grade::create($request->all());

        return redirect()->route('grades.index')->with('success', 'Grade ajouté avec succès');
    }

    /**
     * Affiche un grade spécifique.
     */
    public function show(Grade $grade)
    {
        return view('grades.show', compact('grade'));
    }

    /**
     * Affiche le formulaire d’édition.
     */
    public function edit(Grade $grade)
    {
        return view('grades.edit', compact('grade'));
    }

    /**
     * Met à jour un grade.
     */
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'code_grade' => 'required|unique:grades,code_grade,' . $grade->id_grade . ',id_grade',
            'nom_grade' => 'required|string|max:150',
            'bonification' => 'nullable|integer'
        ]);

        $grad
