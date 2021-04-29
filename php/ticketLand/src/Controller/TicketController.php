<?php

namespace App\Controller;

use DateTime;
use App\Entity\Ticket;
use App\Entity\Message;
use App\Form\TicketType;
use App\Form\MessageType;
use App\Repository\TicketRepository;
use App\Form\ChangeCategoryOfTicketType;
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
    public function get_one_ticket(Ticket $ticket, Request $request): Response
    {
        if (!$ticket) {
            return $this->redirectToRoute('ticket_all');
        }

        // Partie Message
        $message = new Message();

        $formMessage = $this->createForm(MessageType::class, $message);

        $formMessage->handleRequest($request);

        if ($formMessage->isSubmitted() && $formMessage->isValid()) {

            $message->setDateCreatedAt(new DateTime())
                ->setTicket($ticket)
                ->setAuthor($this->getUser())
            ;

            $this->entityManager->persist($message);
            $this->entityManager->flush();

            $this->addFlash('message', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('ticket_one', [ 'id' => $ticket->getId()]);
        }

        return $this->render('ticket/get_one_ticket.html.twig', [
            'ticket' => $ticket,
            'formMessage' => $formMessage->createView()
        ]);
    }

    /**
     * @Route("/ticket_add", name="ticket_add", methods={"GET","POST"}, requirements={"id"="\d+"})
     * 
     */
    public function create_ticket(Request $request)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('ticket_all');
        }

        $ticket = new Ticket;

        $form = $this->createForm(TicketType::class, $ticket);
        
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $ticket->setDateCreatedAt(new \DateTime())
                ->setAuthor($this->getUser())
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
        if (!$this->getUser()) {
            return $this->redirectToRoute('ticket_all');
        }

        $form = $this->createForm(TicketType::class, $ticket, [ 'method' => 'PUT']);
        
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $ticket->setDateUpdatedAt(new \DateTime());

            $this->entityManager->persist($ticket);
            $this->entityManager->flush();

            return $this->redirectToRoute('ticket_all');
        }

        return $this->render('ticket/edit_ticket.html.twig', [
            'formTicket' => $form->createView()
        ]);
    }

    /**
     * @Route("/ticket/close/{id}", name="ticket_close", methods={"GET","POST"}, requirements={"id"="\d+"})
     */
    public function close_ticket(Ticket $ticket, Request $request)
    {

        if($this->isCsrfTokenValid('close_ticket', $request->get('_token'))){

            $ticket->setDateUpdatedAt(new \DateTime())
                ->setClose(true)
            ;
            
            $this->entityManager->persist($ticket);
            $this->entityManager->flush();

            $this->addFlash('success',"Le ticket a bien été fermer !");
        }

        return $this->redirectToRoute('ticket_one', [ 'id' => $ticket->getId()]);
    }

    /**
     * @Route("/ticket/open/{id}", name="ticket_open", methods={"GET","POST"}, requirements={"id"="\d+"})
     */
    public function open_ticket(Ticket $ticket, Request $request)
    {

        if($this->isCsrfTokenValid('open_ticket', $request->get('_token'))){

            $ticket->setDateUpdatedAt(new \DateTime())
                ->setClose(false)
            ;
            
            $this->entityManager->persist($ticket);
            $this->entityManager->flush();

            $this->addFlash('success',"Le ticket a bien été ouvert !");
        }

        return $this->redirectToRoute('ticket_one', [ 'id' => $ticket->getId()]);
    }

    /**
     * @Route("/ticket/delete/{id}", name="ticket_delete", requirements={"id": "\d+"})
     */
    public function delete_ticket(Ticket $ticket, Request $request)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('ticket_all');
        }

        if($this->isCsrfTokenValid('delete', $request->get('_token'))){


            $this->entityManager->remove($ticket);
            $this->entityManager->flush();

            $this->addFlash('success',"Votre ticket a été supprimé !");
        }

        return $this->redirectToRoute('ticket_all');
    }

    /**
     * @Route("/ticket/category/change/{id_ticket}", name="change_category_of_ticket", methods={"GET","PUT"}, requirements={"id"="\d+"})
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
