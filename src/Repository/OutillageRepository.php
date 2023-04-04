<?php

namespace App\Repository;

use App\Entity\Outillage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Outillage>
 *
 * @method Outillage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Outillage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Outillage[]    findAll()
 * @method Outillage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OutillageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Outillage::class);
    }



}
