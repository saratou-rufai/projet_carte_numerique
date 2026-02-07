<?php

namespace App\Http\Controllers;

use App\Models\Historique;

class HistoriqueController extends Controller
{
    /**
     * Affiche la liste des historiques
     */
    public function index()
    {
        // Charger les historiques avec la carte associée
        $historiques = Historique::with('carte')
            ->latest()
            ->get();

        return view('historiques.index', compact('historiques'));
    }
}
