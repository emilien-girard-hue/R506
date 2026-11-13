<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $fillable = ['nom_auteur', 'texte'];
    use HasFactory;
    public function contenu()
    {
        return $this->belongsTo(Contenu::class);
    }
}
