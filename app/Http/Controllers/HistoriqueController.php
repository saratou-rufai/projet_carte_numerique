<?php

namespace App\Http\Controllers;

use App\Models\Historique;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{

     //Affiche la liste des logs (historiques) pour l'administrateur.

    public function index()
    {
        // On récupère les historiques du plus récent au plus ancien
        $historiques = Historique::with(['administrateur', 'etudiant'])
                        ->latest()
                        ->paginate(15); // On utilise la pagination pour ne pas bloquer la page

        return view('admin.historiques.index', compact('historiques'));
    }


    public static function enregistrer($adminId, $action, $description = null, $etudiantId = null)
    {
        Historique::create([
            'administrateur_id' => $adminId,
            'etudiant_id' => $etudiantId,
            'action' => $action,
            'description' => $description,
            'adresse_ip' => request()->ip() 
        ]);
    }

    public function show(Historique $historique)
    {
        $historique->load(['administrateur', 'etudiant']);
        return view('admin.historiques.show', compact('historique'));
    }

    public function destroy(Historique $historique)
    {
        $historique->delete();
        return redirect()->route('historiques.index')->with('success', 'Entrée supprimée.');
    }
}
