<?php

namespace App\Repository;

use App\Entity\ClasseDEcole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Eleve;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method ClasseDEcole|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClasseDEcole|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClasseDEcole[]    findAll()
 * @method ClasseDEcole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasseDEcoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClasseDEcole::class);
    }

    // /**
    //  * @return ClasseDEcole[] Returns an array of ClasseDEcole objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClasseDEcole
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function calc_classe_sum($numero_classe)
    {
        $eleve = Eleve::class ;
        $classeDEcole = ClasseDEcole::class;
        $on = Join::ON;
        /* return $this->getEntityManager()->createQuery(

            "SELECT SUM(moyenne)/COUNT(eleve.id) AS moyenne_classe 
                FROM  {$eleve} eleve 
                INNER JOIN {$classeDEcole} classe_decole 
                {$on} classe_decole.id = eleve.classe_decole_id 
                WHERE classe_decole.numero_classe = :numero_classe
            "
        ) */

        return $this->createQueryBuilder('c')
            ->select('SUM(eleve.moyenne)/COUNT(eleve.id) AS moyenne_classe')
            ->join('c.eleves', 'eleve', Join::WITH, 'c.id = eleve.classeDEcole')
            ->andWhere('c.numeroClasse IN (:numero_classe)')
            ->setParameter('numero_classe', $numero_classe)
            ->getQuery()
            ->getResult();
        ;
    }
}
