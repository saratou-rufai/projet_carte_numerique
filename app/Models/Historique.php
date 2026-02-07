<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Historique extends Model
{
    use HasFactory;

    protected $table = 'historiques';

    protected $fillable = [
        'carte_id',
        'action',
        'motif', // ajouté pour ton champ optionnel
    ];

    /**
     * Relation avec la carte
     */
    public function carte()
    {
        return $this->belongsTo(Carte::class);
    }
}
