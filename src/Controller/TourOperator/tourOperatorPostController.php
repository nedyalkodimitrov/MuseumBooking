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
use Symfony\Component\Validator\Constraints\DateTime;

class tourOperatorPostController extends AbstractController
{
    /**
     * @Route("/tourOperator/unbookTicket/{id}", name="tour_operator_tour_operator_post")
     */
    public function UnbookTicket($id)
    {
        return $this->render('tour_operator/tour_operator_post/adminBase.html.twig', [
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
        $reservedDate = "18/01/2021 tickets";
        $splitTextFromDate = explode(' ', $reservedDate);



        if ($reservedDate != "Today's Tickets"){
            $date = new \DateTime($splitTextFromDate[0]);
        }else{
            $date =  new \DateTime();
        }

        $ticket = new Ticket();
        $schedule = $scheduleRepository->find($scheduleId);
        $tourOperator = $tourOperatorRepository->find($tourOperatorId);
        $ticket->setNumber(intval($number));
        $ticket->setSchedule($schedule);
        $ticket->setTourOperator($tourOperator);
        $ticket->setTime(new \DateTime());
        $ticket->setBoughtDate(new \DateTime());
        $ticket->setReservedDate($date);


        $em = $this->getDoctrine()->getManager();
        $em->persist($ticket);
        $em->flush();

        return $this->json('1');

    }

    /**
     * @Route("/tourOperator/getSchedulesByDate", name="getSchedule", methods={"POST"})
     */
    public function GetScheduleByDate( \Symfony\Component\HttpFoundation\Request $request, TourOperatorRepository $tourOperatorRepository, ScheduleRepository $scheduleRepository, DayRepository $dayRepository, CustomSerializer  $customSerializer)
    {
//        $date = new \DateTime();
        $dateSplit = $request->request->get("date");
        $museumId = $request->request->get("museumId");
            var_dump($dateSplit);
            exit();
//        $dateSplit = explode('/', $dateString);

        $date =  date("l", mktime(0,0,0,$dateSplit[1],$dateSplit[0],$dateSplit[2]));


        $dayId = $dayRepository->findOneBy(["name" => $date]);

        $schedules = null;
        $schedulesData = [];
        if ($dayId != null) {
            $schedules = $scheduleRepository->findSchedulesOrdered($museumId, $dayId);
        }
        for ($i = 0; $i < count($schedules); $i++){
            $data = [];
            //[0] -> id of the schedule
            array_push($data, $schedules[$i]->getId());

            $tickets = $schedules[$i]->getTickets();
            $ticketNumber = 0;

            for ($j = 0; $j < count($tickets); $j++){
                $ticketNumber += $tickets[$j]->getNumber();
            }

            $freeSpace = $schedules[$i]->getMuseum()->getMaxCapacity() -  $ticketNumber;
           //[1] -> free space in the museum
            array_push($data, $freeSpace);
            //[2] -> museum max capacity
            array_push($data, $schedules[$i]->getMuseum()->getMaxCapacity());
            //[3] -> schedule start time
            array_push($data, $schedules[$i]->getStartTime());
            //[4] -> schedule end time
            array_push($data, $schedules[$i]->getEndTime());
            //[5] -> schedule price
            array_push($data, $schedules[$i]->getPrice());
            array_push($schedulesData, $data);
        }

        return $this->json($dateString);

    }







}
