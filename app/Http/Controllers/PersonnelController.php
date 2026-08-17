<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\DataFeed;
use App\Models\Corps;
use App\Models\Compte;
use App\Models\Etablissement;
use App\Models\Fonctionnaire;
use App\Models\Fonction;
use App\Models\Service;
use App\Models\Grade;
use App\Models\Categoriefonctionnaire;
use Illuminate\Support\Facades\DB;

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
            ->join('corps', 'Fonctions.id_corps', '=', 'corps.Id_Corps')
            ->paginate(15);



        return view('pages/personel/personel', compact('dataFeed', 'Fonctionnaires', 'Corps'));
    }




    // ----------------------------------------------------------------------------------------------recuperer tout les fonctionaire

    public function liste(Request $request)
    {
        // Récupérer toutes les CORPS
        //$categories = Categorie::all();
        $corps = Corps::all();
        $comptes = Compte::all();
        $services = Service::all();
        $grades = Grade::all();
        $fonctions = Fonction::all();
        $etablisssemnts = Etablissement::all();
        $categoriefonctionnaires = Categoriefonctionnaire::all();

        // Récupérer l'identifiant de la catégorie actuelle, par défaut la première catégorie
        //$activeCategoryId = $request->query('category', $categories->first()->id);
        $activeCorpId = $request->query('corp', $corps->first()->Id_Corps);

        // Charger les personnels pour la catégorie active avec pagination
        // $personnels = Personnel::where('categorie_id', $activeCategoryId)->paginate(10);
        $Fonctionnaires = Fonctionnaire::with('media')
            ->join('Fonctions', 'Fonctions.id_Fonction', '=', 'Fonctionnaires.id_fonction')
            ->join('corps', 'Fonctions.id_corps', '=', 'corps.Id_Corps')
            ->where('corps.Id_Corps', $activeCorpId)
            ->select('Fonctionnaires.*') // important pour éviter les conflits de colonnes
            ->get();

        return view('pages/personel/personel', compact(
            'corps',
            'comptes',
            'Fonctionnaires',
            'activeCorpId',
            'services',
            'grades',
            'fonctions',
            'etablisssemnts',
            'categoriefonctionnaires'

        ));
    }




    // ----------------------------------------------------------------------------------------------recuperer le fonctionaire par son id
    public function show($id_fonctionaire)
    {
        // Récupérer toutes les CORPS

        $corps = Corps::all();
        $etablisssemnts = Etablissement::all();

        //// Récupérer l'identifiant de fonctionnaire selectionée

        //$activeCategoryId = $request->query('category', $categories->first()->id);
        //$activeCorpId = $request->query('corp', $corps->first()->id_corps);

        // Charger les personnels pour la catégorie active avec pagination
        // $personnels = Personnel::where('categorie_id', $activeCategoryId)->paginate(10);
        $Fonctionnaire = Fonctionnaire::join('fonctions', 'fonctions.id_Fonction', '=', 'fonctionnaires.id_fonction')
            ->join('corps', 'fonctions.id_corps', '=', 'corps.Id_Corps')
            ->join('etablissements', 'etablissements.id_etablissement', '=', 'fonctionnaires.id_etablissement')
            ->where('fonctionnaires.id_fonctionnaire', $id_fonctionaire)
            ->get();


        return view('pages/personel/showFonctionaires', compact('Fonctionnaire'));
    }

    // ----------------------------------------------------------------------------------------------Modifier photo de fonctionaire
    public function updatePhoto(Request $request, $id)
    {
        $fonctionnaire = Fonctionnaire::findOrFail($id);

        if ($request->hasFile('photo')) {
            // Supprimer l’ancienne photo
            $fonctionnaire->clearMediaCollection('photo');

            // Ajouter la nouvelle
            $fonctionnaire->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        return back()->with('success', 'Photo mise à jour avec succès.');
    }
    // -------------------------------------------------store---------------------------------------------Ajout de fonctionaire
    // -------------------------------------------------store---------------------------------------------
    // Ajout de fonctionnaire
   // -------------------------------------------------store---------------------------------------------
// Ajout de fonctionnaire
public function store(Request $request)
{

    

   
    $validated = $request->validate([
        'nom_fonctionnaire'    => 'required|string|max:255',
        'prenom_fonctionnaire' => 'required|string|max:255',
        'dateNaissance'        => 'required|date',
        'dateRecrutement'      => 'required|date',
        'dateSortie'           => 'nullable|date|',
        'sexe'                 => 'required|in:M,F',
        'NSS'                  => 'nullable|digits:12|unique:fonctionnaires,n_ss',
        'NombreEnfants'        => 'nullable|integer|min:0',
        'Telephone'            => 'nullable|regex:/^0\d{9}$/',
        'id_echelon'           => 'required|numeric|min:0',

        'id_grade'             => 'nullable|integer|exists:grades,id_grade',
        'id_fonction'          => 'required|integer|exists:fonctions,id_fonction',
        'id_service'           => 'nullable|integer|exists:services,id_service',
        'id_categorie'         => 'required|integer|exists:categoriefonctionnaires,Id_CategorieFonctionnaire',
        'id_compte'            => 'nullable|integer|exists:comptes,Id_Compte',
        'id_etablissement'     => 'required|integer|exists:etablissements,id_etablissement',
    ]);
    

    $fonctionnaire = DB::transaction(function () use ($validated) {

        // Verrouille la table le temps de calculer le prochain id
        // (id_fonctionnaire n'a pas d'AUTO_INCREMENT en base)
        $nextId = DB::table('fonctionnaires')
            ->lockForUpdate()
            ->max('id_fonctionnaire');

        $nextId = $nextId ? ((int) $nextId) + 1 : 1;

        return Fonctionnaire::create([
            'id_fonctionnaire'           => $nextId,
            'nom_fonctionnaire'          => $validated['nom_fonctionnaire'],
            'prenom_fonctionnaire'       => $validated['prenom_fonctionnaire'],
            'date_naissance'             => $validated['dateNaissance'],
            'date_recretement'           => $validated['dateRecrutement'], // typo conservée (colonne existante)
            'date_sortie'                => $validated['dateSortie'] ?? null,
            'sexe'                       => $validated['sexe'],
            'n_ss'                       => $validated['NSS'],
            'nb_enfant'                  => $validated['NombreEnfants'] ?? 0,
            'telephone'                  => $validated['Telephone'],
            'id_grade'                   => $validated['id_grade'],
            'id_fonction'                => $validated['id_fonction'],
            'id_echelon'                 => $validated['id_echelon'],            
            'id_service'                 => $validated['id_service'] ?? null,
            'id_categoriefonctionnaire'  => $validated['id_categorie'],
            'id_compte'                  => $validated['id_compte'] ?? null,
            'id_etablissement'           => $validated['id_etablissement'],
        ]);
    });


        return redirect()
            ->route('fonctionaires')
            ->with('message', 'Fonctionnaire ajouté avec succès.');
    }
    // ----------------------------------------------------------------------------------------------SUPPRESSION de fonctionaire
    public function deleteFonctionaie($id_fonctionnaire)
    {
        // Récupérer l'employé
        $employee = Fonctionnaire::findOrFail($id_fonctionnaire);
        // Supprimer le fonctionaire


        if (!$employee) {
            return response()->json(['message' => 'Média non trouvé'], 404);
        }
        $employee->delete();

        // suppimer tout les medea de fonctionaire l'media

        // recuperer les medea de fonctionaire
        $media = $employee->getMedia();
        // verefier si l'media existe
        if (!$media) {
            return response()->json(['message' => 'Média non trouvé'], 404);
        }
        //       // Supprimer tout les  médias

        $employee->clearMediaCollection();
        return redirect()->route('fonctionaires')->with('message', 'Suppression réussie!');

        //return response()->json(['message' => 'Média supprimé avec succès']);



    }
    // ----------------------------------------------------------------------------------------------uploadFile de fonctionaire



    public function uploadFile(Request $request, $id_fonctionnaire)
    {


        $Fonctionnaire = Fonctionnaire::join('Fonctions', 'Fonctions.id_Fonction', '=', 'Fonctionnaires.id_fonction')
            ->join('corps', 'Fonctions.id_corps', '=', 'corps.Id_Corps')
            ->where('Fonctionnaires.id_fonctionnaire', $id_fonctionnaire)
            ->get();
        $employee = Fonctionnaire::find($id_fonctionnaire);


        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,pdf|max:10240',  // Exemple de validation
            'file-colllectios' => 'required|string|in:Decision_échelon,photo,Decision_promotion,Pévé,Doosier_initial',  // Exemple de validation
        ]);

        $fileCollection = $request->input('file-colllectios');
        $dateDefie = $request->input('dateDefie');
        $NumDocs = $request->input('NumDocs');
        //nommer le file selon la collection et numeros
        $NomFile = $fileCollection . '-' . $dateDefie . '-' . $NumDocs . '.pdf';

        $media = $employee->addMedia($request->file('file'))
            ->toMediaCollection($fileCollection);
        // Ajouter des propriétés personnalisées
        $media->setCustomProperty('datedifie', $dateDefie);
        $media->setCustomProperty('NumDocs', $NumDocs);
        // Mettre à jour les colonnes directement
        $media->dateDefie = $dateDefie;
        $media->NumDocs = $NumDocs;
        $media->name = $NomFile;


        // Sauvegarder les propriétés dans la base de données
        $media->save();

        // Renommer le fichier dans la bibliothèque
        // $media->copy($media->getPath(), $media->getDirectoryPath() . '/' . $newFileName);

        $mediaGroupedByCollection = $employee->media->groupBy('collection_name');


        return redirect()->route('fonctionaires.show', ['id_fonctionaire' => $id_fonctionnaire])->with('message', 'Enregistrement réussi!');


        // return response()->json(['message' => 'File uploaded successfully']);
        // return view('pages/personel/showFonctionaires', compact('Fonctionnaire'));


    }
    // ----------------------------------------------------------------------------------------------Stream pdf


    public function streamFile($id, $filename)
    {
        $path = storage_path('app/public/' . $id . '/' . $filename);
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
    // ----------------------------------------------------------------------------------------------SUPPRESSION de fichier
    public function deleteMedia($id_fonctionnaire, $id_media)
    {
        // Récupérer l'employé
        $employee = Fonctionnaire::findOrFail($id_fonctionnaire);
        // Récupérer l'media
        $media = $employee->media()->find($id_media);
        // verefier si l'media existe

        if (!$media) {
            return response()->json(['message' => 'Média non trouvé'], 404);
        }

        // Supprimer le média

        $media->delete();
        return redirect()->route('fonctionaires.show', ['id_fonctionaire' => $id_fonctionnaire])->with('message', 'Suppression réussie!');

        //return response()->json(['message' => 'Média supprimé avec succès']);



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
    // ----------------------------------------------------------------------------------------------Show ou afficher un fichier de fonctionaire

    public function showFile($urlFile)
    {

        $urlFile = $urlFile;
        return view('pages/personel/showFile', compact('urlFile'));
    }
}
