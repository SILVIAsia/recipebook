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

    /* public function findLastRecettes():Array
     {
         $dql = "SELECT r
                 FROM App\Entity\Recette r
                 Where r.cooktime > 5
                 ORDER BY r.dateCreated DESC";

         //aqui abjo recupero el entity manager y esto en el repository utilise la methode que forni getem
         $em = $this->getEntityManager();
         $query = $em->createQuery($dql);
         $query->setMaxResults(5);
         return $query->getResult();
     }*/

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
        $query->setMaxResults(10);
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
