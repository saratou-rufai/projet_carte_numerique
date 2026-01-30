<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Auth;

class CarteController extends Controller
{
    /**
     * Affiche la carte d'un étudiant
     */
    public function show($id)
    {
        $carte = Carte::with(['etudiant'])->findOrFail($id);
        return view('cartes.show', compact('carte'));
    }


public function vue_public($qr_code)
{
    // Récupère la carte correspondant au QR code, avec les infos de l'étudiant
    $carte = Carte::where('qr_code', $qr_code)
        ->with('etudiant')  // charge la relation etudiant
        ->firstOrFail();    // si pas trouvé, renvoie 404
    $etudiant = $carte->etudiant;

    // Passe la carte (et donc l'étudiant) à la vue publique
    return view('etudiants.vue_public', compact('carte', 'etudiant'));
}

    /**
     * Changer le statut de la carte (ACTIVE, SUSPENDUE, EXPIREE)
     */
    public function changerStatut(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:active,suspendue,expiree',
        ]);

        $carte = Carte::findOrFail($id);
        $carte->statut = $request->statut;
        $carte->save();

        return redirect()->back()->with('success', 'Statut mis à jour avec succès');
    }

    /**
     * Page HTML pour BrowserShot
     */
    // public function pdfView(Carte $carte)
    // {
    //     $lien_public = route('vue_publique', ['qr_code' => $carte->qr_code]);
    //     return view('cartes.pdf', compact('carte', 'lien_public'));
    // }

    /**
     * Générer le PDF de la carte
     */
// public function pdf(Carte $carte)
// {
//     $pdfPath = storage_path('app/public/carte_'.$carte->numero.'.pdf');

//     Browsershot::url(route('cartes.pdf.view', $carte)) // <- passe l'objet Carte directement
//         ->format('A7')            
//         ->showBackground()        
//         ->save($pdfPath);

//     return response()->download($pdfPath, 'carte_'.$carte->numero.'.pdf');
// }

// Vue Blade spéciale PDF
public function pdfView(Carte $carte)
{
    // $ipPc = gethostbyname(gethostname()); // IP locale du PC
    // $lien_public = "http://{$ipPc}:8000/cartes/{$carte->qr_code}";
    // $lien_public = route('vue_publique', ['qr_code' => $carte->qr_code]);
    return view('cartes.pdf', compact('carte', 'lien_public'));
}

// Générer le PDF via BrowserShot
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
