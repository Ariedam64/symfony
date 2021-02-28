<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Formation;
use App\Entity\Entreprise;
//use App\Controller\ProStagesController;

class ProStagesController extends AbstractController
{
    public function index(): Response
    {

        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        $stages =  $repositoryStage->findAll();

        return $this->render('pro_stages/index.html.twig',['stages'=>$stages]);
    }

    public function ajouterEntreprise(): Response
    {
        //Ajouter la page présentant le formulaire d'ajout d'une entreprise
        return $this->render('pro_stages/ajouterEntreprise.html.twig');
    }

    public function entreprises(): Response
    {

      $repositoryEntreprises = $this->getDoctrine()->getRepository(Entreprise::class);

      $entreprises =  $repositoryEntreprises->findAll();


        return $this->render('pro_stages/entreprises.html.twig',['entreprises'=>$entreprises]);
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
