<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;

class ProStagesController extends AbstractController
{
    public function index(): Response
    {

        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        $stages =  $repositoryStage->findAll();

        return $this->render('pro_stages/index.html.twig',['stages'=>$stages]);
    }

    public function entreprises(): Response
    {
        return $this->render('pro_stages/entreprises.html.twig');
    }

    public function formations(): Response
    {
        return $this->render('pro_stages/formations.html.twig');
    }

    public function stages($id): Response
    {
      $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

      $stage =  $repositoryStage->find($id);

        return $this->render('pro_stages/stages.html.twig',['stage' => $stage]);
    }
}
