<?php

namespace App\Repository;

use App\Entity\MaintenanceOutillage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MaintenanceOutillage|null find($id,$lockMode = null,$lockVersion = null)
 * @method MaintenanceOutillage|null findOneBy(array $criteria,array $orderBy = null)
 * @method MaintenanceOutillage[] findAll()
 * @method MaintenanceOutillage[] findBy(array $criteria,array $orderBy = null,$limit = null,$offset = null)
 */
class MaintenanceOutillageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry,MaintenanceOutillage::class);
    }
}
