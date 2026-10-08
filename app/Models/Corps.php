<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corps extends Model
{
    use HasFactory;

    protected $table = 'corps';

    protected $primaryKey = 'Id_Corps';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'Id_Corps',
        'Nom_Corps',
    ];

    public function fonctions()
    {
        return $this->hasMany(
            Fonction::class,
            'id_corps',
            'Id_Corps'
        );
    }

    public function fonctionnaires()
    {
        return $this->hasManyThrough(
            Fonctionnaire::class,
            Fonction::class,
            'id_corps',
            'id_fonction',
            'Id_Corps',
            'id_fonction'
        );
    }
}
