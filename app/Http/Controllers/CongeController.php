<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\Fonctionnaire;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\GenerePdfArabe;

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
            'lieu_conge' => 'nullable|string|max:255',
            'motif' => 'nullable|string|max:255',
        ]);

        if ($validated['type_conge'] === 'annuel') {
            $fonctionnaire = Fonctionnaire::findOrFail($validated['id_fonctionnaire']);

            $joursDemandes = Carbon::parse($validated['date_depart'])
                ->diffInDaysFiltered(
                    fn($d) => !$d->isWeekend(),
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
            ->when($request->fonctionnaire, fn($q) => $q->where('id_fonctionnaire', $request->fonctionnaire))
            ->get();

        $couleurs = [
            'annuel' => '#3788d8',
            'maladie' => '#e74c3c',
            'exceptionnel' => '#f39c12',
            'maternite' => '#9b59b6',
            'sans_solde' => '#7f8c8d',
        ];

        $events = $conges->map(fn($conge) => [
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




// generer le pdf du titre de congé en arabe
    use GenerePdfArabe;

    public function imprimer($id_conge)
    {
        $conge = Conge::with('fonctionnaire.fonction')->findOrFail($id_conge);

        if ($conge->statut !== 'approuve') {
            abort(403, 'Seul un congé approuvé peut être imprimé.');
        }

        return $this->genererPdfArabe(
            'pages.conges.pdf.titre-conge',
            compact('conge'),
            'titre_conge_' . $conge->fonctionnaire->nom_fonctionnaire . '_' . $conge->id_conge
        );
    }





    // ----------------------------------------------------------------------------------------------attestation de travail de fonctionaire


    // Remplace l'ancienne méthode genererAttestation() par celle-ci :
    public function genererAttestation($id_fonctionnaire)
    {
        $fonctionnaire = Fonctionnaire::with('fonction')->findOrFail($id_fonctionnaire);

        return $this->genererPdfArabe(
            'pages.conges.pdf.titre-conge',
            compact('fonctionnaire'),
            'attestation_' . $fonctionnaire->id_fonctionnaire
        );
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
            0x0621,
            0x0622,
            0x0623,
            0x0624,
            0x0625,
            0x0627,
            0x0629,
            0x062F,
            0x0630,
            0x0631,
            0x0632,
            0x0648,
            0x0649,
            0xFE80,
            0xFE81,
            0xFE82,
            0xFE83,
            0xFE84,
            0xFE85,
            0xFE86,
            0xFE87,
            0xFE88,
            0xFE8D,
            0xFE8E,
            0xFE93,
            0xFE94,
            0xFEA9,
            0xFEAA,
            0xFEAB,
            0xFEAC,
            0xFEAD,
            0xFEAE,
            0xFEAF,
            0xFEB0,
            0xFEED,
            0xFEEE,
            0xFEEF,
            0xFEF0,
            0xFEF5,
            0xFEF6,
            0xFEF7,
            0xFEF8,
            0xFEF9,
            0xFEFA,
            0xFEFB,
            0xFEFC
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




}
