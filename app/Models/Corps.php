<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corps extends Model
{
    use HasFactory;

    public function fonctions()
    {
        return $this->hasMany(Fonction::class, 'id_corps');
    }

    public function fonctionnaires()
    {
        return $this->hasManyThrough(
            Fonctionnaire::class,
            Fonction::class,
            'id_corps',      // clé étrangère sur Fonctions (pointe vers corps)
            'id_fonction',   // clé étrangère sur Fonctionnaires (pointe vers Fonctions)
            'Id_Corps',      // clé locale sur corps
            'id_Fonction'    // clé locale sur Fonctions
        );
    }

    // Indiquer explicitement le nom de la table associée
    protected $table = 'corps';

    // Définir les attributs pouvant être remplis en masse (mass-assignment)
    protected $fillable = ['Nom_Corp'];

    // Si vous souhaitez que l'ID ne soit pas auto-incrémenté, ou que vous spécifiiez un autre nom pour la clé primaire
    protected $primaryKey = 'Id_Corps';

    // Si la table ne possède pas les colonnes 'created_at' et 'updated_at', vous pouvez les désactiver :
    public $timestamps = true;
}
