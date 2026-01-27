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

cards {
    display: flex;
    gap: 20px;
}

.card {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    flex: 1;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}


.stats-container {
        display: flex;
        flex-direction: column;
        gap: 30px; /* Espace entre la ligne du haut et celle du bas */
        margin-top: 20px;
    }








.dashboard-content {
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 30px; /* Espace entre la ligne du haut et du bas */
    }

    .stats-row {
        display: grid;
        gap: 20px; /* Espace entre les cartes d'une même ligne */
    }

    /* 2 colonnes en haut */
    .top-row {
        grid-template-columns: repeat(2, 1fr);
    }

    /* 3 colonnes en bas */
    .bottom-row {
        grid-template-columns: repeat(3, 1fr);
    }

    .stat-card {
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-align: center;
        border-top: 5px solid #4CAF50;
    }

    .stat-card h3 {
        margin: 0;
        font-size: 1.1rem;
        color: #555;
    }

    .stat-card .number {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        margin-top: 10px;
    }

    /* Couleurs spécifiques pour la ligne du bas */
    .border-active { border-top-color: #28a745; }
    .border-suspended { border-top-color: #ffc107; }
    .border-expired { border-top-color: #dc3545; }





</style>

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
       

        <div class="dashboard-content">
    <div class="stats-row top-row">
        <div class="stat-card">
            <h3>Total Étudiants</h3>
            <p class="stat-number"{{$totalEtudiants ?? 0}}></p>


        </div>
        <div class="stat-card">
            <h3>Cartes Générées</h3>

        </div>
    </div>

    <div class="stats-row bottom-row">
        <div class="stat-card border-active">
            <h3>Cartes Actives</h3>

        </div>
        <div class="stat-card border-suspended">
            <h3>Suspendues</h3>

        </div>
        <div class="stat-card border-expired">
            <h3>Expirées</h3>

        </div>
    </div>
</div>



    </div>

@endsection
