<?php

namespace App\Repository;

use App\Entity\DocElectronique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocElectronique|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocElectronique|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocElectronique[]    findAll()
 * @method DocElectronique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocElectroniqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocElectronique::class);
    }

    // /**
    //  * @return DocElectronique[] Returns an array of DocElectronique objects
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
    public function findOneBySomeField($value): ?DocElectronique
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
