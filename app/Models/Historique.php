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
        'date_action',
    ];

    public function carte()
    {
        return $this->belongsTo(Carte::class);
    }
}
