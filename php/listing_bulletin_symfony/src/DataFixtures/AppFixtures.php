<?php

namespace App\DataFixtures;

use App\Entity\Eleve;
use App\Entity\ClasseDEcole;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = \Faker\Factory::create('fr_FR');

        for($i = 1; $i <= 5; $i++){
            $classe = new ClasseDEcole();

            $classe->setNumeroClasse($faker->numberBetween(0,100));

            for($j = 1; $j <= 10; $j++){
                $eleve = new Eleve();
    
                $eleve->setNom($faker->lastName())
                    ->setPrenom($faker->firstName())
                    ->setDateNaissanceAt(new \DateTime())
                    ->setMoyenne($faker->numberBetween(10,20))
                    ->setAppreciation($faker->text(255))
                ;
                
                $manager->persist($eleve);
                $classe->addEleve($eleve);
            }

            $manager->persist($classe);
        }

        $manager->flush();
    }
}
