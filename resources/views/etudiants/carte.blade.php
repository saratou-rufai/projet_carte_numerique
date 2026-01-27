@extends('layouts.app')

@section('contenu')

<style>
    /* === FORMAT CARTE RÉEL : 85mm x 54mm === */
    .carte-container {
        width: 85mm;
        height: 54mm;
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

    .statut {
        padding: 2mm;
        border-radius: 3mm;
        text-align: center;
        font-weight: 800;
        font-size: 3mm;
        color: #fff;
    }

    .statut.active { background: #00c12d83; }
    .statut.suspendue { background: #ff9900a4; }
    .statut.expiree { background: #ff001973; }

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

    /* ===== ZONE EN BAS (RADIOS + BOUTON) ===== */
    .actions-zone {
        width: 85mm;
        margin: 12px auto 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
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

    .status-group label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-print {
        padding: 10px 20px;
        font-size: 14px;
        border-radius: 25px;
        border: none;
        cursor: pointer;
        background: #2c3e50;
        color: #fff;
    }

    .toast {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #28a745;
        color: #fff;
        padding: 12px 16px;
        border-radius: 8px;
        font-weight: 700;
        display: none;
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
                    {{ \Carbon\Carbon::parse($carte->date_creation)->format('d-m-Y') }}
                </div>

                <div class="carte-info">
                    <strong>Date d'expiration</strong>
                    {{ \Carbon\Carbon::parse($carte->date_expiration)->format('d-m-Y') }}
                </div>
            </div>

            <div class="statut">
                @if($carte->statut === 'active')
                    <span class="statut active">🟢 ACTIVE</span>
                @elseif($carte->statut === 'suspendue')
                    <span class="statut suspendue">🟠 SUSPENDUE</span>
                @elseif($carte->statut === 'expiree')
                    <span class="statut expiree">🔴 EXPIREE</span>
                    @else
                    <span class="statut suspendue">Statut inconnu</span>
                @endif
            </div>

        </div>

        <div class="carte-right">
            <div class="qr-box">
                {!! QrCode::size(120)->generate($carte->token) !!}
            </div>
        </div>

    </div>

</div>

<!-- ===== RADIOS + BOUTON SOUS LA CARTE ===== -->
<div class="actions-zone">
<div class="status-group">
    <label>
        <input type="radio" name="statut" value="ACTIVE"
               onclick="changerStatut('ACTIVE')"
               {{ $carte->statut === 'ACTIVE' ? 'checked' : '' }}>
        Active
    </label>

    <label>
        <input type="radio" name="statut" value="SUSPENDUE"
               onclick="changerStatut('SUSPENDUE')"
               {{ $carte->statut === 'SUSPENDUE' ? 'checked' : '' }}>
        Suspendue
    </label>

    <label>
        <input type="radio" name="statut" value="EXPIREE"
               onclick="changerStatut('EXPIREE')"
               {{ $carte->statut === 'EXPIREE' ? 'checked' : '' }}>
        Expirée
    </label>
</div>
</div>



<button class="btn-print" onclick="window.print()">🖨️ Imprimer la carte</button>

</div>

<div class="toast" id="toast">Statut mis à jour avec succès ✔</div>

<script>
function showToast() {
    const toast = document.getElementById('toast');
    toast.style.display = 'block';
    setTimeout(() => toast.style.display = 'none', 2500);
}

function changerStatut(statut) {
    if (!confirm('Confirmer le changement de statut ?')) return;

    fetch("{{ route('cartes.statut', $carte->id) }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ statut })
    })
    .then(res => res.json())
    .then(data => {
        showToast();
        setTimeout(() => location.reload(), 1200);
    });
}
</script>

@endsection
