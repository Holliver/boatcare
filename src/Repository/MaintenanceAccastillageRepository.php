<?php

namespace App\Repository;

use App\Entity\MaintenanceAccastillage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MaintenanceAccastillage|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaintenanceAccastillage|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaintenanceAccastillage[]    findAll()
 * @method MaintenanceAccastillage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaintenanceAccastillageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaintenanceAccastillage::class);
    }

    // /**
    //  * @return MaintenanceAccastillage[] Returns an array of MaintenanceAccastillage objects
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
    public function findOneBySomeField($value): ?MaintenanceAccastillage
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
