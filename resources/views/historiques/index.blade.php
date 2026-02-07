@extends('layouts.app')

@section('contenu')

<div class="historique-wrapper">

    <div class="historique-card">

        <h1 class="page-title">Historique des actions sur les cartes</h1>

        <div class="table-responsive">
            <table class="table historique-table">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Concerné</th>
                        <th>Date</th>
                        <th>Voir</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($historiques as $historique)
                        <tr>
                            {{-- Action lisible --}}
                            
                            <td>
                        @switch($historique->action)
                            @case('activation')
                                <span style="color: #28a745; font-weight: 600;">Activation</span>
                                @break
                            @case('suspension')
                                <span style="color: #fd7e14; font-weight: 600;">Suspension</span>
                                @break
                            @case('expiration')
                                <span style="color: #dc3545; font-weight: 600;">Expiration</span>
                                @break
                            @default
                                <span>{{ ucfirst($historique->action) }}</span>
                        @endswitch
                            </td>


                            {{-- Concerné --}}
                            <td>
                                @if($historique->carte && $historique->carte->etudiant)
                                    {{ $historique->carte->etudiant->nom }}
                                    {{ $historique->carte->etudiant->prenom }}
                                @else
                                    <em>Carte ou étudiant supprimé</em>
                                @endif
                            </td>

                            {{-- Date --}}
                            <td>
                                {{ $historique->created_at->format('d/m/Y H:i') }}
                            </td>

                            {{-- Voir étudiant --}}
                            <td>
                                @if($historique->carte && $historique->carte->etudiant)
                                    <a href="{{ route('etudiants.afficher', $historique->carte->etudiant->id) }}"
                                       class="btn btn-sm btn-primary btn-voir">
                                        👁 Voir étudiant
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Aucune action enregistrée
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<style>
/* === CONTAINER GLOBAL === */
.historique-wrapper {
    max-width: 1200px;
    margin: 10px auto;
    padding: 10px;
    font-family: 'Segoe UI', Tahoma, sans-serif;
}

/* === TITRE === */
.page-title {
    text-align: center;
    margin-bottom: 25px;
    color: #2c3e50;
}

/* === CARTE BLANCHE === */
.historique-card {
    font-size: 18px;
    background: #ffffffb5;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

/* === TABLE === */
.historique-table {
    width: 100%;
    margin-bottom: 0;
    border-collapse: collapse;
}

.historique-table thead {
    background-color: #3498db;
    color: white;
    font-size: 19px;
}

.historique-table thead tr {
    border-bottom: 2px solid #2980b9;
}

.historique-table th {
    text-align: center;
    font-weight: 600;
}

/* === CELLULES === */
.historique-table th,
.historique-table td {
    padding: 16px 12px;
    line-height: 15px;
    text-align: center;
    vertical-align: middle;
}

/* === LIGNES HORIZONTALES VISIBLES === */
.historique-table tbody tr {
    border-bottom: 1px solid #dee2e6;
}

.historique-table tbody tr:hover {
    background-color: #f8f9fa;
}

/* === BOUTON VOIR === */
.btn-voir {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.2s ease-in-out;
    background-color: #3a82cb;
    text-decoration: none;
    color:#ffffff
}

.btn-voir:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    background-color: #27639e;
    text-decoration: none;
    color:#ffffff
}
</style>

@endsection
