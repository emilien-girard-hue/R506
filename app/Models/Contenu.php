<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenu extends Model
{
    protected $fillable = ['titre', 'categorie', 'description', 'auteur_id'];
    use HasFactory;
    public function auteur()
    {
        return $this->belongsTo(Auteur::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Categorie::class);
    }

    public function commentaire()
    {
        return $this->hasMany(Commentaire::class);
    }
}
