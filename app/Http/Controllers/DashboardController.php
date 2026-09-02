<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataFeed;
use App\Models\Corps;
use App\Models\Fonctionnaire;
use App\Models\Fonction;
use App\Models\Grade;
use App\Models\Etablissement;

class DashboardController extends Controller
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


//==========================================================================================
  // -----------------------------------------------------------------
        // Fonctionnaires actifs = ceux sans date de sortie (toujours en poste)
        // -----------------------------------------------------------------
        $totalFonctionnaires = Fonctionnaire::whereNull('date_sortie')->count();

        // Nouveaux recrutements ce mois-ci (date_recretement dans le mois en cours)
     /*   $nouveauxCeMois = Fonctionnaire::whereNull('date_sortie')
            ->whereMonth('date_recretement', Carbon::now()->month)
            ->whereYear('date_recretement', Carbon::now()->year)
            ->count();*/

        // -----------------------------------------------------------------
        // Grades / Fonctions / Établissements — comptages simples
        // -----------------------------------------------------------------
        $totalGrades         = Grade::count();
        $totalFonctions      = Fonction::count();
        $totalEtablissements = Etablissement::count();

        // -----------------------------------------------------------------
        // Postes vacants : ⚠️ hypothèse — à adapter selon ta vraie définition
        // Ici : une "fonction" est considérée occupée si au moins un
        // fonctionnaire actif l'exerce. Le nombre total de "postes" est
        // approximé par (nombre de fonctions × nombre d'établissements),
        // et les vacants sont ceux sans titulaire actif.
        // Si tu as une vraie table "postes" liant fonction+établissement,
        // remplace cette logique par un simple count() dessus.
        // -----------------------------------------------------------------
        $totalPostes = $totalFonctions * max($totalEtablissements, 1);

        $fonctionsOccupees = Fonctionnaire::whereNull('date_sortie')
            ->distinct()
            ->pluck('id_fonction');

        $postesVacants = Fonction::whereNotIn('id_fonction', $fonctionsOccupees)->count();

        // Liste des postes vacants prioritaires (limité à 5 pour l'affichage)
        $postesVacantsListe = Fonction::with('corps') // adapte si tu as une relation etablissement
            ->whereNotIn('id_fonction', $fonctionsOccupees)
            ->limit(5)
            ->get()
            ->map(function ($fonction) {
                return (object) [
                    'nom_fonction'      => $fonction->nom_fonction,
                    'nom_etablissement' => $fonction->corps->nom_corps ?? 'Non défini',
                ];
            });

        // -----------------------------------------------------------------
        // Répartition des fonctionnaires actifs par établissement (pour le graphique)
        // -----------------------------------------------------------------
        $repartition = Fonctionnaire::whereNull('date_sortie')
            ->selectRaw('id_etablissement, count(*) as total')
            ->groupBy('id_etablissement')
            ->get();

        $etablissements = Etablissement::whereIn(
            'id_etablissement',
            $repartition->pluck('id_etablissement')
        )->pluck('nom_etablissement', 'id_etablissement');

        $etablissementsLabels = $repartition->map(function ($item) use ($etablissements) {
            return $etablissements[$item->id_etablissement] ?? 'Non renseigné';
        })->values();

        $etablissementsData = $repartition->pluck('total')->values();

        // -----------------------------------------------------------------

//==========================================================================================




        return view('pages/dashboard/dashboard', compact(
            'dataFeed',
            'Fonctionnaires',
            'Corps',
            'totalFonctionnaires',

            'totalGrades',
            'totalFonctions',
            'totalEtablissements',
            'totalPostes',
            'postesVacants',
            'postesVacantsListe',
            'etablissementsLabels',
            'etablissementsData'));
    }

    /**
     * Displays the analytics screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function analytics()
    {
        return view('pages/dashboard/analytics');
    }

    /**
     * Displays the fintech screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fintech()
    {
        return view('pages/dashboard/fintech');
    }
}
