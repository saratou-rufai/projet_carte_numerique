<?php

namespace App\Http\Controllers;


use App\Models\Etudiant;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // On compte les étudiants présents en base
        $totalEtudiants = Etudiant::count();

        // Comme la logique des cartes n'est pas encore créée,
        // on initialise ces variables à 0 pour éviter les erreurs Blade
        $cartesGenerees = 0;
        $cartesActives = 0;
        $cartesSuspendues = 0;
        $cartesExpirees = 0;

        return view('dashboard', compact(
            'totalEtudiants',
            'cartesGenerees',
            'cartesActives',
            'cartesSuspendues',
            'cartesExpirees'
        ));
    }
}
