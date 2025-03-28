<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Categorie::create(['nomCategorie' => 'Développement Web']);
        Categorie::create(['nomCategorie' => 'Intelligence Artificielle']);
        Categorie::create(['nomCategorie' => 'Cybersécurité']);
    }
}
