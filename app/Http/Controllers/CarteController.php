<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarteController extends Controller
{
    /**
     * Affiche la carte d'un étudiant
     */
    public function show($id)
    {
        $carte = Carte::with(['etudiant'])->findOrFail($id);

        return view('cartes.show', compact('carte'));
    }

    /**
     * Changer le statut de la carte (ACTIVE, SUSPENDUE, EXPIREE)
     */
    public function changerStatut(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:ACTIVE,SUSPENDUE,EXPIREE',
        ]);

        $carte = Carte::findOrFail($id);

        $carte->statut = $request->statut;
        $carte->save();

        return response()->json([
            'success' => true,
            'message' => 'Statut mis à jour',
            'statut' => $carte->statut
        ]);
    }

    /**
     * (OPTIONNEL) Imprimer la carte en PDF
     * Si tu veux un vrai PDF côté serveur, décommente et installe dompdf
     */
    /*
    public function pdf($id)
    {
        $carte = Carte::with(['etudiant'])->findOrFail($id);

        $pdf = \PDF::loadView('cartes.pdf', compact('carte'));
        return $pdf->download('carte_'.$carte->numero.'.pdf');
    }
    */
}
