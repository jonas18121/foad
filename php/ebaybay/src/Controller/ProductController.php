<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product_all")
     */
    public function get_all_product(ProductRepository $repo): Response
    {
        $products = $repo->findAll();

        return $this->render('product/get_all_product.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @Route("/product/{id}", name="product_one", requirements={"id": "\d+"}, methods="GET")
     */
    public function get_one_product(Product $product)
    {
        return $this->render('product/get_one_product.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/product/add", name="product_add", methods={"GET", "POST"})
     */
    public function create_product(Request $request, EntityManagerInterface $manager)
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $product->setCreatedAt(new \DateTime());

            $manager->persist($product);
            $manager->flush();

            return $this->redirectToRoute('product_all');
        }

        return $this->render('product/create_product.html.twig', [
            'formProduct' => $form->createView()
        ]);
    } 
}
