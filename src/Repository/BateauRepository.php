<?php

namespace App\Repository;

use App\Entity\Bateau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bateau|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bateau|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bateau[]    findAll()
 * @method Bateau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BateauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bateau::class);
    }



    /**
     * @param $user
     * @return Bateau|null
     * @throws NonUniqueResultException
     */
    public function userBateau($user): ?Bateau
    {
        return $this->createQueryBuilder('b')
            ->addSelect('b')
            ->leftJoin('b.moteurs','moteurs')
            ->addSelect('moteurs')
            ->leftJoin('moteurs.maintenanceMoteurs','mat')
            ->addSelect('mat')
            ->andWhere('b.user_id = :val')
            ->setParameter('val', $user)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
