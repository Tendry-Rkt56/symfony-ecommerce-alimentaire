<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Articles>
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }

    public function getArticlesInPanier (mixed $ids)
    {
        return $this->getEntityManager()->createQuery('SELECT a FROM App\Entity\Articles a LEFT JOIN 
            App\Entity\Category c WITH (c.id = a.category) WHERE a.id IN (:param)
        ')
        ->setParameter('param', $ids)
        ->getResult();
    }

    public function getArticles ()
    {
        return $this->createQueryBuilder('a')
                ->select('a', 'c')
                ->leftJoin('a.category', 'c')
                ->getQuery()
                ->getResult();
    }

    public function getPaginator (int $page, int $limit)
    {
        return new Paginator($this->createQueryBuilder('a')
                ->orderBy('a.id', 'ASC')
                ->setFirstResult(($page - 1) * $limit)
                ->setMaxResults($limit)
                ->getQuery()
                ->setHint(Paginator::HINT_ENABLE_DISTINCT,true)
        );
    }

    //    /**
    //     * @return Articles[] Returns an array of Articles objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Articles
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
