<?php

use App\Models\Etudiant;
use App\Models\Carte;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\AnneeAcademiqueController;
use App\Http\Controllers\ParametreController;

/*
|--------------------------------------------------------------------------
| Routes Web
|--------------------------------------------------------------------------

| Routes organisées pour l'administration et l'accès public
|
*/

    // ================= ÉTUDIANTS =================
Route::prefix('etudiants')->name('etudiants.')->group(function () {
    Route::get('/', [EtudiantController::class, 'index'])->name('index');

    // PAGE FORMULAIRE → GET
  Route::get('/creer', [EtudiantController::class, 'create'])->name('inscrire');

    // ENREGISTREMENT → POST
   Route::post('/enregistrer', [EtudiantController::class, 'store'])->name('enregistrer');

    Route::get('/{etudiant}/modifier', [EtudiantController::class, 'edit'])->name('modifier');
    Route::get('/{etudiant}/afficher', [EtudiantController::class, 'afficher'])->name('afficher');
    Route::put('/{etudiant}', [EtudiantController::class, 'update'])->name('mettre_a_jour');
    Route::delete('/{etudiant}', [EtudiantController::class, 'destroy'])->name('supprimer');
});

// Page d'accueil (publique)
Route::get('/', function () {
    return view('welcome');
});

// ================= AUTHENTIFICATION =================
Route::get('/login', [ConnexionController::class, 'login'])->name('login');
Route::post('/login', [ConnexionController::class, 'traitement_login']);
Route::post('/deconnexion', [ConnexionController::class, 'logout'])->name('deconnexion');

// ================= UTILISATEURS =================
Route::prefix('users')->name('users.')->group(function () {

    // Routes publiques pour créer un administrateur
    Route::get('/creer', [UserController::class, 'create'])->name('creer');
    Route::post('/enregistrer', [UserController::class, 'store'])->name('enregistrer');

    // Routes protégées par authentification
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{utilisateur}/modifier', [UserController::class, 'edit'])->name('modifier');
        Route::put('/{utilisateur}', [UserController::class, 'update'])->name('mettre_a_jour');
        Route::delete('/{utilisateur}', [UserController::class, 'destroy'])->name('supprimer');
    });
});

// ================= ROUTES PROTÉGÉES =================
Route::middleware(['auth'])->group(function () {

    // Dashboard
  Route::get('/accueil', function () {
    $totalEtudiants = Etudiant::count(); // On récupère le nombre total
    return view('dashboard', compact('totalEtudiants'));
})->name('dashboard');

    // ================= PARAMÈTRES =================
    Route::prefix('parametres')->name('parametres.')->group(function () {

        // Page principale paramètres
        Route::get('/', [ParametreController::class, 'index'])->name('index');

        // Durée de validité
        Route::post('/duree', [ParametreController::class, 'updateDuree'])
            ->name('duree.mettre_a_jour');

        // ================= FILIÈRES =================
        Route::prefix('filieres')->name('filieres.')->group(function () {
            Route::post('/', [FiliereController::class, 'store'])->name('enregistrer');
            Route::put('/{filiere}', [FiliereController::class, 'update'])->name('mettre_a_jour');
            Route::delete('/{filiere}', [FiliereController::class, 'destroy'])->name('supprimer');
        });

        // ================= NIVEAUX =================
        Route::prefix('niveaux')->name('niveaux.')->group(function () {
            Route::post('/', [NiveauController::class, 'store'])->name('enregistrer');
            Route::put('/{niveau}', [NiveauController::class, 'update'])->name('mettre_a_jour');
            Route::delete('/{niveau}', [NiveauController::class, 'destroy'])->name('supprimer');
        });

        // ================= ANNÉES ACADÉMIQUES =================
        Route::prefix('annees_academiques')->name('annees_academiques.')->group(function () {
            Route::post('/', [AnneeAcademiqueController::class, 'store'])->name('enregistrer');
            Route::put('/{anneeAcademique}', [AnneeAcademiqueController::class, 'update'])->name('mettre_a_jour');
            Route::delete('/{anneeAcademique}', [AnneeAcademiqueController::class, 'destroy'])->name('supprimer');
        });
    });


    // ================= CARTES =================
    Route::prefix('cartes')->name('cartes.')->group(function () {
        Route::get('/', [CarteController::class, 'index'])->name('index');
        Route::get('/{carte}/modifier', [CarteController::class, 'edit'])->name('modifier');
        Route::put('/{carte}', [CarteController::class, 'update'])->name('mettre_a_jour');
    });

    // ================= CARTES & HISTORIQUE DES CARTES =================
    Route::get('/historique-cartes', [HistoriqueController::class, 'index'])->name('historique_cartes.index');
});

// ================= ROUTE PUBLIQUE =================
Route::get('/etudiants/carte/{token}', [EtudiantController::class, 'carte'])
    ->name('etudiants.carte');
