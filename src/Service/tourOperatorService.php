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

        if ($bestReview == null){
            return null;
        }
        return $bestReview[0];


    }

   public function getTickets($tourOperatorId, TicketRepository $ticketRepository)
    {

        $tickets = $ticketRepository->findBy(['tourOperator' => $tourOperatorId]);

        return $tickets;


    }

    public function getBestTourOperator( TourOperatorRepository $tourOperatorRepository)
    {

       $bestTourOperators = $tourOperatorRepository->findBy(array(), array('visitRating' => 'DESC'), 10);
        return $bestTourOperators;


    }

    public function getVisitedMuseums($tourOperatorId, TicketRepository $ticketRepository, TourOperatorRepository  $tourOperatorRepository)
    {
        $tourOperator = $tourOperatorRepository->find($tourOperatorId);
        $tickets = $tourOperator->getTickets();
        $visitedMuseums =  [];
        for ($j = 0; $j < count($tickets); $j++){
            $ticket = $tickets[$j];

            $museum = [];
            if ($ticket->getHasCome()){
                for ($i = 0; $i < count($visitedMuseums); $i++){
                    if ($ticket->getSchedule()->getMuseum() == $visitedMuseums[$i][0]->getSchedule()->getMuseum()){
                        $visitedMuseums[$i][1]++;
                        continue;
                    }
                }
                $museum[0] = $ticket;
                $museum[1] = 1;
                array_push($visitedMuseums, $museum);

            }
        }

        return $visitedMuseums;

    }




}