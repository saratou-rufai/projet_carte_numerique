<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Storage;

class EtudiantController extends Controller
{

      //Affiche la liste des étudiants.
    public function index()
    {
        // On récupère les étudiants avec leurs relations
        $etudiants = Etudiant::with(['filiere', 'niveau', 'carte'])->get();
        return view('admin.etudiants.index', compact('etudiants'));
    }

     //Enregistre un nouvel étudiant.
    public function store(Request $request)
    {
        // 1. Validation : On isole les données validées pour éviter le "Mass Assignment"
        $validated = $request->validate([
            'INE' => 'required|unique:etudiants,INE',
            'nom_complet' => 'required|string|max:255',
            'filiere_id' => 'required|exists:filieres,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'annee_academique' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // 2. Gestion de l'upload : Stockage physique du fichier
        if ($request->hasFile('photo')) {
            // Enregistre dans storage/app/public/photos
            $path = $request->file('photo')->store('photos', 'public');
            $validated['photo'] = $path;
        }

        // 3. Création en base de données
        Etudiant::create($validated);

        return redirect()->route('etudiants.index')
                         ->with('success', 'Étudiant enregistré avec succès.');
    }

    
      //Affiche les détails d'un étudiant.

    public function show(Etudiant $etudiant)
    {
        $etudiant->load(['filiere', 'niveau', 'carte']);
        return view('admin.etudiants.show', compact('etudiant'));
    }


      //Met à jour les informations d'un étudiant.

    public function update(Request $request, Etudiant $etudiant)
    {
        $validated = $request->validate([
            'INE' => 'required|unique:etudiants,INE,' . $etudiant->id,
            'nom_complet' => 'required|string|max:255',
            'filiere_id' => 'required|exists:filieres,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'annee_academique' => 'required|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            // On supprime l'ancien fichier pour ne pas encombrer le serveur
            if($etudiant->photo) {
                Storage::disk('public')->delete($etudiant->photo);
            }
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $etudiant->update($validated);

        return redirect()->route('etudiants.index')
                         ->with('success', 'Informations mises à jour.');
    }


     //Supprime un étudiant et son fichier photo.

    public function destroy(Etudiant $etudiant)
    {
        if($etudiant->photo) {
            Storage::disk('public')->delete($etudiant->photo);
        }

        $etudiant->delete();

        return redirect()->route('etudiants.index')
                         ->with('success', 'Étudiant supprimé.');
    }
}
