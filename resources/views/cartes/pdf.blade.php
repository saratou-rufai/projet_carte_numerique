<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Carte Étudiant</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; /* centre horizontalement */
            align-items: flex-start; /* descend un peu */
            height: 100vh;
            background: #fff;
        }

        .carte-container {
            width: 100mm;
            height: 63mm;
            padding: 5mm;
            background: linear-gradient(135deg, #674d00, #467e35);
            border-radius: 5mm;
            box-shadow: 0 12px 30px rgba(0,0,0,0.5);
            color: #fff;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            margin-top: 20px; /* un peu de marge en haut */
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
            position: relative;
        }

        .carte-info {
            margin-bottom: 2mm;
        }

        .carte-info strong {
            display: block;
            font-size: 3mm;
            opacity: 0.85;
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
            border-radius: 3mm;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }
    </style>
</head>
<body>

<div class="carte-container">
    <div class="carte-header">CARTE D'ÉTUDIANT NUMÉRIQUE</div>

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

</body>
</html>
