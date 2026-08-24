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
use Illuminate\Validation\Rule;


use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Mpdf;

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
        $comptes = Compte::all();
        $services = Service::all();
        $grades = Grade::all();
        $fonctions = Fonction::all();
        $etablisssemnts = Etablissement::all();
        $categoriefonctionnaires = Categoriefonctionnaire::all();

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


        return view('pages/personel/showFonctionaires', compact(
                        'corps',
                        'comptes',
                        'Fonctionnaire',
                        'services',
                        'grades',
                        'fonctions',
                        'etablisssemnts',
                        'categoriefonctionnaires'
            ));
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
    // -------------------------------------------------update---------------------------------------------
// Modification de fonctionnaire
public function update(Request $request, $id_fonctionnaire)
{
    $employee = Fonctionnaire::findOrFail($id_fonctionnaire);

    $request->merge([
        'id_service' => $request->id_service ?: null,
        'id_compte'  => $request->id_compte ?: null,
        'dateSortie' => $request->dateSortie ?: null,
    ]);

    $validated = $request->validate([
        'nom_fonctionnaire'    => 'required|string|max:255',
        'prenom_fonctionnaire' => 'required|string|max:255',
        'dateNaissance'        => 'required|date',
        'dateRecrutement'      => 'required|date',
        'dateSortie'           => 'nullable|date|after_or_equal:dateRecrutement',
        'sexe'                 => 'required|in:M,F',
        'NSS'                  => 'nullable|digits:11|unique:fonctionnaires,n_ss,' . $id_fonctionnaire . ',id_fonctionnaire',
        'NombreEnfants'        => 'nullable|integer|min:0',
        'Telephone'            => 'nullable|regex:/^0\d{9}$/',

        'id_grade'             => 'nullable|integer|exists:grades,id_grade',
        'id_fonction'          => 'required|integer|exists:fonctions,id_fonction',
        'id_service'           => 'nullable|integer|exists:services,id_service',
        'id_categorie'         => 'required|integer|exists:categoriefonctionnaires,Id_CategorieFonctionnaire',
        'id_compte'            => 'nullable|integer|exists:comptes,Id_Compte',
        'id_etablissement'     => 'required|integer|exists:etablissements,id_etablissement',
        'id_echelon'           => 'nullable|integer|min:0',
    ]);

    $employee->update([
        'nom_fonctionnaire'          => $validated['nom_fonctionnaire'],
        'prenom_fonctionnaire'       => $validated['prenom_fonctionnaire'],
        'date_naissance'             => $validated['dateNaissance'],
        'date_recretement'           => $validated['dateRecrutement'],
        'date_sortie'                => $validated['dateSortie'] ?? null,
        'sexe'                       => $validated['sexe'],
        'n_ss'                       => $validated['NSS'] ?? null,
        'nb_enfant'                  => $validated['NombreEnfants'] ?? 0,
        'telephone'                  => $validated['Telephone'] ?? null,
        'id_grade'                   => $validated['id_grade'] ?? null,
        'id_fonction'                => $validated['id_fonction'],
        'id_service'                 => $validated['id_service'] ?? null,
        'id_categoriefonctionnaire'  => $validated['id_categorie'],
        'id_compte'                  => $validated['id_compte'] ?? null,
        'id_etablissement'           => $validated['id_etablissement'],
        'id_echelon'                 => $validated['id_echelon'] ?? null,
    ]);

    return redirect()
        ->back()
        ->with('message', 'Fonctionnaire modifié avec succès.');

        /*
       return view('pages/personel/showFonctionaires', compact(
                        'corps',
            'comptes',
            'Fonctionnaire',
            'services',
            'grades',
            'fonctions',
            'etablisssemnts',
            'categoriefonctionnaires'
            ));

*/
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



 // ----------------------------------------------------------------------------------------------attestation de travail de fonctionaire


    public function genererAttestation($id_fonctionnaire)
    {
        $fonctionnaire = Fonctionnaire::with('fonction')->findOrFail($id_fonctionnaire);

        // Si mPDF est installé (recommandé pour un rendu RTL natif)
        if (class_exists(\Mpdf\Mpdf::class)) {
            $html = view('pages.personel.attestation', compact('fonctionnaire'))->render();

            $mpdf = new \Mpdf\Mpdf([
                'mode'                 => 'utf-8',
                'format'               => 'A4',
                'default_font'         => 'sans-serif',
                'margin_left'          => 10,
                'margin_right'         => 10,
                'margin_top'           => 10,
                'margin_bottom'        => 10,
                'autoScriptToLang'     => true,
                'autoLangToFont'       => true,
            ]);

            $mpdf->WriteHTML($html);
            $pdfContent = $mpdf->Output('', 'S');

            return response($pdfContent, 200, [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'inline; filename="attestation_' . $fonctionnaire->id_fonctionnaire . '.pdf"',
            ]);
        }

        // Pour DomPDF : Formater le HTML pour ligaturer les caractères arabes et inverser le sens
        $rawHtml = view('pages.personel.attestation', compact('fonctionnaire'))->render();
        $shapedHtml = $this->shapeArabicHtml($rawHtml);

        $pdf = Pdf::loadHTML($shapedHtml)
                  ->setPaper('a4', 'portrait')
                  ->setOption(['defaultFont' => 'DejaVu Sans', 'isHtml5ParserEnabled' => true]);

        return $pdf->stream('شهادة_عمل_' . $fonctionnaire->nom_fonctionnaire . '.pdf');
    }

    /**
     * Traite les noeuds textes d'un document HTML pour connecter les lettres arabes et les inverser pour DomPDF
     */
    private function shapeArabicHtml($html)
    {
        $parts = preg_split('/(<style\b[^>]*>.*?<\/style>)/is', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        $output = '';

        foreach ($parts as $part) {
            if (stripos($part, '<style') === 0) {
                $output .= $part;
            } else {
                $output .= preg_replace_callback('/>([^<]+)</u', function ($matches) {
                    $text = $matches[1];
                    $text = str_replace('&nbsp;', "\u{00A0}", $text);
                    $shaped = $this->shapeArabicString($text);
                    $shaped = str_replace("\u{00A0}", '&nbsp;', $shaped);
                    return '>' . $shaped . '<';
                }, $part);
            }
        }

        return $output;
    }

    private function shapeArabicString($text)
    {
        $lines = explode("\n", $text);
        $res = [];
        foreach ($lines as $line) {
            $res[] = $this->shapeArabicLine($line);
        }
        return implode("\n", $res);
    }

    private function shapeArabicLine($line)
    {
        if (!preg_match('/[\x{0600}-\x{06FF}]/u', $line)) {
            return $line;
        }

        preg_match_all('/[\x{0600}-\x{06FF}]+|[^\x{0600}-\x{06FF}\s]+|\s+|[^\s]/u', $line, $matches);
        $tokens = $matches[0] ?? [];
        if (empty($tokens)) return $line;

        $shapedTokens = [];
        foreach ($tokens as $token) {
            if (preg_match('/[\x{0600}-\x{06FF}]/u', $token)) {
                $shapedTokens[] = $this->shapeArabicWord($token);
            } else {
                $shapedTokens[] = $token;
            }
        }

        return implode('', array_reverse($shapedTokens));
    }

    private function shapeArabicWord($word)
    {
        static $glyphs = [
            0x0621 => [0xFE80, 0xFE80, 0xFE80, 0xFE80], // ء
            0x0622 => [0xFE81, 0xFE82, 0xFE81, 0xFE82], // آ
            0x0623 => [0xFE83, 0xFE84, 0xFE83, 0xFE84], // أ
            0x0624 => [0xFE85, 0xFE86, 0xFE85, 0xFE86], // ؤ
            0x0625 => [0xFE87, 0xFE88, 0xFE87, 0xFE88], // إ
            0x0626 => [0xFE89, 0xFE8A, 0xFE8B, 0xFE8C], // ئ
            0x0627 => [0xFE8D, 0xFE8E, 0xFE8D, 0xFE8E], // ا
            0x0628 => [0xFE8F, 0xFE90, 0xFE91, 0xFE92], // ب
            0x0629 => [0xFE93, 0xFE94, 0xFE93, 0xFE94], // ة
            0x062A => [0xFE95, 0xFE96, 0xFE97, 0xFE98], // ت
            0x062B => [0xFE99, 0xFE9A, 0xFE9B, 0xFE9C], // ث
            0x062C => [0xFE9D, 0xFE9E, 0xFE9F, 0xFEA0], // ج
            0x062D => [0xFEA1, 0xFEA2, 0xFEA3, 0xFEA4], // ح
            0x062E => [0xFEA5, 0xFEA6, 0xFEA7, 0xFEA8], // خ
            0x062F => [0xFEA9, 0xFEAA, 0xFEA9, 0xFEAA], // د
            0x0630 => [0xFEAB, 0xFEAC, 0xFEAB, 0xFEAC], // ذ
            0x0631 => [0xFEAD, 0xFEAE, 0xFEAD, 0xFEAE], // ر
            0x0632 => [0xFEAF, 0xFEB0, 0xFEAF, 0xFEB0], // ز
            0x0633 => [0xFEB1, 0xFEB2, 0xFEB3, 0xFEB4], // س
            0x0634 => [0xFEB5, 0xFEB6, 0xFEB7, 0xFEB8], // ش
            0x0635 => [0xFEB9, 0xFEBA, 0xFEBB, 0xFEBC], // ص
            0x0636 => [0xFEBD, 0xFEBE, 0xFEBF, 0xFEC0], // ض
            0x0637 => [0xFEC1, 0xFEC2, 0xFEC3, 0xFEC4], // ط
            0x0638 => [0xFEC5, 0xFEC6, 0xFEC7, 0xFEC8], // ظ
            0x0639 => [0xFEC9, 0xFECA, 0xFECB, 0xFECC], // ع
            0x063A => [0xFECD, 0xFECE, 0xFECF, 0xFED0], // غ
            0x0640 => [0x0640, 0x0640, 0x0640, 0x0640], // ـ
            0x0641 => [0xFED1, 0xFED2, 0xFED3, 0xFED4], // ف
            0x0642 => [0xFED5, 0xFED6, 0xFED7, 0xFED8], // ق
            0x0643 => [0xFED9, 0xFEDA, 0xFEDB, 0xFEDC], // ك
            0x0644 => [0xFEDD, 0xFEDE, 0xFEDF, 0xFEE0], // ل
            0x0645 => [0xFEE1, 0xFEE2, 0xFEE3, 0xFEE4], // م
            0x0646 => [0xFEE5, 0xFEE6, 0xFEE7, 0xFEE8], // ن
            0x0647 => [0xFEE9, 0xFEEA, 0xFEEB, 0xFEEC], // ه
            0x0648 => [0xFEED, 0xFEEE, 0xFEED, 0xFEEE], // و
            0x0649 => [0xFEEF, 0xFEF0, 0xFBE8, 0xFBE9], // ى
            0x064A => [0xFEF1, 0xFEF2, 0xFEF3, 0xFEF4], // ي
        ];

        static $noConnectForward = [
            0x0621, 0x0622, 0x0623, 0x0624, 0x0625, 0x0627,
            0x0629, 0x062F, 0x0630, 0x0631, 0x0632, 0x0648,
            0x0649, 0xFE80, 0xFE81, 0xFE82, 0xFE83, 0xFE84,
            0xFE85, 0xFE86, 0xFE87, 0xFE88, 0xFE8D, 0xFE8E,
            0xFE93, 0xFE94, 0xFEA9, 0xFEAA, 0xFEAB, 0xFEAC,
            0xFEAD, 0xFEAE, 0xFEAF, 0xFEB0, 0xFEED, 0xFEEE,
            0xFEEF, 0xFEF0, 0xFEF5, 0xFEF6, 0xFEF7, 0xFEF8,
            0xFEF9, 0xFEFA, 0xFEFB, 0xFEFC
        ];

        $chars = mb_str_split($word);
        $codes = array_map(function ($c) {
            return mb_ord($c, 'UTF-8');
        }, $chars);

        // 1. Traiter les ligatures Lam-Alef (لا, لأ, لإ, لآ)
        $ligatured = [];
        $count = count($codes);
        for ($i = 0; $i < $count; $i++) {
            $c = $codes[$i];
            $next = ($i + 1 < $count) ? $codes[$i + 1] : null;

            if ($c === 0x0644 && $next !== null) {
                $prev = ($i > 0) ? $codes[$i - 1] : null;
                $prevConnects = ($prev !== null && $this->isArabicCode($prev) && !in_array($prev, $noConnectForward));

                if ($next === 0x0622) { // لآ
                    $ligatured[] = $prevConnects ? 0xFEF6 : 0xFEF5;
                    $i++;
                    continue;
                } elseif ($next === 0x0623) { // لأ
                    $ligatured[] = $prevConnects ? 0xFEF8 : 0xFEF7;
                    $i++;
                    continue;
                } elseif ($next === 0x0625) { // لإ
                    $ligatured[] = $prevConnects ? 0xFEFA : 0xFEF9;
                    $i++;
                    continue;
                } elseif ($next === 0x0627) { // لا
                    $ligatured[] = $prevConnects ? 0xFEFC : 0xFEFB;
                    $i++;
                    continue;
                }
            }
            $ligatured[] = $c;
        }

        // 2. Déterminer la forme de chaque glyphe (Isolée, Initiale, Médiane, Finale)
        $shaped = [];
        $lCount = count($ligatured);
        for ($i = 0; $i < $lCount; $i++) {
            $c = $ligatured[$i];
            if (!isset($glyphs[$c])) {
                $shaped[] = $c;
                continue;
            }

            $prev = ($i > 0) ? $ligatured[$i - 1] : null;
            $next = ($i + 1 < $lCount) ? $ligatured[$i + 1] : null;

            $connectPrev = ($prev !== null && $this->isArabicCode($prev) && !in_array($prev, $noConnectForward));
            $connectNext = ($next !== null && $this->isArabicCode($next) && isset($glyphs[$next]));

            if ($connectPrev && $connectNext) {
                $shaped[] = $glyphs[$c][3]; // Médiane
            } elseif ($connectPrev) {
                $shaped[] = $glyphs[$c][1]; // Finale
            } elseif ($connectNext) {
                $shaped[] = $glyphs[$c][2]; // Initiale
            } else {
                $shaped[] = $glyphs[$c][0]; // Isolée
            }
        }

        // 3. Reconstituer la chaîne et inverser l'ordre des caractères pour le moteur LTR de DomPDF
        $shapedChars = array_map(function ($code) {
            return mb_chr($code, 'UTF-8');
        }, $shaped);

        return implode('', array_reverse($shapedChars));
    }

    private function isArabicCode($code)
    {
        return ($code >= 0x0600 && $code <= 0x06FF) ||
               ($code >= 0xFB50 && $code <= 0xFDFF) ||
               ($code >= 0xFE70 && $code <= 0xFEFF);
    }



    // ----------------------------------------------------------------------------------------------uploadFile de fonctionaire



    public function uploadFile(Request $request, $id_fonctionnaire)
    {


        $Fonctionnaire = Fonctionnaire::join('Fonctions', 'Fonctions.id_Fonction', '=', 'Fonctionnaires.id_fonction')
            ->join('corps', 'Fonctions.id_corps', '=', 'corps.Id_Corps')
            ->where('Fonctionnaires.id_fonctionnaire', $id_fonctionnaire)
            ->get();
        $employee = Fonctionnaire::find($id_fonctionnaire);




        $validated = $request->validate([
    'file-colllectios' => [
        'required',
        Rule::in([
            'photo',
            'Doosier_initial',
            'Decision_promotion--  مقررات الترقية ',
            'Decision_échelon--  مقررات ترقية في الدرجة',
            "Pévé d'instalation محضر التعيين",
            'مقرر التنصيب',
            'مقرر الادماج',
            'Decision_مقرر تعيين في منصب عالي',
            'Decision_قرار التحويل',
            'Decision_مقرر الوكيل الداخيل',
            'Decision_تثمين الخبرة',
            'Decision_Maladies-- العطل المرضية',
            'Pévé',
        ]),
    ],
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
