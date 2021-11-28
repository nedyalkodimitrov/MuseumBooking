<?php

namespace App\Service;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SearchLandmark
{
    public function  find(string $data, ServiceEntityRepository  $landmarkRepository)
    {
        $information = [];

        $result = $landmarkRepository->findByValue($data);

        for ($i = 0; $i < count($result); $i++)
        {
            $temp_info = [];
            $temp_info[] =  $result[0]->getImage();
            $temp_info[] = $result[0]->getName();
            $temp_info[] = $result[0]->getCity()->getCountry()->getName().', '.$result[0]->getCity()->getName();
            $temp_info[] = $result[0]->getRating();
            $temp_info[] = $result[0]->getId();
            $information[] = $temp_info;

        }
        if (count($information) == 0){
            return null;
        }

        return $information;

    }
}