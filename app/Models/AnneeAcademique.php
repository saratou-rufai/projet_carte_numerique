<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeAcademique extends Model
{
    use HasFactory;

    // Nom exact de la table en base
    protected $table = 'annees_academiques';

    protected $fillable = [
        'libelle',
        // autres colonnes si besoin
    ];
}
