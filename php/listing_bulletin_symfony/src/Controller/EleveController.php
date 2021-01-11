<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Repository\EleveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EleveController extends AbstractController
{
    /**
     * @Route("/eleve", name="eleve")
     */
    public function index(EleveRepository $repo): Response
    {
        $eleves = $repo->findAll();
        
        return $this->render('eleve/get_all_eleves.html.twig', [
            'eleves' => $eleves
        ]);
    }

    /**
     * @Route("/eleve/{id}", name="eleve_show")
     */
    public function get_one_eleve_and_edit($id)
    {
        $repo =  $this->getDoctrine()->getRepository(Eleve::class);

        $eleve = $repo->find($id);

        return $this->render('eleve/show.html.twig', [
            'eleve' => $eleve
        ]);
    }
}
