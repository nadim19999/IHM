<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormationSession;

class FormationSessionSeeder extends Seeder
{
    public function run()
    {
        FormationSession::create([
            'dateDebut' => '2025-04-01',
            'dateFin' => '2025-04-15',
            'statut' => 'Planifiée',
            'capacite' => 10,
            'nombreCours' => 10,
            'formationID' => 1,
            'formateurID' => 2
        ]);

        FormationSession::create([
            'dateDebut' => '2025-05-01',
            'dateFin' => '2025-05-15',
            'statut' => 'Planifiée',
            'capacite' => 10,
            'nombreCours' => 15,
            'formationID' => 2,
            'formateurID' => 2
        ]);
    }
}