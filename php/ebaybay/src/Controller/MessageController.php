<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\DiddingRepository;
use App\Repository\MessageRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessageController extends AbstractController
{
    /**
     * @Route("/message/product/{product_id}/didding/{didding_id}", name="message_with_owner", requirements={"product_id": "\d+", "didding_id": "\d+" }, methods={"GET", "POST"})
     */
    public function index(
        $product_id, 
        $didding_id, 
        ProductRepository $repoProduct, 
        DiddingRepository $repoDidding, 
        MessageRepository $repoMessage,
        Request $request, 
        EntityManagerInterface $manager): Response
    {
        $owner_product = $repoProduct->find_owner_product($product_id); 

        $shopper_product = $repoDidding->find_one_didding_with_shopper($didding_id);

        $all_message = $repoMessage->find_message_for_owner_and_shopper($shopper_product->getShopper(), $owner_product->getUser());
        
        dump($owner_product);

        dump($shopper_product->getShopper());

        dump($all_message);

        $message = new Message();

        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $message->setCreatedAt(new \DateTime());

            if ( $this->getUser() == $shopper_product->getShopper()) 
            {
                $message->setUserSend($shopper_product->getShopper());
                $message->setUserReceived($owner_product->getUser());
                $manager->persist($message);

                $owner_product->getUser()->addMessage($message);
                $manager->persist($owner_product);
                // dd('ok');
            }
            elseif( $this->getUser() == $owner_product->getUser())
            {
                $message->setUserSend($owner_product->getUser());
                $message->setUserReceived($shopper_product->getShopper());
                $manager->persist($message);

                $shopper_product->getShopper()->addMessage($message);
                $manager->persist($shopper_product);
            }

            $manager->flush();
        }

        return $this->render('message/index.html.twig', [
            'formMessage' => $form->createView(),
            'all_message' => $all_message,
        ]);
    }
}
