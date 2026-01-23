<?php

namespace App\Http\Controllers;

use App\Models\AnneeAcademique;
use Illuminate\Http\Request;

class AnneeAcademiqueController extends Controller
{
    // 🔹 Afficher toutes les années académiques
    public function index()
    {
        $annees = AnneeAcademique::all();
        return view('annees_academiques.index', compact('annees'));
    }

    // 🔹 Formulaire pour créer une nouvelle année académique
    public function create()
    {
        return view('annees_academiques.creer');
    }

    // 🔹 Enregistrer une nouvelle année académique
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:20|unique:annees_academiques,libelle',
        ]);

        AnneeAcademique::create([
            'libelle' => $request->libelle,
        ]);

        return redirect()->route('parametres.index')
                         ->with('success', 'Année académique créée avec succès.');
    }

    // 🔹 Formulaire d'édition d'une année académique
    public function edit(AnneeAcademique $anneeAcademique)
    {
        return view('annees_academiques.modifier', compact('anneeAcademique'));
    }

    // 🔹 Mettre à jour une année académique
    public function update(Request $request, AnneeAcademique $anneeAcademique)
    {
        $request->validate([
            'libelle' => 'required|string|max:20|unique:annees_academiques,libelle,' . $anneeAcademique->id,
        ]);

        $anneeAcademique->update([
            'libelle' => $request->libelle,
        ]);

        return redirect()->route('annees_academiques.index')
                         ->with('success', 'Année académique mise à jour avec succès.');
    }

    // 🔹 Supprimer une année académique
    public function destroy(AnneeAcademique $anneeAcademique)
    {
        $anneeAcademique->delete();

        return redirect()->route('parametres.index')
                         ->with('success', 'Année académique supprimée avec succès.');
    }
}
