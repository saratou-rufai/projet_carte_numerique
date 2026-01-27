@extends('layouts.app')

@section('contenu')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        min-height: 100vh;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .page_container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        max-width: 500px;
        background-color: #fff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    h1 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
        font-weight: 600;
    }

    .form-table {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-row label {
        flex: 1;
        font-weight: 500;
        color: #555;
        margin-right: 10px;
    }

    .form-row input {
        flex: 2;
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 10px;
        transition: 0.3s;
    }

    .form-row input:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        outline: none;
    }

    .btn-primary {
        width: 100%;
        background-color: #4CAF50;
        border: none;
        padding: 12px;
        font-size: 16px;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 20px;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background-color: #45a049;
    }

    .btn-secondary {
        width: 100%;
        margin-top: 10px;
        background-color: #aaa;
        border: none;
        padding: 12px;
        font-size: 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
        text-align: center;
        color: #fff;
        text-decoration: none;
        display: inline-block;
    }

    .btn-secondary:hover {
        background-color: #888;
        text-decoration: none;
        color: #fff;
    }

    .alert {
        background-color: #ffe6e6;
        color: #900;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        font-size: 14px;
    }
</style>
<div class="page_container">
<div class="container">
    <h1>Créer un administrateur</h1>

    {{-- Affichage des messages d'erreur --}}
    @if ($errors->any())
        <div class="alert">
            <strong>Attention !</strong> Veuillez corriger les erreurs ci-dessous :
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire de création --}}
    <form action="{{ route('users.enregistrer') }}" method="POST">
        @csrf

        <div class="form-table">
            <div class="form-row">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" value="" required autocomplete="off">
            </div>

            <div class="form-row">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="" required autocomplete="off">
            </div>

            <div class="form-row">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="" required>
            </div>

            <div class="form-row">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-row">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
        </div>

        {{-- Champ caché pour le rôle admin --}}
        <input type="hidden" name="role" value="admin">

        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="{{ route('login') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</div>

@endsection
