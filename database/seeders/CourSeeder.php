<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cour;

class CourSeeder extends Seeder
{
    public function run()
    {
        Cour::create([
            'titre' => 'Introduction au HTML',
            'description' => 'Apprenez les bases du HTML, la structure d\'une page web, et comment créer des éléments comme les titres, paragraphes, et liens.',
            'videoURL' => '',
            'formationSessionID' => 1
        ]);

        Cour::create([
            'titre' => 'Introduction au CSS',
            'description' => 'Découvrez comment styliser votre page web avec CSS. Ce cours couvre les bases des styles, couleurs, polices et mise en page.',
            'videoURL' => '',
            'formationSessionID' => 1
        ]);

        Cour::create([
            'titre' => 'Comprendre le JSX en React',
            'description' => "Ce cours vous apprendra à utiliser JSX, la syntaxe qui permet d'écrire du HTML dans du JavaScript pour les composants React.",
            'videoURL' => '',
            'formationSessionID' => 2
        ]);

        Cour::create([
            'titre' => 'Gestion des États avec React',
            'description' => "Apprenez à gérer l'état des composants dans une application React, une compétence essentielle pour rendre votre application interactive.",
            'videoURL' => '',
            'formationSessionID' => 2
        ]);
    }
}