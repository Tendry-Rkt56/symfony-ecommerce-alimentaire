<?php

namespace App\Repository;

use App\Entity\Notifications;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Notifications>
 */
class NotificationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notifications::class);
    }

    public function getNotifications ()
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT n FROM App\Entity\Notifications n JOIN App\Entity\Commandes c 
                    WITH (n.commande = c.id) WHERE c.finished = false')
                ->getResult();
    }

    public function getAll ()
    {
        return $this->createQueryBuilder('n')
                    ->orderBy('n.id', 'DESC')
                    ->getQuery()
                    ->getResult();
    }

    public function setRead ()
    {
        return $this->createQueryBuilder('n')
                    ->update()
                    ->set('n.isRead', ':isRead')
                    ->where('n.isRead = :valeur')
                    ->setParameter('isRead', true)
                    ->setParameter('valeur', false)
                    ->getQuery()
                    ->execute();
    }

    //    /**
    //     * @return Notifications[] Returns an array of Notifications objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('n.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Notifications
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
