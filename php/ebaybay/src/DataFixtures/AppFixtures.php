<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($j = 1; $j <= 3; $j++)
        {
            $category = new Category();

            $category->setName("Nom de categorie n° {$j}")
                ->setCreateAt(new \DateTime())
            ;

            for ($i = 1; $i <= 10 ; $i++) { 
                $product = new Product();
    
                $product->setTitle("Titre n° {$i}")
                    ->setContent("Contenu {$i}")
                    ->setCreatedAt(new \DateTime())
                    ->setPriceImmediate(4 . $i)
                ;
    
                $manager->persist($product);
                $category->addProduct($product);
            }
            $manager->persist($category);
        }
        $manager->flush();
    }
}
