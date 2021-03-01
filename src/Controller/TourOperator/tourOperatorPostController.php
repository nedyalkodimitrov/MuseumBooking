<?php

namespace App\Controller\TourOperator;

use App\Entity\MuseumReview;
use App\Entity\Ticket;
use App\Repository\DayRepository;
use App\Repository\MuseumRepository;
use App\Repository\ScheduleRepository;
use App\Repository\TicketRepository;
use App\Repository\TourOperatorRepository;
use App\Service\CustomSerializer;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

class tourOperatorPostController extends AbstractController
{
    /**
     * @Route("/tourOperator/unbookTicket/{id}", name="tour_operator_unbook")
     */
    public function UnbookTicket($id, TicketRepository $ticketRepository)
    {
       $tourOperator = $this->getUser()->getTourOperator();
       $ticket = $ticketRepository->find($id);

       $em = $this->getDoctrine()->getManager();
       $em->remove($ticket);
       $em->flush();
       return $this->json(1);
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
        $splitTextFromDate = explode(' ', $reservedDate);



        if ($reservedDate != "Today's Tickets"){
            $digits = explode('/', $splitTextFromDate[0]);
            $newDate = $digits[0].'-'.$digits[1].'-'.$digits[2];
            var_dump($splitTextFromDate);
            $date = new \DateTime($newDate);
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


        $dateSplit = explode('/', $dateSplit);

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

        return $this->json($schedulesData);

    }


    /**
     * @Route("/tourOperator/makeReview", name="makeReview", methods={"POST"})
     */
    public function makeReview(MuseumRepository $museumRepository,  \Symfony\Component\HttpFoundation\Request $request, TourOperatorRepository $tourOperatorRepository, ScheduleRepository $scheduleRepository, DayRepository $dayRepository, CustomSerializer  $customSerializer)
    {
        $tourOperator = $this->getUser()->getTourOperator();
        $em = $this->getDoctrine()->getManager();

        $text = $request->request->get('text');
        $rating = $request->request->get('rating');
        $museumId = $request->request->get('museumId');
        $date = date('Y-m-d');
        $museum = $museumRepository->find(intval($museumId));

        $review = new MuseumReview();

        $review->setText($text);
        $review->setRating(intval($rating));
        $review->setTourOperator($tourOperator);
        $review->setMuseum($museum);
        $review->setDate($date);

        $em->persist($review);
        $em->flush();
        return $this->json(1);


    }




}
