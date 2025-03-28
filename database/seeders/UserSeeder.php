<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nom' => 'Boussarsar',
            'prenom' => 'Nadim',
            'dateNaissance' => '1999-01-11',
            'numeroTelephone' => '44141875',
            'adresse' => '15 Rue de la Liberté, Tunis',
            'adresseMail' => 'boussarsarnadim@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'admin'
        ]);

        User::create([
            'nom' => 'Zribi',
            'prenom' => 'Manar',
            'dateNaissance' => '2001-05-06',
            'numeroTelephone' => '54558125',
            'adresse' => '6 Rue Maghreb, Sfax',
            'adresseMail' => 'zribimanar6@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'formateur'
        ]);

        User::create([
            'nom' => 'Zaidi',
            'prenom' => 'Med Amine',
            'dateNaissance' => '2004-11-25',
            'numeroTelephone' => '55987766',
            'adresse' => "4 Avenue de l'Indépendance, Sousse",
            'adresseMail' => 'amine.zaidi03@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'candidat'
        ]);

        User::create([
            'nom' => 'Zaidi',
            'prenom' => 'Saif Eddine',
            'dateNaissance' => '2003-04-30',
            'numeroTelephone' => '52224567',
            'adresse' => '7 Rue Ibn Khaldoun, Kairouan',
            'adresseMail' => 'zaidisaif95@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'candidat'
        ]);

        User::create([
            'nom' => 'Chouchane',
            'prenom' => 'Sami',
            'dateNaissance' => '2001-07-20',
            'numeroTelephone' => '55122334',
            'adresse' => "15 Rue Hedi Nouira, Monastir",
            'adresseMail' => 'sami.chouchane@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'candidat'
        ]);

        User::create([
            'nom' => 'Mejri',
            'prenom' => 'Fathi',
            'dateNaissance' => '1999-12-05',
            'numeroTelephone' => '50011223',
            'adresse' => "25 Avenue Mohamed V, Sfax",
            'adresseMail' => 'fathi.mejri@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'candidat'
        ]);
    }
}