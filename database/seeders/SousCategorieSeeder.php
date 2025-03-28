<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SousCategorie;

class SousCategorieSeeder extends Seeder
{
    public function run()
    {
        SousCategorie::create(['nomSousCategorie' => 'Frontend', 'categorieID' => 1]);
        SousCategorie::create(['nomSousCategorie' => 'Backend', 'categorieID' => 1]);
        SousCategorie::create(['nomSousCategorie' => 'Machine Learning', 'categorieID' => 2]);
        SousCategorie::create(['nomSousCategorie' => 'Deep Learning', 'categorieID' => 2]);
        SousCategorie::create(['nomSousCategorie' => 'Traitement du Langage Naturel', 'categorieID' => 2]);
        SousCategorie::create(['nomSousCategorie' => 'Sécurité des Réseaux', 'categorieID' => 3]);
        SousCategorie::create(['nomSousCategorie' => 'Sécurité des Systèmes', 'categorieID' => 3]);
        SousCategorie::create(['nomSousCategorie' => 'Hacking Éthique', 'categorieID' => 3]);
    }
}