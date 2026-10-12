<?php

use App\Http\Controllers\AuteurController;
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
Route::get('/auteurs', [AuteurController::class, 'index']);
Route::get('/auteurs/{id}', [AuteurController::class, 'show']);
Route::post('/auteurs', [AuteurController::class, 'store']);
Route::put('/auteurs/{id}', [AuteurController::class, 'update']);
Route::delete('/auteurs/{id}', [AuteurController::class, 'destroy']);
