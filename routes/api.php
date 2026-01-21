<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\ParametreController;

//Routes des API


//ADMINISTRATEURS
Route::get('/administrateurs', [AdministrateurController::class, 'index']);
Route::post('/administrateurs', [AdministrateurController::class, 'store']);
Route::get('/administrateurs/{administrateur}', [AdministrateurController::class, 'show']);
Route::put('/administrateurs/{administrateur}', [AdministrateurController::class, 'update']);
Route::delete('/administrateurs/{administrateur}', [AdministrateurController::class, 'destroy']);
Route::put(
    '/administrateurs/{administrateur}/reinitialiser-mot-de-passe',
    [AdministrateurController::class, 'reinitialiserMotDePasse']
);

//FILIERES
Route::get('/filieres', [FiliereController::class, 'index']);
Route::post('/filieres', [FiliereController::class, 'store']);
Route::put('/filieres/{filiere}', [FiliereController::class, 'update']);
Route::delete('/filieres/{filiere}', [FiliereController::class, 'destroy']);

//NIVEAUX
Route::get('/niveaux', [NiveauController::class, 'index']);
Route::post('/niveaux', [NiveauController::class, 'store']);
Route::put('/niveaux/{niveau}', [NiveauController::class, 'update']);
Route::delete('/niveaux/{niveau}', [NiveauController::class, 'destroy']);

//ETUDIANTS
Route::get('/etudiants', [EtudiantController::class, 'index']);
Route::post('/etudiants', [EtudiantController::class, 'store']);
Route::get('/etudiants/{etudiant}', [EtudiantController::class, 'show']);
Route::put('/etudiants/{etudiant}', [EtudiantController::class, 'update']);
Route::delete('/etudiants/{etudiant}', [EtudiantController::class, 'destroy']);

//CARTES
Route::get('/cartes', [CarteController::class, 'index']);
Route::post('/cartes', [CarteController::class, 'store']);
Route::put('/cartes/{carte}/activer', [CarteController::class, 'activer']);
Route::put('/cartes/{carte}/suspendre', [CarteController::class, 'suspendre']);
Route::put('/cartes/{carte}/expirer', [CarteController::class, 'expirer']);
Route::delete('/cartes/{carte}', [CarteController::class, 'destroy']);

//HISTORIQUES
Route::get('/historiques', [HistoriqueController::class, 'index']);
Route::post('/historiques', [HistoriqueController::class, 'store']);
Route::get('/historiques/{historique}', [HistoriqueController::class, 'show']);
Route::delete('/historiques/{historique}', [HistoriqueController::class, 'destroy']);

//PARAMETRES 
Route::get('/parametres', [ParametreController::class, 'index']);
Route::post('/parametres', [ParametreController::class, 'store']);
Route::get('/parametres/{parametre}', [ParametreController::class, 'show']);
Route::put('/parametres/{parametre}', [ParametreController::class, 'update']);
Route::delete('/parametres/{parametre}', [ParametreController::class, 'destroy']);
