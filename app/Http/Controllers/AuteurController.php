<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuteurRequest;
use App\Http\Resources\AuteurResource;
use App\Models\Auteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AuteurController extends Controller
{

    // Code TD3 Partie 5

    public function index()
    {
        $auteurs = Cache::remember('auteurs.liste', 600, function () {
            return Auteur::all();
        });
        return response()->json(['data' => $auteurs], 200);
    }


    // public function show($id)
    // {
    //     $auteur = Auteur::find($id);
    //     if (!$auteur) {
    //         return response()->json(
    //             ['message' => 'Auteur introuvable .'],
    //             404
    //         );
    //     }
    //     return response()->json(['data' => $auteur], 200);
    // }

    public function show($id)
    {
        $auteur = Auteur::find($id);
        if (!$auteur) {
            return response()->json(
                ['message' => 'Auteur introuvable .'],
                404
            );
        }
        return new AuteurResource($auteur);
    }

    public function store(StoreAuteurRequest $request)
    {
        $auteur = Auteur::create($request->validated());
        Cache::forget('auteur.liste');
        return response()->json(['data' => $auteur], 201);
    }


    public function update(StoreAuteurRequest $request, $id)
    {
        $auteur = Auteur::find($id);
        if (!$auteur) {
            return response()->json(
                ['message' => 'Auteur introuvable .'],
                404
            );
        }
        $auteur->update($request->validated());
        return response()->json(['data' => $auteur], 200);
    }

    public function destroy($id)
    {
        $auteur = Auteur::find($id);
        if (!$auteur) {
            return response()->json(
                ['message' => 'Auteur introuvable .'],
                404
            );
        }
        $auteur->delete();
        return response()->json(null, 204);
    }
}
