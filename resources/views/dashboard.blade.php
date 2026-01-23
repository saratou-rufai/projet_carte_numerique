@extends('layouts.app')

@section('contenu')

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
}

/* ENTÊTE */
.header {
    background-color: #ffffff;
    padding: 20px;
    text-align: center;
    border-bottom: 2px solid #ddd;
}

.header h1 {
    margin: 0;
}

/* CORPS */
.body-container {
    width: 90%;
    margin: 20px auto;
    display: flex;
    gap: 20px;
}

/* MENU À GAUCHE */
.menu {
    width: 220px;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* LIENS MENU */
.menu a,
.menu button {
    padding: 15px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
    font-weight: bold;
    border: none;
    cursor: pointer;
}

.menu a:hover,
.menu button:hover {
    background-color: #45a049;
}

/* BOUTON DÉCONNEXION */
.menu button {
    background-color: #F44336;
}

.menu button:hover {
    background-color: #d32f2f;
}

/* CONTENU À DROITE */
.content {
    flex: 1;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 5px;
}

</style>

<!-- ENTÊTE -->
<div class="header">
    <h1>Tableau de bord</h1>
</div>

<!-- CORPS -->
<div class="body-container">

    <!-- MENU -->
    <div class="menu">
        <a href="{{ route('etudiants.index') }}">Etudiants</a>
        <a href="{{ route('cartes.index') }}">Cartes d'étudiants</a>
        <a href="{{ route('historique_cartes.index') }}">Historique des cartes</a>
        <a href="{{ route('users.index') }}">Administrateurs</a>
        <a href="{{ route('parametres.index') }}">Paramètres</a>
        <form action="#" method="POST">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>
    </div>

    <!-- CONTENU -->
    <div class="content">
        <p>Bienvenue sur le système de gestion de cartes d'étudiants numériques.</p>
        <p>Utilisez le menu à gauche pour naviguer entre les différentes sections.</p>
    </div>

</div>

@endsection
