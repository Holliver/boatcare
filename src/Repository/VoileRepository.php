<?php

namespace App\Repository;

use App\Entity\Voile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Voile|null find($id,$lockMode = null,$lockVersion = null)
 * @method Voile|null findOneBy(array $criteria,array $orderBy = null)
 * @method Voile[]    findAll()
 * @method Voile[]    findBy(array $criteria,array $orderBy = null,$limit = null,$offset = null)
 */
class VoileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry,Voile::class);
    }

    /**
     * @param $bateau
     * @return Voile[] Returns an array of voile objects
     */
    public function findByBateau($bateau): array
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.bateau = :val')
            ->setParameter('val',$bateau)
            ->getQuery()
            ->getResult();
    }
}
