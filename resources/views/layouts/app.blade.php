<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>@yield('titre', 'Carte Étudiant')</title>

<style>
html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: Arial, sans-serif;
    overflow: hidden;
}

/* Header */
header {
    position: relative;
    height: 85px;
    background: linear-gradient(90deg, #2a80cf, #5aafff, #2a80cf);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.entete-gauche { position: absolute; left: 20px; top: 50%; transform: translateY(-50%); }
.entete-gauche img { height: 70px; }

.entete-centre {
    position: absolute; left: 50%; width: 100%; top: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}
.entete-centre h1 { margin: 3px; font-size: 24px; color: #ffd194; }
.entete-centre h3 { margin: 4px 0 0 0; font-size: 14px; font-weight: normal; color: #fff; }

/* Main layout */
.conteneur-principal { display: flex; height: calc(100% - 85px); }

/* Menu gauche */
.menu {
    width: 250px;
    background-color: #0078bd;
    display: flex;
    flex-direction: column;
    padding: 15px 10px;
    gap: 10px;
    flex-shrink: 0;
}

.menu a,
.menu form button {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    color: white;
    text-decoration: none;
    font-weight: bold;
    border: none;
    background-color: #016aa7a9;
    cursor: pointer;
    border-radius: 4px;
}

.menu a:hover,
.menu form button:hover {
    background-color: #00598c;
}

.menu img {
    width: 26px;
    height: 26px;
}

/* Contenu */
.contenu {
    flex: 1;
    padding: 20px;
    overflow: auto;
    background-image: url("{{ asset('images/back_img.png') }}");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
</head>

<body>

<header>
    <div class="entete-gauche">
        <img src="{{ asset('images/logo.png') }}" alt="UTAB">
    </div>
    <div class="entete-centre">
        <h1>CARTES D'ÉTUDIANTS NUMÉRIQUES | UTAB</h1>
        <h3>UNIVERSITÉ DES TECHNOLOGIES APPLIQUÉES DU BURKINA</h3>
    </div>
</header>

<div class="conteneur-principal">

    <div class="menu">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('icones/accueil.png') }}"> ACCUEIL
        </a>
        <a href="{{ route('etudiants.index') }}">
            <img src="{{ asset('icones/etudiant.png') }}"> ETUDIANTS
        </a>
        <a href="{{ route('cartes.index') }}">
            <img src="{{ asset('icones/carte.png') }}"> CARTES
        </a>
        <a href="{{ route('historiques.index') }}">
            <img src="{{ asset('icones/historique.png') }}"> HISTORIQUES
        </a>
        <a href="{{ route('users.index') }}">
            <img src="{{ asset('icones/admin.png') }}"> ADMINISTRATEURS
        </a>
        <a href="{{ route('parametres.index') }}">
            <img src="{{ asset('icones/parametres.png') }}"> PARAMETRES
        </a>
        <form action="{{ route('deconnexion') }}" method="POST">
            @csrf
            <button type="submit">
                <img src="{{ asset('icones/deconnexion.png') }}"> DÉCONNEXION
            </button>
        </form>
    </div>

    <div class="contenu">
        @yield('contenu')
    </div>

</div>

</body>
</html>
