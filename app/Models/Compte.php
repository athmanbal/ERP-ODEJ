<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    protected $table = 'comptes'; // nom de la table

    protected $primaryKey = 'Id_Compte'; // clé primaire personnalisée

    public $timestamps = true; // passe à false si pas de created_at/updated_at

    protected $fillable = [
        'N_Compte',
        'Id_TypeCompte',
    ];
}
