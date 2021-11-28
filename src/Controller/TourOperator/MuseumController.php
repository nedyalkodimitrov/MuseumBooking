<?php

namespace App\Controller\TourOperator;

use App\Repository\DayRepository;
use App\Repository\MuseumRepository;
use App\Repository\MuseumReviewsRepository;
use App\Repository\ScheduleRepository;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MuseumController extends BaseController
{

    /**
     * @Route("/tourOperator/museum/{id}", name="tour_operator_show_museum")
     */
    public function showMuseum($id,MuseumReviewsRepository $museumReviewsRepository, TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {
        $museum = $museumRepository->find(intval($id));
        $tourOperator = $this->getUser()->getTourOperator();

        $date = new \DateTime();
        $dayName = $date->format("l");
        $dayId = $dayRepository->findOneBy(["name" => $dayName]);

        $schedule = null;
        if ($dayId != null) {
            $schedule = $scheduleRepository->findSchedulesOrdered($id, $dayId);
        }

        $tourOperatorTickets = $ticketRepository->getTourOperatorTicketsOrdered($tourOperator->getId(), $id);
        $museumReviews = $museumReviewsRepository->findBy(['museum' => $id],array(), 4);

        $params =  [
            'controller_name' => 'Controller',
            'museum' => $museum,
            'schedules' => $schedule,
            'tourOperatorTickets' => $tourOperatorTickets,
            'museumReviews' => $museumReviews
        ];

        return $this->customRenderView('tour_operator/museum/museum.html.twig', $params);
    }


    /**
     * @Route("/tourOperator/visitedMuseums", name="tour_operator_show_visited_museums")
     */
    public function showVisitedMuseums(TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {
        $tourOperator = $this->getUser()->getTourOperator();
        $tickets = $ticketRepository->getAllTourOperatorTicketsOrdered($tourOperator->getId());

        $params =  [
            'tickets' => $tickets,
        ];

        return $this->customRenderView('tour_operator/museum/visitedMuseums.html.twig', $params);
    }

    /**
     * @Route("/tourOperator/allMuseums", name="tour_operator_show_all_museums")
     */
    public function showAllMuseums(TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {
        $tourOperator = $this->getUser()->getTourOperator();

        $museums = $museumRepository->findAll();

        $params =  [
            'museums' => $museums
        ];

        return $this->customRenderView('tour_operator/museum/allMuseums.html.twig', $params);


    }
}
