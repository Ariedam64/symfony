<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Creation d'un générateur de données Faker
        $faker = \Faker\Factory::create('fr_FR');

        $nbEntreprises = 15;
        $nbStages= 15;
        $nbFormations = 15;

        for($i=0; $i < $nbEntreprises; $i++){
            $entreprise = new Entreprise();
            $entreprise->setNom($faker->company);
            $entreprise->setActivite($faker->jobTitle);
            $entreprise->setAdresse($faker->address);
            $manager->persist($entreprise);
        }

        for($i=0; $i < $nbStages; $i++){
            $stage = new Stage();
            $stage->setIntitule($faker->jobTitle);
            $stage->setMission($faker->realText($maxNbChars = 50, $indexSize = 2));
            $stage->setAdresseMail($faker->email);
            $manager->persist($stage);

        }
        for($i=0; $i < $nbFormations; $i++){
            $formation = new Formation();
            $formation->setNom("DUT Info");
            $formation->setDescription($faker->realText($maxNbChars = 50, $indexSize = 2));
            $manager->persist($formation);
        }
        $manager->flush();
    }
}
