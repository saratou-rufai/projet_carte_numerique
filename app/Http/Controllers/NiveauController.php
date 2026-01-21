<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauController extends Controller
{

     //Affiche la liste des niveaux (L1, L2, Master, etc.)

    public function index()
    {
        $niveaux = Niveau::all();
        return view('admin.niveaux.index', compact('niveaux'));
    }


     //Affiche le formulaire de création

    public function create()
    {
        return view('admin.niveaux.create');
    }


     //Enregistre le niveau

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_niveau' => 'required|string|unique:niveaux,nom_niveau'
        ], [
            'nom_niveau.required' => 'Le nom du niveau est obligatoire.',
            'nom_niveau.unique' => 'Ce niveau existe déjà.'
        ]);

        Niveau::create($validated);

        return redirect()->route('niveaux.index')
                         ->with('success', 'Niveau ajouté avec succès.');
    }


     //Affiche le formulaire de modification

    public function edit(Niveau $niveau)
    {
        return view('admin.niveaux.edit', compact('niveau'));
    }


      //Met à jour le niveau

    public function update(Request $request, Niveau $niveau)
    {
        $validated = $request->validate([
            'nom_niveau' => 'required|string|unique:niveaux,nom_niveau,' . $niveau->id
        ], [
            'nom_niveau.required' => 'Le nom du niveau est obligatoire.',
            'nom_niveau.unique' => 'Ce niveau existe déjà.'
        ]);

        $niveau->update($validated);

        return redirect()->route('niveaux.index')
                         ->with('success', 'Niveau mis à jour.');
    }


     //Supprime le niveau
     
    public function destroy(Niveau $niveau)
    {
        $niveau->delete();

        return redirect()->route('niveaux.index')
                         ->with('success', 'Niveau supprimé avec succès.');
    }
}
