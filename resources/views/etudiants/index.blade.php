@extends('layouts.app')

@section('contenu')

<style>
/* === Container principal === */
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

/* === Entête === */
.page-container h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
    font-size: 28px;
}

/* === Bloc supérieur === */
.list-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    flex-wrap: wrap;
    gap: 10px;
}

.list-footer .count {
    font-weight: 600;
    color: #555;
}

.list-footer .search {
    flex-grow: 1;
    text-align: center;
}

.list-footer input[type="text"] {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    width: 250px;
}

.list-footer input[type="text"]:focus {
    border-color: #4CAF50;
}

.list-footer .btn-add {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
}

.list-footer .btn-add:hover {
    background-color: #45a049;
}

/* === Table === */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table thead {
    background-color: #4CAF50;
    color: white;
}

table thead th {
    text-align: center;   /* entête centrée */
}

table th,
table td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
}

table tbody tr:hover {
    background-color: #f1f1f1;
}

/* === Actions === */
.actions {
    display: flex;
    justify-content: center;  /* alignement horizontal */
    align-items: center;      /* alignement vertical */
    gap: 6px;
}

/* === Boutons (DESIGN D’ORIGINE) === */
.btn-action {
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    color: white;
    transition: background-color 0.2s;
    border: none;
    cursor: pointer;
}

.btn-edit {
    background-color: #2196F3;
}
.btn-edit:hover {
    background-color: #0b7dda;
}

.btn-delete {
    background-color: #f44336;
}
.btn-delete:hover {
    background-color: #da190b;
}

.btn-carte {
    background-color: #FF9800;
    padding: 6px 18px; /* plus large */
}
.btn-carte:hover {
    background-color: #e68a00;
}

/* === Messages flash === */
.alert {
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 6px;
    font-size: 14px;
}
.alert-success {
    background-color: #d4edda;
    color: #155724;
}
.alert-error {
    background-color: #f8d7da;
    color: #721c24;
}
</style>

<div class="page-container">

    <h1>Liste des étudiants</h1>

    {{-- Messages flash --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    {{-- Bloc supérieur --}}
    <div class="list-footer">
        <div class="count">
            Total : {{ $etudiants->count() }} étudiant(s)
        </div>

        <div class="search">
            <form method="GET" action="{{ route('etudiants.index') }}">
                <input type="text" name="q" placeholder="Rechercher..." value="{{ request('q') }}">
            </form>
        </div>

        <div>
            <a href="{{ route('etudiants.inscrire') }}" class="btn-add">Ajouter un étudiant</a>
        </div>
    </div>

    {{-- Table des étudiants --}}
    <table>
        <thead>
            <tr>
                <th>INE</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>N° carte</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($etudiants as $etudiant)
            <tr>
                <td>{{ $etudiant->ine }}</td>
                <td>{{ $etudiant->nom }}</td>
                <td>{{ $etudiant->prenom }}</td>
                <td>{{ $etudiant->numero_carte ?? '-' }}</td>
                <td>
                    <div class="actions">
                    @if($etudiant->carte)
                    <a href="{{ route('etudiants.carte', $etudiant->carte->token) }}"
                    class="btn-action btn-carte">
                    Voir carte
                    </a>
                    @else
                    <span class="btn-action btn-carte" style="opacity:0.6; cursor:not-allowed;">
                    Carte non disponible
                    </span>
                    @endif

                        <form action="{{ route('etudiants.supprimer', $etudiant->id) }}"
                              method="POST" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn-action btn-delete"
                                    onclick="return confirm('Supprimer cet étudiant ?')">
                                🗑
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;">Aucun étudiant trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
