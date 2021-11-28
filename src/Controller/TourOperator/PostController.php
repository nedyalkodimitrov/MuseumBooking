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
use function PHPUnit\Framework\throwException;

class PostController extends AbstractController
{
    /**
     * @Route("/tourOperator/unbookTicket/{id}", name="tour_operator_unbook")
     */
    public function removeTicket($id, TicketRepository $ticketRepository)
    {
       $ticket = $ticketRepository->find($id);

       $em = $this->getDoctrine()->getManager();
       $em->remove($ticket);
       $em->flush();
       return $this->json(1);
    }


    /**
     * @Route("/tourOperator/bookTicket", name="tour_operator_add_Ticket", methods={"POST"})
     */
    public function addTicket(\Symfony\Component\HttpFoundation\Request $request, TourOperatorRepository $tourOperatorRepository, ScheduleRepository $scheduleRepository)
    {
        $scheduleId = $request->request->get("scheduleId");
        $number = $request->request->get("number");
        $reservedDate = $request->request->get("reservedDate");

        $tourOperator = $this->getUser()->getTourOperator();
        $schedule = $scheduleRepository->find($scheduleId);

        $splitTextFromDate = explode(' ', $reservedDate);
        if ($reservedDate != "Today's Tickets"){
            $digits = explode('/', $splitTextFromDate[0]);
            $newDate = $digits[0].'/'.$digits[1].'/'.$digits[2];
            var_dump($splitTextFromDate);
            $date = new \DateTime($newDate);
        }else{
            $date =  new \DateTime();
        }

        $params = [
            "number" => $number,
            "reserveDate" => $date,
        ];
        $this->postTicketByTorOperatorToSchedule($tourOperator, $schedule, $params);

        return $this->json('1');
    }

    /**
     * @Route("/tourOperator/getSchedulesByDate", name="tour_operator__getSchedule", methods={"POST"})
     */
    public function getScheduleByDate( \Symfony\Component\HttpFoundation\Request $request, TourOperatorRepository $tourOperatorRepository, ScheduleRepository $scheduleRepository, DayRepository $dayRepository, CustomSerializer  $customSerializer)
    {
        $dateStr = $request->request->get("date");
        $museumId = $request->request->get("museumId");

        $date = $this->convertToDate($dateStr);

        $dayId = $dayRepository->findOneBy(["name" => $date]);

        if ($dayId == null) {
           throwException('No such day ');
        }

        $schedules = $this->fetchSchedulesByMuseumAndDay($museumId, $dayId);

        return $this->json($schedules);

    }


    /**
     * @Route("/tourOperator/makeReview", name="tour_operator__createReview", methods={"POST"})
     */
    public function createReview(MuseumRepository $museumRepository,  \Symfony\Component\HttpFoundation\Request $request, TourOperatorRepository $tourOperatorRepository, ScheduleRepository $scheduleRepository, DayRepository $dayRepository, CustomSerializer  $customSerializer)
    {

        $text = $request->request->get('text');
        $rating = $request->request->get('rating');
        $museumId = $request->request->get('museumId');
        $date = date('Y-m-d');

        $tourOperator = $this->getUser()->getTourOperator();
        $museum = $museumRepository->find(intval($museumId));

        $params = [
            'text' => $text,
            'rating' => $rating,
            'date' => $date,
            ];

        $this->postReviewByTorOperatorToMuseum($tourOperator, $museum, $params);

        return $this->json(1);

    }


    private function convertToDate($dateStr){
        $dateSplit = explode('/', $dateStr);
        $formatDate =  date("l", mktime(0,0,0,$dateSplit[1],$dateSplit[0],$dateSplit[2]));

        return $formatDate;
    }


    private function fetchSchedulesByMuseumAndDay($museumId, $dayId){
        $schedulesJsonData = [];
        $schedules = $this->getDoctrine()->getRepository(ScheduleRepository::class)->findSchedulesOrdered($museumId, $dayId);

        for ($i = 0; $i < count($schedules); $i++){
            $takenSeats = 0;
            $maxSeatsCapacity = $schedules[$i]->getMuseum()->getMaxCapacity();
            $tickets = $schedules[$i]->getTickets();
            $tempData = [];

            //[0] -> id of the schedule
            array_push($tempData, $schedules[$i]->getId());

            for ($j = 0; $j < count($tickets); $j++){
                $takenSeats += $tickets[$j]->getNumber();
            }
            $freeSeats = $maxSeatsCapacity- $takenSeats;

            //[1] -> free space in the museum
            array_push($tempData, $freeSeats);
            //[2] -> museum max capacity
            array_push($tempData, $schedules[$i]->getMuseum()->getMaxCapacity());
            //[3] -> schedule start time
            array_push($tempData, $schedules[$i]->getStartTime());
            //[4] -> schedule end time
            array_push($tempData, $schedules[$i]->getEndTime());
            //[5] -> schedule price
            array_push($tempData, $schedules[$i]->getPrice());

            array_push($schedulesJsonData, $tempData);
        }
        return $schedulesJsonData;
    }

    private function postReviewByTorOperatorToMuseum($tourOperator, $museum, $params){
        $em = $this->getDoctrine()->getManager();
        $review = new MuseumReview();

        $review->setText($params['text']);
        $review->setRating($params['rating']);
        $review->setTourOperator($tourOperator);
        $review->setMuseum($museum);
        $review->setDate($params['date']);

        $em->persist($review);
        $em->flush();

    }

    private function postTicketByTorOperatorToSchedule($tourOperator, $schedule, $params){
        $ticket = new Ticket();
        $em = $this->getDoctrine()->getManager();
        $today = new \DateTime();

        $ticket->setNumber($params["number"]);
        $ticket->setSchedule($schedule);
        $ticket->setTourOperator($tourOperator);
        $ticket->setTime($today);
        $ticket->setBoughtDate($today);
        $ticket->setReservedDate($params['reserveDate']);

        $em->persist($ticket);
        $em->flush();
    }


}
