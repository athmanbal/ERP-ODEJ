<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    // -------------------------------------------------index---------------------------------------------
    public function index()
    {
        $grades = Grade::all();

        return view('pages.grade.grades', compact('grades'));
    }

    // -------------------------------------------------store---------------------------------------------
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_grade'    => 'required|string|max:50|unique:grades,code_grade',
            'nom_grade'     => 'required|string|max:255',
            'bonification'  => 'nullable|numeric|min:0',
        ]);

        Grade::create($validated);

        return redirect()->route('grades')->with('message', 'Grade ajouté avec succès.');
    }

    // -------------------------------------------------edit---------------------------------------------
    public function edit($id_grade)
    {
        $grade = Grade::findOrFail($id_grade);

        return view('pages.grade.Modefier_Grade', compact('grade'));
    }

    // -------------------------------------------------update---------------------------------------------
    public function update(Request $request, $id_grade)
    {
        $grade = Grade::findOrFail($id_grade);

        $validated = $request->validate([
            'code_grade'    => 'required|string|max:50|unique:grades,code_grade,' . $id_grade . ',id_grade',
            'nom_grade'     => 'required|string|max:255',
            'bonification'  => 'nullable|numeric|min:0',
        ]);

        $grade->update($validated);

        return redirect()->route('grades')->with('message', 'Grade modifié avec succès.');
    }

    // -------------------------------------------------destroy---------------------------------------------
    public function destroy($id_grade)
    {
        $grade = Grade::findOrFail($id_grade);
        $grade->delete();

        return redirect()->route('grades')->with('message', 'Grade supprimé avec succès.');
    }
}
