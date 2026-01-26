@extends('layouts.app')

@section('contenu')

<style>
    .carte-container {
        width: 850mm;
        height: 550mm;
        margin: 10px auto;
        padding: 20px;
        background: linear-gradient(135deg, #f0f4ff 0%, #ffffff 60%, #f9fbff 100%);
        border-radius: 18px;
        box-shadow: 0 10px 35px rgba(0,0,0,0.18);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow: hidden;
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .carte-container::before {
        content: "";
        position: absolute;
        width: 520px;
        height: 520px;
        background: rgba(70, 130, 180, 0.15);
        border-radius: 50%;
        top: -180px;
        right: -200px;
    }

    .carte-header {
        text-align: center;
        font-size: 34px;
        font-weight: 800;
        color: #1a3b6b;
        letter-spacing: 2px;
        margin-bottom: 10px;
    }

    .carte-num {
        text-align: center;
        font-size: 20px;
        color: #2a4a7d;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .carte-body {
        flex: 1;
        display: flex;
        justify-content: space-between;
        gap: 20px;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .carte-left {
        width: 55%;
        padding: 30px;
        border-radius: 18px;
        border: 1px solid rgba(0,0,0,0.08);
        background: rgba(255,255,255,0.85);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .carte-info {
        font-size: 20px;
        color: #2a3a56;
        margin-bottom: 25px;
    }

    .carte-info strong {
        color: #1a2a4a;
    }

    .statut {
        width: 100%;
        padding: 18px;
        border-radius: 14px;
        color: #fff;
        font-weight: 800;
        text-align: center;
        font-size: 22px;
    }

    .statut.active {
        background-color: #28a745;
    }

    .statut.suspendue {
        background-color: #ff9800;
    }

    .statut.expiree {
        background-color: #dc3545;
    }

    .carte-right {
        width: 40%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .qr-box {
        width: 360px;
        height: 360px;
        border-radius: 26px;
        border: 3px solid rgba(0,0,0,0.12);
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .carte-footer {
        text-align: center;
        font-size: 18px;
        color: #666;
        font-weight: 500;
        margin-top: 10px;
    }
</style>

<div class="carte-container">

    <div class="carte-header">
        CARTE D'ETUDIANT NUMERIQUE
    </div>

    <div class="carte-num">
        N° {{ $carte->numero }}
    </div>

    <div class="carte-body">

        {{-- Partie gauche --}}
        <div class="carte-left">
            <div>
                <div class="carte-info">
                    <strong>Date de création :</strong> {{ \Carbon\Carbon::parse($carte->date_creation_carte)->format('d-m-Y') }}
                </div>

                <div class="carte-info">
                    <strong>Date d'expiration :</strong> {{ \Carbon\Carbon::parse($carte->date_expiration_carte)->format('d-m-Y') }}
                </div>
            </div>

            {{-- Statut --}}
            <div class="statut
                {{ $carte->statut == 'ACTIVE' ? 'active' : '' }}
                {{ $carte->statut == 'SUSPENDUE' ? 'suspendue' : '' }}
                {{ $carte->statut == 'EXPIREE' ? 'expiree' : '' }}">
                {{ $carte->statut }}
            </div>
        </div>

        {{-- Partie droite --}}
        <div class="carte-right">
            <div class="qr-box">
                {!! QrCode::size(320)->generate($carte->token) !!}
            </div>
        </div>

    </div>

    <div class="carte-footer">
        ... Cette carte est la propriété privée de son détenteur ...
    </div>

</div>

@endsection
