<?php


namespace App\Service;


use App\Entity\TourOperator;
use App\Repository\TourOperatorRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SearchTourOperator
{

    public function  find(string $data, ServiceEntityRepository  $searchRepository)
    {
        $information = [];
        $result = $searchRepository->findByValue($data);

        for ($i = 0; $i < count($result); $i++)
        {
            $temp = [];
            $temp[] = $result[$i]->getImage();
            $temp[] = $result[$i]->getName()." ".$result[0]->getFName();
            $temp[] = $result[$i]->getCity()->getCountry()->getName().', '.$result[0]->getCity()->getName();
            $temp[] = $result[$i]->getVisitRating();
            $temp[] = $result[$i]->getId();
            $information[] = $temp;

        }
        if (count($information) == 0){
            return null;
        }

        return $information;

    }
}