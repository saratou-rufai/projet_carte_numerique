<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Vue publique</title>

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, #f9fff7, #fffef3);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }

    /* CARTE */
    .card {
        background: linear-gradient(135deg, #ffe5b6, #afffeb);
        width: 830px; /* largeur par défaut desktop/mobile portrait */
        max-width: 95%; /* 🔹 occupe 95% de la largeur sur mobile */
        height: 1060px;
        padding: 24px;
        border-radius: 27px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        text-align: center;
        display: flex;
        flex-direction: column;
        border: #ffffff 3px solid;

        /* 🔹 fixe à l'écran */
        position: fixed;
        top: 50%;           /* centré verticalement */
        left: 50%;          /* centré horizontalement */
        transform: translate(-50%, -50%);
        z-index: 9999;
    }

    /* TITRE */
    h1 {
        font-size: 47px;
        font-weight: bolder;
        margin-bottom: 14px;
        color: #333;
        text-align: center;
    }

    /* PHOTO */
    .photo {
        width: 373px;
        height: 373px;
        border-radius: 27px;
        object-fit: cover;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        margin: 12px auto 18px;
        display: block;
    }

    /* CONTENEUR INFOS (CENTRÉ) */
    .info-table {
        width: 100%;
        max-width: 600px;
        margin: 60px auto 0;
    }

    .info-row {
        display: grid;
        grid-template-columns: 170px 5fr;
        column-gap: 35px;
        align-items: center;
        padding: 25px;
        border-bottom: 1px solid #eee;
        font-size: 43px;
        margin: 12px;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #444;
        text-align: left;
        white-space: nowrap;
    }

    .info-value {
        color: #222;
        text-align: left;
        word-break: break-word;
    }

    /* ZONE STATUT EN BAS */
    .statut-bloc {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .status-container {
        margin-top: 90px;
        padding-top: 27px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 18px;
        border-radius: 14px;
        font-size: 37px;
        font-weight: bold;
        color: #fff;
        white-space: nowrap;
        line-height: 1;
    }

    .valide {
        background-color: #4CAF50;
        padding: 13px;
    }

    .invalide {
        background-color: #f44336;
    }

    /* 🔹 RESPONSIVE MOBILE */
    @media (max-width: 900px) {
        .card {
            width: 95%;           /* occupe presque tout l'écran */
            padding: 16px;
        }

        .photo {
            width: 120px;
            height: 120px;
        }

        .info-row {
            grid-template-columns: 90px 1fr;
            font-size: 14px;
        }

        h1 {
            font-size: 16px;
        }

        .badge {
            padding: 5px 14px;
            font-size: 12px;
        }
    }
</style>


</head>

<body>

<div class="card">

   <b><h1> CARTE D'ETUDIANT NUMERIQUE</h1></b>

    <img src="{{ asset('storage/' . $etudiant->photo) }}" class="photo">

    <div class="info-table">

        <div class="info-row">
            <div class="info-label">Nom :</div>
            <div class="info-value"> <strong>{{ $etudiant->nom }}</strong></div>
        </div>

        <div class="info-row">
            <div class="info-label">Prénom :</div>
            <div class="info-value"> <strong>{{ $etudiant->prenom }}</strong></div>
        </div>

        <div class="info-row">
            <div class="info-label">Filière :</div>
            <div class="info-value"> <strong>{{ $etudiant->filiere->libelle }}</strong> </div>
        </div><br>

        <div class="statut-bloc"> 
            <div class="info-value">
                @if($carte->statut === 'active')
                    <span class="badge valide">CARTE VALIDE</span>
                @else
                    <span class="badge invalide">CARTE INVALIDE</span>
                @endif
            </div>
        </div>

    </div>

</div>

</body>
</html>
