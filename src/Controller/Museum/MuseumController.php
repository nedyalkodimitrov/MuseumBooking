<?php

namespace App\Controller\Museum;

use App\Entity\Day;
use App\Repository\DayRepository;
use App\Repository\ScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MuseumController extends AbstractController
{
    /**
     * @Route("/museum", name="museum")
     */
    public function home(ScheduleRepository $scheduleRepository)
    {
        $museum = $this->getUser()->getMuseum();
        $images = $museum->getImages();
        $schedule = $scheduleRepository->findBy(["day"=>1]);

        return $this->render('museum/home/index.html.twig', [
            'controller_name' => 'MuseumController',
            'images' => $images,
            'schedules' => $schedule,
        ]);
    }
    /**
     * @Route("/museum/settings", name="museum_settings")
     */
    public function museumSettings()
    {
        return $this->render('museum/settings/settings.html.twig', [
            'controller_name' => 'MuseumController',
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
            for ($i = 0; $i < count($days); $i++){
                $daySchedule = [];

                array_push($daySchedule, $days[$i]);
                $scheduleForDay = $scheduleRepository->findBy(["museum" => $museum, "day" => $days[$i]]);
                array_push($daySchedule, $scheduleForDay);
                array_push($schedule, $daySchedule);



            }
        return $this->render('museum/schedule/schedule.html.twig', [
            'controller_name' => 'MuseumController',
            'schedules' =>$schedule,
        ]);
    }

}
