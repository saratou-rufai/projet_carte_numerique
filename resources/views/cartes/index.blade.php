@extends('layouts.app')

@section('contenu')

<style>
/* === Style Global inspiré de ton image === */
.page-container {
    width: 90%;
    max-width: none;
    margin: 50px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding: 0 10px;
}

.btn-dashboard {
    background-color: #63f1a5;
    color: white;
    text-decoration: none;
    padding: 8px 15px;
    border-radius: 4px;
    font-size: 14px;
}

/* === Table Style (Image) === */
.custom-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto;
    cursor: pointer; /* montre que la ligne est cliquable */
}

.custom-table thead th {
    font-size: 19px;
    background-color: #0090e3;
    color: white;
    padding: 12px;
    text-align: center;
    border: 1px solid #fff;
    font-weight: bold;
}

.custom-table tbody td {
    font-size: 19px;
    padding: 15px 12px;
    border-bottom: 1px solid #eee;
    vertical-align: middle;
    color: #333;
    text-align: center;
}

.custom-table tbody tr:hover {
    background-color: #f1f1f1; /* effet au survol */
}

/* Statut couleurs dynamiques */
.status-active {
    color: #5cc339; /* vert */
    font-weight: bold;
}

.status-inactive {
    color: orange; /* orange */
    font-weight: bold;
}

.status-expiree {
    color: red; /* 🔴 rouge pour expiré */
    font-weight: bold;
}

.qr-code-img {
    border: 1px solid #eee;
    padding: 5px;
    display: inline-block;
}

.section-title {
    font-size: 26px;
    font-weight: bold;
    color: #333;
    margin-bottom: 25px;
    text-align: center;
    width: 100%;
}
</style>

<div class="page-container">

    <h2 class="section-title">Liste des cartes</h2>

    <div class="toolbar">
        <div class="search-box">
            <!-- Recherche possible -->
        </div>
    </div>

    <table class="custom-table">
        <thead>
            <tr>
                <th style="width: 50px;">Ordre</th>
                <th>Numéro de carte</th>
                <th>Étudiant</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cartes as $carte)
                <tr data-url="{{ route('etudiants.afficher', $carte->etudiant->id ?? 0) }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ 'N' . str_pad($carte->numero, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $carte->etudiant->nom ?? '' }} {{ $carte->etudiant->prenom ?? '' }}</td>
                    <td>
                        @php
                            $statusClass = match($carte->statut) {
                                'active' => 'status-active',
                                'inactive' => 'status-inactive',
                                'expiree' => 'status-expiree',
                                default => 'status-inactive',
                            };
                        @endphp
                        <span class="{{ $statusClass }}">
                            {{ strtoupper($carte->statut) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 30px;">Aucune carte trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Ajoute l'événement click à toutes les lignes ayant data-url
    document.querySelectorAll('.custom-table tbody tr[data-url]').forEach(function(row) {
        row.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            if(url && url !== "{{ route('etudiants.afficher', 0) }}") {
                window.location.href = url;
            }
        });
    });
});
</script>

@endsection
