<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>connexion</title>

    <style>
        body {
            margin: 0;
            height: 100vh;
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #63b4ff, #a99f35);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 460px;
            background: #ffffffbc;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.41);
        }

        .login-box h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #0078bd;
        }

        .alert {
            background: #ffcdd2;
            color: #000;
            font-size: 13px;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .alert ul {
            margin: 0;
            padding-left: 18px;
        }

        .form-group {
            position: relative;
            margin-bottom: 22px;
            width: 87%;
        }

        .form-group img {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            opacity: 0.65;
        }

        .form-group input {
            width: 100%;
            padding: 11px 12px 11px 57px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 21px;
            color: #00639d;
            background-color: #ffffffc5;
        }

        .form-group input:focus {
            outline: none;
            border-color: #0078bd;
            box-shadow: 0 0 0 2px #70cbffa4;
        }

        button {
            width: 73%;
            padding: 9px;
            background-color: #0085d2;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 22px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0065a0;
        }

        .btn {
            text-align: center;
        }

        .links {
            text-align: center;
            margin-top: 22px;
        }

        .links a {
            display: block;
            margin: 6px 0;
            font-size: 15px;
            color: #0057a2;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h1>___ CONNEXION ___</h1>

    @if(session('error'))
        <div class="alert">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <img src="{{ asset('icones/user.png') }}" alt="Utilisateur">
            <input type="email" name="email" placeholder="Adresse email" required>
        </div>

        <div class="form-group">
            <img src="{{ asset('icones/pass.png') }}" alt="Mot de passe">
            <input type="password" name="password" placeholder="Mot de passe" required>
        </div>
        <div class="btn">
            <button type="submit">Se connecter</button>
        </div>
        
    </form>

    <div class="links">
        <a href="{{ route('users.creer') }}">Créer un compte</a>
        <a href="#">Mot de passe oublié ?</a>
    </div>
</div>

</body>
</html>
