<?php

namespace App\Repository;

use App\Entity\Season;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Season>
 */
class SeasonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Season::class);
    }
    public function findBySeason(Season $season): array
    {
        $qb = $this->createQueryBuilder('r');
        $qb->leftJoin('r.category', 'c')->addSelect('c')
            ->leftJoin('r.user', 'u')->addSelect('u')
            ->leftJoin('r.status', 's')->addSelect('s')
            ->leftJoin('r.season', 'se')->addSelect('se')
            ->leftJoin('r.activity', 'a')->addSelect('a')
            ->leftJoin('r.place', 'p')->addSelect('p');
        $qb->andWhere('r.season = :season')->setParameter('season', $season);
        $qb->orderBy('r.dateCreated', 'DESC');
        return $qb->getQuery()->getResult();
    }
    //    /**
    //     * @return Season[] Returns an array of Season objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Season
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
