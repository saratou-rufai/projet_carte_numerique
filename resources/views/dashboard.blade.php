@extends('layouts.app')

@section('contenu')

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #ffecc388;

}

/* CONTENEUR PRINCIPAL */
.body-container {

    width: 100%;
    height: 100vh;
    display: block;
    position: fixed;

}

/* CONTENU */
.content {
    display: block;
    width: 75%;
    height: 75%;
    padding: 25px;
    border-radius: 5px;
    margin-left: 120px;
}

.dashboard-content{
    display: block;
    width: 100%;
}


/* CARTES STATS */
.stats-row {
    display: grid;
}


.bottom-row {
    grid-template-columns: repeat(3, 1fr);
    gap: 27p;
}

.stat-card {
    display: block;
    width: 170px;
    background: #ffffffa7;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    text-align: center;
    border-top: 5px solid #0078bd;
    height: 120px;
    padding: 7px;
}

.stat-card h3 {
    margin: 0;
    font-size: 1.1rem;
    color: #555;
}

.stat-card h2 {
    font-size: 2.5rem;
    font-weight: bold;
    color: #333;
    margin-top: 10px;
}

/* COULEURS ÉTAT */
.border-active { border-top-color: #28a745; }
.border-suspendue { border-top-color: #ffa200; }
.border-expiree { border-top-color: #dc3545; }
</style>

<div class="body-container">
    <div class="content">
        <div class="dashboard-content">

            <div class="stats-row top-row">
                <div class="stat-card">
                    <h2>{{ $totalEtudiants ?? 00 }}</h2>
                    <h3>Étudiants inscrits</h3>
                </div>
            </div>

            <div class="stats-row bottom-row">
                <div class="stat-card border-active">
                    <h2>{{ $cartesActives ?? 00 }}</h2>
                    <h3>Cartes actives</h3>
                </div>

                <div class="stat-card border-suspendue">
                    <h2>{{ $cartesSuspendues ?? 00 }}</h2>
                    <h3>Cartes suspendues</h3>
                </div>

                <div class="stat-card border-expiree">
                    <h2>{{ $cartesExpirees ?? 00 }}</h2>
                    <h3>Cartes expirées</h3>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
