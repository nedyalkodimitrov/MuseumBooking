<?php

namespace App\Repository;

use App\Entity\TourOperator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TourOperator|null find($id, $lockMode = null, $lockVersion = null)
 * @method TourOperator|null findOneBy(array $criteria, array $orderBy = null)
 * @method TourOperator[]    findAll()
 * @method TourOperator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TourOperatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TourOperator::class);
    }

    // /**
    //  * @return TourOperator[] Returns an array of TourOperator objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TourOperator
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
