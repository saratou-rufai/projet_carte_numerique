<?php

namespace App\Http\Controllers;

use App\Models\Historique;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{

     //Affichage de  tous les historiques, Chaque historique montre l'admin et l'étudiant concerné
     //creation d'un nouvel historique si par exemple un admin cree une carte ouou supprime ou moddifie avec la fonction store
     //affichage d'un historique precis avec show
     //supprimer un historique avec destroye

    public function index()
    {
        return Historique::with(['administrateur', 'etudiant'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'administrateur_id' => 'required|exists:administrateurs,id',
            'etudiant_id' => 'nullable|exists:etudiants,id',
            'action' => 'required|string',
            'description' => 'nullable|string',
            'adresse_ip' => 'nullable|string'
        ]);

        return Historique::create([
            'administrateur_id' => $request->administrateur_id,
            'etudiant_id' => $request->etudiant_id,
            'action' => $request->action,
            'description' => $request->description,
            'adresse_ip' => $request->adresse_ip
        ]);
    }

    public function show(Historique $historique)
    {
        return $historique->load(['administrateur', 'etudiant']);
    }

    public function destroy(Historique $historique)
    {
        $historique->delete();

        return [
            'message' => 'Historique supprimé avec succès'
        ];
    }
}
