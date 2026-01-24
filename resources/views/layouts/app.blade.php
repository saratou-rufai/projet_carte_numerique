<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('titre', 'Carte Étudiant')</title>
    <style>
        /* ======== Style général ======== */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            margin: 0;
            min-height: 100vh;
        }

        /* ======== Header ======== */
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px 40px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        header h1 {
            margin: 0;
            font-size: 1.8rem;
            letter-spacing: 1px;
        }

        /* ======== Main ======== */
        main {
            display: flex;
            justify-content: center; /* centre horizontalement */
            align-items: center;     /* centre verticalement */
            padding: 40px 20px;
            min-height: calc(100vh - 80px); /* Ajuste selon la hauteur du header */
        }

        /* ======== Container ======== */
        .container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            max-width: 500px;
            width: 100%;
        }

        .container h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-size: 1.6rem;
        }

        /* ======== Formulaire ======== */
        .container form {
            display: grid;
            row-gap: 15px;
        }

        .container label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #555;
        }

        .container input[type="text"],
        .container input[type="email"],
        .container input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        .container button {
            background-color: #4CAF50;
            color: #fff;
            font-size: 1rem;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .container button:hover {
            background-color: #45a049;
        }

        .container .btn-secondary {
            background-color: #ddd;
            color: #333;
        }

        .container .btn-secondary:hover {
            background-color: #ccc;
        }

        /* ======== Alertes ======== */
        .alert {
            padding: 10px 15px;
            background-color: #ffbcb9;
            color: #000;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }

        /* ======== Responsive ======== */
        @media(max-width: 600px){
            .container {
                padding: 20px;
            }

            header h1 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>GESTION DE CARTES D'ETUDIANTS NUMERIQUES</h1>
    </header>

    <main>
        @yield('contenu')
    </main>

</body>
</html>
