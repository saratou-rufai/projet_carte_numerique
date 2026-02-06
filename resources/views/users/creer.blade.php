<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un administrateur</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            height: 100vh;
            overflow: hidden;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            font-size: 19px;
            background: linear-gradient(135deg, #a99f35, #63b4ff);
        }

        .page_container {
            margin-top: 5px;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 800px; /* DESKTOP FIXE */
            background: #ffffffbb;
            padding: 45px 60px;
            border-radius: 16px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.18);
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #2f3e46;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .alert {
            background-color: #fdecea;
            color: #8a1f11;
            border-left: 6px solid #e53935;
            border-radius: 10px;
            padding: 18px 22px;
            margin-bottom: 35px;
            font-size: 16px;
        }

        .alert ul {
            margin: 5px 0 0 10px;
        }

        .form-table {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-row {
            display: flex;
            align-items: center;
        }

        .form-row label {
            width: 300px; /* ALIGNEMENT DESKTOP */
            font-weight: 500;
            color: #444;
        }

        .form-row input {
            width: 100%;
            padding: 10px 15px;
            font-size: 18px;
            border-radius: 10px;
            border: 1px solid #ccc;
            transition: all 0.25s ease;
        }

        .form-row input:focus {
            outline: none;
            border-color: #5b9cda;
            box-shadow: 0 0 0 3px rgba(39, 99, 126, 0.25);
        }

        .actions {
            margin-top: 45px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .btn-primary {
            width: 50%;
            background: #296fd2;
            border: none;
            padding: 12px;
            font-size: 18px;
            font-weight: 500;
            color: #fff;
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(76, 175, 80, 0.35);
        }

        .btn-secondary {
            width: 50%;
            background: #9e9e9e;
            padding: 12px;
            font-size: 18px;
            border-radius: 12px;
            text-align: center;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s;
        }

        .btn-secondary:hover {
            background: #7e7e7e;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="page_container">
    <div class="container">
        <h1>Créer un compte administrateur</h1>

        {{-- Messages d'erreurs --}}
        @if ($errors->any())
            <div class="alert">
                <strong>Attention :</strong> veuillez corriger les erreurs suivantes :
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.enregistrer') }}" method="POST">
            @csrf

            <div class="form-table">
                <div class="form-row">
                    <label for="nom">Nom : </label>
                    <input type="text" name="nom" id="nom" required autocomplete="off">
                </div>

                <div class="form-row">
                    <label for="prenom">Prénom : </label>
                    <input type="text" name="prenom" id="prenom" required autocomplete="off">
                </div>

                <div class="form-row">
                    <label for="email">Email : </label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="form-row">
                    <label for="password">Mot de passe : </label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="form-row">
                    <label for="password_confirmation">Confirmation : </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                </div>
            </div>

            <input type="hidden" name="role" value="admin">

            <div class="actions">
                <button type="submit" class="btn-primary">Créer</button>
                <a href="{{ route('login') }}" class="btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
