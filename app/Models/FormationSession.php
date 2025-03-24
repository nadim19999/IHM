<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormationSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'dateDebut',
        'dateFin',
        'statut',
        'capacite',
        'nombreInscrits',
        'formationID',
        'formateurID'
    ];

    public function cours()
    {
        return $this->hasMany(Cour::class, 'formationSessionID');
    }

    public function candidats()
    {
        return $this->hasMany(User::class, 'formationSessionID');
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'formationID');
    }
}