<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Carte;
use App\Models\AnneeAcademique;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EtudiantController extends Controller
{ 
    // Affiche la liste des étudiants
    public function index(Request $request)
    {
            $q = $request->input('q'); // null si pas de recherche

    $etudiants = Etudiant::with(['filiere', 'niveau', 'carte'])
        ->when($q, function ($query, $q) {
            $query->where(function ($subQuery) use ($q) {
                $subQuery->where('ine', 'like', "%{$q}%")
                          ->orWhere('nom', 'like', "%{$q}%")
                          ->orWhere('prenom', 'like', "%{$q}%")
                          ->orWhereHas('carte', function ($c) use ($q) {
                              $c->where('numero', 'like', "%{$q}%");
                          });
            });
        })
        ->get();

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

    public function edit($id)
{
    $etudiant = Etudiant::findOrFail($id);

    // Récupérer les listes pour les selects
    $filieres = $etudiant->Filiere::all();
    $niveaux = $etudiant->Niveau::all();
    $annees_academiques = AnneeAcademique::all();

    return view('etudiants.modifier', compact('etudiant', 'filieres', 'niveaux', 'annees_academiques'));
}


    public function update(Request $request, Etudiant $etudiant)
    {
        $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'filiere_id' => 'required|exists:filieres,id',
        'niveau_id' => 'required|exists:niveaux,id',
        'annee_id' => 'required|exists:annees_academiques,id',
        'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($etudiant->photo) {
                Storage::disk('public')->delete($etudiant->photo);
            }
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $etudiant->update($validated);

        return redirect()->route('etudiants.index', $etudiant->id)
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

public function carte($id)
{
    // On récupère la carte via son id
    $carte = Carte::where('id', $id)->with('etudiant')->firstOrFail();

    // URL PUBLIQUE
    $monIP = gethostbyname(gethostname()); // IP locale du PC
    $lien_public = "http://{$monIP}:8000/vue_public/{$carte->qr_code}";


    // On renvoie la vue avec la carte
    return view('etudiants.carte', compact('carte', 'lien_public'));
}
}
