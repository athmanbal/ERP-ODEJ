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

    protected $table = 'fonctionnaires';

    protected $primaryKey = 'id_fonctionnaire';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = [
        'id_fonctionnaire',
        'nom_fonctionnaire',
        'prenom_fonctionnaire',
        'matricule_fonctionnaire',
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
        'id_etablissement',
        'lieu_naissance',
        'telephone',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_recretement' => 'date',
        'date_sortie' => 'date',
    ];

    // =========================
    // RELATIONS
    // =========================

public function fonction()
{
    return $this->belongsTo(
        Fonction::class,
        'id_fonction',
        'id_fonction'
    );
}


public function grade()
{
    return $this->belongsTo(
        Grade::class,
        'id_grade',
        'id_grade'
    );
}

public function service()
{
    return $this->belongsTo(
        Service::class,
        'id_service',
        'id_service'
    );
}

public function etablissement()
{
    return $this->belongsTo(
        Etablissement::class,
        'id_etablissement',
        'id_etablissement'
    );
}

public function categorieFonctionnaire()
{
    return $this->belongsTo(
        Categoriefonctionnaire::class,
        'id_categoriefonctionnaire',
        'Id_CategorieFonctionnaire'
    );
}

public function compte()
{
    return $this->belongsTo(
        Compte::class,
        'id_compte',
        'Id_Compte'
    );
}

public function conges()
{
    return $this->hasMany(
        Conge::class,
        'id_fonctionnaire',
        'id_fonctionnaire'
    );
}

 // =========================
    // SOLDE CONGE
    // =========================

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
