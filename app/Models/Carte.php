<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carte extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'etudiant_id',
        'token',
        'date_creation',
        'date_expiration',
        'statut',
        'qr_code',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
}
