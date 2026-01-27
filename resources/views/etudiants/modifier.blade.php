@extends('layouts.app')

@section('title', 'Modifier étudiant')

@section('contenu')
<h2>Modifier l’étudiant</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST"
      action="{{ route('etudiants.update', $etudiant->id) }}"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="ine">INE</label>
        <input type="text"
               name="ine"
               id="ine"
               class="form-control"
               value="{{ old('ine', $etudiant->ine) }}"
               required>
    </div>

    <div class="mb-3">
        <label for="nom">Nom</label>
        <input type="text"
               name="nom"
               id="nom"
               class="form-control"
               value="{{ old('nom', $etudiant->nom) }}"
               required>
    </div>

    <div class="mb-3">
        <label for="prenom">Prénom</label>
        <input type="text"
               name="prenom"
               id="prenom"
               class="form-control"
               value="{{ old('prenom', $etudiant->prenom) }}"
               required>
    </div>

    <div class="mb-3">
    <label for="filiere_id">Filière</label>
    <select name="filiere_id" id="filiere_id" class="form-control" required>
        @foreach($filieres as $filiere)
            <option value="{{ $filiere->id }}" {{ (old('filiere_id', $etudiant->filiere_id) == $filiere->id) ? 'selected' : '' }}>
                {{ $filiere->libelle }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="niveau_id">Niveau</label>
    <select name="niveau_id" id="niveau_id" class="form-control" required>
        @foreach($niveaux as $niveau)
            <option value="{{ $niveau->id }}" {{ (old('niveau_id', $etudiant->niveau_id) == $niveau->id) ? 'selected' : '' }}>
                {{ $niveau->libelle }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="annee_id">Année académique</label>
    <select name="annee_id" id="annee_id" class="form-control" required>
        @foreach($annees as $annee)
            <option value="{{ $annee->id }}" {{ $etudiant->annee_id == $annee->id ? 'selected' : '' }}>
                {{ $annee->libelle }}
            </option>
        @endforeach
    </select>
</div>

    <div class="mb-3">
        <label>Photo actuelle</label><br>
        @if($etudiant->photo)
            <img src="{{ asset('storage/' . $etudiant->photo) }}" width="120">
        @else
            <p>Aucune photo</p>
        @endif
    </div>

    <div class="mb-3">
        <label for="photo">Nouvelle photo (optionnel)</label>
        <input type="file" name="photo" id="photo" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Mettre à jour</button>
    <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">Annuler</a>
</form>

<style>

    .container-center {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 80vh; /* Ajuste la hauteur pour bien centrer verticalement */
}

h2 {
    text-align: center;
    color: #2d3748;
    font-weight: 800; /* Gras prononcé */
    font-family: 'Poppins', sans-serif; /* Font moderne */
    text-transform: uppercase;
    margin-bottom: 30px;
    letter-spacing: 2px;
    background: rgb(175, 234, 86)
}
/* Conteneur identique au Create */
form {
    background: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
    max-width: 400px;
    margin: 20px auto;
    border: 1px solid #46ad53;
}

h2 {
    text-align: center;
    color: #2d3748;
    text-transform: uppercase;
    font-weight: 300;
    margin-bottom: 25px;
    letter-spacing: 1px;
}

label {
    display: block;
    font-weight: 600;
    color: #4a5568;
    margin-bottom: 5px;
}

/* Champs de saisie */
.form-control {
    width: 100%;
    padding: 12px;
    border: 2px solid #edf2f7;
    border-radius: 13px; /* Votre style */
    background-color: #f8fafc;
    box-sizing: border-box; /* Empêche de dépasser du cadre */
    margin-bottom: 15px;
    display: block;
}

.form-control:focus {
    border-color: #48bb78;
    outline: none;
    background-color: #fff;
}

/* Alignement des boutons sur une ligne */
.btn-group {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-top: 10px;
}

.btn {
    flex: 1; /* Largeur égale pour les deux */
    padding: 12px;
    border-radius: 8px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: 0.3s;
}

.btn-success { background-color: #48bb78; color: white; }
.btn-secondary { background-color: #edf2f7; color: #4a5568; }

.btn:hover { opacity: 0.9; }

/* Aperçu de la photo actuelle */
.photo-preview {
    text-align: center;
    margin-bottom: 15px;
    padding: 10px;
    background: #f1f5f9;
    border-radius: 13px;
}
.photo-preview img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #46ad53;
}
</style>

@endsection