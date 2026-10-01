<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;



class Fonctionnaire extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $primaryKey = 'id_fonctionnaire';
    protected $table = 'fonctionnaires'; // car ta table n'est pas au pluriel
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'nom_fonctionnaire',
        'prenom_fonctionnaire',
        'date_naissance',
        'date_recretement',
        'date_sortie',
        'sexe',
        'n_ss',
        'nb_enfant',
        'id_grade',
        'id_fonction',
        'id_echelon',
        'id_service',
        'id_categoriefonctionnaire',
        'id_compte',
        'lieu_naissance',
         // j’ai utilisé ce champ pour stocker l’établissement
        // ajoute ici d’autres colonnes que tu veux remplir via ton formulaire
        'id_fonctionnaire',
        'telephone',
        'id_etablissement',
    ];
protected $casts = [
    'date_naissance' => 'date',
    'date_recretement' => 'date',
    'date_sortie' => 'date',
];
    public function fonction()
    {
        return $this->belongsTo(Fonction::class, 'id_fonction');

    }

public function conges()
{
    return $this->hasMany(Conge::class, 'id_fonctionnaire', 'id_fonctionnaire');
}

/**
 * Solde de congé annuel restant pour une année donnée.
 * Ajuste $droitAnnuel selon la réglementation applicable (ex: 30 jours).
 */
public function soldeConge($annee = null)
{
    $annee = $annee ?? now()->year;
    $droitAnnuel = 30;

    $joursUtilises = $this->conges()
        ->approuves()
        ->annee($annee)
        ->where('type_conge', 'annuel')
        ->sum('nombre_jours');

    return max($droitAnnuel - $joursUtilises, 0);
}
}


