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
        width: 830px;
        max-width: 95%;
        height: auto;
        padding: 24px;
        border-radius: 27px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        text-align: center;
        display: flex;
        flex-direction: column;
        border: #ffffff 3px solid;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        overflow-y: auto;
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

    .no-photo {
        width: 373px;
        height: 373px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ecf0f1;
        color: #7f8c8d;
        border-radius: 27px;
        font-size: 24px;
        margin: 12px auto 18px;
    }

    /* CONTENEUR INFOS */
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
        margin: 12px 0;
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

    /* ZONE STATUT */
    .statut-bloc {
        display: flex;
        justify-content: center;
        margin-top: 20px;
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
        padding: 13px;
    }

    /* RESPONSIVE MOBILE */
    @media (max-width: 900px) {
        .card {
            width: 95%;
            padding: 16px;
        }

        .photo, .no-photo {
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

   <h1>CARTE D'ÉTUDIANT NUMÉRIQUE</h1>

   {{-- PHOTO --}}
   @if($etudiant->photo)
       <img src="{{ Storage::url($etudiant->photo) }}" class="photo" alt="Photo étudiant">
   @else
       <div class="no-photo">Aucune photo</div>
   @endif

   {{-- INFOS --}}
   <div class="info-table">
        <div class="info-row">
            <div class="info-label">Nom :</div>
            <div class="info-value"><strong>{{ $etudiant->nom ?? '-' }}</strong></div>
        </div>

        <div class="info-row">
            <div class="info-label">Prénom :</div>
            <div class="info-value"><strong>{{ $etudiant->prenom ?? '-' }}</strong></div>
        </div>

        <div class="info-row">
            <div class="info-label">Filière :</div>
            <div class="info-value"><strong>{{ $etudiant->filiere->libelle ?? '-' }}</strong></div>
        </div>

        <div class="info-row">
            <div class="info-label">Niveau :</div>
            <div class="info-value"><strong>{{ $etudiant->niveau->libelle ?? '-' }}</strong></div>
        </div>

        <div class="info-row">
            <div class="info-label">Année Académique :</div>
            <div class="info-value"><strong>{{ $etudiant->anneeAcademique->libelle ?? '-' }}</strong></div>
        </div>
   </div>

   {{-- STATUT --}}
   <div class="statut-bloc">
       @if($etudiant->carte && $etudiant->carte->statut === 'active')
           <span class="badge valide">CARTE VALIDE</span>
       @else
           <span class="badge invalide">CARTE INVALIDE</span>
       @endif
   </div>

</div>

</body>
</html>
