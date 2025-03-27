<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
    use HasFactory;

    protected $fillable = [
        'dateObtention',
        'note',
        'statut',
        'formationSessionID',
        'candidatID'
    ];

    public function formationSession()
    {
        return $this->belongsTo(FormationSession::class, 'formationSessionID');
    }

    public function candidat()
    {
        return $this->belongsTo(User::class, 'candidatID');
    }

}