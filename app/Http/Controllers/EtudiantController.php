<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;


class EtudiantController extends Controller
{
    //Afficher la liste des etudiant avec leur relation(filiere, niveau, carte) avec index
    //enreistrer un nouveau etudiant avec store
    //validation des donnee recue du formulare avec validate
    //creation d'un etudiant avec create
    //afficher les information d'un etudiant precis avec show
    //mettre a jour un etudiant existant avec update
    //supprimer un etudiant

    public function index()
    {
        return Etudiant::with(['filiere', 'niveau', 'carte'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'INE' => 'required|unique:etudiants',
            'nom_complet' => 'required',
            'filiere_id' => 'required|exists:filieres,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'annee_academique' => 'required',
            'photo' => 'required'
        ]);

        return Etudiant::create($request->all());
    }

    public function show(Etudiant $etudiant)
    {
        return $etudiant->load(['filiere', 'niveau', 'carte']);
    }

    public function update(Request $request, Etudiant $etudiant)
    {
        $request->validate([
            'INE' => 'required|unique:etudiants,INE,' . $etudiant->id
        ]);

        $etudiant->update($request->all());

        return $etudiant;
    }

    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();

        return [
            'message' => 'Étudiant supprimé avec succès'
        ];
    }
}


