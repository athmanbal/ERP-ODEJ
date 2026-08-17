<?php


namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Fonctionnaire;

use Livewire\WithPagination;






 // Assure-toi d'utiliser le modèle approprié


class SearchTable extends Component
{
    use WithPagination;

    public $search = ''; // Variable pour stocker la recherche

    protected $queryString = ['search']; // Pour maintenir la recherche dans l'URL

    public function updatingSearch()
    {
        $this->resetPage(); // Réinitialiser la pagination en cas de recherche
    }

    public function render()
    {
        // Rechercher dans la base de données les résultats correspondant à la recherche
        $fonctionaires = Fonctionnaire::where('onglet1', 'like', '%' . $this->search . '%')
                                ->orWhere('onglet2', 'like', '%' . $this->search . '%')
                                ->paginate(10);

        return view('livewire.search-table', [
            'categories' => $fonctionaires,
        ]);
    }
}