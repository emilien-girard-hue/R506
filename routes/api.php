<?php

use App\Http\Controllers\AuteurController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\ContenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//                      CODE DU COURS :

// Route::get('/ping', function() {
// 	return response()->json(['message' => 'pong']) ;
// });

// Route::get('/contenus/{ id }', function($id) {
//     return response()->json(['id_demande' => $id ]) ;
// });

// Route::post('/contenus/', function(){
// 	$donnees = request()->all();
// 	return response()->json($donnees, 201);
// }) ;

// Route::get('/contenu', [ContenuController::class, 'index']);
// Route::get('/contenuStore', [ContenuController::class, 'store']);


//                      CODE DU TP2 :

// Route::get('/contenus', [ContenuController::class, 'index']);
// Route::get('/contenus/{id}', [ContenuController::class, 'show']);
// Route::post('/contenus', [ContenuController::class, 'store']);


//                      CODE DE L'EXO :
// Route::get('/auteurs', [ContenuController::class, 'index']);
// Route::get('/auteurs/{id}', [ContenuController::class, 'show']);
// Route::post('/auteurs', [ContenuController::class, 'store']);


//                      CODE TD3
// Route::get('/contenus', [ContenuController::class, 'index']);
// Route::get('/contenus/{id}', [ContenuController::class, 'show']);
// Route::post('/contenus', [ContenuController::class, 'store']);
// Route::put('/contenus/{id}', [ContenuController::class, 'update']);
// Route::delete('/contenus/{id}', [ContenuController::class, 'destroy']);


//                      CODE TD3 Partie 5
// Route::get('/auteurs', [AuteurController::class, 'index']);
// Route::get('/auteurs/{id}', [AuteurController::class, 'show']);
// Route::get('/auteurs/{id}', [AuteurController::class, 'show']);
// Route::post('/auteurs', [AuteurController::class, 'store']);
// Route::put('/auteurs/{id}', [AuteurController::class, 'update']);
// Route::delete('/auteurs/{id}', [AuteurController::class, 'destroy']);

// Route::get('/contenus', [ContenuController::class, 'index']);
// Route::get('/contenus/{id}', [ContenuController::class, 'show']);
// Route::get('/contenus/{id}/commentaires', [CommentaireController::class, 'index']);

// Route::get('/categories', [CategorieController::class, 'index']);
// Route::post('/categories', [CategorieController::class, 'store']);




Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});

// Routes publiques (lecture)
Route::get('/contenus', [ContenuController::class, 'index']);
Route::get('/contenus/{id}', [ContenuController::class, 'show']);
Route::get('/auteurs', [AuteurController::class, 'index']);
Route::get('/auteurs/{id}', [AuteurController::class, 'show']);
Route::get('/categories', [CategorieController::class, 'index']);
Route::get('/contenus/{id}/commentaires', [CommentaireController::class, 'index']);

// Routes protégées (écriture)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/contenus', [ContenuController::class, 'store']);
    Route::put('/contenus/{id}', [ContenuController::class, 'update']);
    Route::delete('/contenus/{id}', [ContenuController::class, 'destroy']);

    Route::post('/auteurs', [AuteurController::class, 'store']);
    Route::put('/auteurs/{id}', [AuteurController::class, 'update']);
    Route::delete('/auteurs/{id}', [AuteurController::class, 'destroy']);

    Route::post('/categories', [CategorieController::class, 'store']);


    Route::get("/me", [AuthController::class, 'index']);
    Route::get("/me/tokens", [AuthController::class, 'indexToken']);
    Route::put("/me/password", [AuthController::class, 'update']);
    Route::delete("/me/tokens/{id}", [AuthController::class, 'destroy']);
});

Route::get('/contenus-recherche', [ContenuController::class, 'rechercheVulnerable']);

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login');
