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

    public function getBestMuseumTicketsOrdered($museumId, $currentTime)
    {

        return    $qb = $this->createQueryBuilder('t')
            ->leftJoin('t.schedule', 's')
            ->where('s.museum = :museumId')
            ->andWhere('s.endTime > :currentTime')
            ->setParameter('museumId', $museumId)
            ->setParameter('currentTime', $currentTime)
            ->orderBy('t.number', 'ASC')
            ->getQuery()
            ->getResult();


//        return  $this->getEntityManager()->createQuery(
//        'SELECT t FROM App\Entity\Ticket t Join App\Entity\Schedule s ON t.schedule_id = s.id WHERE s.museum_id = 1 ORDER BY number ASC LIMIT 2'
//        )
//            ->setParameter('museumId', $value)
//            ->getResult();
    }

    public function getTourOperatorTicketsOrdered($tourOperatorId)
    {

        return    $qb = $this->createQueryBuilder('t')
            ->where('t.tourOperator = :tourOperatorId')
            ->setParameter('tourOperatorId', $tourOperatorId)
            ->orderBy('t.reservedDate', 'ASC')
            ->addOrderBy('t.number', 'ASC')

            ->getQuery()
            ->getResult();


//        return  $this->getEntityManager()->createQuery(
//        'SELECT t FROM App\Entity\Ticket t Join App\Entity\Schedule s ON t.schedule_id = s.id WHERE s.museum_id = 1 ORDER BY number ASC LIMIT 2'
//        )
//            ->setParameter('museumId', $value)
//            ->getResult();
    }
}
