<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Eleve;


class EleveFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i = 1; $i <= 10; $i++){
            $eleve = new Eleve();

            $eleve->setNom("Nom n° {$i} ")
                ->setPrenom("Prenom n° {$i} ")
                ->setDateNaissanceAt(new \DateTime())
                ->setMoyenne($i)
                ->setAppreciation("Appreciation n° {$i} ")
            ;
            
            $manager->persist($eleve);
        }

        $manager->flush();
    }
}
