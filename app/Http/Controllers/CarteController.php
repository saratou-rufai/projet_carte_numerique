<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carte;
use Illuminate\Support\Str; // Nécessaire pour générer le numéro et l'UUID

class CarteController extends Controller
{
    // 1. Affiche la page avec la liste de toutes les cartes
    public function index()
    {
        $cartes = Carte::with('etudiant')->get();
        // On renvoie vers le fichier : resources/views/admin/cartes/index.blade.php
        return view('admin.cartes.index', compact('cartes'));
    }

    // 2. Enregistre une nouvelle carte dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'date_expiration' => 'required|date'
        ]);

        // On vérifie si l'étudiant a déjà une carte pour éviter les doublons
        if (Carte::where('etudiant_id', $request->etudiant_id)->exists()) {
            return redirect()->back()->with('error', 'Cet étudiant a déjà une carte !');
        }

        Carte::create([
            'etudiant_id' => $request->etudiant_id,
            'numero_carte' => 'CARTE-' . now()->year . '-' . strtoupper(Str::random(6)),
            'qr_code' => (string) Str::uuid(), // Un code unique pour le futur QR Code
            'date_creation' => now(),
            'date_expiration' => $request->date_expiration,
            'statut' => 'active'
        ]);

        return redirect()->route('cartes.index')->with('success', 'Carte générée avec succès !');
    }

    // 3. Fonctions pour changer le statut (Activer / Suspendre / Expirer)
    public function activer(Carte $carte)
    {
        $carte->update(['statut' => 'active']);
        return redirect()->back()->with('success', 'La carte est maintenant active.');
    }

    public function suspendre(Carte $carte)
    {
        $carte->update(['statut' => 'suspendue']);
        return redirect()->back()->with('warning', 'La carte a été suspendue.');
    }

    public function expirer(Carte $carte)
    {
        // Attention : on utilise 'expiree' (sans accent) car c'est souvent mieux en base de données
        $carte->update(['statut' => 'expiree']);
        return redirect()->back()->with('info', 'La carte est marquée comme expirée.');
    }

    // 4. Supprimer une carte
    public function destroy(Carte $carte)
    {
        $carte->delete();
        return redirect()->route('cartes.index')->with('success', 'Carte supprimée définitivement.');
    }
}
