<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Contenu;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    public function index($id)
    {
        $contenu = Contenu::find($id);
        if (!$contenu) {
            return response()->json(
                ['message' => 'Contenu introuvable.'],
                404
            );
        }

        $commentaires = Commentaire::where("contenu_id", $id)->get();
        return response()->json(['data' => $commentaires], 200);
    }
}
