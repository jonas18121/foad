<?php

namespace App\Repository;

use App\Entity\Didding;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Didding|null find($id, $lockMode = null, $lockVersion = null)
 * @method Didding|null findOneBy(array $criteria, array $orderBy = null)
 * @method Didding[]    findAll()
 * @method Didding[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiddingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Didding::class);
    }

    // /**
    //  * @return Didding[] Returns an array of Didding objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Didding
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * afficher tous les enchères 
     * avec le produit qui est lier à chaque enchère
     * et le vendeur du produit qui a activer l'enchère
     */
    public function find_all_didding()
    {
        return $this->createQueryBuilder('d')
            ->select('d, p, u')
            ->leftJoin('d.product', 'p')
            ->leftJoin('p.user', 'u')
            ->getQuery()
            ->getResult();
        ;
    }

    public function find_one_didding($id)
    {
        return $this->createQueryBuilder('d')
            ->select('d, p, u')
            ->leftJoin('d.product', 'p')
            ->leftJoin('p.user', 'u')
            ->andWhere('d.id IN (:id)')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        ;
    }
}
