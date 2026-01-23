<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\HistoriqueCarteController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\AnneeAcademiqueController;
use App\Http\Controllers\parametreController;

/*
|--------------------------------------------------------------------------
| Routes Web
|--------------------------------------------------------------------------
|
| Routes organisées pour l'administration et l'accès public
|
*/

// Page d'accueil (publique)
Route::get('/', function () {
    return view('welcome');
});

// ================= AUTHENTIFICATION =================
Route::get('/login', [ConnexionController::class, 'login'])->name('login');
Route::post('/login', [ConnexionController::class, 'traitement_login']);
Route::post('/deconnexion', [ConnexionController::class, 'logout'])->name('deconnexion');

// ================= ROUTES PROTÉGÉES =================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/accueil', function () {
        return view('dashboard');
    })->name('dashboard');


    // ================= PARAMÈTRES =================

    Route::prefix('parametres')->name('parametres.')->group(function () {

        // PAGE PRINCIPALE PARAMÈTRES
        Route::get('/', [ParametreController::class, 'index'])
            ->name('index');

        // DURÉE DE VALIDITÉ
        Route::post('/duree', [ParametreController::class, 'updateDuree'])
            ->name('duree.mettre_a_jour');

        // ================= FILIÈRES =================
        Route::prefix('filieres')->name('filieres.')->group(function () {
            Route::post('/', [FiliereController::class, 'store'])
                ->name('enregistrer');

            Route::put('/{filiere}', [FiliereController::class, 'update'])
                ->name('mettre_a_jour');

            Route::delete('/{filiere}', [FiliereController::class, 'destroy'])
                ->name('supprimer');
        });

        // ================= NIVEAUX =================
        Route::prefix('niveaux')->name('niveaux.')->group(function () {
            Route::post('/', [NiveauController::class, 'store'])
                ->name('enregistrer');

            Route::put('/{niveau}', [NiveauController::class, 'update'])
                ->name('mettre_a_jour');

            Route::delete('/{niveau}', [NiveauController::class, 'destroy'])
                ->name('supprimer');
        });

        // ============ ANNÉES ACADÉMIQUES ============
        Route::prefix('annees_academiques')->name('annees_academiques.')->group(function () {
            Route::post('/', [AnneeAcademiqueController::class, 'store'])
                ->name('enregistrer');

            Route::put('/{anneeAcademique}', [AnneeAcademiqueController::class, 'update'])
                ->name('mettre_a_jour');

            Route::delete('/{anneeAcademique}', [AnneeAcademiqueController::class, 'destroy'])
                ->name('supprimer');
        });

    });
});


    // ================= UTILISATEURS =================
    Route::prefix('utilisateurs')->name('utilisateurs.')->group(function () {
        Route::get('/', [UtilisateurController::class, 'index'])->name('index');
        Route::get('/creer', [UtilisateurController::class, 'create'])->name('creer');
        Route::post('/enregistrer', [UtilisateurController::class, 'store'])->name('enregistrer');
        Route::get('/{utilisateur}/modifier', [UtilisateurController::class, 'edit'])->name('modifier');
        Route::put('/{utilisateur}', [UtilisateurController::class, 'update'])->name('mettre_a_jour');
        Route::delete('/{utilisateur}', [UtilisateurController::class, 'destroy'])->name('supprimer');
    });

    // ================= ÉTUDIANTS =================
    Route::prefix('etudiants')->name('etudiants.')->group(function () {
        Route::get('/', [EtudiantController::class, 'index'])->name('index');
        Route::get('/creer', [EtudiantController::class, 'create'])->name('creer');
        Route::post('/enregistrer', [EtudiantController::class, 'store'])->name('enregistrer');
        Route::get('/{etudiant}/modifier', [EtudiantController::class, 'edit'])->name('modifier');
        Route::put('/{etudiant}', [EtudiantController::class, 'update'])->name('mettre_a_jour');
        Route::delete('/{etudiant}', [EtudiantController::class, 'destroy'])->name('supprimer');
    });

    // ================= CARTES =================
    Route::prefix('cartes')->name('cartes.')->group(function () {
        Route::get('/', [CarteController::class, 'index'])->name('index');
        Route::get('/{carte}/modifier', [CarteController::class, 'edit'])->name('modifier');
        Route::put('/{carte}', [CarteController::class, 'update'])->name('mettre_a_jour');
    });

    // ================= HISTORIQUE DES CARTES =================
    Route::get('/historique-cartes', [HistoriqueCarteController::class, 'index'])
        ->name('historique_cartes.index');

// ================= ROUTE PUBLIQUE =================
Route::get('/carte-publique/{qr_code}', [CarteController::class, 'showPublic'])
    ->name('cartes.publique');
