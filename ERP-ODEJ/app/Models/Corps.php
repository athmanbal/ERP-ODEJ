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

    // Indiquer explicitement le nom de la table associée
    protected $table = 'corps';

    // Définir les attributs pouvant être remplis en masse (mass-assignment)
    protected $fillable = ['Nom_Corp'];

    // Si vous souhaitez que l'ID ne soit pas auto-incrémenté, ou que vous spécifiiez un autre nom pour la clé primaire
    protected $primaryKey = 'Id_Corps';

    // Si la table ne possède pas les colonnes 'created_at' et 'updated_at', vous pouvez les désactiver :
    public $timestamps = true;  // C'est true par défaut, donc vous n'avez pas besoin de le spécifier sauf si vous voulez le contrôler.
}

