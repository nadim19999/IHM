<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'texte',
        'statut',
        'questionID'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'questionID');
    }
}
