<?php

namespace App\Repository;

use App\Entity\MaintenanceElectricite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MaintenanceElectricite|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaintenanceElectricite|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaintenanceElectricite[]    findAll()
 * @method MaintenanceElectricite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaintenanceElectriciteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaintenanceElectricite::class);
    }

    // /**
    //  * @return MaintenanceElectricite[] Returns an array of MaintenanceElectricite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MaintenanceElectricite
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
