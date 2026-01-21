<?php

namespace App\Http\Controllers;

use App\Models\Parametre;
use Illuminate\Http\Request;

class ParametreController extends Controller
{

     //Affiche la liste de tous les paramètres système.

    public function index()
    {
        $parametres = Parametre::all();
        return view('admin.parametres.index', compact('parametres'));
    }


     //Affiche le formulaire pour créer un nouveau paramètre.

    public function create()
    {
        return view('admin.parametres.create');
    }


     //Enregistre le paramètre dans la base de données.

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cle' => 'required|unique:parametres,cle',
            'valeur' => 'required|string',
            'description' => 'nullable|string'
        ]);

        Parametre::create($validated);

        return redirect()->route('parametres.index')
                         ->with('success', 'Paramètre créé avec succès.');
    }


     //Affiche le formulaire de modification.

    public function edit(Parametre $parametre)
    {
        return view('admin.parametres.edit', compact('parametre'));
    }


     //Met à jour un paramètre spécifique.

    public function update(Request $request, Parametre $parametre)
    {
        $validated = $request->validate([
            'cle' => 'required|unique:parametres,cle,' . $parametre->id,
            'valeur' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $parametre->update($validated);

        return redirect()->route('parametres.index')
                         ->with('success', 'Paramètre mis à jour.');
    }


     //Supprime un paramètre.
    
    public function destroy(Parametre $parametre)
    {
        $parametre->delete();

        return redirect()->route('parametres.index')
                         ->with('success', 'Paramètre supprimé.');
    }
}
