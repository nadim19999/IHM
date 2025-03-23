<?php

namespace App\Models;

use COM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousCategorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomSousCategorie',
        'categorieID'
    ];

    public function formations()
    {
        return $this->hasMany(Formation::class, 'sousCategorieID');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorieID');
    }
}