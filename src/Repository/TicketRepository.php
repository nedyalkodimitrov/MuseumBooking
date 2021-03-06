<?php

namespace App\Repository;

use App\Entity\Schedule;
use App\Entity\Ticket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ticket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ticket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ticket[]    findAll()
 * @method Ticket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }

    // /**
    //  * @return Ticket[] Returns an array of Ticket objects
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
    public function findOneBySomeField($value): ?Ticket
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getBestMuseumTicketsOrdered($museumId, $currentTime, $today)
    {

        return    $qb = $this->createQueryBuilder('t')
            ->leftJoin('t.schedule', 's')
            ->where('s.museum = :museumId')
            ->andWhere('s.endTime > :currentTime')
            ->andWhere('t.reservedDate = :today')
            ->setParameter('museumId', $museumId)
            ->setParameter('currentTime', $currentTime)
            ->setParameter('today', $today)
            ->orderBy('t.number', 'ASC')
            ->getQuery()
            ->getResult();

    }

    public function getTourOperatorTicketsOrdered($tourOperatorId, $museumId)
    {

        return    $qb = $this->createQueryBuilder('t')
            ->leftJoin('t.schedule', 's')
            ->where('t.tourOperator = :tourOperatorId')
            ->andWhere('s.museum = :museumsId')
            ->setParameter('tourOperatorId', $tourOperatorId)
            ->setParameter('museumsId', $museumId)
            ->orderBy('t.reservedDate', 'ASC')
            ->addOrderBy('t.number', 'ASC')
            ->getQuery()
            ->getResult();


    }
    public function getAllTourOperatorTicketsOrdered($tourOperatorId)
    {

        return    $qb = $this->createQueryBuilder('t')
            ->where('t.tourOperator = :tourOperatorId')
            ->setParameter('tourOperatorId', $tourOperatorId)
            ->orderBy('t.reservedDate', 'ASC')
            ->addOrderBy('t.number', 'ASC')
            ->getQuery()
            ->getResult();


    }
}
