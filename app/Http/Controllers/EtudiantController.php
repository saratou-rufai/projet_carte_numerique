<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Carte;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EtudiantController extends Controller
{ 
    // Affiche la liste des étudiants
    public function index()
    {
        $etudiants = Etudiant::with(['filiere', 'niveau', 'carte'])->get();
        return view('etudiants.index', compact('etudiants'));
    }


    // AFFICHER LES INFORMATIONS D'UN ETUDIANT
public function afficher(Etudiant $etudiant){
    $etudiant->load(['filiere', 'niveau', 'carte']);
    return view('etudiants.afficher', compact('etudiant'));
}

    /**
 * Affiche le formulaire pour créer un nouvel étudiantA
 */
public function create()
{
    // Récupérer toutes les filières et niveaux pour les listes déroulantes
    $filieres = \App\Models\Filiere::all();
    $niveaux = \App\Models\Niveau::all();
    $annees_academiques = \App\Models\AnneeAcademique::all();

    return view('etudiants.creer', compact('filieres', 'niveaux', 'annees_academiques'));
}


    // Enregistre un nouvel étudiant
public function store(Request $request)
{
    // 1. Validation
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'filiere_id' => 'required|exists:filieres,id',
        'niveau_id' => 'required|exists:niveaux,id',
        'annee_id' => 'required|exists:annees_academiques,id',
        'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'validite_carte' => 'required|integer|min:1',
    ]);

    // 2. Upload photo
    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('photos', 'public');
        $validated['photo'] = $path;
    }

    // 3. Génération de l'INE
    $lastId = Etudiant::max('id') ?? 0; // récupère le dernier ID
    $newId = $lastId + 1;
    $validated['ine'] = 'N' . str_pad($newId, 5, '0', STR_PAD_LEFT) . now()->year;

    // 4. Création de l'étudiant avec l'INE
    $etudiant = Etudiant::create($validated);

    // 5. Création de la carte
$carte = Carte::create([
    'etudiant_id' => $etudiant->id,
    'date_creation' => now(),
    'date_expiration' => now()->addYears((int) $request->validite_carte),
    'statut' => 'active',
    'qr_code' => Str::uuid(),
    'token' => Str::uuid(), // ✅ AJOUT OBLIGATOIRE
    'numero' => 'TEMP',
]);


    // 6. Numéro de carte
    $carte->update([
        'numero' => str_pad($carte->id, 8, '0', STR_PAD_LEFT),
    ]);

    return redirect()->route('etudiants.index')
                     ->with('success', 'Étudiant et carte créés avec succès.');
}


    // Affiche les détails d'un étudiant
    public function show(Etudiant $etudiant)
    {
        $etudiant->load(['filiere', 'niveau', 'carte']);
        return view('etudiants.show', compact('etudiant'));
    }

    // Met à jour un étudiant
    public function edit(Request $request, Etudiant $etudiant)
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
            if ($etudiant->photo) {
                Storage::disk('public')->delete($etudiant->photo);
            }
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $etudiant->update($validated);

        return redirect()->route('etudiants.index')
                         ->with('success', 'Informations mises à jour.');
    }

    // Supprime un étudiant
    public function destroy(Etudiant $etudiant)
    {
        if ($etudiant->photo) {
            Storage::disk('public')->delete($etudiant->photo);
        }

        // Supprime la carte associée automatiquement
        if ($etudiant->carte) {
            $etudiant->carte->delete();
        }

        $etudiant->delete();

        return redirect()->route('etudiants.index')
                         ->with('success', 'Étudiant et carte supprimés.');
    }

    // Affiche la carte d'un étudiant

public function carte($token)
{
    // On récupère la carte via le token
    $carte = Carte::where('token', $token)->with('etudiant')->firstOrFail();

    // On renvoie la vue avec la carte
    return view('etudiants.carte', compact('carte'));
}
}
