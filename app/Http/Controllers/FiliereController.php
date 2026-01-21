<?php

namespace App\Http\Controllers;
use App\Models\Filiere;

use Illuminate\Http\Request;

class FiliereController extends Controller
{

     //Afficher la liste de toutes les filières
     //Récupèrer toutes les filières depuis la base de données
     //Enregistrer une nouvelle filière
     //Validation : le nom de la filière est obligatoire et doit être unique
     //Création de la filière
     //Retourner  la filière créée
     //Met à jour une filière existante
     // Validation avec exclusion de l’ID courant
     //Mise à jour
     //Supprimer une filière
     //Suppression de la filière (les étudiants liés seront supprimés via cascade)


    public function index()
    {

     return response()->json(Filiere::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_filiere' => 'required|string|unique:filieres'
        ]);


        $filiere = Filiere::create([
            'nom_filiere' => $request->nom_filiere
        ]);
        return response()->json($filiere, 201);
    }

    public function update(Request $request, Filiere $filiere)
    {
        $request->validate([
            'nom_filiere' => 'required|string|unique:filieres,nom_filiere,' . $filiere->id
        ]);

        $filiere->update([
            'nom_filiere' => $request->nom_filiere
        ]);

        return response()->json($filiere);
    }

    public function destroy(Filiere $filiere)
    {
        $filiere->delete();

        return response()->json([
            'message' => 'Filière supprimée avec succès'
        ]);
    } //
}
