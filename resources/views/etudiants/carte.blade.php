@extends('layouts.app')

@section('contenu')

<style>
    /* === FORMAT CARTE RÉEL : 85mm x 55mm === */
    .carte-container {
        width: 85mm;
        height: 50mm;
        margin: 30px auto;
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

    /* décor léger */
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

    /* ===== ENTÊTE ===== */
    .carte-header {
        text-align: center;
        font-size: 4.5mm;
        font-weight: 800;
        letter-spacing: 1px;
        margin-bottom: 3mm;
        text-transform: uppercase;
    }

    .carte-num {
        text-align: center;
        font-size: 4.3mm;
        opacity: 0.9;
        margin-bottom: 4mm;
    }

    /* ===== CORPS ===== */
    .carte-body {
        flex: 1;
        display: flex;
        gap: 4mm;
    }

    .carte-left {
        width: 55%;
        text-align: center;
        background: rgba(255,255,255,0.15);
        border-radius: 4mm;
        padding: 3mm;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        font-size: 3.3mm;
    }

    .carte-info {
        margin-bottom: 2.3mm;
    }

    .carte-info strong {
        display: block;
        font-size: 2.6mm;
        opacity: 0.85;
    }

    /* ===== STATUT ===== */
    .statut {
        padding: 2mm;
        border-radius: 3mm;
        text-align: center;
        font-weight: 800;
        font-size: 3mm;
        color: #fff;
    }

    .statut.active { background: #28a745; }
    .statut.suspendue { background: #ff9800; }
    .statut.expiree { background: #dc3545; }

    /* ===== QR ===== */
    .carte-right {
        width: 45%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qr-box {
        width: 30mm;
        height: 30mm;
        background: #fff;
        border-radius: 3mm;
        padding: 1.5mm;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ===== PIED ===== */
    .carte-footer {
        margin-top: 2mm;
        font-size: 2.5mm;
        text-align: center;
        opacity: 0.85;
    }
</style>

<div class="carte-container">

    <div class="carte-header">
        CARTE D'ÉTUDIANT NUMÉRIQUE
    </div>

    <div class="carte-num">
        N° {{ $carte->numero }}
    </div>

    <div class="carte-body">

        <div class="carte-left">
            <div>
                <div class="carte-info">
                    <strong>Date de création</strong>
                    {{ \Carbon\Carbon::parse($carte->date_creation_carte)->format('d-m-Y') }}
                </div>

                <div class="carte-info">
                    <strong>Date d'expiration</strong>
                    {{ \Carbon\Carbon::parse($carte->date_expiration_carte)->format('d-m-Y') }}
                </div>
            </div>

            <div class="statut
                {{ $carte->statut == 'ACTIVE' ? 'active' : '' }}
                {{ $carte->statut == 'SUSPENDUE' ? 'suspendue' : '' }}
                {{ $carte->statut == 'EXPIREE' ? 'expiree' : '' }}">
                {{ $carte->statut }}
            </div>
        </div>

        <div class="carte-right">
            <div class="qr-box">
                {!! QrCode::size(120)->generate($carte->token) !!}
            </div>
        </div>

    </div>

    <div class="carte-footer">
        Cette carte est la propriété privée de son détenteur
    </div>

</div>

@endsection
