<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>vue publique </title>

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, #f0f4ff, #dbe4ff);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card {
        background: #fff;
        width: 420px;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        text-align: center;
    }

    .photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #4CAF50;
        margin-bottom: 15px;
    }

    h2 {
        margin: 10px 0;
        color: #333;
    }

    .ine {
        font-weight: bold;
        color: #555;
        margin-bottom: 20px;
    }

    .info {
        text-align: left;
        margin-top: 15px;
        font-size: 15px;
    }

    .info p {
        margin: 6px 0;
    }

    .badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: bold;
        margin-top: 20px;
        color: white;
    }

    .valid { background-color: #4CAF50; }
    .expired { background-color: #f44336; }

</style>
</head>

<body>
    <h1> VUE PUBLIQUE </h1> <hr>

<div class="card">

    <img src="{{ asset('storage/' . $etudiant->photo) }}" class="photo">

    <h2>{{ $etudiant->nom }} {{ $etudiant->prenom }}</h2>

    <div class="ine">INE : {{ $etudiant->ine }}</div>

    <div class="info">
        <p><strong>Filière :</strong> {{ $etudiant->filiere->libelle }}</p>
        <p><strong>Niveau :</strong> {{ $etudiant->niveau->libelle }}</p>
        <p><strong>Année :</strong> {{ $carte->etudiant->annee_academique->libelle ?? '-' }}</p>
        <p><strong>Carte créée le :</strong> {{ $carte->etudiant->date_creation ? \Carbon\Carbon::parse($carte->etudiant->date_creation)->format('d-m-Y') : '-' }}</p>
        <p><strong>Expire le :</strong> {{ $carte->etudiant->date_expiration ? \Carbon\Carbon::parse($carte->etudiant->date_expiration)->format('d-m-Y') : '-' }}</p>
    </div>



</div>

</body>
</html>

