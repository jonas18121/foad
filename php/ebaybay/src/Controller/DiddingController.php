<?php

namespace App\Controller;

use App\Entity\Didding;
use App\Repository\DiddingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DiddingController extends AbstractController
{
    /**
     * @Route("/didding", name="didding_all")
     */
    public function get_all_didding(DiddingRepository $repo): Response
    {
        // $diddings = $repo->findAll();
        $diddings = $repo->find_all_didding();

        return $this->render('didding/get_all_didding.html.twig', [
            'diddings' => $diddings
        ]);
    }

    /**
     * @Route("/didding/{id}", name="didding_one", requirements={"id": "\d+"}, methods="GET")
     */
    public function get_one_product(Didding $didding)
    {
        return $this->render('didding/get_one_didding.html.twig', [
            'didding' => $didding
        ]);
    }

    /**
     * @Route("/didding/add", name="didding_add", methods={"GET", "POST"})
     */
    public function create_didding(Request $request, EntityManagerInterface $manager)
    {
        $didding = new Didding();

        $form = $this->createForm(DiddingType::class, $didding);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $didding->setCreatedAt(new \DateTime());

            $manager->persist($didding);
            $manager->flush();

            return $this->redirectToRoute('didding_all');
        }

        return $this->render('didding/create_didding.html.twig', [
            'formDidding' => $form->createView()
        ]);
    } 

    /**
     * @Route("/didding/edit/{id}", name="didding_edit", requirements={"id": "\d+"}, methods={"GET", "PUT"})
     */
    public function edit_didding(Didding $didding, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(DiddingType::class, $didding, [ 'method' => 'PUT' ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $manager->persist($didding);
            $manager->flush();

            return $this->redirectToRoute('didding_all');
        }

        return $this->render('didding/edit_didding.html.twig', [
            'formDidding' => $form->createView()
        ]);
    }

     /**
     * @Route("/didding/delete/{id}", name="didding_delete", requirements={"id": "\d+"})
     */
    public function delete_didding(Didding $didding, EntityManagerInterface $manager)
    {
        $manager->remove($didding);
        $manager->flush();

        return $this->redirectToRoute('didding_all');
    }
}
