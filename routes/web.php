<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\AnneeAcademiqueController;
use App\Http\Controllers\ParametreController;

/*
|--------------------------------------------------------------------------
| ROUTES PUBLIQUES
|--------------------------------------------------------------------------
| Accès sans authentification
|--------------------------------------------------------------------------
*/

// Vue publique via QR Code
Route::get('/vue_public/{qr_code}', [CarteController::class, 'vue_public'])
    ->name('vue_publique');

// Authentification
Route::get('/login', [ConnexionController::class, 'login'])->name('login');
Route::post('/login', [ConnexionController::class, 'traitement_login']);

// Création d’un utilisateur (administrateur initial)
Route::get('/users/creer', [UserController::class, 'create'])->name('users.creer');
Route::post('/users/enregistrer', [UserController::class, 'store'])->name('users.enregistrer');


/*
|--------------------------------------------------------------------------
| ROUTES PRIVÉES
|--------------------------------------------------------------------------
| Accès réservé aux utilisateurs authentifiés
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Déconnexion
    |--------------------------------------------------------------------------
    */
    Route::post('/deconnexion', [ConnexionController::class, 'logout'])
        ->name('deconnexion');

    /*
    |--------------------------------------------------------------------------
    | Tableau de bord
    |--------------------------------------------------------------------------
    */
    Route::get('/accueil', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Gestion des étudiants
    |--------------------------------------------------------------------------
    */
    Route::prefix('etudiants')->name('etudiants.')->group(function () {

        Route::get('/', [EtudiantController::class, 'index'])->name('index');
        Route::get('/creer', [EtudiantController::class, 'create'])->name('inscrire');
        Route::post('/enregistrer', [EtudiantController::class, 'store'])->name('enregistrer');

        Route::get('/{etudiant}/afficher', [EtudiantController::class, 'afficher'])->name('afficher');
        Route::get('/{etudiant}/modifier', [EtudiantController::class, 'edit'])->name('modifier');

        Route::put('/{etudiant}', [EtudiantController::class, 'update'])->name('mettre_a_jour');
        Route::delete('/{etudiant}', [EtudiantController::class, 'destroy'])->name('supprimer');

        Route::get('/carte/{id}', [EtudiantController::class, 'carte'])
            ->name('carte');
    });

    /*
    |--------------------------------------------------------------------------
    | Gestion des utilisateurs
    |--------------------------------------------------------------------------
    */
    Route::prefix('users')->name('users.')->group(function () {

        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{utilisateur}/modifier', [UserController::class, 'edit'])->name('modifier');
        Route::put('/{utilisateur}', [UserController::class, 'update'])->name('mettre_a_jour');
        Route::delete('/{utilisateur}', [UserController::class, 'destroy'])->name('supprimer');
    });

    /*
    |--------------------------------------------------------------------------
    | Paramètres généraux
    |--------------------------------------------------------------------------
    */
    Route::prefix('parametres')->name('parametres.')->group(function () {

        Route::get('/', [ParametreController::class, 'index'])->name('index');
        Route::post('/duree', [ParametreController::class, 'updateDuree'])
            ->name('duree.mettre_a_jour');

        // Filières
        Route::prefix('filieres')->name('filieres.')->group(function () {
            Route::post('/', [FiliereController::class, 'store'])->name('enregistrer');
            Route::put('/{filiere}', [FiliereController::class, 'update'])->name('mettre_a_jour');
            Route::delete('/{filiere}', [FiliereController::class, 'destroy'])->name('supprimer');
        });

        // Niveaux
        Route::prefix('niveaux')->name('niveaux.')->group(function () {
            Route::post('/', [NiveauController::class, 'store'])->name('enregistrer');
            Route::put('/{niveau}', [NiveauController::class, 'update'])->name('mettre_a_jour');
            Route::delete('/{niveau}', [NiveauController::class, 'destroy'])->name('supprimer');
        });

        // Années académiques
        Route::prefix('annees_academiques')->name('annees_academiques.')->group(function () {
            Route::post('/', [AnneeAcademiqueController::class, 'store'])->name('enregistrer');
            Route::put('/{anneeAcademique}', [AnneeAcademiqueController::class, 'update'])->name('mettre_a_jour');
            Route::delete('/{anneeAcademique}', [AnneeAcademiqueController::class, 'destroy'])->name('supprimer');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Gestion des cartes
    |--------------------------------------------------------------------------
    */
    Route::prefix('cartes')->name('cartes.')->group(function () {

        Route::get('/', [CarteController::class, 'index'])->name('index');
        Route::get('/{carte}/modifier', [CarteController::class, 'edit'])->name('modifier');
        Route::put('/{carte}', [CarteController::class, 'update'])->name('mettre_a_jour');

        Route::post('/{carte}/statut', [CarteController::class, 'changerStatut'])
            ->name('statut');

        Route::get('/{carte}/pdf-view', [CarteController::class, 'pdfView'])
            ->name('pdf.view');

        Route::get('/{carte}/pdf', [CarteController::class, 'pdf'])
            ->name('pdf.generate');
    });

    /*
    |--------------------------------------------------------------------------
    | Historique des cartes
    |--------------------------------------------------------------------------
    */
    Route::get('/historique-cartes', [HistoriqueController::class, 'index'])
        ->name('historique_cartes.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/historiques', [HistoriqueController::class, 'index'])
        ->name('historiques.index');
});
