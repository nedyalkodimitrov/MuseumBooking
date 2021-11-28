<?php

namespace App\Controller\TourOperator;

use App\Entity\Image;
use App\Entity\MuseumReview;
use App\Entity\Schedule;
use App\Repository\DayRepository;
use App\Repository\MuseumReviewsRepository;
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

class Controller extends BaseController
{
    private const  ImagePath = "images/tourOperator/";

    /**
     * @Route("/tourOperator", name="tour_operator")
     */
    public function showHome(MuseumRepository $museumRepository, TicketRepository  $ticketRepository)
    {
        $tourOperator = $this->getUser()->getTourOperator();
//        $tickets = $tourOperator->getTickets();
        $tickets = $ticketRepository->findBy(['tourOperator'=> $tourOperator->getId()],['boughtDate'=>'DESC'], 4);

        $topMuseums = $museumRepository->getTopMuseums();

        $params = [
            'controller_name' => 'Controller',
            'tickets' => $tickets,
            'topMuseums' => $topMuseums,

        ];

        return $this->customRenderView('tour_operator/home/index.html.twig', $params);

    }
    /**
     * @Route("/tourOperator/settings", name="tourOperator_settings")
     */
    public function showSettings(Request $request, FileService $fileService )
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
            'controller_name' => 'Controller',
            'form' => $form->createView(),
            'userName' => $tourOperator->getName() ,
            'userFirstName' => $tourOperator->getName() ,
            'userFamilyName' => $tourOperator->getFName(),
            'userImage' => self::ImagePath.$tourOperator->getImage()

        ]);
    }


    /**
     * @Route("/tourOperator/stats", name="tour_operator_show_stats")
     */
    public function showStats(tourOperatorService $tourOperatorService, TourOperatorRepository $tourOperatorRepository, TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {
        $tourOperator = $this->getUser()->getTourOperator();
        $bestReview = $tourOperatorService->getBestReview($tourOperator->getId(), $tourOperatorRepository);
        $tickets = $tourOperatorService->getTickets($tourOperator->getId(), $ticketRepository);
        $visitedMuseums = $tourOperatorService->getVisitedMuseums($tourOperator->getid(), $ticketRepository, $tourOperatorRepository);

        $params =  [
            'bestReview' => $bestReview,
            'tickets' => $tickets,
            'tourOperator' => $tourOperator,
            'visitedMuseums' => $visitedMuseums
        ];

        return $this->customRenderView('tour_operator/stats/stats.html.twig', $params);

    }

    /**
     * @Route("/tourOperator/tourists", name="tour_operator_tourists")
     */
    public function showTourists(tourOperatorService $tourOperatorService,TourOperatorRepository $tourOperatorRepository, TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {
        $tourOperator = $this->getUser()->getTourOperator();
        $tickets = $ticketRepository->getAllTourOperatorTicketsOrdered($tourOperator->getId());
        $bestTourOperators = $tourOperatorService->getBestTourOperator($tourOperatorRepository);

        $museums = $museumRepository->findAll();

        $params = [
                'tickets' => $tickets,
                'museums' => $museums,
                'bestTourOperators' => $bestTourOperators
        ];

        return $this->customRenderView('tour_operator/tourists/tourists.html.twig', $params);

    }

    /**
     * @Route("/tourOperator/profile/{profileId}", name="tour_operator_profile_visit")
     */
    public function showFriendProfile($profileId, TourOperatorRepository $tourOperatorRepository, tourOperatorService $tourOperatorService)
    {
        $tourOperator = $this->getUser()->getTourOperator();
        $friend = $tourOperatorRepository->find($profileId);
        $bestReview = $tourOperatorService->getBestReview($tourOperator->getId(), $tourOperatorRepository);

        $params =  [
                'controller_name' => 'Controller',
                'friend' => $friend,
                'bestReview' => $bestReview
        ];

        return $this->customRenderView('tour_operator/tourists/tourists.html.twig', $params);
    }

    /**
     * @Route("/tourOperator/boughtTickets", name="tour_operator_boughtTickets")
     */
    public function showBoughtTickets($id,TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {

    }











}
