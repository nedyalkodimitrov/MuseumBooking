<?php

namespace App\Service;

use App\Controller\TourOperator\MuseumController;
use App\Entity\Museum;
use App\Entity\TourOperator;

class UserNameService
{
    public function getTourOperatorUserName(TourOperator $tourOperator){

        return $tourOperator->getName();
    }


    public function getMuseumUserName(Museum $museum){

        return $museum->getName();
    }


}