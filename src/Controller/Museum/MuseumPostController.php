<?php

namespace App\Controller\Museum;

use App\Entity\Museum;
use App\Entity\Schedule;
use App\Repository\DayRepository;
use App\Repository\MuseumRepository;
use App\Repository\ScheduleRepository;
use App\Repository\TicketRepository;
use App\Service\FileService;
use App\Service\tourOperatorService;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\SubmitButton;
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
        $price = $request->request->get("price");

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
        $schedule->setPrice($price);
        $em = $this->getDoctrine()->getManager();

        $em->persist($schedule);
        $em->flush();

        return $this->json(1);

    }

    /**
     * @Route("/museum/deleteSchedule", name="delete-schedule", methods={"POST"})
     */
    public function deleteSchedule(HttpFoundation\Request $request, DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {
        $scheduleId = $request->request->get("scheduleId");

        $equallySchedule = $scheduleRepository->find(intval($scheduleId));

        if ($equallySchedule) {
            $em = $this->getDoctrine()->getManager();

            $em->remove($equallySchedule);
            $em->flush();

            return $this->json("ex");
        }
        var_dump($scheduleId);
        exit();

    }


    /**
     * @Route("/museum/userHasCome", name="user-has-come")
     */
    public function userHasCome(HttpFoundation\Request $request, TicketRepository  $ticketRepository, tourOperatorService  $tourOperatorService)
    {
        $ticketId = $request->request->get("ticketId");

        //set that operator visited museum
        $ticket = $ticketRepository->find($ticketId);
        $ticket->setHasCome(true);

        //change operator visit rate
        $tourOperator = $ticket->getTourOperator();

        //result[0] --> visitedMuseums
        //result[1] --> allTourOperatorTickets
        $result = $tourOperatorService->changeVisitRating($tourOperator);

        $tourOperator->setVisitRating(round(5* ($result[0] / count($result[1])), 1));

        $em = $this->getDoctrine()->getManager();
        $em->persist($ticket);
        $em->persist($tourOperator);
        $em->flush();

        return $this->json( 5* ($result[0] / count($result[1])));

    }


    /**
     * @Route("/museum/userHasNotCome", name="")
     */
    public function userHasNotCome(HttpFoundation\Request $request, TicketRepository  $ticketRepository, tourOperatorService $tourOperatorService)
    {
        $ticketId = $request->request->get("ticketId");

        $ticket = $ticketRepository->find(intval($ticketId));

        $tourOperator = $ticket->getTourOperator();


        //result[0] --> visitedMuseums
        //result[1] --> allTourOperatorTickets
        $result = $tourOperatorService->changeVisitRating($tourOperator);


        $tourOperator->setVisitRating(round(5* ($result[0] / count($result[1])), 1));

        $em = $this->getDoctrine()->getManager();
        $em->persist($tourOperator);
        $em->flush();

        return $this->json( 5* ($result[0] / count($result[1])));
    }

    /**
     * @Route("/museum/getTouristsByDate", name="getTouristsByDate")
     */
    public function getTouristsByDate(HttpFoundation\Request $request, TicketRepository  $ticketRepository, tourOperatorService $tourOperatorService)
    {
        $dateInString = $request->request->get("date");



        $date =  new \DateTime($dateInString);
        $tourists = $ticketRepository->findBy(['reservedDate' => $date]);
        $touristsInfo = [];

          for ($i = 0; $i < count($tourists); $i++){
              $tourist = [];
              array_push( $tourist, $tourists[$i]->getId());
              array_push( $tourist, $tourists[$i]->getSchedule()->getStartTime());
              array_push( $tourist, $tourists[$i]->getSchedule()->getEndTime());
              array_push( $tourist,$tourists[$i]->getNumber());
              array_push( $tourist, $tourists[$i]->getTourOperator()->getName());
              array_push( $tourist, $tourists[$i]->getTourOperator()->getFName());
              array_push( $tourist, $tourists[$i]->getTourOperator()->getVisitRating());
              array_push( $touristsInfo, $tourist);
          }





        return $this->json($touristsInfo );
    }

    /**
     * @Route("/museum/additionInformationChange", name="changeAdditionalInformation")
     */
    public function additionalInformationChangeAction(HttpFoundation\Request $request)
    {
        $additionaInforamation = $request->request->get('additionalInformation');

        $museum = $this->getUser()->getMuseum();
        $museum->setAdditionalInformation($additionaInforamation);
        $em = $this->getDoctrine()->getManager();
        $em->persist($museum);
        $em->flush();
        return $this->json(1);
    }


}
