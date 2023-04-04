<?php

namespace App\Repository;

use App\Entity\MaintenanceAdministration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MaintenanceAdministration|null find($id,$lockMode = null,$lockVersion = null)
 * @method MaintenanceAdministration|null findOneBy(array $criteria,array $orderBy = null)
 * @method MaintenanceAdministration[]    findAll()
 * @method MaintenanceAdministration[]    findBy(array $criteria,array $orderBy = null,$limit = null,$offset = null)
 */
class MaintenanceAdministrationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry,MaintenanceAdministration::class);
    }

    /**
     * @param $administration
     * @return MaintenanceAdministration[] Returns an array of MaintenanceAdministration objects
     */
    public function findByAdministration($administration): array
    {
        return $this->createQueryBuilder('ma')
            ->andWhere('ma.administration = :val')
            ->setParameter('val',$administration)
            ->getQuery()
            ->getResult();
    }
}
