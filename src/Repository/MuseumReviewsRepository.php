<?php

namespace App\Repository;

use App\Entity\MuseumReviews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MuseumReviews|null find($id, $lockMode = null, $lockVersion = null)
 * @method MuseumReviews|null findOneBy(array $criteria, array $orderBy = null)
 * @method MuseumReviews[]    findAll()
 * @method MuseumReviews[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MuseumReviewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MuseumReviews::class);
    }

    // /**
    //  * @return MuseumReviews[] Returns an array of MuseumReviews objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MuseumReviews
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
