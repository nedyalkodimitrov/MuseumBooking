<?php

namespace App\Repository;

use App\Entity\Landmark;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Landmark|null find($id, $lockMode = null, $lockVersion = null)
 * @method Landmark|null findOneBy(array $criteria, array $orderBy = null)
 * @method Landmark[]    findAll()
 * @method Landmark[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LandmarkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Landmark::class);
    }


    public function findByValue($value)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT landmark
            FROM App\Entity\Landmark landmark
            INNER JOIN landmark.city city 
            INNER JOIN city.country country 
            WHERE landmark.name LIKE :value or city.name Like :value or country.name Like :value
            ORDER BY landmark.name ASC'
        )->setParameter('value', '%' . $value.'%');

        // returns an array of Product objects
        return $query->getResult();
    }
}

