<?php

namespace App\Controller\TourOperator;

use App\Entity\Ticket;
use App\Repository\ScheduleRepository;
use App\Repository\TourOperatorRepository;
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

        $ticket = new Ticket();
        $schedule = $scheduleRepository->find($scheduleId);
        $tourOperator = $tourOperatorRepository->find($tourOperatorId);
        $ticket->setNumber(intval($number));
        $ticket->setSchedule($schedule);
        $ticket->setTourOperator($tourOperator);
        $ticket->setTime(new \DateTime());
        $ticket->setDate(new \DateTime());


        $em = $this->getDoctrine()->getManager();
        $em->persist($ticket);
        $em->flush();

        return $this->json('1');

    }




}
