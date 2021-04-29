<?php

namespace App\Controller;

use App\Entity\Message;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="message")
     */
    public function index(): Response
    {
        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
        ]);
    }

    /**
     * @Route("/message/delete/{id}", name="message_delete", requirements={"id": "\d+"})
     */
    public function delete_message(Message $message, EntityManagerInterface $manager, Request $request)
    {
        /* if (!$this->getUser()) {
            return $this->redirectToRoute('ticket_all');
        } */

        if($this->isCsrfTokenValid('delete', $request->get('_token'))){

            $manager->remove($message);
            $manager->flush();

            $this->addFlash('success',"Votre message a été supprimé !");
        }

        return $this->redirectToRoute('ticket_one', [ 'id' => $message->getTicket()->getId()]);
    }
}
