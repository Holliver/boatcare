<?php

namespace App\Repository;

use App\Entity\DocMoteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocMoteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocMoteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocMoteur[]    findAll()
 * @method DocMoteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocMoteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocMoteur::class);
    }

    // /**
    //  * @return DocMoteur[] Returns an array of DocMoteur objects
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
    public function findOneBySomeField($value): ?DocMoteur
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
