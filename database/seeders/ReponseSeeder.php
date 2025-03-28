<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reponse;

class ReponseSeeder extends Seeder
{
    public function run()
    {
        Reponse::create([
            'texte' => 'C\'est un langage de balisage utilisé pour structurer le contenu des pages web.',
            'statut' => true,
            'questionID' => 1
        ]);

        Reponse::create([
            'texte' => 'C\'est un langage de programmation.',
            'statut' => false,
            'questionID' => 1
        ]);

        Reponse::create([
            'texte' => 'C\'est un framework de développement.',
            'statut' => false,
            'questionID' => 1
        ]);

        Reponse::create([
            'texte' => 'C\'est un système de gestion de base de données.',
            'statut' => false,
            'questionID' => 1
        ]);

        Reponse::create([
            'texte' => 'C\'est un langage utilisé pour définir le style des pages web.',
            'statut' => true,
            'questionID' => 2
        ]);

        Reponse::create([
            'texte' => 'C\'est un langage de programmation.',
            'statut' => false,
            'questionID' => 2
        ]);

        Reponse::create([
            'texte' => 'C\'est un outil de gestion de base de données.',
            'statut' => false,
            'questionID' => 2
        ]);

        Reponse::create([
            'texte' => 'C\'est un framework.',
            'statut' => false,
            'questionID' => 2
        ]);

        Reponse::create([
            'texte' => '<a>',
            'statut' => true,
            'questionID' => 3
        ]);

        Reponse::create([
            'texte' => '<div>',
            'statut' => false,
            'questionID' => 3
        ]);

        Reponse::create([
            'texte' => '<span>',
            'statut' => false,
            'questionID' => 3
        ]);

        Reponse::create([
            'texte' => '<link>',
            'statut' => false,
            'questionID' => 3
        ]);

        Reponse::create([
            'texte' => 'C\'est une bibliothèque JavaScript pour la création d\'interfaces utilisateurs.',
            'statut' => true,
            'questionID' => 4
        ]);

        Reponse::create([
            'texte' => 'C\'est un langage de programmation.',
            'statut' => false,
            'questionID' => 4
        ]);

        Reponse::create([
            'texte' => 'C\'est un framework de gestion de base de données.',
            'statut' => false,
            'questionID' => 4
        ]);

        Reponse::create([
            'texte' => 'C\'est un outil de développement mobile.',
            'statut' => false,
            'questionID' => 4
        ]);

        Reponse::create([
            'texte' => 'En utilisant une fonction ou une classe JavaScript.',
            'statut' => true,
            'questionID' => 5
        ]);

        Reponse::create([
            'texte' => 'En utilisant une balise HTML.',
            'statut' => false,
            'questionID' => 5
        ]);

        Reponse::create([
            'texte' => 'En utilisant une API JavaScript.',
            'statut' => false,
            'questionID' => 5
        ]);

        Reponse::create([
            'texte' => 'En utilisant une bibliothèque CSS.',
            'statut' => false,
            'questionID' => 5
        ]);

        Reponse::create([
            'texte' => 'Elle affiche le contenu d\'un composant à l\'écran.',
            'statut' => true,
            'questionID' => 6
        ]);

        Reponse::create([
            'texte' => 'Elle modifie l\'état du composant.',
            'statut' => false,
            'questionID' => 6
        ]);

        Reponse::create([
            'texte' => 'Elle envoie des données à un autre composant.',
            'statut' => false,
            'questionID' => 6
        ]);

        Reponse::create([
            'texte' => 'Elle effectue des calculs mathématiques.',
            'statut' => false,
            'questionID' => 6
        ]);
    }
}