<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        /* for ($i = 1; $i <= 10 ; $i++) { 
            $product = new Product();

            $product->setTitle("Titre n° {$i}")
                ->setContent("Contenu {$i}")
                ->setCreatedAt(new \DateTime())
                ->setPriceImmediate(4 . $i)
            ;

            $manager->persist($product);
        }
 */
        $manager->flush();
    }
}
