<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $table = 'grades'; // nom de la table
    protected $primaryKey = 'id_grade'; // clé primaire

    protected $fillable = [
        'code_grade',
        'nom_grade',
        'bonification'
    ];

    public $timestamps = false; // si pas de created_at et updated_at
}
