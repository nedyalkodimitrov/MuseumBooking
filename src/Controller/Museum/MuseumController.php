<?php

namespace App\Controller\Museum;

use App\Entity\Day;
use App\Repository\DayRepository;
use App\Repository\ScheduleRepository;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class MuseumController extends AbstractController
{
    /**
     * @Route("/museum", name="museum")
     */
    public function home(TicketRepository $ticketRepository, ScheduleRepository $scheduleRepository, DayRepository $dayRepository)
    {
        $museum = $this->getUser()->getMuseum();
        $museumId = $museum->getId();
        $date = new \DateTime();
        $date->format("D");
        $dayName = $date->format("l");
        $currentTime = $date->format('H');


        $dayId = $dayRepository->findOneBy(["name" => $dayName]);

        $schedule = null;
        $images = $museum->getImages();
        if ($dayId == null) {


        }
        $schedule = $scheduleRepository->findSchedulesOrdered($museumId, $dayId);

        $bestTickets = [];
        for ($i = 0; $i < count($schedule); $i++) {
            if ($schedule[$i]->getEndTime() > $currentTime) {

                $bestTickets = $ticketRepository->getBestMuseumTicketsOrdered($museumId, $currentTime);

            }
        }

        return $this->render('museum/home/index.html.twig', [
            'controller_name' => 'MuseumController',
            'images' => $images,
            'schedules' => $schedule,
            'dayName' => $dayName,
            'bestTickets' => $bestTickets
        ]);
    }

    /**
     * @Route("/museum/settings", name="museum_settings")
     */
    public function museumSettings()
    {
        $museum = $this->getUser()->getMuseum();
        $images = $museum->getImages();

        return $this->render('museum/settings/settings.html.twig', [
            'controller_name' => 'MuseumController',
            'images' => $images
        ]);
    }

    /**
     * @Route("/museum/schedule", name="museum_schedule")
     */
    public function schedule(ScheduleRepository $scheduleRepository, DayRepository $dayRepository)
    {
        $museum = $this->getUser()->getMuseum();
        $schedule = [];
        $days = $dayRepository->findAll();
        for ($i = 0; $i < count($days); $i++) {
            $daySchedule = [];

            array_push($daySchedule, $days[$i]);
            $scheduleForDay = $scheduleRepository->findSchedulesOrdered($museum, $days[$i]);
            array_push($daySchedule, $scheduleForDay);
            array_push($schedule, $daySchedule);


        }
        return $this->render('museum/schedule/schedule.html.twig', [
            'controller_name' => 'MuseumController',
            'schedules' => $schedule,
        ]);
    }


    /**
     * @Route("/museum/stats", name="museum_stats")
     */
    public function stats(ScheduleRepository $scheduleRepository, DayRepository $dayRepository)
    {
        $museum = $this->getUser()->getMuseum();
        $reviews = $museum->getReviews();


        return $this->render('museum/stats/stats.html.twig', [
            'controller_name' => 'MuseumController',
            'reviews' => $reviews

        ]);
    }

}