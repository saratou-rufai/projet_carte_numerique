<?php

namespace App\Http\Controllers;


use App\Models\Etudiant;
use App\Models\Carte;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // On compte les étudiants présents en base
        $totalEtudiants = Etudiant::count();
        $cartesActives = Carte::where('statut', 'active')->count();
        $cartesSuspendues = Carte::where('statut', 'suspendue')->count();
        $cartesExpirees = Carte::where('statut', 'expiree')->count();;

        return view('dashboard', compact(
            'totalEtudiants',
            'cartesActives',
            'cartesSuspendues',
            'cartesExpirees'
        ));
    }
}
