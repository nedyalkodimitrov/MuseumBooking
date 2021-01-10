<?php


namespace App\Service;


use App\Entity\TourOperator;
use App\Repository\TicketRepository;
use App\Repository\TourOperatorRepository;

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

    public function getBestReview($tourOperatorId, TourOperatorRepository $tourOperatorRepository)
    {

        $bestReview = $tourOperatorRepository->getBestReview($tourOperatorId);

        return $bestReview[0];


    }

   public function getTickets($tourOperatorId, TicketRepository $ticketRepository)
    {

        $tickets = $ticketRepository->findBy(['tourOperator' => $tourOperatorId]);

        return $tickets;


    }

}