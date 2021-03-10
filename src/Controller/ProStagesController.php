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

        $stages =  $repositoryStage->findAll();

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

    public function ajouterEntreprise(Request $request, ManagerRegistry $manager)
    {
        //Création d'une entreprise qui sera remplie par le formulaire
        $entreprise = new Entreprise();

        //Création du formulaire permattant de saisir une entreprise
        $formulaireEntreprise = $this->createForm(EntrepriseType::class, $entreprise);

        $formulaireEntreprise->handleRequest($request);

        if ($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid()){

            //Enregister la ressource en base de donnéelse
            $manager->getManager()->persist($entreprise);
            $manager->getManager()->flush();

            //Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('ProStages_index');

        }

        //Ajouter la page présentant le formulaire d'ajout d'une entreprise
        return $this->render('pro_stages/ajoutModifEntreprise.html.twig',['vueFormulaire' => $formulaireEntreprise->createView(), 'action'=>"ajouter"]);
    }

    public function modifierEntreprise(Request $request, ManagerRegistry $manager, Entreprise $entreprise)
    {

        //Création du formulaire permattant de modifier une entreprise
        $formulaireEntreprise = $this->createForm(EntrepriseType::class, $entreprise);

        $formulaireEntreprise->handleRequest($request);

        if ($formulaireEntreprise->isSubmitted()){

            //Enregister la ressource en base de donnéelse
            $manager->getManager()->persist($entreprise);
            $manager->getManager()->flush();

            //Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('ProStages_entreprises');

        }

        //Ajouter la page présentant le formulaire d'ajout d'une entreprise
        return $this->render('pro_stages/ajoutModifEntreprise.html.twig',['vueFormulaire' => $formulaireEntreprise->createView(), 'action'=>"modifier"]);
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
