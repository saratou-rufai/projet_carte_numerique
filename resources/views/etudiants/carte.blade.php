@extends('layouts.app')

@section('contenu')

<style>
/* ================= CONTENEUR GLOBAL ================= */
.page-carte {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* ================= CARTE ================= */
.carte-container {
    width: 100mm;
    height: 63mm;
    padding: 5mm;
    border-radius: 5mm;
    box-shadow: 0 12px 30px rgba(0,0,0,0.5);
    color: #fff;
    position: relative;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    background-image: url("{{ asset('images/carte-back.jpg') }}");
    background-size: cover;
    background-position: center;
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
    margin-bottom: 3mm;
}

.carte-num {
    text-align: center;
    font-size: 4.7mm;
    margin-bottom: 4mm;
}

.carte-body {
    flex: 1;
    display: flex;
    gap: 4mm;
}

.carte-left {
    width: 50%;
    background: rgba(107, 63, 22, 0.33);
    border-radius: 4mm;
    padding: 5mm;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    font-size: 3.7mm;
    text-align: center;
}

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

/* ================= ACTIONS ================= */
.actions-zone {
    width: 110mm;
    max-width: 95%;
    padding: 20px;
    margin-top: 30px;
    background: #f4f6f8;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.status-group {
    display: flex;
    gap: 18px;
    margin-bottom: 25px;
}

.status-group label {
    cursor: pointer;
    font-weight: bold;
}

.boutons {
    display: flex;
    gap: 15px;
}

.boutons button,
.boutons a {
    padding: 8px 16px;
    border-radius: 6px;
    border: none;
    font-size: 14px;
    cursor: pointer;
    text-decoration: none;
    color: #fff;
    transition: 0.2s;
}

.boutons button:hover,
.boutons a:hover {
    opacity: 0.85;
}

.boutons button[type="submit"] { background: #28a745; } /* vert valider */
.boutons button.print-button { background: #3498db; }      /* bleu imprimer */
.boutons a { background: #6c757d; }                         /* gris voir */

/* ================= IMPRIMÉ ================= */
@media print {
    body * { visibility: hidden; }
    .carte-container, .carte-container * { visibility: visible; }
    .carte-container {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100mm;
        height: 63mm;
        transform: translate(-50%, -50%);
        box-shadow: none;
        overflow: hidden;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .actions-zone { display: none; } /* Cacher les boutons */
}
</style>

<div class="page-carte">

    {{-- ================= CARTE ================= --}}
    <div class="carte-container">
        <div class="carte-header">CARTE D'ÉTUDIANT NUMÉRIQUE</div>

        <div class="carte-num">
            N° {{ $carte->numero }}
        </div>

        <div class="carte-body">
            <div class="carte-left">
                <div>
                    Date de création<br>
                    {{ \Carbon\Carbon::parse($carte->date_creation)->format('d-m-Y') }}<br><br>

                    Date d'expiration<br>
                    {{ \Carbon\Carbon::parse($carte->date_expiration)->format('d-m-Y') }}
                </div>

                <div class="statut">
                    <span class="{{ $carte->statut }}">
                        {{ strtoupper($carte->statut) }}
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

    {{-- ================= ACTIONS ================= --}}
    <div class="actions-zone">

        <form id="statutForm" method="POST" action="{{ route('cartes.statut', $carte->id) }}">
            @csrf

            {{-- Radios pour changer le statut --}}
            <div class="status-group">
                <label>
                    <input type="radio" name="statut" value="active" {{ $carte->statut === 'active' ? 'checked' : '' }}>
                    Activer
                </label>

                <label>
                    <input type="radio" name="statut" value="suspendue" {{ $carte->statut === 'suspendue' ? 'checked' : '' }}>
                    Suspendre
                </label>

                <label>
                    <input type="radio" name="statut" value="expiree" {{ $carte->statut === 'expiree' ? 'checked' : '' }}>
                    Expirer
                </label>
            </div>

            {{-- Boutons --}}
            <div class="boutons">
                <button type="button" class="print-button" onclick="window.print()">🖨️ Imprimer carte</button>
                <a href="{{ route('vue_publique', $carte->qr_code) }}" target="_blank">👁️ Voir étudiant</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('statutForm');
    let statutInitial = document.querySelector('input[name="statut"]:checked').value;

    document.querySelectorAll('input[name="statut"]').forEach(radio => {
        radio.addEventListener('click', function (e) {
            if (this.value === statutInitial) return;
            e.preventDefault();

            if (confirm("Confirmer le changement vers " + this.value.toUpperCase() + " ?")) {
                this.checked = true;
                statutInitial = this.value;
                form.submit();
            } else {
                document.querySelectorAll('input[name="statut"]').forEach(r => {
                    r.checked = (r.value === statutInitial);
                });
            }
        });
    });
});
</script>

@endsection
