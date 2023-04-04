<?php

namespace App\Repository;

use App\Entity\MaterielSecuriteLegal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MaterielSecuriteLegal|null find($id,$lockMode = null,$lockVersion = null)
 * @method MaterielSecuriteLegal|null findOneBy(array $criteria,array $orderBy = null)
 * @method MaterielSecuriteLegal[]    findAll()
 * @method MaterielSecuriteLegal[]    findBy(array $criteria,array $orderBy = null,$limit = null,$offset = null)
 */
class MaterielSecuriteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry,MaterielSecuriteLegal::class);
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function materielParTypeNav($typenav)
    {
        if ($typenav === 'haututière') {
            return $this->createQueryBuilder('mat')
                ->addSelect('mat')
                ->andWhere('mat.haututiere = :val')
                ->setParameter('val',true)
                ->getQuery()
                ->getResult();
        }
        if ($typenav === 'semihauturière') {
            return $this->createQueryBuilder('mat')
                ->addSelect('mat')
                ->andWhere('mat.semihauturiere = :val')
                ->setParameter('val',true)
                ->getQuery()
                ->getResult();
        }
        if ($typenav === 'navcotière') {
            return $this->createQueryBuilder('mat')
                ->addSelect('mat')
                ->andWhere('mat.navcotiere = :val')
                ->setParameter('val',true)
                ->getQuery()
                ->getResult();
        }

    }

   /* public function choixMatNonObligatoire(){
        return $this->createQueryBuilder('msl')
            ->andWhere('msl.bateau = :val')
            ->setParameter('val',3);
    }*/
}
