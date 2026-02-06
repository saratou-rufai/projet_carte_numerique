<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>@yield('titre', 'Carte Étudiant')</title>

<style>
/* ===== RESET & BODY ===== */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f4f4;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* ===== HEADER ===== */
header {
    position: sticky;
    top: 0;
    width: 100%;
    height: 85px;
    background: linear-gradient(90deg, #2a80cf, #5aafff, #2a80cf);
    color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    z-index: 100;
}

header h1 {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0;
    font-size: 25px;
    color: #ffd194
}

header h1 img {
    height: 70px;
    width: auto;
}

/* BOUTON TOGGLE MENU */
#btnToggleMenu {
    background-color: #ffffff;
    color: #2a80cf;
    border: 2px solid #2a80cf;
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    z-index: 200;
}
#btnToggleMenu:hover {
    background-color: #e6f0ff;
}

/* ===== BODY WRAPPER ===== */
.body-wrapper {
    display: flex;
    flex-grow: 1;
    min-height: calc(100vh - 85px); /* full height minus header */
}

/* ===== MENU FIXE À GAUCHE ===== */
.menu {
    flex-shrink: 0;
    width: 250px;
    background-color: #0078bd;
    display: flex;
    flex-direction: column;
    padding: 15px 0 0 15px;
    gap: 9px;
    transition: transform 0.3s ease;
    position: fixed;
    top: 85px;
    bottom: 0;
    left: 0;
    z-index: 100;

}
.menu.hidden {
    transform: translateX(-100%);
}

.menu a, .menu form button {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 15px;
    color: white;
    text-decoration: none;
    font-weight: bold;
    border: none;
    background-color: #016aa7a9;
    cursor: pointer;
    border-radius: 4px;
}
.menu a:hover, .menu form button:hover {
    background-color: #00598c;
}

.menu img {
    width: 27px;
    height: 27px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 900px) {
    .menu {
        position: fixed;
        width: 200px;
        transform: translateX(-100%);
}
}

</style>
</head>
<body>

<header>
    <h1>
        <img src="{{ asset('images/logo.png') }}" alt="UTAB">
        UNIVERSITE TECHNONOLOGIQUE DU BURKINA | CARTES D'ETUDIANTS NUMERIQUES
    </h1>
    <button id="btnToggleMenu">MENU</button>
</header>

<div class="body-wrapper">
    <!-- MENU FIXE À GAUCHE -->
    <div class="menu" id="menu">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('icones/accueil.png') }}" alt="Accueil"> ACCUEIL
        </a>
        <a href="{{ route('etudiants.index') }}">
            <img src="{{ asset('icones/etudiant.png') }}" alt="Etudiants"> ETUDIANTS
        </a>
        <a href="{{ route('cartes.index') }}">
            <img src="{{ asset('icones/carte.png') }}" alt="Cartes"> CARTES
        </a>
        <a href="{{ route('historique_cartes.index') }}">
            <img src="{{ asset('icones/historique.png') }}" alt="Historiques"> HISTORIQUES
        </a>
        <a href="{{ route('users.index') }}">
            <img src="{{ asset('icones/admin.png') }}" alt="Admin"> ADMINISTRATEURS
        </a>
        <a href="{{ route('parametres.index') }}">
            <img src="{{ asset('icones/parametres.png') }}" alt="Paramètres"> PARAMETRES
        </a>
        <form action="{{ route('deconnexion') }}" method="POST">
            @csrf
            <button type="submit">
                <img src="{{ asset('icones/deconnexion.png') }}" alt="Déconnexion"> DÉCONNEXION
            </button>
        </form>
    </div>

    <!-- CONTENU PRINCIPAL -->
    <div class="content" id="content">
        @yield('contenu')
    </div>
</div>

<script>
const btnToggleMenu = document.getElementById('btnToggleMenu');
const menu = document.getElementById('menu');
const content = document.getElementById('content');

btnToggleMenu.addEventListener('click', function() {
    menu.classList.toggle('hidden');
    content.classList.toggle('fullwidth');
});
</script>

</body>
</html>
