<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'videoURL',
        'formationSessionID'
    ];

    public function formationSession()
    {
        return $this->belongsTo(FormationSession::class, 'formationSessionID');
    }
}