<?php

namespace App\Controller\TourOperator;

use App\Entity\Image;
use App\Entity\Schedule;
use App\Repository\DayRepository;
use App\Repository\TourOperatorRepository;
use App\Service\FileService;
use App\Repository\MuseumRepository;
use App\Repository\ScheduleRepository;
use App\Repository\TicketRepository;
use App\Service\tourOperatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class TourOperatorController extends AbstractController
{
    private const  ImagePath = "images/tourOperator/";

    /**
     * @Route("/tourOperator", name="tour_operator")
     */
    public function home(MuseumRepository $museumRepository, TicketRepository  $ticketRepository)
    {
        $tourOperator = $this->getUser()->getTourOperator();
        $tickets = $tourOperator->getTickets();
        $tickets = $ticketRepository->findBy(['tourOperator'=> $tourOperator->getId()],['boughtDate'=>'DESC'], 4);

        $topMuseums = $museumRepository->getTopMuseums();
        return $this->render('tour_operator/home/index.html.twig', [
            'controller_name' => 'TourOperatorController',
            'tickets' => $tickets,
            'topMuseums' => $topMuseums,
            'userName' => $tourOperator->getName() .' '. $tourOperator->getFName(),
            'userImage' => self::ImagePath.$tourOperator->getImage()
        ]);
    }
    /**
     * @Route("/tourOperator/settings", name="tourOperator_settings")
     */
    public function settings(Request $request, FileService $fileService )
    {   
        $tourOperator = $this->getUser()->getTourOperator();

        $tourOperatorFormObj = new \App\Entity\TourOperator();

        $form = $this->createFormBuilder($tourOperatorFormObj)
            ->add("image", FileType::class,array('data_class' => null, ))
            ->add("button", SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $fileName = $fileService->MoveImage($form, false);
        if ($fileName != null){


            if($fileName != false) {
                $em = $this->getDoctrine()->getManager();
                $tourOperator->setImage($fileName);
                $em->persist($tourOperator);
                $em->flush();

            }
        }
        }


        return $this->render('tour_operator/settings/settings.html.twig', [
            'controller_name' => 'TourOperatorController',
            'form' => $form->createView(),
            'userName' => $tourOperator->getName() .' '. $tourOperator->getFName(),
            'userFirstName' => $tourOperator->getName() ,
            'userFamilyName' => $tourOperator->getFName(),
            'userImage' => self::ImagePath.$tourOperator->getImage()

        ]);
    }
    /**
     * @Route("/tourOperator/museum/{id}", name="tour_operator_museumView")
     */
    public function museum($id,TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {
        $museum = $museumRepository->find(intval($id));
        $tourOperator = $this->getUser()->getTourOperator();

        $date = new \DateTime();
        $dayName = $date->format("l");

        $dayId = $dayRepository->findOneBy(["name" => $dayName]);

        $schedule = null;
        if ($dayId != null) {
            $schedule = $scheduleRepository->findSchedulesOrdered($id, $dayId);
        }
        $tourOperatorTickets = $ticketRepository->getTourOperatorTicketsOrdered($tourOperator->getId());

        return $this->render('tour_operator/museum/museum.html.twig', [
            'controller_name' => 'TourOperatorController',
            'museum' => $museum,
            'schedules' => $schedule,
            'tourOperatorTickets' => $tourOperatorTickets,
            'userName' => $tourOperator->getName() .' '. $tourOperator->getFName(),
            'userImage' => self::ImagePath.$tourOperator->getImage()
        ]);
    }

    /**
     * @Route("/tourOperator/stats", name="tour_operator_stats")
     */
    public function stats(tourOperatorService $tourOperatorService, TourOperatorRepository $tourOperatorRepository, TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {
        $tourOperator = $this->getUser()->getTourOperator();
        $bestReview = $tourOperatorService->getBestReview($tourOperator->getId(), $tourOperatorRepository);
        $tickets = $tourOperatorService->getTickets($tourOperator->getId(), $ticketRepository);
        return $this->render('tour_operator/stats/stats.html.twig', [
            'controller_name' => 'TourOperatorController',
            'userName' => $tourOperator->getName() .' '. $tourOperator->getFName(),
            'userImage' => self::ImagePath.$tourOperator->getImage(),
            'bestReview' => $bestReview,
            'tickets' => $tickets
        ]);
    }

    /**
     * @Route("/tourOperator/visitedMuseums", name="tour_operator_visitedMuseums")
     */
    public function visitedMuseums(TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {
        $tourOperator = $this->getUser()->getTourOperator();
        $tickets = $ticketRepository->getTourOperatorTicketsOrdered($tourOperator->getId());

        return $this->render('tour_operator/museum/visitedMuseums.html.twig', [
            'controller_name' => 'TourOperatorController',
            'tickets' => $tickets,
            'userName' => $tourOperator->getName() .' '. $tourOperator->getFName(),
            'userImage' => self::ImagePath.$tourOperator->getImage()

        ]);


    }

    /**
     * @Route("/tourOperator/profile/{profileId}", name="tour_operator_profile_visit")
     */
    public function visitFriendProfile($profileId, TourOperatorRepository $tourOperatorRepository, tourOperatorService $tourOperatorService)
    {
        $tourOperator = $this->getUser()->getTourOperator();
        $friend = $tourOperatorRepository->find($profileId);
        $bestReview = $tourOperatorService->getBestReview($tourOperator->getId(), $tourOperatorRepository);

        return $this->render('tour_operator/friendProfile/friendProfile.html.twig', [
            'controller_name' => 'TourOperatorController',
            'userName' => $tourOperator->getName() .' '. $tourOperator->getFName(),
            'userImage' => self::ImagePath.$tourOperator->getImage(),
            'friend' => $friend,
            'bestReview' => $bestReview

        ]);


    }

    /**
     * @Route("/tourOperator/boughtTickets", name="tour_operator_boughtTickets")
     */
    public function boughtTickets($id,TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {

    }


}
