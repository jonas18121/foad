<?php

namespace App\Controller;

use DateTime;
use App\Entity\Didding;
use App\Entity\Product;
use App\Form\DiddingType;
use App\Form\PriceShopperType;
use App\Repository\DiddingRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DiddingController extends AbstractController
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/didding", name="didding_all")
     */
    public function get_all_didding(DiddingRepository $repo): Response
    {
        // $diddings = $repo->findAll();
        $diddings = $repo->find_all_didding();

        // dd($diddings);

        return $this->render('didding/get_all_didding.html.twig', [
            'diddings' => $diddings
        ]);
    }

    /**
     * @Route("/didding/{id}", name="didding_one", requirements={"id": "\d+"}, methods={"GET", "POST"})
     */
    public function get_one_didding($id, DiddingRepository $repo, Request $request, EntityManagerInterface $manager)
    {
        $error = null;
        $didding = $repo->find_one_didding($id);
        $dateCurrent = new \DateTime();
        
        // dd($didding);
        
        $form = $this->createForm(PriceShopperType::class, $didding[0]);
        
        
        $form->handleRequest($request);


        // a mettre dans un subcriber ou un sevrice
        if ($dateCurrent->format('d/m/Y') > $didding[0]->getDateEndAt()->format('d/m/Y')) {
            
            $didding[0]->setIsActive(false);

            if ($didding[0]->getBestPrice() !== null ) {
                
                $didding[0]->setWinner(true)
                    ->setPriceEnd($didding[0]->getBestPrice())
                    ->getProduct()->setSold(true);
                ;
            }
            else{
                $didding[0]->getProduct()->setSold(false);
            }

            $manager->persist($didding[0]);
            $manager->flush();
        }
        

                
    
        if ($form->isSubmitted() && $form->isValid()) {

            if ($didding[0]->getPriceShopper() < $didding[0]->getPriceStart()) {
                $error = "Votre mise doit être égale ou plus élevé que prix de départ"; 
            }
            else{
    
                if ($didding[0]->getPriceShopper() <= $didding[0]->getBestPrice()) {
                    $error = "Votre mise doit être plus élevé que le prix proposer par un autre acheteur"; 
                }
                else{

                    // dd($didding[0]->getProduct()->getSold());

                    if ($didding[0]->getPriceImmediate() != null) 
                    {
                        if ($didding[0]->getPriceShopper() >= $didding[0]->getPriceImmediate()) {

                            $didding[0]->setIsActive(false)
                                ->setWinner(true)
                                ->setBestPrice($didding[0]->getPriceShopper())
                                ->setPriceEnd($didding[0]->getBestPrice())
                                ->getProduct()->setSold(true)
                            ;
                        }
                    }

                    $didding[0]->setShopper($this->getUser())
                        ->setBestPrice($didding[0]->getPriceShopper())
                        ->setPriceShopper(null)
                        // ->setPriceEnd($didding[0]->getBestPrice())
                        // ->setSold(true)
                    ;
        
                    $manager->persist($didding[0]);
                    $manager->flush();
                }
            } // return $this->redirectToRoute('didding_all'); 
        }

        dump($error);


        return $this->render('didding/get_one_didding.html.twig', [
            'didding' => $didding,
            'formPriceShopper' => $form->createView(),
            'error' => $error
        ]);
    }

    /* public function priceShopper($didding)
    {

        $request = $this->get('security.csrf.token_manager');
        $manager = $this->getDoctrine()->getManager();


        $form = $this->createForm(PriceShopperType::class, $didding);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($didding);
            $manager->flush();

            // return $this->redirectToRoute('didding_all');
        }
    } */

    /**
     * @Route("/didding/add/product/{id}", name="didding_add", methods={"GET", "POST"})
     */
    public function create_didding($id, ProductRepository $repo, Request $request, EntityManagerInterface $manager)
    {
        $didding = new Didding();

        $product = $repo->find_one_product_for_form($id);

        dump($product );

        $didding->setProduct($product);

        $product->setSold(null);
        
        $form = $this->createForm(DiddingType::class, $didding);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $didding->setCreatedAt(new \DateTime())
                ->setIsActive(true)
            ;

            $manager->persist($didding);
            $manager->flush();

            return $this->redirectToRoute('didding_all');
        }
 
        return $this->render('didding/create_didding.html.twig', [
            'formDidding' => $form->createView(),
            'product' => $product
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
