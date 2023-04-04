<?php

namespace App\Repository;

use App\Entity\MaintenanceBateau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MaintenanceBateau|null find($id,$lockMode = null,$lockVersion = null)
 * @method MaintenanceBateau|null findOneBy(array $criteria,array $orderBy = null)
 * @method MaintenanceBateau[]    findAll()
 * @method MaintenanceBateau[]    findBy(array $criteria,array $orderBy = null,$limit = null,$offset = null)
 */
class MaintenanceBateauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry,MaintenanceBateau::class);
    }

    /**
     * @param $bateau
     * @return MaintenanceBateau[] Returns an array of MaintenanceBateau objects
     */
    public function findByBateau($bateau): array
    {
        return $this->createQueryBuilder('mb')
            ->andWhere('mb.bateauMaintenuId = :val')
            ->setParameter('val',$bateau)
            ->getQuery()
            ->getResult();
    }
}
