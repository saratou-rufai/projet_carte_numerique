<?php

namespace App\Http\Controllers;

use App\Models\Parametre;
use Illuminate\Http\Request;

class ParametreController extends Controller
{

     //Affiche tous les paramètres
     //creation d'un nouveau parametreavec store
     //affichage d'un parametre precis avec show
     //mise a jour d'un parametre precis
     // //mise a jour du parametre
     //suppression d'un paramettre
    public function index()
    {
        return Parametre::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'cle' => 'required|unique:parametres',
            'valeur' => 'required',
            'description' => 'nullable|string'
        ]);

        return Parametre::create([
            'cle' => $request->cle,
            'valeur' => $request->valeur,
            'description' => $request->description
        ]);
    }

    public function show(Parametre $parametre)
    {
        return $parametre;
    }

    public function update(Request $request, Parametre $parametre)
    {
        $request->validate([
            'cle' => 'required|unique:parametres,cle,' . $parametre->id,
            'valeur' => 'required',
        ]);

        $parametre->update([
            'cle' => $request->cle,
            'valeur' => $request->valeur,
            'description' => $request->description
        ]);

        return $parametre;
    }

    
    public function destroy(Parametre $parametre)
    {
        $parametre->delete();

        return [
            'message' => 'Paramètre supprimé avec succès'
        ];
    }
}
