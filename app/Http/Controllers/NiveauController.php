<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    // 🔹 Afficher tous les niveaux
    public function index()
    {
        $niveaux = Niveau::all();
        return view('niveaux.index', compact('niveaux'));
    }

    // 🔹 Formulaire de création
    public function create()
    {
        return view('niveaux.creer');
    }

    // 🔹 Enregistrer un nouveau niveau
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:50|unique:niveaux,libelle',
        ]);

        Niveau::create([
            'libelle' => $request->libelle,
        ]);

        return redirect()->route('parametres.index')->with('success', 'Niveau créé avec succès.');
    }

    // 🔹 Formulaire d'édition
    public function edit(Niveau $niveau)
    {
        return view('niveaux.modifier', compact('niveau'));
    }

    // 🔹 Mettre à jour un niveau
    public function update(Request $request, Niveau $niveau)
    {
        $request->validate([
            'libelle' => 'required|string|max:50|unique:niveaux,libelle,' . $niveau->id,
        ]);

        $niveau->update([
            'libelle' => $request->libelle,
        ]);

        return redirect()->route('niveaux.index')->with('success', 'Niveau mis à jour avec succès.');
    }

    // 🔹 Supprimer un niveau
    public function destroy(Niveau $niveau)
    {
        $niveau->delete();

        return redirect()->route('parametres.index')->with('success', 'Niveau supprimé avec succès.');
    }
}
