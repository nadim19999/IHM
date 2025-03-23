<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomCategorie'
    ];

    public function sousCategories()
    {
        return $this->hasMany(SousCategorie::class, 'categorieID');
    }
}