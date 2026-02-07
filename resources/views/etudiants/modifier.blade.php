@extends('layouts.app')

@section('contenu')
<style>
    /* ===== Conteneur de page ===== */
    .container {
        width: 600px;
        max-width: 90%;
        background-color: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);

        /* Centre verticalement et horizontalement par rapport à la zone content du layout */
        margin: 50px auto;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
        font-size: 28px;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .form-group label {
        margin-bottom: 8px;
        font-weight: bold;
        color: #555;
    }

    .form-group input,
    .form-group select {
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 25px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #4CAF50;
        color: white;
    }

    .btn-primary:hover {
        background-color: #45a049;
    }

    .btn-secondary {
        background-color: #ccc;
        color: #333;
    }

    .btn-secondary:hover {
        background-color: #bbb;
    }

    .alert {
        padding: 12px;
        font-size: 14px;
        background-color: #ffbcb9;
        color: #000;
        margin-bottom: 20px;
        border-radius: 6px;
    }
</style>

<div class="container">
    <h1>Modifier l'étudiant</h1>

    {{-- Messages d'erreur --}}
    @if ($errors->any())
        <div class="alert">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('etudiants.mettre_a_jour', $etudiant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $etudiant->nom) }}" required>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $etudiant->prenom) }}" required>
        </div>

        <div class="form-group">
            <label for="filiere_id">Filière</label>
            <select name="filiere_id" id="filiere_id" required>
                <option value="">-- Sélectionner une filière --</option>
                @foreach ($filieres as $filiere)
                    <option value="{{ $filiere->id }}" 
                        {{ old('filiere_id', $etudiant->filiere_id) == $filiere->id ? 'selected' : '' }}>
                        {{ $filiere->libelle }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="niveau_id">Niveau</label>
            <select name="niveau_id" id="niveau_id" required>
                <option value="">-- Sélectionner un niveau --</option>
                @foreach ($niveaux as $niveau)
                    <option value="{{ $niveau->id }}" 
                        {{ old('niveau_id', $etudiant->niveau_id) == $niveau->id ? 'selected' : '' }}>
                        {{ $niveau->libelle }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="annee_id">Année académique</label>
            <select name="annee_id" id="annee_id" required>
                <option value="">-- Sélectionner une année --</option>
                @foreach ($annees_academiques as $annee)
                    <option value="{{ $annee->id }}" 
                        {{ old('annee_id', $etudiant->annee_id) == $annee->id ? 'selected' : '' }}>
                        {{ $annee->libelle }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo" accept="image/*">
            @if($etudiant->photo)
                <small>Photo actuelle : {{ $etudiant->photo }}</small>
            @endif
        </div>

        <div class="form-actions">
            <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
