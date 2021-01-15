<?php

namespace App\Repository;

use App\Entity\Eleve;
use App\Entity\ClasseDEcole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method Eleve|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eleve|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eleve[]    findAll()
 * @method Eleve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EleveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Eleve::class);
    }

    // /**
    //  * @return Eleve[] Returns an array of Eleve objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Eleve
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * pour des raisons de performance, cette fonction va remplacer la fonction findAll() de symfony
     * car avec findAll(), symfony fait 6 requêtes pour afficher tous les élèves qui sont réparti dans 5 classes différentes par exemple.
     * donc, une requête pour afficher tous les élèves et 5 requêtes pour afficher les 5 classes différentes
     * 
     * autre exemple : 
     * toujours avec findAll(), symfony fait 8 requêtes pour afficher tous les élèves qui sont réparti dans 7 classes différentes.
     * donc, une requête pour afficher tous les élèves et 7 requêtes pour afficher les 7 classes différentes, 
     * 
     * ainsi de suite, le nombre de requètes va augmenté a chaque fois qu'on va augmenter le nombre de classes différentes
     * 
     * avec find_all_eleve_in_ecole() qu'on a créer, symfony fait que une seule requête pour afficher le tout, peut importe le nombres de classes différentes 
     */
    public function find_all_eleve_in_ecole()
    {
        return $this->createQueryBuilder('e')
            ->select('e, c')
            ->leftJoin('e.classeDEcole', 'c')
            ->getQuery()
            ->getResult();
        ;
    }
}
