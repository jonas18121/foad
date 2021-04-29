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
     * @Route("/ticket/{id}", name="ticket_one")
     */
    public function get_one_ticket(Ticket $ticket): Response
    {

        if (!$ticket) {
            return $this->redirectToRoute('ticket_all');
        }

        return $this->render('ticket/get_one_ticket.html.twig', [
            'ticket' => $ticket,
        ]);
    }

    /**
     * @Route("/ticket_add", name="ticket_add", methods={"GET","POST"}, requirements={"id"="\d+"})
     * 
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

    /**
     * @Route("/ticket/edit/{id}", name="ticket_edit", methods={"GET","PUT"}, requirements={"id"="\d+"})
     */
    public function edit_ticket(Ticket $ticket, Request $request)
    {
        $form = $this->createForm(TicketType::class, $ticket, [ 'method' => 'PUT']);
        
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            // $ticket->setDateUpdatedAt(new \DateTime());

            $this->entityManager->persist($ticket);
            $this->entityManager->flush();

            return $this->redirectToRoute('ticket_all');
        }

        return $this->render('ticket/edit_ticket.html.twig', [
            'formTicket' => $form->createView()
        ]);
    }

    /**
     * @Route("/ticket/delete/{id}", name="ticket_delete", requirements={"id": "\d+"})
     */
    public function delete_ticket(Ticket $ticket, Request $request)
    {
        if($this->isCsrfTokenValid('delete', $request->get('_token'))){


            $this->entityManager->remove($ticket);
            $this->entityManager->flush();

            $this->addFlash('success',"Votre ticket a été supprimé !");
        }

        return $this->redirectToRoute('ticket_all');
    }
}
