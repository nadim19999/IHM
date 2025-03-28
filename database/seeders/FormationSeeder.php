<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Formation;

class FormationSeeder extends Seeder
{
    public function run()
    {
        Formation::create([
            'nomFormation' => 'Introduction à HTML et CSS',
            'description' => 'Apprenez les bases du développement web avec HTML et CSS pour créer des pages web attrayantes',
            'niveau' => 'Débutant',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 21,
            "sousCategorieID" => 1
        ]);

        Formation::create([
            'nomFormation' => 'Développement avec React.js',
            'description' => 'Maîtrisez React.js pour créer des applications web modernes et dynamiques',
            'niveau' => 'Intermédiaire',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 35,
            "sousCategorieID" => 1
        ]);

        Formation::create([
            'nomFormation' => 'Responsive Design avec Bootstrap',
            'description' => 'Apprenez à créer des sites web adaptatifs avec le framework Bootstrap',
            'niveau' => 'Intermédiaire',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 35,
            "sousCategorieID" => 1
        ]);

        Formation::create([
            'nomFormation' => 'Introduction à Node.js',
            'description' => 'Apprenez les bases de Node.js pour créer des applications backend rapides et scalables',
            'niveau' => 'Débutant',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 21,
            "sousCategorieID" => 2
        ]);

        Formation::create([
            'nomFormation' => 'Développement Backend avec Express.js',
            'description' => 'Maîtrisez Express.js pour créer des API RESTful robustes et efficaces',
            'niveau' => 'Intermédiaire',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 35,
            "sousCategorieID" => 2
        ]);

        Formation::create([
            'nomFormation' => 'Backend avec PHP et Laravel',
            'description' => 'Apprenez à créer des applications backend sécurisées et performantes avec PHP et Laravel',
            'niveau' => 'Avancé',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 42,
            "sousCategorieID" => 2
        ]);

        Formation::create([
            'nomFormation' => 'Introduction au Machine Learning',
            'description' => 'Apprenez les bases du Machine Learning et découvrez les algorithmes les plus utilisés',
            'niveau' => 'Débutant',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 21,
            "sousCategorieID" => 3
        ]);

        Formation::create([
            'nomFormation' => 'Pratique du Machine Learning avec Python',
            'description' => 'Apprenez à utiliser Python pour mettre en œuvre des modèles de Machine Learning dans des projets réels',
            'niveau' => 'Intermédiaire',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 35,
            "sousCategorieID" => 3
        ]);

        Formation::create([
            'nomFormation' => 'Deep Learning avec TensorFlow',
            'description' => 'Apprenez à créer des réseaux de neurones et des modèles de Deep Learning avec TensorFlow',
            'niveau' => 'Avancé',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 42,
            "sousCategorieID" => 4
        ]);

        Formation::create([
            'nomFormation' => 'Traitement du Langage Naturel avec Python',
            'description' => 'Apprenez à traiter et analyser des données textuelles avec Python et les bibliothèques NLP',
            'niveau' => 'Intermédiaire',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 35,
            "sousCategorieID" => 5
        ]);

        Formation::create([
            'nomFormation' => 'Introduction à la Sécurité des Réseaux',
            'description' => 'Apprenez les concepts de base de la sécurité des réseaux et les meilleures pratiques pour protéger vos infrastructures.',
            'niveau' => 'Débutant',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 35,
            "sousCategorieID" => 6
        ]);

        Formation::create([
            'nomFormation' => 'Sécurisation des Réseaux avec Cisco',
            'description' => 'Maîtrisez les outils et techniques pour sécuriser les réseaux avec les équipements Cisco.',
            'niveau' => 'Intermédiaire',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 42,
            "sousCategorieID" => 6
        ]);

        Formation::create([
            'nomFormation' => 'Sécurisation des Systèmes d\'Exploitation',
            'description' => 'Apprenez à sécuriser les systèmes d\'exploitation Linux et Windows contre les menaces et vulnérabilités courantes.',
            'niveau' => 'Intermédiaire',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 40,
            "sousCategorieID" => 7
        ]);

        Formation::create([
            'nomFormation' => 'Gestion des Vulnérabilités des Systèmes',
            'description' => 'Apprenez à identifier, analyser et corriger les vulnérabilités des systèmes pour assurer leur sécurité.',
            'niveau' => 'Avancé',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 45,
            "sousCategorieID" => 7
        ]);

        Formation::create([
            'nomFormation' => 'Hacking Éthique et Tests d\'Intrusion',
            'description' => 'Devenez un expert en hacking éthique et apprenez à réaliser des tests d\'intrusion pour détecter des vulnérabilités.',
            'niveau' => 'Avancé',
            'image' => 'https://asset.cloudinary.com/dlj8nno5x/eeb445b3dd2a2aeb2784f458336d0572',
            'duree' => 50,
            "sousCategorieID" => 8
        ]);
    }
}