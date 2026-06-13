<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recette>
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }

    public function findLastRecettes(): array
    {
        $qb = $this->createQueryBuilder('r');
        $qb->leftJoin('r.category', 'c')->addSelect('c')
            ->leftJoin('r.user', 'u')->addSelect('u')
            ->leftJoin('r.status', 's')->addSelect('s')
            ->leftJoin('r.season', 'se')->addSelect('se')
            ->leftJoin('r.activity', 'a')->addSelect('a')
            ->leftJoin('r.place', 'p')->addSelect('p');
        $qb->orderBy('r.dateCreated', 'DESC');
        $query = $qb->getQuery();
        $query->setMaxResults(50);
        return $query->getResult();
    }

    //    /**
    //     * @return Recette[] Returns an array of Recette objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Recette
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

}
