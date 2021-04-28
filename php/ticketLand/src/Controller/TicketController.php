<?php

namespace App\Controller;

use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
   private TicketRepository $ticketRepository; 

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

     /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->get_all_ticket();
    }

    /**
     * @Route("/ticket", name="ticket")
     */
    public function get_all_ticket(): Response
    {
        $tickets = $this->ticketRepository->findAll();

        return $this->render('ticket/get_all_ticket.html.twig', [
            'tickets' => $tickets,
        ]);
    }
}
