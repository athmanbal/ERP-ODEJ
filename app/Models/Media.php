<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media as SpatieMedia;
class Media extends SpatieMedia
{
    use HasFactory;
    protected $fillable = [
        'dateDefie', // Ajoutez la nouvelle colonne dateDefie
        'NumDocs',   // Ajoutez la nouvelle colonne NumDocs
    ];
}
