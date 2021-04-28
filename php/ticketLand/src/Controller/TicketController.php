<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\TicketType;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TicketController extends AbstractController
{
   private TicketRepository $ticketRepository; 
   private EntityManagerInterface $entityManager;

    public function __construct(
        TicketRepository $ticketRepository,
        EntityManagerInterface $entityManager
    )
    {
        $this->ticketRepository = $ticketRepository;
        $this->entityManager = $entityManager;
    }

     /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->get_all_ticket();
    }

    /**
     * @Route("/ticket", name="ticket_all")
     */
    public function get_all_ticket(): Response
    {
        $tickets = $this->ticketRepository->findAll();

        return $this->render('ticket/get_all_ticket.html.twig', [
            'tickets' => $tickets,
        ]);
    }

    /**
     * @Route("/ticket/add", name="ticket_add")
     */
    public function create_ticket(Request $request)
    {
        $ticket = new Ticket;

        $form = $this->createForm(TicketType::class, $ticket);
        
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $ticket->setDateCreatedAt(new \DateTime())
            // ->setAuthor($this->getUser())
            ;

            $this->entityManager->persist($ticket);
            $this->entityManager->flush();

            return $this->redirectToRoute('ticket_all');
        }

        return $this->render('ticket/create_ticket.html.twig', [
            'formTicket' => $form->createView()
        ]);
    }
}
