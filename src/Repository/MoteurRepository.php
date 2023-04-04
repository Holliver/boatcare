<?php

namespace App\Repository;

use App\Entity\Moteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Moteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Moteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Moteur[]    findAll()
 * @method Moteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Moteur::class);
    }
}
