<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContenuResource;
use App\Models\Categorie;
use App\Models\Commentaire;
use App\Models\Contenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CommentaireController extends Controller
{
    public function index($id)
    {
        $commentaires = Commentaire::where("contenu_id", $id);

        return ContenuResource::collection($commentaires->paginate(15));
    }
}
