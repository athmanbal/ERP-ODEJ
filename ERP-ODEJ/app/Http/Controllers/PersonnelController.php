<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\DataFeed;
use App\Models\Corps;
use App\Models\Fonctionnaire;
use App\Models\Fonction;

class PersonnelController extends Controller
{
    public function index()
    {
        $dataFeed = new DataFeed();
        $Fonctionnaires = Fonctionnaire::paginate(15);
        $Corps = Corps::all();
        $fonctions = Fonction::all();

        //$fonctionaires = Fonctionnaire::with(['fonction.corps'])->get();
        $Fonctionnaires = Fonctionnaire::join('Fonctions', 'Fonctions.id_Fonction', '=', 'Fonctionnaires.id_fonction')
            ->join('corps', 'Fonctions.id_corps', '=', 'corps.id_corps')
            ->paginate(15);



        return view('pages/personel/personel', compact('dataFeed', 'Fonctionnaires', 'Corps'));
    }




    // ----------------------------------------------------------------------------------------------recuperer tout les fonctionaire 

    public function liste(Request $request)
    {
        // Récupérer toutes les CORPS
        //$categories = Categorie::all();
        $corps = Corps::all();

        // Récupérer l'identifiant de la catégorie actuelle, par défaut la première catégorie
        //$activeCategoryId = $request->query('category', $categories->first()->id);
        $activeCorpId = $request->query('corp', $corps->first()->id_corps);

        // Charger les personnels pour la catégorie active avec pagination
        // $personnels = Personnel::where('categorie_id', $activeCategoryId)->paginate(10);
        $Fonctionnaires = Fonctionnaire::join('Fonctions', 'Fonctions.id_Fonction', '=', 'Fonctionnaires.id_fonction')
            ->join('corps', 'Fonctions.id_corps', '=', 'corps.id_corps')
            ->where('corps.id_corps', $activeCorpId)
            ->get();

        return view('pages/personel/personel', compact('corps', 'Fonctionnaires', 'activeCorpId'));
    }




    // ----------------------------------------------------------------------------------------------recuperer le fonctionaire par son id
    public function show($id_fonctionaire)
    {
        // Récupérer toutes les CORPS

        $corps = Corps::all();

        //// Récupérer l'identifiant de fonctionnaire selectionée

        //$activeCategoryId = $request->query('category', $categories->first()->id);
        //$activeCorpId = $request->query('corp', $corps->first()->id_corps);

        // Charger les personnels pour la catégorie active avec pagination
        // $personnels = Personnel::where('categorie_id', $activeCategoryId)->paginate(10);
        $Fonctionnaire = Fonctionnaire::join('Fonctions', 'Fonctions.id_Fonction', '=', 'Fonctionnaires.id_fonction')
            ->join('corps', 'Fonctions.id_corps', '=', 'corps.id_corps')
            ->where('Fonctionnaires.id_fonctionnaire', $id_fonctionaire)
            ->get();

        return view('pages/personel/showFonctionaires', compact('Fonctionnaire'));
    }


    // ----------------------------------------------------------------------------------------------uploadFile de fonctionaire



    public function uploadFile(Request $request, $id_fonctionnaire)
    {

        $Fonctionnaire = Fonctionnaire::join('Fonctions', 'Fonctions.id_Fonction', '=', 'Fonctionnaires.id_fonction')
            ->join('corps', 'Fonctions.id_corps', '=', 'corps.id_corps')
            ->where('Fonctionnaires.id_fonctionnaire', $id_fonctionnaire)
            ->get();
        $employee = Fonctionnaire::find($id_fonctionnaire);


        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,pdf|max:10240',  // Exemple de validation 
            'file-colllectios' => 'required|string|in:decision,peve,Dossier_Recrutement',  // Exemple de validation
        ]);
        $fileCollection = $request->input('file-colllectios');
        $employee->addMedia($request->file('file'))
            ->toMediaCollection($fileCollection);



        $mediaGroupedByCollection = $employee->media->groupBy('collection_name');




        // return response()->json(['message' => 'File uploaded successfully']);
        return view('pages/personel/showFonctionaires', compact('Fonctionnaire', 'employee', 'mediaGroupedByCollection'));



        
    }
    // ----------------------------------------------------------------------------------------------Stream pdf


    public function streamFile($id,$filename)
    {  
        $path = storage_path('app/public/'.$id .'/'. $filename);
    //dd( $path);
        // Vérifier si le fichier existe
        if (!file_exists($path)) {
            abort(404, 'Le fichier PDF n\'a pas été trouvé.');
        }
    
        // Ouvrir le fichier en mode lecture
        $file = fopen($path, 'rb');
    
        // Retourner une réponse stream avec le fichier
        return response()->stream(function () use ($file) {
            // Lire et envoyer le fichier par morceaux
            while (!feof($file)) {
                echo fread($file, 1024);
            }
            fclose($file);
        }, 200, [
            "Content-Type" => "application/pdf",
            "Content-Disposition" => "inline; filename=" . basename($path), // 'inline' pour afficher dans le navigateur
        ]);
    }
    // ----------------------------------------------------------------------------------------------Listes des File de fonctionaire


    public function listFiles($id_fonctionnaire)
    {
        $employee = Fonctionnaire::findOrFail($id_fonctionnaire);

        $files = $employee->getMedia('documents');

        return response()->json($files);
    }

    // ----------------------------------------------------------------------------------------------Telecharger ou afficher un fichier de fonctionaire


    public function downloadFile($id_fonctionnaire, $mediaId)
    {
        $employee = Fonctionnaire::findOrFail($id_fonctionnaire);

        $file = $employee->getMedia('documents')->where('id', $mediaId)->first();

        if ($file) {
            return response()->download($file->getPath(), $file->file_name);
        }

        return response()->json(['message' => 'File not found'], 404);
    }
}
