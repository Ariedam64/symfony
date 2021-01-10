<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $entrepriseSERIEL = new Entreprise();
        $entrepriseSERIEL->setNom("SERIEL");
        $entrepriseSERIEL->setActivite("R&D Informatique");
        $entrepriseSERIEL->setAdresse("76 Rue du Bois Belin, 64600 Anglet");


        $manager->persist($entrepriseSERIEL);

        $manager->flush();
    }
}
