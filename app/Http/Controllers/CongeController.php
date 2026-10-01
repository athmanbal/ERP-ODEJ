<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\Fonctionnaire;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CongeController extends Controller
{
    /**
     * Écran 1 : Tableau de bord — solde annuel + statistiques.
     */
    public function dashboard()
    {
        $anneeActuelle = now()->year;

        $fonctionnaires = $this->fonctionnairesAvecSolde($anneeActuelle);

        $stats = [
            'en_attente' => Conge::where('statut', 'en_attente')->count(),
            'en_conge_aujourdhui' => Conge::approuves()
                ->whereDate('date_depart', '<=', now())
                ->whereDate('date_retour', '>=', now())
                ->count(),
            'jours_pris_annee' => (int) Conge::approuves()->annee($anneeActuelle)->sum('nombre_jours'),
            'par_type' => Conge::approuves()->annee($anneeActuelle)
                ->selectRaw('type_conge, SUM(nombre_jours) as total')
                ->groupBy('type_conge')
                ->pluck('total', 'type_conge'),
        ];

        return view('pages.conges.dashboard', compact('fonctionnaires', 'stats'));
    }

    /**
     * Écran 2 : Nouveau congé (traitement du formulaire modal, appelable depuis n'importe quel écran).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_fonctionnaire' => 'required|exists:Fonctionnaires,id_fonctionnaire',
            'type_conge' => 'required|in:annuel,maladie,exceptionnel,maternite,sans_solde',
            'date_depart' => 'required|date',
            'date_retour' => 'required|date|after_or_equal:date_depart',
            'motif' => 'nullable|string|max:255',
        ]);

        if ($validated['type_conge'] === 'annuel') {
            $fonctionnaire = Fonctionnaire::findOrFail($validated['id_fonctionnaire']);

            $joursDemandes = Carbon::parse($validated['date_depart'])
                ->diffInDaysFiltered(
                    fn ($d) => !$d->isWeekend(),
                    Carbon::parse($validated['date_retour'])->addDay()
                );

            if ($joursDemandes > $fonctionnaire->soldeConge()) {
                return back()
                    ->withErrors(['date_retour' => 'Solde de congé annuel insuffisant (' . $fonctionnaire->soldeConge() . ' jours restants).'])
                    ->withInput();
            }
        }

        Conge::create($validated);

        return back()->with('success', 'Congé enregistré avec succès.');
    }

    /**
     * Écran 3 : Historique — tous les congés d'un fonctionnaire.
     */
    public function historique($id_fonctionnaire = null)
    {
        $fonctionnaires = Fonctionnaire::select('id_fonctionnaire', 'nom_fonctionnaire', 'prenom_fonctionnaire')
            ->orderBy('nom_fonctionnaire')
            ->get();

        $conges = collect();
        if ($id_fonctionnaire) {
            $conges = Conge::where('id_fonctionnaire', $id_fonctionnaire)
                ->orderByDesc('date_depart')
                ->get();
        }

        return view('pages.conges.historique', compact('fonctionnaires', 'conges', 'id_fonctionnaire'));
    }

    /**
     * Écran 4 : Calendrier — visualisation annuelle des congés.
     */
    public function calendrier()
    {
        $fonctionnaires = Fonctionnaire::select('id_fonctionnaire', 'nom_fonctionnaire', 'prenom_fonctionnaire')
            ->orderBy('nom_fonctionnaire')
            ->get();

        return view('pages.conges.calendrier', compact('fonctionnaires'));
    }

    /**
     * Source de données JSON pour le calendrier (FullCalendar).
     */
    public function events(Request $request)
    {
        $conges = Conge::with('fonctionnaire')
            ->when($request->fonctionnaire, fn ($q) => $q->where('id_fonctionnaire', $request->fonctionnaire))
            ->get();

        $couleurs = [
            'annuel' => '#3788d8',
            'maladie' => '#e74c3c',
            'exceptionnel' => '#f39c12',
            'maternite' => '#9b59b6',
            'sans_solde' => '#7f8c8d',
        ];

        $events = $conges->map(fn ($conge) => [
            'id' => $conge->id_conge,
            'title' => $conge->fonctionnaire->nom_fonctionnaire . ' ' . $conge->fonctionnaire->prenom_fonctionnaire,
            'start' => $conge->date_depart->format('Y-m-d'),
            'end' => $conge->date_retour->copy()->addDay()->format('Y-m-d'), // FullCalendar exclut la date de fin
            'color' => $couleurs[$conge->type_conge] ?? '#3788d8',
            'extendedProps' => [
                'type' => $conge->type_conge,
                'statut' => $conge->statut,
            ],
        ]);

        return response()->json($events);
    }

    public function updateStatut(Request $request, Conge $conge)
    {
        $request->validate(['statut' => 'required|in:en_attente,approuve,refuse']);
        $conge->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut mis à jour.');
    }

    public function destroy(Conge $conge)
    {
        $conge->delete();

        return back()->with('success', 'Congé supprimé.');
    }

    /**
     * Solde calculé à la volée pour chaque fonctionnaire — jamais stocké en base.
     */
    private function fonctionnairesAvecSolde(int $annee)
    {
        return Fonctionnaire::select('id_fonctionnaire', 'nom_fonctionnaire', 'prenom_fonctionnaire')
            ->orderBy('nom_fonctionnaire')
            ->get()
            ->map(function ($f) use ($annee) {
                $f->solde = $f->soldeConge($annee);
                return $f;
            });
    }
}
