@extends('layouts.app')

@section('contenu')

<style>
/* ================= CONTENEUR GLOBAL VERTICAL ================= */
.page-carte {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

/* ===================== PARTIE 1 : CARTE ===================== */
.carte-container {
    width: 100mm;
    height: 63mm;
    padding: 5mm;
    background: linear-gradient(135deg, #674d00, #467e35);
    border-radius: 5mm;
    box-shadow: 0 12px 30px rgba(0,0,0,0.5);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #fff;
    position: relative;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.carte-container::before {
    content: "";
    position: absolute;
    width: 60mm;
    height: 60mm;
    background: rgba(255,255,255,0.08);
    border-radius: 37%;
    top: -30mm;
    right: -25mm;
}

.carte-header {
    text-align: center;
    font-size: 5mm;
    font-weight: 800;
    letter-spacing: 1px;
    margin-bottom: 3mm;
    text-transform: uppercase;
}

.carte-num {
    text-align: center;
    font-size: 4.7mm;
    opacity: 0.9;
    margin-bottom: 4mm;
}

.carte-body {
    flex: 1;
    display: flex;
    gap: 4mm;
}

.carte-left {
    width: 50%;
    text-align: center;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4mm;
    padding: 5mm;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    font-size: 3.7mm;
}

.carte-info {
    margin-bottom: 2mm;
}

.carte-info strong {
    display: block;
    font-size: 3mm;
    opacity: 0.85;
}

/* ===== STATUT CARTE ===== */
.statut span {
    display: inline-block;
    padding: 2mm 4mm;
    border-radius: 3mm;
    font-weight: 800;
    font-size: 3mm;
}

.statut .active { background: #00c12d83; }
.statut .suspendue { background: #ff9900a4; }
.statut .expiree { background: #ff001973; }

.carte-right {
    width: 45%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.qr-box {
    width: 33mm;
    height: 33mm;
    background: #fff;
    border-radius: 3mm;
    padding: 1.5mm;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* ===================== PARTIE 2 : ACTIONS ===================== */
.actions-zone {
    width: 110mm;
    max-width: 95%;
    padding: 20px;
    margin-top: 30px;              /* espace entre la carte et la zone */
    background: #f4f6f8;
    border-radius: 10px;

    display: flex;
    flex-direction: column;
    align-items: center;
}

.status-group {
    display: flex;
    gap: 18px;
    justify-content: center;
    flex-wrap: nowrap;
    margin-bottom: 30px; /* espace entre radios et boutons */
}

.status-group label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    cursor: pointer;
}

/* Boutons centrés et alignés horizontalement */
.boutons {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: nowrap;
}

/* ================= PRINT PDF ================= */
@media print {
    body * {
        visibility: hidden; /* tout cacher */
    }

    .carte-container, .carte-container * {
        visibility: visible; /* afficher uniquement la carte */
    }

    .carte-container {
        position: absolute;
        left: 0;
        top: 0;
        margin: 0;
        width: 100mm;       /* largeur exacte de la carte */
        height: 63mm;       /* hauteur exacte de la carte */
        display: flex;       /* force flex pour garder le layout */
        flex-direction: column;
        padding: 5mm;
        box-shadow: none;    /* optionnel pour PDF propre */
        background: linear-gradient(135deg, #674d00, #467e35); /* force le fond */
        color: #fff;        /* texte visible */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .carte-container::before {
        content: "";
        position: absolute;
        width: 60mm;
        height: 60mm;
        background: rgba(255,255,255,0.08);
        border-radius: 37%;
        top: -30mm;
        right: -25mm;
    }
}

</style>

<div class="page-carte">

    {{-- ================= PARTIE SUPÉRIEURE : LA CARTE ================= --}}
    <div class="carte-container">

        <div class="carte-header">
            CARTE D'ÉTUDIANT NUMÉRIQUE
        </div>

        <div class="carte-num">
            ... ....... ....... ....... N° {{ $carte->numero }} ....... ....... ....... ...
        </div>

        <div class="carte-body">

            <div class="carte-left">
                <div>
                    <div class="carte-info">
                        <strong>Date de création</strong>
                        {{ \Carbon\Carbon::parse($carte->date_creation)->format('d-m-Y') }}
                    </div>

                    <div class="carte-info">
                        <strong>Date d'expiration</strong>
                        {{ \Carbon\Carbon::parse($carte->date_expiration)->format('d-m-Y') }}
                    </div>
                </div>

                <div class="statut">
                    <span class="{{ $carte->statut }}">
                        @if($carte->statut === 'active') 🟢 ACTIVE
                        @elseif($carte->statut === 'suspendue') 🟠 SUSPENDUE
                        @elseif($carte->statut === 'expiree') 🔴 EXPIREE
                        @endif
                    </span>
                </div>
            </div>

            <div class="carte-right">
                <div class="qr-box">
                    {!! QrCode::size(120)->generate($lien_public) !!}
                </div>
            </div>

        </div>
    </div>

    {{-- ================= PARTIE INFÉRIEURE : ACTIONS ================= --}}

<div class="actions-zone">

    <form method="POST" action="{{ route('cartes.statut', $carte->id) }}">
        @csrf

        <!-- Radios en haut -->
        <div class="status-group">
            <label>
                <input type="radio" name="statut" value="active"
                       {{ $carte->statut === 'active' ? 'checked' : '' }}>
                <b> Activer </b>
            </label>

            <label>
                <input type="radio" name="statut" value="suspendue"
                       {{ $carte->statut === 'suspendue' ? 'checked' : '' }}>
                <b> Suspendre </b>
            </label>

            <label>
                <input type="radio" name="statut" value="expiree"
                       {{ $carte->statut === 'expiree' ? 'checked' : '' }}>
                <b> Expirer </b>
            </label>
        </div>

    </form>

            <!-- Boutons en bas -->
        <div class="boutons">
            <!-- <button type="submit" class="btn-print">💾 Valider statut </button> -->
            <button type="button" class="btn-print" onclick="window.print()">🖨️ Imprimer la carte </button>
            
            <!-- <a href="{{ route('cartes.pdf.view', $carte) }}" class="btn-print">📄 Télécharger PDF</a> -->


            <form action="{{ route('vue_publique', $carte->qr_code) }}" method="GET" style="display:inline;">
            <button type="submit" class="btn-print">👁️ Afficher l'étudiant</button>
            </form>

        </div>

</div>

</div>

@endsection
