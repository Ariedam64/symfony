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

        $dutInfo = new Formation();
        $dutInfo->setNom("DUT Informatique");
        $dutInfo->setDescription("Le BUT informatique est un diplôme de grade licence qui prépare aux métiers de l’informatique tout en répondant aux exigences des entreprises.");

        $licencePro = new Formation();
        $licencePro->setNom("Licence Professionnelle Multimédia");
        $licencePro->setDescription("Une licence professionnelle en multimédia est un cursus d’un an qui a pour but de former les étudiants aux métiers de la création, de la conception et de la réalisation de produits et de services multimédias.");

        $duTIC = new Formation();
        $duTIC->setNom("DU TIC");
        $duTIC->setDescription("Technologies de l’information et de la communication - s’adresse à toute personne en reconversion professionnelle ou en recherche de compléments de compétences dans les domaines du web, du multimédia, du webmarketing et de la gestion de projets.");

        $tableauFormations = array($dutInfo, $licencePro, $duTIC);

        foreach ($tableauFormations as $formation){
            $manager->persist($formation);
        }

        $nbEntreprises = 15;

        for($i=0; $i < $nbEntreprises; $i++){
            $entreprise = new Entreprise();
            $entreprise->setNom($faker->company);
            $entreprise->setActivite($faker->jobTitle);
            $entreprise->setAdresse($faker->address);
            $manager->persist($entreprise);

            $nbStages = $faker->numberBetween($min=0, $max=2);

            for($ii=0; $ii < $nbStages; $ii++){
                $stage = new Stage();
                $stage->setIntitule($faker->jobTitle);
                $stage->setMission($faker->realText($maxNbChars = 50, $indexSize = 2));
                $stage->setAdresseMail($faker->email);
                $numFormation = $faker->numberBetween($min=0, $max=2);
                $tableauFormations[$numFormation] -> addStage($stage);
                $entreprise->addStage($stage);
                $manager->persist($entreprise);
                $manager->persist($tableauFormations[$numFormation]);
                $manager->persist($stage);

            }
        }
        $manager->flush();
    }
}
