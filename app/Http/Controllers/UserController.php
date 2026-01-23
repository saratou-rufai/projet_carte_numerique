<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Pour le hachage du mot de passe
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // 🔹 Afficher tous les utilisateurs
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // 🔹 Formulaire de création
    public function create()
    {
        return view('users.creer');
    }

    // 🔹 Enregistrer un nouvel utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // Confirmer via password_confirmation
            'role' => 'required|in:admin',
        ]);

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('login')
                         ->with('success', 'Utilisateur créé avec succès.');
    }

    // 🔹 Formulaire d'édition
    public function edit(User $utilisateur)
    {
        return view('utilisateurs.modifier', compact('utilisateur'));
    }

    // 🔹 Mettre à jour un utilisateur
    public function update(Request $request, User $utilisateur)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($utilisateur->id),
            ],
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:admin',
        ]);

        $utilisateur->nom = $request->nom;
        $utilisateur->prenom = $request->prenom;
        $utilisateur->email = $request->email;
        $utilisateur->role = $request->role;

        if ($request->filled('password')) {
            $utilisateur->password = Hash::make($request->password);
        }

        $utilisateur->save();

        return redirect()->route('utilisateurs.index')
                         ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    // 🔹 Supprimer un utilisateur
    public function destroy(User $utilisateur)
    {
        $utilisateur->delete();

        return redirect()->route('utilisateurs.index')
                         ->with('success', 'Utilisateur supprimé avec succès.');
    }
}
