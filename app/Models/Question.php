<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'image',
        'note',
        'type',
        'examenID'
    ];

    public function examen()
    {
        return $this->belongsTo(Examen::class, 'examenID');
    }

    public function reponses()
    {
        return $this->hasMany(Reponse::class, 'questionID');
    }
}
