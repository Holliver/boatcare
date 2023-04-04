<?php

namespace App\Repository;

use App\Entity\DocEquipementSecurite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocEquipementSecurite|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocEquipementSecurite|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocEquipementSecurite[]    findAll()
 * @method DocEquipementSecurite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocEquipementSecuriteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocEquipementSecurite::class);
    }

    // /**
    //  * @return DocEquipementSecurite[] Returns an array of DocEquipementSecurite objects
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
    public function findOneBySomeField($value): ?DocEquipementSecurite
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
