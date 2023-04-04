<?php

namespace App\Repository;

use App\Entity\MaintenanceElectronique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MaintenanceElectronique|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaintenanceElectronique|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaintenanceElectronique[]    findAll()
 * @method MaintenanceElectronique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaintenanceElectroniqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaintenanceElectronique::class);
    }

    // /**
    //  * @return MaintenanceElectronique[] Returns an array of MaintenanceElectronique objects
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
    public function findOneBySomeField($value): ?MaintenanceElectronique
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
