<?php


namespace App\Service;


use App\Entity\TourOperator;

class tourOperatorService
{
    public function  changeVisitRating(TourOperator $tourOperator)
    {

        $allTourOperatorTickets = $tourOperator->getTickets();
        $visitedMuseums = 0;

        foreach ($allTourOperatorTickets as $operatorTicket)
        {
            if ($operatorTicket->getHasCome()){
                $visitedMuseums++;
            }
        }

        return [$visitedMuseums, $allTourOperatorTickets];

    }
}