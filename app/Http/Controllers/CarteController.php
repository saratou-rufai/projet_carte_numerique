<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Browsershot\Browsershot;
use App\Models\Historique;

class CarteController extends Controller
{

    public function index()
    {
        // On récupère toutes les cartes avec leur étudiant associé
        $cartes = Carte::with('etudiant')->get();

        // On renvoie la vue avec les cartes
        return view('cartes.index', compact('cartes'));
    }
    /**
     * Affiche la carte d'un étudiant
     */
    public function show($id)
    {
        $carte = Carte::with('etudiant')->findOrFail($id);
        return view('cartes.show', compact('carte'));
    }

    /**
     * Vue publique via QR code
     */
    public function vue_public($qr_code)
    {
        $carte = Carte::where('qr_code', $qr_code)
            ->with('etudiant')
            ->firstOrFail();
        $etudiant = $carte->etudiant;

        return view('etudiants.vue_public', compact('carte', 'etudiant'));
    }

    /**
     * Changer le statut de la carte
     */
    public function changerStatut(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:active,suspendue,expiree',
            'motif'  => 'nullable|string|max:255', // optionnel
        ]);

        $carte = Carte::findOrFail($id);

        // Met à jour le statut de la carte
        $carte->statut = $request->statut;
        $carte->save();

        // Mapping du statut vers l'enum Historique
        $statutEnum = [
            'active'    => 'activation',
            'suspendue' => 'suspension',
            'expiree'   => 'expiration',
        ];

        $action = $statutEnum[$request->statut] ?? $request->statut;

        // Crée l'historique
        Historique::create([
            'carte_id' => $carte->id,      // OBLIGATOIRE
            'action'   => $action,         // enum
            'motif'    => $request->motif ?? null,
        ]);

        return back()->with('success', 'Statut mis à jour avec succès');
    }

    /**
     * Vue PDF de la carte
     */
    public function pdfView(Carte $carte)
    {
        return view('cartes.pdf', compact('carte'));
    }

    /**
     * Générer le PDF via BrowserShot
     */
    public function pdf(Carte $carte)
    {
        $pdfPath = storage_path('app/public/carte_'.$carte->numero.'.pdf');

        Browsershot::url(route('cartes.pdfView', $carte))
            ->format('A7')
            ->showBackground()
            ->waitUntilNetworkIdle()
            ->save($pdfPath);

        return response()->download($pdfPath, 'carte_'.$carte->numero.'.pdf');
    }
}
