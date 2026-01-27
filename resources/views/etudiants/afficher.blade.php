@extends('layouts.app')

@section('title', 'Détails de l’étudiant')

@section('contenu')

<div class="etudiant-wrapper">
    <h2 class="page-title">🎓 Détails de l’étudiant</h2>

    <div class="etudiant-card">
        <div class="photo-section">
            @if($etudiant->photo)
                <img src="{{ asset('storage/' . $etudiant->photo) }}" alt="Photo étudiant">
            @else
                <div class="no-photo">Aucune photo</div>
            @endif

            {{-- STATUT DE LA CARTE --}}
            <div class="carte-statut">
                @if($etudiant->carte)
                    <span class="statut actif">🟢 Carte active</span>
                @else
                    <span class="statut inactive">🔴 Carte non disponible</span>
                @endif
            </div>
        </div>

        <div class="infos-section">
            <p><span>INE</span> <b>{{ $etudiant->ine }}</b></p>
            <p><span>Nom</span> <b>{{ $etudiant->nom }}</b></p>
            <p><span>Prénom</span> <b>{{ $etudiant->prenom }}</b></p>
            <p><span>Filière</span> <b>{{ $etudiant->filiere->libelle }}</b></p>
            <p><span>Niveau</span> <b>{{ $etudiant->niveau->libelle }}</b></p>
            <p><span>Année académique</span> <b>{{ $etudiant->annee_academique?->libelle ?? '-' }}</b></p>
        </div>
    </div>

    <div class="actions">
        <a href="{{ route('etudiants.modifier', $etudiant->id) }}" class="btn btn-primary">✏️ Modifier</a>
        <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">⬅️ Retour</a>
    </div>
</div>

<style>
/* === CONTAINER GLOBAL === */
.etudiant-wrapper {
    max-width: 1200px;
    margin: 40px auto;
    padding: 10px;
    font-family: 'Segoe UI', Tahoma, sans-serif;
}

/* === TITRE === */
.page-title {
    text-align: center;
    margin-bottom: 30px;
    color: #2c3e50;
}

/* === CARTE PRINCIPALE === */
.etudiant-card {
    display: flex;
    gap: 30px;
    background: #ffffff;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

/* === PHOTO === */
.photo-section {
    flex: 1;
    text-align: center;
}

.photo-section img {
    width: 150px;          /* ↓ taille réduite */
    height: 175px;
    object-fit: cover;
    border-radius: 10px;
    border: 3px solid #3498db;
}

.no-photo {
    width: 150px;
    height: 175px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ecf0f1;
    color: #7f8c8d;
    border-radius: 10px;
    font-size: 14px;
}

/* === STATUT CARTE === */
.carte-statut {
    margin-top: 12px;
}

.statut {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

.statut.actif {
    background-color: #d4edda;
    color: #155724;
}

.statut.inactive {
    background-color: #f8d7da;
    color: #721c24;
}

/* === INFOS === */
.infos-section {
    flex: 2;
}

.infos-section p {
    font-size: 16px;
    margin: 12px 0;
    padding-bottom: 8px;
    border-bottom: 1px dashed #ddd;
}

.infos-section span {
    display: inline-block;
    width: 180px;
    font-weight: 600;
    color: #34495e;
}

/* === BOUTONS === */
.actions {
    margin-top: 30px;
    text-align: center;
}

.actions a {
    margin: 0 10px;
    padding: 10px 25px;
    font-size: 15px;
    border-radius: 25px;
}
</style>

@endsection
