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


    public function findByValue($value)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT t
            FROM App\Entity\TourOperator t
            INNER JOIN t.city c 
            WHERE t.name LIKE :value or t.fName Like :value or c.name Like :value
            ORDER BY t.name ASC'
        )->setParameter('value', '%' . $value.'%');

        // returns an array of Product objects
        return $query->getResult();
    }

    public function getBestReview($tourOperatorId)
    {
        $entityManager = $this->getEntityManager();



        $query = $entityManager->createQuery(
            'SELECT r
            FROM App\Entity\MuseumReview r
            INNER JOIN r.tourOperator t 
            WHERE t.id = :value
            ORDER BY r.rating ASC'
        )->setParameter('value',  $tourOperatorId)
        ->setMaxResults(1);

        // returns an array of Product objects
        return $query->getResult();
    }

}
