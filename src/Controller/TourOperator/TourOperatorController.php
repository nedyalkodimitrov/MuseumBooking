<?php

namespace App\Controller\TourOperator;

use App\Entity\Schedule;
use App\Repository\DayRepository;
use App\Repository\MuseumRepository;
use App\Repository\ScheduleRepository;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TourOperatorController extends AbstractController
{
    /**
     * @Route("/tourOperator", name="tour_operator")
     */
    public function home()
    {
        return $this->render('tour_operator/home/index.html.twig', [
            'controller_name' => 'TourOperatorController',
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
     * @Route("/tourOperator/museum/{id}", name="tour_operator_settings")
     */
    public function museum($id, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
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


        return $this->render('tour_operator/museum/museum.html.twig', [
            'controller_name' => 'TourOperatorController',
            'museum' => $museum,
            'schedules' => $schedule,
            'tourOperator' => $tourOperator
        ]);
    }

}
