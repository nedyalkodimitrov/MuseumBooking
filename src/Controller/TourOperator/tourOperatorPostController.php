<?php

namespace App\Controller\TourOperator;

use App\Entity\Ticket;
use App\Repository\DayRepository;
use App\Repository\ScheduleRepository;
use App\Repository\TourOperatorRepository;
use App\Service\CustomSerializer;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class tourOperatorPostController extends AbstractController
{
    /**
     * @Route("/tourOperator/unbookTicket/{id}", name="tour_operator_tour_operator_post")
     */
    public function UnbookTicket($id)
    {
        return $this->render('tour_operator/tour_operator_post/index.html.twig', [
            'controller_name' => 'tour/operator/pourOperatorPostController',
        ]);
    }


    /**
     * @Route("/tourOperator/bookTicket", name="tour_operator_tour_operator_post")
     */
    public function BookTicket(\Symfony\Component\HttpFoundation\Request $request, TourOperatorRepository $tourOperatorRepository, ScheduleRepository $scheduleRepository)
    {
        $tourOperator = $this->getUser()->getTourOperator();
        $tourOperatorId = $tourOperator->getId();

        $number = $request->request->get("number");
        $scheduleId = $request->request->get("scheduleId");
        $reservedDate = $request->request->get("reservedDate");

        $ticket = new Ticket();
        $schedule = $scheduleRepository->find($scheduleId);
        $tourOperator = $tourOperatorRepository->find($tourOperatorId);
        $ticket->setNumber(intval($number));
        $ticket->setSchedule($schedule);
        $ticket->setTourOperator($tourOperator);
        $ticket->setTime(new \DateTime());
        $ticket->setBoughtDate(new \DateTime());
        $ticket->setReservedDate(new \DateTime());


        $em = $this->getDoctrine()->getManager();
        $em->persist($ticket);
        $em->flush();

        return $this->json('1');

    }

    /**
     * @Route("/tourOperator/getSchedulesByDate", name="tour_operator_tour_operator_post")
     */
    public function GetScheduleByDate( \Symfony\Component\HttpFoundation\Request $request, TourOperatorRepository $tourOperatorRepository, ScheduleRepository $scheduleRepository, DayRepository $dayRepository, CustomSerializer  $customSerializer)
    {
//        $date = new \DateTime();
        $date = $request->request->get("date");
//        $dayName = $date->format("l");

        $museumId = $request->request->get("museumId");
        $dayName = "Friday";
        $dayId = $dayRepository->findOneBy(["name" => $dayName]);

        $schedules = null;
        $schedulesData = [];
        if ($dayId != null) {
            $schedules = $scheduleRepository->findSchedulesOrdered(1, 1);

        }

        for ($i = 0; $i < count($schedules); $i++){
            $data = [];
            array_push($data, $schedules[$i]->getDate());


        }


        exit;
    }







}
