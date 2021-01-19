<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function get_all_category(CategoryRepository $repo): Response
    {
        $categories = $repo->findAll();

        return $this->render('category/get_all_category.html.twig', [
            'categories' => $categories,
        ]);
    }
}
