<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Creation d'un générateur de données Faker
        $faker = \Faker\Factory::create('fr_FR');
        $nbEntreprises = 15;

        for($i=0; $i < $nbEntreprises; $i++){
            $entreprise = new Entreprise();
            $entreprise->setNom($faker->company);
            $entreprise->setActivite($faker->jobTitle);
            $entreprise->setAdresse($faker->address);
            $manager->persist($entreprise);
        }
        $manager->flush();
    }
}
