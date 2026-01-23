<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    // 🔹 Afficher toutes les filières
    public function index()
    {
        $filieres = Filiere::all();
        return view('filieres.index', compact('filieres'));
    }

    // 🔹 Formulaire de création
    public function create()
    {
        return view('filieres.creer');
    }

    // 🔹 Enregistrer une nouvelle filière
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:100|unique:filieres,libelle',
        ]);

        Filiere::create([
            'libelle' => $request->libelle,
        ]);

        return redirect()->route('parametres.index')->with('success', 'Filière créée avec succès.');
    }

    // 🔹 Formulaire d'édition
    public function edit(Filiere $filiere)
    {
        return view('parametres.filieres.modifier', compact('filiere'));
    }

    // 🔹 Mettre à jour une filière
    public function update(Request $request, Filiere $filiere)
    {
        $request->validate([
            'libelle' => 'required|string|max:100|unique:filieres,libelle,' . $filiere->id,
        ]);

        $filiere->update([
            'libelle' => $request->libelle,
        ]);

        return redirect()->route('parametres.index')->with('success', 'Filière mise à jour avec succès.');
    }

    // 🔹 Supprimer une filière
    public function destroy(Filiere $filiere)
    {
        $filiere->delete();

        return redirect()->route('parametres.index')->with('success', 'Filière supprimée avec succès.');
    }
}
