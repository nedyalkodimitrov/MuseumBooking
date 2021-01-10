<?php


namespace App\Service;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SearchMuseum
{
    public function  searchTourOperator(string $data, ServiceEntityRepository  $museumRepository)
    {
        $information = [];
        $result = $museumRepository->findByValue($data);

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($information, $result[0]->getImage());
            array_push($information, $result[0]->getMuseumName());
            array_push($information, $result[0]->getCity()->getCountry()->getName().', '.$result[0]->getCity()->getName());
            array_push($information, $result[0]->getRating());
            array_push($information, $result[0]->getId());

        }
        if (count($information) == 0){
            return null;
        }
        return $information;

    }
}