<?php


namespace App\Service;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SearchMuseum
{
    public function  find(string $data, ServiceEntityRepository  $museumRepository)
    {
        $information = [];
        $result = $museumRepository->findByValue($data);

        for ($i = 0; $i < count($result); $i++)
        {
            $temp = [];

            $temp[] = $result[0]->getImage();
            $temp[] = $result[0]->getMuseumName();
            $temp[] = $result[0]->getCity()->getCountry()->getName().', '.$result[0]->getCity()->getName();
            $temp[] = $result[0]->getRating();
            $temp[] = $result[0]->getId();
            $information[] = $temp;

        }
        if (count($information) == 0){
            return null;
        }
        return $information;

    }
}