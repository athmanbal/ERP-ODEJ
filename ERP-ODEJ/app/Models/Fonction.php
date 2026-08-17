<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    use HasFactory;
    public function corps()
    {
        return $this->belongsTo(Corps::class, 'id_corps');
    }
}
