<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    use HasFactory;

        protected $table = 'fonctions'; // table associée

    protected $primaryKey = 'Id_Fonction'; // clé primaire

    public $incrementing = true; // auto-incrémentation
    protected $keyType = 'int';

    protected $fillable = [
        'Section',
        'Taux_Prime',
        'Nom_Fonction',
        'Code_fonction',
        'Niveau',
        'valeur_Indiciere',
        'Id_Corps'
    ];
    public function corps()
    {
        return $this->belongsTo(Corps::class, 'id_corps');
    }
}
