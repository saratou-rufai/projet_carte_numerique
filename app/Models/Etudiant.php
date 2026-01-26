<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'ine',
        'nom',
        'prenom',
        'email',
        'filiere_id',
        'niveau_id',
        'annee_id',
        'photo',
    ];

    // Relations
    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function anneeAcademique()
    {
        return $this->belongsTo(AnneeAcademique::class);
    }

    public function carte()
    {
        return $this->hasOne(Carte::class);
    }
}
