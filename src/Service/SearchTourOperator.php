<?php


namespace App\Service;


use App\Entity\TourOperator;
use App\Repository\TourOperatorRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SearchTourOperator
{

    public function  searchTourOperator(string $data, ServiceEntityRepository  $searchRepository)
    {
        $information = [];
        $result = $searchRepository->findByValue($data);

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($information, $result[0]->getImage());
            array_push($information, $result[0]->getName()." ".$result[0]->getFName());
            array_push($information, $result[0]->getCity()->getCountry()->getName().', '.$result[0]->getCity()->getName());
            array_push($information, $result[0]->getVisitRating());
            array_push($information, $result[0]->getId());

        }
        if (count($information) == 0){
            return null;
        }

        return $information;

    }
}