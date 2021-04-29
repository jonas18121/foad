<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Ticket;
use App\Form\CategoryType;
use App\Form\ChangeCategoryOfTicketType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private CategoryRepository $categoryRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        CategoryRepository $categoryRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/category", name="category")
     */
    public function get_all_category(): Response
    {
        $categories = $this->categoryRepository->findAll();

        return $this->render('category/get_all_category.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/change/{id_category}/{id_ticket}", name="change_category", methods={"GET","PUT"}, requirements={"id"="\d+"})
     */
    public function change_category($id_ticket, Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('ticket_all');
        }

        $ticket = $this->entityManager->getRepository(Ticket::class)->findOneBy([ 'id' => $id_ticket ]);

        $form = $this->createForm(ChangeCategoryOfTicketType::class, $ticket, [ 'method' => 'PUT']);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($ticket);
            $this->entityManager->flush();

            return $this->redirectToRoute('ticket_all');
        }

        return $this->render('category/change_category.html.twig', [
            'formTicket' => $form->createView()
        ]);
    }
    
}
