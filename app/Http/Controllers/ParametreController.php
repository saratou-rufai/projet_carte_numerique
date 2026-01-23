<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Niveau;
use App\Models\AnneeAcademique;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    public function index()
    {
        return view('parametres.index', [
            'filieres' => Filiere::orderBy('libelle')->get(),
            'niveaux'  => Niveau::orderBy('libelle')->get(),
            'annees_academiques'   => AnneeAcademique::orderBy('libelle')->get(),
        ]);
    }
}
