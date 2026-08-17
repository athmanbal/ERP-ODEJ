<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoriefonctionnaire extends Model
{
    protected $table = 'categoriefonctionnaires'; // nom de la table

    protected $primaryKey = 'Id_CategorieFonctionnaire'; // clé primaire personnalisée

    public $timestamps = true; // à mettre false si tu n’as pas created_at/updated_at

    protected $fillable = [
        'Nom_CategorieFonctionnaire',
        'Display',
    ];
}
