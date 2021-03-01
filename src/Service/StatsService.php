<?php


namespace App\Service;


use App\Repository\DayRepository;
use App\Repository\ScheduleRepository;
use App\Repository\TicketRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class StatsService
{


    public function getDaysVisitors($museumid,ScheduleRepository $scheduleRepository, DayRepository $dayRepository)
    {
       $days = $dayRepository->findAll();
       $daysVisits = [];
       foreach ($days as $day){
           $dayVisits = 0;
           $schedules = $scheduleRepository->findBy(['museum' => $museumid, 'day' => $day->getId()]);
           foreach ($schedules as $schedule){
               $tickets = count($schedule->getTickets());
               $dayVisits += $tickets;
           }
          $dayVisits = $dayVisits / count($schedules);
           array_push($daysVisits, $dayVisits);
       }
       return $daysVisits;


    }

    public function getMostVisitedHour($museumid,ScheduleRepository $scheduleRepository, DayRepository $dayRepository)
    {
        $days = $dayRepository->findAll();

        $bestSchedule = 0;
        $bestScheduleTickets = 0;
        foreach ($days as $day){

            $schedules = $scheduleRepository->findBy(['museum' => $museumid, 'day' => $day->getId()]);

            foreach ($schedules as $schedule){
                $tickets = count($schedule->getTickets());

                if ($bestScheduleTickets < $tickets){
                    $bestScheduleTickets = $tickets;
                    $bestSchedule = $schedule;
                }

            }

        }
        return $bestSchedule;


    }
    public function getMostVisitedDay($museumid,ScheduleRepository $scheduleRepository, DayRepository $dayRepository)
    {
        $days = $dayRepository->findAll();

        $mostVisitedDay = 0;
        $mostVisitedDayTickets = 0;
        foreach ($days as $day){

            $schedules = $scheduleRepository->findBy(['museum' => $museumid, 'day' => $day->getId()]);
            $tickets = 0;
            foreach ($schedules as $schedule){
                $tickets += count($schedule->getTickets());



            }
            if ($mostVisitedDayTickets  < $tickets){
                $mostVisitedDayTickets = $tickets;
                $mostVisitedDay = $day->getName();
            }

        }
        return $mostVisitedDay;


    }

}