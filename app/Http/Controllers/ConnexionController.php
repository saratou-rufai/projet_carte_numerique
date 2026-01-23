<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ConnexionController extends Controller
{
    /**
     * Afficher le formulaire de connexion
     */
    public function login()
    {
        // Vérifier s'il existe déjà un administrateur
        $adminExiste = User::where('role', 'admin')->exists();

        if (!$adminExiste) {
            // Rediriger vers la création du premier admin
            return redirect()->route('users.creer');
        }

        return view('connexion.login');
    }

    /**
     * Traiter la connexion
     */
    public function traitement_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email ou mot de passe incorrect');
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
