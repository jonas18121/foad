<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category_all")
     */
    public function get_all_category(CategoryRepository $repo): Response
    {
        $categories = $repo->findAll();

        return $this->render('category/get_all_category.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_one", requirements={"id": "\d+"}, methods="GET")
     */
    public function get_one_category(Category $category)
    {
        return $this->render('category/get_one_category.html.twig', [
            'category' => $category
        ]);
    }

    /**
     * @Route("/product/add", name="category_add", methods={"GET", "POST"})
     */
    public function create_category(Request $request, EntityManagerInterface $manager)
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $category->setCreatedAt(new \DateTime());

            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute('category_all');
        }

        return $this->render('category/create_category.html.twig', [
            'formCategory' => $form->createView()
        ]);
    } 

    /**
     * @Route("/product/edit/{id}", name="category_edit", requirements={"id": "\d+"}, methods={"GET", "PUT"})
     */
    public function edit_category(Category $category, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(CategoryType::class, $category, [ 'method' => 'PUT' ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute('category_all');
        }

        return $this->render('category/edit_category.html.twig', [
            'formCategory' => $form->createView()
        ]);
    }

     /**
     * @Route("/category/delete/{id}", name="category_delete", requirements={"id": "\d+"})
     */
    public function delete_category(Category $category, EntityManagerInterface $manager)
    {
        $manager->remove($category);
        $manager->flush();

        return $this->redirectToRoute('category_all');
    }
}
