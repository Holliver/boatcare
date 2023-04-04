<?php

namespace App\Repository;

use App\Entity\Electricite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Electricite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Electricite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Electricite[]    findAll()
 * @method Electricite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElectriciteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Electricite::class);
    }

    // /**
    //  * @return electricite[] Returns an array of electricite objects
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
    public function findOneBySomeField($value): ?electricite
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
