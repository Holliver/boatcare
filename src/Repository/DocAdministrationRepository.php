<?php

namespace App\Repository;

use App\Entity\DocAdministration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocAdministration|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocAdministration|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocAdministration[]    findAll()
 * @method DocAdministration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocAdministrationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocAdministration::class);
    }
}
