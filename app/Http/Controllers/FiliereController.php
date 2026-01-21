<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;

class FiliereController extends Controller
{

     //Affiche la liste des filières.

    public function index()
    {
        $filieres = Filiere::all();
        // On range les vues dans admin/filieres pour plus de clarté
        return view('admin.filieres.index', compact('filieres'));
    }


      //Affiche le formulaire pour ajouter une filière.

    public function create()
    {
        return view('admin.filieres.create');
    }


     //Enregistre la filière.

    public function store(Request $request)
    {
        // On valide et on récupère les données propres
        $validated = $request->validate([
            'nom_filiere' => 'required|string|unique:filieres,nom_filiere'
        ]);

        Filiere::create($validated);

        return redirect()->route('filieres.index')
                         ->with('success', 'La filière a été ajoutée.');
    }


     //Affiche le formulaire de modification.

    public function edit(Filiere $filiere)
    {
        return view('admin.filieres.edit', compact('filiere'));
    }


      //Met à jour la filière.

    public function update(Request $request, Filiere $filiere)
    {
        $validated = $request->validate([
            'nom_filiere' => 'required|string|unique:filieres,nom_filiere,' . $filiere->id
        ]);

        $filiere->update($validated);

        return redirect()->route('filieres.index')
                         ->with('success', 'Filière mise à jour.');
    }


     //Supprime la filière.
     
    public function destroy(Filiere $filiere)
    {
        $filiere->delete();

        return redirect()->route('filieres.index')
                         ->with('success', 'Filière supprimée.');
    }
}
