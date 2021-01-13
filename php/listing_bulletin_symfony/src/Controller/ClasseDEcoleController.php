<?php

namespace App\Controller;

use App\Form\ClasseDEcoleType;
use App\Entity\ClasseDEcole;
use App\Repository\ClasseDEcoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClasseDEcoleController extends AbstractController
{
    /**
     * @Route("/classe_d_ecole", name="classe_all")
     */
    public function index(ClasseDEcoleRepository $repo): Response
    {
        $classes = $repo->findAll();

        return $this->render('classe_d_ecole/get_all_classe.html.twig', [
            'classes' => $classes,
        ]);
    }

    /**
     * @Route("/classe_d_ecole/add", name="classe_add")
     */
    public function create_classe(Request $request, EntityManagerInterface $manager)
    {
        $classe = new ClasseDEcole();

        $form = $this->createForm(ClasseDEcoleType::class, $classe);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $manager->persist($classe);
            $manager->flush();

            return $this->redirectToRoute('classe');
        }

        return $this->render('classe_d_ecole/create_classe.html.twig', [
            'formEleve' => $form->createView()
        ]);
    }

    /**
     * @Route("/classe_d_ecole/{id}", name="classe_get_one", requirements={"id": "\d+"}, methods="GET")
     */
    public function get_one_eleve(ClasseDEcole $classeDEcole, ClasseDEcoleRepository $repo)
    {
        $moyenne_classe = $repo->calc_classe_sum($classeDEcole->getNumeroClasse());

        return $this->render('classe_d_ecole/get_one_classe.html.twig', [
            'classeDEcole' => $classeDEcole,
            'moyenne_classe' => $moyenne_classe
        ]);
    }

    
}
