<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carte;

class CarteController extends Controller
{

// affiche toutes les cartes avec les etudiant avec indexe
//generer une carte pour un etudiant avec store;
//validation de la carte avec validate
//generation des donnee automatique de la carte avec create
// affichage d'une catre precise avec show
//suspendre une carte avec suspendre
//activer une catre avec activer
//expirer une catre avec expirer
//detruire une carte avec destroye

     public function index()
    {
        return Carte::with('etudiant')->get();
    }


    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'date_expiration' => 'required|date'
        ]);

        if (Carte::where('etudiant_id', $request->etudiant_id)->exists()) {
            return ['message' => 'Cet étudiant possède déjà une carte'];
        }

        return Carte::create([
            'etudiant_id' => $request->etudiant_id,
            'numero_carte' => 'CARTE-' . now()->year . '-' . strtoupper(Str::random(6)),
            'qr_code' => 'QR-' . Str::uuid(),
            'date_creation' => now(),
            'date_expiration' => $request->date_expiration,
            'statut' => 'active'
        ]);
    }


    public function activer(Carte $carte)
    {
        $carte->update(['statut' => 'active']);
        return $carte;
    }


    public function suspendre(Carte $carte)
    {
        $carte->update(['statut' => 'suspendue']);
        return $carte;
    }


    public function expirer(Carte $carte)
    {
        $carte->update(['statut' => 'expirée']);
        return $carte;
    }

    public function destroy(Carte $carte)
    {
        $carte->delete();
        return ['message' => 'Carte supprimée'];
    }
}
