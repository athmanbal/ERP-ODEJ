<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // 👉 Nom de la table
    protected $table = 'services';

    // 👉 Nom de la clé primaire
    protected $primaryKey = 'id_service';

    // 👉 Si ta clé n’est pas auto-incrémentée, ajoute : public $incrementing = false;
    public $incrementing = true;

    // 👉 Si ta clé n’est pas de type integer (par ex UUID) : protected $keyType = 'string';
    protected $keyType = 'int';

    // 👉 Colonnes que tu autorises en insertion
    protected $fillable = [
        'nom_service',
        'code_service',
    ];

    // 👉 Si tu n’utilises pas created_at / updated_at
    public $timestamps = false;
}
