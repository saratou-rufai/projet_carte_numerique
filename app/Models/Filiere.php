<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    // Table associée
     // Champs autorisés pour le mass assignment (create / update)
     //Relation : une filière possède plusieurs étudiants
    protected $table = 'filieres';
    protected $fillable = ['nom_filiere',];
    
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }
}
