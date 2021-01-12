<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Repository\EleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

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

        $form = $this->createFormBuilder($eleve)
                    ->add('nom', TextType::class, [
                        'attr' => [
                            'placeholder' => 'Le nom de l\'élève'
                        ]
                    ])
                    ->add('prenom', TextType::class, [
                        'attr' => [
                            'placeholder' => 'Le prénom de l\'élève'
                        ]
                    ])
                    ->add('dateNaissanceAt', BirthdayType::class, [
                        'attr' => [
                            'placeholder' => 'La date de naissance de l\'élève'
                        ]
                    ])
                    ->add('moyenne', IntegerType::class, [
                        'attr' => [
                            'placeholder' => 'La moyenne de l\'élève'
                        ]
                    ])
                    ->add('appreciation', TextareaType::class, [
                        'attr' => [
                            'placeholder' => 'L\'appréciation de l\'élève'
                        ]
                    ])
                    ->getForm()
        ;

        return $this->render('eleve/create_eleve.html.twig', [
            'formEleve' => $form->createView()
        ]);
    }
}
