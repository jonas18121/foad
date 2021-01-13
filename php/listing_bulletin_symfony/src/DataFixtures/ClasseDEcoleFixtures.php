<?php

namespace App\DataFixtures;

use App\Entity\ClasseDEcole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClasseDEcoleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i = 1; $i <= 10; $i++){
            $classe = new ClasseDEcole;

            $classe->setMoyenneClasse($i)
                ->setNbEleves($i)
                ->setNumeroClasse($i)
            ;
            
            $manager->persist($classe);
        }

        $manager->flush();
    }
}
