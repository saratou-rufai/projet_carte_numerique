@extends('layouts.app')

@section('title', 'Détails de l’étudiant')

@section('contenu')

<div class="etudiant-wrapper">
    <div class="etudiant-card">
        <!-- TITRE DANS LE RECTANGLE -->
        <h2 class="page-title">🎓 Détails de l’étudiant</h2>

        <!-- SECTION PHOTO ET STATUT -->
        <div class="photo-section">
            {{-- PHOTO DE L'ÉTUDIANT --}}
            @if($etudiant->photo)
                <img src="{{ Storage::url($etudiant->photo) }}" alt="Photo étudiant" class="photo">
            @else
                <div class="no-photo">Aucune photo</div>
            @endif

            {{-- STATUT DE LA CARTE --}}
            <div class="carte-statut">
                @if($etudiant->carte)
                    @php
                        $statutCarte = $etudiant->carte->statut;
                        $statutClass = match($statutCarte) {
                            'active' => 'actif',
                            'suspendue' => 'suspendue',
                            'expiree' => 'expiree',
                            default => 'inactive',
                        };
                    @endphp
                    <span class="statut {{ $statutClass }}">
                        {{ strtoupper($statutCarte) }}
                    </span>
                @else
                    <span class="statut inactive">🔴 Carte non disponible</span>
                @endif
            </div>
        </div>

        <!-- SECTION INFOS -->
        <div class="infos-section">
            <p><span>INE</span> <b>{{ $etudiant->ine ?? '-' }}</b></p>
            <p><span>Nom</span> <b>{{ $etudiant->nom ?? '-' }}</b></p>
            <p><span>Prénom</span> <b>{{ $etudiant->prenom ?? '-' }}</b></p>
            <p><span>Filière</span> <b>{{ $etudiant->filiere->libelle ?? '-' }}</b></p>
            <p><span>Niveau</span> <b>{{ $etudiant->niveau->libelle ?? '-' }}</b></p>
            <p><span>Année académique</span> <b>{{ $etudiant->anneeAcademique->libelle ?? '-' }}</b></p>
        </div>
    </div>

    <!-- BOUTONS -->
    <div class="actions">
        <a href="{{ route('etudiants.modifier', $etudiant->id) }}" class="btn btn-primary">✏️ Modifier</a>
        @if($etudiant->carte)
            <a href="{{ route('etudiants.carte', $etudiant->carte->id) }}" class="btn btn-success">🖨️ Voir la carte</a>
        @endif
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

/* === CARTE PRINCIPALE === */
.etudiant-card {
    display: flex;
    gap: 30px;
    flex-direction: row;
    background: #ffffff;
    border-radius: 15px;
    padding: 60px 25px 25px 25px; /* 🔹 padding-top augmenté pour laisser plus d’espace au titre */
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    position: relative;
}

/* TITRE DANS LE RECTANGLE */
.page-title {
    position: absolute;
    top: 5px; /* 🔹 titre un peu plus en haut pour ne pas chevaucher */
    left: 50%;
    transform: translateX(-50%);
    font-size: 28px;
    font-weight: bold;
    color: #2c3e50;
}

/* === PHOTO === */
.photo-section {
    flex: 1;
    text-align: center;
}

.photo-section img {
    width: 150px;
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
    font-size: 14px;
    font-weight: 600;
}

/* Couleurs statut dynamiques */
.statut.actif { background-color: #d4edda; color: #155724; }
.statut.suspendue { background-color: #fff3cd; color: #856404; }
.statut.expiree { background-color: #f8d7da; color: #721c24; }
.statut.inactive { background-color: #f8d7da; color: #721c24; }

/* === INFOS === */
.infos-section {
    flex: 2;
    padding-left: 20px;
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
    margin-top: 25px;
    text-align: center;
}

.actions a {
    margin: 0 10px;
    padding: 10px 25px;
    font-size: 15px;
    border-radius: 25px;
    text-decoration: none;
    color: #fff;
    transition: 0.3s;
}

.btn-primary { background-color: #3498db; }
.btn-primary:hover { background-color: #217dbb; }

.btn-success { background-color: #2ecc71; }
.btn-success:hover { background-color: #27ae60; }
</style>

@endsection
