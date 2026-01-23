@extends('layouts.app')

@section('contenu')
<style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
    .container { width: 400px; margin: 80px auto; padding: 20px; background-color: #fff; border: 1px solid #ddd; border-radius: 5px; }
    h1 { text-align: center; margin-bottom: 20px; }
    label { display: block; margin-bottom: 5px; }
    input[type="email"], input[type="password"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    button {
        width: 100%;
        padding: 15px;
        background-color: #4CAF50;
        font-size: 14px;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
    button:hover { background-color: #45a049; }
    .alert {
        padding: 10px;
        font-size: 13px;
        background-color: #ffbcb9;
        color: #000;
        margin-bottom: 15px;
        border-radius: 3px;
    }
</style>

<div class="container">
    <h1>Connexion</h1>

    @if(session('error'))
        <div class="alert">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Mot de passe</label>
        <input type="password" name="password" required>

        <button type="submit">Se connecter</button>
    </form>
</div>
@endsection
