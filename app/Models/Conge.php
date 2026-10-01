<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Conge extends Model
{
    use HasFactory;

    protected $table = 'conges';
    protected $primaryKey = 'id_conge';

    protected $fillable = [
        'id_fonctionnaire',
        'type_conge',
        'date_depart',
        'date_retour',
        'nombre_jours',
        'motif',
        'statut',
    ];

    protected $casts = [
        'date_depart' => 'date',
        'date_retour' => 'date',
    ];

    public function fonctionnaire()
    {
        return $this->belongsTo(Fonctionnaire::class, 'id_fonctionnaire', 'id_fonctionnaire');
    }

    /**
     * Calcule automatiquement le nombre de jours ouvrés (hors week-end)
     * à chaque création/modification.
     */
    protected static function booted()
    {
        static::saving(function (Conge $conge) {
            if ($conge->date_depart && $conge->date_retour) {
                $conge->nombre_jours = Carbon::parse($conge->date_depart)
                    ->diffInDaysFiltered(
                        fn (Carbon $date) => !$date->isWeekend(),
                        Carbon::parse($conge->date_retour)->addDay()
                    );
            }
        });
    }

    public function scopeApprouves($query)
    {
        return $query->where('statut', 'approuve');
    }

    public function scopeAnnee($query, $annee)
    {
        return $query->whereYear('date_depart', $annee);
    }
}
