<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'texte',
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
