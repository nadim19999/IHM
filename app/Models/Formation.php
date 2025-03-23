<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomFormation',
        'description',
        'niveau',
        'duree',
        'sousCategorieID'
    ];

    public function formationSessions()
    {
        return $this->hasMany(FormationSession::class, 'formationID');
    }

    public function sousCategorie()
    {
        return $this->belongsTo(SousCategorie::class, 'sousCategorieID');
    }
}