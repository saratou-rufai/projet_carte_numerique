<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauController extends Controller
{

     //Affiche la liste de tous les niveaux
     // Récupère tous les niveaux de la base de données
      //Enregistre un nouveau niveau
       // Validation : nom obligatoire et unique
       // Création du niveau
        // Retour du niveau créé
        //Met à jour un niveau existant
        // Validation avec exclusion de l’ID courant
         // Mise à jour
         // Supprime un niveau
         // Suppression du niveau (les étudiants liés seront supprimés via cascade)

    public function index()
    {
        return response()->json(Niveau::all());
    }
    public function store(Request $request)
    {
        $request->validate([
            'nom_niveau' => 'required|string|unique:niveaux'
        ], [
            'nom_niveau.required' => 'Le nom du niveau est obligatoire.',
            'nom_niveau.unique' => 'Ce niveau existe déjà.'
        ]);


        $niveau = Niveau::create([
            'nom_niveau' => $request->nom_niveau
        ]);


        return response()->json($niveau, 201);
    }

    public function update(Request $request, Niveau $niveau)
    {

        $request->validate([
            'nom_niveau' => 'required|string|unique:niveaux,nom_niveau,' . $niveau->id
        ], [
            'nom_niveau.required' => 'Le nom du niveau est obligatoire.',
            'nom_niveau.unique' => 'Ce niveau existe déjà.'
        ]);


        $niveau->update([
            'nom_niveau' => $request->nom_niveau
        ]);

        return response()->json($niveau);
    }


    public function destroy(Niveau $niveau)
    {

        $niveau->delete();

        return response()->json([
            'message' => 'Niveau supprimé avec succès'
        ]);
    }
}
