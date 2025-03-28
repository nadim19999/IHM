<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionProgression extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidatID',
        'formationSessionID',
        'progression',
        'courIDS'
    ];

    protected $casts = [
        'courIDs' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'candidatID');
    }

    public function formationSession()
    {
        return $this->belongsTo(FormationSession::class, 'formationSessionID');
    }
}
