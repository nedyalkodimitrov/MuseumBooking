<?php

namespace App\Repository;

use App\Entity\MuseumReview;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MuseumReview|null find($id, $lockMode = null, $lockVersion = null)
 * @method MuseumReview|null findOneBy(array $criteria, array $orderBy = null)
 * @method MuseumReview[]    findAll()
 * @method MuseumReview[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MuseumReviewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MuseumReview::class);
    }

    // /**
    //  * @return MuseumReview[] Returns an array of MuseumReview objects
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
    public function findOneBySomeField($value): ?MuseumReview
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
