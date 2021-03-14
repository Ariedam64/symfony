<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Formation;
use App\Entity\Entreprise;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\EntrepriseType;

//use App\Controller\ProStagesController;

class ProStagesController extends AbstractController
{
    public function index(): Response
    {

        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        $stages =  $repositoryStage->allStage();

        return $this->render('pro_stages/index.html.twig',['stages'=>$stages]);
    }

    public function stageParEntreprise($entreprise): Response
    {

        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        $stages =  $repositoryStage->findByEntreprise($entreprise);

        return $this->render('pro_stages/stageParEntreprise.html.twig',['stages'=>$stages]);
    }

    public function stageParFormation($formation): Response
    {

        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        $stages =  $repositoryStage->findByFormation($formation);

        return $this->render('pro_stages/stageParFormation.html.twig',['stages'=>$stages]);
    }


    public function formations(): Response
    {
      $repositoryFormations = $this->getDoctrine()->getRepository(Formation::class);

      $formations =  $repositoryFormations->findAll();

      return $this->render('pro_stages/formations.html.twig', ['formations'=>$formations]);
    }

    public function stages($id): Response
    {
      $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

      $stage =  $repositoryStage->find($id);


        return $this->render('pro_stages/stages.html.twig',['stage' => $stage]);
    }
}
