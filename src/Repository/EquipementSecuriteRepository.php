<?php

namespace App\Repository;

use App\Entity\EquipementSecurite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EquipementSecurite|null find($id,$lockMode = null,$lockVersion = null)
 * @method EquipementSecurite|null findOneBy(array $criteria,array $orderBy = null)
 * @method EquipementSecurite[]    findAll()
 * @method EquipementSecurite[]    findBy(array $criteria,array $orderBy = null,$limit = null,$offset = null)
 */
class EquipementSecuriteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry,EquipementSecurite::class);
    }

    /**
     * @param $bateau
     * @return EquipementSecurite[] Returns an array of equipementsSecurite objects
     */
    public function findByBateau($bateau): array
    {
        return $this->createQueryBuilder('eqs')
            ->andWhere('eqs.bateau = :val')
            ->setParameter('val',$bateau)
            ->getQuery()
            ->getResult();
    }
}
