@extends('layouts.app')

@section('contenu')

<style>
/* ===== CONTENEUR DASHBOARD ===== */
.body-container {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #63b4ff62, #a99f3561);
    padding: 20px;
    box-sizing: border-box;
    border-radius:  23px;
}

/* ===== CONTENU DASHBOARD ===== */
.dashboard-content {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    gap: 30px;

    position: absolute;
    top: 35%;
    left: 13%;
}

/* ===== LIGNES DE STATISTIQUES ===== */
.stats-row {
    display: flex;
    justify-content: center;
    gap: 25px;
}

/* ===== CARTES ===== */
.stat-card {
    display: block;
    width: 180px;
    height: 120px;
    background: #ffffffa7;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    text-align: center;
    border-top: 5px solid #0078bd;
    padding: 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.stat-etudiant{
    width: 610px;
    height: 90px;
}


.stat-card h3 {
    margin: 0;
    font-size: 1.1rem;
    color: #555;
}

.stat-etudiant h3{
    color: #0078bd;
}

.stat-card h2 {
    font-size: 2.5rem;
    font-weight: bold;
    color: #333;
    margin: 5px 0 0 0;
}

/* ===== COULEURS DES ETATS ===== */
.border-active { border-top-color: #28a745; }
.border-suspendue { border-top-color: #ffa200; }
.border-expiree { border-top-color: #dc3545; }

</style>

<div class="body-container">

    <div class="dashboard-content">

        <div class="stats-row">
            <div class="stat-card stat-etudiant">
                <h3> {{ $totalEtudiants ?? 00 }} Étudiant(e)s inscrit(e)s </h3>
            </div>
        </div>

        <div class="stats-row">
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

@endsection
