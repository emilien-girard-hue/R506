<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();
        $data = ["id" => $user->id, "name" => $user->name, "email" => $user->email];
        return response()->json($data);
    }

    public function indexToken(Request $request)
    {
        $array = $request->user()->tokens;
        $listToken = $array->map(function ($token) {
            return [
                "id" => $token->id,
                "name" => $token->name,
            ];
        });

        return response()->json($listToken);
    }

    public function update(Request $request)
    {
        $donnees = $request->validate([
            "mot_de_passe_actuel" => "required|string|min:8",
            "nouveau_mot_de_passe" => "required|string|min:8",
        ]);

        if ($donnees["mot_de_passe_actuel"] === $donnees["nouveau_mot_de_passe"]) {
            return response()->json(['message' => "Votre nouveau mot de passe ne modifie pas l'ancien."], 422);
        }
        $user = $request->user();
        if (!$user || !Hash::check($donnees["mot_de_passe_actuel"], $user->password)) {
            return response()->json(["message" => "Mot de passe actuel invalide."], 422);
        }

        $user->password = Hash::make($donnees["nouveau_mot_de_passe"]);
        $user->save();
        return response()->json(["messsage" => "Votre mot de passe à été modifié"], 201);
    }

    public function destroy(Request $request, int $id)
    {
        $request->user()->tokens->where("id", $id)->first()->delete();
        return response()->json(['message' => 'Deconnexion reussie.'], 200);
    }

    public function register(Request $request)
    {
        $donnees = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:8",
        ]);

        $user = User::create([
            "name" => $donnees["name"],
            "email" => $donnees["email"],
            "password" => Hash::make($donnees["password"]),
        ]);
        $token = $user->createToken("api-token")->plainTextToken;

        return response()->json(["data" => $user, "token" => $token], 201);
    }

    public function login(Request $request)
    {
        $donnees = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $donnees['email'])->first();

        if (!$user || !Hash::check($donnees['password'], $user->password)) {
            return response()->json(['message' => 'Identifiants invalides.'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['data' => $user, 'token' => $token], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Deconnexion reussie.'], 200);
    }
}
