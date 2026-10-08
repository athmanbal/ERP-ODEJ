<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoriefonctionnaire extends Model
{
    use HasFactory;

    protected $table = 'categoriefonctionnaires';

    protected $primaryKey = 'Id_CategorieFonctionnaire';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = true;

    protected $fillable = [
        'Nom_CategorieFonctionnaire',
        'Display',
    ];
}
