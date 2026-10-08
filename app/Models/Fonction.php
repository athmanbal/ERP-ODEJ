<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    use HasFactory;

    protected $table = 'fonctions';

    protected $primaryKey = 'id_fonction';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = [
        'section',
        'taux_prime',
        'nom_fonction',
        'code_fonction',
        'niveau',
        'valeur_indiciere',
        'id_corps',
    ];

    public $timestamps = false;

    public function corps()
    {
        return $this->belongsTo(
            Corps::class,
            'id_corps',
            'id_corps'
        );
    }
}
