<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataFeed;
use App\Models\Corps;
use App\Models\Fonctionnaire;
use App\Models\Fonction;

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
     
       

        return view('pages/dashboard/dashboard', compact('dataFeed','Fonctionnaires','Corps'));
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
