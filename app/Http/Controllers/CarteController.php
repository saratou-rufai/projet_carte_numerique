<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use Illuminate\Http\Request;

class CarteController extends Controller
{
    //  Liste de toutes les cartes
    public function index()
    {
        $cartes = Carte::with('etudiant')->orderBy('created_at', 'desc')->get();
        return view('admin.cartes.index', compact('cartes'));
    }

    //  Activer une carte
    public function activer(Carte $carte)
    {
        $carte->update(['statut' => 'active']);
        return back()->with('success', 'Carte activée.');
    }

    // ⏸ Suspendre une carte
    public function suspendre(Carte $carte)
    {
        $carte->update(['statut' => 'suspendue']);
        return back()->with('warning', 'Carte suspendue.');
    }

    //  Expirer une carte
    public function expirer(Carte $carte)
    {
        $carte->update(['statut' => 'expiree']);
        return back()->with('info', 'Carte expirée.');
    }

    //  Supprimer une carte
    public function destroy(Carte $carte)
    {
        $carte->delete();
        return redirect()->route('cartes.index')->with('success', 'Carte supprimée.');
    }
}
