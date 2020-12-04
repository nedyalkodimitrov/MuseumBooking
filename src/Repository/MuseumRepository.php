<?php

namespace App\Repository;

use App\Entity\Museum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Museum|null find($id, $lockMode = null, $lockVersion = null)
 * @method Museum|null findOneBy(array $criteria, array $orderBy = null)
 * @method Museum[]    findAll()
 * @method Museum[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MuseumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Museum::class);
    }

    // /**
    //  * @return Museum[] Returns an array of Museum objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Museum
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
