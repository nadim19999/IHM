<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Examen;

class ExamenSeeder extends Seeder
{
    public function run()
    {
        Examen::create([
            'titre' => 'Introduction à HTML et CSS',
            'nombreQuestion' => 10,
            'duree' => 60,
            'formationSessionID' => 1,
        ]);

        Examen::create([
            'titre' => 'Développement avec React.js',
            'nombreQuestion' => 10,
            'duree' => 60,
            'formationSessionID' => 2,
        ]);
    }
}