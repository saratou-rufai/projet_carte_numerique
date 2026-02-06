<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paramètres généraux</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #dbf1ff;
            margin: 35px;
            padding: 30px;
        }

        h1 { text-align: center; margin-bottom: 30px; }

        .container { max-width: 1000px; margin: auto; }

        .bloc {
            background: #e7f9ff;
            padding: 20px;
            margin-bottom: 55px;
            border-radius: 6px;
            box-shadow: 0 7px 13px rgba(0, 0, 0, 0.23);
        }

        .bloc h2 {
            text-align: center;
            margin-top: 0;
            border-bottom: 2px solid #6693c6;
            padding-bottom: 10px;
        }

        label { font-weight: bold; display: block; margin-bottom: 5px; }

        input[type="text"],
        input[type="number"] { width: 100%; padding: 8px; margin-bottom: 10px; border-radius: 4px; border: 1px solid #ccc; }

        button {
            padding: 8px 15px;
            background: #2c7be5;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover { background: #1a5fc4; }

        table { width: 100%; text-align: center; border-collapse: collapse; margin-top: 15px; }
        table th, table td { border: 1px solid #ddd; padding: 8px; }
        table th { background: #f0f0f0; }

        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #b52a37; }

        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px; }

        .actions form { display: inline-block; }
    </style>
</head>

<body>

<div class="container">
    <h1>Paramètres généraux</h1>

    {{-- MESSAGE SUCCÈS --}}
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    {{-- 🔹 DURÉE --}}
    <!-- <div class="bloc">
        <h2>Durée de validité des cartes</h2>
        <form method="POST" action="{{ route('parametres.duree.mettre_a_jour') }}">
            @csrf
            <label>Durée (en années)</label>
            <input type="number" name="duree_validite_carte"
                   value="{{ $parametre->duree_validite_carte ?? '' }}"
                   required min="1">
            <button type="submit">Valider</button>
        </form>
    </div> -->

    {{-- 🔹 FILIÈRES --}}
    <div class="bloc">
        <h2>Gestion des filières</h2>
        <form method="POST" action="{{ route('parametres.filieres.enregistrer') }}">
            @csrf
            <label>Nouvelle filière</label>
            <input type="text" name="libelle" required>
            <button type="submit">Ajouter</button>
        </form>

        <table>
            <tr>
                <th>Libellé</th>
                <th>Actions</th>
            </tr>
            @foreach($filieres as $filiere)
            <tr>
                <td>{{ $filiere->libelle }}</td>
                <td class="actions">
                    <form method="POST" action="{{ route('parametres.filieres.supprimer', $filiere->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-danger" onclick="return confirm('Supprimer cette filière ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    {{-- 🔹 NIVEAUX --}}
    <div class="bloc">
        <h2>Gestion des niveaux</h2>
        <form method="POST" action="{{ route('parametres.niveaux.enregistrer') }}">
            @csrf
            <label>Nouveau niveau</label>
            <input type="text" name="libelle" required>
            <button type="submit">Ajouter</button>
        </form>

        <table>
            <tr>
                <th>Libellé</th>
                <th>Actions</th>
            </tr>
            @foreach($niveaux as $niveau)
            <tr>
                <td>{{ $niveau->libelle }}</td>
                <td class="actions">
                    <form method="POST" action="{{ route('parametres.niveaux.supprimer', $niveau->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-danger" onclick="return confirm('Supprimer ce niveau ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    {{-- 🔹 ANNÉES ACADÉMIQUES --}}
    <div class="bloc">
        <h2>Gestion des années académiques</h2>
        <form method="POST" action="{{ route('parametres.annees_academiques.enregistrer') }}">
            @csrf
            <label>Nouvelle année académique</label>
            <input type="text" name="libelle" placeholder="Ex: 2025-2026" required>
            <button type="submit">Ajouter</button>
        </form>

        <table>
            <tr>
                <th>Libellé</th>
                <th>Actions</th>
            </tr>
            @foreach($annees_academiques as $annee)
            <tr>
                <td>{{ $annee->libelle }}</td>
                <td class="actions">
                    <form method="POST" action="{{ route('parametres.annees_academiques.supprimer', $annee->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-danger" onclick="return confirm('Supprimer cette année académique ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

</div>

</body>
</html>
