<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('titre', 'Carte Étudiant')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <header>
        <h1>Carte Étudiant Numérique</h1>
    </header>

    <main>
        @yield('contenu')
    </main>

</body>
</html>
