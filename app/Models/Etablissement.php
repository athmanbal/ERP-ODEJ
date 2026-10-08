<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    use HasFactory;

    protected $table = 'etablissements';
    protected $primaryKey = 'id_etablissement';

    protected $fillable = [
        'nom_etablissement',
        'address_etablissement',
        'type_etablissement',

        'telFax_etablissement',
        'mail_etablissement'
    ];

      // 👇 Relation à ajouter
    public function fonctionnaires()
    {
        return $this->hasMany(Fonctionnaire::class, 'id_etablissement', 'id_etablissement');
    }
}
