<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Form\EleveType;
use App\Repository\EleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EleveController extends AbstractController
{
    /**
     * @Route("/", name="eleve", methods="GET")
     */
    public function index(EleveRepository $repo): Response
    {
        $eleves = $repo->findAll();
        
        return $this->render('eleve/get_all_eleves.html.twig', [
            'eleves' => $eleves
        ]);
    }

    /**
     * @Route("/eleve/{id}", name="eleve_show", requirements={"id": "\d+"}, methods="GET")
     */
    public function get_one_eleve_and_edit(Eleve $eleve)
    {
        return $this->render('eleve/get_one_eleve.html.twig', [
            'eleve' => $eleve
        ]);
    }

    /**
     * @Route("/eleve/add", name="eleve_add", methods={"GET", "POST"})
     */
    public function create_eleve(Request $request, EntityManagerInterface $manager)
    {
        $eleve = new Eleve();

        $form = $this->createForm(EleveType::class, $eleve);

        $form->handleRequest($request);

        dump($eleve);

        return $this->render('eleve/create_eleve.html.twig', [
            'formEleve' => $form->createView()
        ]);
    }
}
