<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * performance 1 requête en 95ms au lieu de 3 en 143ms 
     * 
     * affiche un produit en particulier 
     * puis donne moi accès au user 
     * et au didding depuis ce produit
     */
    public function find_one_product($id)
    {
        return $this->createQueryBuilder('p')
            ->select('p, d, user, c')
            ->leftJoin('p.diddings', 'd')
            // ->innerJoin('p.user', 'user')
            ->leftJoin('p.categorie', 'c')
            ->andWhere('p.id IN (:id)')
            ->leftJoin('d.shopper', 'user')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        ;
    }

    /**
     * https://openclassrooms.com/forum/sujet/doctrine-sf2-selectionner-des-colonnes
     * 
     * https://github.com/doctrine/orm/blob/master/docs/en/reference/partial-objects.rst
     * 
     * on peut utiliser le mot partial dans le select pour sélectionné des champs
     * 
     * ->select('partial p.{id , image.name}, partial u.{id}')
     * ->leftJoin('p.user', 'u')
     * ->andWhere('p.id IN (:id)')
     * ->setParameter('id', $id)
     * 
     * mais ça peut posé un problème de sécurité si on veut modifier l'entité qui est en partial
     * c'est a faire uniquement pour de l'affichage, en plus en terme de preformance ça peut être breaucoup plus long, 
     */
    public function find_one_product_for_form($id)
    {
        return $this->createQueryBuilder('p')
            ->select('p, u')
            ->leftJoin('p.user', 'u')
            ->andWhere('p.id IN (:id)')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
        ;
    }

    public function find_all_product()
    {
        return $this->createQueryBuilder('p')
            ->select('p, d, u, c')
            ->leftJoin('p.diddings', 'd')
            ->leftJoin('p.user', 'u')
            ->leftJoin('p.categorie', 'c')
            ->getQuery()
            ->getResult();
        ;
    }

    public function find_owner_product($id)
    {
        return $this->createQueryBuilder('p')
            ->select('p, user')
            ->leftJoin('p.diddings', 'd')
            ->innerJoin('p.user', 'user')
            // ->leftJoin('p.categorie', 'c')
            ->andWhere('p.id IN (:id)')
            // ->leftJoin('d.shopper', 'user')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
        ;
    }

    public function find_shopper_product($id)
    {
        return $this->createQueryBuilder('p')
            ->select('p, user, d')
            ->leftJoin('p.diddings', 'd')
            // ->innerJoin('p.user', 'user')
            // ->leftJoin('p.categorie', 'c')
            ->andWhere('p.id IN (:id)')
            ->leftJoin('d.shopper', 'user')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
        ;
    }
}
