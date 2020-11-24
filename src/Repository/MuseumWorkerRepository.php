<?php

namespace App\Repository;

use App\Entity\MuseumWorker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MuseumWorker|null find($id, $lockMode = null, $lockVersion = null)
 * @method MuseumWorker|null findOneBy(array $criteria, array $orderBy = null)
 * @method MuseumWorker[]    findAll()
 * @method MuseumWorker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MuseumWorkerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MuseumWorker::class);
    }

    // /**
    //  * @return MuseumWorker[] Returns an array of MuseumWorker objects
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
    public function findOneBySomeField($value): ?MuseumWorker
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
