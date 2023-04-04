<?php

namespace App\Repository;

use App\Entity\Electricte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Electricte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Electricte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Electricte[]    findAll()
 * @method Electricte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElectricteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Electricte::class);
    }


}
