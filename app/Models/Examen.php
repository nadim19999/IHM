<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'nombreQuestion',
        'duree',
        'formationSessionID'
    ];

    public function formationSession()
    {
        return $this->belongsTo(FormationSession::class, 'formationSessionID');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'examenID');
    }
}
