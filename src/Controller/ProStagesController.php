<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStagesController extends AbstractController
{
    public function index(): Response
    {
        return new Response(
        '<html><body><h1>Bienvenue sur la page d\'accueil de ProStages</h1></body></html>'
        );
    }

    public function entreprises(): Response
    {
        return new Response(
        '<html><body><h1>Cette page affichera la liste des entreprises proposant un stage</h1></body></html>'
        );
    }

    public function formations(): Response
    {
        return new Response(
        '<html><body><h1>Cette page affichera la liste des formations de l\'IUT</h1></body></html>'
        );
    }
}
