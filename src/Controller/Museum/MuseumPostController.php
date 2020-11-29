<?php

namespace App\Controller\Museum;

use App\Entity\Schedule;
use App\Repository\DayRepository;
use App\Repository\ScheduleRepository;
use App\Repository\TicketRepository;
use App\Service\tourOperatorService;
use Symfony\Component\HttpFoundation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MuseumPostController extends AbstractController
{
    /**
     * @Route("/museum/createSchedule", name="create-schedule")
     */
    public function index(HttpFoundation\Request $request, DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {

        $startTimeStr = $request->request->get("startTime");
        $endTimeStr = $request->request->get("endTime");
        $dayName = $request->request->get("dayName");

        $startTime = new \DateTime($startTimeStr);
        $endTime = new \DateTime($endTimeStr);
        $day = $dayRepository->findOneBy(["name" => $dayName]);

        $museum = $this->getUser()->getMuseum();
        $schedulesForDay = $scheduleRepository->findBy(["day" => $day, "museum" => $museum]);
        if (count($schedulesForDay) > 6){
            return $this->json("Max");
        }
        $equallySchedule = $scheduleRepository->findBy(["day" => $day, "museum" => $museum, "startTime" => $startTime] );
        if ($equallySchedule){
            return $this->json("Equally");
        }
        $schedule = new Schedule();

        $schedule->setDay($day);
        $schedule->setMuseum($museum);
        $schedule->setStartTime($startTime);
        $schedule->setEndTime($endTime);

        $em = $this->getDoctrine()->getManager();

        $em->persist($schedule);
        $em->flush();

        return $this->json(1);

    }

    /**
     * @Route("/museum/deleteSchedule", name="delete-schedule")
     */
    public function deleteSchedule(HttpFoundation\Request $request, DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {

        $startTimeStr = $request->request->get("startTime");
        $endTimeStr = $request->request->get("endTime");
        $dayName = $request->request->get("dayName");


        $startTime = new \DateTime($startTimeStr);
        $endTime = new \DateTime($endTimeStr);
        $day = $dayRepository->findOneBy(["name" => $dayName]);

        $museum = $this->getUser()->getMuseum();

        $equallySchedule = $scheduleRepository->findBy(["day" => $day, "museum" => $museum, "startTime" => $startTime]);

        if ($equallySchedule) {
            $em = $this->getDoctrine()->getManager();

            $em->remove($equallySchedule[0]);
            $em->flush();

            return $this->json("ex");
        }

    }


    /**
     * @Route("/museum/userHasCome", name="delete-schedule")
     */
    public function userHasCome(HttpFoundation\Request $request, TicketRepository  $ticketRepository, tourOperatorService  $tourOperatorService)
    {
        $ticketId = $request->request->get("ticketId");

        //set that operator visited museum
        $ticket = $ticketRepository->find(1);
        $ticket->setHasCome(true);

        //change operator visit rate
        $tourOperator = $ticket->getTourOperator();

        //result[0] --> visitedMuseums
        //result[1] --> allTourOperatorTickets
        $result = $tourOperatorService->changeVisitRating($tourOperator);

        $tourOperator->setVisitRating(5* ($result[0] / count($result[1])));

        $em = $this->getDoctrine()->getManager();
        $em->persist($ticket);
        $em->persist($tourOperator);
        $em->flush();

        return $this->json( 5* ($result[0] / count($result[1])));

    }


    /**
     * @Route("/museum/userHasNotCome", name="delete-schedule")
     */
    public function userHasNotCome(HttpFoundation\Request $request, TicketRepository  $ticketRepository, tourOperatorService $tourOperatorService)
    {
        $ticketId = $request->request->get("ticketId");

        $ticket = $ticketRepository->find(1);

        $tourOperator = $ticket->getTourOperator();


        //result[0] --> visitedMuseums
        //result[1] --> allTourOperatorTickets
        $result = $tourOperatorService->changeVisitRating($tourOperator);


        $tourOperator->setVisitRating(5* ($result[0] / count($result[1])));

        $em = $this->getDoctrine()->getManager();
        $em->persist($tourOperator);
        $em->flush();

        return $this->json( 5* ($result[0] / count($result[1])));
    }

}
