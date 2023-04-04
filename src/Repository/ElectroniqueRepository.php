<?php

namespace App\Repository;

use App\Entity\Electronique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Electronique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Electronique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Electronique[]    findAll()
 * @method Electronique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElectroniqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Electronique::class);
    }


    /**
     * @param $bateau
     * @return Electronique[] Returns an array of electronique objects
     */
    public function findByBateau($bateau): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.bateau = :val')
            ->setParameter('val',$bateau)
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return electronique[] Returns an array of electronique objects
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
    public function findOneBySomeField($value): ?electronique
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
