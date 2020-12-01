<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStagesController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('pro_stages/index.html.twig');
    }

    public function entreprises(): Response
    {
        return $this->render('pro_stages/entreprises.html.twig');
    }

    public function formations(): Response
    {
        return $this->render('pro_stages/formations.html.twig');
    }

    public function stages(string $id): Response
    {
        return $this->render('pro_stages/stages.html.twig');
    }

}
