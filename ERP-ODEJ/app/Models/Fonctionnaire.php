<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;



class Fonctionnaire extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $primaryKey = 'id_fonctionnaire';
    public function fonction()
    {
        return $this->belongsTo(Fonction::class, 'id_fonction');
    }
}


