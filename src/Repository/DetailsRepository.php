<?php

namespace App\Repository;

use App\Entity\Details;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Details>
 */
class DetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Details::class);
    }

    public function getDetails (int $commande)
    {
        return $this->getEntityManager()->createQuery('SELECT d FROM App\Entity\Details d JOIN App\Entity\Articles a 
            WITH (a.id = d.articles) WHERE d.commande = :commande;
        ')->setParameter('commande', $commande)->getResult();
    }

//    /**
//     * @return Details[] Returns an array of Details objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Details
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
