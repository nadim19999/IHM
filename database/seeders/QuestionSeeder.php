<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        Question::create([
            'titre' => 'Qu\'est-ce que HTML ?',
            'image' => null,
            'note' => 1,
            'type' => 'seule réponse',
            'examenID' => 1
        ]);

        Question::create([
            'titre' => 'Qu\'est-ce que CSS ?',
            'image' => null,
            'note' => 1,
            'type' => 'seule réponse',
            'examenID' => 1
        ]);

        Question::create([
            'titre' => 'Quelle balise HTML est utilisée pour définir un lien ?',
            'image' => null,
            'note' => 1,
            'type' => 'seule réponse',
            'examenID' => 1
        ]);
        
        Question::create([
            'titre' => 'Qu\'est-ce que React ?',
            'image' => null,
            'note' => 1,
            'type' => 'seule réponse',
            'examenID' => 2
        ]);

        Question::create([
            'titre' => 'Comment créer un composant React ?',
            'image' => null,
            'note' => 1,
            'type' => 'seule réponse',
            'examenID' => 2
        ]);

        Question::create([
            'titre' => 'Que fait la méthode render() dans React ?',
            'image' => null,
            'note' => 1,
            'type' => 'seule réponse',
            'examenID' => 2
        ]);
    }
}