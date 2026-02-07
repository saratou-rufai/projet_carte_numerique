@extends('layouts.app')

@section('contenu')
<style>
    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
    }

    .page_container {
        width: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 0;
    }

    .container {
        width: 800px; /* même esprit que création utilisateur */
        background-color: #fff;
        padding: 45px 60px;
        border-radius: 14px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }

    h1 {
        text-align: center;
        margin-bottom: 40px;
        color: #2f3e46;
        font-size: 28px;
        font-weight: 600;
    }

    .alert {
        background-color: #fdecea;
        color: #8a1f11;
        border-left: 6px solid #e53935;
        border-radius: 8px;
        padding: 16px 20px;
        margin-bottom: 30px;
        font-size: 15px;
    }

    .alert ul {
        margin: 10px 0 0 20px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .form-group {
        display: flex;
        align-items: center;
        gap: 25px;
    }

    .form-group label {
        width: 260px;
        font-weight: 500;
        color: #444;
    }

    .form-group input,
    .form-group select {
        flex: 1;
        padding: 12px 14px;
        font-size: 16px;
        border-radius: 8px;
        border: 1px solid #ccc;
        transition: 0.25s;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 0 3px rgba(76,175,80,0.25);
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 35px;
    }

    .btn {
        padding: 14px 28px;
        font-size: 16px;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        border: none;
        text-decoration: none;
        text-align: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4CAF50, #43a047);
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #43a047, #388e3c);
    }

    .btn-secondary {
        background-color: #9e9e9e;
        color: #fff;
    }

    .btn-secondary:hover {
        background-color: #7e7e7e;
    }
</style>

<div class="page_container">
    <div class="container">
        <h1>Créer un étudiant</h1>

        {{-- Messages d'erreur --}}
        @if ($errors->any())
            <div class="alert">
                <strong>Attention :</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('etudiants.enregistrer') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required>
            </div>

            <div class="form-group">
                <label for="filiere_id">Filière</label>
                <select name="filiere_id" id="filiere_id" required>
                    <option value="">-- Sélectionner une filière --</option>
                    @foreach ($filieres as $filiere)
                        <option value="{{ $filiere->id }}" @selected(old('filiere_id') == $filiere->id)>
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
                        <option value="{{ $niveau->id }}" @selected(old('niveau_id') == $niveau->id)>
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
                        <option value="{{ $annee->id }}" @selected(old('annee_id') == $annee->id)>
                            {{ $annee->libelle }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" name="photo" id="photo" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="validite_carte">Durée de validité (années)</label>
                <input type="number" name="validite_carte" id="validite_carte" min="1" required>
            </div>

            <div class="form-actions">
                <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Créer</button>
            </div>
        </form>
    </div>
</div>
@endsection
