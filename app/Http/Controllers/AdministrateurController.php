<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;

class AdministrateurController extends Controller
{

      //Affiche tous les administrateurs avec index
      //affichage de tous les administrateur evec store,si vavide avec validate, creation avec create
      //// affichage d'un administrateur precis
      //mise a jour d'un administrateur avec le nom de l'utilisateur avec update
      //supprimer un addminitrateur avec destroye
      //reinitialiser le mot de passe d'un administrateur avec reinitialisatinMotDePasse

    public function index()
    {
        return Administrateur::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_utilisateur' => 'required|unique:administrateurs',
            'mot_de_passe' => 'required|min:6'
        ]);

        return Administrateur::create([
            'nom_utilisateur' => $request->nom_utilisateur,
            'mot_de_passe' => Hash::make($request->mot_de_passe)
        ]);
    }

    public function show(Administrateur $administrateur)
    {
        return $administrateur;
    }

    public function update(Request $request, Administrateur $administrateur)
    {
        $request->validate([
            'nom_utilisateur' => 'required|unique:administrateurs,nom_utilisateur,' . $administrateur->id
        ]);

        $administrateur->update([
            'nom_utilisateur' => $request->nom_utilisateur
        ]);

        return $administrateur;
    }

    public function destroy(Administrateur $administrateur)
    {
        $administrateur->delete();

        return [
            'message' => 'Administrateur supprimé avec succès'
        ];
    }

    public function reinitialiserMotDePasse(Request $request, Administrateur $administrateur)
    {
        $request->validate([
            'nouveau_mot_de_passe' => 'required|min:6'
        ]);

        $administrateur->update([
            'mot_de_passe' => Hash::make($request->nouveau_mot_de_passe)
        ]);

        return [
            'message' => 'Mot de passe réinitialisé avec succès'
        ];
    }
}
