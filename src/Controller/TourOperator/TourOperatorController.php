<?php

namespace App\Controller\TourOperator;

use App\Entity\Image;
use App\Entity\Schedule;
use App\Repository\DayRepository;
use App\Repository\MuseumRepository;
use App\Repository\ScheduleRepository;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TourOperatorController extends AbstractController
{
    private const  ImagePath = "images/tourOperator/";

    /**
     * @Route("/tourOperator", name="tour_operator")
     */
    public function home(MuseumRepository $museumRepository)
    {
        $tourOperator = $this->getUser()->getTourOperator();
        $tickets = $tourOperator->getTickets();

        $topMuseums = $museumRepository->getTopMuseums();
        return $this->render('tour_operator/home/index.html.twig', [
            'controller_name' => 'TourOperatorController',
            'tickets' => $tickets,
            'topMuseums' => $topMuseums,
            'userName' => $tourOperator->getName() .' '. $tourOperator->getFName(),
            'userImage' => self::ImagePath.$tourOperator->getImage()
        ]);
    }
    /**
     * @Route("/tourOperator/settings", name="tour_operator_schedule")
     */
    public function settings()
    {
        return $this->render('tour_operator/schedule/schedule.html.twig', [
            'controller_name' => 'TourOperatorController',

        ]);
    }
    /**
     * @Route("/tourOperator/museum/{id}", name="tour_operator_museumView")
     */
    public function museum($id,TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {
        $museum = $museumRepository->find(intval($id));
        $tourOperator = $this->getUser()->getTourOperator();

        $date = new \DateTime();
        $dayName = $date->format("l");

        $dayId = $dayRepository->findOneBy(["name" => $dayName]);

        $schedule = null;

        if ($dayId == null) {


        }
        $schedule = $scheduleRepository->findSchedulesOrdered($id, 1);
        $tourOperatorTickets = $ticketRepository->getTourOperatorTicketsOrdered($tourOperator->getId());

        return $this->render('tour_operator/museum/museum.html.twig', [
            'controller_name' => 'TourOperatorController',
            'museum' => $museum,
            'schedules' => $schedule,
            'tourOperatorTickets' => $tourOperatorTickets,
            'userName' => $tourOperator->getName() .' '. $tourOperator->getFName(),
            'userImage' => self::ImagePath.$tourOperator->getImage()
        ]);
    }

    /**
     * @Route("/tourOperator/stats", name="tour_operator_stats")
     */
    public function stats($id,TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {

    }

    /**
     * @Route("/tourOperator/visitedMuseums", name="tour_operator_visitedMuseums")
     */
    public function visitedMuseums(TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {
        $tourOperator = $this->getUser()->getTourOperator();
        $tickets = $ticketRepository->getTourOperatorTicketsOrdered($tourOperator->getId());

        return $this->render('tour_operator/museum/visitedMuseums.html.twig', [
            'controller_name' => 'TourOperatorController',
            'tickets' => $tickets,
            'userName' => $tourOperator->getName() .' '. $tourOperator->getFName(),
            'userImage' => self::ImagePath.$tourOperator->getImage()

        ]);


    }

    /**
     * @Route("/tourOperator/boughtTickets", name="tour_operator_boughtTickets")
     */
    public function boughtTickets($id,TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {

    }


}
